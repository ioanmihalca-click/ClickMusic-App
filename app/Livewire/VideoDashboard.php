<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class VideoDashboard extends Component
{
    public $videos;

    public function mount()
    {
        $this->videos = cache()->remember('all_videos', 3600, function() {
            return Video::select('id', 'title', 'description', 'embed_link', 'thumbnail_url', 'created_at')
                ->latest()
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.video-dashboard');
    }
}
