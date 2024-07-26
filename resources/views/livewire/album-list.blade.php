<div>
    {{-- <div class="mb-4">
        <input wire:model.debounce.300ms="search" type="text" placeholder="Caută albume..."
            class="w-full px-4 py-2 border rounded-md">
    </div> --}}

    @if($albums->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($albums as $album)
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="aspect-w-1 aspect-h-1">
                <img src="{{ $album->cover_url }}" alt="{{ $album->titlu }}"
                    class="object-cover w-full h-full">
            </div>
            <div class="p-4">
                <h3 class="mb-2 text-xl font-semibold">{{ $album->titlu }}</h3>
                <p class="mb-2 text-gray-600">{!! Str::limit($album->descriere, 100) !!}</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold">{{ number_format($album->pret, 2) }} RON</span>
                    <a href="{{ route('album.show', $album->slug) }}"
                        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Detalii</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
        {{ $albums->links() }}
    @else
        <p>No albums found.</p>
    @endif
</div>