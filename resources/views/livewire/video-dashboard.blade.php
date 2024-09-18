<div>
    <h2 class="mb-6 text-2xl font-bold text-gray-800">Toate videoclipurile</h2>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($videos as $video)
            <div class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
                <a href="{{ route('videos.show', $video) }}" class="block">
                    <div class="aspect-w-16 aspect-h-9">
                        {!! $video->embed_link !!}
                    </div>
                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-semibold text-gray-800 line-clamp-1">{{ $video->title }}</h3>
                        <p class="flex items-center text-blue-500 hover:text-blue-600">
                            Vezi mai mult
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>