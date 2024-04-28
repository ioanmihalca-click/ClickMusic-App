<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class FeaturedVideo extends Component
{
  public $featuredVideo;

  public function mount()
  {
    // Define logic to fetch the featured video (e.g., by ID, flag)
    $this->featuredVideo = Video::find(1); // Replace with your logic
  }

  public function render()
  {
    return view('livewire.featured-video');
  }
}
