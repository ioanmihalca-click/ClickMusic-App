<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $video->title }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <div class="w-full mb-4 aspect-w-16 aspect-h-9">
                    {!! $video->embed_link !!}
                </div>
                <div class="flex flex-wrap items-center p-2">
                    <div class="w-full mb-4 md:w-auto md:mb-0 md:mr-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="px-2 py-1 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">Share on
                            Facebook</a>
                    </div>
                @livewire('videos.like', ['video' => $video])


                </div>
                <h3 class="p-2 mb-1 text-base font-semibold">{{ $video->title }}</h3>
                <p class="p-2 text-sm text-gray-600">{!! nl2br($video->description) !!}</p>

                <div class="p-2 text-sm text-black">
                    @livewire('comments.all-comments', ['videoId' => $video->id])
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@livewireScripts
