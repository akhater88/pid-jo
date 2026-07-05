@php
// Services Grid Block - Display services in a 3-column grid
$section_label = $data['section_label'] ?? 'Our Services';
$section_title = $data['section_title'] ?? 'Explore Our Comprehensive Interior Design Services';
$section_title_highlight = $data['section_title_highlight'] ?? 'Comprehensive Interior Design';
$limit = $data['limit'] ?? 3;
$show_all_link = $data['show_all_link'] ?? false;

// Fetch services
$services = \App\Models\Service::query()
    ->published()
    ->ordered()
    ->limit($limit)
    ->get();
@endphp

<section class="pesaro-services-section">
    <div class="pesaro-services-container">
        <!-- Decorative Scribbles -->
        <div class="pesaro-services-decoration pesaro-services-decoration-left">
            <img src="{{ asset('images/scribble-decoration.png') }}" alt="">
        </div>
        <div class="pesaro-services-decoration pesaro-services-decoration-right">
            <img src="{{ asset('images/scribble-decoration.png') }}" alt="">
        </div>

        <!-- Section Header -->
        <div class="pesaro-services-header">
            <!-- Badge -->
            <div class="pesaro-services-badge">
                <ul><li>{{ $section_label }}</li></ul>
            </div>

            <!-- Title -->
            <h2 class="pesaro-services-title">
                {{ __('Explore Our ') }}<span class="gold">{{ __('Comprehensive') }}<br>{{ __('Interior Design') }}</span> {{ __('Services') }}
            </h2>
        </div>

        <!-- Services Grid -->
        @if($services->isNotEmpty())
            <div class="pesaro-services-grid">
                @foreach($services as $index => $service)
                    @if($index === 1)
                        {{-- Middle card - tall with overlay --}}
                        <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}"
                           class="pesaro-service-card pesaro-service-card-tall">
                            <!-- Service Image -->
                            <div class="pesaro-service-image-tall">
                                @if($service->hasMedia('hero'))
                                    <img src="{{ $service->getFirstMediaUrl('hero', 'card') }}"
                                         alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                @else
                                    <img src="{{ asset('images/service-2.jpg') }}" alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                @endif
                                <div class="pesaro-service-overlay"></div>
                            </div>

                            <!-- Service Title (Overlay) -->
                            <h3 class="pesaro-service-title-overlay">
                                {{ $service->getTranslation('title', app()->getLocale()) }}
                            </h3>
                        </a>
                    @else
                        {{-- Side cards - short with description --}}
                        <div class="pesaro-service-card pesaro-service-card-short">
                            <!-- Service Image -->
                            <div class="pesaro-service-image-short">
                                @if($service->hasMedia('hero'))
                                    <img src="{{ $service->getFirstMediaUrl('hero', 'card') }}"
                                         alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                @else
                                    <img src="{{ asset('images/service-' . ($index + 1) . '.jpg') }}"
                                         alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                @endif
                            </div>

                            <!-- Service Content -->
                            <div class="pesaro-service-content">
                                <h3>{{ $service->getTranslation('title', app()->getLocale()) }}</h3>
                                <p>{{ $service->getTranslation('short_description', app()->getLocale()) }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- View All Button -->
            @if($show_all_link)
                <div class="pesaro-services-view-all">
                    <a href="{{ route('services.index.' . app()->getLocale()) }}" class="pesaro-services-btn">
                        {{ __('View All Services') }}
                    </a>
                </div>
            @endif
        @else
            <div class="pesaro-text-center">
                <p>{{ __('No services available at the moment.') }}</p>
            </div>
        @endif
    </div>
</section>
