@extends('layouts.app')

@section('title', __('About Us') . ' - ' . config('app.name'))
@section('meta_description', __('Learn more about Pesaro, your trusted interior design partner in Amman, Jordan.'))

@section('content')
<!-- Hero Section with Header -->
<section class="pesaro-about-hero relative bg-[#222126] border-b-2 border-[#403e3e]">
    <!-- Background Image -->
    <div class="absolute inset-0 h-[429px]">
        <img
            src="{{ asset('images/about-hero-bg-new.jpg') }}"
            alt="{{ __('About Us') }}"
            class="absolute w-full h-[242.42%] top-[-69.7%] left-0 object-cover"
        >
        <!-- Overlay Gradients -->
        <div class="absolute inset-0" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 3.5%, rgba(0, 0, 0, 0.06) 37.5%), linear-gradient(90deg, rgba(0, 0, 0, 0.765) 0%, rgba(0, 0, 0, 0.425) 100%)"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 pt-[217px] pb-[106px]">
        <!-- Page Title -->
        <h1 class="text-[40px] leading-[60px] font-semibold text-white tracking-[-0.8px] mb-[10px]">
            {{ __('About Us') }}
        </h1>

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-4">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="text-[26px] leading-[36px] font-medium text-white/90 hover:text-white transition-colors">
                {{ __('Home') }}
            </a>
            <svg class="w-[7px] h-[14px] text-white/50 rtl:rotate-180 transform -rotate-90" fill="currentColor" viewBox="0 0 7 14">
                <path d="M0 0L7 7L0 14" />
            </svg>
            <span class="text-[26px] leading-[36px] font-semibold text-[#c09a5b]">{{ __('About Us') }}</span>
        </nav>
    </div>
</section>

<!-- Content Section with Video and Text -->
<section class="pesaro-about-content bg-[#222126] border-b-2 border-[#403e3e] py-[76px]">
    <div class="container mx-auto px-4">
        <div class="max-w-[1232px] mx-auto flex flex-col gap-[40px]">
            <!-- Video Container -->
            <div class="relative w-full h-[500px] rounded-[36px] overflow-hidden group cursor-pointer"
                 x-data="{
                     showVideo: false,
                     videoUrl: 'https://www.youtube.com/embed/dQw4w9WgXcQ'
                 }">

                <!-- Thumbnail -->
                <div x-show="!showVideo" class="relative w-full h-full">
                    <img
                        src="{{ asset('images/about-content-image.jpg') }}"
                        alt="{{ __('About Pesaro Video') }}"
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
            <div class="flex flex-col gap-[16px] max-w-[1220px]">
                <!-- Title -->
                <h2 class="text-[33px] leading-normal font-medium text-white tracking-[-0.396px]">
                    @if(app()->isLocale('en'))
                        Saudi Liver Diseases and Transplantation Society Conference 2024
                    @else
                        مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024
                    @endif
                </h2>

                <!-- Description -->
                <div class="text-[24px] leading-[46px] font-medium text-white/80">
                    @if(app()->isLocale('en'))
                        <p class="mb-0">The city of Riyadh will host the Saudi Association for Liver Diseases and Transplantation Conference 2024 to discuss developments in the medical field of liver diseases in the .</p>
                        <p class="mb-0">The Saudi Association for Liver Diseases and Transplantation Conference 2024 is scheduled to be held from October 17-19 with a wide medical presence and the participation of local and international experts and specialists. All this is to showcase the latest technologies and new developments in the field of liver diseases and their treatment.</p>
                        <p class="mb-0">The conference's activities will include various sessions, including dialogue sessions and specialized training workshops to discuss various areas related to liver diseases and their early diagnosis.</p>
                        <p>The Saudi Association for Liver Diseases and Transplantation, during its activities, works to enhance the contribution to the advancement of science and the dissemination of knowledge. It also</p>
                    @else
                        <p class="mb-0">ستستضيف مدينة الرياض مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024 لمناقشة التطورات في المجال الطبي لأمراض الكبد.</p>
                        <p class="mb-0">من المقرر عقد مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024 في الفترة من 17-19 أكتوبر بحضور طبي واسع ومشاركة خبراء ومتخصصين محليين ودوليين. كل هذا لعرض أحدث التقنيات والتطورات الجديدة في مجال أمراض الكبد وعلاجها.</p>
                        <p class="mb-0">ستتضمن أنشطة المؤتمر جلسات متنوعة، بما في ذلك جلسات الحوار وورش العمل التدريبية المتخصصة لمناقشة مختلف المجالات المتعلقة بأمراض الكبد وتشخيصها المبكر.</p>
                        <p>تعمل الجمعية السعودية لأمراض الكبد والزراعة، خلال أنشطتها، على تعزيز المساهمة في النهوض بالعلم ونشر المعرفة. كما</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="pesaro-about-timeline bg-[#222126] border-b-2 border-[#403e3e] py-[39px]">
    <div class="container mx-auto px-4">
        <!-- Section Heading -->
        <div class="flex flex-col items-center gap-[6px] mb-[42px]">
            <!-- Badge -->
            <div class="border-[1.5px] border-[#c09a5b] rounded-[51px] px-[13px] py-[8px] ps-[3px]">
                <ul class="text-[16px] font-medium text-[#c09a5b] leading-normal">
                    <li class="list-disc ms-[24px]">
                        <span>{{ __('Our Story') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Title -->
            <h2 class="text-[30px] leading-[40px] font-semibold text-center capitalize text-white">
                @if(app()->isLocale('en'))
                    <span>Explore Our </span><span class="text-[#c09a5b]">Comprehensive</span><br>
                    <span class="text-[#c09a5b]">Interior Design</span><span> Services</span>
                @else
                    <span>استكشف خدماتنا </span><span class="text-[#c09a5b]">الشاملة</span><br>
                    <span class="text-[#c09a5b]">للتصميم الداخلي</span>
                @endif
            </h2>
        </div>

        <!-- Timeline Content -->
        <div class="max-w-[1190px] mx-auto relative">
            <div class="flex items-start justify-between gap-8">
                <!-- 1951 Timeline -->
                <div class="flex flex-col gap-[16px] items-start">
                    <img
                        src="{{ asset('images/about-timeline-1951-new.jpg') }}"
                        alt="{{ __('Founded in 1951') }}"
                        class="w-[130px] h-[120px] rounded-[16px] object-cover"
                    >
                    <div class="flex flex-col gap-[12px]">
                        <!-- Line with dot -->
                        <div class="relative flex items-center py-[10px]">
                            <div class="w-[370px] h-[2px] bg-[#c09a5b]"></div>
                            <div class="absolute left-0 top-[3.78px] w-[15px] h-[15px] rounded-[7.5px] bg-[#c09a5b]"></div>
                        </div>
                        <!-- Year -->
                        <p class="text-[28px] leading-normal font-semibold text-white capitalize">1951</p>
                    </div>
                </div>

                <!-- Center Card -->
                <div class="bg-[#353535] rounded-[24px] px-[24px] pt-[24px] pb-[30px] w-[450px] shadow-[0px_4px_25px_rgba(39,39,39,0.8)] mt-[40px]">
                    <div class="flex flex-col gap-[6px]">
                        <p class="text-[23px] leading-[32px] font-semibold text-white capitalize">
                            @if(app()->isLocale('en'))
                                Supervision & execution Accessories
                            @else
                                إشراف وتنفيذ الإكسسوارات
                            @endif
                        </p>
                        <p class="text-[20px] leading-[30px] font-medium text-white/80">
                            @if(app()->isLocale('en'))
                                Powerful project management tools for your companies of all sizes. companies of all sizes.
                            @else
                                أدوات إدارة مشاريع قوية لشركاتك من جميع الأحجام.
                            @endif
                        </p>
                    </div>
                </div>

                <!-- 2026 Timeline -->
                <div class="flex flex-col gap-[16px] items-end">
                    <img
                        src="{{ asset('images/about-timeline-2026-new.jpg') }}"
                        alt="{{ __('Looking to 2026') }}"
                        class="w-[130px] h-[120px] rounded-[16px] object-cover"
                    >
                    <div class="flex flex-col gap-[12px] items-end">
                        <!-- Line with dot -->
                        <div class="relative flex items-center py-[10px]">
                            <div class="w-[370px] h-[2px] bg-[#c09a5b]"></div>
                            <div class="absolute right-0 top-[3.78px] w-[15px] h-[15px] rounded-[7.5px] bg-[#c09a5b]"></div>
                        </div>
                        <!-- Year -->
                        <p class="text-[28px] leading-normal font-semibold text-white capitalize">2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
