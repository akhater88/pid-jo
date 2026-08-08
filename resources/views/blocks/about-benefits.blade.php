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
                    @php
                        // Extract file path from array (FileUpload format) or use as string (legacy)
                        $mainImagePath = is_array($main_image) ? ($main_image[0] ?? null) : $main_image;
                    @endphp
                    @if($mainImagePath)
                        @php
                            // Handle both storage paths and absolute/external paths
                            $mainImageUrl = str_starts_with($mainImagePath, '/') || str_starts_with($mainImagePath, 'http')
                                ? asset($mainImagePath)
                                : asset('storage/' . $mainImagePath);
                        @endphp
                        <img src="{{ $mainImageUrl }}" alt="{{ $section_title }}">
                    @else
                        <img src="{{ asset('images/about-main.jpg') }}" alt="{{ __('Pesaro Interior Design') }}">
                    @endif
                    <div class="pesaro-about-image-overlay"></div>
                </div>

                {{-- Small overlapping image (foreground) --}}
                <div class="pesaro-about-image-small">
                    @php
                        // Extract file path from array (FileUpload format) or use as string (legacy)
                        $smallImagePath = is_array($small_image) ? ($small_image[0] ?? null) : $small_image;
                    @endphp
                    @if($smallImagePath)
                        @php
                            // Handle both storage paths and absolute/external paths
                            $smallImageUrl = str_starts_with($smallImagePath, '/') || str_starts_with($smallImagePath, 'http')
                                ? asset($smallImagePath)
                                : asset('storage/' . $smallImagePath);
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
