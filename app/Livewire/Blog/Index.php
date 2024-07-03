<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Canvas\Models\Post;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::published()
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('livewire.blog.index', compact('posts'))
        ->layout('layouts.blog');
    }
}