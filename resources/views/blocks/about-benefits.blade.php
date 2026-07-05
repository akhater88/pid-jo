@php
// About Section with Benefits - Two column layout with text, benefits list, and image
$section_label = $data['section_label'] ?? 'About US';
$section_title = $data['section_title'] ?? 'What the Benefit to get Work with Pesaro';
$description = $data['description'] ?? '';
$about_image = $data['about_image'] ?? null;

// Benefits list
$benefits = $data['benefits'] ?? [
    [
        'title' => 'User Experience Design Team.',
        'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.'
    ],
    [
        'title' => 'User Experience Design Team.',
        'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.'
    ],
];
@endphp

<section class="pesaro-section pesaro-section-lighter" id="about">
    <div class="pesaro-container">
        <!-- Section Header -->
        <div class="pesaro-section-header">
            <p class="pesaro-section-label">
                {{ $section_label }}
            </p>
            <h2 class="pesaro-section-title">
                {{ $section_title }}
            </h2>
        </div>

        <!-- Content Grid -->
        <div class="pesaro-grid-2">
            <!-- Left: Text & Benefits -->
            <div>
                @if($description)
                    <p class="pesaro-about-text">
                        {{ $description }}
                    </p>
                @endif

                <!-- Benefits List -->
                @if(!empty($benefits))
                    <div class="pesaro-benefits">
                        @foreach($benefits as $benefit)
                            <div class="pesaro-benefit-item">
                                <!-- Icon -->
                                <div class="pesaro-benefit-icon">
                                    <svg width="24" height="24" fill="none" stroke="#c09a5b" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div class="pesaro-benefit-content">
                                    <h4>{{ $benefit['title'] ?? '' }}</h4>
                                    <p>{{ $benefit['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Image -->
            <div class="pesaro-about-image">
                @if($about_image)
                    <img src="{{ $about_image }}" alt="{{ $section_title }}">
                @endif
            </div>
        </div>
    </div>
</section>
