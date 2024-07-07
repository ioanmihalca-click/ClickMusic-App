<div class="mt-4">
    <h3 class="mb-2 text-lg font-semibold text-gray-800">Videoclipuri Recomandate</h3>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($videos as $recommendedVideo) 
            <div class="p-2 bg-white border rounded-lg shadow-md">
                <a href="{{ route('videos.show', $recommendedVideo->id) }}"> 
                    <img src="{{ $recommendedVideo->thumbnail_url }}" alt="{{ $recommendedVideo->title }}" class="w-full mb-2 rounded">
                    <h4 class="text-sm font-semibold text-gray-700">{{ $recommendedVideo->title }}</h4>
                </a>
            </div>
        @endforeach
    </div>
</div>
