<?php


namespace App\Listeners;

use App\Models\User;
use App\Events\CommentCreated;
use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAdminOfNewComment
{
    public function handle(CommentCreated $event)
    {
        $admins = User::where('usertype', 'admin')->get();
        Notification::send($admins, new NewCommentNotification($event->comment));
    }
}
