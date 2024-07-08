<?php


namespace App\Events;

use App\Models\Comment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CommentCreated
{
    use Dispatchable, SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
