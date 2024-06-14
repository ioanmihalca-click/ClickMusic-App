<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Notifications\SubscriptionCancelled;

class SubscriptionController extends Controller
{
    public function cancelSubscription(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'You must be logged in to cancel your subscription.']);
        }

        try {
            $subscription = $user->subscription('prod_QGao8eve2XHvzf');

            if ($subscription) {
                $subscription->cancelNow();

                   // Notify the user that their subscription has been cancelled
                   $user->notify(new SubscriptionCancelled());
                
                return redirect()->route('abonament')->with('success', 'Abonamentul tau a fost anulat cu succes.'); // Redirect to abonament.blade using route name
                   
            } else {
                  return redirect()->route('abonament')->withErrors(['error' => 'Nu ai un abonament activ']);
            }
        } catch (\Exception $e) {  // Catch potential exceptions
            report($e);
            return redirect()->route('abonament')->withErrors(['error' => 'A aparut o eroare. Te rugam incearca mai tarziu.']);
        }
    }

}