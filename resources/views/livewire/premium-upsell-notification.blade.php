<div>
    @if ($show)
        <div class="fixed sm:bottom-4 sm:right-4 bottom-0 right-0 left-0 z-50 w-full sm:max-w-sm mx-auto sm:mr-0"
            x-data="{ shown: true }" x-show="shown" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-4">
            <div
                class="relative p-5 overflow-hidden bg-gradient-to-br from-gray-800/90 via-gray-900/95 to-blue-900/90 border border-blue-500/30 sm:rounded-xl rounded-t-xl shadow-2xl backdrop-blur-sm">
                <div
                    class="absolute -inset-1.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl opacity-10 animate-pulse">
                </div>

                <!-- Close button -->
                <button @click="shown = false; $wire.dismiss()"
                    class="absolute top-2 right-2 text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <div class="relative">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-blue-600/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-center text-white">Descoperă Conținutul Premium</h3>

                    <p class="mb-4 text-sm text-center text-gray-300">
                        Ai acces la comunitate, dar pentru a vedea toate videoclipurile exclusive, abonează-te la planul
                        Premium.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center sm:space-x-2 space-y-2 sm:space-y-0"> <a
                            href="{{ route('abonament') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-center">
                            Vezi planurile
                        </a>
                        <button wire:click="dismiss(24)"
                            class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 text-center">
                            Amintește-mi mâine
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
