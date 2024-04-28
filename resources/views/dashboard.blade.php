<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Videoclipuri') }}
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900">
                    {{ __('Bine ai venit! Aici ai acces la toate PREMIERELE si la toata colectia de videoclipuri') }}
                </div>


                <div class="p-6">

                    <div class="">
                        @livewire('search-videos')
                    </div>

                    


                    @livewire('recent-videos')
                </div>

                {{--   <div class="p-6">

                    @livewire('popular-videos') </div> --}}

                <div class="p-6">
                    @livewire('featured-video') </div>

                <div class="p-6">

                    @livewire('video-dashboard') </div>

            </div>
        </div>
    </div>



</x-app-layout>
