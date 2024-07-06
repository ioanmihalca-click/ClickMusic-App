
<article class="max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-4xl font-bold text-gray-800">{{ $post->title }}</h1>

    <div class="mb-4 text-gray-600">
        Publicat la data de {{ $post->published_at->format('F j, Y') }} de Click
    </div>

    @if ($post->featured_image)
        <div class="relative mb-6 overflow-hidden rounded-lg aspect-w-16 aspect-h-9"> 
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
        </div>
    @endif

    <div class="prose text-gray-800 max-w-none">
        {!! $post->body !!}
    </div>

    <div class="mt-8">
    <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline">&larr; Inapoi la Blog</a>
    
</div>

</article>
