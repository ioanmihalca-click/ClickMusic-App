<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Facades\Log;

class SearchVideos extends Component
{
    public $searchTerm = '';
    public $searchResults = null;
    public $lastSearchedTerm = '';

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function search()
    {
        $this->lastSearchedTerm = trim($this->searchTerm);
        
        if (strlen($this->lastSearchedTerm) >= 2) {
            $this->searchResults = Video::where(function($query) {
                $query->where('title', 'like', "%{$this->lastSearchedTerm}%")
                      ->orWhere('description', 'like', "%{$this->lastSearchedTerm}%");
            })->get();

            // Logging pentru depanare
            Log::info("Căutare efectuată", [
                'termen' => $this->lastSearchedTerm,
                'rezultate' => $this->searchResults->count()
            ]);
        } else {
            $this->searchResults = collect();
            Log::info("Termen de căutare prea scurt", ['termen' => $this->lastSearchedTerm]);
        }

        $this->dispatch('searchPerformed', $this->lastSearchedTerm);
        $this->searchTerm = ''; // Resetăm câmpul de căutare
    }

    public function render()
    {
        return view('livewire.search-videos');
    }
}