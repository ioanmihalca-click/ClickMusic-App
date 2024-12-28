<?php

// app/Livewire/Forum/ThreadCreate.php
namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\ForumThread;
use App\Models\ForumCategory;
use Illuminate\Support\Facades\Auth;

class ThreadCreate extends Component
{
    public $title;
    public $content;
    public $category_id;

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'content' => 'required|min:20',
        'category_id' => 'required|exists:forum_categories,id'
    ];

    public function save()
    {
        $this->validate();

        $thread = ForumThread::create([
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('forum.threads.show', $thread)
            ->with('message', 'Discuția a fost creată cu succes!');
    }

    public function render()
    {
        return view('livewire.forum.thread-create', [
            'categories' => ForumCategory::all()
        ])->layout('layouts.app');
    }
}