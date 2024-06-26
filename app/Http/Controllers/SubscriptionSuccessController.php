<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SubscriptionCreated;
use App\Notifications\AbonamentNouCreatAdmin;

class SubscriptionSuccessController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        // Verify that the subscription was actually created
        if ($user->subscribed('prod_QGao8eve2XHvzf')) {
            $user->notify(new SubscriptionCreated());
            User::find(1)->notify(new AbonamentNouCreatAdmin());
        }

        return redirect()->route('videoclipuri');
    }
}