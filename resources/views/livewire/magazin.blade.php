<div class="mt-24">
    <!-- Fixed Hero Section -->
    <div class="bg-black border-b border-gray-800">
        <div class="container px-4 py-8 mx-auto">
            <div class="flex flex-col items-center justify-between max-w-6xl mx-auto md:flex-row">
                <!-- Shop Info -->
                <div class="flex items-center mb-4 space-x-6 md:mb-0">
                    <!-- Shop Icon -->
                    <div
                        class="flex items-center justify-center w-20 h-20 border-2 border-blue-500 rounded-full shadow-lg bg-blue-600/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>

                    <!-- Shop Details -->
                    <div>
                        <h1 class="text-2xl font-bold text-blue-400 md:text-3xl font-roboto-condensed">
                            MAGAZIN
                        </h1>
                        <p class="text-lg text-gray-300">
                            Albume • Haine • Accesorii
                        </p>
                        <p class="text-sm text-gray-400">
                            Livrare rapidă • Plată securizată
                        </p>
                    </div>
                </div>

                <!-- Shop Badge -->
                <div class="text-center md:text-right">
                    <div class="inline-block px-4 py-2 border rounded-lg bg-blue-600/20 border-blue-500/30">
                        <span class="text-sm font-semibold tracking-wider text-blue-400 uppercase">
                            Produse Oficiale
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu - Interactive tabs -->
    <div class="sticky z-30 border-b border-gray-800 shadow-lg top-12 bg-black/95 backdrop-blur-sm">
        <div class="container px-4 mx-auto">
            <nav class="flex flex-wrap justify-center gap-2 py-4 text-sm md:gap-6 md:text-base">
                <button wire:click="setActiveTab('toate')"
                    class="px-4 py-2 font-medium transition-all duration-300 rounded-lg
                    {{ $activeTab === 'toate' ? 'text-white bg-blue-600 scale-105 shadow-lg' : 'text-gray-300 hover:text-blue-400 hover:bg-gray-800/50' }}">
                    Toate Produsele
                </button>
                <button wire:click="setActiveTab('albume')"
                    class="px-4 py-2 font-medium transition-all duration-300 rounded-lg
                    {{ $activeTab === 'albume' ? 'text-white bg-blue-600 scale-105 shadow-lg' : 'text-gray-300 hover:text-blue-400 hover:bg-gray-800/50' }}">
                    Albume
                </button>
                <button wire:click="setActiveTab('haine')"
                    class="px-4 py-2 font-medium transition-all duration-300 rounded-lg
                    {{ $activeTab === 'haine' ? 'text-white bg-blue-600 scale-105 shadow-lg' : 'text-gray-300 hover:text-blue-400 hover:bg-gray-800/50' }}">
                    Haine
                </button>
            </nav>
        </div>
    </div>

    <!-- Alerts Section -->
    <div class="container px-4 py-4 mx-auto">
        @if (session('error'))
            <div class="relative px-4 py-3 mb-4 text-red-700 border rounded-lg bg-red-100/10 backdrop-blur-sm border-red-400/50"
                role="alert">
                <strong class="font-bold">Eroare:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="relative px-4 py-3 mb-4 text-green-700 border rounded-lg bg-green-100/10 backdrop-blur-sm border-green-400/50"
                role="alert">
                <strong class="font-bold">Succes:</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <!-- Products Section -->
    <div class="min-h-screen transition-all duration-500 ease-in-out">
        @if ($activeTab === 'toate')
            <!-- Show both albums and haine -->
            <div class="space-y-16">
                <div>
                    <h2
                        class="mb-8 text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                        Albume Muzicale
                    </h2>
                    <livewire:album-list />
                </div>
                <div>
                    <h2
                        class="mb-8 text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">
                        Haine Click Music
                    </h2>
                    <livewire:haina-list />
                </div>
            </div>
        @elseif($activeTab === 'albume')
            <!-- Show only albums -->
            <livewire:album-list />
        @elseif($activeTab === 'haine')
            <!-- Show only haine -->
            <livewire:haina-list />
        @endif
    </div>

    <!-- Loading indicator pentru tranziții -->
    {{-- <div wire:loading.delay class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="flex items-center px-6 py-4 space-x-3 bg-gray-900 border border-gray-700 rounded-lg">
            <div class="w-5 h-5 border-2 border-blue-500 rounded-full animate-spin border-t-transparent"></div>
            <span class="text-white">Se încarcă...</span>
        </div>
    </div> --}}

    <!-- Custom Styles pentru animații -->
    <style>
        /* Smooth transitions */
        .transition-all {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced button states */
        nav button {
            position: relative;
            overflow: hidden;
        }

        nav button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        nav button:hover::before {
            left: 100%;
        }
    </style>
</div>
