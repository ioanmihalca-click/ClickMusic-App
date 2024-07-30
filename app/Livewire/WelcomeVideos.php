<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class WelcomeVideos extends Component
{
    public $videos;

    public function mount()
    {
        // Fetch all videos from the database
        $this->videos = Video::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.welcome-videos');
    }
}
