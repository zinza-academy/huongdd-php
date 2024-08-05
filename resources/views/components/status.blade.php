@props(['status'])
@php
    $colorMatch = [
        'bg-green',
        'bg-red',
        'bg-gray'
    ];
@endphp

<span class="text-white {{$colorMatch[$status]}}">
    {{$slot}}
</span>
