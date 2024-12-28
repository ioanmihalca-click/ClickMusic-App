<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class RecentVideos extends Component
{
  public $recentVideos;

  public function mount()
  {
      $this->recentVideos = cache()->remember('recent_videos', 3600, function() {
          return Video::select('id', 'title', 'description', 'embed_link', 'thumbnail_url', 'created_at')
              ->latest()
              ->take(3)
              ->get();
      });
  }

  public function render()
  {
    return view('livewire.recent-videos');
  }
}
