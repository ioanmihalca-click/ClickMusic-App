<div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($recentVideos as $video)
        <div class="relative group">
            <!-- Efect gradient animat pentru border -->
            <div
                class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
            </div>

            <!-- Card-ul principal -->
            <div
                class="relative flex flex-col overflow-hidden border border-gray-800 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <!-- Container Video - fără overlay -->
                <div class="relative aspect-w-16 aspect-h-9">
                    @if ($video->video_path)
                        <a href="{{ route('videos.show', $video) }}" class="block w-full h-full">
                            <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                class="object-cover w-full h-full">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div
                                    class="flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full opacity-80">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @else
                        {!! $video->embed_link !!}
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
                        </div>

                        <!-- Link "Vezi mai mult" -->
                        <a href="{{ route('videos.show', $video) }}"
                            class="inline-flex items-center text-sm font-medium text-blue-400 transition-all duration-300 group-hover:text-blue-300">
                            <span
                                class="relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-0 after:bg-blue-300 after:transition-all after:duration-300 group-hover:after:w-full">
                                Vezi mai mult
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
