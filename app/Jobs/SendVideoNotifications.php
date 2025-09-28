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
    protected $isInitialDispatch;
    protected $maxEmailsPerBatch = 30; // Reducă batch-ul pentru a respecta limita zilnică de 100

    public $tries = 3;
    public $timeout = 1800; // 30 minute

    public function __construct(Video $video, ?Collection $userIds = null, bool $isInitialDispatch = null)
    {
        $this->video = $video;
        $this->userIds = $userIds ?? collect();
        $this->isInitialDispatch = $isInitialDispatch ?? $userIds === null;
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
                // Luăm TOȚI utilizatorii, dar limitați la quota zilnică
                $this->userIds = User::newsletterSubscribed()
                    ->pluck('id')
                    ->take($remainingQuota);
            } else {
                // Pentru job-urile re-dispatched, limitează la quota rămasă
                $this->userIds = $this->userIds->take($remainingQuota);
            }

            $notification = new NewVideoNotification($this->video);
            $sentCount = 0;
            $failedCount = 0;

            $dispatchType = $this->isInitialDispatch ? 'INITIAL' : 'CONTINUATION';
            Log::info("Starting video notifications [{$dispatchType}] for video: {$this->video->title} to {$this->userIds->count()} users (Remaining quota: {$remainingQuota})");

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

            // Programează utilizatorii rămași DOAR dacă este dispatch-ul inițial
            // și nu toți utilizatorii au fost procesați din cauza limitei zilnice
            if ($this->isInitialDispatch) {
                $allUsers = User::newsletterSubscribed()->pluck('id');
                $totalUsers = $allUsers->count();

                // Dacă am mai mulți utilizatori decât cât am putut procesa astăzi
                if ($totalUsers > $sentCount) {
                    $processedUserIds = $this->userIds->take($sentCount);
                    $remainingUsers = $allUsers->diff($processedUserIds);

                    if ($remainingUsers->isNotEmpty()) {
                        Log::info("Scheduling remaining {$remainingUsers->count()} video notifications for tomorrow at 08:00.");
                        static::dispatch($this->video, $remainingUsers, false) // false = not initial dispatch
                            ->delay(now()->addDay()->setTime(8, 0));
                    }
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
