{{-- Blog List Block --}}
@php
    use App\Models\BlogPost;

    $sectionTitle = $data['section_title'] ?? __('Explore Our Comprehensive Interior Design Services');
    $sectionBadge = $data['section_badge'] ?? __('News & Blogs');
    $postsPerPage = $data['posts_per_page'] ?? 9;

    // Fetch published blog posts with pagination
    $posts = BlogPost::query()
        ->published()
        ->orderBy('published_at', 'desc')
        ->paginate($postsPerPage);
@endphp

<section class="pesaro-blog-section bg-[#222126] border-b-2 border-[#403e3e] py-[39px] pb-[103px]">
    <div class="container mx-auto px-4">
        <!-- Section Heading -->
        <div class="flex flex-col items-center gap-[6px] mb-[42px]">
            <!-- Badge -->
            <div class="border-[1.5px] border-[#c09a5b] rounded-[51px] px-[13px] py-[8px] ps-[3px]">
                <ul class="text-[16px] font-medium text-[#c09a5b] leading-normal">
                    <li class="list-disc ms-[24px]">
                        <span>{{ $sectionBadge }}</span>
                    </li>
                </ul>
            </div>

            <!-- Title -->
            <div class="text-[30px] leading-[40px] font-semibold text-center capitalize max-w-[665px]">
                @if(app()->isLocale('en'))
                    <p class="mb-0">
                        <span class="text-white">Explore Our </span><span class="text-[#c09a5b]">Comprehensive</span>
                    </p>
                    <p class="mb-0">
                        <span class="text-[#c09a5b]">Interior Design</span><span class="text-white"> Services</span>
                    </p>
                @else
                    <p class="mb-0 text-white">
                        <span>استكشف خدماتنا </span><span class="text-[#c09a5b]">الشاملة</span>
                    </p>
                    <p class="mb-0">
                        <span class="text-[#c09a5b]">للتصميم الداخلي</span>
                    </p>
                @endif
            </div>
        </div>

        @if($posts->isNotEmpty())
            {{-- Blog Posts Grid with Alternating Layout --}}
            <div class="max-w-[1190px] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-[24px] mb-[60px]">
                    @foreach($posts as $index => $post)
                        @php
                            // Determine row (0-indexed)
                            $row = floor($index / 3);
                            // Position in row (0, 1, 2)
                            $posInRow = $index % 3;

                            // Pattern: Row 0 [img, text, img], Row 1 [text, img, text], Row 2 [img, text, img]
                            // Even rows (0, 2, 4...): image at positions 0 and 2
                            // Odd rows (1, 3, 5...): image at position 1
                            $imageFirst = ($row % 2 === 0) ? ($posInRow !== 1) : ($posInRow === 1);
                        @endphp

                        <article class="pesaro-blog-card bg-[#353535] rounded-[24px] overflow-hidden shadow-[0px_4px_25px_rgba(39,39,39,0.8)] flex flex-col h-full">
                            @if($imageFirst)
                                {{-- Image First --}}
                                <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                                   class="block w-full h-[246px] overflow-hidden">
                                    @if($post->hasMedia('featured_image'))
                                        <img src="{{ $post->getFirstMediaUrl('featured_image', 'card') }}"
                                             alt="{{ $post->title }}"
                                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-[#222126] flex items-center justify-center">
                                            <svg class="w-16 h-16 text-[#c09a5b]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                {{-- Content --}}
                                <div class="p-[24px] flex flex-col flex-grow">
                                    <h3 class="text-[23px] leading-[32px] font-semibold text-white mb-[12px] line-clamp-2">
                                        <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                                           class="hover:text-[#c09a5b] transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    @if($post->excerpt)
                                        <p class="text-[18px] leading-[28px] font-medium text-white/80 mb-[16px] line-clamp-3 flex-grow">
                                            {{ $post->excerpt }}
                                        </p>
                                    @endif

                                    <div class="flex items-center gap-[12px] text-[16px] text-[#c09a5b]">
                                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <time datetime="{{ $post->published_at?->toISOString() }}">
                                            {{ $post->published_at?->format('F j, Y') }}
                                        </time>
                                    </div>
                                </div>
                            @else
                                {{-- Text First --}}
                                <div class="p-[24px] flex flex-col flex-grow">
                                    <h3 class="text-[23px] leading-[32px] font-semibold text-white mb-[12px] line-clamp-2">
                                        <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                                           class="hover:text-[#c09a5b] transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    @if($post->excerpt)
                                        <p class="text-[18px] leading-[28px] font-medium text-white/80 mb-[16px] line-clamp-3 flex-grow">
                                            {{ $post->excerpt }}
                                        </p>
                                    @endif

                                    <div class="flex items-center gap-[12px] text-[16px] text-[#c09a5b]">
                                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <time datetime="{{ $post->published_at?->toISOString() }}">
                                            {{ $post->published_at?->format('F j, Y') }}
                                        </time>
                                    </div>
                                </div>

                                {{-- Image --}}
                                <a href="{{ route('blog.show.' . app()->getLocale(), ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
                                   class="block w-full h-[246px] overflow-hidden">
                                    @if($post->hasMedia('featured_image'))
                                        <img src="{{ $post->getFirstMediaUrl('featured_image', 'card') }}"
                                             alt="{{ $post->title }}"
                                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-[#222126] flex items-center justify-center">
                                            <svg class="w-16 h-16 text-[#c09a5b]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-16 max-w-[600px] mx-auto">
                <svg class="w-20 h-20 text-[#c09a5b]/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-[23px] font-semibold text-white mb-2">{{ __('No Posts Yet') }}</h3>
                <p class="text-[18px] text-white/60">{{ __('Blog posts will be displayed here once they are published.') }}</p>
            </div>
        @endif
    </div>
</section>
