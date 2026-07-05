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
                <a href="{{ route('blog.index.' . app()->getLocale()) }}" class="text-white/60 hover:text-primary transition-colors">
                    {{ __('News & Blogs') }}
                </a>
                <svg class="w-4 h-4 text-white/40 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-primary">{{ __('Blog Details') }}</span>
            </nav>
        </div>
    </section>

    {{-- Blog Post Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2">
                        <article>
                            {{-- Post Meta --}}
                            <div class="flex items-center gap-4 text-sm text-primary mb-4">
                                <time datetime="{{ $post->published_at?->toISOString() }}">
                                    {{ $post->published_at?->format('F j, Y') }}
                                </time>
                            </div>

                            {{-- Post Title --}}
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                                {{ $post->title }}
                            </h1>

                            {{-- Featured Image --}}
                            @if($post->hasMedia('featured_image'))
                                <div class="aspect-video rounded-lg overflow-hidden mb-8">
                                    <img src="{{ $post->getFirstMediaUrl('featured_image', 'hero') }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endif

                            {{-- Post Excerpt --}}
                            @if($post->excerpt)
                                <div class="text-xl text-white/80 mb-8 leading-relaxed">
                                    {{ $post->excerpt }}
                                </div>
                            @endif

                            {{-- Post Body --}}
                            @if($post->body)
                                <div class="prose prose-invert prose-lg max-w-none">
                                    <div class="text-white/80 leading-relaxed">
                                        {!! nl2br(e($post->body)) !!}
                                    </div>
                                </div>
                            @endif

                            {{-- Share Section --}}
                            <div class="mt-12 pt-8 border-t border-white/10">
                                <h3 class="text-lg font-semibold text-white mb-4">{{ __('Share this post') }}</h3>
                                <div class="flex gap-3">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="w-10 h-10 bg-secondary hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="w-10 h-10 bg-secondary hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="w-10 h-10 bg-secondary hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')"
                                            class="w-10 h-10 bg-secondary hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>

                    {{-- Sidebar --}}
                    <aside class="lg:col-span-1">
                        {{-- Recent Posts --}}
                        @if($recentPosts->isNotEmpty())
                            <div class="bg-secondary rounded-lg p-6 mb-8">
                                <h3 class="text-xl font-bold text-white mb-6">{{ __('Recent Posts') }}</h3>
                                <div class="space-y-6">
                                    @foreach($recentPosts as $recentPost)
                                        <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $recentPost->getTranslation('slug', app()->getLocale())]) }}"
                                           class="flex gap-4 group">
                                            @if($recentPost->hasMedia('featured_image'))
                                                <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden">
                                                    <img src="{{ $recentPost->getFirstMediaUrl('featured_image', 'thumb') }}"
                                                         alt="{{ $recentPost->title }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-white group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                                    {{ $recentPost->title }}
                                                </h4>
                                                <time class="text-xs text-primary" datetime="{{ $recentPost->published_at?->toISOString() }}">
                                                    {{ $recentPost->published_at?->format('M j, Y') }}
                                                </time>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Contact CTA --}}
                        <div class="bg-gradient-to-br from-primary/20 to-primary/5 border border-primary/30 rounded-lg p-6">
                            <h3 class="text-xl font-bold text-white mb-3">{{ __('Need Our Services?') }}</h3>
                            <p class="text-white/80 mb-4 text-sm">
                                {{ __('Contact us today to discuss your interior design project.') }}
                            </p>
                            <a href="{{ route('contact.' . app()->getLocale()) }}"
                               class="block w-full bg-primary hover:bg-primary-600 text-white text-center px-6 py-3 rounded-md font-medium transition-colors">
                                {{ __('Get in Touch') }}
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Posts --}}
    @php
        $relatedPosts = \App\Models\BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    @endphp

    @if($relatedPosts->isNotEmpty())
        <section class="py-16 bg-dark-lighter">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-sm font-semibold text-primary uppercase tracking-wider mb-2">{{ __('Related Posts') }}</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        {{ __('You May Also Like') }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-secondary rounded-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $relatedPost->getTranslation('slug', app()->getLocale())]) }}"
                               class="block aspect-[16/10] overflow-hidden">
                                @if($relatedPost->hasMedia('featured_image'))
                                    <img src="{{ $relatedPost->getFirstMediaUrl('featured_image', 'card') }}"
                                         alt="{{ $relatedPost->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-dark"></div>
                                @endif
                            </a>
                            <div class="p-6">
                                <time class="text-primary text-sm" datetime="{{ $relatedPost->published_at?->toISOString() }}">
                                    {{ $relatedPost->published_at?->format('F j, Y') }}
                                </time>
                                <h4 class="text-lg font-semibold text-white mt-2 line-clamp-2 hover:text-primary transition-colors">
                                    <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $relatedPost->getTranslation('slug', app()->getLocale())]) }}">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h4>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
