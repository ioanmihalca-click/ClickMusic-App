<?php
namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Video; // Import the Video model
use App\Models\Comment; // Import the Comment model

class AllComments extends Component
{
    public $videoId;
    public $newComment;

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
            'newComment' => 'required|min:3'
        ]);

        $comment = new Comment;
        $comment->body = $this->newComment;
        $comment->video_id = $this->videoId;
        $comment->user_id = auth()->id(); // Assuming user is authenticated
        $comment->save();

        $this->newComment = ""; // Reset comment content after submission
    }
}
