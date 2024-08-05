@props(['type'])

@php
    $classes = ($type === 'success') ?
    "p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400" :
    "p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400";
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="alert">
    <span class="font-medium">{{ $slot }}</span>
</div>
