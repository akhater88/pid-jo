@extends('layouts.app')

@section('content')
    {{-- Hero Section with Promotional Banners --}}
    <section class="pesaro-hero">
        {{-- Background Image with Overlays --}}
        <div class="pesaro-hero-bg">
            <div class="pesaro-hero-bg-inner">
                <img src="{{ asset('images/hero-bg.jpg') }}"
                     alt="Pesaro Interior Design">
            </div>
            {{-- Dual Gradient Overlays --}}
            <div class="pesaro-hero-overlay-1"></div>
            <div class="pesaro-hero-overlay-2"></div>
        </div>

        {{-- Hero Content --}}
        <div class="pesaro-hero-content">
            <div class="pesaro-hero-content-container">
                <div class="pesaro-hero-flex">
                    {{-- Left: Hero Text --}}
                    <div class="pesaro-hero-text">
                        {{-- Badge --}}
                        <div class="pesaro-badge">
                            <ul>
                                <li>{{ __('Fast and Realable') }}</li>
                            </ul>
                        </div>

                        {{-- Title & Subtitle --}}
                        <div class="pesaro-hero-title-wrap">
                            <h1 class="pesaro-hero-title" style="overflow: visible;">
                                <span class="gold relative inline-block pb-3">
                                    {{ __('Manage') }}
                                    <img src="{{ asset('images/text-underline.png') }}"
                                         alt=""
                                         class="absolute start-0 bottom-0 w-full h-auto pointer-events-none"
                                         style="max-width: 100%;"
                                         aria-hidden="true">
                                </span>
                                {{ __('your all transaction without') }}
                            </h1>
                            <p class="pesaro-hero-subtitle">
                                {{ __('With Finnen, you can transfer your money in a second. We also provide you with secure transfer.') }}
                            </p>
                        </div>

                        {{-- Button --}}
                        <a href="{{ route('services.index') }}"
                           class="pesaro-hero-btn">
                            {{ __('Explore Services') }}
                        </a>
                    </div>

                    {{-- Right: Promotional Banners (stacked vertically) --}}
                    <div class="pesaro-promo-banners">
                    {{-- 30% OFF Banner --}}
                    <div class="pesaro-promo-card-wrap">
                        {{-- Card with Background Image --}}
                        <div class="pesaro-promo-card">
                            {{-- Background Image (cropped hero image) --}}
                            <div class="pesaro-promo-bg">
                                <img src="{{ asset('images/hero-bg.jpg') }}" alt="">
                                <div class="pesaro-promo-bg-overlay"></div>
                            </div>

                            {{-- Content --}}
                            <div class="pesaro-promo-content">
                                <h3>{{ __('Visit our showroom') }}</h3>
                                <p>{{ __('to get your 30% Discount') }}</p>
                            </div>
                        </div>

                        {{-- Badge (positioned on top) --}}
                        <div class="pesaro-promo-badge">
                            <p>30% OFF</p>
                        </div>
                    </div>

                    {{-- 20% OFF Banner --}}
                    <div class="pesaro-promo-card-wrap">
                        {{-- Card with Background Image --}}
                        <div class="pesaro-promo-card">
                            {{-- Background Image (cropped hero image) --}}
                            <div class="pesaro-promo-bg">
                                <img src="{{ asset('images/hero-bg.jpg') }}" alt="">
                                <div class="pesaro-promo-bg-overlay"></div>
                            </div>

                            {{-- Content --}}
                            <div class="pesaro-promo-content">
                                <h3>{{ __('Visit our showroom') }}</h3>
                                <p>{{ __('to get your 20% Discount') }}</p>
                            </div>
                        </div>

                        {{-- Badge (positioned on top) --}}
                        <div class="pesaro-promo-badge">
                            <p>20% OFF</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="pesaro-scroll-indicator">
            <svg width="24" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- About Us Section --}}
    <section class="pesaro-about-section">
        <div class="pesaro-container">
            <div class="pesaro-about-content">
                {{-- Left: Layered Images --}}
                <div class="pesaro-about-images">
                    {{-- Main large image (background) --}}
                    <div class="pesaro-about-image-main">
                        <img src="{{ asset('images/about-main.jpg') }}" alt="{{ __('Pesaro Interior Design') }}">
                        <div class="pesaro-about-image-overlay"></div>
                    </div>

                    {{-- Small overlapping image (foreground) --}}
                    <div class="pesaro-about-image-small">
                        <img src="{{ asset('images/about-small.jpg') }}" alt="{{ __('Pesaro Projects') }}">
                        <div class="pesaro-about-image-small-overlay"></div>
                    </div>
                </div>

                {{-- Right: Text Content --}}
                <div class="pesaro-about-text-content">
                    <div class="pesaro-about-heading">
                        <div class="pesaro-about-heading-top">
                            {{-- Badge --}}
                            <div class="pesaro-about-badge">
                                <ul><li>{{ __('About US') }}</li></ul>
                            </div>

                            {{-- Title --}}
                            <h2 class="pesaro-about-title">
                                {{ __('What the Benefit ') }}<span class="gold">{{ __('to get Work with') }}</span> {{ __('Pesaro') }}
                            </h2>
                        </div>

                        {{-- Description --}}
                        <p class="pesaro-about-text">
                            {{ __('With Finnen, you can transfer your money in a second. We also provide you with secure transfer, don\'t need any frustations! Sometimes, I\'m really impress with my own product provide you with secure transfer.') }}
                        </p>
                    </div>

                    {{-- Benefits List --}}
                    <div class="pesaro-benefits">
                        {{-- Benefit 1 --}}
                        <div class="pesaro-benefit-item">
                            <div class="pesaro-benefit-icon">
                                <img src="{{ asset('images/check-circle.svg') }}" alt="">
                            </div>
                            <div class="pesaro-benefit-content">
                                <h4>{{ __('User Experience Design Team.') }}</h4>
                                <p>{{ __('Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.') }}</p>
                            </div>
                        </div>

                        {{-- Benefit 2 --}}
                        <div class="pesaro-benefit-item">
                            <div class="pesaro-benefit-icon">
                                <img src="{{ asset('images/check-circle.svg') }}" alt="">
                            </div>
                            <div class="pesaro-benefit-content">
                                <h4>{{ __('User Experience Design Team.') }}</h4>
                                <p>{{ __('Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    @include('blocks.services-grid', ['data' => []])

    {{-- News & Blog Section --}}
    @include('blocks.news-grid', ['data' => []])

    {{-- Testimonials Section --}}
    @include('blocks.testimonials-carousel', ['data' => []])
@endsection
