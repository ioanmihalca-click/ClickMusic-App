<?php

namespace App\Listeners;

use App\Events\CommentReplied;
use Illuminate\Support\Facades\Log;
use App\Megaphone\CommentReplyNotification;
class SendCommentReplyNotification 
{
    public function handle(CommentReplied $event)
    {
        if ($event->reply->user_id != auth()->user()->id) {
            $recipient = $event->reply->parent->user;
            $recipient->notify(new CommentReplyNotification($event->reply, $event->video));
        }
    }
}