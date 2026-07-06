@extends('layouts.app')

@section('content')
    {{-- Hero Section with Breadcrumbs --}}
    <section class="relative bg-[#222126] border-b-2 border-[#403e3e] min-h-[329px] py-[100px]">
        <!-- Background Image -->
        <div class="absolute inset-0">
            @if($post->hasMedia('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image', 'hero') }}"
                     alt="{{ $post->title }}"
                     class="absolute inset-0 w-full h-full object-cover">
            @endif
            <!-- Overlay Gradients -->
            <div class="absolute inset-0" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 3.5%, rgba(0, 0, 0, 0.06) 37.5%), linear-gradient(90deg, rgba(0, 0, 0, 0.765) 0%, rgba(0, 0, 0, 0.425) 100%)"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 container mx-auto px-4">
            <!-- Page Title -->
            <h1 class="text-[40px] leading-[60px] font-semibold text-white tracking-[-0.8px] mb-[10px]">
                {{ __('News & Events') }}
            </h1>

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-[16px]">
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
                    <a href="{{ route('blog.index.' . app()->getLocale()) }}" class="text-[26px] leading-[36px] font-medium text-white/90 hover:text-white transition-colors">
                        {{ __('News & Events') }}
                    </a>
                    <div class="flex items-center justify-center w-[7px] h-[14px]">
                        <svg class="-rotate-90 rtl:rotate-90" width="14" height="7" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1.5L8.5 8.5L15.5 1.5" stroke="#C09A5B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <span class="text-[26px] leading-[36px] font-semibold text-[#c09a5b]">{{ __('Blog Details') }}</span>
            </nav>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 bg-[#222126]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-12">
                {{-- Left Column: Content --}}
                <div class="space-y-12">
                    {{-- Image Gallery --}}
                    @if($post->hasMedia('gallery'))
                        @php
                            $galleryImages = $post->getMedia('gallery');
                        @endphp
                        <div class="space-y-6" x-data="{ activeImage: 0 }">
                            {{-- Main Image --}}
                            <div class="aspect-video rounded-lg overflow-hidden bg-[#2a2830]">
                                @foreach($galleryImages as $index => $image)
                                    <img x-show="activeImage === {{ $index }}"
                                         src="{{ $image->getUrl('card') }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover">
                                @endforeach
                            </div>

                            {{-- Thumbnails --}}
                            @if($galleryImages->count() > 1)
                                <div class="grid grid-cols-5 gap-4">
                                    @foreach($galleryImages as $index => $image)
                                        <button @click="activeImage = {{ $index }}"
                                                :class="activeImage === {{ $index }} ? 'ring-2 ring-primary' : ''"
                                                class="aspect-video rounded-lg overflow-hidden bg-[#2a2830] hover:opacity-80 transition-opacity">
                                            <img src="{{ $image->getUrl('thumb') }}"
                                                 alt="{{ $post->title }}"
                                                 class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @elseif($post->hasMedia('featured_image'))
                        <div class="aspect-video rounded-lg overflow-hidden bg-[#2a2830]">
                            <img src="{{ $post->getFirstMediaUrl('featured_image', 'hero') }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @endif

                    {{-- Introduction Section --}}
                    <div>
                        <h2 class="text-[32px] leading-[48px] font-semibold text-white mb-6">{{ __('Introduction') }}</h2>
                        <div class="prose prose-invert prose-lg max-w-none">
                            <div class="text-[16px] leading-[24px] text-white/80">
                                @if($post->excerpt)
                                    {!! nl2br(e($post->excerpt)) !!}
                                @endif

                                @if($post->body)
                                    <div class="mt-6">
                                        {!! nl2br(e($post->body)) !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Join Conversation Button --}}
                        <div class="mt-8">
                            <a href="#comment-form"
                               class="inline-flex items-center gap-2 bg-transparent border-2 border-primary hover:bg-primary text-white px-8 py-3 rounded-full font-medium transition-colors">
                                <span>{{ __('Join the conversation') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Sidebar --}}
                <aside class="space-y-8">
                    {{-- Search Widget --}}
                    <div class="bg-[#2a2830] rounded-lg p-6">
                        <h3 class="text-[20px] font-semibold text-white mb-4">{{ __('Search Anything') }}</h3>
                        <form action="{{ route('blog.index.' . app()->getLocale()) }}" method="GET" class="relative">
                            <input type="search" name="q" placeholder="{{ __('Enter keywords...') }}"
                                   class="w-full bg-[#222126] border border-white/10 rounded-lg pl-4 pr-12 py-3 text-white placeholder-white/40 focus:outline-none focus:border-primary">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-primary hover:bg-primary/90 text-white px-4 py-1.5 rounded-md text-sm font-medium transition-colors">
                                {{ __('Search') }}
                            </button>
                        </form>
                    </div>

                    {{-- Recent Posts Widget --}}
                    @if($recentPosts->isNotEmpty())
                        <div class="bg-[#2a2830] rounded-lg p-6">
                            <h3 class="text-[20px] font-semibold text-white mb-6">{{ __('Recent Posts') }}</h3>
                            <div class="space-y-4">
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
                                        <div class="flex-1">
                                            <h4 class="text-[14px] font-semibold text-white group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                                {{ $recentPost->title }}
                                            </h4>
                                            <p class="text-[12px] text-white/60">
                                                {{ $recentPost->excerpt ? \Illuminate\Support\Str::limit($recentPost->excerpt, 50) : '' }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Recent Comments Widget --}}
                    <div class="bg-[#2a2830] rounded-lg p-6">
                        <h3 class="text-[20px] font-semibold text-white mb-6">{{ __('Recent Comments') }}</h3>
                        <div class="space-y-4">
                            @for($i = 0; $i < 3; $i++)
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-semibold">
                                        {{ chr(65 + $i) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="text-[14px] font-semibold text-white">{{ __('Mohamed Sayed') }}</h4>
                                            <span class="text-[10px] text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ __('Active') }}</span>
                                        </div>
                                        <p class="text-[12px] text-white/60 line-clamp-2">
                                            {{ __('Powerful project management tools for your composites of...') }}
                                        </p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- Full Width Comment Form Section --}}
    <section class="py-16 bg-[#222126]">
        <div class="container mx-auto px-4">
            {{-- Decorative CTA with Arrows --}}
            <div class="relative py-16">
                {{-- Left Arrow --}}
                <div class="absolute left-0 top-1/2 -translate-y-1/2">
                    <svg width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.5 76.5L1 38.5L38.5 1" stroke="#C09A5B" stroke-width="2"/>
                        <path d="M76 38.5L38.5 76.5L1 38.5" stroke="#C09A5B" stroke-width="2"/>
                    </svg>
                </div>

                {{-- Center Content --}}
                <div class="text-center px-24">
                    <h3 class="text-[24px] leading-[36px] font-semibold text-white mb-2">
                        {{ __('Explore Our') }} <span class="text-primary">{{ __('Comprehensive') }}</span>
                    </h3>
                    <p class="text-[24px] leading-[36px] font-semibold text-primary">
                        {{ __('Interior Design Services') }}
                    </p>
                </div>

                {{-- Right Arrow --}}
                <div class="absolute right-0 top-1/2 -translate-y-1/2 rotate-180">
                    <svg width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.5 76.5L1 38.5L38.5 1" stroke="#C09A5B" stroke-width="2"/>
                        <path d="M76 38.5L38.5 76.5L1 38.5" stroke="#C09A5B" stroke-width="2"/>
                    </svg>
                </div>
            </div>

            {{-- Comment Form --}}
            <div id="comment-form" class="bg-[#2a2830] rounded-lg p-8">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="name" class="block text-white text-sm font-medium mb-2">{{ __('Full Name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('Enter your Name') }}"
                                   class="w-full bg-[#222126] border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label for="email" class="block text-white text-sm font-medium mb-2">{{ __('Email') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ __('Enter your Email') }}"
                                   class="w-full bg-[#222126] border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label for="website" class="block text-white text-sm font-medium mb-2">{{ __('Website') }}</label>
                            <input type="url" id="website" name="website" placeholder="{{ __('Enter your Website') }}"
                                   class="w-full bg-[#222126] border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label for="comment" class="block text-white text-sm font-medium mb-2">{{ __('Your Comment') }}</label>
                        <textarea id="comment" name="comment" rows="6" placeholder="{{ __('Enter your Comment') }}"
                                  class="w-full bg-[#222126] border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-primary resize-none"></textarea>
                    </div>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-12 py-3 rounded-full font-medium transition-colors">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>

            {{-- Bottom Decorative CTA --}}
            <div class="relative py-16">
                {{-- Left Arrow --}}
                <div class="absolute left-0 top-1/2 -translate-y-1/2">
                    <svg width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.5 76.5L1 38.5L38.5 1" stroke="#C09A5B" stroke-width="2"/>
                        <path d="M76 38.5L38.5 76.5L1 38.5" stroke="#C09A5B" stroke-width="2"/>
                    </svg>
                </div>

                {{-- Center Content --}}
                <div class="text-center px-24">
                    <h3 class="text-[24px] leading-[36px] font-semibold text-white mb-2">
                        {{ __('Explore Our') }} <span class="text-primary">{{ __('Comprehensive') }}</span>
                    </h3>
                    <p class="text-[24px] leading-[36px] font-semibold text-primary">
                        {{ __('Interior Design Services') }}
                    </p>
                </div>

                {{-- Right Arrow --}}
                <div class="absolute right-0 top-1/2 -translate-y-1/2 rotate-180">
                    <svg width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.5 76.5L1 38.5L38.5 1" stroke="#C09A5B" stroke-width="2"/>
                        <path d="M76 38.5L38.5 76.5L1 38.5" stroke="#C09A5B" stroke-width="2"/>
                    </svg>
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
