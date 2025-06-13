<div class="w-full mx-auto" x-data="{ isLoading: false, isFocused: false }" x-on:livewire:loading.window="isLoading = true"
    x-on:livewire:load.window="isLoading = false">

    <div class="relative mb-6">
        <div class="relative flex">
            <!-- Modern Search Icon -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input wire:model.live.debounce.300ms="search" type="text" x-on:focus="isFocused = true"
                x-on:blur="isFocused = false"
                class="w-full py-4 pl-12 pr-10 text-white placeholder-gray-400 transition-all duration-300 border bg-gray-800/50 border-gray-700/30 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                :class="{ 'shadow-lg shadow-blue-500/20': isFocused }" placeholder="Caută Videoclip">

            <!-- Loading Spinner -->
            <div x-show="isLoading" class="absolute transform -translate-y-1/2 right-4 top-1/2">
                <svg class="w-5 h-5 text-blue-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <!-- Clear Button -->
            <button x-show="search.length > 0" @click="$wire.search = ''" type="button"
                class="absolute inset-y-0 flex items-center pr-3 right-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 hover:text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    @if ($search)
        <div class="mt-4 mb-6 text-lg font-semibold text-blue-400">
            Rezultate pentru: <span class="text-white">{{ $search }}</span>
        </div>
    @endif

    <div>
        @if ($searchResults !== null)
            @if ($searchResults->count() > 0)
                <div class="grid grid-cols-1 gap-6 mt-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($searchResults as $video)
                        <div
                            class="overflow-hidden transition-all duration-300 bg-gray-800/50 backdrop-blur border border-gray-700/30 rounded-xl group hover:scale-[1.02] hover:shadow-lg hover:shadow-blue-500/10">
                            <a href="{{ route('videos.show', $video) }}" class="block">
                                <div class="aspect-w-16 aspect-h-9">
                                    @if ($video->video_path)
                                        <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                            class="object-cover w-full h-full">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div
                                                class="flex items-center justify-center w-16 h-16 transition-transform duration-300 transform bg-blue-600 rounded-full opacity-80 group-hover:scale-110">
                                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @else
                                        {!! $video->embed_link !!}
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="mb-3 text-lg font-semibold text-white line-clamp-1">{{ $video->title }}
                                    </h3>
                                    {{-- <p
                                        class="flex items-center text-blue-400 transition-all duration-300 group-hover:text-blue-300">
                                        Vezi mai mult
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </p> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.879 7.519a1 1 0 00-1.442 1.386l4.764 4.764a1 1 0 001.442 0l4.764-4.764a1 1 0 00-1.442-1.386L14 10.586V6a1 1 0 00-2 0v4.586l-2.121-2.067zM19 16v3a2 2 0 01-2 2H7a2 2 0 01-2-2v-3" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 14h14" />
                    </svg>
                    <p class="text-xl font-medium text-gray-400">Nu s-au găsit rezultate pentru "{{ $search }}"
                    </p>
                    <p class="mt-2 text-gray-500">Încearcă alte cuvinte cheie sau verifică ortografia</p>
                </div>
            @endif
        @endif
    </div>
</div>
