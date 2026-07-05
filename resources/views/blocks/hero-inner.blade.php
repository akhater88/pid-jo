@php
// Hero Inner Block - For inner pages with breadcrumbs
$title = $data['title'] ?? '';
$background_image = $data['background_image'] ?? null;
$breadcrumbs = $data['breadcrumbs'] ?? [];
@endphp

<section class="relative py-20 md:py-32 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        @if($background_image)
            <img src="{{ $background_image }}"
                 alt="{{ $title }}"
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-dark via-dark-lighter to-secondary"></div>
        @endif

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-dark/70"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        @if(!empty($breadcrumbs))
            <x-breadcrumb :items="$breadcrumbs" />
        @endif

        <!-- Title -->
        @if($title)
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                {{ $title }}
            </h1>
        @endif
    </div>
</section>
