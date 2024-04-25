<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Video; // Import the Video model

class VideoDashboard extends Component
{
    public $videos = []; // Property to store retrieved video data

    public function mount()
    {
        // Assuming you have a method to get the currently logged-in user
        $user = auth()->user();

        // Filter videos based on user (optional)
        // You can implement logic here to filter videos based on user permissions
        // or ownership, if applicable. 
        // For now, let's just retrieve all videos

        $this->videos = Video::all(); // Retrieve all videos (modify for filtering)
    }

    public function render()
    {
        return view('livewire.video-dashboard');
    }
}