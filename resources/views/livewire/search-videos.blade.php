<div>
    <div class="flex mb-4">
        <input wire:model="searchTerm" type="text" class="flex-grow px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search Videos" wire:keyup.enter="search">
        <button wire:click="search" class="px-4 py-2 text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600">Search</button>
    </div>

    @if($searchResults->count() > 0)
        <div class="">
            @foreach($searchResults as $video)
                <div class="max-w-xs mx-auto mb-4 overflow-hidden rounded-lg shadow-lg sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                    <a href="{{ route('videos.show', $video) }}">
                        <div class="mb-4 aspect-w-16 aspect-h-9">
                            {!! $video->embed_link !!}
                        </div>
                        <h3 class="pl-1 mb-1 text-base font-semibold">{{ $video->title }}</h3>
                        <p class="pl-1 text-base text-gray-600">Vezi mai mult... <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 ml-1 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L12.586 11H3a1 1 0 0 1 0-2h9.586l-2.293-2.293a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                            </svg></p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Hide the message if there are search results --}}
    @if($searchTerm && $searchResults->isEmpty())
        <p class="text-gray-600">No results found for "{{ $searchTerm }}"</p>
    @endif
</div>
