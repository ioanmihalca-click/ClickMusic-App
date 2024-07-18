<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="mt-3">
            <x-filament::button type="submit">

                Trimite Email

            </x-filament::button>
        </div>
    </form>
</x-filament::page>
