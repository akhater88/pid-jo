@extends('layouts.app')

@section('content')
    {{-- Gallery Hero Section --}}
    <section class="pesaro-about-hero">
        {{-- Background Image --}}
        <div class="pesaro-about-hero-background">
            @if($images->isNotEmpty() && $images->first()->hasMedia('image'))
                <img src="{{ $images->first()->getFirstMediaUrl('image', 'hero') }}"
                     alt="{{ __('Pesaro Gallery') }}">
            @else
                {{-- Fallback gradient background if no images --}}
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #222126 0%, #353535 100%);"></div>
            @endif
            {{-- Overlay Gradients --}}
            <div class="pesaro-about-hero-overlay"></div>
        </div>

        {{-- Content --}}
        <div class="pesaro-about-hero-content">
            {{-- Page Title --}}
            <h1 class="pesaro-about-hero-title">
                {{ __('Pesaro Gallery') }}
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
                <span class="pesaro-about-hero-breadcrumb-current">{{ __('Gallery') }}</span>
            </nav>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="py-16 bg-dark" x-data="galleryViewer()">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($images->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($images as $index => $image)
                        <button @click="openGallery({{ $index }})"
                                class="group relative block aspect-square overflow-hidden rounded-lg bg-secondary cursor-pointer">
                            @if($image->hasMedia('image'))
                                <img src="{{ $image->getFirstMediaUrl('image', 'card') }}"
                                     alt="{{ $image->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-dark flex items-center justify-center">
                                    <svg class="w-16 h-16 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-dark/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-center text-white px-4">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    @if($image->title)
                                        <h3 class="font-semibold mb-1">{{ $image->title }}</h3>
                                    @endif
                                    @if($image->description)
                                        <p class="text-sm text-white/80 line-clamp-2">{{ $image->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Lightbox Modal --}}
                <div x-show="isOpen"
                     x-cloak
                     @keydown.escape.window="close()"
                     @keydown.arrow-left.window="prev()"
                     @keydown.arrow-right.window="next()"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/95"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">

                    {{-- Close Button --}}
                    <button @click="close()"
                            class="absolute top-4 right-4 z-10 text-white hover:text-primary transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- Image Counter --}}
                    <div class="absolute top-4 left-4 z-10 text-white bg-black/50 px-4 py-2 rounded-lg">
                        <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                    </div>

                    {{-- Previous Button --}}
                    <button @click="prev()"
                            class="absolute left-4 top-1/2 -translate-y-1/2 z-10 text-white hover:text-primary transition-colors p-2 bg-black/50 rounded-full">
                        <svg class="w-8 h-8 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    {{-- Image Container --}}
                    <div class="relative max-w-7xl max-h-[90vh] mx-auto px-16" @click.self="close()">
                        <img :src="images[currentIndex]?.url"
                             :alt="images[currentIndex]?.title"
                             class="max-w-full max-h-[90vh] object-contain mx-auto"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100">

                        {{-- Image Title & Description --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-center"
                             x-show="images[currentIndex]?.title || images[currentIndex]?.description">
                            <h3 x-show="images[currentIndex]?.title"
                                x-text="images[currentIndex]?.title"
                                class="text-xl font-semibold text-white mb-2"></h3>
                            <p x-show="images[currentIndex]?.description"
                               x-text="images[currentIndex]?.description"
                               class="text-white/80"></p>
                        </div>
                    </div>

                    {{-- Next Button --}}
                    <button @click="next()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 z-10 text-white hover:text-primary transition-colors p-2 bg-black/50 rounded-full">
                        <svg class="w-8 h-8 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-primary/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white mb-2">{{ __('No Gallery Images Yet') }}</h3>
                    <p class="text-white/60">{{ __('Gallery images will be displayed here once they are added.') }}</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('Inspired by What You See?') }}
                </h2>
                <p class="text-lg text-white/80 mb-8">
                    {{ __('Let us bring your vision to life with our expert design and execution services.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact.' . app()->getLocale()) }}"
                       class="inline-block bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-md font-medium transition-colors">
                        {{ __('Start Your Project') }}
                    </a>
                    <a href="{{ route('services.index.' . app()->getLocale()) }}"
                       class="inline-block bg-secondary hover:bg-secondary-lighter text-white px-8 py-4 rounded-md font-medium transition-colors">
                        {{ __('View Our Services') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
function galleryViewer() {
    return {
        isOpen: false,
        currentIndex: 0,
        images: [
            @foreach($images as $image)
                {
                    url: '{{ $image->getFirstMediaUrl('image') }}',
                    title: '{{ addslashes($image->title ?? '') }}',
                    description: '{{ addslashes($image->description ?? '') }}'
                },
            @endforeach
        ],

        openGallery(index) {
            this.currentIndex = index;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },

        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },

        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },

        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        }
    }
}
</script>
@endpush
