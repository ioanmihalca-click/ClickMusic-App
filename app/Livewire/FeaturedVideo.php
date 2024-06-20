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
      $this->featuredVideo = Video::where('featured', true)->first();
  }

  public function render()
  {
    return view('livewire.featured-video');
  }
}
