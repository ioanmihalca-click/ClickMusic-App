<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <!-- Left Column - Video Player Section -->
                <div class="lg:col-span-8">
                    <div
                        class="overflow-hidden shadow-xl bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                        <!-- Media Player Container -->
                        <div class="relative aspect-w-16 aspect-h-9">
                            @if (isset($showUpsell) && $showUpsell)
                                <!-- Upsell Overlay for Free Users -->
                                <livewire:video-upsell-overlay :videoId="$video->id" />
                            @endif

                            @if ($video->video_path)
                                @if ($video->isAudio())
                                    <!-- Audio Player with Thumbnail Background -->
                                    <div class="relative flex items-center justify-center w-full h-full bg-center bg-cover"
                                        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ $video->thumbnail_url_full }}') center center no-repeat; background-size: cover;">
                                        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
                                        <div
                                            class="relative z-10 w-full max-w-md px-8 py-4 bg-black/30 rounded-xl backdrop-blur-md">
                                            <div class="flex items-center justify-center mb-3">
                                                <span
                                                    class="text-sm font-medium text-white/80">{{ $video->title }}</span>
                                            </div>
                                            <audio class="w-full" controls controlsList="nodownload"
                                                src="{{ route('videos.stream', $video->id) }}">
                                                Browserul dvs. nu suportă redarea de fișiere audio.
                                            </audio>
                                        </div>
                                    </div>
                                @else
                                    <!-- Video Player -->
                                    <video class="object-cover w-full h-full" controls controlsList="nodownload"
                                        src="{{ route('videos.stream', $video->id) }}"
                                        poster="{{ $video->thumbnail_url_full }}">
                                        Browserul dvs. nu suportă redarea de videoclipuri.
                                    </video>
                                @endif
                            @else
                                <div class="w-full h-full">
                                    {!! $video->embed_link !!}
                                </div>
                            @endif
                        </div>

                        <!-- Controls Bar -->
                        <div class="border-t border-white/10">
                            <!-- Progress Bar -->
                            {{-- <div class="relative h-1 bg-gray-700/50">
                                <div class="w-1/3 h-full rounded-full bg-gradient-to-r from-blue-500 to-purple-500">
                                </div>
                            </div> --}}

                            <div class="flex items-center justify-between p-4">
                                <div class="flex items-center space-x-3">
                                    <!-- Like Button -->
                                    <div class="group">
                                        @livewire('videos.like', ['video' => $video])
                                    </div>

                                    <!-- Share Button -->
                                    {{-- <button
                                        class="flex items-center text-gray-300 hover:text-white transition-all duration-300 rounded-full p-1.5 hover:bg-purple-600/20 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                        <span
                                            class="ml-1.5 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity">Distribuie</span>
                                    </button> --}}
                                </div>

                                <!-- Support Buttons -->
                                {{-- <div class="flex items-center space-x-2 text-xs md:text-base">
                                    <a href="https://www.paypal.me/ClickMusic"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-sm shadow-blue-600/20">
                                        <svg class="w-4 h-4 mr-1.5" viewBox="0 0 16 16" fill="currentColor">
                                            <path
                                                d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.35.35 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91q.57-.403.993-1.005a4.94 4.94 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.7 2.7 0 0 0-.76-.59l-.094-.061Z" />
                                        </svg>
                                        PayPal
                                    </a>

                                    <a href="https://revolut.me/clickmusic"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white transition-all duration-300 bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-lg hover:from-emerald-700 hover:to-emerald-800 shadow-sm shadow-emerald-600/20">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5" />
                                        </svg>
                                        Revolut
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Video Info -->
                    <div
                        class="p-6 mt-6 shadow-xl bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                        <h1 class="mb-2 text-2xl font-bold text-white">{{ $video->title }}</h1>

                        <div class="flex items-center mb-6 space-x-3 text-sm text-gray-400">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $video->created_at->format('d M Y') }}</span>
                            </div>

                            @if (isset($video->views_count))
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ number_format($video->views_count) }} vizualizări</span>
                                </div>
                            @endif
                        </div>

                        <div class="prose prose-invert max-w-none">
                            <p class="leading-relaxed text-gray-300">{!! nl2br($video->description) !!}</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div
                        class="p-6 mt-6 shadow-xl bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                        <h2 class="flex items-center mb-4 text-xl font-semibold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Comentarii
                        </h2>
                        @if($video->usesForumComments())
                            {{-- Videoclipuri noi - folosesc sistemul forum --}}
                            @livewire('comments.video-forum-comments', ['video' => $video])
                        @else
                            {{-- Videoclipuri vechi - folosesc sistemul clasic --}}
                            @livewire('comments.all-comments', ['videoId' => $video->id])
                        @endif
                    </div>
                </div>

                <!-- Right Sidebar - Recommendations -->
                <div class="lg:col-span-4">
                    <div
                        class="sticky p-6 shadow-xl top-20 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                        <h2 class="flex items-center mb-4 text-xl font-semibold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Videoclipuri Recomandate
                        </h2>
                        @livewire('video-recommendations', ['video' => $video])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
