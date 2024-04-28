<div>
    <div class="flex mb-4">
        <input wire:model="searchTerm" type="text" class="flex-grow px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search Videos">
        <button wire:click="search" class="px-4 py-2 text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600">Search</button>
    </div>

    @if($searchResults->count() > 0)
        <div class="">
            @foreach($searchResults as $video)
                <div class="max-w-xs mx-auto mb-4 overflow-hidden rounded-lg shadow-lg sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                           
                    <div class="mb-4 aspect-w-16 aspect-h-9">
                        {!! $video->embed_link !!}
                    </div>
                    <h3 class="mb-1 text-base font-semibold">{{ $video->title }}</h3>
                    {{--<p class="text-sm text-gray-600">{{ $video->description }}</p>--}}
                </div>
            @endforeach
        </div>
    @endif

    {{-- Hide the message if there are search results --}}
    @if($searchTerm && $searchResults->isEmpty())
        <p class="text-gray-600">No results found for "{{ $searchTerm }}"</p>
    @endif
</div>
