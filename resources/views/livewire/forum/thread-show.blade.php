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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Înapoi la {{ $thread->category->name }}
            </a>
        </div>
            
            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <div class="flex items-start space-x-4">
                    <img src="{{ $thread->user->avatar }}" 
                         alt="{{ $thread->user->name }}"
                         class="w-12 h-12 rounded-full ring-2 ring-gray-800">
                         
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h1 class="text-2xl font-bold text-white">
                                {{ $thread->title }}
                            </h1>
                            <div class="flex items-center space-x-2">
                                @if($thread->is_pinned)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-400/10 text-blue-400">
                                        Pinned
                                    </span>
                                @endif
                                @if($thread->is_locked)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400">
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
            @foreach($replies as $reply)
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ $reply->user->avatar }}" 
                                     alt="{{ $reply->user->name }}"
                                     class="w-10 h-10 rounded-full">
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm">
                                        <span class="font-medium text-blue-400">{{ $reply->user->name }}</span>
                                        <span class="text-gray-500">• {{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    @if($reply->is_solution)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-400/10 text-green-400">
                                            Soluție
                                        </span>
                                    @endif
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
        @if(!$thread->is_locked)
            <div class="relative mt-8 group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                
                <form wire:submit="saveReply" class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                    <div>
                        <label for="replyContent" class="sr-only">Răspunsul tău</label>
                        <textarea wire:model="replyContent"
                                  id="replyContent"
                                  rows="4"
                                  class="w-full text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                                  placeholder="Scrie un răspuns..."></textarea>
                        @error('replyContent')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-50">
                            <span wire:loading.remove>Publică răspunsul</span>
                            <span wire:loading>Se publică...</span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="p-4 mt-8 text-center text-gray-400 border border-gray-800 rounded-lg">
                Această discuție este închisă pentru răspunsuri noi.
            </div>
        @endif
    </div>
</div>