<div>
    <h2 class="mb-4 text-lg font-semibold ">PREMIERA <br> <span class="px-2 text-white bg-blue-500 rounded">Exclusiv pe clickmusic.ro</span> </h2>

    @if ($featuredVideo)
        <div class="overflow-hidden rounded-lg shadow-lg">

            <a href="{{ route('videos.show', $featuredVideo) }}">
                <div class="mb-4 aspect-w-16 aspect-h-9">
                    {!! $featuredVideo->embed_link !!}
                </div>
                <h3 class="pl-1 mb-1 text-base font-semibold">{{ $featuredVideo->title }}</h3>
                   <p class="pl-1 text-base text-gray-600">Vezi mai mult... <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 ml-1 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L12.586 11H3a1 1 0 0 1 0-2h9.586l-2.293-2.293a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
                    </svg></p>
            </a>

        </div>
    @else
        <p>No featured video available.</p>
    @endif
</div>
