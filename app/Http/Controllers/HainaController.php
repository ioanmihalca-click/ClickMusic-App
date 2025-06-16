<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Haina;
use App\Models\ComandaHaina;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Mail\ComandaHainaConfirmare;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\ApiErrorException;

class HainaController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('cashier.secret'));
    }

    public function show(Haina $haina)
    {
        return view('haine.show', compact('haina'));
    }

    public function checkout(Haina $haina, Request $request)
    {
        // Validate the required data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'nume_cumparator' => 'required|string|max:255',
            'telefon' => 'nullable|string|max:20',
            'adresa_livrare' => 'required|string|max:500',
            'marime_selectata' => 'required|string|in:' . implode(',', $haina->marimi_disponibile),
        ]);

        // Generate a unique order_id
        $orderId = 'haina_' . uniqid();

        // Create a temporary order
        $comandaHaina = ComandaHaina::create([
            'order_id' => $orderId,
            'haina_id' => $haina->id,
            'email' => $validatedData['email'],
            'nume_cumparator' => $validatedData['nume_cumparator'],
            'telefon' => $validatedData['telefon'],
            'adresa_livrare' => $validatedData['adresa_livrare'],
            'marime_selectata' => $validatedData['marime_selectata'],
            'status' => 'pending',
        ]);

        // Create the Stripe Checkout session
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $haina->price_id_stripe,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('haina.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $orderId,
                'cancel_url' => route('haina.show', $haina),
                'customer_email' => $validatedData['email'],
                'metadata' => [
                    'haina_id' => $haina->id,
                    'order_id' => $orderId,
                ],
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe Session Creation Error for Haina: ' . $e->getMessage());
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la crearea sesiunii de plată: ' . $e->getMessage());
        }
    }

    public function checkoutSuccess(Request $request)
    {
        try {
            Log::info('Haina Checkout Success: Starting process');
            Log::info('Session ID: ' . $request->get('session_id'));
            Log::info('Order ID: ' . $request->get('order_id'));

            $session = Session::retrieve($request->get('session_id'), ['expand' => ['payment_intent']]);
            Log::info('Session retrieved: ' . json_encode($session));

            if ($session->status === 'complete') {
                $orderId = $request->get('order_id');
                $comandaHaina = ComandaHaina::where('order_id', $orderId)->firstOrFail();
                Log::info('ComandaHaina found: ' . json_encode($comandaHaina));

                $comandaHaina->update([
                    'status' => 'completed',
                ]);

                // Send confirmation email to customer
                Mail::to($comandaHaina->email)->send(new ComandaHainaConfirmare($comandaHaina));

                // Send notification email to admin
                Mail::to('ioanclickmihalca@gmail.com')->send(new ComandaHainaConfirmare($comandaHaina));

                return view('haine.checkout_success', compact('comandaHaina'));
            } else {
                Log::warning('Haina Checkout not completed');
                return redirect()->route('magazin')->with('error', 'A apărut o eroare la procesarea plății.');
            }
        } catch (\Exception $e) {
            Log::error('Haina Checkout Success Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('magazin')->with('error', 'A apărut o eroare la procesarea plății: ' . $e->getMessage());
        }
    }
}
