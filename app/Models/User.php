<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Panel;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Cashier\Concerns\ManagesSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, Billable, ManagesSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'avatar',
        'newsletter_unsubscribed_at',
        'newsletter_consent',
        'forum_notifications',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'newsletter_unsubscribed_at' => 'datetime',
            'newsletter_consent' => 'boolean',
            'forum_notifications' => 'boolean',
        ];
    }

    // Add accessor for avatar
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) {
                    return 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
                }
                return asset('storage/' . $value);
            }
        );
    }

    /**
     * NEWSLETTER FUNCTIONALITY - Logică simplificată
     * Toți utilizatorii primesc newsletter implicit, exceptând cei dezabonați
     */

    /**
     * Scope pentru utilizatori abonați la newsletter (toți minus cei dezabonați)
     */
    public function scopeNewsletterSubscribed(Builder $query): Builder
    {
        return $query->whereNull('newsletter_unsubscribed_at');
    }

    /**
     * Verifică dacă utilizatorul este abonat la newsletter
     */
    public function isSubscribedToNewsletter(): bool
    {
        return is_null($this->newsletter_unsubscribed_at);
    }

    /**
     * Reabonează utilizatorul la newsletter (șterge data dezabonării)
     */
    public function subscribeToNewsletter(): bool
    {
        return $this->update([
            'newsletter_unsubscribed_at' => null,
        ]);
    }

    /**
     * Dezabonează utilizatorul de la newsletter
     */
    public function unsubscribeFromNewsletter(): bool
    {
        return $this->update([
            'newsletter_unsubscribed_at' => now(),
        ]);
    }

    /**
     * Returnează utilizatorii abonați la newsletter
     */
    public static function getNewsletterSubscribers()
    {
        return static::newsletterSubscribed()->get();
    }

    /**
     * Returnează numărul de abonați la newsletter
     */
    public static function getNewsletterSubscribersCount(): int
    {
        return static::newsletterSubscribed()->count();
    }

    /**
     * Pentru compatibilitate cu sistemul de notificări newsletter
     * Permite utilizarea User ca recipient pentru newsletter
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    /**
     * Proprietăți computed pentru a mima structura Newsletter
     */
    public function getRecipientEmailAttribute(): string
    {
        return $this->email;
    }

    public function getRecipientNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * EXISTING FUNCTIONALITY
     */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function findOrCreateGoogleUser($providerUser)
    {
        $user = User::where('email', $providerUser->email)->first();

        if (!$user) {

            $randomPassword = Str::random(16);
            $user = User::create([
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                'password' => bcrypt($randomPassword),
                // newsletter_unsubscribed_at va fi null implicit = abonat la newsletter
            ]);
        }

        return $user;
    }

    public function subscribed()
    {
        // Check if the user has an active subscription
        return $this->subscriptions()
            ->where('stripe_status', 'active')
            ->exists();
    }

    public function isEligibleForFreePlan()
    {
        return $this->usertype === 'admin' || $this->usertype === 'super_user';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, 'ioanclickmihalca@gmail.com');
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function forumReplies()
    {
        return $this->hasMany(ForumReply::class);
    }

    /**
     * Verifică dacă utilizatorul este dezabonat
     */
    public function getUnsubscribedAttribute(): bool
    {
        return !is_null($this->newsletter_unsubscribed_at);
    }

    /**
     * User's custom notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get unread notifications count
     */
    public function unreadNotificationsCount()
    {
        return $this->notifications()->whereNull('read_at')->count();
    }

    // Determine if the user has an active premium subscription
    public function isPremium()
    {
        if ($this->usertype === 'admin' || $this->usertype === 'super_user') {
            return true;
        }

        return $this->subscribed('prod_QGao8eve2XHvzf');
    }

    // Determine if the user should see premium badges (is a paying user)
    public function hasPremiumBadge()
    {
        return $this->isPremium() && $this->usertype !== 'admin' && $this->usertype !== 'super_user';
    }

    // Determine if the user has a free plan (authenticated but not premium)
    public function hasFreePlan()
    {
        return !$this->isPremium() && $this->id;
    }

    // Check if user can access community features
    public function canAccessCommunity()
    {
        // All authenticated users can access community
        return $this->id !== null;
    }

    // Check if user can access premium video content
    public function canAccessPremiumContent()
    {
        return $this->isPremium();
    }

    // Get the user's membership type for display
    public function getMembershipTypeAttribute()
    {
        if ($this->usertype === 'admin') {
            return 'Admin';
        } elseif ($this->usertype === 'super_user') {
            return 'Super User';
        } elseif ($this->isPremium()) {
            return 'Premium';
        } else {
            return 'Free';
        }
    }
}
