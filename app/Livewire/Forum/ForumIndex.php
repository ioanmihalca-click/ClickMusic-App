<?php

namespace App\Livewire\Forum;

use App\Models\ForumCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ForumIndex extends Component
{
    use WithPagination;

    public $search = '';
    
    public function render()
    {
        return view('livewire.forum.forum-index', [
            'categories' => ForumCategory::withCount('threads')
                ->withCount('replies')
                ->get()
        ]);
    }
}