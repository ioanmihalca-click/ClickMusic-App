<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Album;
use App\Models\ComandaAlbum;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Mail\ComandaAlbumConfirmare;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Debugbar\Facades\Debugbar;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('cashier.secret'));
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function checkout(Album $album, Request $request)
    {
        // Validate the email address
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
    
        // Generate a unique order_id
        $orderId = 'ord_' . uniqid();
    
        // Create a temporary order
        $comandaAlbum = ComandaAlbum::create([
            'order_id' => $orderId,
            'album_id' => $album->id,
            'email' => $validatedData['email'],
            'download_link' => null,
            'status' => 'pending',
        ]);
    
        // Create the Stripe Checkout session
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $album->price_id_stripe,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $orderId,
                'cancel_url' => route('album.show', $album),
                'customer_email' => $validatedData['email'],
                'metadata' => [
                    'album_id' => $album->id,
                ],
            ]);
    
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe Session Creation Error: ' . $e->getMessage());
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la crearea sesiunii de plată: ' . $e->getMessage());
        }
    }
    
    public function checkoutSuccess(Request $request)
    {
        try {
            Log::info('Checkout Success: Starting process');
            Log::info('Session ID: ' . $request->get('session_id'));
            Log::info('Order ID: ' . $request->get('order_id'));
    
            $session = Session::retrieve($request->get('session_id'), ['expand' => ['payment_intent']]);
            Log::info('Session retrieved: ' . json_encode($session));
    
            if ($session->status === 'complete') {
                $albumId = $session->metadata->album_id ?? null;
                if (!$albumId) {
                    throw new \Exception('Album ID not found in session metadata');
                }
    
                $album = Album::findOrFail($albumId);
                Log::info('Album found: ' . json_encode($album));
    
                $orderId = $request->get('order_id');
                $comandaAlbum = ComandaAlbum::where('order_id', $orderId)->firstOrFail();
                Log::info('ComandaAlbum found: ' . json_encode($comandaAlbum));
    
                $downloadLink = $comandaAlbum->download_url; // Folosim accessorul definit în model
                Log::info('Generated Download Link: ' . $downloadLink);
    
                $comandaAlbum->update([
                    'status' => 'completed',
                    'download_link' => $downloadLink,
                ]);
    
                Mail::to($comandaAlbum->email)->send(new ComandaAlbumConfirmare($comandaAlbum));
    
                return view('albums.checkout_success', compact('album', 'comandaAlbum'));
            } else {
                Log::warning('Checkout not completed');
                return redirect()->route('magazin')->with('error', 'A apărut o eroare la procesarea plății.');
            }
        } catch (\Exception $e) {
            Log::error('Checkout Success Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la procesarea plății: ' . $e->getMessage());
        }
    }




    public function download(Request $request, Album $album)
{
    if (!$request->hasValidSignature()) {
        abort(403, 'URL invalid sau expirat.');
    }

    $orderId = $request->query('order');
    $comandaAlbum = ComandaAlbum::where('album_id', $album->id)
        ->where('order_id', $orderId)
        ->firstOrFail();

    if ($comandaAlbum->status !== 'completed') {
        abort(403, 'Descărcare neautorizată. Comanda nu este finalizată.');
    }

    $filePath = storage_path('app/public/' . $album->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'Fișierul nu a fost găsit.');
    }

    return response()->download($filePath, $album->titlu . '.zip');
}
}