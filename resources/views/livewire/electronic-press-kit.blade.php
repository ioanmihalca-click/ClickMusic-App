<div class="mt-24">
    <!-- Fixed Hero Section - Static, nu se reîncarcă -->
    <div class="bg-black border-b border-gray-800">
        <div class="container px-4 mx-auto py-8">
            <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto">
                <!-- Artist Info -->
                <div class="flex items-center space-x-6 mb-4 md:mb-0">
                    <!-- Artist Photo - Smaller -->
                    <img src="/img/Poza Click optimizata.jpg" alt="Click"
                        class="w-20 h-20 rounded-full border-2 border-blue-500 shadow-lg">

                    <!-- Artist Details -->
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-blue-400 font-roboto-condensed">
                            CLICK MUSIC
                        </h1>
                        <p class="text-gray-300 text-lg">
                            Hip-Hop • Drum & Bass • Reggae
                        </p>
                        <p class="text-gray-400 text-sm">
                            23 ani experiență • 50M+ vizualizări
                        </p>
                    </div>
                </div>

                <!-- EPK Badge -->
                <div class="text-center md:text-right">
                    <div class="inline-block px-4 py-2 bg-blue-600/20 border border-blue-500/30 rounded-lg">
                        <span class="text-blue-400 font-semibold text-sm uppercase tracking-wider">
                            Electronic Press Kit
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Navigation Menu -->
    <div class="sticky top-12 z-30 border-b border-gray-800 bg-black/95 backdrop-blur-sm shadow-lg">
        <div class="container px-4 mx-auto">
            <nav class="flex flex-wrap justify-center gap-2 py-4 text-sm md:gap-6 md:text-base">
                @foreach ($sections as $key => $section)
                    <button wire:click="setActiveSection('{{ $key }}')"
                        class="px-4 py-2 rounded-lg transition-all duration-300 font-medium
                               {{ $activeSection === $key
                                   ? 'bg-blue-600 text-white shadow-lg scale-105'
                                   : 'text-gray-300 hover:text-blue-400 hover:bg-gray-800/50' }}">
                        {{ $section['title'] }}
                    </button>
                @endforeach
            </nav>
        </div>
    </div>

    <!-- Dynamic Content Section -->
    <div class="min-h-screen">
        <div class="transition-all duration-500 ease-in-out" wire:key="section-{{ $activeSection }}">

            @if ($activeSection === 'overview')
                <livewire:epk.artist-overview />
            @elseif($activeSection === 'biography')
                <livewire:epk.biography-section />
            @elseif($activeSection === 'discography')
                <livewire:epk.discography-section />
            @elseif($activeSection === 'drum-bass-project')
                <livewire:epk.drum-bass-project />
            @elseif($activeSection === 'media-assets')
                <livewire:epk.media-assets />
            @elseif($activeSection === 'contact-booking')
                <livewire:epk.contact-booking />
            @elseif($activeSection === 'download')
                <livewire:epk.download-section />
            @elseif($activeSection === 'future-vision')
                <livewire:epk.future-vision />
            @endif
        </div>
    </div>

    <!-- Loading indicator pentru tranziții -->
    <div wire:loading.delay wire:target="setActiveSection"
        class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="flex items-center space-x-3 px-6 py-4 bg-gray-900 rounded-lg border border-gray-700">
            <div class="animate-spin w-5 h-5 border-2 border-blue-500 border-t-transparent rounded-full"></div>
            <span class="text-white">Se încarcă...</span>
        </div>
    </div>

    <!-- Custom Styles pentru animații -->
    <style>
        /* Smooth transitions pentru schimbarea conținutului */
        [wire\:key] {
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
