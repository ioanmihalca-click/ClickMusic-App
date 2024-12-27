<div class="w-full mx-auto" 
     x-data="{ isLoading: false }" 
     x-on:livewire:loading.window="isLoading = true" 
     x-on:livewire:load.window="isLoading = false">
    
    <div class="relative mb-6">
        <div class="flex">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text"
                class="w-full px-6 py-4 text-white placeholder-gray-400 border bg-gray-800/50 border-gray-700/30 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Caută Videoclip">
                
            <div x-show="isLoading" 
                 class="absolute transform -translate-y-1/2 right-4 top-1/2">
                <svg class="w-5 h-5 text-gray-400 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>

    @if($search)
        <div class="mt-4 mb-6 text-lg font-semibold text-blue-400">
            Rezultate pentru: <span class="text-white">{{ $search }}</span>
        </div>
    @endif

    <div>
        @if($searchResults !== null)
            @if($searchResults->count() > 0)
                <div class="grid grid-cols-1 gap-6 mt-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($searchResults as $video)
                        <div class="overflow-hidden transition-all duration-300 bg-gray-800/50 backdrop-blur border border-gray-700/30 rounded-xl group hover:scale-[1.02]">
                            <a href="{{ route('videos.show', $video) }}" class="block">
                                <div class="aspect-w-16 aspect-h-9">
                                    {!! $video->embed_link !!}
                                </div>
                                <div class="p-6">
                                    <h3 class="mb-3 text-lg font-semibold text-white line-clamp-1">{{ $video->title }}</h3>
                                    <p class="flex items-center text-blue-400 transition-all duration-300 group-hover:text-blue-300">
                                        Vezi mai mult
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-6 text-lg text-gray-400">Nu s-au găsit rezultate pentru "{{ $search }}"</p>
            @endif
        @endif
    </div>
</div>