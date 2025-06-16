<div class="container relative px-4 mx-auto mb-32 text-white">
    <!-- Enhanced Gradient Background with Animated Particles -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-green-600/20 via-blue-600/20 to-green-800/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/30"></div>
    </div>

    @if ($haine->count() > 0)
        <!-- Page Header -->
        <div class="relative mb-12 text-center">
            <h1
                class="mb-4 text-4xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-400 to-green-500 md:text-5xl">
                Haine Click Music
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-300">
                Tricouri și hanorace oficiale Click Music
            </p>
        </div>

        <div class="relative grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($haine as $haina)
                <div class="relative group">
                    <!-- Animated Border Effect -->
                    <div
                        class="absolute inset-0 transition-opacity duration-500 opacity-0 rounded-xl bg-gradient-to-r from-green-500/50 via-blue-500/50 to-green-500/50 group-hover:opacity-100 blur-sm">
                    </div>

                    <div
                        class="relative p-[1px] bg-gradient-to-br from-green-500/30 via-blue-500/30 to-green-500/30 rounded-xl transform transition-all duration-500 group-hover:scale-[1.02] group-hover:shadow-2xl group-hover:shadow-green-500/25">
                        <div
                            class="relative flex flex-col h-full overflow-hidden bg-black/95 backdrop-blur-sm rounded-xl">
                            <!-- Product Image with Enhanced Effects -->
                            <div class="relative ">
                                <!-- Glow Effect Behind Image -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-blue-500/20 blur-xl">
                                </div>

                                <img src="{{ $haina->image_url }}" alt="{{ $haina->nume }}"
                                    class="relative object-cover w-full h-full transition-all duration-700 group-hover:scale-110 group-hover:brightness-110">

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 group-hover:opacity-100">
                                </div>

                                <!-- Price Badge with Enhanced Design -->
                                <div
                                    class="absolute transition-all duration-300 transform bottom-4 right-4 group-hover:scale-110">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-green-500 rounded-full blur-md"></div>
                                        <div
                                            class="relative px-4 py-2 border rounded-full bg-gradient-to-r from-green-600 to-green-700 border-green-400/30 backdrop-blur-sm">
                                            <span class="text-sm font-bold text-white drop-shadow-lg">
                                                {{ number_format($haina->pret, 2) }} RON
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4">
                                    <div class="relative">
                                        <div
                                            class="relative px-3 py-1 text-xs font-bold text-white uppercase border rounded-full bg-gradient-to-r from-blue-600 to-blue-700 border-blue-400/30 backdrop-blur-sm">
                                            {{ ucfirst($haina->categorie) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section with Enhanced Typography -->
                            <div class="flex flex-col flex-grow p-6 space-y-4">
                                <!-- Product Title with Glow Effect -->
                                <div class="space-y-2">
                                    <h3
                                        class="text-xl font-bold tracking-wider text-transparent uppercase transition-all duration-300 bg-clip-text bg-gradient-to-r from-white to-green-200 group-hover:from-green-300 group-hover:to-blue-300">
                                        {{ $haina->nume }}
                                    </h3>
                                    <div
                                        class="w-12 h-0.5 bg-gradient-to-r from-green-500 to-blue-500 transition-all duration-500 group-hover:w-full">
                                    </div>
                                </div>

                                <!-- Color and Size Info -->
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-400">
                                        <span class="font-semibold text-green-400">Culoare:</span> {{ $haina->culoare }}
                                    </p>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="text-sm font-semibold text-green-400">Mărimi:</span>
                                        @foreach ($haina->marimi_disponibile as $marime)
                                            <span
                                                class="px-2 py-1 text-xs text-gray-300 border border-gray-600 rounded bg-gray-800/50">
                                                {{ $marime }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Description with Enhanced Styling -->
                                <p
                                    class="flex-grow leading-relaxed text-gray-400 transition-colors duration-300 group-hover:text-gray-300">
                                    {!! Str::limit($haina->descriere, 100) !!}
                                </p>

                                <!-- Enhanced Action Button -->
                                <div class="pt-4 border-t border-white/10">
                                    <a href="{{ route('haina.show', $haina->slug) }}"
                                        class="relative inline-flex items-center justify-center w-full px-6 py-3 overflow-hidden text-sm font-semibold tracking-wider text-white uppercase transition-all duration-500 transform border rounded-lg group/btn border-green-500/30 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-500 hover:to-blue-500 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-black hover:scale-105 active:scale-95">
                                        <!-- Button Background Effect -->
                                        <div
                                            class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-r from-green-400 to-blue-400 group-hover/btn:opacity-20">
                                        </div>

                                        <!-- Button Text -->
                                        <span class="relative flex items-center">
                                            Comandă Acum
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/btn:translate-x-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Enhanced Empty State -->
        <div class="relative max-w-md mx-auto">
            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-green-500/20 to-blue-500/20 blur-xl">
            </div>
            <div class="relative p-12 text-center border rounded-2xl backdrop-blur-sm bg-black/40 border-white/20">
                <!-- Empty State Icon -->
                <div class="mb-6">
                    <div class="inline-flex p-4 rounded-full bg-gradient-to-br from-green-500/20 to-blue-500/20">
                        <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <h3
                    class="mb-3 text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">
                    Nu există haine
                </h3>
                <p class="leading-relaxed text-gray-400">
                    Nu există produse disponibile momentan. Verifică din nou mai târziu pentru noi haine Click Music.
                </p>
            </div>
        </div>
    @endif
</div>
