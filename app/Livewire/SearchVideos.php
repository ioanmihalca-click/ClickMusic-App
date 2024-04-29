<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video; 

class SearchVideos extends Component
{
    public $searchTerm;
    public $searchResults;

    public function render()
    {
        // Perform search based on $searchTerm when it changes
        $this->searchResults = $this->searchTerm ? Video::where('title', 'like', "%{$this->searchTerm}%")->get() : collect([]);

        return view('livewire.search-videos');
    }

    // Define the search method to perform the search
    public function search()
    {
        // Perform the search based on $searchTerm
        $this->searchResults = $this->searchTerm ? Video::where('title', 'like', "%{$this->searchTerm}%")->get() : collect([]);
    }

//   public function clearSearch()
// {
//     $this->searchTerm = '';
//     $this->searchResults = collect([]);
// } 

}
