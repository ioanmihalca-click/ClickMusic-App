<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Abonare la newsletter (pentru vizitatori ne-înregistrați)
     */
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:newsletters,recipient_email',
        ]);

        // Verificăm dacă email-ul aparține unui utilizator înregistrat
        $existingUser = User::where('email', $validatedData['email'])->first();

        if ($existingUser) {
            // Dacă utilizatorul există, îl reabonăm la newsletter
            if ($existingUser->isSubscribedToNewsletter()) {
                return redirect()->back()->with('info', 'Ești deja abonat la newsletter cu acest email!');
            } else {
                $existingUser->subscribeToNewsletter();
                return redirect()->back()->with('success', 'Te-ai reabornat cu succes la newsletter!');
            }
        }

        // Dacă nu este utilizator înregistrat, îl adăugăm în lista Newsletter
        Newsletter::create([
            'recipient_name' => $validatedData['name'],
            'recipient_email' => $validatedData['email'],
            'status' => Newsletter::STATUS_PENDING,
            'campaign_type' => Newsletter::TYPE_SUBSCRIBER, // Adăugăm tipul corect de subscriber
        ]);

        Log::info("Newsletter subscription: {$validatedData['email']} added to newsletter list");

        return redirect()->back()->with('success', 'V-ați abonat cu succes la newsletter!');
    }

    /**
     * Dezabonare de la newsletter (pentru ambele: Newsletter și Users)
     */
    public function unsubscribe(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return view('newsletter.unsubscribe', ['error' => 'Adresa de email nu a fost găsită.']);
        }

        $unsubscribed = false;
        $message = '';

        // 1. Verificăm dacă este utilizator înregistrat
        $user = User::where('email', $email)->first();
        if ($user && $user->isSubscribedToNewsletter()) {
            $user->unsubscribeFromNewsletter();
            $unsubscribed = true;
            Log::info("User unsubscribed from newsletter: {$email}");
        }

        // 2. Verificăm dacă este în lista Newsletter
        $newsletter = Newsletter::where('recipient_email', $email)->first();
        if ($newsletter) {
            $newsletter->delete();
            $unsubscribed = true;
            Log::info("Newsletter entry deleted: {$email}");
        }

        if ($unsubscribed) {
            $message = 'Te-ai dezabonat cu succes de la newsletter!';
        } else {
            $message = 'Adresa de email nu a fost găsită în listele noastre.';
        }

        return view('newsletter.unsubscribe', ['success' => $message]);
    }

    /**
     * Reabonare pentru utilizatori (prin link special sau formular)
     */
    public function resubscribe(Request $request)
    {
        $email = $request->input('email') ?? $request->query('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Adresa de email este necesară.');
        }

        // Verificăm dacă este utilizator înregistrat
        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->isSubscribedToNewsletter()) {
                return redirect()->back()->with('info', 'Ești deja abonat la newsletter!');
            } else {
                $user->subscribeToNewsletter();
                Log::info("User resubscribed to newsletter: {$email}");
                return redirect()->back()->with('success', 'Te-ai reabornat cu succes la newsletter!');
            }
        }

        return redirect()->back()->with('error', 'Contul nu a fost găsit. Te poți abona folosind formularul de mai jos.');
    }

    /**
     * Status abonare pentru un email (API endpoint util)
     */
    public function status(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return response()->json(['error' => 'Email required'], 400);
        }

        $isSubscribed = false;
        $source = null;

        // Verificăm în Users
        $user = User::where('email', $email)->first();
        if ($user && $user->isSubscribedToNewsletter()) {
            $isSubscribed = true;
            $source = 'user';
        }

        // Verificăm în Newsletter
        $newsletter = Newsletter::where('recipient_email', $email)->exists();
        if ($newsletter) {
            $isSubscribed = true;
            $source = $source ? 'both' : 'newsletter';
        }

        return response()->json([
            'email' => $email,
            'subscribed' => $isSubscribed,
            'source' => $source,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Statistici publice pentru newsletter (pentru dashboard-uri externe)
     */
    public function stats()
    {
        $stats = [
            'newsletter_subscribers' => Newsletter::count(),
            'user_subscribers' => User::getNewsletterSubscribersCount(),
            'total_unique' => Newsletter::count() + User::getNewsletterSubscribersCount() -
                User::whereIn('email', Newsletter::pluck('recipient_email'))->count(),
            'sent_today' => Newsletter::getSentTodayCount(),
            'remaining_quota' => Newsletter::getRemainingQuota(200),
        ];

        return response()->json($stats);
    }

    /**
     * Verifică dacă un utilizator poate fi adăugat în newsletter
     */
    private function canAddToNewsletter(string $email): array
    {
        $user = User::where('email', $email)->first();
        $newsletter = Newsletter::where('recipient_email', $email)->first();

        if ($user && $user->isSubscribedToNewsletter()) {
            return ['can_add' => false, 'reason' => 'User already subscribed'];
        }

        if ($newsletter) {
            return ['can_add' => false, 'reason' => 'Email already in newsletter list'];
        }

        return ['can_add' => true, 'reason' => null];
    }
}
