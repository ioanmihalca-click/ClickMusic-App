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
                <div class="grid grid-cols-1 gap-8 mt-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($searchResults as $video)
                        <div class="relative group">
                            <!-- Efect gradient animat pentru border -->
                            <div
                                class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                            </div>

                            <!-- Card-ul principal -->
                            <div
                                class="relative flex flex-col overflow-hidden border border-gray-800 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                                <!-- Container Video -->
                                <div class="relative aspect-w-16 aspect-h-9">
                                    @if ($video->video_path)
                                        <a href="{{ route('videos.show', $video) }}" class="block">
                                            <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                                class="object-cover w-full h-full">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div
                                                    class="flex items-center justify-center w-16 h-16 transition-transform duration-300 transform bg-blue-600 rounded-full opacity-80 group-hover:scale-110">
                                                    @if ($video->isAudio())
                                                        <!-- Audio Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                        </svg>
                                                    @else
                                                        <!-- Video Icon -->
                                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ route('videos.show', $video) }}" class="block">
                                            {!! $video->embed_link !!}
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Conținut cu overlay doar pentru această secțiune -->
                                <div class="relative flex flex-col flex-grow">
                                    <!-- Overlay doar pentru secțiunea de conținut -->
                                    <div
                                        class="absolute inset-0 z-10 transition-opacity duration-300 bg-black/50 group-hover:opacity-0">
                                    </div>

                                    <!-- Conținutul efectiv -->
                                    <div class="relative z-20 p-5 space-y-3">
                                        <!-- Titlu cu trunchiere -->
                                        <h3
                                            class="text-lg font-bold leading-tight tracking-wide text-white transition-colors duration-300 line-clamp-1 group-hover:text-blue-400">
                                            {{ $video->title }}
                                        </h3>

                                        <!-- Informații suplimentare -->
                                        <div class="flex items-center space-x-3 text-sm text-gray-400">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $video->created_at->diffForHumans() }}
                                            </span>
                                            <a wire:navigate href="{{ route('videos.show', $video->id) }}"
                                                class="flex items-center px-2 py-1 text-xs font-medium text-white transition duration-200 ease-in-out rounded-md bg-blue-600/70 hover:bg-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Detalii
                                            </a>
                                        </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 mt-4 text-center bg-gray-900/80 backdrop-blur-sm border border-gray-800/50 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-blue-500/70" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.879 7.519a1 1 0 00-1.442 1.386l4.764 4.764a1 1 0 001.442 0l4.764-4.764a1 1 0 00-1.442-1.386L14 10.586V6a1 1 0 00-2 0v4.586l-2.121-2.067zM19 16v3a2 2 0 01-2 2H7a2 2 0 01-2-2v-3" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 14h14" />
                    </svg>
                    <p class="text-xl font-medium text-blue-400">Nu s-au găsit rezultate pentru "<span class="text-white">{{ $search }}</span>"
                    </p>
                    <p class="mt-2 text-gray-400">Încearcă alte cuvinte cheie sau verifică ortografia</p>
                </div>
            @endif
        @endif
    </div>
</div>
