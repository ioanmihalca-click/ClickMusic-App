<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;

class SearchVideos extends Component
{
    public $searchTerm = '';
    public $searchResults;
    public $suggestions = [];

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
        if (strlen($this->searchTerm) >= 2) {
            $this->searchResults = Video::where('title', 'like', "%{$this->searchTerm}%")
                ->orWhere('description', 'like', "%{$this->searchTerm}%")
                ->take(12)
                ->get();
            
            // Stocăm termenul de căutare înainte de a-l reseta
            $searchedTerm = $this->searchTerm;
            
            // Resetăm câmpul de căutare
            $this->searchTerm = '';
            
            // Emitem un eveniment cu termenul căutat
            $this->dispatch('searchPerformed', $searchedTerm);
        } else {
            $this->searchResults = collect();
        }
        $this->suggestions = [];
    }

    public function render()
    {
        return view('livewire.search-videos');
    }
}