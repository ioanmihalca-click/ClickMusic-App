<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SubscriptionCreated;
use App\Notifications\AbonamentNouCreatAdmin;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1PQ3d2LHnRRaUZdBVHGvJcQX')
    {
        $user = $request->user();
        $checkout = $user
            ->newSubscription('prod_QGao8eve2XHvzf', $plan)
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url' => url('/'),
            ]);

        // After the checkout, send the SubscriptionCreated notification
        // if ($checkout) {
        //     $user->notify(new SubscriptionCreated());
        //     User::find(1)->notify(new AbonamentNouCreatAdmin);
        // }

        return $checkout;
    } 
}
