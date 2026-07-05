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
                <span class="text-primary">{{ __('Privacy Policy') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('Privacy Policy') }}
            </h1>
        </div>
    </section>

    {{-- Privacy Policy Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto prose prose-invert prose-lg">
                <div class="text-white/80 leading-relaxed space-y-6">
                    <h2 class="text-2xl font-bold text-white">{{ __('Introduction') }}</h2>
                    <p>
                        {{ __('These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written here. You must not use this Website if you disagree with any of these Website\'s Standard Terms and Conditions and conditions written here. You must not use this Website if you disagree with any of these Website\'s Standard Terms and and conditions written here. You must not use this Website if you disagree with any of these Website\'s.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Information We Collect') }}</h2>
                    <p>
                        {{ __('We collect information you provide directly to us through our contact forms, including your name, email address, phone number, and message content. This information is used solely to respond to your inquiries and provide the services you request.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('How We Use Your Information') }}</h2>
                    <p>
                        {{ __('The information we collect is used to:') }}
                    </p>
                    <ul class="list-disc ps-6 space-y-2">
                        <li>{{ __('Respond to your inquiries and provide customer support') }}</li>
                        <li>{{ __('Process and fulfill your service requests') }}</li>
                        <li>{{ __('Send you updates about our services and promotions (with your consent)') }}</li>
                        <li>{{ __('Improve our website and services') }}</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-white">{{ __('Data Security') }}</h2>
                    <p>
                        {{ __('We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Your Rights') }}</h2>
                    <p>
                        {{ __('You have the right to:') }}
                    </p>
                    <ul class="list-disc ps-6 space-y-2">
                        <li>{{ __('Access the personal information we hold about you') }}</li>
                        <li>{{ __('Request correction of inaccurate information') }}</li>
                        <li>{{ __('Request deletion of your personal information') }}</li>
                        <li>{{ __('Opt-out of marketing communications') }}</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-white">{{ __('Cookies') }}</h2>
                    <p>
                        {{ __('Our website uses cookies to enhance your browsing experience. You can choose to disable cookies through your browser settings, although this may affect the functionality of certain features.') }}
                    </p>

                    <h2 class="text-2xl font-bold text-white">{{ __('Contact Us') }}</h2>
                    <p>
                        {{ __('If you have any questions about this Privacy Policy, please contact us at:') }}
                    </p>
                    <p>
                        <strong>{{ __('Email:') }}</strong> info@pid-jo.com<br>
                        <strong>{{ __('Phone:') }}</strong> +962 6 55 3 11 77
                    </p>

                    <p class="text-sm text-white/60">
                        {{ __('Last updated: ') }} {{ now()->format('F j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
