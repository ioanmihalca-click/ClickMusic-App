<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900">
                    {{ __("Bine ai venit! Aici ai acces la toate PREMIERELE si la toata colectia de videoclipuri") }}
                </div>


 @include('/components/video-dashboard')


            </div>
        </div>

        

    
</x-app-layout>
