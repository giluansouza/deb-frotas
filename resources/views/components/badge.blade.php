@props(['text'])

@php
    $base = 'inline-block text-xs px-4 py-1 rounded-full';
    $colorMap = [
        'orange' => 'bg-orange-100 text-orange-500',
        'red' => 'bg-red-100 text-red-500',
        'blue' => 'bg-blue-100 text-gray-500',
        'green' => 'bg-green-100 text-green-500',
        'gray' => 'bg-gray-100 text-gray-500',
    ];
@endphp

<span class="{{ $base }} {{ $colorMap[$color] ?? $colorMap['gray'] }} {{ $bold ? 'font-semibold' : '' }}">
    {{ $text }}
</span>