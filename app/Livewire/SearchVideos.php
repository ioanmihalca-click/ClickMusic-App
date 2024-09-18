<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class SearchVideos extends Component
{
    public $searchTerm = '';
    public $searchResults = null;
    public $suggestions = [];
    public $lastSearchedTerm = '';

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function updatedSearchTerm()
    {
        $this->getSuggestions();
    }

    public function getSuggestions()
    {
        if (strlen($this->searchTerm) >= 2) {
            $this->suggestions = Video::where('title', 'like', "%{$this->searchTerm}%")
                ->select('title')
                ->distinct()
                ->take(5)
                ->pluck('title')
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function selectSuggestion($suggestion)
    {
        $this->searchTerm = $suggestion;
        $this->search();
    }

    public function search()
    {
        $this->suggestions = [];
        $this->lastSearchedTerm = $this->searchTerm; // Salvăm termenul de căutare
        
        if (strlen($this->searchTerm) >= 2) {
            $this->searchResults = Video::where('title', 'like', "%{$this->searchTerm}%")
                ->orWhere('description', 'like', "%{$this->searchTerm}%")
                ->get();
        } else {
            $this->searchResults = collect();
        }

        $this->dispatch('searchPerformed', $this->lastSearchedTerm);
        $this->searchTerm = ''; // Resetăm câmpul de căutare
    }

    public function render()
    {
        return view('livewire.search-videos');
    }
}