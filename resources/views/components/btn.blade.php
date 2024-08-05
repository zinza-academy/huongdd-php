@props(['color'])

@php
    $classes = "cursor-pointer text-white bg-gradient-to-r from-$color-500 via-$color-600 to-$color-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-$color-300 dark:focus:ring-$color-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
@endphp

<a {{$attributes->merge(['class' => $classes])}}>
    {{$slot}}
</a>
