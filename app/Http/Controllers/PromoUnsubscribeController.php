<?php

namespace App\Http\Controllers;

use App\Models\PromoEmail;
use Illuminate\Http\Request;

class PromoUnsubscribeController extends Controller
{
    public function unsubscribe(Request $request)
    {
        $email = $request->email;
        
        if ($email && PromoEmail::unsubscribe($email)) {
            return view('promo.unsubscribe', ['success' => 'V-ați dezabonat cu succes de la e-mailurile promoționale.']);
        }
        
        return view('promo.unsubscribe', ['error' => 'Adresa de email nu a fost găsită sau a apărut o eroare la dezabonare.']);
    }
}