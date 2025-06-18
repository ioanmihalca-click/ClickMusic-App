<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    public function handle($request, Closure $next, $forVideoOnly = false)
    {
        // Always allow admins and super users
        if ($request->user() && (
            $request->user()->usertype === 'super_user' ||
            $request->user()->usertype === 'admin'
        )) {
            return $next($request);
        }

        // For video content, check subscription status
        if ($forVideoOnly) {
            // Check if user is premium
            if ($request->user() && $request->user()->subscribed('prod_QGao8eve2XHvzf')) {
                return $next($request);
            }

            // If not premium and request is for video streaming, redirect to video page with upsell message
            if (request()->route()->getName() === 'videos.stream') {
                $videoId = request()->route('id');
                return redirect()->route('videos.show', $videoId)->with('upsell', true);
            }

            // For other video-related actions, redirect to subscription page
            return redirect('abonament')->with('upsell', 'Acest conținut este disponibil doar pentru abonații premium.');
        }

        // For forum and other community features, allow all authenticated users
        if ($request->user()) {
            return $next($request);
        }

        // If no user is logged in, redirect to login
        return redirect('login');
    }
}
