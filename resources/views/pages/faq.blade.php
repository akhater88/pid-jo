@extends('layouts.app')

@section('content')
    {{-- Inner Page Hero --}}
    <section class="relative bg-dark-lighter py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home.' . app()->getLocale()) }}" class="text-white/60 hover:text-primary transition-colors">
                    {{ __('Home') }}
                </a>
                <svg class="w-4 h-4 text-white/40 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-primary">{{ __('FAQ Questions') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('Frequently Asked Questions') }}
            </h1>
            <p class="text-lg text-white/70 max-w-3xl">
                {{ __('Find answers to common questions about our services and processes') }}
            </p>
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
