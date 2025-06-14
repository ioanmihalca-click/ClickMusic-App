<?php

namespace App\Events;

use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class ForumReplyCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;
    public $thread;

    /**
     * Create a new event instance.
     */
    public function __construct(ForumReply $reply, ForumThread $thread)
    {
        $this->reply = $reply;
        $this->thread = $thread;
    }
}
