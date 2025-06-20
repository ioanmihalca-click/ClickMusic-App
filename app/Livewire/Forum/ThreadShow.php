<?php

namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\ForumReply;
use App\Models\ForumThread;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class ThreadShow extends Component
{
    use WithPagination;

    public ForumThread $thread;
    public $replyContent = '';
    public $replyToMark = null;
    public $sortOrder = 'asc'; // asc = cele mai vechi prima dată, desc = cele mai noi prima dată

    protected $queryString = ['sortOrder' => ['except' => 'asc']];

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

        $reply = $this->thread->replies()->create([
            'content' => $this->replyContent,
            'user_id' => Auth::id()
        ]);

        $this->replyContent = '';
        $this->dispatch('replyAdded');

        // Scrollează automat la noul răspuns
        $this->dispatch('scrollToReply', id: $reply->id);

        // Declanșează evenimentul pentru notificări
        event(new \App\Events\ForumReplyCreated($reply, $this->thread));
    }

    public function markAsSolution($replyId)
    {
        // Verifică dacă utilizatorul curent este autorul thread-ului
        if (Auth::id() !== $this->thread->user_id) {
            return;
        }

        // Resetează toate soluțiile anterioare
        ForumReply::where('thread_id', $this->thread->id)
            ->where('is_solution', true)
            ->update(['is_solution' => false]);

        // Marchează răspunsul selectat ca soluție
        ForumReply::where('id', $replyId)->update(['is_solution' => true]);

        $this->dispatch('solutionMarked');
    }

    public function unmarkSolution($replyId)
    {
        // Verifică dacă utilizatorul curent este autorul thread-ului
        if (Auth::id() !== $this->thread->user_id) {
            return;
        }

        // Demarcă soluția
        ForumReply::where('id', $replyId)->update(['is_solution' => false]);

        $this->dispatch('solutionUnmarked');
    }

    public function updatedSortOrder()
    {
        $this->resetPage();
    }

    public function toggleSortOrder()
    {
        $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        return view('livewire.forum.thread-show', [
            'replies' => $this->thread->replies()
                ->with('user')
                ->orderBy('created_at', $this->sortOrder)
                ->paginate(15)
        ]);
    }
}
