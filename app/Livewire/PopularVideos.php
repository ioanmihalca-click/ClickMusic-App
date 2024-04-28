<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class PopularVideos extends Component
{
  public $popularVideos;

  public function mount()
  {
    // Define logic to fetch popular videos based on your criteria (e.g., views, likes)
    $this->popularVideos = Video::orderBy('views', 'desc')->take(3)->get(); // Replace with your logic
  }

  public function render()
  {
    return view('livewire.popular-videos');
  }
}
