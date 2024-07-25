<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;
use Livewire\WithPagination;

class AlbumList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function render()
    {
        $albums = Album::search($this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        return view('livewire.album-list', ['albums' => $albums]);
    }
}