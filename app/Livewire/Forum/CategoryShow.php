<?php


namespace App\Livewire\Forum;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ForumCategory;

class CategoryShow extends Component
{
    use WithPagination;

    public ForumCategory $category;
    public $search = '';

    // Resetează paginarea când se modifică căutarea
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount(ForumCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $threads = $this->category->threads()
            ->with(['user', 'latestReply.user'])
            ->withCount('replies')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.forum.category-show', [
            'threads' => $threads
        ])->layout('layouts.app');
    }
}