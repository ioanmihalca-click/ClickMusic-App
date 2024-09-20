<div class="py-6 sm:py-12">
    <div class="px-4 mx-auto max-w-7xl ">
        <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-3 perspective-1000">
            @foreach ($posts as $index => $post)
                <article class="overflow-hidden bg-gray-50 border border-blue-500 rounded-lg shadow-md transition-all duration-500 ease-in-out transform-style-3d
                    @if($index === 0) md:rotate-y-30 md:hover:rotate-y-0
                    @elseif($index === 1) center-card md:hover:translate-z-10
                    @else md:-rotate-y-30 md:hover:rotate-y-0
                    @endif">
                    @if($post->featured_image)
                        <div class="relative overflow-hidden aspect-w-16 aspect-h-9">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                        </div>
                    @endif
                    <div class="p-4 sm:p-6">
                        <h2 class="mb-2 text-xl font-bold text-gray-800 line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <div class="mb-2 text-sm text-gray-600">
                            {{ $post->published_at->format('F j, Y') }}
                        </div>
                        <div class="mb-4 text-base text-gray-700 line-clamp-3">
                            {{ strip_tags($post->body) }}
                        </div>
                        {{-- <a href="{{ route('blog.show', $post->slug) }}" class="inline-block px-6 py-2 text-sm font-medium text-white transition-colors duration-300 bg-blue-500 rounded-lg hover:bg-blue-600">
                            Citește mai mult
                        </a> --}}
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
    @media (min-width: 768px) {
        .md\:rotate-y-30 {
            transform: rotateY(35deg);
        }
        .md\:-rotate-y-30 {
            transform: rotateY(-35deg);
        }
        .md\:hover\:rotate-y-0:hover {
            transform: rotateY(0deg);
        }
        .md\:hover\:translate-z-10:hover {
            transform: translateZ(10px);
        }
        .center-card {
            height: calc(100% - 2.5rem);
            margin-top: 1.2rem;
            margin-bottom: 1rem;
        }
    }
</style>
</div>