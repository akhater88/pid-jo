@props([
    'variant' => 'primary', // primary, secondary, outline
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary';

$variantClasses = [
    'primary' => 'bg-primary hover:bg-primary-600 text-white',
    'secondary' => 'bg-secondary hover:bg-secondary-lighter text-white',
    'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
];

$sizeClasses = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-2.5 text-base',
    'lg' => 'px-8 py-3 text-lg',
];

$classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
