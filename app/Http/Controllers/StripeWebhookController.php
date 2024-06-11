<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Handle the incoming webhook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['type'];

        if ($eventType == 'customer.subscription.updated' || $eventType == 'customer.subscription.created') {
            $subscription = $payload['data']['object'];
            $user = User::where('stripe_id', $subscription['customer'])->first();

            if ($user) {
                // Update the user's subscription status in the database
                $user->subscriptions()
                     ->where('stripe_id', $subscription['id'])
                     ->update(['stripe_status' => $subscription['status']]);
            }
        }

        return response('Webhook Handled', 200);
    }
}
