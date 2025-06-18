{{-- show.blade.php --}}
<div class="relative py-12">
    <!-- Background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute rounded-full top-1/4 left-1/4 w-96 h-96 bg-blue-500/5 blur-3xl"></div>
        <div class="absolute rounded-full bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/5 blur-3xl"></div>
    </div>

    <!-- Main article container -->
    <div class="relative max-w-5xl px-4 mx-auto sm:px-6">
        <article class="overflow-hidden glass-effect rounded-3xl">
            <!-- Article header -->
            <header class="relative">
                @if ($post->featured_image)
                    <div class="relative h-auto overflow-hidden">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                            class="object-cover w-full h-full">

                        <!-- Gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/50 to-transparent">
                        </div>

                        <!-- Title in overlay -->
                        <div
                            class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-4 sm:left-6 md:left-8 right-4 sm:right-6 md:right-8">
                            <h1 class="font-bold leading-tight text-white text-md md:text-4xl ">
                                {{ $post->title }}
                            </h1>
                        </div>
                    </div>

                    <!-- Article meta below image -->
                    <div class="p-4 sm:p-6 md:p-8">
                        <div class="flex items-center mb-6">
                            <time datetime="{{ $post->published_at->toDateString() }}"
                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-300 border rounded-full sm:px-4 sm:py-2 sm:text-sm bg-slate-800/50 backdrop-blur-md border-slate-600/30">
                                <svg class="w-3 h-3 mr-1 sm:w-4 sm:h-4 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $post->published_at->format('d F Y') }}
                            </time>

                            <span
                                class="inline-flex items-center px-2 py-1 ml-2 text-xs font-medium text-blue-400 border rounded-full sm:px-4 sm:py-2 sm:ml-4 sm:text-sm bg-blue-500/20 backdrop-blur-md border-blue-500/30">
                                <svg class="w-3 h-3 mr-1 sm:w-4 sm:h-4 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                de Click
                            </span>
                        </div>
                    </div>
                @else
                    <div class="p-6 text-center sm:p-8 md:p-12">
                        <div class="flex items-center justify-center mb-6">
                            <time datetime="{{ $post->published_at->toDateString() }}"
                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-white border rounded-full sm:px-4 sm:py-2 sm:text-sm bg-black/50 backdrop-blur-md border-white/20">
                                <svg class="w-3 h-3 mr-1 sm:w-4 sm:h-4 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $post->published_at->format('d F Y') }}
                            </time>

                            <span
                                class="inline-flex items-center px-2 py-1 ml-2 text-xs font-medium text-blue-400 border rounded-full sm:px-4 sm:py-2 sm:ml-4 sm:text-sm bg-blue-500/20 backdrop-blur-md border-blue-500/30">
                                <svg class="w-3 h-3 mr-1 sm:w-4 sm:h-4 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                de Click
                            </span>
                        </div>

                        <h1 class="text-2xl font-bold leading-tight text-white sm:text-3xl md:text-4xl lg:text-5xl">
                            {{ $post->title }}
                        </h1>
                    </div>
                @endif
                <!-- Article content -->
                <div class="pb-4">
                    <div
                        class="prose prose-lg prose-invert max-w-none prose-headings:text-white prose-headings:font-bold prose-p:text-gray-300 prose-p:leading-relaxed prose-a:text-blue-400 prose-a:no-underline hover:prose-a:text-blue-300 prose-strong:text-white prose-strong:font-semibold prose-blockquote:border-l-blue-500 prose-blockquote:bg-blue-500/10 prose-code:text-blue-300 prose-code:bg-slate-800 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-pre:bg-slate-800 prose-pre:border prose-pre:border-slate-700 prose-ul:text-gray-300 prose-ol:text-gray-300 prose-li:text-gray-300">
                        {!! $post->body !!}
                    </div>

                    <!-- Share buttons -->
                    <div class="pt-8 mt-12 border-t border-white/10">
                        <h3
                            class="mb-4 text-sm font-medium text-gray-400 sm:mb-6 sm:text-lg sm:font-semibold sm:text-white">
                            Împărtășește această poveste</h3>
                        <div class="flex flex-wrap gap-2 sm:gap-4">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white transition-all duration-300 border rounded-lg border-blue-500/30 bg-blue-600/10 backdrop-blur-sm hover:bg-blue-600/20 hover:border-blue-400/50 sm:px-6 sm:py-3 sm:text-sm sm:bg-blue-600 sm:border-transparent sm:hover:bg-blue-700 sm:rounded-xl sm:shadow-lg sm:shadow-blue-500/25">
                                <svg class="w-3 h-3 mr-1 sm:w-5 sm:h-5 sm:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                <span class="hidden sm:inline">Facebook</span>
                                <span class="sm:hidden">FB</span>
                            </a>

                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white transition-all duration-300 border rounded-lg border-blue-600/30 bg-blue-700/10 backdrop-blur-sm hover:bg-blue-700/20 hover:border-blue-500/50 sm:px-6 sm:py-3 sm:text-sm sm:bg-blue-700 sm:border-transparent sm:hover:bg-blue-800 sm:rounded-xl sm:shadow-lg sm:shadow-blue-500/25">
                                <svg class="w-3 h-3 mr-1 sm:w-5 sm:h-5 sm:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                                <span class="hidden sm:inline">LinkedIn</span>
                                <span class="sm:hidden">LI</span>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title) }} - {{ urlencode(route('blog.show', $post->slug)) }}"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white transition-all duration-300 border rounded-lg border-green-500/30 bg-green-600/10 backdrop-blur-sm hover:bg-green-600/20 hover:border-green-400/50 sm:px-6 sm:py-3 sm:text-sm sm:bg-green-600 sm:border-transparent sm:hover:bg-green-700 sm:rounded-xl sm:shadow-lg sm:shadow-green-500/25">
                                <svg class="w-3 h-3 mr-1 sm:w-5 sm:h-5 sm:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                                <span class="hidden sm:inline">WhatsApp</span>
                                <span class="sm:hidden">WA</span>
                            </a>
                        </div>
                        <!-- Navigation and Newsletter -->
                        <div class="pt-8 mt-12 border-t border-white/10">
                            <!-- Back to blog button -->
                            <div class="mb-12">
                                <a href="{{ route('blog.index') }}"
                                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-slate-600 to-slate-700 rounded-xl hover:from-slate-700 hover:to-slate-800 hover:scale-105 shadow-slate-500/25">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Înapoi la Blog
                                </a>
                            </div>

                            <!-- Newsletter signup -->
                            <div
                                class="p-4 border bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-2xl sm:p-6 md:p-8 border-blue-500/20">
                                @if (session('success'))
                                    <div
                                        class="p-4 mb-6 text-green-400 border rounded-lg bg-green-900/50 border-green-500/30">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div
                                        class="p-4 mb-6 text-red-400 border rounded-lg bg-red-900/50 border-red-500/30">
                                        <ul class="space-y-1 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-8 text-center">
                                    <h3 class="mb-4 text-2xl font-bold text-white">
                                        🎵 Rămâi la curent cu Click Music
                                    </h3>
                                    <p class="max-w-lg mx-auto text-gray-300">
                                        Primește notificări despre cele mai recente piese, albume și videoclipuri direct
                                        în inbox-ul tău.
                                    </p>
                                </div>

                                <form action="{{ route('newsletter.subscribe') }}" method="POST"
                                    class="max-w-md mx-auto">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-300">
                                                Numele tău
                                            </label>
                                            <input id="name" name="name" type="text" required
                                                class="w-full px-4 py-3 text-white placeholder-gray-400 transition-colors border bg-slate-800/80 border-slate-600 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50"
                                                placeholder="Introdu numele tău">
                                        </div>

                                        <div>
                                            <label for="email-address"
                                                class="block mb-2 text-sm font-medium text-gray-300">
                                                Adresa de email
                                            </label>
                                            <input id="email-address" name="email" type="email" required
                                                class="w-full px-4 py-3 text-white placeholder-gray-400 transition-colors border bg-slate-800/80 border-slate-600 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50"
                                                placeholder="adresa@exemplu.ro">
                                        </div>

                                        <button type="submit"
                                            class="w-full px-6 py-3 text-sm font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 shadow-blue-500/25">
                                            🚀 Abonează-te acum
                                        </button>
                                    </div>

                                    <p class="mt-4 text-sm text-center text-gray-400">
                                        Citind <a href="{{ route('privacy-policy') }}"
                                            class="text-blue-400 underline hover:text-blue-300">
                                            politica de confidențialitate</a>, ești de acord cu procesarea datelor.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
        </article>

        <!-- Recommended articles -->
        @if ($recommendedPosts->isNotEmpty())
            <section class="mt-16">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-white">
                        Mai multe povești
                    </h2>
                    <p class="max-w-lg mx-auto text-gray-400">
                        Alte articole care te-ar putea interesa din lumea muzicii
                    </p>
                    <div class="w-16 h-1 mx-auto mt-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3 md:gap-8">
                    @foreach ($recommendedPosts as $post)
                        <article class="blog-grid-item group">
                            <div class="h-full overflow-hidden glass-effect rounded-2xl">
                                <a href="{{ route('blog.show', $post->slug) }}" class="block h-full">
                                    @if ($post->featured_image)
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                alt="{{ $post->title }}"
                                                class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">

                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent">
                                            </div>

                                            <div class="absolute top-4 left-4">
                                                <time datetime="{{ $post->published_at->toDateString() }}"
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-white border rounded-full sm:px-3 sm:py-1 bg-black/50 backdrop-blur-md border-white/20">
                                                    {{ $post->published_at->format('d M') }}
                                                </time>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        <h3
                                            class="mb-3 text-lg font-bold text-white transition-colors duration-300 line-clamp-2 group-hover:text-blue-400">
                                            {{ $post->title }}
                                        </h3>

                                        <p class="mb-4 text-sm text-gray-400 line-clamp-2">
                                            {{ $post->summary }}
                                        </p>

                                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                            <span
                                                class="text-sm font-medium text-blue-400 transition-colors duration-300 group-hover:text-blue-300">
                                                Citește
                                            </span>
                                            <svg class="w-4 h-4 text-blue-400 transition-transform duration-300 group-hover:translate-x-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Back to all articles -->
        <div class="relative mt-16 text-center">
            <a href="{{ route('blog.index') }}"
                class="inline-flex items-center px-8 py-4 text-sm font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 shadow-blue-500/25">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Toate articolele
            </a>
        </div>
    </div>
</div>
