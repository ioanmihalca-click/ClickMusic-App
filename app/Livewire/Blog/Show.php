<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Post;

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
        return view('livewire.blog.show', [
            'post' => $this->post, 
            'meta_description' => $this->post->meta['description'] ?? null, // Pass meta_description
        ])->layout('layouts.blog');
    }
}