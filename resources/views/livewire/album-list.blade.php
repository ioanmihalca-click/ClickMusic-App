<div class="container px-4 mx-auto text-white">
    @if($albums->count() > 0)
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($albums as $album)
                <div class="relative overflow-hidden transition-all duration-300 transform bg-black border border-blue-500 rounded-lg shadow-lg group hover:scale-105">
                    <!-- Overlay gradient pentru hover -->
                    <div class="absolute inset-0 z-10 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black via-black/50 to-transparent group-hover:opacity-100"></div>
                    
                    <!-- Imagine album -->
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ $album->cover_url }}" 
                             alt="{{ $album->titlu }}"
                             class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    </div>
                    
                    <!-- Conținut -->
                    <div class="relative z-20 p-6">
                        <h3 class="mb-3 text-xl font-bold tracking-wider text-white uppercase transition-colors duration-300 font-roboto-condensed group-hover:text-blue-400">
                            {{ $album->titlu }}
                        </h3>
                        
                        <!-- Descriere care apare la hover -->
                        <div class="transition-all duration-300 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100">
                            <p class="mb-4 text-sm text-gray-300">
                                {!! Str::limit($album->descriere, 100) !!}
                            </p>
                            
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-lg font-semibold text-blue-400">
                                    {{ number_format($album->pret, 2) }} RON
                                </span>
                                <a href="{{ route('album.show', $album->slug) }}"
                                   class="px-6 py-2 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 border border-blue-500 rounded-full hover:bg-blue-500 hover:text-white font-roboto-condensed">
                                    Detalii
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Paginare stilizată -->
        <div class="mt-8">
            {{ $albums->links() }}
        </div>
    @else
        <div class="p-8 text-center">
            <p class="text-xl text-gray-400">Nu există albume disponibile momentan.</p>
        </div>
    @endif
</div>