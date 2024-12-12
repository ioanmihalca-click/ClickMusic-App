<div class="container relative px-4 mx-auto text-white">
    <!-- Gradient ambient în fundal -->
    <div class="absolute inset-0 blur-3xl opacity-30">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-blue-800"></div>
    </div>

    @if ($albums->count() > 0)
        <div class="relative grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($albums as $album)
                <div
                    class="group relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl">
                    <div class="relative flex flex-col h-full overflow-hidden rounded-lg bg-black/90">
                        <!-- Imagine Album -->
                        <div class="relative overflow-hidden aspect-square">
                            <img src="{{ $album->cover_url }}" alt="{{ $album->titlu }}"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">

                            <!-- Badge preț -->
                            <div class="absolute px-4 py-2 rounded-full top-4 right-4 bg-blue-500/80 backdrop-blur-sm">
                                <span class="font-bold text-sm text-white">
                                    {{ number_format($album->pret, 2) }} RON
                                </span>
                            </div>
                        </div>

                        <!-- Conținut -->
                        <div class="flex flex-col flex-grow p-6 space-y-4">
                            <h3 class="text-xl font-bold tracking-wider text-white uppercase">
                                {{ $album->titlu }}
                            </h3>

                            <p class="flex-grow text-gray-400">
                                {!! Str::limit($album->descriere, 100) !!}
                            </p>

                            <!-- Buton Detalii -->
                            <div class="pt-4 border-t border-white/10">
                                <a href="{{ route('album.show', $album->slug) }}"
                                    class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-black">
                                    Detalii Album
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginare -->
        <div class="relative mt-12">
            {{ $albums->links() }}
        </div>
    @else
        <div class="relative p-12 text-center border rounded-xl backdrop-blur-sm bg-black/30 border-white/10">
            <p class="text-xl text-gray-400">Nu există albume disponibile momentan.</p>
        </div>
    @endif
</div>
