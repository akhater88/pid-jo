@extends('layouts.app')

@section('content')
    {{-- Terms Hero Section --}}
    <section class="pesaro-about-hero">
        {{-- Background Image --}}
        <div class="pesaro-about-hero-background">
            @if(file_exists(public_path('images/terms-hero-bg.jpg')))
                <img src="{{ asset('images/terms-hero-bg.jpg') }}"
                     alt="{{ $title }}">
            @else
                {{-- Fallback gradient background if image doesn't exist --}}
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #222126 0%, #353535 100%);"></div>
            @endif
            {{-- Overlay Gradients --}}
            <div class="pesaro-about-hero-overlay"></div>
        </div>

        {{-- Content --}}
        <div class="pesaro-about-hero-content">
            {{-- Page Title --}}
            <h1 class="pesaro-about-hero-title">
                {{ $title }}
            </h1>

            {{-- Breadcrumb --}}
            <nav class="pesaro-about-hero-breadcrumb" aria-label="Breadcrumb">
                <div class="pesaro-about-hero-breadcrumb-item">
                    <a href="{{ route('home.' . app()->getLocale()) }}" class="pesaro-about-hero-breadcrumb-link">
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

    {{-- Terms Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-invert prose-lg max-w-none">
                    <div class="text-white/80 leading-relaxed space-y-6">
                        {!! $content !!}
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-white/10">
                    <p class="text-sm text-white/60">
                        {{ __('Last updated: ') }} {{ now()->format('F j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
