<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Haina;
use Livewire\WithPagination;

class HainaList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $categorieFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategorieFilter()
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

    public function redirectToHaina($slug)
    {
        return redirect()->route('haina.show', $slug);
    }

    public function render()
    {
        $haine = Haina::activ()
            ->search($this->search)
            ->when($this->categorieFilter, function ($query, $categorie) {
                return $query->categorie($categorie);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.haina-list', ['haine' => $haine]);
    }
}
