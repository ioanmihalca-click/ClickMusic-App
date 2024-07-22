<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CommentReplied 
{
    use Dispatchable, SerializesModels;
    public $reply; 
    public $video;

    public function __construct(Comment $reply)
    {
        $this->reply = $reply;
        $this->video = $reply->video;
    }
}