<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && (
            $request->user()->subscribed('prod_QGao8eve2XHvzf') || 
            $request->user()->usertype === 'super_user' ||
            $request->user()->usertype === 'admin' // Allow admins as well
        )) {
            return $next($request);
        }

        return redirect('abonament'); 
    }
}