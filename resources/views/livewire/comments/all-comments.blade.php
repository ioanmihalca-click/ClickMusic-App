<div class="mt-8">
    <h4 class="text-xl font-semibold text-white flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-400" fill="none" viewBox="0 0 24 24"
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
                class="block w-full p-3 mt-1 text-white bg-gray-800/50 border-none rounded-lg shadow-md backdrop-blur-sm ring-1 ring-purple-500/20 focus:ring-purple-500/40 focus:outline-none resize-none transition-all duration-300"
                rows="3" placeholder="Adaugă un comentariu..."></textarea>
            @error('newComment')
                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:from-blue-700 hover:to-purple-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
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
            class="mt-6 p-6 text-center text-gray-400 bg-gray-800/30 rounded-lg backdrop-blur-sm ring-1 ring-purple-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 mb-3 text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <p>Nu există comentarii încă. Fii primul care comentează!</p>
        </div>
    @endif
</div>
