<div>
    <!-- Background cu particule animate -->
    <div class="relative min-h-screen overflow-hidden bg-black">
        <!-- Gradient animat de fundal -->
        <div class="absolute inset-0 opacity-15">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-950/40 via-slate-900/30 to-black">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/20 via-blue-950/20 to-black"></div>
        </div>

        
        <!-- Container principal -->
        <div class="relative z-10 max-w-4xl px-6 py-20 mx-auto mt-12">
            <div class="text-center">


                <!-- Card principal cu efect glassmorphism -->
                <div class="relative">
                    <!-- Card content -->
                    <div
                        class="relative p-8 border shadow-2xl md:p-12 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                        <div class="space-y-8">
                            <!-- Descriere principală -->
                            <div class="space-y-6">

                                <!-- Header principal cu animație -->
                                <h1
                                    class="my-4 text-3xl font-bold tracking-tight text-transparent md:text-6xl bg-clip-text bg-gradient-to-r from-white via-blue-100 to-sky-200 font-roboto-condensed animate-fade-in">
                                    <span class="block uppercase tracking-[0.2em]">Acces</span>
                                    <span
                                        class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 uppercase via-sky-300 to-indigo-500 tracking-[0.3em]">Premium</span>
                                </h1>

                                <p class="text-lg leading-relaxed text-gray-200">
                                    Te invit să faci parte din <span class="font-semibold text-blue-400">Comunitatea mea
                                        exclusivă</span> -
                                    un club select cu acces la piese unreleased și videoclipuri în premieră absolută.
                                </p>
                                <p class="max-w-xl mx-auto mt-3 text-gray-300">
                                    Ai acces <span class="font-semibold text-blue-400">GRATUIT</span> la secțiunea
                                    "Comunitate", dar
                                    pentru conținutul EXCLUSIV
                                    ai nevoie de un abonament lunar.
                                </p>
                                <p
                                    class="max-w-xl mx-auto mt-3 text-sm tracking-normal text-blue-400 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400"
                                        fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                    </svg>
                                    Contribuția de 9,99 lei pe luna va susține dezvoltarea platformei și proiectele
                                    viitoare
                                </p>

                                <!-- Authentication Section -->
                                @if (Route::has('login'))
                                    <div class="mb-8">
                                        <livewire:welcome.navigation />
                                    </div>
                                @endif

                                <!-- Google Sign In Button -->
                                <div class="flex justify-center">
                                    <a href="{{ route('login.google') }}"
                                        class="relative px-8 py-4 overflow-hidden text-sm font-semibold text-gray-800 transition-all duration-300 bg-white group rounded-xl hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/25">
                                        <div class="flex items-center justify-center space-x-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
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
