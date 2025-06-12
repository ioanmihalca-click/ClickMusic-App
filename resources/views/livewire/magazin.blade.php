<div>
    <!-- Header cu gradient și efect de glow -->
    <div class="relative">
        <!-- Gradient blur în fundal -->
        <div class="absolute inset-0 blur-3xl opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
        </div>

        <div class="relative z-10 px-6 mt-24 mb-12">
            <h1
                class="text-4xl font-bold tracking-[0.2em] text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                Albume
            </h1>
            <div class="w-24 h-1 mx-auto mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
        </div>
    </div>

    @if (session('error'))
        <div class="relative px-4 py-3 text-green-700 border rounded-lg bg-green-100/10 backdrop-blur-sm border-green-400/50"
            role="alert">
            <strong class="font-bold">Eroare:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Album List Component -->
    <livewire:album-list />
</div>
