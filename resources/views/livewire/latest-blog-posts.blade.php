<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    @foreach ($posts as $post)
        <article class="overflow-hidden bg-white rounded-lg shadow-md">
            @if($post->featured_image)
                <div class="relative overflow-hidden aspect-w-16 aspect-h-9">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                </div>
            @endif
            <div class="p-4">
                <h2 class="mb-2 text-lg font-bold text-gray-800 line-clamp-2">
                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600">
                        {{ $post->title }}
                    </a>
                </h2>
                <div class="mb-2 text-xs text-gray-600">
                    {{ $post->published_at->format('F j, Y') }}
                </div>
                <div class="mb-4 text-sm text-gray-700 line-clamp-3">
                    {{ Str::limit(strip_tags($post->body), 100) }}
                </div>
                <a href="{{ route('blog.show', $post->slug) }}" class="inline-block px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                    Citește mai mult
                </a>
            </div>
        </article>
    @endforeach
</div>