@props(['color'])
@php
    $classes = "text-white bg-$color-500 px-2 py-1";
@endphp

<span {{$attributes->merge(['class' => $classes])}}>
    {{$slot}}
</span>
