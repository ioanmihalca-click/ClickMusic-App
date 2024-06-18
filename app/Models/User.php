<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Concerns\ManagesSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use MBarlow\Megaphone\HasMegaphone;

class User extends Authenticatable
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


}
