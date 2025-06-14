<?php

namespace App\Listeners;

use App\Events\ForumReplyCreated;
use App\Jobs\SendForumNotifications;

class SendForumReplyNotification
{
    /**
     * Handle the event.
     */
    public function handle(ForumReplyCreated $event): void
    {
        // Programăm job-ul care va trimite notificări prin email tuturor participanților
        SendForumNotifications::dispatch(
            $event->reply,
            $event->thread,
            $event->reply->user_id // Excludem utilizatorul care a răspuns
        );
    }
}
