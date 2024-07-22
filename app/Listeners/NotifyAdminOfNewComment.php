<?php


namespace App\Listeners;

use App\Events\CommentCreated;
use App\Megaphone\NewCommentNotification; // Correct import
use App\Models\User;

class NotifyAdminOfNewComment
{
    public function handle(CommentCreated $event)
    {
        $admins = User::where('usertype', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommentNotification($event->comment));
        }
    }
}