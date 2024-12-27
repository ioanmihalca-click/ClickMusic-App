<!-- Featured Video Component -->
<div class="p-6">
    <h2 class="mb-6 text-2xl font-bold tracking-wide text-blue-400 uppercase">
        PREMIERA 
        <span class="px-3 py-1 ml-2 text-sm font-medium text-white bg-blue-600 rounded-full">Exclusiv</span>
    </h2>

    @if ($featuredVideo)
        <div class="overflow-hidden transition-all duration-300 bg-gray-900 rounded-xl hover:ring-2 hover:ring-blue-500">
            <a href="{{ route('videos.show', $featuredVideo) }}" class="block">
                <div class="aspect-w-16 aspect-h-9">
                    {!! $featuredVideo->embed_link !!}
                </div>
                <div class="p-6">
                    <h3 class="mb-3 text-xl font-semibold text-white line-clamp-1">{{ $featuredVideo->title }}</h3>
                    <p class="flex items-center text-blue-400 transition-colors duration-300 group hover:text-blue-300">
                        Vezi mai mult
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" 
                             viewBox="0 0 20 20" 
                             fill="currentColor">
                            <path fill-rule="evenodd" 
                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" 
                                  clip-rule="evenodd" />
                        </svg>
                    </p>
                </div>
            </a>
        </div>
    @else
        <p class="text-gray-400">Nu există videoclip promovat momentan.</p>
    @endif
</div>