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
                <a href="{{ route('services.index.' . app()->getLocale()) }}" class="text-white/60 hover:text-primary transition-colors">
                    {{ __('Our Services') }}
                </a>
                <svg class="w-4 h-4 text-white/40 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-primary">{{ $service->title }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ $service->title }}
            </h1>

            @if($service->short_description)
                <p class="text-lg text-white/70 max-w-3xl">
                    {{ $service->short_description }}
                </p>
            @endif
        </div>
    </section>

    {{-- Featured Image --}}
    @if($service->hasMedia('featured_image'))
        <section class="py-8 bg-dark">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="aspect-video rounded-lg overflow-hidden">
                    <img src="{{ $service->getFirstMediaUrl('featured_image', 'hero') }}"
                         alt="{{ $service->title }}"
                         class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    @endif

    {{-- Service Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                @if($service->body)
                    <div class="prose prose-invert prose-lg max-w-none">
                        <div class="text-white/80 leading-relaxed">
                            {!! nl2br(e($service->body)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Service Gallery --}}
    @if($service->hasMedia('gallery'))
        <section class="py-16 bg-dark-lighter">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        {{ __('Project Gallery') }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($service->getMedia('gallery') as $media)
                        <a href="{{ $media->getUrl() }}"
                           class="group block aspect-square overflow-hidden rounded-lg"
                           data-lightbox="service-gallery"
                           data-title="{{ $service->title }}">
                            <img src="{{ $media->getUrl('card') }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Related Services --}}
    @php
        $relatedServices = \App\Models\Service::query()
            ->published()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->limit(3)
            ->get();
    @endphp

    @if($relatedServices->isNotEmpty())
        <section class="py-16 bg-dark">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-sm font-semibold text-primary uppercase tracking-wider mb-2">{{ __('Related Services') }}</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        {{ __('You May Also Be Interested In') }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedServices as $relatedService)
                        <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $relatedService->getTranslation('slug', app()->getLocale())]) }}"
                           class="group bg-secondary hover:bg-secondary-lighter rounded-lg overflow-hidden transition-colors">
                            {{-- Service Image --}}
                            <div class="aspect-[4/3] overflow-hidden">
                                @if($relatedService->hasMedia('featured_image'))
                                    <img src="{{ $relatedService->getFirstMediaUrl('featured_image', 'card') }}"
                                         alt="{{ $relatedService->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-dark flex items-center justify-center">
                                        <svg class="w-16 h-16 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Service Content --}}
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-white mb-2 group-hover:text-primary transition-colors">
                                    {{ $relatedService->title }}
                                </h4>
                                @if($relatedService->short_description)
                                    <p class="text-white/70 text-sm line-clamp-2">
                                        {{ $relatedService->short_description }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Call to Action --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('Interested in This Service?') }}
                </h2>
                <p class="text-lg text-white/80 mb-8">
                    {{ __('Contact us today to discuss your project requirements and get a personalized quote.') }}
                </p>
                <a href="{{ route('contact.' . app()->getLocale()) }}"
                   class="inline-block bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-md font-medium transition-colors">
                    {{ __('Request a Quote') }}
                </a>
            </div>
        </div>
    </section>
@endsection
