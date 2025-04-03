@props([
    'type' => 'info', // success, error, warning, info
    'message' => null,
])

@php
    $baseClasses = 'mb-4 p-4 rounded-lg border shadow-sm';
    $typeStyles = [
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'error' => 'bg-red-100 text-red-800 border-red-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'info' => 'bg-blue-100 text-blue-800 border-blue-300',
    ];
    $classes = $baseClasses . ' ' . ($typeStyles[$type] ?? $typeStyles['info']);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $message ?? $slot }}
</div>
