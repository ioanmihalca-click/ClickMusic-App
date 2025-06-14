<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\ForumReplyNotification;

class SendForumNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reply;
    protected $thread;
    protected $excludeUserId;
    protected $maxEmailsPerBatch = 50; // Limită de siguranță pentru a respecta restricțiile de hosting

    /**
     * Create a new job instance.
     */
    public function __construct(ForumReply $reply, ForumThread $thread, ?int $excludeUserId = null)
    {
        $this->reply = $reply;
        $this->thread = $thread;
        $this->excludeUserId = $excludeUserId; // Exclude autorul răspunsului
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            // Colectează toți participanții unici din thread
            $participants = collect();

            // Adaugă autorul thread-ului
            if ($this->thread->user_id != $this->excludeUserId) {
                $participants->push($this->thread->user_id);
            }

            // Adaugă utilizatorii care au răspuns în thread
            $this->thread->replies()
                ->select('user_id')
                ->distinct()
                ->where('user_id', '!=', $this->excludeUserId)
                ->get()
                ->each(function ($reply) use ($participants) {
                    $participants->push($reply->user_id);
                });

            // Elimină duplicatele și limitează numărul de notificări
            $uniqueParticipants = $participants->unique()->take($this->maxEmailsPerBatch);

            // Trimite notificări
            $notification = new ForumReplyNotification($this->reply, $this->thread);
            foreach ($uniqueParticipants as $userId) {
                $user = User::find($userId);
                if ($user && $user->forum_notifications) {
                    $user->notify($notification);
                }
                // Adăugăm o mică întârziere între trimiteri pentru a evita limitările de server
                usleep(200000); // 0.2 secunde
            }

            Log::info("Forum notifications sent for thread {$this->thread->id}, reply {$this->reply->id} to {$uniqueParticipants->count()} participants");
        } catch (\Exception $e) {
            Log::error("Error sending forum notifications: " . $e->getMessage());
        }
    }
}
