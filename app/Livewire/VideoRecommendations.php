<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class VideoRecommendations extends Component
{
    public $video; // Receive the $video object from the parent component

    public function mount($video) // Receive the $video in the mount method
    {
        $this->video = $video; 
    }

    public function render()
    {
        // Exclude the current video from recommendations
        $recommendedVideos = Video::where('id', '!=', $this->video->id)
                                 ->inRandomOrder()
                                 ->limit(3)
                                 ->get();

        return view('livewire.video-recommendations', [
            'videos' => $recommendedVideos,
        ]);
    }
}