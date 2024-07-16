<div>
    <h2 class="mb-4 text-lg font-semibold">Videoclipuri Recente</h2>
    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
        @foreach($recentVideos as $video)
            <div class="max-w-xs mx-0 overflow-hidden rounded-lg shadow-lg sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
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
</div>
