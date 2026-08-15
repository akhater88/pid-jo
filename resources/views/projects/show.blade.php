@extends('layouts.app')

@section('title', $project->title . ' - ' . $project->service->title)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 155))

@section('content')
    {{-- Project Detail Hero Section --}}
    <section class="pesaro-about-hero">
        {{-- Background Image --}}
        <div class="pesaro-about-hero-background">
            @if($project->hasMedia('gallery'))
                <img src="{{ $project->getFirstMediaUrl('gallery', 'detail') }}"
                     alt="{{ $project->title }}">
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
                {{ $project->title }}
            </h1>

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-[16px]" aria-label="Breadcrumb">
                <div class="flex items-center justify-center gap-[12px]">
                    <a href="{{ route('home.' . app()->getLocale()) }}" class="text-[26px] leading-[36px] font-medium text-white/90 hover:text-white transition-colors">
                        {{ __('Home') }}
                    </a>
                    <div class="flex items-center justify-center w-[7px] h-[14px]">
                        <svg class="-rotate-90 rtl:rotate-90" width="14" height="7" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1.5L8.5 8.5L15.5 1.5" stroke="#C09A5B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-[12px]">
                    <a href="{{ route('services.show.' . app()->getLocale(), $project->service->slug) }}" class="text-[26px] leading-[36px] font-medium text-white/90 hover:text-white transition-colors">
                        {{ $project->service->title }}
                    </a>
                    <div class="flex items-center justify-center w-[7px] h-[14px]">
                        <svg class="-rotate-90 rtl:rotate-90" width="14" height="7" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1.5L8.5 8.5L15.5 1.5" stroke="#C09A5B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <span class="text-[26px] leading-[36px] font-semibold text-[#c09a5b]">{{ Str::limit($project->title, 40) }}</span>
            </nav>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 bg-[#222126]">
        <div class="container mx-auto px-4 max-w-6xl">
            {{-- Project Info Card --}}
            <div class="bg-[#2a2830] rounded-lg p-6 md:p-8 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Customer/Client Info --}}
                    <div>
                        <h3 class="text-[#c09a5b] text-sm font-semibold uppercase tracking-wider mb-2">
                            {{ __('Client') }}
                        </h3>
                        <p class="text-white text-xl font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#c09a5b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            {{ $project->customer_name }}
                        </p>
                    </div>

                    {{-- Service Category --}}
                    <div>
                        <h3 class="text-[#c09a5b] text-sm font-semibold uppercase tracking-wider mb-2">
                            {{ __('Service') }}
                        </h3>
                        <a href="{{ route('services.show.' . app()->getLocale(), $project->service->slug) }}"
                           class="text-white text-xl font-medium hover:text-[#c09a5b] transition-colors inline-flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#c09a5b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $project->service->title }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Project Description --}}
            <div class="prose prose-invert prose-lg max-w-none mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">
                    {{ __('Project Description') }}
                </h2>
                <div class="text-white/80 leading-relaxed whitespace-pre-wrap">
                    {{ $project->description }}
                </div>
            </div>

            {{-- Image Gallery --}}
            @if($project->hasMedia('gallery'))
                @php
                    $galleryImages = $project->getMedia('gallery');
                @endphp
                <div class="space-y-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">
                        {{ __('Project Gallery') }}
                        <span class="text-[#c09a5b] text-lg font-normal">({{ $galleryImages->count() }} {{ __('images') }})</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($galleryImages as $index => $image)
                            <a href="{{ $image->getUrl() }}"
                               data-lightbox="project-gallery"
                               data-title="{{ $project->title }} - {{ __('Image') }} {{ $index + 1 }}"
                               class="group relative block rounded-lg overflow-hidden bg-[#2a2830] hover:shadow-2xl transition-all duration-300 aspect-[4/3]">
                                <img src="{{ $image->hasGeneratedConversion('card') ? $image->getUrl('card') : $image->getUrl() }}"
                                     alt="{{ $project->title }} - {{ __('Image') }} {{ $index + 1 }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">

                                {{-- Zoom Icon Overlay --}}
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                                    </svg>
                                </div>

                                {{-- Image Number --}}
                                <div class="absolute top-3 start-3 bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $index + 1 }} / {{ $galleryImages->count() }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Back to Service Button --}}
            <div class="mt-16 pt-8 border-t border-white/10">
                <a href="{{ route('services.show.' . app()->getLocale(), $project->service->slug) }}"
                   class="inline-flex items-center gap-3 bg-[#c09a5b] hover:bg-[#a87f42] text-white font-semibold px-8 py-4 rounded-lg transition-colors duration-300 group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 rtl:group-hover:translate-x-1 rtl:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to :service', ['service' => $project->service->title]) }}
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Lightbox for image gallery --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': '{{ __("Image %1 of %2") }}'
        });
    </script>
@endpush
