<?php

namespace App\Listeners;

use App\Events\CommentReplied;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class SendCommentReplyNotification
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(CommentReplied $event)
    {
        $reply = $event->reply;
        $video = $event->video;

        if ($reply->user_id != Auth::id()) {
            $recipient = $reply->parent->user;

            $this->notificationService->sendCommentReplyNotification(
                $recipient,
                $reply->user->name,
                $video->title,
                (string) $reply->body,
                route('videos.show', ['video' => $video->id])
            );
        }
    }
}
