<?php


namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\ForumThread;
use Livewire\WithPagination;
use App\Models\ForumCategory;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class CategoryShow extends Component
{
    use WithPagination;

    public ForumCategory $category;
    public $search = '';
    protected $queryString = ['search' => ['except' => '']];

    // Resetează paginarea când se modifică căutarea
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount(ForumCategory $category)
    {
        $this->category = $category;
    }

    public function pinThread($threadId)
    {
        // Verifică dacă utilizatorul este admin
        if (Auth::user()->usertype !== 'admin') {
            return;
        }

        $thread = ForumThread::findOrFail($threadId);
        $thread->is_pinned = !$thread->is_pinned;
        $thread->save();

        $this->dispatch(
            'thread-updated',
            message: $thread->is_pinned ? 'Discuția a fost fixată' : 'Discuția nu mai este fixată'
        );
    }

    public function lockThread($threadId)
    {
        // Verifică dacă utilizatorul este admin
        if (Auth::user()->usertype !== 'admin') {
            return;
        }

        $thread = ForumThread::findOrFail($threadId);
        $thread->is_locked = !$thread->is_locked;
        $thread->save();

        $this->dispatch(
            'thread-updated',
            message: $thread->is_locked ? 'Discuția a fost închisă' : 'Discuția a fost redeschisă'
        );
    }

    public function render()
    {
        $threads = $this->category->threads()
            ->with(['user', 'latestReply.user'])
            ->withCount('replies')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderByDesc('is_pinned') // Afișează întâi discuțiile fixate
            ->latest()
            ->paginate(10);

        return view('livewire.forum.category-show', [
            'threads' => $threads
        ]);
    }
}
