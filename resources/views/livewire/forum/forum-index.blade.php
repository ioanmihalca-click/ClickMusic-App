<!-- resources/views/livewire/forum/forum-index.blade.php -->
<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header cu gradient, similar cu profilul tău -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
            </div>
            
            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <h1 class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                    Comunitatea Click Music
                </h1>
                <p class="mt-2 text-gray-400">Discută cu artiștii și ceilalți membri despre muzică, evenimente și mai multe.</p>
            </div>
        </div>

        <!-- Categorii -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $category)
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    
                    <a href="{{ route('forum.categories.show', $category) }}" 
                       class="relative block p-6 transition bg-gray-900/90 backdrop-blur-sm rounded-xl hover:bg-gray-900/95">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                            <div class="px-3 py-1 text-sm text-blue-400 rounded-full bg-blue-400/10">
                                {{ $category->threads_count }} discuții
                            </div>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-400">{{ $category->description }}</p>
                        
                        @if($category->latest_thread)
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $category->latest_thread->user->avatar }}" 
                                         alt="{{ $category->latest_thread->user->name }}"
                                         class="w-6 h-6 rounded-full">
                                    <div class="text-sm text-gray-400">
                                        Ultima postare de <span class="font-medium text-blue-400">{{ $category->latest_thread->user->name }}</span>
                                        <span class="text-gray-600">{{ $category->latest_thread->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>