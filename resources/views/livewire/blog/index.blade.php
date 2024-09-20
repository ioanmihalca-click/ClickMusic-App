<section class="px-4 py-12 mx-auto bg-black max-w-7xl sm:px-6 lg:px-8">
    <h1 class="mt-8 mb-12 text-4xl font-extrabold text-center text-blue-400 font-roboto-condensed">Articole pe Blog</h1>

    <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-3 perspective-1000">
        @foreach ($posts as $index => $post)
            <article class="overflow-hidden bg-gray-900 border border-blue-800 rounded-lg shadow-lg transition-all duration-500 ease-in-out transform-style-3d hover:shadow-blue-500/30
                @if($index === 0) md:rotate-y-30 md:hover:rotate-y-0
                @elseif($index === 1) center-card md:hover:translate-z-10
                @else md:-rotate-y-30 md:hover:rotate-y-0
                @endif">
                <a href="{{ route('blog.show', $post->slug) }}" class="block">
                    @if ($post->featured_image)
                        <div class="relative overflow-hidden aspect-w-16 aspect-h-9">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                class="object-cover w-full h-full transition-transform duration-300 hover:scale-110">
                        </div>
                    @endif
                    <div class="p-6">
                        <h2 class="mb-3 text-xl font-bold text-white line-clamp-2 font-roboto-condensed">
                            {{ $post->title }}
                        </h2>
                        <time datetime="{{ $post->published_at->toDateString() }}" class="block mb-3 text-sm text-gray-400">
                            {{ $post->published_at->format('j F Y') }}
                        </time>
                        <p class="mb-4 text-base text-gray-300 line-clamp-3">
                            {{ $post->summary }}
                        </p>
                        <span class="inline-block px-6 py-2 text-sm font-medium text-white transition-colors duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                            Citește mai mult
                        </span>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>

    <div class="mt-12 text-center">
        <a href="/" class="inline-flex items-center text-blue-400 transition-colors duration-300 hover:text-blue-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Pagina principală
        </a>
    </div>
</section>