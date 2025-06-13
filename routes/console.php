<?php

use App\Models\Newsletter;
use App\Jobs\SendNewsletters;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Scheduler pentru newslettere - rulează zilnic la 09:00
Artisan::command('newsletter:schedule', function () {
    $pendingNewsletters = Newsletter::pending()->get();

    if ($pendingNewsletters->isEmpty()) {
        $this->info('Nu există newslettere pending de trimis.');
        Log::info('Newsletter scheduler: Nu există newslettere pending');
        return;
    }

    $remainingQuota = Newsletter::getRemainingQuota(200);

    if ($remainingQuota <= 0) {
        $this->warn('Limita zilnică de 200 emailuri a fost deja atinsă.');
        Log::info('Newsletter scheduler: Limita zilnică atinsă');
        return;
    }

    // Verificăm dacă avem image_url și url setate pentru a putea trimite
    // Pentru scheduler, vom avea nevoie de valori default sau de o metodă de a le obține
    $this->warn('⚠️  Pentru a trimite newslettere automat, este nevoie de image_url și url.');
    $this->warn('Aceasta comandă doar verifică și raportează starea newsletterelor.');

    $this->info("📊 Raport newslettere:");
    $this->info("   • Pending: {$pendingNewsletters->count()}");
    $this->info("   • Quota rămasă astăzi: {$remainingQuota}");
    $this->info("   • Pot fi trimise astăzi: " . min($pendingNewsletters->count(), $remainingQuota));

    Log::info("Newsletter scheduler: {$pendingNewsletters->count()} pending, quota rămasă: {$remainingQuota}");
})->purpose('Verifică și raportează starea newsletterelor pending')->dailyAt('09:00');

// Comandă pentru curățarea newsletterelor vechi eșuate
Artisan::command('newsletter:cleanup', function () {
    $daysOld = 30;
    $oldFailedCount = Newsletter::failed()
        ->where('failed_at', '<', now()->subDays($daysOld))
        ->count();

    if ($oldFailedCount > 0) {
        Newsletter::failed()
            ->where('failed_at', '<', now()->subDays($daysOld))
            ->delete();

        $this->info("🗑️  Șterse {$oldFailedCount} newslettere eșuate mai vechi de {$daysOld} zile.");
        Log::info("Newsletter cleanup: Șterse {$oldFailedCount} newslettere vechi");
    } else {
        $this->info('Nu există newslettere vechi de șters.');
    }
})->purpose('Șterge newsletterele eșuate mai vechi de 30 zile')->weekly();

// Comandă pentru statistici rapide
Artisan::command('newsletter:stats', function () {
    $totalSubscribers = Newsletter::count();
    $pendingCount = Newsletter::pending()->count();
    $sentCount = Newsletter::sent()->count();
    $failedCount = Newsletter::failed()->count();
    $sentToday = Newsletter::getSentTodayCount();
    $remainingQuota = Newsletter::getRemainingQuota(200);

    $this->info('📊 STATISTICI NEWSLETTER');
    $this->info('========================');
    $this->info("Total abonați: {$totalSubscribers}");
    $this->info("În așteptare: {$pendingCount}");
    $this->info("Trimise cu succes: {$sentCount}");
    $this->info("Eșuate: {$failedCount}");
    $this->info('------------------------');
    $this->info("Trimise astăzi: {$sentToday}/200");
    $this->info("Quota rămasă: {$remainingQuota}");

    if ($remainingQuota <= 0) {
        $this->warn('⚠️  Limita zilnică a fost atinsă!');
    }
})->purpose('Afișează statistici rapide despre newslettere');

// Comandă pentru resetarea newsletterelor eșuate la pending
Artisan::command('newsletter:retry-failed', function () {
    $failedNewsletters = Newsletter::failed()->get();

    if ($failedNewsletters->isEmpty()) {
        $this->info('Nu există newslettere eșuate de reîncercat.');
        return;
    }

    if (!$this->confirm("Vrei să resetezi {$failedNewsletters->count()} newslettere eșuate la status 'pending'?")) {
        $this->info('Operațiune anulată.');
        return;
    }

    $failedNewsletters->each(function ($newsletter) {
        $newsletter->resetToPending();
    });

    $this->info("✅ Resetate {$failedNewsletters->count()} newslettere la status 'pending'.");
    Log::info("Newsletter retry: Resetate {$failedNewsletters->count()} newslettere eșuate");
})->purpose('Resetează newsletterele eșuate la status pending');
