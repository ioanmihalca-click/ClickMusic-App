<?php

namespace App\Livewire\Videos;

use App\Models\Video;
use Livewire\Component;

class Like extends Component
{
    public $video;
    public $likes;
    public $likeActive;
    public function mount(Video $video)
    {
        $this->video = $video;
    }
    public function render()
    {
        $this->likes = $this->video->likes->count();
        return view('livewire.videos.like');
    }

    public function like()
    {
      // Check if user already liked the video
      if ($this->video->doesUserLikedVideos()) {
        // User already liked, do nothing (optional: display a message)
        return;
      }
    
      // User hasn't liked yet, create a new like record
      $this->video->likes()->create([
        'user_id' => auth()->id()
      ]);
    
      // Update the like count (optional: can be handled through Livewire magic properties)
      $this->likes = $this->video->likes->count();
    
      // Update like button state (optional: emit Livewire event for UI update)
      $this->likeActive = true;
    }
    
}
