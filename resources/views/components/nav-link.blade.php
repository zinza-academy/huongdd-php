@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-black hover:text-blue-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-white hover:text-blue-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
