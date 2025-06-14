<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Panel;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use MBarlow\Megaphone\HasMegaphone;
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
    use HasFactory, Notifiable, Billable, HasMegaphone, ManagesSubscriptions;

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
}
