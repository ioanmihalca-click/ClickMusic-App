<x-layouts.app :title="$haina->nume . ' - Click Music Shop'" :description="'Cumpără ' . $haina->nume . ' - ' . $haina->categorie . ' - Click Music Shop'" :ogTitle="$haina->nume . ' - Click Music Shop'" :ogDescription="'Cumpără ' . $haina->nume . ' - ' . $haina->categorie . ' - Click Music Shop'" :ogImage="$haina->image_url"
    :ogUrl="url()->current()">
    <div class="min-h-screen py-24 bg-gradient-to-b from-black via-green-900/35 to-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <!-- Left Column - Product Image Section -->
                <div class="lg:col-span-8">
                    <div
                        class="overflow-hidden shadow-xl bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                        <!-- Product Image Container -->
                        <div class="relative ">
                            <img src="{{ $haina->image_url }}" alt="{{ $haina->nume }}"
                                class="object-cover w-full h-full">

                            <!-- Overlay with Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 text-sm font-bold text-white uppercase border rounded-full bg-gradient-to-r from-green-600 to-green-700 border-green-400/30 backdrop-blur-sm">
                                    {{ ucfirst($haina->categorie) }}
                                </span>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute bottom-4 right-4">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-green-500 rounded-full blur-md"></div>
                                    <div
                                        class="relative px-6 py-3 border rounded-full bg-gradient-to-r from-green-600 to-green-700 border-green-400/30 backdrop-blur-sm">
                                        <span class="text-lg font-bold text-white drop-shadow-lg">
                                            {{ number_format($haina->pret, 2) }} RON
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div
                        class="p-6 mt-6 shadow-xl bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                        <h1 class="mb-4 text-3xl font-bold text-white">{{ $haina->nume }}</h1>

                        <div class="grid grid-cols-2 gap-6 mb-6 md:grid-cols-3">
                            <div class="p-4 border rounded-lg bg-gray-800/50 border-green-500/30">
                                <h3 class="text-sm font-semibold tracking-wider text-green-400 uppercase">Categorie</h3>
                                <p class="text-lg font-medium text-white">{{ ucfirst($haina->categorie) }}</p>
                            </div>

                            <div class="p-4 border rounded-lg bg-gray-800/50 border-green-500/30">
                                <h3 class="text-sm font-semibold tracking-wider text-green-400 uppercase">Culoare</h3>
                                <p class="text-lg font-medium text-white">{{ $haina->culoare }}</p>
                            </div>

                            <div
                                class="col-span-2 p-4 border rounded-lg bg-gray-800/50 border-green-500/30 md:col-span-1">
                                <h3 class="text-sm font-semibold tracking-wider text-green-400 uppercase">Preț</h3>
                                <p class="text-lg font-medium text-white">{{ number_format($haina->pret, 2) }} RON</p>
                                <span
                                    class="inline-block px-2 py-1 mt-2 text-xs font-semibold text-white bg-green-600 rounded-full">
                                    Transport gratuit
                                </span>
                            </div>
                        </div>

                        <!-- Available Sizes -->
                        <div class="mb-6">
                            <h3 class="mb-3 text-lg font-semibold text-white">Mărimi disponibile:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($haina->marimi_disponibile as $marime)
                                    <span
                                        class="px-4 py-2 text-sm font-medium text-green-400 border rounded-lg bg-gray-800/50 border-green-500/30">
                                        {{ $marime }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Description -->
                        @if ($haina->descriere)
                            <div class="prose prose-invert max-w-none">
                                <h3 class="text-lg font-semibold text-white">Descriere:</h3>
                                <div class="leading-relaxed text-gray-300">{!! $haina->descriere !!}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Sidebar - Order Form -->
                <div class="lg:col-span-4">
                    <div
                        class="sticky p-6 shadow-xl top-20 bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                        <h2 class="flex items-center mb-6 text-xl font-semibold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Comandă Acum
                        </h2>

                        <!-- Order Form -->
                        <form action="{{ route('haina.checkout', $haina) }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-300">
                                    Email <span class="text-red-400">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-4 py-3 text-white placeholder-gray-400 border border-gray-600 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="exemplu@email.ro">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nume -->
                            <div>
                                <label for="nume_cumparator" class="block mb-2 text-sm font-medium text-gray-300">
                                    Nume complet <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nume_cumparator" id="nume_cumparator" required
                                    class="w-full px-4 py-3 text-white placeholder-gray-400 border border-gray-600 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Numele tău complet">
                                @error('nume_cumparator')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telefon -->
                            <div>
                                <label for="telefon" class="block mb-2 text-sm font-medium text-gray-300">
                                    Telefon
                                </label>
                                <input type="text" name="telefon" id="telefon"
                                    class="w-full px-4 py-3 text-white placeholder-gray-400 border border-gray-600 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="0712345678">
                                @error('telefon')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Mărimea -->
                            <div>
                                <label for="marime_selectata" class="block mb-2 text-sm font-medium text-gray-300">
                                    Mărimea <span class="text-red-400">*</span>
                                </label>
                                <select name="marime_selectata" id="marime_selectata" required
                                    class="w-full px-4 py-3 text-white border border-gray-600 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <option value="">Selectează mărimea</option>
                                    @foreach ($haina->marimi_disponibile as $marime)
                                        <option value="{{ $marime }}">{{ $marime }}</option>
                                    @endforeach
                                </select>
                                @error('marime_selectata')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Adresa -->
                            <div>
                                <label for="adresa_livrare" class="block mb-2 text-sm font-medium text-gray-300">
                                    Adresa de livrare <span class="text-red-400">*</span>
                                </label>
                                <textarea name="adresa_livrare" id="adresa_livrare" rows="3" required
                                    class="w-full px-4 py-3 text-white placeholder-gray-400 border border-gray-600 rounded-lg resize-none bg-gray-800/50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    placeholder="Strada, numărul, orașul, județul, codul poștal"></textarea>
                                @error('adresa_livrare')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-6 py-4 mt-6 font-semibold text-white transition-all duration-300 transform rounded-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-900 hover:scale-105 active:scale-95">
                                <span class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5L2 13m5 0v6a2 2 0 002 2h6a2 2 0 002-2v-6" />
                                    </svg>
                                    Plătește {{ number_format($haina->pret, 2) }} RON
                                </span>
                            </button>

                            <!-- Security Info -->
                            <div class="p-3 mt-4 border border-gray-600 rounded-lg bg-gray-800/30">
                                <div class="flex items-center text-sm text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Plată securizată prin Stripe
                                </div>
                                <div class="flex items-center mt-2 text-sm text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Transport Gratuit
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Informații livrare -->
                    <div
                        class="p-6 mt-6 shadow-xl bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                        <h3 class="flex items-center mb-4 text-lg font-semibold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informații livrare
                        </h3>
                        <div class="space-y-3 text-sm text-gray-300">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Livrare în toată România
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Procesare în 1-2 zile lucrătoare
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Calitate premium garantată
                            </div>
                            <div class="flex items-center font-medium text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Transport gratuit - inclus în preț
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
