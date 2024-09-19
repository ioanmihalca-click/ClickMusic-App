<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PromoEmail extends Model
{
    use Notifiable;

    protected $fillable = [
        'recipient_email',
        'recipient_name',
        'status',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->recipient_email;
    }

    public static function unsubscribe($email)
    {
        $promoEmail = self::where('recipient_email', $email)->first();
        
        if ($promoEmail) {
            $promoEmail->delete();
            return true;
        }
        
        return false;
    }

}
