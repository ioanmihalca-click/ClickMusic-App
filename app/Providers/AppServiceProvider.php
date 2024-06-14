<?php


// app/Providers/AppServiceProvider.php

namespace App\Providers;

use App\Models\User;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Notifications\SubscriptionCreated;
use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Events\WebhookReceived;
use App\Listeners\HandleStripeSubscriptionCreated;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
  
}
}