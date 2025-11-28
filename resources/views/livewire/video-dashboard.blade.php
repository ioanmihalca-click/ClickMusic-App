<div>
    <!-- Video playback modal -->
    <div x-data="{
        open: false,
        videoId: null,
        videoPath: null,
        videoTitle: null,
        videoDescription: null,
        isAudio: false,
        embedLink: null,
        thumbnailUrl: null,
        playMedia(id, path, title, description, isAudio, embedLink, thumbnail) {
            this.videoId = id;
            this.videoPath = path;
            this.videoTitle = title;
            this.videoDescription = description;
            this.isAudio = isAudio;
            this.embedLink = embedLink;
            this.thumbnailUrl = thumbnail;
            this.open = true;
        }
    }">
        <!-- The modal -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-cloak
            @click="open = false; if ($refs.videoPlayer) $refs.videoPlayer.pause(); if ($refs.audioPlayer) $refs.audioPlayer.pause();">
            <div class="relative w-full max-w-5xl bg-gradient-to-br from-gray-900/95 via-slate-900/90 to-blue-950/50 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5" @click.stop>
                <!-- Premium Content Overlay for free users -->
                @if (!$userIsPremium)
                    <div
                        class="absolute inset-0 z-50 flex items-center justify-center bg-black/95 rounded-xl backdrop-blur-md">
                        <div class="w-full max-w-lg p-6 space-y-4 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                            <h3 class="text-xl font-bold text-blue-400">Acces Limitat</h3>

                            <div class="p-4 my-4 border-l-4 border-blue-400 bg-blue-900/20">
                                <p class="text-lg text-gray-200">
                                    Pentru a asculta sau viziona acest conținut ai nevoie de un <span
                                        class="font-bold text-blue-400">abonament Premium</span>.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 pt-4">
                                <a href="{{ route('abonament') }}"
                                    class="w-full px-6 py-3 text-white text-center transition duration-150 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    <span class="font-medium">Abonează-te Acum</span>
                                </a>

                                <button @click="open = false"
                                    class="w-full px-6 py-3 text-white transition duration-150 border border-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                                    <span>Închide</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Close button -->
                <button
                    @click="open = false; if ($refs.videoPlayer) $refs.videoPlayer.pause(); if ($refs.audioPlayer) $refs.audioPlayer.pause();"
                    class="absolute z-10 p-2 text-gray-400 transition-colors duration-300 rounded-full bg-gray-900/80 -right-3 -top-3 hover:text-white hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Media container -->
                <div class="aspect-w-16 aspect-h-9">
                    <!-- Video player -->
                    <template x-if="videoPath && !isAudio">
                        <video x-ref="videoPlayer" class="w-full h-full" controls controlsList="nodownload"
                            :src="`/videos/stream/${videoId}`" :poster="thumbnailUrl">
                            Browserul dvs. nu suportă redarea de videoclipuri.
                        </video>
                    </template>

                    <!-- Audio player with thumbnail background -->
                    <template x-if="videoPath && isAudio">
                        <div class="relative flex items-center justify-center w-full h-full"
                            :style="'background: url(' + thumbnailUrl + ') center center; background-size: cover;'">
                            <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
                            <div class="relative z-10 w-full max-w-md px-4">
                                <audio x-ref="audioPlayer" class="w-full" controls controlsList="nodownload"
                                    :src="`/videos/stream/${videoId}`">
                                    Browserul dvs. nu suportă redarea de fișiere audio.
                                </audio>
                            </div>
                        </div>
                    </template>

                    <!-- Embedded iframe -->
                    <template x-if="!videoPath && embedLink">
                        <div x-html="embedLink"></div>
                    </template>
                </div> <!-- Video info -->
                <div class="p-6">
                    <h2 x-text="videoTitle" class="mb-4 text-xl font-bold text-white"></h2>
                    <div x-html="videoDescription" class="text-gray-400"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videos as $video)
                <div class="relative">
                    <!-- Card-ul principal -->
                    <div
                        class="relative flex flex-col overflow-hidden bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5 transition-all duration-300 hover:border-blue-500/20">
                        <!-- Container Video - fără overlay -->
                        <div class="relative aspect-w-16 aspect-h-9">
                            @if ($video->video_path)
                                <!-- Condiționăm click-ul pe baza statutului utilizatorului -->
                                <div class="block w-full h-full cursor-pointer"
                                    @if ($userIsPremium) @click="playMedia({{ $video->id }}, '{{ $video->video_path }}', '{{ addslashes($video->title) }}', `{!! addslashes(nl2br($video->description)) !!}`, {{ $video->isAudio() ? 'true' : 'false' }}, null, '{{ $video->thumbnail_url_full }}')"
                                    @else
                                        @click="window.location.href='{{ route('abonament') }}?video={{ $video->id }}'" @endif>
                                    <img src="{{ $video->thumbnail_url_full }}" alt="{{ $video->title }}"
                                        class="object-cover w-full h-full">

                                    <!-- Overlay pentru utilizatorii gratuiți -->
                                    @if (!$userIsPremium)
                                        <div
                                            class="absolute inset-0 bg-black/70 backdrop-blur-sm flex flex-col items-center justify-center opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300">
                                            <div
                                                class="bg-gradient-to-br from-gray-900/90 via-slate-900/80 to-blue-950/50 backdrop-blur-xl p-3 md:p-5 rounded-xl max-w-[90%] md:max-w-[80%] text-center transform translate-y-0 md:translate-y-4 md:group-hover:translate-y-0 transition-all duration-300 border border-white/10">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-8 w-8 md:h-10 md:w-10 text-blue-400 mx-auto mb-2 md:mb-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                <h3 class="text-base md:text-lg font-semibold text-white mb-1">Conținut
                                                    Premium</h3>
                                                <p class="text-gray-300 text-xs md:text-sm mb-2 md:mb-3">Pentru a
                                                    asculta acest conținut ai
                                                    nevoie de un abonament Premium</p>
                                                <button
                                                    class="bg-blue-600 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg text-xs md:text-sm font-medium hover:bg-blue-700">
                                                    Abonează-te acum
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div
                                            class="flex items-center justify-center w-16 h-16 transition-opacity duration-300 bg-blue-600 rounded-full opacity-80 hover:opacity-100">
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
                                </div>
                            @else
                                <!-- Video embed extern -->
                                <div class="w-full h-full cursor-pointer"
                                    @if ($userIsPremium) @click="playMedia({{ $video->id }}, null, '{{ addslashes($video->title) }}', `{!! addslashes(nl2br($video->description)) !!}`, false, `{!! addslashes($video->embed_link) !!}`, '{{ $video->thumbnail_url_full }}')"
                                    @else
                                        @click="window.location.href='{{ route('abonament') }}?video={{ $video->id }}'" @endif>
                                    <!-- Overlay pentru videoclipurile embed pentru utilizatorii gratuiți -->
                                    @if (!$userIsPremium)
                                        <div
                                            class="absolute inset-0 z-10 bg-black/70 backdrop-blur-sm flex items-center justify-center opacity-100 md:opacity-0 md:group-hover:opacity-100 md:transition-opacity md:duration-300">
                                            <div
                                                class="bg-gradient-to-br from-gray-900/90 via-slate-900/80 to-blue-950/50 backdrop-blur-xl p-3 md:p-5 rounded-xl max-w-[90%] md:max-w-[80%] text-center border border-white/10">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-8 w-8 md:h-10 md:w-10 text-blue-400 mx-auto mb-2 md:mb-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                <h3 class="text-base md:text-lg font-semibold text-white mb-1">Conținut
                                                    Premium</h3>
                                                <p class="text-gray-300 text-xs md:text-sm mb-2 md:mb-3">Pentru a
                                                    asculta sau viziona
                                                    acest conținut ai nevoie de un abonament Premium</p>
                                                <a href="{{ route('abonament') }}"
                                                    class="bg-blue-600 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg text-xs md:text-sm font-medium hover:bg-blue-700 inline-block">
                                                    Abonează-te acum
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Afisăm iframe-ul dar este acoperit de overlay pentru utilizatorii free -->
                                    <div class="relative {{ !$userIsPremium ? 'opacity-30' : '' }}">
                                        {!! $video->embed_link !!}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Conținut -->
                        <div class="relative flex flex-col flex-grow">
                            <!-- Conținutul efectiv -->
                            <div class="relative p-5 space-y-3">
                                <!-- Titlu cu trunchiere -->
                                <h3
                                    class="text-lg font-bold leading-tight tracking-wide text-white transition-colors duration-300 line-clamp-1 hover:text-blue-400">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Detalii
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
