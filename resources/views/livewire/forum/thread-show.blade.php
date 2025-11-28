<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Thread Header -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-cyan-500 to-emerald-500"></div>
            </div>

            <div class="relative p-6 glass-card">
                <!-- Adăugăm butonul de înapoi -->
                <div class="mb-4">
                    <a href="{{ route('forum.categories.show', $thread->category) }}"
                        class="inline-flex items-center px-4 py-2 text-gray-300 transition-all duration-300 border border-gray-700 rounded-lg hover:text-white hover:border-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Înapoi la {{ $thread->category->name }}
                    </a>
                </div>

                <div class="relative p-6 glass-card">
                    <div class="flex items-start space-x-4">
                        <img src="{{ $thread->user->avatar }}" alt="{{ $thread->user->name }}"
                            class="w-12 h-12 rounded-full ring-2 ring-gray-800">

                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-white">
                                    {{ $thread->title }}
                                </h1>
                                <div class="flex items-center space-x-2">
                                    @if ($thread->is_pinned)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-400/10 text-blue-400">
                                            Pinned
                                        </span>
                                    @endif
                                    @if ($thread->is_locked)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400">
                                            Locked
                                        </span>
                                    @endif

                                    <!-- Butoane de editare/ștergere pentru autorul thread-ului sau admin -->
                                    {{-- Nu afișăm butoanele pentru thread-uri auto-generate (din videoclipuri) --}}
                                    @if (!$thread->is_auto_generated && (auth()->id() === $thread->user_id || auth()->user()->usertype === 'admin'))
                                        <div class="flex items-center space-x-2 ml-4">
                                            @if (auth()->id() === $thread->user_id)
                                                <a href="{{ route('forum.threads.edit', $thread) }}"
                                                    class="inline-flex items-center p-1 text-blue-400 transition-colors bg-blue-400/10 rounded-md hover:bg-blue-400/20"
                                                    title="Editează discuția">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <form action="{{ route('forum.threads.destroy', $thread) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Ești sigur că vrei să ștergi această discuție? Această acțiune nu poate fi anulată.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center p-1 text-red-400 transition-colors bg-red-400/10 rounded-md hover:bg-red-400/20"
                                                    title="Șterge discuția">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-2">
                                <div class="flex items-center space-x-2 text-sm text-gray-400">
                                    <div class="flex items-center">
                                        <span class="font-medium text-blue-400">{{ $thread->user->name }}</span>
                                        <livewire:user-badge :user="$thread->user" />
                                    </div>
                                    <span>&bull;</span>
                                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="mt-2 sm:mt-0">
                                    <span class="text-sm text-gray-400">{{ $replies->count() }} răspunsuri</span>
                                </div>
                            </div>

                            <div
                                class="mt-4 prose prose-sm max-w-none text-gray-300 prose-headings:text-gray-200 prose-a:text-blue-400">
                                {!! $thread->body_html !!}
                            </div>

                            {{-- Video embed pentru thread-uri legate de videoclipuri --}}
                            @if($thread->isVideoThread() && $thread->video)
                                <div class="mt-6 overflow-hidden glass-card">
                                    @if($thread->video->video_path)
                                        @if($thread->video->isAudio())
                                            {{-- Audio Player --}}
                                            <div class="relative flex items-center justify-center w-full h-48 bg-center bg-cover"
                                                style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ $thread->video->thumbnail_url_full }}') center center no-repeat; background-size: cover;">
                                                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
                                                <div class="relative z-10 w-full max-w-md px-8 py-4 bg-black/30 rounded-xl backdrop-blur-md">
                                                    <audio class="w-full" controls controlsList="nodownload"
                                                        src="{{ route('videos.stream', $thread->video->id) }}">
                                                        Browserul dvs. nu suportă redarea de fișiere audio.
                                                    </audio>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Video Player --}}
                                            <video class="w-full aspect-video" controls controlsList="nodownload"
                                                src="{{ route('videos.stream', $thread->video->id) }}"
                                                poster="{{ $thread->video->thumbnail_url_full }}">
                                                Browserul dvs. nu suportă redarea de videoclipuri.
                                            </video>
                                        @endif
                                    @elseif($thread->video->embed_link)
                                        {{-- Embed extern --}}
                                        <div class="aspect-video">
                                            {!! $thread->video->embed_link !!}
                                        </div>
                                    @endif

                                    {{-- Link către pagina video --}}
                                    <div class="p-3 mt-4 glass-card">
                                        <a href="{{ route('videos.show', $thread->video) }}"
                                            class="inline-flex items-center text-sm text-cyan-300 hover:text-cyan-200 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            Vezi pagina completă a videoclipului
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header pentru secțiunea de răspunsuri -->
            <div class="mt-8 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Răspunsuri ({{ $replies->total() }})</h2>
                    <div class="flex items-center text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Ordonate cronologic
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="relative">
                <!-- Linia temporală verticală -->
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-700"></div>

                <div class="space-y-6">
                    @foreach ($replies as $loop_index => $reply)
                        <div id="reply-{{ $reply->id }}" class="relative group">
                            <!-- Indicator temporal -->
                            <div
                                class="absolute left-5 -translate-x-1/2 w-2 h-2 rounded-full {{ $reply->is_solution ? 'bg-green-500' : 'bg-blue-500' }} z-10">
                            </div>

                            <div
                                class="absolute -inset-0.5 ml-8 {{ $reply->is_solution ? 'bg-gradient-to-r from-green-500 via-emerald-500 to-green-500' : 'bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400' }} rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                            </div>

                            <div
                                class="relative p-6 ml-8 glass-card {{ $reply->is_solution ? 'border border-green-500/30' : '' }}">
                                @if ($reply->is_solution)
                                    <div class="absolute top-0 right-0 transform translate-x-2 -translate-y-2">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 bg-green-500 rounded-full shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                <!-- Număr răspuns -->
                                <div
                                    class="absolute top-0 left-0 text-sm text-gray-500 transform -translate-x-12 translate-y-6">
                                    #{{ $loop_index + 1 + ($replies->currentPage() - 1) * $replies->perPage() }}
                                </div>

                                <div class="flex space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}"
                                            class="w-10 h-10 rounded-full">
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-medium text-blue-400">{{ $reply->user->name }}</span>
                                                    <livewire:user-badge :user="$reply->user" />
                                                    @if ($reply->user->id === $thread->user_id)
                                                        <span
                                                            class="px-1.5 py-0.5 text-xs bg-blue-400/10 text-blue-400 rounded-md">Autor</span>
                                                    @endif
                                                </div>
                                                <div class="text-gray-500 text-xs mt-0.5">
                                                    <span class="inline-block">
                                                        <time datetime="{{ $reply->created_at->toIso8601String() }}"
                                                            title="{{ $reply->created_at->format('d M Y, H:i') }}">
                                                            {{ $reply->created_at->format('d M Y, H:i') }}
                                                        </time>
                                                    </span>
                                                    <span
                                                        class="inline-block ml-2 text-gray-600">({{ $reply->created_at->diffForHumans() }})</span>
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-2">
                                                @if ($reply->is_solution)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-400/10 text-green-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Soluție verificată
                                                    </span>
                                                @endif

                                                <!-- Opțiuni pentru autorul thread-ului -->
                                                <!-- Soluție buttons -->
                                                @if (auth()->id() === $thread->user_id && !$thread->is_locked)
                                                    @if (!$reply->is_solution)
                                                        <button wire:click="markAsSolution({{ $reply->id }})"
                                                            wire:loading.attr="disabled"
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-400 transition-colors bg-transparent border border-green-400 rounded-md hover:bg-green-400/10"
                                                            title="Marchează ca soluție">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button wire:click="unmarkSolution({{ $reply->id }})"
                                                            wire:loading.attr="disabled"
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-400 transition-colors bg-transparent border border-red-400 rounded-md hover:bg-red-400/10"
                                                            title="Demarcă soluția">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    @endif
                                                @endif

                                                <!-- Edit/Delete Buttons pentru autor sau admin -->
                                                @if (auth()->id() === $reply->user_id || auth()->user()->usertype === 'admin')
                                                    <div class="flex items-center space-x-1 ml-2">
                                                        @if (auth()->id() === $reply->user_id)
                                                            <a href="{{ route('forum.replies.edit', $reply) }}"
                                                                class="inline-flex items-center p-1 text-blue-400 transition-colors bg-blue-400/10 rounded-md hover:bg-blue-400/20"
                                                                title="Editează răspunsul">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
                                                        @endif

                                                        <form action="{{ route('forum.replies.destroy', $reply) }}"
                                                            method="POST" class="inline-block"
                                                            onsubmit="return confirm('Ești sigur că vrei să ștergi acest răspuns? Această acțiune nu poate fi anulată.')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center p-1 text-red-400 transition-colors bg-red-400/10 rounded-md hover:bg-red-400/20"
                                                                title="Șterge răspunsul">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-2 prose prose-invert max-w-none">
                                            {!! Str::markdown($reply->content) !!}
                                        </div>

                                        {{-- Secțiune nested replies --}}
                                        @if(!$thread->is_locked)
                                            <div class="mt-4" x-data="{ showReplies: {{ $reply->replies->count() > 0 ? 'true' : 'false' }} }">
                                                {{-- Buton toggle replies --}}
                                                <button @click="showReplies = !showReplies"
                                                    class="flex items-center text-sm text-blue-400 transition-colors duration-200 hover:text-blue-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                    </svg>
                                                    <span x-text="showReplies ? 'Ascunde răspunsuri' : '{{ $reply->replies->count() > 0 ? $reply->replies->count() . " răspunsuri" : "Răspunde" }}'"></span>
                                                </button>

                                                {{-- Lista de nested replies + form --}}
                                                <div x-show="showReplies" x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 transform scale-95"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    class="mt-3">

                                                    {{-- Nested replies list --}}
                                                    @if($reply->replies->count() > 0)
                                                        <ul class="pl-4 ml-2 space-y-3 border-l-2 border-cyan-400/30">
                                                            @foreach($reply->replies->sortByDesc('created_at') as $nestedReply)
                                                                <li class="p-3 glass-card">
                                                                    <div class="flex items-start space-x-2">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="{{ $nestedReply->user->avatar }}" alt="{{ $nestedReply->user->name }}"
                                                                                class="w-8 h-8 rounded-full">
                                                                        </div>
                                                                        <div class="flex-1 min-w-0">
                                                                            <div class="flex items-center space-x-2">
                                                                                <span class="text-sm font-medium text-blue-400">{{ $nestedReply->user->name }}</span>
                                                                                @if($nestedReply->user->usertype === 'admin')
                                                                                    <span class="px-1.5 py-0.5 text-xs bg-cyan-500/20 text-cyan-200 rounded-md">Admin</span>
                                                                                @endif
                                                                                <span class="text-xs text-gray-500">{{ $nestedReply->created_at->diffForHumans() }}</span>
                                                                            </div>
                                                                            <div class="mt-1 text-sm text-gray-300 prose prose-sm prose-invert max-w-none">
                                                                                {!! Str::markdown($nestedReply->content) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                    {{-- Form pentru reply nou --}}
                                                    @auth
                                                        <form wire:submit.prevent="addReplyToReply({{ $reply->id }})" class="mt-3 pl-4 ml-2">
                                                            <div class="mb-2">
                                                                <textarea wire:model.defer="replyToReplyContent.{{ $reply->id }}"
                                                                    class="w-full p-2 text-sm text-white transition-all duration-300 rounded-2xl shadow-glass resize-none bg-slate-900/60 border border-white/10 backdrop-blur-xl focus:border-cyan-300/60 focus:ring-2 focus:ring-cyan-400/40 focus:outline-none"
                                                                    rows="2" placeholder="Răspunde la acest comentariu..."></textarea>
                                                                @error("replyToReplyContent.{$reply->id}")
                                                                    <span class="mt-1 text-xs text-red-400">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="flex justify-end">
                                                                <button type="submit"
                                                                    class="glass-button px-4 py-2 text-xs">
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
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $replies->links() }}
                </div>

                <!-- Reply Form -->
                @if (!$thread->is_locked)
                    <div class="relative mt-8 group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                        </div>

                        <form wire:submit.prevent="saveReply"
                            class="relative p-6 glass-card">
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 mr-3">
                                        @if (auth()->check())
                                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                                class="w-8 h-8 rounded-full">
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-medium text-white">Scrie un răspuns</h3>
                                </div>

                                <div class="relative">
                                    <textarea wire:model="replyContent" id="replyContent" rows="4"
                                        class="w-full px-4 py-3 text-gray-200 bg-slate-900/60 border border-white/10 rounded-2xl shadow-glass focus:ring-2 focus:ring-cyan-400/40 focus:border-cyan-300/60"
                                        placeholder="Contribuie la discuție..."></textarea>

                                    <div class="absolute text-xs text-gray-500 top-2 right-2">
                                        Markdown suportat
                                    </div>

                                    @error('replyContent')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-2 text-xs text-gray-500">
                                    <span class="inline-block mr-2">
                                        <code>**bold**</code> pentru <strong class="text-gray-400">bold</strong>
                                    </span>
                                    <span class="inline-block mr-2">
                                        <code>*italic*</code> pentru <em class="text-gray-400">italic</em>
                                    </span>
                                    <span class="inline-block">
                                        <code>```cod```</code> pentru <code
                                            class="px-1 py-0.5 text-gray-400 bg-gray-700 rounded">cod</code>
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="glass-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    <span wire:loading.remove>Publică răspunsul</span>
                                    <span wire:loading>Se publică...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="p-6 mt-8 text-center glass-card">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-300">Discuție închisă</h3>
                        <p class="mt-1 text-gray-400">Această discuție este închisă pentru răspunsuri noi.</p>
                    </div>
                @endif

                <!-- Notificări -->
                <div x-data="{ show: false, message: '', type: 'success' }"
                    x-on:solution-marked.window="show = true; message = 'Răspuns marcat ca soluție'; type='success'; setTimeout(() => show = false, 3000)"
                    x-on:solution-unmarked.window="show = true; message = 'Soluție demarcată'; type='info'; setTimeout(() => show = false, 3000)"
                    x-on:reply-added.window="show = true; message = 'Răspuns adăugat cu succes'; type='success'; setTimeout(() => show = false, 3000)"
                    x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2" class="fixed z-50 bottom-4 right-4">
                    <div x-bind:class="{
                        'bg-green-500': type === 'success',
                        'bg-blue-500': type === 'info',
                        'bg-yellow-500': type === 'warning',
                        'bg-red-500': type === 'error'
                    }"
                        class="px-4 py-3 text-white rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <svg x-show="type === 'success'" class="w-6 h-6 mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg x-show="type === 'info'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-text="message"></span>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('livewire:initialized', () => {
                    @this.on('scrollToReply', ({
                        id
                    }) => {
                        setTimeout(() => {
                            const element = document.getElementById(`reply-${id}`);
                            if (element) {
                                element.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                element.classList.add('animate-pulse');
                                setTimeout(() => {
                                    element.classList.remove('animate-pulse');
                                }, 2000);
                            }
                        }, 200);
                    });

                    @this.on('solutionMarked', () => {
                        Livewire.dispatch('solution-marked');
                    });

                    @this.on('solutionUnmarked', () => {
                        Livewire.dispatch('solution-unmarked');
                    });

                    @this.on('replyAdded', () => {
                        Livewire.dispatch('reply-added');
                    });
                });
            </script>
        </div>
    </div>
</div>
