<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class RecentVideos extends Component
{
  public $recentVideos;

  public function mount()
  {
    // Use a shorter cache time or disable cache temporarily to see new uploads
    $this->recentVideos = cache()->remember('recent_videos', 5, function () {
      return Video::select('id', 'title', 'description', 'embed_link', 'thumbnail_url', 'video_path', 'created_at')
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
