<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($recentVideos as $video)
        <div class="overflow-hidden transition-all duration-300 bg-gray-800/50 backdrop-blur border border-gray-700/30 rounded-xl group hover:scale-[1.02]">
            <!-- Player Video - independent păstrăm structura care funcționează -->
            <div class="aspect-w-16 aspect-h-9">
                {!! $video->embed_link !!}
            </div>
            
            <!-- Link și informații cu designul nou -->
            <div class="p-6">
                <h3 class="mb-3 text-lg font-semibold text-white line-clamp-1">{{ $video->title }}</h3>
                <a href="{{ route('videos.show', $video) }}" 
                   class="flex items-center text-blue-400 transition-all duration-300 group-hover:text-blue-300">
                    Vezi mai mult
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" 
                         viewBox="0 0 20 20" 
                         fill="currentColor">
                        <path fill-rule="evenodd" 
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" 
                              clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
</div>