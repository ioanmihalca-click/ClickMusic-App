<?php


namespace App\Listeners;

use App\Events\CommentCreated;
use App\Services\NotificationService;
use App\Models\User;

class NotifyAdminOfNewComment
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(CommentCreated $event)
    {
        $admins = User::where('usertype', 'admin')->get();
        $comment = $event->comment;
        $video = $comment->video;

        foreach ($admins as $admin) {
            $this->notificationService->sendNewCommentNotification(
                $admin,
                $comment->user->name,
                $video->title,
                (string) $comment->body,
                route('videos.show', ['video' => $video->id])
            );
        }
    }
}
