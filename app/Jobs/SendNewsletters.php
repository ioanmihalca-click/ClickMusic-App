<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewsletterNotification;

class SendNewsletters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $newsletters;
    protected $imageUrl;
    protected $url;

    // Numărul maxim de reîncercări
    public $tries = 3;

    // Timeout pentru job (30 minute)
    public $timeout = 1800;

    public function __construct(Collection $newsletters, $imageUrl, $url)
    {
        $this->newsletters = $newsletters;
        $this->imageUrl = $imageUrl;
        $this->url = $url;
    }

    public function handle()
    {
        $maxDailySent = 200; // Limita zilnică de siguranță
        $errorCount = 0;
        $maxErrors = 5;
        $processedCount = 0;

        Log::info("Starting SendNewsletters job for {$this->newsletters->count()} newsletters");

        // Verificăm câte mailuri s-au trimis astăzi folosind metoda din model
        $sentToday = Newsletter::getSentTodayCount();
        Log::info("Emails sent today: {$sentToday}/{$maxDailySent}");

        // Dacă am atins limita zilnică, programăm job-ul pentru mâine
        if (Newsletter::isDailyLimitReached($maxDailySent)) {
            Log::info("Daily limit reached. Scheduling job for tomorrow.");
            $this->rescheduleForTomorrow();
            return;
        }

        // Calculăm câte mailuri mai putem trimite astăzi
        $remainingQuota = Newsletter::getRemainingQuota($maxDailySent);
        $newslettersToProcess = $this->newsletters->take($remainingQuota);

        Log::info("Processing {$newslettersToProcess->count()} newsletters (remaining quota: {$remainingQuota})");

        foreach ($newslettersToProcess as $newsletter) {
            try {
                // Verificăm din nou limita pentru fiecare mail
                if (Newsletter::isDailyLimitReached($maxDailySent)) {
                    Log::info("Daily limit reached during processing. Scheduling remaining newsletters for tomorrow.");
                    $this->scheduleRemainingNewsletters($newsletter);
                    break;
                }

                // Trimitem notificarea
                $newsletter->notify(new NewsletterNotification($newsletter, $this->imageUrl, $this->url));

                // Marcăm newsletter-ul ca trimis folosind metoda din model
                $newsletter->markAsSent();

                $processedCount++;
                Log::info("Newsletter sent successfully to {$newsletter->recipient_email} ({$processedCount} processed)");

                // Pauză între mailuri pentru a nu suprasolicita SMTP-ul
                sleep(2);

                // Reconectare la DB din când în când pentru conexiuni lungi
                if ($processedCount % 50 === 0) {
                    DB::connection()->reconnect();
                }
            } catch (Exception $e) {
                $errorCount++;

                // Marcăm newsletter-ul ca eșuat cu mesajul de eroare
                $newsletter->markAsFailed($e->getMessage());

                Log::error("Error sending newsletter to {$newsletter->recipient_email}: {$e->getMessage()}");

                // Dacă avem prea multe erori, oprim job-ul
                if ($errorCount >= $maxErrors) {
                    Log::error("Max error count ({$maxErrors}) reached. Stopping job.");
                    $this->fail($e);
                    return;
                }
            }
        }

        // Dacă mai avem newslettere de trimis, le programăm pentru mâine
        if ($this->newsletters->count() > $processedCount) {
            $remaining = $this->newsletters->skip($processedCount);
            $this->scheduleRemainingNewsletters($remaining->first(), $remaining);
        }

        Log::info("SendNewsletters job completed. Processed: {$processedCount}, Errors: {$errorCount}");
    }

    /**
     * Programează job-ul pentru mâine dimineață
     */
    private function rescheduleForTomorrow()
    {
        $tomorrow = Carbon::tomorrow()->hour(9)->minute(0)->second(0);

        static::dispatch($this->newsletters, $this->imageUrl, $this->url)
            ->delay($tomorrow);

        Log::info("Job rescheduled for tomorrow at 09:00");
    }

    /**
     * Programează newsletterele rămase pentru mâine
     */
    private function scheduleRemainingNewsletters($startNewsletter, Collection $remaining = null)
    {
        if ($remaining === null) {
            // Găsim indexul newsletter-ului curent și luăm restul
            $currentIndex = $this->newsletters->search(function ($item) use ($startNewsletter) {
                return $item->id === $startNewsletter->id;
            });

            $remaining = $this->newsletters->slice($currentIndex);
        }

        if ($remaining->count() > 0) {
            $tomorrow = Carbon::tomorrow()->hour(9)->minute(0)->second(0);

            static::dispatch($remaining, $this->imageUrl, $this->url)
                ->delay($tomorrow);

            Log::info("Scheduled {$remaining->count()} remaining newsletters for tomorrow at 09:00");
        }
    }

    /**
     * Gestionarea eșecului job-ului
     */
    public function failed(Exception $exception)
    {
        Log::error("SendNewsletters job failed: " . $exception->getMessage());

        // Marcăm toate newsletterele rămase ca eșuate folosind metoda din model
        $this->newsletters->each(function ($newsletter) use ($exception) {
            if ($newsletter->status !== Newsletter::STATUS_SENT) {
                $newsletter->markAsFailed($exception->getMessage());
            }
        });
    }
}
