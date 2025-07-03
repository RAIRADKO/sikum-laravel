@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center mt-4 py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-white'
            : 'flex items-center mt-4 py-2 px-6 text-gray-400 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 border-l-4 border-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>