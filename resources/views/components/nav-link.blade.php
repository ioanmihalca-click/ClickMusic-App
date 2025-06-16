@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-2 pt-1 border-b-2 border-blue-400 text-sm font-medium leading-5 text-blue-400 focus:outline-none focus:border-blue-600 transition duration-300 ease-in-out'
    : 'inline-flex items-center px-2 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-blue-400 hover:border-blue-400/50 focus:outline-none focus:text-blue-400 focus:border-blue-400/50 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>