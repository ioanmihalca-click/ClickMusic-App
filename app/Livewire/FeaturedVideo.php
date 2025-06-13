<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class FeaturedVideo extends Component
{
  public $featuredVideo;

  protected $listeners = ['featuredVideoChanged' => '$refresh'];

  public function mount()
  {
    $this->loadFeaturedVideo();
  }

  public function loadFeaturedVideo()
  {
    // Don't use cache for the featured video to ensure it's always up to date
    $this->featuredVideo = Video::where('featured', true)
      ->select('id', 'title', 'description', 'embed_link', 'thumbnail_url', 'video_path', 'featured', 'created_at')
      ->first();
  }

  public function render()
  {
    return view('livewire.featured-video');
  }
}
