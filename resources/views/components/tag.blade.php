@props(['color'])

<span style="background-color: {{ $color }}" class="inline-block text-white px-3 py-1">
    {{ $slot }}
</span>
