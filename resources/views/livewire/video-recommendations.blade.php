<div class="mt-8">
    <h3 class="mb-4 text-lg font-semibold text-blue-400">Videoclipuri Recomandate</h3>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($videos as $recommendedVideo) 
            <div class="overflow-hidden transition-all duration-300 bg-gray-800/50 backdrop-blur-sm border border-gray-700/30 rounded-xl group hover:scale-[1.02]">
                <a href="{{ route('videos.show', $recommendedVideo->id) }}" class="block"> 
                    <div class="relative aspect-w-16 aspect-h-9">
                        <img src="{{ $recommendedVideo->thumbnail_url }}" 
                             alt="{{ $recommendedVideo->title }}" 
                             class="object-cover w-full">
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/60 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-4">
                        <h4 class="text-sm font-medium text-white line-clamp-2 group-hover:text-blue-400">
                            {{ $recommendedVideo->title }}
                        </h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>