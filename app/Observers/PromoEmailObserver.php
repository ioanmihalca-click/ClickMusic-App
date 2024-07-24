<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\PromoEmail;

class PromoEmailObserver
{
    public function updated(PromoEmail $promoEmail)
    {
        if ($promoEmail->status === 'sent') {
            // Programează resetarea statusului după 24 de ore
            $promoEmail->update(['status' => 'pending', 'sent_at' => null]);
            // sau 
            // Resetează statusul după 24 de ore
            PromoEmail::where('id', $promoEmail->id)
                ->where('status', 'sent')
                ->where('sent_at', '<', Carbon::now()->subHours(24))
                ->update(['status' => 'pending', 'sent_at' => null]);
        }
    }
}