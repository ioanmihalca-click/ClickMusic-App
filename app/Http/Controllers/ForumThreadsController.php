<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumThreadsController extends Controller
{
    public function destroy(ForumThread $thread)
    {
        // Thread-urile auto-generate (din videoclipuri) pot fi șterse doar de admin
        if ($thread->is_auto_generated && Auth::user()->usertype !== 'admin') {
            return redirect()
                ->back()
                ->with('error', 'Discuțiile generate automat pentru videoclipuri nu pot fi șterse.');
        }

        // Check if user is admin or the thread author
        if (Auth::user()->usertype === 'admin' || Auth::user()->id === $thread->user_id) {
            // Delete all replies first
            $thread->replies()->delete();

            // Then delete the thread
            $thread->delete();

            return redirect()
                ->route('forum.categories.show', $thread->category)
                ->with('success', 'Discuția a fost ștearsă cu succes.');
        }

        return redirect()
            ->back()
            ->with('error', 'Nu ai permisiunea de a șterge această discuție.');
    }

    public function edit(ForumThread $thread)
    {
        // Thread-urile auto-generate (din videoclipuri) nu pot fi editate
        if ($thread->is_auto_generated) {
            return redirect()
                ->back()
                ->with('error', 'Discuțiile generate automat pentru videoclipuri nu pot fi editate.');
        }

        // Check if user is the thread author (admins can't edit others' threads, only delete them)
        if (Auth::user()->id !== $thread->user_id) {
            return redirect()
                ->back()
                ->with('error', 'Nu ai permisiunea de a edita această discuție.');
        }

        // Return view for editing the thread
        return view('forum.threads.edit', compact('thread'));
    }

    public function update(Request $request, ForumThread $thread)
    {
        // Thread-urile auto-generate (din videoclipuri) nu pot fi editate
        if ($thread->is_auto_generated) {
            return redirect()
                ->back()
                ->with('error', 'Discuțiile generate automat pentru videoclipuri nu pot fi editate.');
        }

        // Check if user is the thread author
        if (Auth::user()->id !== $thread->user_id) {
            return redirect()
                ->back()
                ->with('error', 'Nu ai permisiunea de a edita această discuție.');
        }

        // Validate request data
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:20',
        ]);

        // Update the thread
        $thread->update($validated);

        return redirect()
            ->route('forum.threads.show', $thread)
            ->with('success', 'Discuția a fost actualizată cu succes.');
    }
}
