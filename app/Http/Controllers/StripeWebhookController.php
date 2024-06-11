<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripeWebhookController extends Controller
{
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

        if ($eventType == 'customer.subscription.deleted') {
            $subscription = $payload['data']['object'];
            $user = User::where('stripe_id', $subscription['customer'])->first();

            if ($user) {
                // Cancel the subscription immediately
                $user->subscription('default')->cancelNow();
            }
        }

    
        return response('Webhook Handled', 200);
    }
    
}
