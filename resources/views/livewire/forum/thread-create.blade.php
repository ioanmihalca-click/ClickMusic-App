<!-- resources/views/livewire/forum/thread-create.blade.php -->
<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header cu gradient -->
        <div class="relative mb-8">
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
            </div>

            <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <h1
                    class="text-3xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                    Crează o discuție nouă
                </h1>
                <p class="mt-2 text-gray-400">Împărtășește gândurile tale cu comunitatea</p>
            </div>
        </div>

        <!-- Formular -->
        <div class="relative group">
            <div
                class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
            </div>

            <form wire:submit="save" class="relative p-6 space-y-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                <!-- Categoria -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-300">
                        Categoria
                    </label>
                    <select wire:model="category_id" id="category"
                        class="w-full mt-1 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Selectează o categorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titlu -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300">
                        Titlul discuției
                    </label>
                    <input type="text" wire:model="title" id="title"
                        class="w-full mt-1 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Introdu titlul discuției">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Conținut -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-300">
                        Conținut
                    </label>
                    <div class="mt-1">
                        <div class="relative">
                            <textarea wire:model="content" id="content" rows="8"
                                class="w-full px-4 py-3 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Despre ce vrei să discuți? Poți include detalii, întrebări sau orice informație relevantă."></textarea>
                            <div class="absolute top-2 right-2 text-xs text-gray-500">
                                Markdown suportat
                            </div>
                        </div>
                        @error('content')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="p-3 mt-2 space-y-2 text-sm text-gray-400 border border-gray-800 rounded-lg bg-gray-900/50">
                        <p class="font-medium">Formatare text:</p>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                            <div class="flex items-center">
                                <code class="p-1 mr-2 text-xs bg-gray-800 rounded"># Titlu</code>
                                <span>Titlu mare</span>
                            </div>
                            <div class="flex items-center">
                                <code class="p-1 mr-2 text-xs bg-gray-800 rounded">**bold**</code>
                                <span class="font-bold">Text bold</span>
                            </div>
                            <div class="flex items-center">
                                <code class="p-1 mr-2 text-xs bg-gray-800 rounded">*italic*</code>
                                <span class="italic">Text italic</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                            <div class="flex items-center">
                                <code class="p-1 mr-2 text-xs bg-gray-800 rounded">[link](url)</code>
                                <span class="text-blue-400 underline">Link</span>
                            </div>
                            <div class="flex items-center">
                                <code class="p-1 mr-2 text-xs bg-gray-800 rounded">![alt](url_imagine)</code>
                                <span>Imagine</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Butoane -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 text-gray-400 transition-colors duration-300 border border-gray-700 rounded-lg hover:text-white hover:border-gray-600">
                        Anulează
                    </a>
                    <button type="submit" wire:loading.attr="disabled"
                        class="px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-50">
                        <span wire:loading.remove>Publică discuția</span>
                        <span wire:loading>Se publică...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notificări -->
    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:notify.window="show = true; message = $event.detail.message; type='success'; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" class="fixed bottom-4 right-4 z-50">
        <div x-bind:class="{
            'bg-green-500': type === 'success',
            'bg-blue-500': type === 'info',
            'bg-yellow-500': type === 'warning',
            'bg-red-500': type === 'error'
        }"
            class="px-4 py-3 text-white rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg x-show="type === 'success'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span x-text="message"></span>
            </div>
        </div>
    </div>
</div>
