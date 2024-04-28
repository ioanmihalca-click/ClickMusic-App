div>
<h2 class="mb-4 text-lg font-semibold">Videoclipuri Populare</h2>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">

    @foreach ($popularVideos as $video)
            <div class="max-w-xs mx-0 overflow-hidden rounded-lg shadow-lg sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
            <div class="mb-4 aspect-w-16 aspect-h-9">
                {!! $video->embed_link !!}
            </div>
            <h3 class="mb-1 text-base font-semibold">{{ $video->title }}</h3>
            <p class="text-sm text-gray-600">{{ $video->description }}</p>
        </div>
    @endforeach
</div>
</div>
