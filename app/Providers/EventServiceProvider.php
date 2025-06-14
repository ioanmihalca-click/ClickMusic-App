<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ForumReplyCreated;
use App\Listeners\SendForumReplyNotification;
use App\Events\CommentCreated;
use App\Events\CommentReplied;
use App\Listeners\NotifyAdminOfNewComment;
use App\Listeners\SendCommentReplyNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ForumReplyCreated::class => [
            SendForumReplyNotification::class,
        ],
        CommentCreated::class => [
            NotifyAdminOfNewComment::class,
        ],
        CommentReplied::class => [
            SendCommentReplyNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
