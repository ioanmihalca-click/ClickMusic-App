<?php

// app/Livewire/Forum/ForumIndex.php
namespace App\Livewire\Forum;

use App\Models\ForumCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ForumIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $newCategory = [
        'name' => '',
        'description' => '',
        'color' => '#3b82f6',
    ];

    protected $queryString = ['search' => ['except' => '']];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'newCategory.name' => 'required|min:3|max:255',
        'newCategory.description' => 'required|min:10',
        'newCategory.color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
    ];

    public function createCategory()
    {
        $this->validate();

        ForumCategory::create([
            'name' => $this->newCategory['name'],
            'description' => $this->newCategory['description'],
            'color' => $this->newCategory['color'],
        ]);

        $this->reset(['showCreateModal', 'newCategory']);
        $this->dispatch('category-created', message: 'Categoria a fost creată cu succes!');
    }

    public function toggleCreateModal()
    {
        $this->showCreateModal = !$this->showCreateModal;
        if ($this->showCreateModal === false) {
            // Reset form data when closing
            $this->reset('newCategory');
            $this->resetValidation();
        }
    }

    public function render()
    {
        return view('livewire.forum.forum-index', [
            'categories' => ForumCategory::withCount('threads')
                ->withCount('replies')
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%');
                    });
                })
                ->get()
        ]);
    }
}
