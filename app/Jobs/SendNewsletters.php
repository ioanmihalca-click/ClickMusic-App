<?php

namespace App\Jobs;

use Exception;
use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNewsletters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Newsletter $campaign;
    protected Collection $recipients;

    // Numărul maxim de reîncercări
    public $tries = 3;

    // Timeout pentru job (45 minute)
    public $timeout = 2700;

    public function __construct(Newsletter $campaign, Collection $recipients)
    {
        $this->campaign = $campaign;
        $this->recipients = $recipients;
    }

    public function handle()
    {
        $maxDailySent = 200;
        $errorCount = 0;
        $maxErrors = 5;
        $processedCount = 0;
        $sentCount = 0;
        $failedCount = 0;

        Log::info("Starting SendNewsletterCampaign job for campaign: {$this->campaign->campaign_title} with {$this->recipients->count()} recipients");

        // Verificăm câte mailuri s-au trimis astăzi
        $sentToday = Newsletter::getSentTodayCount();
        Log::info("Emails sent today: {$sentToday}/{$maxDailySent}");

        // Dacă am atins limita zilnică, programăm job-ul pentru mâine
        if (Newsletter::isDailyLimitReached($maxDailySent)) {
            Log::info("Daily limit reached. Scheduling campaign for tomorrow.");
            $this->rescheduleForTomorrow();
            return;
        }

        // Calculăm câte mailuri mai putem trimite astăzi
        $remainingQuota = Newsletter::getRemainingQuota($maxDailySent);
        $recipientsToProcess = $this->recipients->take($remainingQuota);

        Log::info("Processing {$recipientsToProcess->count()} recipients (remaining quota: {$remainingQuota})");

        // Marcăm campania ca fiind în proces de trimitere
        $this->campaign->update(['status' => Newsletter::STATUS_PENDING]);

        foreach ($recipientsToProcess as $recipient) {
            try {
                // Verificăm din nou limita pentru fiecare mail
                if (Newsletter::isDailyLimitReached($maxDailySent)) {
                    Log::info("Daily limit reached during processing. Scheduling remaining recipients for tomorrow.");
                    $this->scheduleRemainingRecipients($recipient);
                    break;
                }

                // Trimitem email-ul folosind Mail facade
                $this->sendCampaignEmail($recipient);

                // Pentru recipients de tip Newsletter, marcăm ca trimis
                if (isset($recipient->id) && is_numeric($recipient->id)) {
                    $newsletterRecord = Newsletter::find($recipient->id);
                    if ($newsletterRecord && $newsletterRecord->isSubscriber()) {
                        $newsletterRecord->markAsSent();
                    }
                }

                $sentCount++;
                $processedCount++;
                Log::info("Campaign email sent successfully to {$recipient->recipient_email} ({$processedCount} processed)");

                // Pauză între mailuri pentru a nu suprasolicita SMTP-ul
                sleep(2);

                // Reconectare la DB din când în când pentru conexiuni lungi
                if ($processedCount % 50 === 0) {
                    DB::connection()->reconnect();
                }
            } catch (Exception $e) {
                $errorCount++;
                $failedCount++;

                // Pentru recipients de tip Newsletter, marcăm ca eșuat
                if (isset($recipient->id) && is_numeric($recipient->id)) {
                    $newsletterRecord = Newsletter::find($recipient->id);
                    if ($newsletterRecord && $newsletterRecord->isSubscriber()) {
                        $newsletterRecord->markAsFailed($e->getMessage());
                    }
                }

                Log::error("Error sending campaign email to {$recipient->recipient_email}: {$e->getMessage()}");

                // Dacă avem prea multe erori, oprim job-ul
                if ($errorCount >= $maxErrors) {
                    Log::error("Max error count ({$maxErrors}) reached. Stopping campaign.");
                    $this->campaign->markAsFailed();
                    $this->fail($e);
                    return;
                }
            }
        }

        // Dacă mai avem recipients de trimis, îi programăm pentru mâine
        if ($this->recipients->count() > $processedCount) {
            $remaining = $this->recipients->skip($processedCount);
            $this->scheduleRemainingRecipients($remaining->first(), $remaining);
        }

        // Actualizăm statisticile campaniei
        $this->campaign->updateCampaignStats($sentCount, $failedCount);

        // Dacă am terminat de trimis la toți, marcăm campania ca trimisă
        if ($this->recipients->count() <= $processedCount) {
            $this->campaign->markAsSent($sentCount, $failedCount);
        }

        Log::info("SendNewsletterCampaign job completed for '{$this->campaign->campaign_title}'. Sent: {$sentCount}, Failed: {$failedCount}");
    }

    /**
     * Trimite email-ul campaniei către un recipient
     */
    private function sendCampaignEmail($recipient): void
    {
        $subject = $this->campaign->campaign_subject;

        // Procesăm conținutul cu variabilele
        $content = $this->campaign->getProcessedContent([
            '{{email}}' => $recipient->recipient_email,
            '{{name}}' => $recipient->recipient_name,
        ]);

        // Înlocuim {{email}} în linkurile de dezabonare
        $content = str_replace('{{email}}', $recipient->recipient_email, $content);

        Mail::send([], [], function (Message $message) use ($recipient, $subject, $content) {
            $message->from('contact@clickmusic.ro', 'Click Music Ro')
                ->to($recipient->recipient_email, $recipient->recipient_name)
                ->subject($subject)
                ->html($content);
        });
    }

    /**
     * Programează job-ul pentru mâine dimineață
     */
    private function rescheduleForTomorrow()
    {
        $tomorrow = \Carbon\Carbon::tomorrow()->hour(9)->minute(0)->second(0);

        static::dispatch($this->campaign, $this->recipients)
            ->delay($tomorrow);

        Log::info("Campaign '{$this->campaign->campaign_title}' rescheduled for tomorrow at 09:00");
    }

    /**
     * Programează recipients rămași pentru mâine
     */
    private function scheduleRemainingRecipients($startRecipient, Collection $remaining = null)
    {
        if ($remaining === null) {
            // Găsim indexul recipient-ului curent și luăm restul
            $currentIndex = $this->recipients->search(function ($item) use ($startRecipient) {
                return $item->recipient_email === $startRecipient->recipient_email;
            });

            $remaining = $this->recipients->slice($currentIndex);
        }

        if ($remaining->count() > 0) {
            $tomorrow = \Carbon\Carbon::tomorrow()->hour(9)->minute(0)->second(0);

            static::dispatch($this->campaign, $remaining)
                ->delay($tomorrow);

            Log::info("Scheduled {$remaining->count()} remaining recipients for campaign '{$this->campaign->campaign_title}' for tomorrow at 09:00");
        }
    }

    /**
     * Gestionarea eșecului job-ului
     */
    public function failed(Exception $exception)
    {
        Log::error("SendNewsletterCampaign job failed for campaign '{$this->campaign->campaign_title}': " . $exception->getMessage());

        // Marcăm campania ca eșuată
        $this->campaign->markAsFailed();

        // Marcăm toți recipients rămași ca eșuați (doar cei de tip Newsletter)
        $this->recipients->each(function ($recipient) use ($exception) {
            if (isset($recipient->id) && is_numeric($recipient->id)) {
                $newsletterRecord = Newsletter::find($recipient->id);
                if ($newsletterRecord && $newsletterRecord->isSubscriber() && $newsletterRecord->status !== Newsletter::STATUS_SENT) {
                    $newsletterRecord->markAsFailed($exception->getMessage());
                }
            }
        });
    }
}
