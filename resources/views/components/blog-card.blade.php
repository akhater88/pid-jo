@props(['post'])

<article class="group bg-secondary rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-primary/10">
    <a href="{{ route('blog.show.' . app()->getLocale(), $post->slug) }}" class="block">
        <!-- Image -->
        <div class="aspect-[16/9] overflow-hidden">
            @if($post->hasMedia('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image', 'card') }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-dark flex items-center justify-center">
                    <svg class="w-16 h-16 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Meta -->
            <div class="flex items-center text-white/50 text-sm mb-3 space-x-4 rtl:space-x-reverse">
                <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                    {{ $post->published_at->format('M d, Y') }}
                </time>

                @if($post->comments_count ?? 0)
                    <span class="flex items-center">
                        <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ $post->comments_count }}
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors line-clamp-2">
                {{ $post->title }}
            </h3>

            <!-- Excerpt -->
            @if($post->excerpt)
                <p class="text-white/70 text-sm line-clamp-3 mb-4">
                    {{ $post->excerpt }}
                </p>
            @endif

            <!-- Read More -->
            <div class="flex items-center text-primary text-sm font-semibold">
                <span>{{ __('Read More') }}</span>
                <svg class="w-4 h-4 ms-2 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>
    </a>
</article>
