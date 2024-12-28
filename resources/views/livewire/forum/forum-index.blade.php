
<div class="min-h-screen py-12 bg-black">
   <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
         <div class="p-6 border border-gray-800 rounded-xl bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-blue-600/10">
            <h2 class="mb-2 text-xl font-semibold text-white">Forumul de discuții "Comunitate"</h2>
            <p class="text-gray-300">Îmi doresc ca aici să formăm o comunitate unită prin muzică. La fiecare lansare voi crea o nouă discuție unde voi pune detalii, story-uri și videouri scurte pentru ca voi sa ma ajutați să promovez piesa lansată. </p>
        </div>
    <!-- Header cu acțiuni -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <!-- Căutare -->
            {{-- <div class="relative">
                <input type="text" 
                       wire:model.debounce.300ms="search"
                       class="w-64 px-4 py-2 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="Caută în forum...">
            </div> --}}
        </div>

        <!-- Buton creare categorie pentru admini -->
        @if(auth()->user()->usertype === 'admin')
            <button 
                wire:click="$set('showCreateModal', true)"
                class="px-4 py-2 mt-6 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                Creează Categorie Nouă
            </button>
        @endif
    </div>

    <!-- Modal pentru creare categorie -->
    @if(auth()->user()->usertype === 'admin')
        <div x-data="{ show: @entangle('showCreateModal') }"
             x-show="show"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             aria-labelledby="modal-title"
             role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75"
                     aria-hidden="true"></div>

                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
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
                                    <input type="text" 
                                           wire:model="newCategory.name"
                                           class="w-full mt-1 text-gray-300 bg-gray-700 border-gray-600 rounded-lg focus:ring-blue-500">
                                    @error('newCategory.name') 
                                        <span class="text-sm text-red-500">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-300">
                                        Descriere
                                    </label>
                                    <textarea 
                                        wire:model="newCategory.description"
                                        rows="3"
                                        class="w-full mt-1 text-gray-300 bg-gray-700 border-gray-600 rounded-lg focus:ring-blue-500"></textarea>
                                    @error('newCategory.description') 
                                        <span class="text-sm text-red-500">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div>
                                    <label for="color" class="block text-sm font-medium text-gray-300">
                                        Culoare
                                    </label>
                                    <input type="color" 
                                           wire:model="newCategory.color"
                                           class="block w-full h-10 mt-1 bg-gray-700 border-gray-600 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-5 space-x-3">
                        <button type="button"
                                wire:click="$set('showCreateModal', false)"
                                class="px-4 py-2 text-sm text-gray-300 border border-gray-600 rounded-lg hover:bg-gray-700">
                            Anulează
                        </button>
                        <button type="button"
                                wire:click="createCategory"
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
            @foreach($categories as $category)
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    
                    <a href="{{ route('forum.categories.show', $category) }}" 
                       class="relative block p-6 transition bg-gray-900/90 backdrop-blur-sm rounded-xl hover:bg-gray-900/95">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                            <div class="px-3 py-1 text-sm text-blue-400 rounded-full bg-blue-400/10">
                                {{ $category->threads_count }} discuții
                            </div>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-400">{{ $category->description }}</p>
                        
                        @if($category->latest_thread)
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $category->latest_thread->user->avatar }}" 
                                         alt="{{ $category->latest_thread->user->name }}"
                                         class="w-6 h-6 rounded-full">
                                    <div class="text-sm text-gray-400">
                                        Ultima postare de <span class="font-medium text-blue-400">{{ $category->latest_thread->user->name }}</span>
                                        <span class="text-gray-600">{{ $category->latest_thread->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>