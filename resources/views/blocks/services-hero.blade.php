{{-- Services Hero Block --}}
@php
    $title = $data['title'] ?? __('Our Services');
    // Extract file path from array (FileUpload format) or use as string (legacy)
    $backgroundImagePath = $data['background_image'] ?? null;
    $backgroundImagePath = is_array($backgroundImagePath) ? ($backgroundImagePath[0] ?? null) : $backgroundImagePath;
    $backgroundImage = !empty($backgroundImagePath)
        ? asset('storage/' . $backgroundImagePath)
        : asset('storage/hero-images/services-hero-bg.jpg');
@endphp

<section class="pesaro-services-hero relative bg-[#222126] border-b-2 border-[#403e3e] min-h-[429px]">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img
            src="{{ $backgroundImage }}"
            alt="{{ $title }}"
            class="absolute inset-0 w-full h-full object-cover"
        >
        <!-- Overlay Gradients -->
        <div class="absolute inset-0" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 3.5%, rgba(0, 0, 0, 0.06) 37.5%), linear-gradient(90deg, rgba(0, 0, 0, 0.765) 0%, rgba(0, 0, 0, 0.425) 100%)"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 pt-[217px] pb-[106px]">
        <!-- Page Title -->
        <h1 class="text-[40px] leading-[60px] font-semibold text-white tracking-[-0.8px] mb-[10px]">
            {{ $title }}
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
            <span class="text-[26px] leading-[36px] font-semibold text-[#c09a5b]">{{ $title }}</span>
        </nav>
    </div>
</section>
