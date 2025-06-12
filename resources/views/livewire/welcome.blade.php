<div>
    <div x-data="{ loading: true, isMobile: window.innerWidth <= 768 }" x-init="$nextTick(() => {
        setTimeout(() => loading = false, 700);
        window.addEventListener('resize', () => isMobile = window.innerWidth <= 768);
    })" class="relative h-screen overflow-hidden">

        <!-- Loading Spinner -->
        <div x-show="loading" class="absolute inset-0 z-50 flex items-center justify-center bg-black">
            <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        </div>

        <div x-show="!loading" x-transition:enter="transition ease-out duration-300" x-data="netflixBackground()"
            x-init="init()" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="relative h-screen overflow-hidden bg-black home-parallax home-fade">

            <!-- Poster Background -->
            <div class="absolute inset-0 overflow-hidden poster-container">
                <template x-for="(row, rowIndex) in posterRows" :key="rowIndex">
                    <div class="poster-row"
                        :style="`animation-duration: ${50 + rowIndex * 5}s; transform: translateY(${isMobile ? rowIndex * 25 : rowIndex * 50}px) rotateX(60deg);`">
                        <template x-for="(poster, posterIndex) in row" :key="posterIndex">
                            <div class="poster">
                                <img :src="poster" alt="Click Music"
                                    class="object-cover w-full h-full rounded-lg">
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/75"></div>

            <!-- Content Overlay -->
            <div class="relative z-10 flex items-center justify-center h-full text-white caption-content">
                <div class="text-center">
                    <h1
                        class="font-roboto-condensed uppercase mb-3 tracking-[6px] md:tracking-[20px] font-bold text-4xl md:text-5xl leading-relaxed md:leading-normal">
                        Click Music Romania
                    </h1>
                    <h2 class="mb-12 text-xl uppercase font-roboto-condensed md:text-3xl">Hip-Hop • DnB •
                        Reggae</h2>
                    <a href="#despre"
                        class="px-10 py-2 text-xs tracking-widest uppercase transition-all duration-300 border border-blue-500 scroll-link hover:bg-blue-500 hover:text-white font-roboto-condensed hover:border-transparent">Afla
                        mai multe</a>
                </div>
            </div>
        </div>
    </div>

    <main id="despre" class="overflow-hidden text-white bg-black">
        <div class="container px-4 py-16 mx-auto">
            <div class="max-w-3xl mx-auto">
                <section class="mb-16 overflow-hidden transition-all duration-300 transform">
                    <div class="relative shadow-lg p-4rounded-lg md:p-8 bg-opacity-60">
                        <div class="relative z-10 text-center">
                            <div class="flex justify-center mb-8">
                                <img src="/img/Poza Click optimizata.jpg" alt="Click"
                                    class="w-32 h-32 border-4 border-blue-500 rounded-full shadow-lg md:w-40 md:h-40">
                            </div>
                            <p
                                class="mb-4 text-lg tracking-wider text-blue-400 uppercase font-roboto-condensed md:text-2xl">
                                Bine ai venit!
                            </p>
                            <h3
                                class="mb-6 text-xl tracking-wide text-white uppercase font-roboto-condensed md:text-3xl">
                                Streaming Video <br> Blog si Magazin Click Music
                            </h3>

                            <p class="mb-8 text-base leading-relaxed text-gray-300 md:text-lg">
                                Salut! Sunt Click, un artist de muzică hip-hop, drum & bass și reggae din inima
                                României.
                                Te invit să mă cunoști răsfoind <a href="/blog"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Blogul</a>
                                sau ascultându-mi
                                muzica gratuit pe <a href="https://youtube.com/clickmusicromania" target="_blank"
                                    rel="noopener noreferrer"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">YouTube</a>.
                                Poți să mă
                                susții prin achiziționarea de albume digitale și tricouri din
                                <a href="/magazin"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Magazin</a>
                                sau
                                devenind parte din Comunitatea mea. Poti face asta aici: <a href="/accespremium"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Acces
                                    Premium</a>.
                            </p>

                            <div class="relative bg-black">
                                <div class="absolute inset-0 blur-3xl opacity-30">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800">
                                    </div>
                                </div>

                                <div class="max-w-5xl px-6 py-24 mx-auto text-center">
                                    <h2
                                        class="text-3xl font-bold tracking-wide text-transparent uppercase bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 font-roboto-condensed">
                                        Intră în Comunitate
                                    </h2>

                                    <div class="grid gap-8 mt-12 md:grid-cols-3">
                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Premiere Exclusive</h3>
                                            <p class="text-gray-300">Fii primul care ascultă piesele noi înainte de
                                                lansarea oficială</p>
                                        </div>

                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Forum Comunitate</h3>
                                            <p class="text-gray-300">Discută cu alți susținători și împărtășește păreri
                                                despre
                                                muzică</p>
                                        </div>

                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Acces Direct</h3>
                                            <p class="text-gray-300">Feedback și interacțiune directă cu artistul</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div id="newsletter" class="max-w-md px-6 py-20 mx-auto mt-48">
            @if (session('success'))
                <div class="mt-4 text-green-400">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-4 text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="mt-12 mb-6 text-2xl tracking-widest text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                Abonează-te la newsletter
            </h2>
            <p class="mt-4 mb-6 text-lg leading-8 text-gray-300">Trimit un email de fiecare data cand lansez ceva nou
                pe Youtube</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="flex-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Numele tău</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Introdu numele tău">
                    </div>
                    <div class="flex-1">
                        <label for="email-address" class="block mb-2 text-sm font-medium text-gray-300">Adresa de
                            email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Adaugă emailul tău">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="w-32 px-3.5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-300">
                        Abonează-te
                    </button>
                </div>
                <p class="mt-3 text-sm">
                    <a href="{{ route('privacy-policy') }}" class="text-blue-400 hover:text-blue-300">
                        Politica de confidențialitate
                    </a>
                </p>
            </form>
        </div>

        <!-- Centered Bounce Circle -->
        <div class="flex justify-center mb-8">
            <div class="animate-bounce">
                <a href="#accespremium"
                    class="inline-block p-2 transition-colors duration-300 bg-blue-500 rounded-full scroll-link hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Access Premium Section -->
        <div id="accespremium" class="max-w-xl px-6 py-20 mx-auto mt-48 ">
            <div class="max-w-2xl px-4 mx-auto mt-20 text-center">
                <h2 class="mb-6 text-2xl tracking-widest text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                    Acces Premium
                </h2>
                <p class="mb-8 text-lg text-gray-300">
                    Pentru <span class="font-semibold text-blue-400">Acces Premium</span> la download-uri și la
                    întreaga colecție de videoclipuri, inclusiv cele mai recente lansări și PREMIERE exclusive,
                    abonează-te pentru doar<br>
                    <span class="font-semibold text-blue-300">9,99 lei/ lună.</span>
                </p>
                @if (Route::has('login'))
                    <div class="mb-8">
                        <livewire:welcome.navigation />
                    </div>
                @endif

                <div class="flex justify-center">
                    <a href="{{ route('login.google') }}"
                        class="flex items-center justify-center px-6 py-3 text-gray-700 transition duration-300 ease-in-out bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="mr-3 bi bi-google" viewBox="0 0 16 16">
                            <path
                                d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                        </svg>
                        <span class="text-base font-medium">Sign in with Google</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Centered Bounce Circle -->
        <div class="flex justify-center mb-8">
            <div class="animate-bounce">
                <a href="#blogposts"
                    class="inline-block p-2 transition-colors duration-300 bg-blue-500 rounded-full scroll-link hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Blog Posts Section -->
        <section id="blogposts" class="px-6 py-16 mt-48 mb-16 overflow-hidden ">
            <div class="max-w-5xl mx-auto">
                <h3
                    class="my-8 text-2xl tracking-widest text-center text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                    Ultimele Articole pe Blog
                </h3>
                @livewire('latest-blog-posts')
            </div>
        </section>
    </main>

    <!-- JavaScript pentru efecte -->
    <script>
        document.querySelectorAll('.poster-row').forEach((row, index) => {
            // Adaugă viteze diferite pentru fiecare rând
            row.style.animationDuration = `${60 + (index * 10)}s`;

            // Adaugă un delay aleatoriu la start
            row.style.animationDelay = `-${Math.random() * 60}s`;
        });

        function netflixBackground() {
            return {
                posterRows: [],
                init() {
                    // Add your poster image URLs here
                    const posters = [
                        '/img/poze-bg/1.jpg',
                        '/img/poze-bg/2.jpg',
                        '/img/poze-bg/3.jpg',
                        '/img/poze-bg/4.jpg',
                        '/img/poze-bg/5.jpg',
                        '/img/poze-bg/6.jpg',
                        '/img/poze-bg/7.jpg',
                        '/img/poze-bg/8.jpg',
                        '/img/poze-bg/9.jpg',
                        '/img/poze-bg/10.jpg',
                        '/img/poze-bg/11.jpg',
                        '/img/poze-bg/12.jpg',
                        '/img/poze-bg/13.jpg',
                        '/img/poze-bg/14.jpg',
                        '/img/poze-bg/15.jpg',
                        '/img/poze-bg/16.jpg',
                        '/img/poze-bg/17.jpg',
                        '/img/poze-bg/18.jpg',
                        '/img/poze-bg/19.jpg',
                        '/img/poze-bg/20.jpg',

                        // Add more poster URLs as needed
                    ];

                    // Create 5 rows of posters
                    this.posterRows = Array(5).fill().map(() => {
                        // Shuffle the posters array for each row
                        return [...posters].sort(() => Math.random() - 0.5);
                    });

                    // Double the posters in each row for seamless looping
                    this.posterRows = this.posterRows.map(row => [...row, ...row]);
                }
            };
        }
    </script>
</div>
