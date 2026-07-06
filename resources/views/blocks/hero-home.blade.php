@php
// Hero Home Block - Full-screen hero with promo banners
$badge_text = $data['badge_text'] ?? 'Fast and Realable';
$title = $data['title'] ?? '';
$title_highlight = $data['title_highlight'] ?? 'Manage';
$subtitle = $data['subtitle'] ?? '';
$cta_text = $data['cta_text'] ?? __('Explore Services');
$cta_url = $data['cta_url'] ?? route('services.index');
$background_image = $data['background_image'] ?? null;

// Promo banners (right side cards)
$promo_1_title = $data['promo_1_title'] ?? 'Visit our showroom';
$promo_1_subtitle = $data['promo_1_subtitle'] ?? 'to get your 30% Discount';
$promo_1_badge = $data['promo_1_badge'] ?? '30% OFF';
$promo_1_image = $data['promo_1_image'] ?? null;

$promo_2_title = $data['promo_2_title'] ?? 'Visit our showroom';
$promo_2_subtitle = $data['promo_2_subtitle'] ?? 'to get your 20% Discount';
$promo_2_badge = $data['promo_2_badge'] ?? '20% OFF';
$promo_2_image = $data['promo_2_image'] ?? null;
@endphp

<section class="pesaro-hero">
    <!-- Background Image with Overlays -->
    <div class="pesaro-hero-bg">
        <div class="pesaro-hero-bg-inner">
            @if($background_image)
                <img src="{{ asset('storage/' . $background_image) }}" alt="{{ $title }}">
            @else
                <img src="{{ asset('storage/hero-images/hero-home-bg.jpg') }}" alt="Pesaro Interior">
            @endif
        </div>
        <div class="pesaro-hero-overlay-1"></div>
        <div class="pesaro-hero-overlay-2"></div>
    </div>
    <!-- Content -->
    <div class="pesaro-hero-content">
        <div class="pesaro-hero-content-container">
            <div class="pesaro-hero-flex">
                <!-- Left: Main Content -->
                <div class="pesaro-hero-text">
                    <!-- Badge -->
                    @if($badge_text)
                        <div class="pesaro-badge">
                            <ul><li>{{ $badge_text }}</li></ul>
                        </div>
                    @endif

                    <!-- Title & Subtitle -->
                    <div class="pesaro-hero-title-wrap">
                        @if($title)
                            <h1 class="pesaro-hero-title" style="overflow: visible;">
                                @if($title_highlight)
                                    <span class="gold relative inline-block pb-3">
                                        {{ $title_highlight }}
                                        <img src="{{ asset('images/text-underline.svg') }}"
                                             alt=""
                                             class="absolute start-0 bottom-0 w-full h-auto pointer-events-none"
                                             style="max-width: 100%;"
                                             aria-hidden="true">
                                    </span> {{ $title }}
                                @else
                                    {{ $title }}
                                @endif
                            </h1>
                        @endif

                        @if($subtitle)
                            <p class="pesaro-hero-subtitle">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>

                    <!-- CTA Button -->
                    @if($cta_text)
                        <a href="{{ $cta_url }}" class="pesaro-hero-btn">
                            {{ $cta_text }}
                        </a>
                    @endif
                </div>

                <!-- Right: Promo Banners (Desktop Only) -->
                <div class="pesaro-promo-banners">
                    <!-- Promo Card 1 -->
                    <div class="pesaro-promo-card-wrap">
                        <div class="pesaro-promo-card">
                            <!-- Background -->
                            <div class="pesaro-promo-bg">
                                @if($promo_1_image)
                                    <img src="{{ $promo_1_image }}" alt="{{ $promo_1_title }}">
                                @else
                                    <img src="{{ asset('images/hero-bg.jpg') }}" alt="{{ $promo_1_title }}">
                                @endif
                                <div class="pesaro-promo-bg-overlay"></div>
                            </div>

                            <!-- Content -->
                            <div class="pesaro-promo-content">
                                <h3>{{ $promo_1_title }}</h3>
                                <p>{{ $promo_1_subtitle }}</p>
                            </div>
                        </div>

                        <!-- Badge -->
                        <div class="pesaro-promo-badge">
                            <p>{{ $promo_1_badge }}</p>
                        </div>
                    </div>

                    <!-- Promo Card 2 -->
                    <div class="pesaro-promo-card-wrap">
                        <div class="pesaro-promo-card">
                            <!-- Background -->
                            <div class="pesaro-promo-bg">
                                @if($promo_2_image)
                                    <img src="{{ $promo_2_image }}" alt="{{ $promo_2_title }}">
                                @else
                                    <img src="{{ asset('images/hero-bg.jpg') }}" alt="{{ $promo_2_title }}">
                                @endif
                                <div class="pesaro-promo-bg-overlay"></div>
                            </div>

                            <!-- Content -->
                            <div class="pesaro-promo-content">
                                <h3>{{ $promo_2_title }}</h3>
                                <p>{{ $promo_2_subtitle }}</p>
                            </div>
                        </div>

                        <!-- Badge -->
                        <div class="pesaro-promo-badge">
                            <p>{{ $promo_2_badge }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="pesaro-scroll-indicator">
        <svg width="24" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>
