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
            <div class="relative z-10 flex items-center justify-center h-full text-white">
                <div class="max-w-4xl px-6 mx-auto text-center">
                    <!-- Artist Photo -->
                    <div class="mb-8">
                        <img src="/img/Poza Click optimizata.jpg" alt="Click"
                            class="w-32 h-32 mx-auto border-4 border-blue-500 rounded-full shadow-2xl md:w-40 md:h-40">
                    </div>

                    <!-- Main Title -->
                    <h1
                        class="font-roboto-condensed uppercase mb-4 tracking-[6px] md:tracking-[15px] font-bold text-3xl md:text-5xl leading-relaxed">
                        Click Music Romania
                    </h1>

                    <!-- Subtitle -->
                    <h2 class="mb-6 text-lg text-blue-400 uppercase font-roboto-condensed md:text-2xl">
                        Hip-Hop • Drum & Bass • Reggae
                    </h2>

                    <!-- Key Stats -->
                    <div class="grid max-w-md grid-cols-3 gap-4 mx-auto mb-8 md:grid-cols-3">
                        <div class="text-center">
                            <div class="text-xl font-bold text-blue-400 md:text-2xl">23</div>
                            <div class="text-xs text-gray-300 md:text-sm">Ani experiență</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-blue-400 md:text-2xl">50M+</div>
                            <div class="text-xs text-gray-300 md:text-sm">Vizualizări</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-blue-400 md:text-2xl">2025</div>
                            <div class="text-xs text-gray-300 md:text-sm">Proiect D&B</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="max-w-2xl mx-auto mb-8 text-sm leading-relaxed text-gray-300 md:text-base">
                        Artist de muzică hip-hop, drum & bass și reggae din România cu peste două decenii de experiență.
                        Cunoscut pentru hiturile naționale cu trupa Camuflaj și cariera solo de succes.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-4 md:flex-row md:justify-center md:gap-6">
                        <!-- Premium Access -->
                        <a href="/accespremium"
                            class="relative inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white transition-all duration-300 bg-blue-600 rounded-lg group md:text-base hover:bg-blue-700 focus:ring-4 focus:ring-blue-500/50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                            Acces Premium
                            <span class="px-2 py-1 ml-2 text-xs text-yellow-900 bg-yellow-500 rounded-full">9,99
                                lei/lună</span>
                        </a>

                        <!-- Explore More -->
                        <a href="/electronic-press-kit"
                            class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-blue-400 transition-all duration-300 border border-blue-500 rounded-lg md:text-base hover:bg-blue-500 hover:text-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Press Kit
                        </a>

                        <!-- YouTube -->
                        <a href="https://youtube.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-gray-300 transition-all duration-300 border border-gray-600 rounded-lg md:text-base hover:border-red-500 hover:text-red-400">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                            YouTube
                        </a>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript pentru efecte -->
    <script>
        document.querySelectorAll('.poster-row').forEach((row, index) => {
            row.style.animationDuration = `${60 + (index * 10)}s`;
            row.style.animationDelay = `-${Math.random() * 60}s`;
        });

        function netflixBackground() {
            return {
                posterRows: [],
                init() {
                    const posters = [
                        '/img/poze-bg/1.jpg', '/img/poze-bg/2.jpg', '/img/poze-bg/3.jpg', '/img/poze-bg/4.jpg',
                        '/img/poze-bg/5.jpg', '/img/poze-bg/6.jpg', '/img/poze-bg/7.jpg', '/img/poze-bg/8.jpg',
                        '/img/poze-bg/9.jpg', '/img/poze-bg/10.jpg', '/img/poze-bg/11.jpg', '/img/poze-bg/12.jpg',
                        '/img/poze-bg/13.jpg', '/img/poze-bg/14.jpg', '/img/poze-bg/15.jpg', '/img/poze-bg/16.jpg',
                        '/img/poze-bg/17.jpg', '/img/poze-bg/18.jpg', '/img/poze-bg/19.jpg', '/img/poze-bg/20.jpg'
                    ];

                    this.posterRows = Array(5).fill().map(() => {
                        return [...posters].sort(() => Math.random() - 0.5);
                    });

                    this.posterRows = this.posterRows.map(row => [...row, ...row]);
                }
            };
        }
    </script>
</div>
