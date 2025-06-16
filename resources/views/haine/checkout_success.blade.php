<x-app-layout>
    <div class="min-h-screen py-12 bg-gradient-to-b from-black via-green-900/35 to-black">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Success Header -->
            <div class="mb-8 text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full shadow-lg bg-gradient-to-r from-green-500 to-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1
                    class="mb-4 text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">
                    Comandă Confirmată!
                </h1>
                <p class="text-xl text-gray-300">
                    Mulțumim pentru comandă! Vei primi un email de confirmare în scurt timp.
                </p>
            </div>

            <!-- Order Details Card -->
            <div class="overflow-hidden shadow-xl bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-green-500/20 bg-gradient-to-r from-green-600/20 to-green-700/20">
                    <h2 class="flex items-center text-xl font-semibold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Detaliile comenzii
                    </h2>
                </div>

                <!-- Card Content -->
                <div class="p-6">
                    <!-- Product Info -->
                    <div class="flex flex-col gap-6 mb-8 md:flex-row">
                        <!-- Product Image -->
                        <div class="flex-shrink-0 w-full h-64 overflow-hidden bg-gray-800 rounded-lg md:w-48 md:h-48">
                            <img src="{{ $comandaHaina->haina->image_url }}" alt="{{ $comandaHaina->haina->nume }}"
                                class="object-cover w-full h-full">
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="mb-2 text-2xl font-bold text-white">{{ $comandaHaina->haina->nume }}</h3>
                                <p class="text-lg font-semibold text-green-400">
                                    {{ number_format($comandaHaina->haina->pret, 2) }} RON</p>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div class="p-3 border rounded-lg bg-gray-800/50 border-green-500/30">
                                    <p class="text-sm font-medium tracking-wide text-green-400 uppercase">Categorie</p>
                                    <p class="font-semibold text-white">{{ ucfirst($comandaHaina->haina->categorie) }}
                                    </p>
                                </div>
                                <div class="p-3 border rounded-lg bg-gray-800/50 border-green-500/30">
                                    <p class="text-sm font-medium tracking-wide text-green-400 uppercase">Culoare</p>
                                    <p class="font-semibold text-white">{{ $comandaHaina->haina->culoare }}</p>
                                </div>
                                <div class="p-3 border rounded-lg bg-gray-800/50 border-green-500/30">
                                    <p class="text-sm font-medium tracking-wide text-green-400 uppercase">Mărimea</p>
                                    <p class="font-semibold text-white">{{ $comandaHaina->marime_selectata }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order and Customer Info -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Order Info -->
                        <div class="p-4 border border-gray-600 rounded-lg bg-gray-800/30">
                            <h4 class="flex items-center mb-3 text-lg font-semibold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Informații comandă
                            </h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">ID Comandă:</span>
                                    <span class="font-mono text-white">{{ $comandaHaina->order_id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Status:</span>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                        Confirmată
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Data comenzii:</span>
                                    <span class="text-white">{{ $comandaHaina->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="p-4 border border-gray-600 rounded-lg bg-gray-800/30">
                            <h4 class="flex items-center mb-3 text-lg font-semibold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Informații client
                            </h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-gray-400">Nume:</span>
                                    <span class="ml-2 text-white">{{ $comandaHaina->nume_cumparator }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Email:</span>
                                    <span class="ml-2 text-white">{{ $comandaHaina->email }}</span>
                                </div>
                                @if ($comandaHaina->telefon)
                                    <div>
                                        <span class="text-gray-400">Telefon:</span>
                                        <span class="ml-2 text-white">{{ $comandaHaina->telefon }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="p-4 mt-6 border border-gray-600 rounded-lg bg-gray-800/30">
                        <h4 class="flex items-center mb-3 text-lg font-semibold text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Adresa de livrare
                        </h4>
                        <p class="p-3 text-white border border-gray-600 rounded bg-gray-700/50">
                            {{ $comandaHaina->adresa_livrare }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="p-6 mt-8 shadow-xl bg-gray-900/70 backdrop-blur-md rounded-2xl ring-1 ring-green-500/20">
                <h3 class="flex items-center mb-4 text-xl font-semibold text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ce urmează?
                </h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-600 rounded-full">
                            <span class="text-sm font-bold text-white">1</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Email de confirmare</h4>
                            <p class="text-sm text-gray-400">Vei primi un email cu detaliile comenzii</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-600 rounded-full">
                            <span class="text-sm font-bold text-white">2</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Procesare comandă</h4>
                            <p class="text-sm text-gray-400">Comanda va fi procesată în 1-2 zile lucrătoare</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-600 rounded-full">
                            <span class="text-sm font-bold text-white">3</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Livrare</h4>
                            <p class="text-sm text-gray-400">Produsul va fi expediat la adresa specificată</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
                <a href="{{ route('magazin') }}"
                    class="inline-flex items-center justify-center px-6 py-3 text-white transition-all duration-300 transform rounded-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Continuă cumpărăturile
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center px-6 py-3 text-green-400 transition-all duration-300 border border-green-500 rounded-lg hover:bg-green-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
