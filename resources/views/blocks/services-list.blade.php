{{-- Services List Block --}}
@php
    use App\Models\Service;

    $sectionTitle = $data['section_title'] ?? __('Explore Our Comprehensive Interior Design Services');
    $galleryLimit = $data['gallery_limit'] ?? 5;

    // Fetch published services ordered by sort_order
    $services = Service::query()
        ->published()
        ->ordered()
        ->get();
@endphp

<section class="pesaro-services-section bg-[#222126] py-[40px] pb-[103px]">
    <div class="container mx-auto px-4">
        @if($services->isNotEmpty())
            <div class="max-w-[1232px] mx-auto">
                {{-- Services Loop --}}
                @foreach($services as $index => $service)
                    <div class="content-stretch flex flex-col gap-[36px] items-center mb-[44px] last:mb-0">
                        <!-- Section Heading -->
                        <div class="content-stretch flex flex-col gap-[6px] items-center w-[665px]">
                            <!-- Badge -->
                            <div class="border-[1.5px] border-[#c09a5b] rounded-[51px] px-[13px] py-[8px] ps-[3px]">
                                <ul class="text-[16px] font-medium text-[#c09a5b] leading-normal">
                                    <li class="list-disc ms-[24px]">
                                        <span>{{ $service->title }}</span>
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

                        <!-- Gallery -->
                        @php
                            $galleryImages = $service->getMedia('gallery')->take($galleryLimit);
                        @endphp

                        @if($galleryImages->isNotEmpty())
                            <div class="content-stretch flex gap-[24px] items-start w-full">
                                @foreach($galleryImages as $galleryIndex => $image)
                                    @php
                                        // First image is large (440px), others are smaller (174px)
                                        $isLarge = $galleryIndex === 0;
                                        $width = $isLarge ? 'w-[440px]' : 'w-[174px]';
                                    @endphp

                                    <a href="{{ route('services.show.' . app()->getLocale(), ['slug' => $service->getTranslation('slug', app()->getLocale())]) }}"
                                       class="h-[560px] relative rounded-[26px] shrink-0 {{ $width }} group overflow-hidden">
                                        <img
                                            src="{{ $image->getUrl('card') }}"
                                            alt="{{ $service->title }} - {{ __('Image') }} {{ $galleryIndex + 1 }}"
                                            class="absolute inset-0 w-full h-full object-cover rounded-[26px] group-hover:scale-110 transition-transform duration-500"
                                        >
                                        <!-- Overlay -->
                                        <div class="absolute bg-[rgba(0,0,0,0.15)] inset-0 rounded-[26px] group-hover:bg-[rgba(0,0,0,0.25)] transition-colors duration-300"></div>
                                    </a>
                                @endforeach

                                @if($galleryImages->count() < $galleryLimit)
                                    {{-- Placeholder images if gallery has fewer than limit --}}
                                    @for($i = $galleryImages->count(); $i < $galleryLimit; $i++)
                                        @php
                                            $isLarge = $i === 0;
                                            $width = $isLarge ? 'w-[440px]' : 'w-[174px]';
                                        @endphp
                                        <div class="h-[560px] relative rounded-[26px] shrink-0 {{ $width }} bg-[#353535] flex items-center justify-center">
                                            <svg class="w-20 h-20 text-[#c09a5b]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        @else
                            {{-- No gallery images --}}
                            <div class="text-center py-16 max-w-[600px] mx-auto">
                                <svg class="w-20 h-20 text-[#c09a5b]/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-[18px] text-white/60">{{ __('No gallery images for this service yet.') }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 max-w-[600px] mx-auto">
                <svg class="w-20 h-20 text-[#c09a5b]/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-[23px] font-semibold text-white mb-2">{{ __('No Services Yet') }}</h3>
                <p class="text-[18px] text-white/60">{{ __('Services will be displayed here once they are published.') }}</p>
            </div>
        @endif
    </div>
</section>
