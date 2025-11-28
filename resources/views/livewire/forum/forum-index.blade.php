<div class="min-h-screen py-12 bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="p-6 border border-white/10 rounded-xl bg-gradient-to-r from-blue-600/10 via-cyan-500/10 to-emerald-500/10 backdrop-blur-xl shadow-glass">
            <h2 class="mb-2 text-xl font-semibold text-white">Forumul de discuții "Comunitate"</h2>
            <p class="text-gray-300">Îmi doresc ca aici să formăm o comunitate unită prin muzică. La fiecare lansare voi
                crea o nouă discuție unde voi pune detalii, story-uri și videouri scurte pentru ca voi sa ma ajutați să
                promovez piesa lansată. </p>
        </div>
        <!-- Header cu acțiuni -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div class="flex-grow flex items-center space-x-4">
                <!-- Căutare -->
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="w-full pl-10 pr-4 py-2 text-gray-300 bg-gray-800/80 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Caută categorii în forum...">
                </div>
            </div>

            <!-- Buton creare categorie pentru admini -->
            @if (auth()->user()->usertype === 'admin')
                <button wire:click="$set('showCreateModal', true)"
                    class="inline-flex items-center px-4 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Creează Categorie Nouă
                </button>
            @endif
        </div>

        <!-- Modal pentru creare categorie -->
        @if (auth()->user()->usertype === 'admin')
            <div x-data="{ show: @entangle('showCreateModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>

                    <div x-show="show" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-gray-800 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-white">
                                Creează o Categorie Nouă
                            </h3>
                            <div class="mt-4">
                                <div class="space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-300">
                                            Nume Categorie
                                        </label>
                                        <input type="text" wire:model="newCategory.name"
                                            class="w-full mt-1 text-gray-300 bg-gray-700 border-gray-600 rounded-lg focus:ring-blue-500">
                                        @error('newCategory.name')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-300">
                                            Descriere
                                        </label>
                                        <textarea wire:model="newCategory.description" rows="3"
                                            class="w-full mt-1 text-gray-300 bg-gray-700 border-gray-600 rounded-lg focus:ring-blue-500"></textarea>
                                        @error('newCategory.description')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="color" class="block text-sm font-medium text-gray-300">
                                            Culoare
                                        </label>
                                        <input type="color" wire:model="newCategory.color"
                                            class="block w-full h-10 mt-1 bg-gray-700 border-gray-600 rounded-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-5 space-x-3">
                            <button type="button" wire:click="$set('showCreateModal', false)"
                                class="px-4 py-2 text-sm text-gray-300 border border-gray-600 rounded-lg hover:bg-gray-700">
                                Anulează
                            </button>
                            <button type="button" wire:click="createCategory"
                                class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Creează Categoria
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Categorii -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($categories as $category)
                <div class="relative group">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                    </div>

                    <a href="{{ route('forum.categories.show', $category) }}"
                        class="relative block p-6 glass-card hover:bg-slate-900/85">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg"
                                    style="background-color: {{ $category->color }};">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                            </div>
                            <div class="px-3 py-1 text-sm text-blue-400 rounded-full bg-blue-400/10">
                                {{ $category->threads_count }} discuții
                            </div>
                        </div>

                        <p class="mt-2 text-sm text-gray-400">{{ $category->description }}</p>

                        <div class="flex flex-wrap items-center mt-4 gap-4 text-xs text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                {{ $category->replies_count }} răspunsuri
                            </div>
                        </div>

                        @if ($category->latest_thread)
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-start space-x-3">
                                    <img src="{{ $category->latest_thread->user->avatar }}"
                                        alt="{{ $category->latest_thread->user->name }}"
                                        class="w-8 h-8 rounded-full ring-1 ring-blue-500/30">
                                    <div>
                                        <div class="text-sm font-medium text-blue-400 line-clamp-1">
                                            {{ $category->latest_thread->title }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <span
                                                class="font-medium text-gray-400">{{ $category->latest_thread->user->name }}</span>
                                            • {{ $category->latest_thread->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="text-sm text-center text-gray-500">Nicio discuție încă</div>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Notificări -->
    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:category-created.window="show = true; message = $event.detail.message; type='success'; setTimeout(() => show = false, 3000)"
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
