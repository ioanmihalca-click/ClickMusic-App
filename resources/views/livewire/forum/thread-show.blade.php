<!-- resources/views/livewire/forum/thread-show.blade.php -->
<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Thread Header -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
            </div>

            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
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

                <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
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
                                </div>
                            </div>

                            <div class="mt-1 text-sm text-gray-400">
                                Creat de <span class="font-medium text-blue-400">{{ $thread->user->name }}</span>
                                • {{ $thread->created_at->diffForHumans() }}
                                • {{ $thread->views_count }} vizualizări
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 prose prose-invert max-w-none">
                        {!! Str::markdown($thread->content) !!}
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="space-y-6">
                @foreach ($replies as $reply)
                    <div id="reply-{{ $reply->id }}" class="relative group">
                        <div
                            class="absolute -inset-0.5 {{ $reply->is_solution ? 'bg-gradient-to-r from-green-500 via-emerald-500 to-green-500' : 'bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500' }} rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                        </div>

                        <div
                            class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl {{ $reply->is_solution ? 'border border-green-500/30' : '' }}">
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

                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}"
                                        class="w-10 h-10 rounded-full">
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm">
                                            <span class="font-medium text-blue-400">{{ $reply->user->name }}</span>
                                            <span class="text-gray-500">•
                                                {{ $reply->created_at->diffForHumans() }}</span>
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
                                            @if (auth()->id() === $thread->user_id && !$thread->is_locked)
                                                @if (!$reply->is_solution)
                                                    <button wire:click="markAsSolution({{ $reply->id }})"
                                                        wire:loading.attr="disabled"
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-400 transition-colors bg-transparent border border-green-400 rounded-md hover:bg-green-400/10"
                                                        title="Marchează ca soluție">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-2 prose prose-invert max-w-none">
                                        {!! Str::markdown($reply->content) !!}
                                    </div>
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
                        class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                    </div>

                    <form wire:submit.prevent="saveReply"
                        class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
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
                                    class="w-full px-4 py-3 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="Contribuie la discuție..."></textarea>

                                <div class="absolute top-2 right-2 text-xs text-gray-500">
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
                                class="inline-flex items-center px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-50">
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
                <div class="p-6 mt-8 text-center bg-gray-900/80 border border-gray-800 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
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
