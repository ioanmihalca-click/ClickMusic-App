<?php
namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Post;

class Show extends Component
{
    public Post $post; // Use type hinting for clarity

    public function mount($slug)
    {
        $this->post = Post::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog.show') // No need for the extra array
            ->layout('layouts.articol-blog', ['post' => $this->post]); // Pass $post to the layout
    }
}
