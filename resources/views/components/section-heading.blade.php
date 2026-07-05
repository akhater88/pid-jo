@props([
    'title',
    'subtitle' => null,
    'align' => 'center', // left, center, right
])

@php
$alignClasses = [
    'left' => 'text-start',
    'center' => 'text-center',
    'right' => 'text-end',
];
@endphp

<div {{ $attributes->merge(['class' => 'mb-12 ' . $alignClasses[$align]]) }}>
    @if($subtitle)
        <p class="text-primary text-sm font-semibold uppercase tracking-wider mb-3">
            {{ $subtitle }}
        </p>
    @endif

    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
        {{ $title }}
    </h2>

    @if($slot->isNotEmpty())
        <div class="mt-4 text-lg text-white/70 max-w-3xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{ $slot }}
        </div>
    @endif
</div>
