<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 perspective-1000">
            @foreach ($posts as $index => $post)
                <article class="overflow-hidden bg-white rounded-lg shadow-md transition-all duration-300 ease-in-out transform-style-3d
                    @if($index === 0) rotate-y-30 hover:rotate-y-0
                    @elseif($index === 1) center-card hover:translate-z-10
                    @else -rotate-y-30 hover:rotate-y-0
                    @endif">
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
    </div>

<style>
    .perspective-1000 {
        perspective: 1000px;
    }
    .transform-style-3d {
        transform-style: preserve-3d;
    }
    .rotate-y-30 {
        transform: rotateY(30deg);
    }
    .-rotate-y-30 {
        transform: rotateY(-30deg);
    }
    .hover\:rotate-y-0:hover {
        transform: rotateY(0deg);
    }
    .hover\:translate-z-10:hover {
        transform: translateZ(10px);
    }
    .center-card {
        height: calc(100% - 2rem); /* Reduce height by 2rem (32px) */
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
</style>
</div>