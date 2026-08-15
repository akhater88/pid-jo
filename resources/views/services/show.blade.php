@extends('layouts.app')

@section('content')
    {{-- Use template if available, otherwise fallback to hardcoded layout --}}
    @if($template && $template->getRenderedBlocks())
        @foreach($template->getRenderedBlocks() as $block)
            @php
                $data = \App\Helpers\TemplateHelper::replaceVariables($block['data'] ?? [], $service);
            @endphp
            @includeIf("blocks.{$block['type']}", ['data' => $data, 'service' => $service])
        @endforeach
    @else
        {{-- Fallback: Original hardcoded layout --}}
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

    {{-- Service Sections --}}
    @if($service->sections && $service->sections->isNotEmpty())
        @foreach($service->sections as $section)
            <section class="py-12 {{ $loop->even ? 'bg-dark' : 'bg-dark-lighter' }}">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-4xl mx-auto">
                        {{-- Section Title --}}
                        @if($section->title)
                            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">
                                {{ $section->title }}
                            </h2>
                        @endif

                        {{-- Text Content --}}
                        @if($section->type === 'text' && $section->content)
                            <div class="prose prose-invert prose-lg max-w-none">
                                <div class="text-white/80 leading-relaxed">
                                    {!! $section->content !!}
                                </div>
                            </div>
                        @endif

                        {{-- Single Image --}}
                        @if($section->type === 'image' && isset($section->media_data['image_path']))
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ $section->media_data['image_path'] }}"
                                     alt="{{ $section->title }}"
                                     class="w-full h-auto">
                            </div>
                        @endif

                        {{-- Video --}}
                        @if($section->type === 'video' && isset($section->media_data['video_url']))
                            <div class="aspect-video rounded-lg overflow-hidden">
                                @php
                                    $videoUrl = $section->media_data['video_url'];
                                    $embedUrl = '';

                                    // Convert YouTube URL to embed
                                    if (str_contains($videoUrl, 'youtube.com/watch?v=')) {
                                        $videoId = parse_url($videoUrl, PHP_URL_QUERY);
                                        parse_str($videoId, $params);
                                        $embedUrl = 'https://www.youtube.com/embed/' . ($params['v'] ?? '');
                                    } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                        $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                    } elseif (str_contains($videoUrl, 'vimeo.com/')) {
                                        $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
                                        $embedUrl = 'https://player.vimeo.com/video/' . $videoId;
                                    }
                                @endphp

                                @if($embedUrl)
                                    <iframe src="{{ $embedUrl }}"
                                            class="w-full h-full"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                @endif
                            </div>
                        @endif

                        {{-- Image Gallery --}}
                        @if($section->type === 'gallery' && isset($section->media_data['gallery_images']))
                            @php
                                $images = explode(',', $section->media_data['gallery_images']);
                                $images = array_map('trim', $images);
                            @endphp

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($images as $imagePath)
                                    @if($imagePath)
                                        <div class="aspect-square rounded-lg overflow-hidden">
                                            <img src="{{ $imagePath }}"
                                                 alt="{{ $section->title }}"
                                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    {{-- Service Gallery --}}
    @if($service->hasMedia('gallery'))
        <section class="py-16 bg-dark-lighter" x-data="serviceGalleryViewer()">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        {{ __('Project Gallery') }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($service->getMedia('gallery') as $index => $media)
                        <button @click="openGallery({{ $index }})"
                                class="group relative block aspect-square overflow-hidden rounded-lg bg-secondary cursor-pointer">
                            <img src="{{ $media->getUrl('card') }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-dark/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-center text-white px-4">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    <h3 class="font-semibold">{{ $service->title }}</h3>
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

                        {{-- Image Title --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-center">
                            <h3 x-text="images[currentIndex]?.title"
                                class="text-xl font-semibold text-white"></h3>
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
    @endif

    {{-- Projects Section --}}
    @include('components.projects.projects-section', ['service' => $service])
@endsection

@if($service->hasMedia('gallery'))
    @push('scripts')
    <script>
    function serviceGalleryViewer() {
        return {
            isOpen: false,
            currentIndex: 0,
            images: [
                @foreach($service->getMedia('gallery') as $media)
                    {
                        url: '{{ $media->getUrl() }}',
                        title: '{{ addslashes($service->title) }}'
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
@endif
