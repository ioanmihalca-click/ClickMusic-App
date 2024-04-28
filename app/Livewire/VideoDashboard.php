<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class VideoDashboard extends Component
{
    public $videos;

    public function mount()
    {
        // Fetch all videos from the database
        $this->videos = Video::all();
    }

    public function render()
    {
        return view('livewire.video-dashboard');
    }
}
