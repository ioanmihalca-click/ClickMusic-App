<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Video;
use App\Models\ForumReply;
use App\Events\ForumReplyCreated;
use Illuminate\Support\Facades\Auth;

class VideoForumComments extends Component
{
    public Video $video;
    public $newComment = '';
    public $replyToReplyContent = [];  // Array pentru reply-uri nested

    protected $rules = [
        'newComment' => 'required|min:1'
    ];

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function addComment()
    {
        $this->validate();

        $thread = $this->video->forumThread;

        if (!$thread) {
            return;
        }

        $reply = $thread->replies()->create([
            'content' => $this->newComment,
            'user_id' => Auth::id()
        ]);

        // Declanșează evenimentul pentru notificări
        event(new ForumReplyCreated($reply, $thread));

        $this->newComment = '';
    }

    /**
     * Adaugă un răspuns nested (reply la reply)
     */
    public function addReplyToReply($parentReplyId)
    {
        $this->validate([
            "replyToReplyContent.{$parentReplyId}" => 'required|min:1'
        ]);

        $thread = $this->video->forumThread;

        if (!$thread) {
            return;
        }

        $reply = $thread->replies()->create([
            'content' => $this->replyToReplyContent[$parentReplyId],
            'user_id' => Auth::id(),
            'parent_id' => $parentReplyId
        ]);

        $this->replyToReplyContent[$parentReplyId] = '';

        // Declanșează evenimentul pentru notificări
        event(new ForumReplyCreated($reply, $thread));
    }

    public function render()
    {
        $thread = $this->video->forumThread;
        $comments = $thread
            ? $thread->replies()
                ->whereNull('parent_id')  // Doar comentarii principale
                ->with(['user', 'replies.user'])  // Eager load nested replies
                ->latest()
                ->get()
            : collect();

        // Numără toate comentariile (inclusiv nested)
        $totalCount = $thread
            ? $thread->replies()->count()
            : 0;

        return view('livewire.comments.video-forum-comments', [
            'comments' => $comments,
            'thread' => $thread,
            'commentsCount' => $totalCount
        ]);
    }
}
