@extends('layouts.app')

@section('content')
    {{-- FAQ Hero Section --}}
    <section class="pesaro-about-hero">
        {{-- Background Image --}}
        <div class="pesaro-about-hero-background">
            @if(file_exists(public_path('images/faq-hero-bg.jpg')))
                <img src="{{ asset('images/faq-hero-bg.jpg') }}"
                     alt="{{ __('Frequently Asked Questions') }}">
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
                {{ __('Frequently Asked Questions') }}
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
                <span class="pesaro-about-hero-breadcrumb-current">{{ __('FAQ Questions') }}</span>
            </nav>
        </div>
    </section>

    {{-- FAQ Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                @if($faqs->isNotEmpty())
                    <div x-data="{ activeIndex: null }" class="space-y-4">
                        @foreach($faqs as $index => $faq)
                            <div class="bg-secondary rounded-lg overflow-hidden">
                                <button @click="activeIndex = activeIndex === {{ $index }} ? null : {{ $index }}"
                                        class="w-full px-6 py-5 flex items-center justify-between text-start hover:bg-secondary-lighter transition-colors">
                                    <span class="text-lg font-semibold text-white pe-4">
                                        {{ $faq->question }}
                                    </span>
                                    <svg class="w-5 h-5 text-primary flex-shrink-0 transform transition-transform"
                                         :class="{ 'rotate-180': activeIndex === {{ $index }} }"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="activeIndex === {{ $index }}"
                                     x-collapse
                                     class="px-6 pb-5">
                                    <div class="text-white/80 leading-relaxed">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="w-20 h-20 text-primary/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">{{ __('No FAQs Yet') }}</h3>
                        <p class="text-white/60">{{ __('Frequently asked questions will be displayed here once they are added.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('Still Have Questions?') }}
                </h2>
                <p class="text-lg text-white/80 mb-8">
                    {{ __('Our team is here to help. Get in touch with us for personalized assistance.') }}
                </p>
                <a href="{{ route('contact.' . app()->getLocale()) }}"
                   class="inline-block bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-md font-medium transition-colors">
                    {{ __('Contact Us') }}
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
@endpush
