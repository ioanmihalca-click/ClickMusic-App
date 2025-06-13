<x-app-layout>
    <div class="min-h-screen py-12 bg-gradient-to-t from-black via-purple-900/55 to-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">


            <!-- Video Player Section -->
            <div
                class="relative max-w-5xl mx-auto overflow-hidden border bg-gray-900/50 backdrop-blur-sm rounded-xl border-gray-800/30">
                <!-- Video Player Container -->
                <div class="aspect-w-16 aspect-h-9">
                    @if ($video->video_path)
                        <video class="w-full h-full" controls controlsList="nodownload"
                            src="{{ route('videos.stream', $video->id) }}" poster="{{ $video->thumbnail_url_full }}">
                            Browserul dvs. nu suportă redarea de videoclipuri.
                        </video>
                    @else
                        {!! $video->embed_link !!}
                    @endif
                </div>

                <!-- Controls Bar -->
                <div class="relative p-2 border-t border-gray-700/30">
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-700">
                        <div class="w-1/3 h-full bg-blue-500"></div>
                    </div>

                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            @livewire('videos.like', ['video' => $video])

                            {{-- <a href="https://www.paypal.me/ClickMusic" 
                               class="inline-flex items-center px-3 py-1 text-xs font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-1" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.35.35 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91q.57-.403.993-1.005a4.94 4.94 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.7 2.7 0 0 0-.76-.59l-.094-.061Z"/>
                                </svg>
                                PayPal
                            </a>

                            <a href="https://revolut.me/clickmusic" 
                               class="inline-flex items-center px-3 py-1 text-xs font-medium text-white transition-all duration-300 rounded-lg bg-emerald-600 hover:bg-emerald-700">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5"/>
                                </svg>
                                Revolut
                            </a> --}}
                        </div>

                        {{-- <button class="p-1.5 text-gray-400 transition-all duration-300 rounded-full hover:text-white hover:bg-gray-700">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                        </button> --}}
                    </div>
                </div>
            </div>

            <!-- Video Info & Comments -->
            <div class="max-w-5xl mx-auto mt-8">
                <div class="p-6 border bg-gray-900/50 backdrop-blur-sm rounded-xl border-gray-800/30">
                    <h1 class="mb-4 text-xl font-bold text-white">{{ $video->title }}</h1>
                    <p class="mb-8 text-gray-400">{!! nl2br($video->description) !!}</p>

                    <!-- Recommendations -->
                    <div class="mb-8">
                        <h2 class="mb-4 text-lg font-semibold text-blue-400">Videoclipuri Similare</h2>
                        @livewire('video-recommendations', ['video' => $video])
                    </div>

                    <!-- Comments -->
                    {{-- <div class="pt-6 border-t border-gray-800/50">
                        <h2 class="mb-4 text-lg font-semibold text-blue-400">Comentarii</h2>
                        @livewire('comments.all-comments', ['videoId' => $video->id])
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
