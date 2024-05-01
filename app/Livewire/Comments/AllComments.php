<?php


namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Video; // Import the Video model
use App\Models\Comment; // Import the Comment model


class AllComments extends Component
{
    public $videoId;
    public $newComment;
    public $replyToComment = null; // Store reply target comment ID

    public function mount($videoId)
    {
        $this->videoId = $videoId;
        $this->newComment = ""; // Initialize empty comment content
    }

    public function render()
    {
        $video = Video::find($this->videoId); // Fetch the video data
        $comments = $video->comments; // Access comments relationship on the video object
        return view('livewire.comments.all-comments', compact('comments', 'video'));
    }

    public function getComments() // This method is no longer needed
    {
        // This functionality is now handled within the render method
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:3'
        ]);

        $comment = new Comment;
        $comment->body = $this->newComment;
        $comment->video_id = $this->videoId;
        $comment->user_id = auth()->id(); // Assuming user is authenticated

        if ($this->replyToComment) {
            $comment->parent_id = $this->replyToComment;
        }

        $comment->save();

        $this->newComment = ""; // Reset comment content after submission
        // $this->emit('commentAdded');
    }

    public function replyToComment($commentId)
    {
        $this->replyToComment = $commentId;
    }
}
