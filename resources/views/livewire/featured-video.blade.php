<div class="mb-8">
    <h2 class="mb-4 text-2xl font-bold text-gray-800">PREMIERA <span class="px-2 py-1 ml-2 text-sm text-white bg-blue-500 rounded-full">Exclusiv</span></h2>

    @if ($featuredVideo)
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <a href="{{ route('videos.show', $featuredVideo) }}" class="block transition duration-300 hover:opacity-90">
                <div class="aspect-w-16 aspect-h-9">
                    {!! $featuredVideo->embed_link !!}
                </div>
                <div class="p-4">
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $featuredVideo->title }}</h3>
                    <p class="flex items-center text-blue-500 hover:text-blue-600">
                        Vezi mai mult
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </p>
                </div>
            </a>
        </div>
    @else
        <p class="text-gray-600">No featured video available.</p>
    @endif
</div>