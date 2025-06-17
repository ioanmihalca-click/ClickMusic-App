<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Video;
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
    protected $maxEmailsPerBatch = 50; // Limită pentru a respecta restricțiile de hosting

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
            // Dacă nu avem userIds specifici, luăm toți utilizatorii abonați la newsletter
            if ($this->userIds->isEmpty()) {
                $this->userIds = User::newsletterSubscribed()
                    ->pluck('id')
                    ->take($this->maxEmailsPerBatch);
            }

            $notification = new NewVideoNotification($this->video);
            $sentCount = 0;
            $failedCount = 0;

            Log::info("Starting video notifications for video: {$this->video->title} to {$this->userIds->count()} users");

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

            // Dacă mai sunt utilizatori de notificat, programează următorul batch
            $remainingUsers = User::newsletterSubscribed()
                ->whereNotIn('id', $this->userIds)
                ->pluck('id')
                ->take($this->maxEmailsPerBatch);

            if ($remainingUsers->isNotEmpty()) {
                static::dispatch($this->video, $remainingUsers)
                    ->delay(now()->addMinutes(2)); // Întârziere de 2 minute între batch-uri
            }

            Log::info("Video notifications batch completed. Sent: {$sentCount}, Failed: {$failedCount}");
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
