<!-- resources/views/livewire/forum/category-show.blade.php -->
<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header cu gradient -->
        <div class="relative mb-8">
            <div class="relative p-6 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg"
                                style="background-color: {{ $category->color }};">
                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <h1
                                class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500">
                                {{ $category->name }}
                            </h1>
                        </div>
                        <p class="mt-2 text-gray-400">{{ $category->description }}</p>

                        <div class="flex flex-wrap items-center mt-3 gap-4">
                            <div class="flex items-center text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>{{ $threads->total() }} discuții</span>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <span>{{ $category->replies()->count() }} răspunsuri</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col mt-4 space-y-2 sm:mt-0 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('forum.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 text-center text-gray-300 transition-all duration-300 border border-white/10 rounded-lg hover:text-white hover:border-blue-500/20">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Înapoi la categorii
                        </a>

                        <a href="{{ route('forum.threads.create', ['category' => $category->id]) }}"
                            class="inline-flex items-center justify-center px-4 py-2 text-center text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Creează discuție
                        </a>
                    </div>
                </div>

                <!-- Search bar -->
                <div class="flex-1 my-4">
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="w-full px-4 py-2 text-gray-300 bg-black/30 border border-white/10 rounded-lg focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/50"
                            placeholder="Caută după titlu sau conținut...">
                    </div>
                </div>
            </div>

            <!-- Lista de thread-uri -->
            <div class="space-y-4">
                @forelse($threads as $thread)
                    <div class="relative">
                        <div
                            class="relative p-6 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5 transition-all duration-300 hover:border-blue-500/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $thread->user->avatar }}" alt="{{ $thread->user->name }}"
                                        class="w-12 h-12 rounded-full ring-2 ring-blue-500/20">
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center justify-between">
                                        <a href="{{ route('forum.threads.show', $thread) }}"
                                            class="text-xl font-semibold text-white hover:text-blue-400 line-clamp-1">
                                            <div class="flex items-center">
                                                @if ($thread->is_pinned)
                                                    <span
                                                        class="inline-flex items-center justify-center w-6 h-6 mr-2 text-blue-400 bg-blue-400/10 rounded-full"
                                                        title="Discuție fixată">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                        </svg>
                                                    </span>
                                                @endif
                                                {{ $thread->title }}
                                            </div>
                                        </a>
                                        <div class="flex flex-wrap items-center gap-2 mt-1 sm:mt-0">
                                            @if ($thread->replies()->where('is_solution', true)->exists())
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-400/10 text-green-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Rezolvat
                                                </span>
                                            @endif
                                            <span class="text-sm text-gray-500">
                                                {{ $thread->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-1 text-sm text-gray-400">
                                        de <span class="font-medium text-blue-400">{{ $thread->user->name }}</span>
                                    </div>

                                    <!-- Extras conținut truncat pentru previzualizare -->
                                    <div class="mt-2 text-sm text-gray-500 line-clamp-2">
                                        {{ Str::limit(strip_tags(Str::markdown($thread->content)), 150) }}
                                    </div>

                                    <div class="flex flex-wrap items-center mt-4 gap-4 text-sm">
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ $thread->views_count }}
                                        </div>

                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                            {{ $thread->replies_count }}
                                        </div>

                                        @if ($thread->is_locked)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                Blocat
                                            </span>
                                        @endif

                                        <!-- Opțiuni pentru autorul thread-ului -->
                                        @if (auth()->check() && auth()->id() === $thread->user_id && auth()->user()->usertype !== 'admin')
                                            <div class="flex space-x-1">
                                                <a href="{{ route('forum.threads.edit', $thread) }}"
                                                    class="inline-flex items-center p-1 text-xs text-gray-400 transition-colors bg-gray-800 rounded hover:text-blue-400 hover:bg-gray-700"
                                                    title="Editează discuția">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('forum.threads.destroy', $thread) }}"
                                                    method="POST" class="inline-block"
                                                    onsubmit="return confirm('Ești sigur că vrei să ștergi această discuție? Această acțiune nu poate fi anulată.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center p-1 text-xs text-gray-400 transition-colors bg-gray-800 rounded hover:text-red-400 hover:bg-gray-700"
                                                        title="Șterge discuția">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif

                                        <!-- Controale admin -->
                                        @if (auth()->check() && auth()->user()->usertype === 'admin')
                                            <div class="flex space-x-1 ml-1">
                                                <button wire:click="pinThread({{ $thread->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="inline-flex items-center p-1 text-xs text-gray-400 transition-colors bg-gray-800 rounded hover:text-blue-400 hover:bg-gray-700"
                                                    title="{{ $thread->is_pinned ? 'Anulează fixarea' : 'Fixează discuția' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                    </svg>
                                                </button>

                                                <button wire:click="lockThread({{ $thread->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="inline-flex items-center p-1 text-xs text-gray-400 transition-colors bg-gray-800 rounded hover:text-red-400 hover:bg-gray-700"
                                                    title="{{ $thread->is_locked ? 'Deblochează discuția' : 'Blochează discuția' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </button>

                                                <form action="{{ route('forum.threads.destroy', $thread) }}"
                                                    method="POST" class="inline-block"
                                                    onsubmit="return confirm('Ești sigur că vrei să ștergi această discuție? Această acțiune nu poate fi anulată.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center p-1 text-xs text-gray-400 transition-colors bg-gray-800 rounded hover:text-red-400 hover:bg-gray-700"
                                                        title="Șterge discuția">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
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

                                @if ($thread->latestReply)
                                    <div class="hidden pl-4 border-l border-white/10 md:block">
                                        <div class="text-sm text-gray-400">
                                            Ultimul răspuns
                                        </div>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <img src="{{ $thread->latestReply->user->avatar }}"
                                                alt="{{ $thread->latestReply->user->name }}"
                                                class="w-6 h-6 rounded-full">
                                            <span class="text-sm text-gray-300">
                                                {{ $thread->latestReply->user->name }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                {{ $thread->latestReply->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="text-gray-400">
                            Nu există încă discuții în această categorie.
                        </div>
                        <a href="{{ route('forum.threads.create', ['category' => $category->id]) }}"
                            class="inline-block px-4 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Creează prima discuție
                        </a>
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Notificări -->
    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:thread-updated.window="show = true; message = $event.detail.message; type='success'; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" class="fixed bottom-4 right-4 z-50">
        <div x-bind:class="{
            'bg-green-500': type === 'success',
            'bg-blue-500': type === 'info',
            'bg-yellow-500': type === 'warning',
            'bg-red-500': type === 'error'
        }"
            class="px-4 py-3 text-white rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg x-show="type === 'success'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span x-text="message"></span>
            </div>
        </div>
    </div>
