{{-- About Timeline Block --}}
@php
    $sectionTitle = $data['section_title'] ?? __('Explore Our Comprehensive Interior Design Services');
    $sectionBadge = $data['section_badge'] ?? __('Our Story');
    $timeline1951Image = $data['timeline_1951_image'] ?? asset('images/about-timeline-1951.jpg');
    $centerTitle = $data['center_title'] ?? __('Supervision & execution Accessories');
    $centerDescription = $data['center_description'] ?? '';
    $timeline2026Image = $data['timeline_2026_image'] ?? asset('images/about-timeline-2026.jpg');
@endphp

<section class="pesaro-about-timeline bg-[#222126] border-b-2 border-[#403e3e] py-[39px] pb-[103px]">
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

        <!-- Timeline Content -->
        <div class="max-w-[1190px] mx-auto relative">
            <div class="relative" style="min-height: 254px;">
                <!-- 1951 Timeline - Left -->
                <div class="absolute left-0 top-0 flex flex-col gap-[16px] items-start">
                    <!-- Image -->
                    <img
                        src="{{ $timeline1951Image }}"
                        alt="{{ __('Founded in 1951') }}"
                        class="w-[130px] h-[120px] rounded-[16px] object-cover"
                    >
                    <!-- Line with dot and year -->
                    <div class="flex flex-col gap-[12px]">
                        <!-- Line with dot -->
                        <div class="relative flex items-center py-[10px]">
                            <div class="w-[370px] h-[2px] bg-[#c09a5b]"></div>
                            <div class="absolute left-0 top-[3.78px] w-[15px] h-[15px] rounded-[7.5px] bg-[#c09a5b]"></div>
                        </div>
                        <!-- Year -->
                        <p class="text-[28px] leading-normal font-semibold text-white capitalize mb-0">1951</p>
                    </div>
                </div>

                <!-- Center Card -->
                <div class="absolute left-1/2 -translate-x-1/2 top-[40px] bg-[#353535] rounded-[24px] px-[24px] pt-[24px] pb-[30px] w-[450px] shadow-[0px_4px_25px_rgba(39,39,39,0.8)]">
                    <div class="flex flex-col gap-[6px]">
                        <p class="text-[23px] leading-[32px] font-semibold text-white capitalize mb-0">
                            {{ $centerTitle }}
                        </p>
                        <p class="text-[20px] leading-[30px] font-medium text-white/80 mb-0">
                            {{ $centerDescription }}
                        </p>
                    </div>
                </div>

                <!-- 2026 Timeline - Right -->
                <div class="absolute right-0 top-0 flex flex-col gap-[16px] items-end">
                    <!-- Image -->
                    <img
                        src="{{ $timeline2026Image }}"
                        alt="{{ __('Looking to 2026') }}"
                        class="w-[130px] h-[120px] rounded-[16px] object-cover"
                    >
                    <!-- Line with dot and year -->
                    <div class="flex flex-col gap-[12px] items-end">
                        <!-- Line with dot -->
                        <div class="relative flex items-center py-[10px]">
                            <div class="w-[370px] h-[2px] bg-[#c09a5b]"></div>
                            <div class="absolute right-0 top-[3.78px] w-[15px] h-[15px] rounded-[7.5px] bg-[#c09a5b]"></div>
                        </div>
                        <!-- Year -->
                        <p class="text-[28px] leading-normal font-semibold text-white capitalize mb-0">2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
