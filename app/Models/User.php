<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

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
        ];
    }

     // Add accessor for avatar
     protected function avatar(): Attribute
     {
         return Attribute::make(
             get: function ($value) {
                 if (!$value) {
                     return 'https://ui-avatars.com/api/?name='.urlencode($this->name);
                 }
                 return asset('storage/' . $value);
             }
         );
     }

    public function comments() {
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

}
