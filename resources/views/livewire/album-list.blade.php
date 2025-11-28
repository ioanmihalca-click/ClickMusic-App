<div class="container relative px-4 mb-32 mx-auto text-white">
    <!-- Enhanced Gradient Background with Animated Particles -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-blue-500/20 to-indigo-700/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/30"></div>
    </div>

    @if ($albums->count() > 0)
        <!-- Page Header -->
        <div class="relative mb-12 text-center">
            <h1
                class="mb-4 text-4xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-400 md:text-5xl">
                Albumele Mele
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-300">
                Descoperă colecția completă de albume și EP-uri
            </p>
        </div>

        <div class="relative grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($albums as $album)
                <div class="relative group">
                    <!-- Animated Border Effect -->
                    <div
                        class="absolute inset-0 transition-opacity duration-500 opacity-0 rounded-xl bg-gradient-to-r from-blue-500/50 via-sky-400/50 to-indigo-600/50 group-hover:opacity-100 blur-sm">
                    </div>

                    <div
                        class="relative p-[1px] bg-gradient-to-br from-blue-500/30 via-sky-400/30 to-indigo-600/30 rounded-xl transform transition-all duration-500 group-hover:scale-[1.02] group-hover:shadow-2xl group-hover:shadow-blue-500/25">
                        <div
                            class="relative flex flex-col h-full overflow-hidden bg-black/95 backdrop-blur-sm rounded-xl">
                            <!-- Album Cover with Enhanced Effects -->
                            <div class="relative overflow-hidden aspect-square">
                                <!-- Glow Effect Behind Image -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-indigo-600/20 blur-xl">
                                </div>

                                <img src="{{ $album->cover_url }}" alt="{{ $album->titlu }}"
                                    class="relative object-cover w-full h-full transition-all duration-700 group-hover:scale-110 group-hover:brightness-110">

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 group-hover:opacity-100">
                                </div>

                                <!-- Price Badge with Enhanced Design -->
                                <div
                                    class="absolute transition-all duration-300 transform bottom-4 right-4 group-hover:scale-110">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-blue-500 rounded-full blur-md"></div>
                                        <div
                                            class="relative px-4 py-2 border rounded-full bg-gradient-to-r from-blue-600 to-blue-700 border-blue-400/30 backdrop-blur-sm">
                                            <span class="text-sm font-bold text-white drop-shadow-lg">
                                                {{ number_format($album->pret, 2) }} RON
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Play Button Overlay -->
                                @if ($album->youtube_link)
                                    <div
                                        class="absolute inset-0 flex items-center justify-center transition-all duration-500 opacity-0 group-hover:opacity-100">
                                        <a href="{{ $album->youtube_link }}" target="_blank" rel="noopener noreferrer"
                                            class="p-4 transition-transform duration-500 transform scale-75 border rounded-full bg-white/20 backdrop-blur-md border-white/30 group-hover:scale-100 hover:bg-red-600/40">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Section with Enhanced Typography -->
                            <div class="flex flex-col flex-grow p-6 space-y-4">
                                <!-- Album Title with Glow Effect -->
                                <div class="space-y-2">
                                    <h3
                                        class="text-xl font-bold tracking-wider text-transparent uppercase transition-all duration-300 bg-clip-text bg-gradient-to-r from-white to-sky-200 group-hover:from-blue-300 group-hover:to-indigo-300">
                                        {{ $album->titlu }}
                                    </h3>
                                    <div
                                        class="w-12 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-500 group-hover:w-full">
                                    </div>
                                </div>

                                <!-- Description with Enhanced Styling -->
                                <p
                                    class="flex-grow leading-relaxed text-gray-400 transition-colors duration-300 group-hover:text-gray-300">
                                    {!! Str::limit($album->descriere, 100) !!}
                                </p>

                                <!-- Enhanced Action Button -->
                                <div class="pt-4 border-t border-white/10">
                                    <a href="{{ route('album.show', $album->slug) }}"
                                        class="relative inline-flex items-center justify-center w-full px-6 py-3 overflow-hidden text-sm font-semibold tracking-wider text-white uppercase transition-all duration-500 transform border rounded-lg group/btn border-blue-400/30 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-sky-500 focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-black hover:scale-105 active:scale-95">
                                        <!-- Button Background Effect -->
                                        <div
                                            class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-r from-blue-400 to-indigo-400 group-hover/btn:opacity-20">
                                        </div>

                                        <!-- Button Text -->
                                        <span class="relative flex items-center">
                                            Detalii Album
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/btn:translate-x-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Pagination -->
        {{-- <div class="relative mt-16">
            <div class="flex justify-center">
                <div class="p-4 border rounded-xl bg-black/50 backdrop-blur-sm border-white/10">
                    {{ $albums->links() }}
                </div>
            </div>
        </div> --}}
    @else
        <!-- Enhanced Empty State -->
        <div class="relative max-w-md mx-auto">
            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-blue-500/20 to-indigo-600/20 blur-xl">
            </div>
            <div class="relative p-12 text-center border rounded-2xl backdrop-blur-sm bg-black/40 border-white/20">
                <!-- Empty State Icon -->
                <div class="mb-6">
                    <div class="inline-flex p-4 rounded-full bg-gradient-to-br from-blue-500/20 to-indigo-600/20">
                        <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                            </path>
                        </svg>
                    </div>
                </div>

                <h3
                    class="mb-3 text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">
                    Nu există albume
                </h3>
                <p class="leading-relaxed text-gray-400">
                    Nu există albume disponibile momentan. Verifică din nou mai târziu pentru noutăți muzicale.
                </p>
            </div>
        </div>
    @endif
</div>
