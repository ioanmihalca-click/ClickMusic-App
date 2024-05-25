<?php
namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Video; // Import the Video model
use App\Models\Comment; // Import the Comment model
use App\Models\Reply;

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
        $video = Video::find($this->videoId); // Fetch the video data
        $comments = $video->comments()->latest()->get(); // Fetch comments ordered by creation time, newest first
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
        $comment->user_id = auth()->id(); // Assuming user is authenticated
        $comment->save();

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
        $reply->user_id = auth()->id(); // Assuming user is authenticated
        $reply->reply_id = $comment->id; // Set the reply's reply_id to the parent comment's ID
        $reply->save();
    
        // Reset reply content after submission
        $this->replyToComment[$commentId] = "";
    }
    

}
