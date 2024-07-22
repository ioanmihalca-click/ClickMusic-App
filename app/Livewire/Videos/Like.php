<?php

namespace App\Livewire\Videos;

use App\Models\Video;
use Livewire\Component;

class Like extends Component
{
    public Video $video;
    public $likeCount;
    public $isLiked;

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->refreshLikeStatus();
    }

    public function render()
    {
        return view('livewire.videos.like');
    }

    public function toggleLike()
    {
        if (!auth()->check()) {
            $this->dispatch('showLoginPrompt');
            return;
        }

        if ($this->isLiked) {
            $this->video->likes()->where('user_id', auth()->id())->delete();
        } else {
            $this->video->likes()->create([
                'user_id' => auth()->id()
            ]);
        }

        $this->refreshLikeStatus();
        $this->dispatch('likeUpdated', $this->video->id);
    }

    private function refreshLikeStatus()
    {
        $this->likeCount = $this->video->likes()->count();
        $this->isLiked = $this->video->likes()->where('user_id', auth()->id())->exists();
    }
}