<div class="mt-8">
    <h4 class="text-xl font-semibold text-white flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
        </svg>
        {{ $commentsCount }} Comentarii
    </h4>

    <!-- Comment Form -->
    @auth
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
    @else
        <div class="mt-6 p-4 text-center text-gray-400 bg-gray-800/30 rounded-lg backdrop-blur-sm ring-1 ring-purple-500/10">
            <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300">Autentifică-te</a> pentru a adăuga un comentariu.
        </div>
    @endauth

    <!-- Comments Section -->
    @if ($comments->count())
        <ul class="mt-6 space-y-4">
            @foreach ($comments as $comment)
                <li class="p-4 bg-gray-800/30 rounded-lg backdrop-blur-sm ring-1 ring-purple-500/10">
                    <div class="flex items-start space-x-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if ($comment->user->avatar)
                                <img src="{{ asset('storage/' . $comment->user->avatar) }}"
                                    alt="{{ $comment->user->name }}"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-purple-500/30">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center text-white font-semibold">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Comment Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-white">{{ $comment->user->name }}</span>
                                @if ($comment->user->usertype === 'admin')
                                    <span class="px-2 py-0.5 text-xs font-medium bg-purple-500/20 text-purple-300 rounded-full">
                                        Admin
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="mt-1 text-gray-300 whitespace-pre-wrap">{{ $comment->content }}</p>

                            {{-- Secțiune nested replies --}}
                            <div class="mt-3" x-data="{ showReplies: {{ $comment->replies->count() > 0 ? 'true' : 'false' }} }">
                                {{-- Buton toggle replies --}}
                                <button @click="showReplies = !showReplies"
                                    class="flex items-center text-sm text-blue-400 transition-colors duration-200 hover:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    <span x-text="showReplies ? 'Ascunde răspunsuri' : '{{ $comment->replies->count() > 0 ? $comment->replies->count() . " răspunsuri" : "Răspunde" }}'"></span>
                                </button>

                                {{-- Lista de nested replies + form --}}
                                <div x-show="showReplies" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    class="mt-2">

                                    {{-- Nested replies list --}}
                                    @if($comment->replies->count() > 0)
                                        <ul class="pl-4 ml-2 space-y-2 border-l-2 border-purple-500/30">
                                            @foreach($comment->replies->sortByDesc('created_at') as $nestedReply)
                                                <li class="p-2 rounded-lg bg-gray-900/50 backdrop-blur-sm ring-1 ring-purple-500/10">
                                                    <div class="flex items-start space-x-2">
                                                        <div class="flex-shrink-0">
                                                            @if ($nestedReply->user->avatar)
                                                                <img src="{{ asset('storage/' . $nestedReply->user->avatar) }}"
                                                                    alt="{{ $nestedReply->user->name }}"
                                                                    class="w-7 h-7 rounded-full object-cover">
                                                            @else
                                                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center text-white text-xs font-semibold">
                                                                    {{ substr($nestedReply->user->name, 0, 1) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex items-center space-x-2">
                                                                <span class="text-sm font-medium text-blue-400">{{ $nestedReply->user->name }}</span>
                                                                @if($nestedReply->user->usertype === 'admin')
                                                                    <span class="px-1.5 py-0.5 text-xs bg-purple-500/20 text-purple-300 rounded-md">Admin</span>
                                                                @endif
                                                                <span class="text-xs text-gray-500">{{ $nestedReply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-300 whitespace-pre-wrap">{{ $nestedReply->content }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- Form pentru reply nou --}}
                                    @auth
                                        <form wire:submit.prevent="addReplyToReply({{ $comment->id }})" class="mt-2 pl-4 ml-2">
                                            <div class="mb-2">
                                                <textarea wire:model.defer="replyToReplyContent.{{ $comment->id }}"
                                                    class="w-full p-2 text-sm text-white transition-all duration-300 border-none rounded-lg shadow-sm resize-none bg-gray-800/50 backdrop-blur-sm ring-1 ring-purple-500/20 focus:ring-purple-500/40 focus:outline-none"
                                                    rows="2" placeholder="Răspunde la acest comentariu..."></textarea>
                                                @error("replyToReplyContent.{$comment->id}")
                                                    <span class="mt-1 text-xs text-red-400">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:from-blue-700 hover:to-purple-700 shadow-sm focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                    </svg>
                                                    Trimite
                                                </button>
                                            </div>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Link către forum -->
        @if ($thread)
            <div class="mt-6 text-center">
                <a href="{{ route('forum.threads.show', $thread) }}"
                    class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                    <span>Vezi discuția completă în forum</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        @endif
    @else
        <div class="mt-6 p-6 text-center text-gray-400 bg-gray-800/30 rounded-lg backdrop-blur-sm ring-1 ring-purple-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 mb-3 text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <p>Nu există comentarii încă. Fii primul care comentează!</p>

            @if ($thread)
                <a href="{{ route('forum.threads.show', $thread) }}"
                    class="mt-3 inline-block text-purple-400 hover:text-purple-300">
                    sau discută în forum →
                </a>
            @endif
        </div>
    @endif
</div>
