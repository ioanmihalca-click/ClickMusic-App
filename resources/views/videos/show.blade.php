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
                <div class="flex flex-wrap items-center p-1">
                    <div class="flex items-center">
                        <div class="w-full mb-0 md:w-auto md:mb-0 md:mr-1">
                           {{-- <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('videos.share', $video->id)) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="px-2 py-1 text-xs text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                    Share on Facebook
                </a> --}}
                 <a href="https://www.facebook.com/sharer/sharer.php?u=https://clickmusic.ro"
       target="_blank"
       rel="noopener noreferrer"
       class="px-2 py-1 text-xs text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
       Share pe Facebook
    </a>

                        </div>

                        @livewire('videos.like', ['video' => $video])

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>



                        <!-- PayPal Donation -->
                        <a href="https://www.paypal.me/ClickMusic" target="_blank" rel="noopener noreferrer"
                            class="inline-block px-2 py-1 mr-3 text-xs font-semibold text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                            PayPal
                        </a>

                        <!-- Revolut Donation -->
                        <a href="https://revolut.me/clickmusic" target="_blank" rel="noopener noreferrer"
                            class="inline-block px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded-lg shadow-md hover:bg-green-600">
                            Revolut
                        </a>


                    </div>
                </div>




                <h3 class="p-2 mb-1 text-base font-semibold">{{ $video->title }}</h3>
                <p class="p-2 text-sm text-gray-600">{!! nl2br($video->description) !!}</p>
<div class="p-2">
    @livewire('video-recommendations', ['video' => $video]) 
    </div>
                <div class="p-2 text-sm text-black">
                    @livewire('comments.all-comments', ['videoId' => $video->id])
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@livewireScripts
