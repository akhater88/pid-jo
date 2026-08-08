{{-- About Timeline Block --}}
@php
    $sectionTitle = $data['section_title'] ?? __('Explore Our Comprehensive Interior Design Services');
    $sectionBadge = $data['section_badge'] ?? __('Our Story');

    // Extract file path from array (FileUpload format) or use as string (legacy) for 1951 image
    $timeline1951ImageRaw = $data['timeline_1951_image'] ?? null;
    $timeline1951ImagePath = is_array($timeline1951ImageRaw) ? ($timeline1951ImageRaw[0] ?? null) : $timeline1951ImageRaw;
    $timeline1951Image = $timeline1951ImagePath
        ? ((str_starts_with($timeline1951ImagePath, 'http://') || str_starts_with($timeline1951ImagePath, 'https://') || str_starts_with($timeline1951ImagePath, '/'))
            ? asset($timeline1951ImagePath)
            : asset('storage/' . $timeline1951ImagePath))
        : asset('images/about-timeline-1951.jpg');

    $centerTitle = $data['center_title'] ?? __('Supervision & execution Accessories');
    $centerDescription = $data['center_description'] ?? '';

    // Extract file path from array (FileUpload format) or use as string (legacy) for 2026 image
    $timeline2026ImageRaw = $data['timeline_2026_image'] ?? null;
    $timeline2026ImagePath = is_array($timeline2026ImageRaw) ? ($timeline2026ImageRaw[0] ?? null) : $timeline2026ImageRaw;
    $timeline2026Image = $timeline2026ImagePath
        ? ((str_starts_with($timeline2026ImagePath, 'http://') || str_starts_with($timeline2026ImagePath, 'https://') || str_starts_with($timeline2026ImagePath, '/'))
            ? asset($timeline2026ImagePath)
            : asset('storage/' . $timeline2026ImagePath))
        : asset('images/about-timeline-2026.jpg');
@endphp

<section class="pesaro-about-timeline">
    <div class="pesaro-about-timeline-container">
        <!-- Section Heading -->
        <div class="pesaro-timeline-header">
            <!-- Badge -->
            <div class="pesaro-timeline-badge">
                <ul>
                    <li>{{ $sectionBadge }}</li>
                </ul>
            </div>

            <!-- Title -->
            <div class="pesaro-timeline-title">
                @if(app()->isLocale('en'))
                    <p>
                        <span>{{ __('Explore Our ') }}</span><span class="gold">{{ __('Comprehensive') }}</span>
                    </p>
                    <p>
                        <span class="gold">{{ __('Interior Design') }}</span><span> {{ __('Services') }}</span>
                    </p>
                @else
                    <p>
                        <span>{{ __('استكشف خدماتنا ') }}</span><span class="gold">{{ __('الشاملة') }}</span>
                    </p>
                    <p>
                        <span class="gold">{{ __('للتصميم الداخلي') }}</span>
                    </p>
                @endif
            </div>
        </div>

        <!-- Mobile Timeline (visible on mobile only) -->
        <div class="pesaro-timeline-mobile">
            <!-- Timeline Item 1 (1951) -->
            <div class="pesaro-timeline-item">
                <!-- Top Section: Image and Timeline -->
                <div class="pesaro-timeline-item-top">
                    <!-- Timeline Line with Dot -->
                    <div class="pesaro-timeline-line-wrapper">
                        <!-- Container for line and dot -->
                        <div class="pesaro-timeline-line-container">
                            <div class="pesaro-timeline-line-inner">
                                <div class="pesaro-timeline-line"></div>
                                <div class="pesaro-timeline-dot-top"></div>
                            </div>
                        </div>
                        <!-- Year -->
                        <p class="pesaro-timeline-year">1951</p>
                    </div>

                    <!-- Image -->
                    <img
                        src="{{ $timeline1951Image }}"
                        alt="{{ __('Founded in 1951') }}"
                        class="pesaro-timeline-image"
                    >
                </div>

                <!-- Content Card -->
                <div class="pesaro-timeline-card">
                    <div class="pesaro-timeline-card-content">
                        <h3 class="pesaro-timeline-card-title">
                            {{ $centerTitle }}
                        </h3>
                        <p class="pesaro-timeline-card-description">
                            {{ $centerDescription }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timeline Item 2 (2026) -->
            <div class="pesaro-timeline-item">
                <!-- Top Section: Image and Timeline -->
                <div class="pesaro-timeline-item-top">
                    <!-- Timeline Line with Dot -->
                    <div class="pesaro-timeline-line-wrapper">
                        <!-- Container for line and dot -->
                        <div class="pesaro-timeline-line-container">
                            <div class="pesaro-timeline-line-inner">
                                <div class="pesaro-timeline-line"></div>
                                <div class="pesaro-timeline-dot-bottom"></div>
                            </div>
                        </div>
                        <!-- Year -->
                        <p class="pesaro-timeline-year">2026</p>
                    </div>

                    <!-- Image -->
                    <img
                        src="{{ $timeline2026Image }}"
                        alt="{{ __('Looking to 2026') }}"
                        class="pesaro-timeline-image"
                    >
                </div>

                <!-- Content Card -->
                <div class="pesaro-timeline-card">
                    <div class="pesaro-timeline-card-content">
                        <h3 class="pesaro-timeline-card-title">
                            {{ $centerTitle }}
                        </h3>
                        <p class="pesaro-timeline-card-description">
                            {{ $centerDescription }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Timeline (visible on desktop only) -->
        <div class="pesaro-timeline-desktop">
            <div class="pesaro-timeline-desktop-wrapper">
                <!-- 1951 Timeline - Left -->
                <div class="pesaro-timeline-left">
                    <!-- Image -->
                    <img
                        src="{{ $timeline1951Image }}"
                        alt="{{ __('Founded in 1951') }}"
                    >
                    <!-- Line with dot and year -->
                    <div class="pesaro-timeline-left-content">
                        <!-- Line with dot -->
                        <div class="pesaro-timeline-left-line-container">
                            <div class="pesaro-timeline-horizontal-line"></div>
                            <div class="pesaro-timeline-horizontal-dot-left"></div>
                        </div>
                        <!-- Year -->
                        <p class="pesaro-timeline-desktop-year">1951</p>
                    </div>
                </div>

                <!-- Center Card -->
                <div class="pesaro-timeline-center">
                    <div class="pesaro-timeline-center-content">
                        <p class="pesaro-timeline-center-title">
                            {{ $centerTitle }}
                        </p>
                        <p class="pesaro-timeline-center-description">
                            {{ $centerDescription }}
                        </p>
                    </div>
                </div>

                <!-- 2026 Timeline - Right -->
                <div class="pesaro-timeline-right">
                    <!-- Image -->
                    <img
                        src="{{ $timeline2026Image }}"
                        alt="{{ __('Looking to 2026') }}"
                    >
                    <!-- Line with dot and year -->
                    <div class="pesaro-timeline-right-content">
                        <!-- Line with dot -->
                        <div class="pesaro-timeline-left-line-container">
                            <div class="pesaro-timeline-horizontal-line"></div>
                            <div class="pesaro-timeline-horizontal-dot-right"></div>
                        </div>
                        <!-- Year -->
                        <p class="pesaro-timeline-desktop-year">2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
