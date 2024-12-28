<?php

namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ThreadShow extends Component
{
    use WithPagination;

    public ForumThread $thread;
    public $replyContent = '';

    protected $rules = [
        'replyContent' => 'required|min:3'
    ];

    public function mount(ForumThread $thread)
    {
        $this->thread = $thread;
        $this->thread->incrementViewCount();
    }

    public function saveReply()
    {
        $this->validate();

        $this->thread->replies()->create([
            'content' => $this->replyContent,
            'user_id' => Auth::id()
        ]);

        $this->replyContent = '';
        $this->dispatch('replyAdded');
    }

    public function render()
    {
        return view('livewire.forum.thread-show', [
            'replies' => $this->thread->replies()
                ->with('user')
                ->latest()
                ->paginate(15)
        ]);
    }
}