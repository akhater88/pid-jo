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
                <span class="text-primary">{{ __('Pesaro Gallery') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('Pesaro Gallery') }}
            </h1>
            <p class="text-lg text-white/70 max-w-3xl">
                {{ __('Explore our portfolio of completed projects and get inspired for your next interior design venture') }}
            </p>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($images->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($images as $image)
                        <a href="{{ $image->getFirstMediaUrl('image') }}"
                           class="group block aspect-square overflow-hidden rounded-lg bg-secondary"
                           data-lightbox="gallery"
                           data-title="{{ $image->title }}">
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
                                    @if($image->title)
                                        <h3 class="font-semibold mb-1">{{ $image->title }}</h3>
                                    @endif
                                    @if($image->description)
                                        <p class="text-sm text-white/80 line-clamp-2">{{ $image->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
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
// Simple lightbox functionality with Alpine.js
document.addEventListener('alpine:init', () => {
    Alpine.data('lightbox', () => ({
        open: false,
        currentImage: '',
        currentTitle: '',

        init() {
            document.querySelectorAll('[data-lightbox]').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.currentImage = link.getAttribute('href');
                    this.currentTitle = link.getAttribute('data-title') || '';
                    this.open = true;
                });
            });
        }
    }));
});
</script>
@endpush
