<section class="relative py-8">
    <!-- Background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute rounded-full top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 blur-3xl"></div>
        <div class="absolute rounded-full bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 blur-3xl"></div>
    </div>

    <!-- Main container with consistent padding -->
    <div class="relative z-10 max-w-5xl px-4 mx-auto sm:px-6">
        <!-- Header Section -->
        <div class="mb-16 text-center">
            <div
                class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium text-blue-400 border rounded-full bg-blue-500/10 border-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Blog Click Music
            </div>

            <h1 class="mb-6 text-5xl font-bold tracking-tight text-white md:text-6xl">
                Povești din
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-blue-600">
                    Muzică
                </span>
            </h1>

            <p class="max-w-2xl mx-auto text-xl leading-relaxed text-gray-400">
                Descoperă articole, interviuri și povești din lumea hip-hop, reggae și soul
            </p>

            <div class="w-24 h-1 mx-auto mt-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 gap-6 mb-16 md:grid-cols-2 lg:grid-cols-3 xl:gap-8">
            @foreach ($posts as $post)
                <article class="blog-grid-item group">
                    <div class="h-full overflow-hidden glass-effect rounded-2xl">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block h-full">
                            @if ($post->featured_image)
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">

                                    <!-- Gradient overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent">
                                    </div>

                                    <!-- Date badge -->
                                    <div class="absolute top-4 left-4">
                                        <time datetime="{{ $post->published_at->toDateString() }}"
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-white border rounded-full bg-black/50 backdrop-blur-md border-white/20">
                                            {{ $post->published_at->format('d M Y') }}
                                        </time>
                                    </div>
                                </div>
                            @endif

                            <div class="p-4 sm:p-6">
                                <h2
                                    class="mb-3 text-xl font-bold text-white transition-colors duration-300 line-clamp-2 group-hover:text-blue-400">
                                    {{ $post->title }}
                                </h2>

                                <p class="mb-4 text-sm leading-relaxed text-gray-400 line-clamp-3">
                                    {{ $post->summary }}
                                </p>

                                <!-- Read more link -->
                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <span
                                        class="text-sm font-medium text-blue-400 transition-colors duration-300 group-hover:text-blue-300">
                                        Citește articolul
                                    </span>
                                    <svg class="w-5 h-5 text-blue-400 transition-transform duration-300 group-hover:translate-x-2"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mb-16">
            <div class="p-2 glass-effect rounded-xl">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Back to home -->
        <div class="text-center">
            <a href="/"
                class="inline-flex items-center px-8 py-4 text-sm font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 shadow-blue-500/25">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Înapoi acasă
            </a>
        </div>
    </div>
</section>
