<?php

// app/Livewire/Forum/ThreadCreate.php
namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\ForumThread;
use App\Models\ForumCategory;
use Illuminate\Support\Facades\Auth;

class ThreadCreate extends Component
{
    public $title = '';
    public $content = '';
    public $category_id = '';

    // Populează categoria_id dacă este specificată în query string
    public function mount($category = null)
    {
        if ($category) {
            $this->category_id = $category;
        }
    }

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'content' => 'required|min:20',
        'category_id' => 'required|exists:forum_categories,id'
    ];

    public function updatedTitle($value)
    {
        // Validare în timp real pentru titlu
        $this->validateOnly('title');
    }

    public function updatedContent($value)
    {
        // Validare în timp real pentru conținut
        if (strlen($value) > 10) {
            $this->validateOnly('content');
        }
    }

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
        ]);
    }
}
