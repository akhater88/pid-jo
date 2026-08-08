{{-- About Us Hero Block --}}
@php
    $title = $data['title'] ?? __('About Us');
    // Extract file path from array (FileUpload format) or use as string (legacy)
    $backgroundImagePath = $data['background_image'] ?? null;
    $backgroundImagePath = is_array($backgroundImagePath) ? ($backgroundImagePath[0] ?? null) : $backgroundImagePath;
    $backgroundImage = !empty($backgroundImagePath)
        ? asset('storage/' . $backgroundImagePath)
        : asset('storage/hero-images/about-hero-bg.jpg');
@endphp

<section class="pesaro-about-hero">
    <!-- Background Image -->
    <div class="pesaro-about-hero-background">
        <img
            src="{{ $backgroundImage }}"
            alt="{{ $title }}"
        >
        <!-- Overlay Gradients -->
        <div class="pesaro-about-hero-overlay"></div>
    </div>

    <!-- Content -->
    <div class="pesaro-about-hero-content">
        <!-- Page Title -->
        <h1 class="pesaro-about-hero-title">
            {{ $title }}
        </h1>

        <!-- Breadcrumb -->
        <nav class="pesaro-about-hero-breadcrumb">
            <div class="pesaro-about-hero-breadcrumb-item">
                <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="pesaro-about-hero-breadcrumb-link">
                    {{ __('Home') }}
                </a>
                <div class="pesaro-about-hero-breadcrumb-separator">
                    <svg width="14" height="7" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 1.5L8.5 8.5L15.5 1.5" stroke="#C09A5B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <span class="pesaro-about-hero-breadcrumb-current">{{ $title }}</span>
        </nav>
    </div>
</section>
