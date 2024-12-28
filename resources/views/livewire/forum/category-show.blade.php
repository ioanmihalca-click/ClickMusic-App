<!-- resources/views/livewire/forum/category-show.blade.php -->
<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header cu gradient -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
            </div>
            
            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                            {{ $category->name }}
                        </h1>
                        <p class="mt-2 text-gray-400">{{ $category->description }}</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
    <a href="{{ route('forum.index') }}" 
       class="px-4 py-2 text-gray-300 transition-all duration-300 border border-gray-700 rounded-lg hover:text-white hover:border-gray-600">
        ← Înapoi la categorii
    </a>
    
    <a href="{{ route('forum.threads.create', ['category' => $category->id]) }}" 
       class="px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
        Creează discuție
    </a>
</div>
                </div>

                <!-- Search bar -->
                <div class="mt-4">
                    <input type="text" 
                           wire:model.debounce.300ms="search"
                           class="w-full px-4 py-2 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="Caută în această categorie...">
                </div>
            </div>
        </div>

        <!-- Lista de thread-uri -->
        <div class="space-y-4">
            @forelse($threads as $thread)
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative p-6 transition-colors bg-gray-900/90 backdrop-blur-sm rounded-xl hover:bg-gray-900/95">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ $thread->user->avatar }}" 
                                     alt="{{ $thread->user->name }}"
                                     class="w-12 h-12 rounded-full ring-2 ring-gray-800">
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('forum.threads.show', $thread) }}" 
                                       class="text-xl font-semibold text-white hover:text-blue-400 line-clamp-1">
                                        @if($thread->is_pinned)
                                            <span class="mr-2 text-blue-400">📌</span>
                                        @endif
                                        {{ $thread->title }}
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        {{ $thread->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <div class="mt-1 text-sm text-gray-400">
                                    de <span class="font-medium text-blue-400">{{ $thread->user->name }}</span>
                                </div>
                                
                                <div class="flex items-center mt-4 space-x-4 text-sm">
                                    <div class="flex items-center text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ $thread->views_count }}
                                    </div>
                                    
                                    <div class="flex items-center text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                        {{ $thread->replies_count }}
                                    </div>

                                    @if($thread->is_locked)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400">
                                            Blocat
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($thread->latestReply)
                                <div class="hidden pl-4 border-l border-gray-800 md:block">
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