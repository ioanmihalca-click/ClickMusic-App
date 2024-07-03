<div class="p-8 bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-3xl font-bold text-center">Articole pe Blog</h1>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="block group"> {{-- Make the entire card clickable --}}
                @if ($post->featured_image)
                    <div class="relative overflow-hidden rounded-lg aspect-w-16 aspect-h-9">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black opacity-40"></div>
                    </div>
                @endif

                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-800 group-hover:text-blue-500">{{ $post->title }}</h2>
                    <p class="mt-2 text-gray-600">{{ $post->published_at->format('F j, Y') }}</p>
                    <p class="mt-2 text-gray-700">{{ $post->summary }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>

    <div class="mt-8">
    <a href="/" class="text-blue-600 hover:underline">&larr; Pagina principala</a>
</div>

</div>
