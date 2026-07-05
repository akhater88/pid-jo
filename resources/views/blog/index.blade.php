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
                <span class="text-primary">{{ __('News & Blogs') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('News & Blogs') }}
            </h1>
            <p class="text-lg text-white/70 max-w-3xl">
                {{ __('Stay updated with the latest news, trends, and insights from Pesaro') }}
            </p>
        </div>
    </section>

    {{-- Blog Posts Grid --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="bg-secondary rounded-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                            {{-- Post Image --}}
                            <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                               class="block aspect-[16/10] overflow-hidden">
                                @if($post->hasMedia('featured_image'))
                                    <img src="{{ $post->getFirstMediaUrl('featured_image', 'card') }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-dark flex items-center justify-center">
                                        <svg class="w-20 h-20 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            {{-- Post Content --}}
                            <div class="p-6">
                                <div class="flex items-center gap-4 text-sm text-primary mb-3">
                                    <time datetime="{{ $post->published_at?->toISOString() }}">
                                        {{ $post->published_at?->format('F j, Y') }}
                                    </time>
                                </div>

                                <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 hover:text-primary transition-colors">
                                    <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                @if($post->excerpt)
                                    <p class="text-white/70 mb-4 line-clamp-3">
                                        {{ $post->excerpt }}
                                    </p>
                                @endif

                                <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                                   class="inline-flex items-center gap-2 text-primary hover:text-primary-400 font-medium transition-colors group">
                                    {{ __('Read More') }}
                                    <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-primary/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white mb-2">{{ __('No Posts Yet') }}</h3>
                    <p class="text-white/60">{{ __('Blog posts will be displayed here once they are published.') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
