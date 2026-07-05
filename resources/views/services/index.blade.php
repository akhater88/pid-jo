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
                <span class="text-primary">{{ __('Our Services') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('Our Services') }}
            </h1>
            <p class="text-lg text-white/70 max-w-3xl">
                {{ __('Explore Our Comprehensive Interior Design Services') }}
            </p>
        </div>
    </section>

    {{-- Services Grid --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <article class="group bg-secondary rounded-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                        {{-- Service Image --}}
                        <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}"
                           class="block aspect-[4/3] overflow-hidden">
                            @if($service->hasMedia('featured_image'))
                                <img src="{{ $service->getFirstMediaUrl('featured_image', 'card') }}"
                                     alt="{{ $service->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-dark flex items-center justify-center">
                                    <svg class="w-20 h-20 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>

                        {{-- Service Content --}}
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-primary transition-colors">
                                <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}">
                                    {{ $service->title }}
                                </a>
                            </h3>

                            @if($service->short_description)
                                <p class="text-white/70 mb-4 line-clamp-3">
                                    {{ $service->short_description }}
                                </p>
                            @endif

                            <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}"
                               class="inline-flex items-center gap-2 text-primary hover:text-primary-400 font-medium transition-colors">
                                {{ __('Learn More') }}
                                <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-20 h-20 text-primary/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">{{ __('No Services Yet') }}</h3>
                        <p class="text-white/60">{{ __('Services will be displayed here once they are added.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('Need a Custom Solution?') }}
                </h2>
                <p class="text-lg text-white/80 mb-8">
                    {{ __('Every project is unique. Contact us to discuss your specific needs and get a personalized quote.') }}
                </p>
                <a href="{{ route('contact.' . app()->getLocale()) }}"
                   class="inline-block bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-md font-medium transition-colors">
                    {{ __('Get in Touch') }}
                </a>
            </div>
        </div>
    </section>
@endsection
