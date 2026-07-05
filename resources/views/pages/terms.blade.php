@extends('layouts.app')

@section('content')
    {{-- Inner Page Hero --}}
    <section class="relative bg-dark-lighter py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home.' . app()->getLocale()) }}" class="text-white/60 hover:text-primary transition-colors">
                    {{ __('Home') }}
                </a>
                <svg class="w-4 h-4 text-white/40 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-primary">{{ __('Terms & Conditions') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('Terms & Conditions') }}
            </h1>
        </div>
    </section>

    {{-- Terms Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto prose prose-invert prose-lg">
                <div class="text-white/80 leading-relaxed space-y-6">
                    <h2 class="text-2xl font-bold text-white">{{ __('Introduction') }}</h2>
                    <p>
                        {{ __('These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Pesaro accessible at www.pid-jo.com.') }}
                    </p>
                    <p>
                        {{ __('These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written here. You must not use this Website if you disagree with any of these Website\'s Standard Terms and Conditions.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Intellectual Property Rights') }}</h2>
                    <p>
                        {{ __('Other than the content you own, under these Terms, Pesaro and/or its licensors own all the intellectual property rights and materials contained in this Website.') }}
                    </p>
                    <p>
                        {{ __('You are granted a limited license only for the purposes of viewing the material contained on this Website.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Restrictions') }}</h2>
                    <p>
                        {{ __('You are specifically restricted from all of the following:') }}
                    </p>
                    <ul class="list-disc ps-6 space-y-2">
                        <li>{{ __('publishing any Website material in any other media;') }}</li>
                        <li>{{ __('selling, sublicensing, and/or otherwise commercializing any Website material;') }}</li>
                        <li>{{ __('publicly performing and/or showing any Website material;') }}</li>
                        <li>{{ __('using this Website in any way that is or may be damaging to this Website;') }}</li>
                        <li>{{ __('using this Website in any way that impacts user access to this Website;') }}</li>
                        <li>{{ __('using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;') }}</li>
                        <li>{{ __('engaging in any data mining, data harvesting, data extracting, or any other similar activity in relation to this Website;') }}</li>
                        <li>{{ __('using this Website to engage in any advertising or marketing.') }}</li>
                    </ul>
                    <p>
                        {{ __('Certain areas of this Website are restricted from being accessed by you and the Pesaro team may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Your Content') }}</h2>
                    <p>
                        {{ __('In these Website Standard Terms and Conditions, Your Content shall mean any audio, video text, images, or other material you choose to display on this Website. By displaying Your Content, you grant Pesaro a non exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.') }}
                    </p>
                    <p>
                        {{ __('Your Content must be your own and must not be invading any third party s rights. Pesaro reserves the right to remove any of Your Content from this Website at any time without notice.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Your Privacy') }}</h2>
                    <p>
                        {{ __('Please read Privacy Policy.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Limitation of Liability') }}</h2>
                    <p>
                        {{ __('In no event shall Pesaro, nor any of its officers, directors and employees, be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. Pesaro, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Variation of Terms') }}</h2>
                    <p>
                        {{ __('Pesaro is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Contact Information') }}</h2>
                    <p>
                        {{ __('If you have any questions about these Terms and Conditions, please contact us at:') }}
                    </p>
                    <p>
                        <strong>{{ __('Email:') }}</strong> info@pid-jo.com<br>
                        <strong>{{ __('Phone:') }}</strong> +962 6 55 3 11 77<br>
                        <strong>{{ __('Address:') }}</strong> {{ __('Amman, Jordan - Khalda, Rawan Mall') }}
                    </p>

                    <p class="text-sm text-white/60">
                        {{ __('Last updated: ') }} {{ now()->format('F j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
