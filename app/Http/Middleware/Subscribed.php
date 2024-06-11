<?php

namespace App\Http\Middleware;

use Closure;
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
        $user = $request->user();

        if ($user && $user->subscribed()) {
            $user->subscription('main')->cancelNow();

            return redirect('/')
                ->with('success', 'Your subscription has been cancelled.');
        }

        return redirect()->back()
            ->with('error', 'Unable to cancel subscription.');
    }
}