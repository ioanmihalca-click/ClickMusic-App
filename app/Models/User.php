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

class User extends Authenticatable
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

public function cancelNow($name = 'default')
    {
        $subscription = $this->subscription($name);

        if (!$subscription) {
            throw new \Exception("No subscription found with the name {$name}.");
        }

        $subscription->cancel();

        $this->markAsCancelled();

        return $this;
    }

    public function markAsCancelled()
    {
        $this->fill(['ends_at' => Carbon::now()])->save();
    }

// public static function findOrCreateFacebookUser($providerUser)
// {
//     $user = self::where('email', $providerUser->email)->first();

//     if (!$user) {
//         $randomPassword = Str::random(16);
//         $user = self::create([
//             'name' => $providerUser->name,
//             'email' => $providerUser->email,
//             'password' => bcrypt($randomPassword),
//         ]);
//     }

//     return $user;
// }


}
