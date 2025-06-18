<section class="relative">
    <!-- Background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header Section -->
    <div class="relative z-10 text-center mb-16">
        <div
            class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium text-blue-400 bg-blue-500/10 rounded-full border border-blue-500/20">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Blog Click Music
        </div>

        <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-white mb-6">
            Povești din
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-blue-600">
                Muzică
            </span>
        </h1>

        <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
            Descoperă articole, interviuri și povești din lumea hip-hop, reggae și soul
        </p>

        <div class="w-24 h-1 mx-auto mt-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
    </div>

    <!-- Articles Grid -->
    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @foreach ($posts as $post)
            <article class="blog-grid-item group">
                <div class="glass-effect rounded-2xl overflow-hidden h-full">
                    <a href="{{ route('blog.show', $post->slug) }}" class="block h-full">
                        @if ($post->featured_image)
                            <div class="relative overflow-hidden h-64">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <!-- Gradient overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent">
                                </div>

                                <!-- Date badge -->
                                <div class="absolute top-4 left-4">
                                    <time datetime="{{ $post->published_at->toDateString() }}"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-black/50 backdrop-blur-md rounded-full border border-white/20">
                                        {{ $post->published_at->format('d M Y') }}
                                    </time>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <h2
                                class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-blue-400 transition-colors duration-300">
                                {{ $post->title }}
                            </h2>

                            <p class="text-gray-400 text-sm line-clamp-3 mb-4 leading-relaxed">
                                {{ $post->summary }}
                            </p>

                            <!-- Read more link -->
                            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                <span
                                    class="text-sm font-medium text-blue-400 group-hover:text-blue-300 transition-colors duration-300">
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
    <div class="relative z-10 flex justify-center mb-16">
        <div class="glass-effect rounded-xl p-2">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Back to home -->
    <div class="relative z-10 text-center">
        <a href="/"
            class="inline-flex items-center px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-blue-500/25">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Înapoi acasă
        </a>
    </div>
</section>
