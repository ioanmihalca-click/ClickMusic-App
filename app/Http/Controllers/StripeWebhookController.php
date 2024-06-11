<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class StripeWebhookController extends \Laravel\Cashier\Http\Controllers\WebhookController
{
    /**
     * Handle a Stripe webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {
        // Log the webhook payload for debugging
        Log::info('Stripe Webhook received:', $request->all());

        $payload = $request->all();
        $eventType = $payload['type'] ?? null;

        try {
            if ($eventType == 'customer.subscription.updated' || $eventType == 'customer.subscription.created') {
                $this->handleSubscriptionUpdate($payload['data']['object']);
            }

            return response('Webhook Handled', 200);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Stripe Webhook error:', ['error' => $e->getMessage()]);

            return response('Webhook Handling Error', 500);
        }
    }

    /**
     * Handle the subscription update event.
     *
     * @param  array  $subscription
     * @return void
     */
    protected function handleSubscriptionUpdate(array $subscription)
    {
        $user = User::where('stripe_id', $subscription['customer'])->first();

        if ($user) {
            // Update the user's subscription status in the database
            $user->subscriptions()
                ->where('stripe_id', $subscription['id'])
                ->update(['stripe_status' => $subscription['status']]);
        }
    }
}
