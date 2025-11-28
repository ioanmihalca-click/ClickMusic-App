<div>
    <div class="space-y-4">
        @forelse ($videos as $recommendedVideo)
            <div
                class="overflow-hidden transition-all duration-300 glass-card group hover:shadow-cyan-500/20">
                <a href="{{ route('videos.show', $recommendedVideo->id) }}" class="block">
                    <div class="flex flex-row items-center">
                        <!-- Thumbnail -->
                        <div class="relative w-1/3">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ $recommendedVideo->thumbnail_url_full }}"
                                    alt="{{ $recommendedVideo->title }}" class="object-cover w-full h-full rounded-l-lg">
                                @if ($recommendedVideo->isAudio())
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                        </svg>
                                    </div>
                                @else
                                    <div
                                        class="absolute inset-0 flex items-center justify-center transition-opacity opacity-0 bg-black/30 group-hover:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="w-2/3 p-3">
                            <h4
                                class="text-sm font-medium text-white transition-colors line-clamp-2 group-hover:text-cyan-300">
                                {{ $recommendedVideo->title }}
                            </h4>

                            @if ($recommendedVideo->created_at)
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $recommendedVideo->created_at->format('d M Y') }}
                                </div>
                            @endif

                            {{-- <!-- Buton Detalii -->
                            @if ($recommendedVideo->video_path)
                                <div class="mt-3">
                                    <a href="{{ route('videos.stream', $recommendedVideo->id) }}" 
                                       class="inline-flex items-center px-3 py-1 text-xs font-medium text-white transition-all duration-300 rounded-md bg-cyan-600/70 hover:bg-cyan-500/80">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Detalii
                                    </a>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="p-4 text-center text-gray-400">
                <p>Nu există videoclipuri recomandate momentan.</p>
            </div>
        @endforelse
    </div>
</div>
