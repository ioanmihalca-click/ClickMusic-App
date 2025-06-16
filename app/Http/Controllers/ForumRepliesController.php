<?php

namespace App\Http\Controllers;

use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumRepliesController extends Controller
{
    public function destroy(ForumReply $reply)
    {
        // Store thread for redirect
        $thread = $reply->thread;

        // Check if user is admin or the reply author
        if (Auth::user()->usertype === 'admin' || Auth::user()->id === $reply->user_id) {
            // Delete the reply
            $reply->delete();

            return redirect()
                ->route('forum.threads.show', $thread)
                ->with('success', 'Răspunsul a fost șters cu succes.');
        }

        return redirect()
            ->back()
            ->with('error', 'Nu ai permisiunea de a șterge acest răspuns.');
    }

    public function edit(ForumReply $reply)
    {
        // Check if user is the reply author (admins can't edit others' replies, only delete them)
        if (Auth::user()->id !== $reply->user_id) {
            return redirect()
                ->back()
                ->with('error', 'Nu ai permisiunea de a edita acest răspuns.');
        }

        // Return view for editing the reply
        return view('forum.replies.edit', compact('reply'));
    }

    public function update(Request $request, ForumReply $reply)
    {
        // Check if user is the reply author
        if (Auth::user()->id !== $reply->user_id) {
            return redirect()
                ->back()
                ->with('error', 'Nu ai permisiunea de a edita acest răspuns.');
        }

        // Validate request data
        $validated = $request->validate([
            'content' => 'required|min:10',
        ]);

        // Update the reply
        $reply->update($validated);

        return redirect()
            ->route('forum.threads.show', $reply->thread)
            ->with('success', 'Răspunsul a fost actualizat cu succes.');
    }
}
