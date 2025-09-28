<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Video;
use App\Models\DailyEmailTracker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewVideoNotification;
use Illuminate\Support\Collection;

class SendVideoNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $video;
    protected $userIds;
    protected $maxEmailsPerBatch = 30; // Reducă batch-ul pentru a respecta limita zilnică de 100

    public $tries = 3;
    public $timeout = 1800; // 30 minute

    public function __construct(Video $video, ?Collection $userIds = null)
    {
        $this->video = $video;
        $this->userIds = $userIds ?? collect();
    }

    public function handle()
    {
        try {
            // Verifică câte email-uri mai putem trimite astăzi
            $remainingQuota = DailyEmailTracker::getRemainingQuota();

            if ($remainingQuota <= 0) {
                Log::info("Daily email limit reached. Scheduling for tomorrow.");
                // Reprogramează pentru mâine la 08:00
                static::dispatch($this->video, $this->userIds)
                    ->delay(now()->addDay()->setTime(8, 0));
                return;
            }

            // Dacă nu avem userIds specifici, luăm toți utilizatorii abonați la newsletter
            if ($this->userIds->isEmpty()) {
                $maxToTake = min($this->maxEmailsPerBatch, $remainingQuota);
                $this->userIds = User::newsletterSubscribed()
                    ->pluck('id')
                    ->take($maxToTake);
            } else {
                // Limitează la quota rămasă
                $this->userIds = $this->userIds->take($remainingQuota);
            }

            $notification = new NewVideoNotification($this->video);
            $sentCount = 0;
            $failedCount = 0;

            Log::info("Starting video notifications for video: {$this->video->title} to {$this->userIds->count()} users (Remaining quota: {$remainingQuota})");

            foreach ($this->userIds as $userId) {
                try {
                    $user = User::find($userId);
                    if ($user) {
                        $user->notify($notification);
                        $sentCount++;
                        Log::info("Video notification sent to user {$user->email}");

                        // Pauză între mailuri pentru a nu suprasolicita SMTP-ul
                        usleep(500000); // 0.5 secunde
                    }
                } catch (\Exception $e) {
                    $failedCount++;
                    Log::error("Failed to send video notification to user {$userId}: " . $e->getMessage());
                }
            }

            // Înregistrează email-urile trimise cu succes
            if ($sentCount > 0) {
                DailyEmailTracker::recordSentEmails($sentCount, 'video_notification');
            }

            // Verifică dacă mai sunt utilizatori de notificat
            $remainingUsers = User::newsletterSubscribed()
                ->whereNotIn('id', $this->userIds)
                ->pluck('id');

            if ($remainingUsers->isNotEmpty()) {
                $newRemainingQuota = DailyEmailTracker::getRemainingQuota();

                if ($newRemainingQuota > 0) {
                    // Mai avem quota pentru astăzi, programează următorul batch în 5 minute
                    $nextBatch = $remainingUsers->take(min($this->maxEmailsPerBatch, $newRemainingQuota));
                    static::dispatch($this->video, $nextBatch)
                        ->delay(now()->addMinutes(5));
                } else {
                    // Quota epuizată pentru astăzi, programează pentru mâine
                    Log::info("Daily quota exhausted. Scheduling remaining {$remainingUsers->count()} notifications for tomorrow.");
                    static::dispatch($this->video, $remainingUsers)
                        ->delay(now()->addDay()->setTime(8, 0));
                }
            }

            Log::info("Video notifications batch completed. Sent: {$sentCount}, Failed: {$failedCount}, Remaining quota: " . DailyEmailTracker::getRemainingQuota());
        } catch (\Exception $e) {
            Log::error("Error in SendVideoNotifications job: " . $e->getMessage());
            throw $e;
        }
    }

    public function failed(\Exception $exception)
    {
        Log::error("SendVideoNotifications job failed for video {$this->video->title}: " . $exception->getMessage());
    }
}
