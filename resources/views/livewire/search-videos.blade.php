<div class="w-full mx-auto"
     x-data="{ 
         isLoading: false 
     }"
     x-on:livewire:loading.window="isLoading = true"
     x-on:livewire:load.window="isLoading = false"
>
    <div class="relative mb-6">
        <div class="flex">
            <input
                wire:model.debounce.300ms="searchTerm"
                wire:keydown.enter="search"
                type="text"
                class="flex-grow px-4 py-2 border border-gray-300 shadow-sm rounded-l-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                placeholder="Caută Videoclip"
            >
            <button
                wire:click="search"
                class="relative px-2 py-2 text-white bg-blue-500 shadow-md md:px-6 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                :class="{ 'opacity-50 cursor-not-allowed': isLoading }"
                :disabled="isLoading"
            >
                <span x-show="!isLoading">Caută</span>
                <span x-show="isLoading" class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </div>

        @if(count($suggestions) > 0)
            <ul class="absolute z-10 w-full mt-1 overflow-y-auto bg-white border border-gray-300 rounded-md shadow-lg max-h-60">
                @foreach($suggestions as $suggestion)
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-100" wire:click="selectSuggestion('{{ $suggestion }}')">
                        {{ $suggestion }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if($lastSearchedTerm)
        <div class="mt-4 mb-6 text-lg font-semibold">
            Rezultate pentru: <span class="text-blue-600">{{ $lastSearchedTerm }}</span>
        </div>
    @endif

    <div x-show="isLoading" class="flex justify-center my-8">
        <svg class="w-10 h-10 text-blue-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <div x-show="!isLoading">
        @if($searchResults !== null)
            @if($searchResults->count() > 0)
                <div class="grid grid-cols-1 gap-6 mt-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($searchResults as $video)
                        <div class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
                            <a href="{{ route('videos.show', $video) }}" class="block">
                                <div class="aspect-w-16 aspect-h-9">
                                    {!! $video->embed_link !!}
                                </div>
                                <div class="p-4">
                                    <h3 class="mb-2 text-lg font-semibold text-gray-800 line-clamp-1 md:line-clamp-2">{{ $video->title }}</h3>
                                    <p class="flex items-center text-blue-500 hover:text-blue-600">
                                        Vezi mai mult
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-6 text-lg text-gray-600">Nu s-au găsit rezultate pentru "{{ $lastSearchedTerm }}"</p>
            @endif
        @endif
    </div>
</div>