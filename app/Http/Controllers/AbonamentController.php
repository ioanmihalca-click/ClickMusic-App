<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbonamentController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $activeSubscription = null; // Initialize to null in case no active subscription

        if ($user) { // Check if user is logged in
            $activeSubscription = Subscription::where('user_id', $user->id)
                                             ->where('stripe_status', 'active')
                                             ->first();
        }

        return view('abonament', [
            'user' => $user,
            'activeSubscription' => $activeSubscription,
        ]);
    }
}
