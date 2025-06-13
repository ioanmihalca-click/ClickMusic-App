<?php

namespace App\Livewire\Comments;

use App\Models\Reply;
use Livewire\Component;
use App\Events\CommentCreated;
use Illuminate\Support\Facades\Auth;
use App\Megaphone\CommentReplyNotification;
use App\Models\Video; // Import the Video model
use App\Models\Comment; // Import the Comment model

class AllComments extends Component
{
    public $videoId;
    public $newComment;
    public $replyToComment = [];

    public function mount($videoId)
    {
        $this->videoId = $videoId;
        $this->newComment = ""; // Initialize empty comment content
    }

    public function render()
    {
        $video = Video::find($this->videoId);

        // Fetch comments with eager loading of replies, sorted by the latest reply
        $comments = $video->comments()
            ->whereNull('reply_id')
            ->latest()
            ->with(['replies' => function ($query) {
                $query->latest();
            }])
            ->get()
            ->sortByDesc(function ($comment) {
                return $comment->replies->max('created_at') ?: $comment->created_at;
            });
        return view('livewire.comments.all-comments', compact('comments', 'video'));
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:1'
        ]);

        $comment = new Comment;
        $comment->body = $this->newComment;
        $comment->video_id = $this->videoId;
        $comment->user_id = Auth::id(); // Using Auth facade
        $comment->save();

        event(new CommentCreated($comment)); // Dispatch the event

        $this->newComment = ""; // Reset comment content after submission
    }

    public function addReplyToComment($commentId)
    {
        $this->validate([
            "replyToComment.{$commentId}" => 'required|min:1'
        ]);

        $comment = Comment::findOrFail($commentId); // Find the parent comment
        $reply = new Comment; // Create a new comment
        $reply->body = $this->replyToComment[$commentId];
        $reply->video_id = $comment->video_id; // Assign the same video ID
        $reply->user_id = Auth::id(); // Using Auth facade
        $reply->reply_id = $comment->id; // Set the reply's reply_id to the parent comment's ID
        $reply->save();

        // Reset reply content after submission
        $this->replyToComment[$commentId] = "";

        // Trigger the Megaphone notification, passing only title and body:
        $comment->user->notify(new CommentReplyNotification($reply, $comment->video));
    }
}
