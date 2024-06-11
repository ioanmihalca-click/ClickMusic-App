<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{

     
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->subscribed()) {
            // Redirect user to billing page and ask them to subscribe...
            return redirect('abonament');
        }

        return $next($request);
    }


 /**
     * Cancel the user's subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function cancelSubscription(Request $request): Response
    {
        $payload = $request->all();
        $eventType = $payload['type'];
    
        // Check if the event type is 'customer.subscription.deleted'
        if ($eventType == 'customer.subscription.deleted') {
            $subscription = $payload['data']['object'];
            $user = User::where('stripe_id', $subscription['customer'])->first();
    
            if ($user) {
                // Cancel the subscription immediately
                $user->cancelNow();
                // Redirect with success message
                return redirect('/')
                    ->with('success', 'Your subscription has been cancelled.');
            }
        }
        
        // If no subscription was cancelled or user not found, redirect back with an error message
        return redirect()->back()
            ->with('error', 'Unable to cancel subscription.');
    }
}