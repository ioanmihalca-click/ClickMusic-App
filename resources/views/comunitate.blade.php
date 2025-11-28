
<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <!-- Header cu gradient -->
        <div class="relative mb-8">
            <div class="relative p-6 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-xl border border-white/10 rounded-2xl ring-1 ring-blue-400/5">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500">
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