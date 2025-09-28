<?php

namespace App\Jobs;

use Exception;
use App\Models\User;
use App\Models\Newsletter;
use App\Models\DailyEmailTracker;
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

    protected int $campaignId;
    protected Collection $recipientsData;

    // Numărul maxim de reîncercări
    public $tries = 3;

    // Timeout pentru job (45 minute)
    public $timeout = 2700;

    public function __construct(int $campaignId, Collection $recipientsData)
    {
        $this->campaignId = $campaignId;
        $this->recipientsData = $recipientsData;
    }

    public function handle()
    {
        // Încărcăm campania din baza de date
        $campaign = Newsletter::find($this->campaignId);
        if (!$campaign) {
            Log::error("Campaign with ID {$this->campaignId} not found");
            return;
        }

        $errorCount = 0;
        $maxErrors = 5;
        $processedCount = 0;
        $sentCount = 0;
        $failedCount = 0;

        Log::info("Starting SendNewsletterCampaign job for campaign: {$campaign->campaign_title} with {$this->recipientsData->count()} recipients");

        // Verificăm câte mailuri mai putem trimite astăzi prin sistemul unificat
        $remainingQuota = DailyEmailTracker::getRemainingQuota();
        Log::info("Remaining email quota today: {$remainingQuota}");

        // Dacă nu mai avem quota, programăm job-ul pentru mâine
        if ($remainingQuota <= 0) {
            Log::info("Daily limit reached. Scheduling campaign for tomorrow.");
            $this->rescheduleForTomorrow($campaign);
            return;
        }

        // Limitează numărul de recipients la quota rămasă
        $recipientsToProcess = $this->recipientsData->take($remainingQuota);

        Log::info("Processing {$recipientsToProcess->count()} recipients (remaining quota: {$remainingQuota})");

        // Marcăm campania ca fiind în proces de trimitere
        $campaign->update(['status' => Newsletter::STATUS_PENDING]);

        foreach ($recipientsToProcess as $recipientData) {
            try {
                // Verificăm din nou quota pentru fiecare mail
                if (DailyEmailTracker::getRemainingQuota() <= 0) {
                    Log::info("Daily quota exhausted during processing. Scheduling remaining recipients for tomorrow.");
                    $this->scheduleRemainingRecipients($campaign, $recipientData);
                    break;
                }

                // Trimitem email-ul folosind Mail facade
                $this->sendCampaignEmail($campaign, $recipientData);

                // Pentru recipients de tip Newsletter, marcăm ca trimis
                if ($recipientData['type'] === 'newsletter' && $recipientData['newsletter_id']) {
                    $newsletterRecord = Newsletter::find($recipientData['newsletter_id']);
                    if ($newsletterRecord && $newsletterRecord->isSubscriber()) {
                        $newsletterRecord->markAsSent();
                    }
                }

                $sentCount++;
                $processedCount++;
                Log::info("Campaign email sent successfully to {$recipientData['email']} ({$processedCount} processed)");

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
                if ($recipientData['type'] === 'newsletter' && $recipientData['newsletter_id']) {
                    $newsletterRecord = Newsletter::find($recipientData['newsletter_id']);
                    if ($newsletterRecord && $newsletterRecord->isSubscriber()) {
                        $newsletterRecord->markAsFailed($e->getMessage());
                    }
                }

                Log::error("Error sending campaign email to {$recipientData['email']}: {$e->getMessage()}");

                // Dacă avem prea multe erori, oprim job-ul
                if ($errorCount >= $maxErrors) {
                    Log::error("Max error count ({$maxErrors}) reached. Stopping campaign.");
                    $campaign->markAsFailed();
                    $this->fail($e);
                    return;
                }
            }
        }

        // Dacă mai avem recipients de trimis, îi programăm pentru mâine
        if ($this->recipientsData->count() > $processedCount) {
            $remaining = $this->recipientsData->skip($processedCount);
            $this->scheduleRemainingRecipients($campaign, $remaining->first(), $remaining);
        }

        // Înregistrăm email-urile trimise în sistemul unificat de tracking
        if ($sentCount > 0) {
            DailyEmailTracker::recordSentEmails($sentCount, 'newsletter_campaign');
            Log::info("Recorded {$sentCount} newsletter emails in daily tracker");
        }

        // Actualizăm statisticile campaniei
        $campaign->updateCampaignStats($sentCount, $failedCount);

        // Dacă am terminat de trimis la toți, marcăm campania ca trimisă
        if ($this->recipientsData->count() <= $processedCount) {
            $campaign->markAsSent($sentCount, $failedCount);
        }

        Log::info("SendNewsletterCampaign job completed for '{$campaign->campaign_title}'. Sent: {$sentCount}, Failed: {$failedCount}");
    }

    /**
     * Trimite email-ul campaniei către un recipient
     */
    private function sendCampaignEmail(Newsletter $campaign, array $recipientData): void
    {
        $subject = $campaign->campaign_subject;

        // Procesăm conținutul cu variabilele
        $content = $campaign->getProcessedContent([
            '{{email}}' => $recipientData['email'],
            '{{name}}' => $recipientData['name'],
        ]);

        // Înlocuim {{email}} în linkurile de dezabonare
        $content = str_replace('{{email}}', $recipientData['email'], $content);

        Mail::send([], [], function (Message $message) use ($recipientData, $subject, $content) {
            $message->from('contact@clickmusic.ro', 'Click Music Ro')
                ->to($recipientData['email'], $recipientData['name'])
                ->subject($subject)
                ->html($content);
        });
    }

    /**
     * Programează job-ul pentru mâine dimineață
     */
    private function rescheduleForTomorrow(Newsletter $campaign)
    {
        $tomorrow = \Carbon\Carbon::tomorrow()->hour(8)->minute(0)->second(0);

        static::dispatch($this->campaignId, $this->recipientsData)
            ->delay($tomorrow);

        Log::info("Campaign '{$campaign->campaign_title}' rescheduled for tomorrow at 08:00");
    }

    /**
     * Programează recipients rămași pentru mâine
     */
    private function scheduleRemainingRecipients(Newsletter $campaign, array $startRecipient, Collection $remaining = null)
    {
        if ($remaining === null) {
            // Găsim indexul recipient-ului curent și luăm restul
            $currentIndex = $this->recipientsData->search(function ($item) use ($startRecipient) {
                return $item['email'] === $startRecipient['email'];
            });

            $remaining = $this->recipientsData->slice($currentIndex);
        }

        if ($remaining->count() > 0) {
            $tomorrow = \Carbon\Carbon::tomorrow()->hour(8)->minute(0)->second(0);

            static::dispatch($this->campaignId, $remaining)
                ->delay($tomorrow);

            Log::info("Scheduled {$remaining->count()} remaining recipients for campaign '{$campaign->campaign_title}' for tomorrow at 08:00");
        }
    }

    /**
     * Gestionarea eșecului job-ului
     */
    public function failed(Exception $exception)
    {
        $campaign = Newsletter::find($this->campaignId);
        if ($campaign) {
            Log::error("SendNewsletterCampaign job failed for campaign '{$campaign->campaign_title}': " . $exception->getMessage());

            // Marcăm campania ca eșuată
            $campaign->markAsFailed();

            // Marcăm toți recipients rămași ca eșuați (doar cei de tip Newsletter)
            $this->recipientsData->each(function ($recipientData) use ($exception) {
                if ($recipientData['type'] === 'newsletter' && $recipientData['newsletter_id']) {
                    $newsletterRecord = Newsletter::find($recipientData['newsletter_id']);
                    if ($newsletterRecord && $newsletterRecord->isSubscriber() && $newsletterRecord->status !== Newsletter::STATUS_SENT) {
                        $newsletterRecord->markAsFailed($exception->getMessage());
                    }
                }
            });
        }
    }
}
