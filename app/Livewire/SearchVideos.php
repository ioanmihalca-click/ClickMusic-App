<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Log;

class SearchVideos extends Component
{
    #[Url()]
    public $search = '';
    
    public $searchResults = null;

    public function updatedSearch($value)
    {
        if (strlen($value) >= 2) {
            $this->searchResults = Video::where(function($query) {
                $query->where('title', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
            })->get();

            Log::info("Live search performed", [
                'term' => $value,
                'results' => $this->searchResults->count()
            ]);
        } else {
            $this->searchResults = collect();
        }
    }

    public function render()
    {
        return view('livewire.search-videos');
    }
}