<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
                $subscription->cancel();
                return redirect()->route('abonament')->with('success', 'Abonamentul tau a fost anulat cu succes.'); // Redirect to abonament.blade using route name
            } else {
                  return redirect()->route('abonament')->withErrors(['error' => 'You do not have an active subscription.']);
            }
        } catch (\Exception $e) {  // Catch potential exceptions
            report($e);
            return redirect()->route('abonament')->withErrors(['error' => 'An error occurred while canceling your subscription. Please try again later.']);
        }
    }
}
