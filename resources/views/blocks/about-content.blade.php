{{-- About Content Block with Video --}}
@php
    $videoThumbnail = $data['video_thumbnail'] ?? asset('images/about-content-image.jpg');
    $videoUrl = $data['video_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ';
    $contentTitle = $data['content_title'] ?? '';
    $contentBody = $data['content_body'] ?? '';

    // Convert YouTube watch URL to embed URL
    if (str_contains($videoUrl, 'youtube.com/watch')) {
        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $params);
        $videoUrl = 'https://www.youtube.com/embed/' . ($params['v'] ?? '');
    } elseif (str_contains($videoUrl, 'youtu.be/')) {
        $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
        $videoUrl = 'https://www.youtube.com/embed/' . $videoId;
    }
@endphp

<section class="pesaro-about-content bg-[#222126] border-b-2 border-[#403e3e] py-[76px]">
    <div class="container mx-auto px-4">
        <div class="max-w-[1232px] mx-auto flex flex-col gap-[40px]">
            <!-- Video Container -->
            <div class="relative w-full h-[500px] rounded-[36px] overflow-hidden group cursor-pointer"
                 x-data="{
                     showVideo: false,
                     videoUrl: '{{ $videoUrl }}'
                 }">

                <!-- Thumbnail -->
                <div x-show="!showVideo" class="relative w-full h-full">
                    <img
                        src="{{ $videoThumbnail }}"
                        alt="{{ $contentTitle }}"
                        class="absolute inset-0 w-full h-full object-cover rounded-[36px]"
                    >
                    <!-- Dark Overlay -->
                    <div class="absolute inset-0 bg-black/30 rounded-[36px]"></div>

                    <!-- Play Button -->
                    <a
                        @click.prevent="showVideo = true"
                        href="#"
                        class="absolute top-1/2 start-1/2 -translate-x-1/2 translate-y-[4px] -translate-y-1/2 w-[84px] h-[84px] rounded-[42px] bg-[#c09a5b] flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                        aria-label="{{ __('Play video') }}"
                    >
                        <svg class="w-[25px] h-[38px] text-white -scale-y-100 ms-1" fill="currentColor" viewBox="0 0 26 43">
                            <path d="M8 5v33l18-16.5z"/>
                        </svg>
                    </a>
                </div>

                <!-- YouTube Iframe -->
                <div x-show="showVideo" x-cloak class="w-full h-full">
                    <iframe
                        :src="showVideo ? videoUrl + '?autoplay=1' : ''"
                        class="w-full h-full rounded-[36px]"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>

            <!-- Text Content -->
            @if($contentTitle || $contentBody)
            <div class="flex flex-col gap-[16px] max-w-[1220px]">
                @if($contentTitle)
                <!-- Title -->
                <h2 class="text-[33px] leading-normal font-medium text-white tracking-[-0.396px]">
                    {{ $contentTitle }}
                </h2>
                @endif

                @if($contentBody)
                <!-- Description -->
                <div class="text-[24px] leading-[46px] font-medium text-white/80 prose prose-invert prose-lg max-w-none">
                    {!! $contentBody !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
