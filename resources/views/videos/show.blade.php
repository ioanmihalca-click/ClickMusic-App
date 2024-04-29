<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $video->title }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                

                <div class="w-full mb-4 aspect-w-16 aspect-h-9">
                    {!! $video->embed_link !!}
                </div>
<div class="flex flex-wrap items-center p-2">
                    <div class="w-full mb-4 md:w-auto md:mb-0 md:mr-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-2 py-1 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">Share on Facebook</a>
                    </div>

                    <button class="px-2 py-1 text-xs text-gray-600 hover:text-red-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-1 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3.105c2.198-3.29 8-3.29 8 4.63 0 4.358-2.462 6.906-5.792 9.28-1.464 1.133-2.143 1.787-2.208 1.846-.061-.054-.757-.715-2.208-1.846C4.462 14.611 2 12.063 2 7.695 2 3.785 7.802.815 10 3.105z" clip-rule="evenodd" />
                        </svg>
                        Like
                    </button>
                </div>
                <h3 class="p-2 mb-1 text-base font-semibold">{{ $video->title }}</h3>
            
                <!-- Allow HTML rendering for the description -->
                <p class="p-2 text-sm text-gray-600">{!! nl2br($video->description) !!}</p>
            </div>
        </div>
    </div>
</x-app-layout>
