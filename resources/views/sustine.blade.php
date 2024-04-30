<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Sustine Artistul') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900">
                    {{ __('Daca rezonezi cu muzica, sustine artistul in realizarea urmatoarelor proiecte muzicale!') }}
                </div>

                <div class="flex justify-center mb-3 space-x-6">
                    <!-- PayPal Donation -->
                    <a href="http://www.paypal.me/ClickMusic" target="_blank" rel="noopener noreferrer"
                        class="inline-block px-4 py-1 text-sm font-semibold text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                        Doneaza prin PayPal
                    </a>

                    <!-- Revolut Donation -->
                    <a href="https://revolut.me/clickmusic" target="_blank" rel="noopener noreferrer"
                        class="inline-block px-4 py-1 text-sm font-semibold text-white bg-green-500 rounded-lg shadow-md hover:bg-green-600">
                        Donate via Revolut
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
