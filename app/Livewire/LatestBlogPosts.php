<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class LatestBlogPosts extends Component
{
    public function render()
    {
        $latestPosts = Post::where('published_at', '<=', now())
                           ->latest('published_at')
                           ->take(3)
                           ->get();
        return view('livewire.latest-blog-posts', ['posts' => $latestPosts]);
    }
}