<div>
    <div x-data="{ loading: true }" x-init="$nextTick(() => setTimeout(() => loading = false, 400))"
        class="relative min-h-screen overflow-hidden">


        <!-- Loading Spinner -->
        <div x-show="loading" class="fixed inset-0 z-50 flex items-center justify-center bg-black">
            <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        </div>

        <div x-show="!loading" x-transition:enter="transition ease-out duration-300" x-data="netflixBackground()"
            x-on:resize.window.debounce.200ms="buildRows()" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" class="relative min-h-screen overflow-hidden bg-black home-parallax">

            <!-- Poster Background -->
            <div class="absolute inset-0 poster-container" aria-hidden="true">
                <div class="poster-plane">
                    <template x-for="(row, rowIndex) in posterRows" :key="rowIndex">
                        <div class="poster-row" :style="row.style">
                            <template x-for="(poster, posterIndex) in row.posters" :key="posterIndex">
                                <img class="poster" :src="poster" alt="" width="200" height="300"
                                    decoding="async">
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Cinematic Overlay -->
            <div class="absolute inset-0 poster-overlay"></div>

            <!-- Scroll dim layer (condus din resources/js/app.js) -->
            <div class="absolute inset-0 z-20 bg-black opacity-0 pointer-events-none scroll-dim"></div>

            <!-- Content Overlay - Better Mobile Positioning -->
            <div class="relative z-10 flex items-start justify-center h-full pt-16 pb-20 text-white md:pt-24 md:pb-16">
                <div class="max-w-4xl px-6 mx-auto text-center">
                    <!-- Artist Photo -->
                    <div class="mb-6">
                        <img src="/img/Poza Click optimizata.jpg" alt="Click"
                            class="mx-auto border-4 border-blue-500 rounded-full shadow-2xl w-28 h-28 md:w-36 md:h-36">
                    </div>

                    <!-- Main Title -->
                    <h1
                        class="font-roboto-condensed uppercase mb-3 tracking-[6px] md:tracking-[15px] font-bold text-3xl md:text-5xl leading-relaxed">
                        Click Music Romania
                    </h1>

                    <!-- Subtitle -->
                    <h2 class="mb-5 text-lg text-blue-400 uppercase font-roboto-condensed md:text-2xl">
                        Hip-Hop • Drum & Bass • Reggae
                    </h2>

                    <!-- Latest YouTube Clip -->
                    @if (! empty($youtubeEmbedUrl))
                        <div class="max-w-2xl mx-auto mb-6">
                            <p class="mb-3 text-xs tracking-[3px] text-blue-400 uppercase font-roboto-condensed md:text-sm">
                                Cel mai recent videoclip
                            </p>
                            <div class="relative w-full overflow-hidden shadow-2xl rounded-xl ring-1 ring-blue-500/40"
                                style="padding-top: 56.25%">
                                <iframe class="absolute inset-0 w-full h-full"
                                    src="{{ $youtubeEmbedUrl }}"
                                    title="Cel mai recent videoclip Click Music"
                                    frameborder="0" loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <p class="max-w-2xl mx-auto mb-6 text-sm leading-relaxed text-gray-300 md:text-base">
                        Artist de muzică hip-hop, drum & bass și reggae din România cu peste două decenii de experiență.
                        Cunoscut pentru hiturile naționale cu trupa Camuflaj și cariera solo de succes.
                    </p>

                    <!-- Action Buttons - Mobile Optimized -->
                    <div
                        class="flex flex-col gap-3 mb-12 md:mb-0 md:flex-row md:justify-center md:gap-4 action-buttons">
                        <!-- Premium Access -->
                        <a href="{{ route('accespremium') }}" wire:navigate
                            class="relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-300 bg-blue-600 rounded-lg group md:text-base hover:bg-blue-700 focus:ring-4 focus:ring-blue-500/50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                            Acces Premium
                            <span class="px-2 py-1 ml-2 text-xs text-yellow-900 bg-yellow-500 rounded-full">9,99
                                lei/lună</span>
                        </a>

                        <!-- Press Kit -->
                        <a href="{{ route('electronic-press-kit') }}" wire:navigate
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-blue-400 transition-all duration-300 border border-blue-500 rounded-lg md:text-base hover:bg-blue-500 hover:text-white">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Press Kit
                        </a>

                        <!-- YouTube -->
                        <a href="https://youtube.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-300 transition-all duration-300 border border-gray-600 rounded-lg md:text-base hover:border-red-500 hover:text-red-400">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                            YouTube
                        </a>
                    </div>




                </div>
            </div>
        </div>

        <!-- Latest Blog Posts -->

        <livewire:latest-blog-posts />


    </div>

    <!-- JavaScript pentru efecte -->
    <script>
        function netflixBackground() {
            return {
                posterRows: [],
                perRow: 0,
                rowCount: 0,
                init() {
                    this.buildRows();
                },
                buildRows() {
                    const posters = [
                        '/img/poze-bg/1.jpg', '/img/poze-bg/2.jpg', '/img/poze-bg/3.jpg', '/img/poze-bg/4.jpg',
                        '/img/poze-bg/5.jpg', '/img/poze-bg/6.jpg', '/img/poze-bg/7.jpg', '/img/poze-bg/8.jpg',
                        '/img/poze-bg/9.jpg', '/img/poze-bg/10.jpg', '/img/poze-bg/11.jpg', '/img/poze-bg/12.jpg',
                        '/img/poze-bg/13.jpg', '/img/poze-bg/14.jpg', '/img/poze-bg/15.jpg', '/img/poze-bg/16.jpg',
                        '/img/poze-bg/17.jpg', '/img/poze-bg/18.jpg', '/img/poze-bg/19.jpg', '/img/poze-bg/20.jpg'
                    ];

                    const isMobile = window.innerWidth <= 768;
                    // lățime poster + margine, respectiv înălțime poster + gap rând (vezi .poster / .poster-plane)
                    const tileWidth = isMobile ? 68 : 120;
                    const rowPitch = isMobile ? 93 : 160;

                    // planul e supradimensionat cu 44% pe lățime și 36% pe înălțime,
                    // deci rândurile trebuie să depășească viewport-ul ca să nu apară goluri
                    const perRow = Math.min(40, Math.ceil((window.innerWidth * 1.4) / tileWidth) + 1);
                    const rowCount = Math.min(12, Math.ceil((window.innerHeight * 1.3) / rowPitch) + 1);

                    // reconstruim doar când peretele ar rămâne prea mic (ex. rotirea telefonului).
                    // altfel resize-urile mărunte, precum bara de adrese pe mobil, ar reporni animațiile
                    if (perRow <= this.perRow && rowCount <= this.rowCount) {
                        return;
                    }

                    this.perRow = Math.max(perRow, this.perRow);
                    this.rowCount = Math.max(rowCount, this.rowCount);

                    const shuffle = (items) => {
                        const shuffled = [...items];

                        for (let i = shuffled.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
                        }

                        return shuffled;
                    };

                    this.posterRows = Array.from({ length: this.rowCount }, () => {
                        const deck = shuffle(posters);
                        const sequence = Array.from({ length: this.perRow }, (_, i) => deck[i % deck.length]);

                        // durata se derivă dintr-o viteză țintă în px/s, ca driftul să arate
                        // la fel indiferent de lățimea rândului sau de breakpoint
                        const speed = 20 + Math.random() * 8;
                        const duration = (this.perRow * tileWidth) / speed;
                        // delay negativ aleator: rândurile pornesc în faze diferite
                        const delay = -(Math.random() * duration);
                        // decalaj orizontal aleator, ca posterele să nu formeze coloane
                        const offset = -(Math.random() * tileWidth);

                        return {
                            // set duplicat: keyframes-urile mută rândul cu exact -50% pentru un loop continuu
                            posters: [...sequence, ...sequence],
                            style: `animation-duration: ${duration.toFixed(1)}s;` +
                                ` animation-delay: ${delay.toFixed(1)}s; margin-left: ${offset.toFixed(0)}px;`,
                        };
                    });
                }
            };
        }
    </script>
</div>
