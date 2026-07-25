@extends('layouts.app')

@section('content')
    {{-- Inner Page Hero --}}
    <section class="pesaro-services-page-hero">
        <div class="pesaro-services-page-hero-container">
            {{-- Breadcrumb --}}
            <nav class="pesaro-services-page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home.' . app()->getLocale()) }}" class="pesaro-services-page-breadcrumb-link">
                    {{ __('Home') }}
                </a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="pesaro-services-page-breadcrumb-current">{{ __('Our Services') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="pesaro-services-page-hero-title">
                {{ __('Our Services') }}
            </h1>
            <p class="pesaro-services-page-hero-description">
                {{ __('Explore Our Comprehensive Interior Design Services') }}
            </p>
        </div>
    </section>

    {{-- Services Grid --}}
    <section class="pesaro-services-page-grid-section">
        <div class="pesaro-services-page-grid-container">
            <div class="pesaro-services-page-grid">
                @forelse($services as $service)
                    <article class="pesaro-services-page-card">
                        {{-- Service Images Grid (2x2) --}}
                        <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}" class="pesaro-services-page-card-link">
                            <div class="pesaro-services-page-images">
                                {{-- First Row --}}
                                <div class="pesaro-services-page-images-row">
                                    @php
                                        // Get gallery images or use hero image as fallback
                                        $galleryImages = $service->getMedia('gallery');
                                        $heroImage = $service->hasMedia('hero') ? $service->getFirstMediaUrl('hero', 'card') : asset('images/service-placeholder.jpg');

                                        // Prepare 4 images for the grid
                                        $images = [];
                                        if ($galleryImages->count() >= 4) {
                                            // Use first 4 gallery images
                                            for ($i = 0; $i < 4; $i++) {
                                                $images[] = $galleryImages[$i]->getUrl('card');
                                            }
                                        } else {
                                            // Fill with available gallery images and hero image
                                            foreach ($galleryImages as $img) {
                                                $images[] = $img->getUrl('card');
                                            }
                                            // Fill remaining slots with hero image
                                            while (count($images) < 4) {
                                                $images[] = $heroImage;
                                            }
                                        }
                                    @endphp

                                    <div class="pesaro-services-page-image-wrapper">
                                        <img src="{{ $images[0] }}" alt="{{ $service->title }}">
                                        <div class="pesaro-services-page-image-overlay"></div>
                                    </div>
                                    <div class="pesaro-services-page-image-wrapper">
                                        <img src="{{ $images[1] }}" alt="{{ $service->title }}">
                                        <div class="pesaro-services-page-image-overlay"></div>
                                    </div>
                                </div>

                                {{-- Second Row --}}
                                <div class="pesaro-services-page-images-row">
                                    <div class="pesaro-services-page-image-wrapper">
                                        <img src="{{ $images[2] }}" alt="{{ $service->title }}">
                                        <div class="pesaro-services-page-image-overlay"></div>
                                    </div>
                                    <div class="pesaro-services-page-image-wrapper">
                                        <img src="{{ $images[3] }}" alt="{{ $service->title }}">
                                        <div class="pesaro-services-page-image-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        {{-- Service Content --}}
                        <div class="pesaro-services-page-content">
                            <h3 class="pesaro-services-page-card-title">
                                <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}" class="pesaro-services-page-card-link">
                                    {{ $service->title }}
                                </a>
                            </h3>

                            @if($service->short_description)
                                <p class="pesaro-services-page-card-description">
                                    {{ $service->short_description }}
                                </p>
                            @endif

                            <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}"
                               class="pesaro-services-page-learn-more">
                                {{ __('Learn More') }}
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="pesaro-services-page-empty">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="pesaro-services-page-empty-title">{{ __('No Services Yet') }}</h3>
                        <p class="pesaro-services-page-empty-description">{{ __('Services will be displayed here once they are added.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="pesaro-services-page-cta">
        <div class="pesaro-services-page-cta-container">
            <h2 class="pesaro-services-page-cta-title">
                {{ __('Need a Custom Solution?') }}
            </h2>
            <p class="pesaro-services-page-cta-description">
                {{ __('Every project is unique. Contact us to discuss your specific needs and get a personalized quote.') }}
            </p>
            <a href="{{ route('contact.' . app()->getLocale()) }}"
               class="pesaro-services-page-cta-button">
                {{ __('Get in Touch') }}
            </a>
        </div>
    </section>
@endsection
