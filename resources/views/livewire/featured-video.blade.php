<div>
<h2 class="mb-4 text-lg font-semibold ">Videoclip Promovat</h2>

@if($featuredVideo)
            <div class="overflow-hidden rounded-lg shadow-lg">
    <div class="mb-4 aspect-w-16 aspect-h-9">
      {!! $featuredVideo->embed_link !!}
    </div>
    <h3 class="mb-1 text-base font-semibold">{{ $featuredVideo->title }}</h3>
    {{--<p class="text-sm text-gray-600">{{ $video->description }}</p>--}}
  </div>
@else
  <p>No featured video available.</p>
@endif
</div>