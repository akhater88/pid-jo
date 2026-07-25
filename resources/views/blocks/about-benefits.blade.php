@php
// About Section with Benefits - Matches homepage design
$section_label = $data['section_label'] ?? 'About US';
$section_title = $data['section_title'] ?? 'What the Benefit to get Work with Pesaro';
$description = $data['description'] ?? '';
$main_image = $data['main_image'] ?? null;
$small_image = $data['small_image'] ?? null;

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

{{-- About Us Section --}}
<section class="pesaro-about-section">
    <div class="pesaro-container">
        <div class="pesaro-about-content">
            {{-- Left: Layered Images --}}
            <div class="pesaro-about-images">
                {{-- Main large image (background) --}}
                <div class="pesaro-about-image-main">
                    @if($main_image)
                        @php
                            // Handle both new FileUpload paths and legacy text input paths
                            $mainImageUrl = str_starts_with($main_image, '/') || str_starts_with($main_image, 'http')
                                ? asset($main_image)
                                : asset('storage/' . $main_image);
                        @endphp
                        <img src="{{ $mainImageUrl }}" alt="{{ $section_title }}">
                    @else
                        <img src="{{ asset('images/about-main.jpg') }}" alt="{{ __('Pesaro Interior Design') }}">
                    @endif
                    <div class="pesaro-about-image-overlay"></div>
                </div>

                {{-- Small overlapping image (foreground) --}}
                <div class="pesaro-about-image-small">
                    @if($small_image)
                        @php
                            // Handle both new FileUpload paths and legacy text input paths
                            $smallImageUrl = str_starts_with($small_image, '/') || str_starts_with($small_image, 'http')
                                ? asset($small_image)
                                : asset('storage/' . $small_image);
                        @endphp
                        <img src="{{ $smallImageUrl }}" alt="{{ $section_title }}">
                    @else
                        <img src="{{ asset('images/about-small.jpg') }}" alt="{{ __('Pesaro Projects') }}">
                    @endif
                    <div class="pesaro-about-image-small-overlay"></div>
                </div>
            </div>

            {{-- Right: Text Content --}}
            <div class="pesaro-about-text-content">
                <div class="pesaro-about-heading">
                    <div class="pesaro-about-heading-top">
                        {{-- Badge --}}
                        <div class="pesaro-about-badge">
                            <ul><li>{{ $section_label }}</li></ul>
                        </div>

                        {{-- Title --}}
                        <h2 class="pesaro-about-title">
                            {!! $section_title !!}
                        </h2>
                    </div>

                    {{-- Description --}}
                    @if($description)
                        <p class="pesaro-about-text">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                {{-- Benefits List --}}
                @if(!empty($benefits))
                    <div class="pesaro-benefits">
                        @foreach($benefits as $benefit)
                            <div class="pesaro-benefit-item">
                                <div class="pesaro-benefit-icon">
                                    <img src="{{ asset('images/check-circle.svg') }}" alt="">
                                </div>
                                <div class="pesaro-benefit-content">
                                    <h4>{{ $benefit['title'] ?? '' }}</h4>
                                    <p>{{ $benefit['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
