<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Models\Album;
use App\Models\ComandaAlbum;
use App\Mail\ComandaAlbumConfirmare;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class HandleCheckoutSessionCompleted
{
    public function handle(WebhookReceived $event)
{
    if ($event->payload['type'] === 'checkout.session.completed') {
        $session = $event->payload['data']['object'];
        
        // Get the first line item's price ID
        $priceId = $session['line_items']['data'][0]['price']['id'];
        
        // Find the album associated with this price ID
        $album = Album::where('stripe_price_id', $priceId)->firstOrFail();
        $email = $session['customer_details']['email'];

        // Create the order
        $comanda = ComandaAlbum::create([
            'email' => $email,
            'album_id' => $album->id,
            'download_link' => $this->generateDownloadLink($album),
        ]);

        // Send confirmation email
        Mail::to($email)->send(new ComandaAlbumConfirmare($comanda));
    }
}

    private function generateDownloadLink($album)
    {
        return URL::signedRoute('album.download', ['album' => $album->id], now()->addHours(24));
    }
}