<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Videoclipuri') }}
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                {{-- Mesaj abonament cu succes --}}
                {{-- @dd(session('success')); --}}
                {{-- @if (Session::has('success'))
                    <div class="p-6 text-center bg-green-100 border-b border-green-200">
                        <p class="text-green-700">Abonamentul a fost creat cu succes!</p>
                    </div>
                @endif --}}

                <div class="p-2 text-center text-gray-900 md:p-6">
                    {{ __('Bine ai venit! Aici ai acces la toate PREMIERELE si la toata colectia de videoclipuri') }}
                </div>

                <div class="px-2 md:px-6">
                    @livewire('search-videos')
                </div>

                <div class="p-2 md:p-6">
                    @livewire('featured-video')
                </div>

                <div class="p-2 md:p-6">
                    @livewire('recent-videos')
                </div>

                {{--   <div class="p-2 md:p-6">

                    @livewire('popular-videos') </div> --}}



                <div class="p-2 md:p-6">

                    @livewire('video-dashboard') </div>

            </div>
        </div>
    </div>



</x-app-layout>
