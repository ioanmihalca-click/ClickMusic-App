<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1PQ3d2LHnRRaUZdBVHGvJcQX')
    {
        return $request->user()
        ->newSubscription('prod_QGao8eve2XHvzf', $plan)
       
        ->checkout([
            'success_url' => route('videoclipuri'),
            'cancel_url' => url('/'),
        ]);
    }
}
