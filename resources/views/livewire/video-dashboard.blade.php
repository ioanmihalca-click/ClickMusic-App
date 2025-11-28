<div>
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($videos as $video)
            <div class="relative">
                <!-- Card-ul principal -->
                <a href="{{ $userIsPremium ? route('videos.show', $video->id) : route('abonament') . '?video=' . $video->id }}"
                   wire:navigate
                   class="block relative flex flex-col overflow-hidden bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5 transition-all duration-300 hover:border-blue-500/20">
                    <!-- Container Video -->
                    <div class="relative aspect-w-16 aspect-h-9">
                        @if ($video->video_path)
                            <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                class="object-cover w-full h-full">
                        @else
                            <!-- Video embed extern - afișăm thumbnail în loc de iframe -->
                            <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                class="object-cover w-full h-full {{ !$userIsPremium ? 'opacity-50' : '' }}">
                        @endif

                        <!-- Overlay pentru utilizatorii gratuiți -->
                        @if (!$userIsPremium)
                            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm flex flex-col items-center justify-center">
                                <div class="bg-gradient-to-br from-gray-900/90 via-slate-900/80 to-blue-950/50 backdrop-blur-xl p-3 md:p-5 rounded-xl max-w-[90%] md:max-w-[80%] text-center border border-white/10">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 md:h-10 md:w-10 text-blue-400 mx-auto mb-2 md:mb-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <h3 class="text-base md:text-lg font-semibold text-white mb-1">Conținut Premium</h3>
                                    <p class="text-gray-300 text-xs md:text-sm mb-2 md:mb-3">Pentru a viziona ai nevoie de un abonament Premium</p>
                                    <span class="bg-blue-600 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg text-xs md:text-sm font-medium inline-block">
                                        Abonează-te acum
                                    </span>
                                </div>
                            </div>
                        @else
                            <!-- Play button pentru utilizatorii premium -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex items-center justify-center w-16 h-16 transition-opacity duration-300 bg-blue-600 rounded-full opacity-80 hover:opacity-100">
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
                        @endif
                    </div>

                    <!-- Conținut -->
                    <div class="relative flex flex-col flex-grow">
                        <div class="relative p-5 space-y-3">
                            <!-- Titlu -->
                            <h3 class="text-lg font-bold leading-tight tracking-wide text-white transition-colors duration-300 line-clamp-1 hover:text-blue-400">
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
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
