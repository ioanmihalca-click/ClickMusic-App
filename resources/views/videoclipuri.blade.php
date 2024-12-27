<!-- videoclipuri.blade.php -->
<x-app-layout>
    <!-- Hero Header with Gradient -->
    <div class="relative bg-black">
        <div class="absolute inset-0 blur-3xl opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
        </div>
        
        <div class="relative px-6 py-16">
            <h1 class="text-4xl font-bold tracking-[0.2em] text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                Videoclipuri
            </h1>
            <div class="w-24 h-1 mx-auto mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
            
            <p class="max-w-2xl mx-auto mt-6 text-center text-gray-300">
                Te salut si iti multumesc ca ai ajuns pe pagina asta. Acesta este un club exclusiv si o comunitate. Te invit sa participi la discutiile din "Comunitate".
            <p class="max-w-2xl mx-auto mt-6 text-center text-gray-300">
              Aici vei gasi mereu toate piesele mele inainte de a fi lansate. Asculta cele doua piese noi care inca nu sunt lansate: "RESPECT" si "Bate inima ca bitu"
            </p>
            
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-black">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="px-4 mb-8">
                @livewire('search-videos')
            </div>
{{-- 
            <!-- Featured Video Section -->
            <div class="mb-12 overflow-hidden bg-gray-900 shadow-xl rounded-xl">
                @livewire('featured-video')
            </div> --}}

            <!-- Recent Videos Grid -->
            <div class="mb-12">
                <h2 class="mb-6 text-2xl font-semibold tracking-wide text-blue-400 uppercase">
                    Videoclipuri Recente
                </h2>
                @livewire('recent-videos')
            </div>

            <!-- Video Dashboard Grid -->
            <div>
                <h2 class="mb-6 text-2xl font-semibold tracking-wide text-blue-400 uppercase">
                    Toate Videoclipurile
                </h2>
                @livewire('video-dashboard')
            </div>
        </div>
    </div>
</x-app-layout>