<div class="py-16">
    <!-- Container principal cu gradient ambient -->
    <div class="relative max-w-4xl mx-auto">
        <!-- Gradient animat de fundal -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[conic-gradient(from_0deg,#3b82f6,#8b5cf6,#3b82f6)] blur-3xl opacity-30 animate-spin-slow"></div>
        </div>

        <!-- Articol principal -->
        <article class="relative">
            <!-- Border gradient -->
            <div class="relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl">
                <!-- Conținut cu backdrop blur -->
                <div class="p-8 bg-black/75 backdrop-blur-sm rounded-xl text-white relative z-10">
                <!-- Header articol -->
                <h1 class="mb-4 text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 md:text-4xl">
                    {{ $post->title }}
                </h1>

                <div class="mb-6 text-gray-400">
                    Publicat la data de {{ $post->published_at->format('F j, Y') }} de Click
                </div>

                <!-- Imagine articol -->
                @if ($post->featured_image)
                    <div class="relative mb-8 overflow-hidden rounded-lg aspect-video">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                    </div>
                @endif

                <!-- Conținut articol -->
                <div class="prose prose-invert prose-blue max-w-none">
                    {!! $post->body !!}
                </div>

                <!-- Butoane Share -->
                <div class="py-6 mt-8 border-t border-white/10">
                    <p class="mb-4 text-gray-400">Împărtășește această poveste:</p>
                    <div class="flex gap-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}"
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                            </svg>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title) }} - {{ urlencode(route('blog.show', $post->slug)) }}"
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Link înapoi -->
                <div class="mt-8">
                    <a href="{{ route('blog.index') }}" 
                       class="inline-flex items-center px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 border rounded-lg bg-blue-600/30 hover:bg-blue-500 backdrop-blur-sm border-blue-400/30 hover:border-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Înapoi la Blog
                    </a>
                </div>

                <!-- Newsletter -->
                <div class="pt-8 mt-12 border-t border-white/10">
                    <div class="max-w-md">
                        @if (session('success'))
                            <div class="p-4 mb-4 text-green-400 rounded-lg bg-green-900/50">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="p-4 mb-4 text-red-400 rounded-lg bg-red-900/50">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2 class="text-2xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                            Abonează-te la newsletter
                        </h2>
                        
                        <p class="mt-4 mb-6 text-gray-400">
                            Lasă-mi adresa ta de email și te voi ține la curent cu cele mai recente piese, 
                            albume și videoclipuri lansate pe YouTube.
                        </p>

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="flex-1">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">
                                        Numele Tău
                                    </label>
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           required
                                           class="w-full px-4 py-2 text-white placeholder-gray-400 border rounded-lg bg-white/10 border-white/20 focus:border-blue-500 focus:ring-blue-500"
                                           placeholder="Introdu numele tău">
                                </div>
                                <div class="flex-1">
                                    <label for="email-address" class="block mb-2 text-sm font-medium text-gray-300">
                                        Adresa de email
                                    </label>
                                    <input id="email-address" 
                                           name="email" 
                                           type="email" 
                                           required
                                           class="w-full px-4 py-2 text-white placeholder-gray-400 border rounded-lg bg-white/10 border-white/20 focus:border-blue-500 focus:ring-blue-500"
                                           placeholder="Adaugă emailul tău">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                        class="px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Abonează-te
                                </button>
                            </div>

                            <p class="mt-3 text-sm">
                                <a href="{{ route('privacy-policy') }}" 
                                   class="text-blue-400 hover:text-blue-300">
                                    Politica de confidențialitate
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </article>

        <!-- Articole recomandate -->
        @if ($recommendedPosts->isNotEmpty())
            <section class="mt-12">
                <h2 class="mb-8 text-2xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                    Articole similare
                </h2>
                
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendedPosts as $post)
                        <article class="group">
                            <div class="relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl">
                                <div class="relative flex flex-col h-full overflow-hidden bg-black/90 backdrop-blur-sm rounded-xl">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="block">
                                        @if ($post->featured_image)
                                            <div class="relative overflow-hidden aspect-video">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                     alt="{{ $post->title }}"
                                                     class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                                
                                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60"></div>
                                            </div>
                                        @endif

                                        <div class="p-6">
                                            <time class="block mb-2 text-sm text-blue-400" datetime="{{ $post->published_at->toDateString() }}">
                                                {{ $post->published_at->format('j F Y') }}
                                            </time>

                                            <h3 class="text-xl font-bold tracking-wide text-white transition-colors duration-300 group-hover:text-blue-400 line-clamp-2">
                                                {{ $post->title }}
                                            </h3>

                                            <p class="mt-3 text-gray-400 line-clamp-3">
                                                {{ $post->summary }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
        

        <!-- Footer navigation -->
        <div class="relative mt-12 text-center">
            <a href="{{ route('blog.index') }}" 
               class="inline-flex items-center px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 border rounded-lg bg-blue-600/30 hover:bg-blue-500 backdrop-blur-sm border-blue-400/30 hover:border-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Înapoi la toate articolele
            </a>
        </div>
    </div>
</div>