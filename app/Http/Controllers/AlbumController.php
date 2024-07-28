<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\ComandaAlbum;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Mail\ComandaAlbumConfirmare;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function checkout(Album $album)
    {
        return redirect($album->payment_link);
    }

    public function checkoutSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Log::info('Stripe Secret Key: ' . substr(config('services.stripe.secret'), 0, 5) . '...');
  
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            Log::error('Session ID missing from request');
            return redirect()->route('magazin')->with('error', 'Sesiunea de plată nu a fost găsită.');
        }

        try {
            $session = Session::retrieve($sessionId);
            Log::info("Session retrieved successfully", ['payment_status' => $session->payment_status]);
            
            if ($session->payment_status !== 'paid') {
                Log::warning("Payment not completed", ['status' => $session->payment_status]);
                return redirect()->route('magazin')->with('error', 'Plata nu a fost finalizată cu succes.');
            }
            
            $albumId = $session->client_reference_id;
            $email = $session->customer_details['email'];

            Log::info("Processing order for Album ID: {$albumId}");

            $album = Album::findOrFail($albumId);
            Log::info("Album found", ['album' => $album->toArray()]);

            $comanda = ComandaAlbum::create([
                'email' => $email,
                'album_id' => $albumId,
                'download_link' => $this->generateDownloadLink($album),
            ]);
            
            if (!$comanda) {
                Log::error("Failed to create order for Album ID: {$albumId}, Email: {$email}");
                return redirect()->route('magazin')->with('error', 'Nu s-a putut crea comanda.');
            }
            
            Log::info("Order created successfully", ['order' => $comanda->toArray()]);

            $this->sendConfirmationEmail($comanda);
        
            return view('albums.checkout_success', compact('comanda')); 
        } catch (ApiErrorException $e) {
            Log::error("Stripe API Error: {$e->getMessage()}", ['exception' => $e]);
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la preluarea detaliilor plății.');
        } catch (\Exception $e) {
            Log::error("Eroare la procesarea plății: {$e->getMessage()}", [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'session_id' => $sessionId
            ]);
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la procesarea plății.');
        }
    }
    
    private function sendConfirmationEmail(ComandaAlbum $comanda)
    {
        try {
            Mail::to($comanda->email)->send(new ComandaAlbumConfirmare($comanda));
            Log::info("Confirmation email sent successfully", ['order_id' => $comanda->id]);
        } catch (\Exception $e) {
            Log::error("Failed to send confirmation email", ['error' => $e->getMessage(), 'order_id' => $comanda->id]);
        }
    }

    private function generateDownloadLink(Album $album)
    {
        return URL::signedRoute('album.download', ['album' => $album->id], now()->addHours(24));
    }

    public function download(Request $request, Album $album)
    {
        if (!$request->hasValidSignature()) {
            Log::warning("Invalid signature for download", ['album_id' => $album->id]);
            abort(401);
        }

        $filePath = Storage::disk('public')->path($album->file_path);

        if (!Storage::disk('public')->exists($album->file_path)) {
            Log::error("Album file not found", ['album_id' => $album->id, 'file_path' => $album->file_path]);
            abort(404, 'Fișierul albumului nu a fost găsit.');
        }

        return response()->download($filePath, $album->titlu . '.zip');
    }
}