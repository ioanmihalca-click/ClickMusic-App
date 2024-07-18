<x-filament-widgets::widget>

    <x-filament::section>
       <div x-data="{ open: false }" class="max-w-md p-1 mb-1 bg-white rounded-md shadow-md">
                <button @click="open = !open">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold text-center text-black">Trimite o notificare abonatilor in aplicatie</h2>
                        {{-- <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500 ">+</span>
                        <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span> --}}
                    </div>
                </button>
                <div x-show="open" x-transition>
                    <livewire:megaphone-admin></livewire:megaphone-admin>
                </div>
            </div>
    </div>
    </x-filament::section>
</x-filament-widgets::widget>
