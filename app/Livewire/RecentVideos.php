<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class RecentVideos extends Component
{
  public $recentVideos;

  public function mount()
  {
    $this->recentVideos = Video::latest()->take(3)->get(); 
  }

  public function render()
  {
    return view('livewire.recent-videos');
  }
}
