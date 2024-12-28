<?php

// app/Livewire/Forum/CategoryShow.php
namespace App\Livewire\Forum;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ForumCategory;

class CategoryShow extends Component
{
    use WithPagination;

    public ForumCategory $category;
    public $search = '';

    public function mount(ForumCategory $category)
    {
        $this->category = $category;
    }

    // În CategoryShow.php
    public function render()
    {
        $threads = $this->category->threads()
            ->with(['user', 'latestReply.user'])
            ->withCount('replies') // Aceasta va adăuga replies_count
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.forum.category-show', [
            'threads' => $threads
        ])->layout('layouts.app');
    }
}
