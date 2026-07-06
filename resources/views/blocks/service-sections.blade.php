{{-- Service Sections Block --}}
@if($service->sections && $service->sections->isNotEmpty())
    <section class="py-12 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                @if(!empty($data['heading']))
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 text-center">
                        {{ $data['heading'] }}
                    </h2>
                @endif

                @if(!empty($data['description']))
                    <p class="text-lg text-white/70 mb-12 text-center max-w-2xl mx-auto">
                        {{ $data['description'] }}
                    </p>
                @endif

                <div class="space-y-8">
                    @foreach($service->sections as $section)
                        <div class="bg-dark rounded-lg p-6 md:p-8">
                            @if($section->title)
                                <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                                    {{ $section->title }}
                                </h3>
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
                                @php
                                    $videoUrl = $section->media_data['video_url'];
                                    $embedUrl = '';

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
                                    <div class="aspect-video rounded-lg overflow-hidden">
                                        <iframe src="{{ $embedUrl }}"
                                                class="w-full h-full"
                                                frameborder="0"
                                                allowfullscreen></iframe>
                                    </div>
                                @endif
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
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
