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
                    <div class="flex items-center space-x-2">
                        {{-- <div class="w-full mb-0 md:w-auto md:mb-0 md:mr-1">

                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://clickmusic.ro" target="_blank"
                                rel="noopener noreferrer"
                                class="px-2 py-1 text-xs text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                                Share pe Facebook
                            </a>

                        </div> --}}

                        @livewire('videos.like', ['video' => $video])

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>



                        <!-- PayPal Donation -->
                         <a href="https://www.paypal.me/ClickMusic" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white transition duration-300 bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-1 bi bi-paypal" viewBox="0 0 16 16">
  <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.35.35 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91q.57-.403.993-1.005a4.94 4.94 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.7 2.7 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.7.7 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016q.326.186.548.438c.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.87.87 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.35.35 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32z"/>
</svg>
                            PayPal
                        </a>

                        <!-- Revolut Donation -->   
                        <a href="https://revolut.me/clickmusic" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white transition duration-300 rounded-lg shadow-md bg-emerald-500 hover:bg-emerald-600">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-1 bi bi-currency-exchange" viewBox="0 0 16 16">
  <path d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z"/>
</svg>
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
