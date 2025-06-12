<div>
    <!-- Background cu particule animate -->
    <div class="relative min-h-screen overflow-hidden bg-black">
        <!-- Gradient animat de fundal -->
        <div class="absolute inset-0 opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-600/30 via-purple-600/30 to-black animate-pulse">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-purple-600/20 via-blue-500/30 to-black"></div>
        </div>

        <!-- Efecte de blur pentru depth -->
        <div class="absolute rounded-full top-20 left-10 w-72 h-72 bg-blue-500/10 blur-3xl"></div>
        <div class="absolute rounded-full bottom-20 right-10 w-96 h-96 bg-purple-500/10 blur-3xl"></div>
        <div
            class="absolute transform -translate-x-1/2 -translate-y-1/2 rounded-full top-1/2 left-1/2 w-80 h-80 bg-pink-500/5 blur-3xl">
        </div>

        <!-- Container principal -->
        <div class="relative z-10 max-w-4xl px-6 py-20 mx-auto">
            <div class="text-center">


                <!-- Header principal cu animație -->
                <h1
                    class="my-4 text-3xl font-bold tracking-tight text-transparent md:text-6xl bg-clip-text bg-gradient-to-r from-white via-blue-100 to-purple-200 font-roboto-condensed animate-fade-in">
                    <span class="block uppercase tracking-[0.2em]">Acces</span>
                    <span
                        class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 uppercase via-purple-400 to-pink-400 tracking-[0.3em]">Premium</span>
                </h1>

                <!-- Subtitle -->
                <p class="max-w-2xl mx-auto mb-12 text-xl leading-relaxed text-gray-300">
                    Alătură-te comunității exclusive și descoperă muzica înainte de toți ceilalți
                </p>

                <!-- Card principal cu efect glassmorphism -->
                <div class="relative group">
                    <!-- Glow effect -->
                    <div
                        class="absolute transition duration-500 -inset-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-2xl blur-lg opacity-20 group-hover:opacity-40">
                    </div>

                    <!-- Card content -->
                    <div
                        class="relative p-8 border shadow-2xl md:p-12 bg-black/60 backdrop-blur-xl border-white/10 rounded-2xl">
                        <div class="space-y-8">
                            <!-- Descriere principală -->
                            <div class="space-y-6">
                                <h2 class="mb-4 text-2xl font-bold text-white">
                                    🎵 Intră în Clubul Exclusiv
                                </h2>

                                <p class="text-lg leading-relaxed text-gray-200">
                                    Te invit să faci parte din <span class="font-semibold text-blue-400">Comunitatea mea
                                        exclusivă</span> -
                                    un club select cu acces la piese unreleased și videoclipuri în premieră absolută.
                                </p>

                                <p class="text-base leading-relaxed text-gray-300">
                                    Această comunitate oferă o experiență unică: <span class="text-purple-400">ascultă
                                        primul</span>
                                    noile creații, participă la <span class="text-blue-400">sesiuni exclusive</span> și
                                    fii parte
                                    din procesul creativ.
                                </p>
                            </div>

                            <!-- Preț cu efect special -->
                            <div class="relative py-8">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-purple-500/10 to-pink-500/10 rounded-xl blur-sm">
                                </div>
                                <div class="relative text-center">
                                    <p class="mb-2 text-sm text-gray-400">Doar</p>
                                    <div
                                        class="text-4xl font-bold text-transparent md:text-5xl bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                                        9,99 <span class="text-2xl">lei</span>
                                    </div>
                                    <p class="mt-2 text-lg text-gray-300">pe lună</p>
                                    <p class="max-w-md mx-auto mt-3 text-sm text-gray-500">
                                        Contribuția va susține dezvoltarea platformei și proiectele viitoare
                                    </p>
                                </div>
                            </div>

                            <!-- Authentication Section -->
                            @if (Route::has('login'))
                                <div class="mb-8">
                                    <livewire:welcome.navigation />
                                </div>
                            @endif

                            <!-- Google Sign In Button -->
                            <div class="flex justify-center">
                                <a href="{{ route('login.google') }}"
                                    class="relative px-8 py-4 overflow-hidden text-lg font-semibold text-gray-800 transition-all duration-300 bg-white group rounded-xl hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/25">
                                    <div class="flex items-center justify-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                                        </svg>
                                        <span>Începe cu Google</span>
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 gap-6 mt-16 md:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 transition-all duration-300 border bg-black/60 backdrop-blur-xl border-white/10 rounded-xl hover:scale-105">
                            <div
                                class="w-12 h-12 p-3 mx-auto mb-4 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600">
                                <svg class="w-full h-full text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-white">Premiere Exclusive</h3>
                            <p class="text-sm leading-relaxed text-gray-400">Acces la videoclipuri și piese înainte de
                                lansarea publică</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 transition-all duration-300 border bg-black/60 backdrop-blur-xl border-white/10 rounded-xl hover:scale-105">
                            <div
                                class="w-12 h-12 p-3 mx-auto mb-4 rounded-lg bg-gradient-to-r from-purple-500 to-pink-600">
                                <svg class="w-full h-full text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-white">Download Nelimitat</h3>
                            <p class="text-sm leading-relaxed text-gray-400">Descarcă și păstrează toată muzica pentru
                                ascultare offline</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 to-blue-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 transition-all duration-300 border bg-black/60 backdrop-blur-xl border-white/10 rounded-xl hover:scale-105">
                            <div
                                class="w-12 h-12 p-3 mx-auto mb-4 rounded-lg bg-gradient-to-r from-pink-500 to-blue-600">
                                <svg class="w-full h-full text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-white">Comunitate Exclusivă</h3>
                            <p class="text-sm leading-relaxed text-gray-400">Interacțiune directă cu artistul și alte
                                sesiuni live</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- CSS pentru animații -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</div>
