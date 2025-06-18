<div class="absolute inset-0">
    <div class="absolute inset-0 z-10 flex items-center justify-center p-2 text-center bg-black bg-opacity-90">
        <div class="w-full mx-4 max-w-[280px] md:max-w-sm p-3 md:p-4 space-y-2 bg-gray-800 rounded-lg shadow">
            <h3 class="text-base md:text-lg font-bold text-blue-400">Conținut Exclusiv</h3>

            <div class="p-1.5 md:p-2 mb-2 border-l-4 border-blue-400 bg-blue-900/20">
                <p class="text-sm md:text-base text-gray-200">
                    Ai nevoie de <span class="font-bold text-blue-400">Plan Premium</span> pentru acest conținut.
                </p>
            </div>

            <div class="flex space-x-2 pt-2">
                <button wire:click="redirectToSubscription"
                    class="flex-1 px-3 py-1.5 md:px-4 md:py-2 text-xs md:text-sm text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-1">
                    Abonează-te
                </button>
                <a href="{{ route('abonament') }}"
                    class="flex-1 px-3 py-1.5 md:px-4 md:py-2 text-xs md:text-sm text-white border border-gray-600 rounded hover:bg-gray-700 focus:outline-none">
                    Vezi Planuri
                </a>
            </div>
        </div>
    </div>
</div>
