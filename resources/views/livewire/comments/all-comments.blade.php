<div class="mt-8">
    <h4 class="text-xl font-semibold text-white flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-sky-300" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
        </svg>
        {{ $video->allCommentsCount() }} Comentarii
    </h4>

    <!-- Comment Form -->
    <form wire:submit.prevent="addComment" class="mt-6">
        <div class="mb-4">
            <textarea wire:model.defer="newComment" id="newComment"
                class="block w-full p-3 mt-1 text-white rounded-2xl bg-slate-900/50 border border-white/10 backdrop-blur-xl focus:border-sky-300/60 focus:ring-2 focus:ring-sky-400/40 focus:outline-none resize-none transition-all duration-300"
                rows="3" placeholder="Adaugă un comentariu..."></textarea>
            @error('newComment')
                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="glass-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                Adaugă comentariu
            </button>
        </div>
    </form>

    <!-- Comments Section -->
    @if ($comments->count())
        <ul class="mt-6 space-y-6">
            @include('includes.replyToComment', ['comments' => $video->comments])
        </ul>
    @else
        <div
            class="mt-6 p-6 glass-card text-center text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 mb-3 text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <p>Nu există comentarii încă. Fii primul care comentează!</p>
        </div>
    @endif
</div>
