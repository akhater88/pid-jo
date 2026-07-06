@php
// News Grid Block - Display blog posts in alternating layout
$section_label = $data['section_label'] ?? 'News & Blogs';
$section_title = $data['section_title'] ?? 'Explore Our Comprehensive Interior Design Services';
$limit = $data['limit'] ?? 3;
$show_all_link = $data['show_all_link'] ?? false;

// Fetch blog posts (no limit for carousel)
$posts = \App\Models\BlogPost::query()
    ->published()
    ->withCount('comments')
    ->ordered()
    ->get();
@endphp

<section class="pesaro-news-section">
    <div class="pesaro-news-container">
        <!-- Decorative Scribbles -->
        <div class="pesaro-news-decoration pesaro-news-decoration-left">
            <img src="{{ asset('images/blog-scribble-left.png') }}" alt="">
        </div>
        <div class="pesaro-news-decoration pesaro-news-decoration-right">
            <img src="{{ asset('images/blog-scribble-right.png') }}" alt="">
        </div>

        <!-- Section Header -->
        <div class="pesaro-news-header">
            <!-- Badge -->
            <div class="pesaro-news-badge">
                <ul><li>{{ $section_label }}</li></ul>
            </div>

            <!-- Title -->
            <h2 class="pesaro-news-title">
                {{ __('Explore Our ') }}<span class="gold">{{ __('Comprehensive') }}<br>{{ __('Interior Design') }}</span> {{ __('Services') }}
            </h2>
        </div>

        <!-- Blog Posts Carousel -->
        @if($posts->isNotEmpty())
            <div class="pesaro-news-carousel-wrapper">
                <!-- Swiper Container -->
                <div class="swiper pesaro-news-swiper">
                    <div class="swiper-wrapper">
                        @foreach($posts as $index => $post)
                            <div class="swiper-slide">
                                <article class="pesaro-news-card">
                                    @if($index % 2 === 1)
                                        {{-- Middle card - text first, then image --}}
                                        <!-- Post Content -->
                                        <div class="pesaro-news-content">
                                            <h3>{{ $post->getTranslation('title', app()->getLocale()) }}</h3>
                                            <p>
                                                {{ $post->getTranslation('excerpt', app()->getLocale()) ?? $post->getTranslation('short_description', app()->getLocale()) }}
                                            </p>
                                        </div>

                                        <!-- Post Image -->
                                        <div class="pesaro-news-image">
                                            @if($post->hasMedia('hero'))
                                                <img src="{{ $post->getFirstMediaUrl('hero', 'card') }}"
                                                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
                                            @else
                                                <img src="{{ asset('images/blog-2.jpg') }}"
                                                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
                                            @endif
                                        </div>
                                    @else
                                        {{-- Side cards - image first, then text --}}
                                        <!-- Post Image -->
                                        <div class="pesaro-news-image">
                                            @if($post->hasMedia('hero'))
                                                <img src="{{ $post->getFirstMediaUrl('hero', 'card') }}"
                                                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
                                            @else
                                                <img src="{{ asset('images/blog-1.jpg') }}"
                                                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
                                            @endif
                                        </div>

                                        <!-- Post Content -->
                                        <div class="pesaro-news-content">
                                            <h3>{{ $post->getTranslation('title', app()->getLocale()) }}</h3>
                                            <p>
                                                {{ $post->getTranslation('excerpt', app()->getLocale()) ?? $post->getTranslation('short_description', app()->getLocale()) }}
                                            </p>
                                        </div>
                                    @endif
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <div class="pesaro-swiper-button-prev pesaro-news-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
                <div class="pesaro-swiper-button-next pesaro-news-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>

                <!-- Pagination -->
                <div class="pesaro-swiper-pagination pesaro-news-pagination"></div>
            </div>

            <!-- View All Button -->
            @if($show_all_link)
                <div class="pesaro-news-view-all">
                    <a href="{{ route('blog.index.' . app()->getLocale()) }}" class="pesaro-news-btn">
                        {{ __('View All Posts') }}
                    </a>
                </div>
            @endif
        @else
            <div class="pesaro-text-center">
                <p>{{ __('No articles available at the moment.') }}</p>
            </div>
        @endif
    </div>
</section>
