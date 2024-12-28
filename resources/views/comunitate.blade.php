
<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <!-- Header cu gradient -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
            </div>

            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                            Comunitatea Click Music
                        </h1>
                        <p class="mt-2 text-gray-400">
                            Conectează-te cu alți membri și discută despre muzică, evenimente și experiențe
                        </p>
                    </div>
                    @auth
                        <a href="{{ route('forum.threads.create') }}" 
                           wire:navigate
                           class="px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            Crează o discuție nouă
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Componenta Livewire pentru Forum Index -->
        <div class="mb-8">
            <livewire:forum.forum-index />
        </div>
    </div>

    <!-- Notificări -->
    <div x-data="{ show: false, message: '' }"
         x-on:notify.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed bottom-4 right-4">
        <div class="px-4 py-2 text-white bg-green-500 rounded-lg shadow-lg">
            <span x-text="message"></span>
        </div>
    </div>
</x-app-layout>