    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
        @foreach ($videos as $video)
            <div class="max-w-xs mx-0 overflow-hidden rounded-lg shadow-lg sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
              
                    <div class="mb-4 aspect-w-16 aspect-h-9">
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}">
                    </div>
                    <h3 class="pl-1 mb-1 text-sm font-normal">{{ $video->title }}</h3>
                
            </div>
        @endforeach
    </div>

