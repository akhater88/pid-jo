@php
// Services Grid Block - Display services in a 3-column grid
$section_label = $data['section_label'] ?? 'Our Services';
$section_title = $data['section_title'] ?? 'Explore Our Comprehensive Interior Design Services';
$section_title_highlight = $data['section_title_highlight'] ?? 'Comprehensive Interior Design';
$limit = $data['limit'] ?? 3;
$show_all_link = $data['show_all_link'] ?? false;

// Fetch services (no limit for carousel)
$services = \App\Models\Service::query()
    ->published()
    ->ordered()
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

        <!-- Services Carousel -->
        @if($services->isNotEmpty())
            <div class="pesaro-services-carousel-wrapper">
                <!-- Swiper Container -->
                <div class="swiper pesaro-services-swiper">
                    <div class="swiper-wrapper">
                        @foreach($services as $index => $service)
                            <div class="swiper-slide">
                                <article class="pesaro-service-card">
                                    @if($index % 2 === 1)
                                        {{-- Middle card - text first, then image --}}
                                        <!-- Service Content -->
                                        <div class="pesaro-service-content">
                                            <h3>{{ $service->getTranslation('title', app()->getLocale()) }}</h3>
                                            <p>{{ $service->getTranslation('short_description', app()->getLocale()) }}</p>
                                        </div>

                                        <!-- Service Image -->
                                        <div class="pesaro-service-image">
                                            @if($service->hasMedia('hero'))
                                                <img src="{{ $service->getFirstMediaUrl('hero', 'card') }}"
                                                     alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                            @else
                                                <img src="{{ asset('images/service-2.jpg') }}"
                                                     alt="{{ $service->getTranslation('title', app()->getLocale()) }}">
                                            @endif
                                        </div>
                                    @else
                                        {{-- Side cards - image first, then text --}}
                                        <!-- Service Image -->
                                        <div class="pesaro-service-image">
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
                                    @endif
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <div class="pesaro-swiper-button-prev pesaro-services-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
                <div class="pesaro-swiper-button-next pesaro-services-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>

                <!-- Pagination -->
                <div class="pesaro-swiper-pagination pesaro-services-pagination"></div>
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
