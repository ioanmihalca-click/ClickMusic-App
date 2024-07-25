<div>
    <div class="mb-4">
        <input wire:model.debounce.300ms="search" type="text" placeholder="Caută albume..."
            class="w-full px-4 py-2 border rounded-md">
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($albums as $album)
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <img src="{{ asset('storage/' . $album->coperta_album) }}" alt="{{ $album->titlu }}"
                    class="object-cover w-full h-48">
                <div class="p-4">
                    <h3 class="mb-2 text-xl font-semibold">{{ $album->titlu }}</h3>
                    <p class="mb-2 text-gray-600">{{ Str::limit($album->descriere, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold">{{ number_format($album->pret, 2) }} RON</span>
                        <a href="{{ route('album.show', $album->slug) }}"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Detalii</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $albums->links() }}
    </div>
</div>
