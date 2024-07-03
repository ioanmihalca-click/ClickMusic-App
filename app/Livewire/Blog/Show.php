<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Canvas\Models\Post;

class Show extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = Post::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog.show')
        ->layout('layouts.blog');
    }
}