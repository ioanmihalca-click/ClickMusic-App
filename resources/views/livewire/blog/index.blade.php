<section class="relative px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Gradient ambient în fundal -->
    <div class="absolute inset-0 blur-3xl opacity-30">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-blue-800"></div>
    </div>

    <!-- Header -->
    <div class="relative z-10 my-12">
        <h1 class="text-4xl font-bold tracking-[0.2em] text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed text-center">
            Articole pe Blog
        </h1>
        <div class="w-24 h-1 mx-auto mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
    </div>

    <!-- Grid de articole -->
    <div class="relative grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <article class="group">
                <!-- Card cu gradient border -->
                <div class="relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl overflow-hidden">
                    <div class="relative flex flex-col h-full overflow-hidden bg-black/90 backdrop-blur-sm rounded-xl">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block">
                            @if ($post->featured_image)
                                <div class="relative overflow-hidden aspect-video">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}"
                                         class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                    
                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60"></div>
                                </div>
                            @endif

                            <div class="p-6">
                                <time datetime="{{ $post->published_at->toDateString() }}"
                                      class="block mb-3 text-sm text-blue-400">
                                    {{ $post->published_at->format('j F Y') }}
                                </time>

                                <h2 class="text-2xl font-bold tracking-wide text-white transition-colors duration-300 line-clamp-2 group-hover:text-blue-400">
                                    {{ $post->title }}
                                </h2>

                                <p class="mt-3 text-gray-400 line-clamp-3">
                                    {{ $post->summary }}
                                </p>

                                <!-- Citește mai mult -->
                                <div class="pt-4 mt-6 border-t border-white/10">
                                    <span class="inline-flex items-center text-sm font-semibold tracking-wider text-blue-400 uppercase transition-colors duration-300 group-hover:text-blue-500">
                                        Citește mai mult
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-2" 
                                             fill="none" 
                                             stroke="currentColor" 
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" 
                                                  stroke-linejoin="round" 
                                                  stroke-width="2" 
                                                  d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Paginare -->
    <div class="relative mt-12">
        {{ $posts->links() }}
    </div>

    <!-- Link către pagina principală -->
    <div class="relative mt-12 text-center">
        <a href="/" class="inline-flex items-center px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 border rounded-lg bg-blue-600/30 hover:bg-blue-500 backdrop-blur-sm border-blue-400/30 hover:border-blue-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Pagina principală
        </a>
    </div>
</section>