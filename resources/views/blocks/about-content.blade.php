{{-- About Content Block with Video --}}
@php
    // Extract file path from array (FileUpload format) or use as string (legacy)
    $videoThumbnailRaw = $data['video_thumbnail'] ?? null;
    $videoThumbnailPath = is_array($videoThumbnailRaw) ? ($videoThumbnailRaw[0] ?? null) : $videoThumbnailRaw;
    $videoThumbnail = $videoThumbnailPath
        ? ((str_starts_with($videoThumbnailPath, 'http://') || str_starts_with($videoThumbnailPath, 'https://') || str_starts_with($videoThumbnailPath, '/'))
            ? asset($videoThumbnailPath)
            : asset('storage/' . $videoThumbnailPath))
        : asset('images/about-content-image.jpg');

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

<section class="pesaro-about-content">
    <div class="pesaro-about-content-container">
        <div class="pesaro-about-content-wrapper">
            <!-- Video Container -->
            <div class="pesaro-about-video-container"
                 x-data="{
                     showVideo: false,
                     videoUrl: '{{ $videoUrl }}'
                 }">

                <!-- Thumbnail -->
                <div x-show="!showVideo" class="pesaro-about-video-thumbnail">
                    <img
                        src="{{ $videoThumbnail }}"
                        alt="{{ $contentTitle }}"
                    >
                    <!-- Dark Overlay -->
                    <div class="pesaro-about-video-overlay"></div>

                    <!-- Play Button -->
                    <a
                        @click.prevent="showVideo = true"
                        href="#"
                        class="pesaro-about-video-play-button"
                        aria-label="{{ __('Play video') }}"
                    >
                        <svg fill="currentColor" viewBox="0 0 26 43">
                            <path d="M8 5v33l18-16.5z"/>
                        </svg>
                    </a>
                </div>

                <!-- YouTube Iframe -->
                <div x-show="showVideo" x-cloak class="pesaro-about-video-iframe-container">
                    <iframe
                        :src="showVideo ? videoUrl + '?autoplay=1' : ''"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>

            <!-- Text Content -->
            @if($contentTitle || $contentBody)
            <div class="pesaro-about-text-content">
                @if($contentTitle)
                <!-- Title -->
                <h2>
                    {{ $contentTitle }}
                </h2>
                @endif

                @if($contentBody)
                <!-- Description -->
                <div class="pesaro-about-text-content-body">
                    {!! $contentBody !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
