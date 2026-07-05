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
                <span class="text-primary">{{ __('About Us') }}</span>
            </nav>

            {{-- Page Title --}}
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ __('About Us') }}
            </h1>
        </div>
    </section>

    {{-- Main About Content --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                        {{ __('What the Benefit to get Work with Pesaro') }}
                    </h2>
                    <p class="text-lg text-white/80 leading-relaxed">
                        {{ __('With Finnen, you can transfer your money in a second. We also provide you with secure transfer, don\'t need any frustations! Sometimes, I\'m really impress with my own product provide you with secure transfer.') }}
                    </p>
                </div>

                {{-- Company Image/Video Placeholder --}}
                <div class="aspect-video bg-secondary rounded-lg overflow-hidden mb-12">
                    <div class="w-full h-full bg-gradient-to-br from-primary/10 to-transparent flex items-center justify-center">
                        <svg class="w-24 h-24 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>

                {{-- Company Story --}}
                <div class="prose prose-invert prose-lg max-w-none">
                    <p class="text-white/80 leading-relaxed mb-6">
                        {{ __('Pesaro has been a leading name in interior design and execution since 1951. With over seven decades of experience, we have transformed countless spaces into beautiful, functional environments that reflect our clients\' unique vision and style.') }}
                    </p>
                    <p class="text-white/80 leading-relaxed mb-6">
                        {{ __('Our commitment to excellence, attention to detail, and innovative design solutions have made us a trusted partner for residential and commercial projects throughout Jordan and the region.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Grid --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-primary uppercase tracking-wider mb-2">{{ __('Why Choose Us') }}</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ __('What Makes Pesaro Different') }}
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Benefit 1 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Expert Design Team') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('Our experienced designers bring creativity and technical expertise to every project, ensuring exceptional results.') }}
                    </p>
                </div>

                {{-- Benefit 2 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Fast Execution') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('We deliver projects on time without compromising on quality, ensuring smooth and efficient execution.') }}
                    </p>
                </div>

                {{-- Benefit 3 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Best Value') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('Competitive pricing and transparent costs ensure you get the best value for your investment.') }}
                    </p>
                </div>

                {{-- Benefit 4 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Premium Materials') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('We source the finest materials and finishes to ensure durability and aesthetic excellence.') }}
                    </p>
                </div>

                {{-- Benefit 5 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Client-Focused Approach') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('We work closely with our clients to understand their needs and deliver personalized solutions.') }}
                    </p>
                </div>

                {{-- Benefit 6 --}}
                <div class="bg-secondary rounded-lg p-8">
                    <div class="w-14 h-14 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-white mb-3">{{ __('Quality Guarantee') }}</h4>
                    <p class="text-white/70 leading-relaxed">
                        {{ __('All our work is backed by quality guarantees and comprehensive after-sales support.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Story Timeline --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-primary uppercase tracking-wider mb-2">{{ __('Our Journey') }}</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ __('Seven Decades of Excellence') }}
                </h3>
            </div>

            <div class="max-w-4xl mx-auto">
                {{-- Timeline Items --}}
                <div class="space-y-12">
                    {{-- 1951 --}}
                    <div class="flex gap-6 md:gap-8">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">1951</span>
                            </div>
                        </div>
                        <div class="flex-1 pt-2">
                            <h4 class="text-xl font-semibold text-white mb-2">{{ __('The Beginning') }}</h4>
                            <p class="text-white/70 leading-relaxed">
                                {{ __('Pesaro was founded with a vision to bring exceptional interior design to Jordan. Starting with small residential projects, we quickly built a reputation for quality and innovation.') }}
                            </p>
                        </div>
                    </div>

                    {{-- 1980s --}}
                    <div class="flex gap-6 md:gap-8">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">1980s</span>
                            </div>
                        </div>
                        <div class="flex-1 pt-2">
                            <h4 class="text-xl font-semibold text-white mb-2">{{ __('Expansion & Growth') }}</h4>
                            <p class="text-white/70 leading-relaxed">
                                {{ __('We expanded our services to include commercial projects and opened our first showroom in Khalda, showcasing the finest materials and designs.') }}
                            </p>
                        </div>
                    </div>

                    {{-- 2000s --}}
                    <div class="flex gap-6 md:gap-8">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">2000s</span>
                            </div>
                        </div>
                        <div class="flex-1 pt-2">
                            <h4 class="text-xl font-semibold text-white mb-2">{{ __('Modern Innovation') }}</h4>
                            <p class="text-white/70 leading-relaxed">
                                {{ __('Embracing new technologies and design trends, we introduced contemporary styles while maintaining our commitment to craftsmanship and quality.') }}
                            </p>
                        </div>
                    </div>

                    {{-- 2026 --}}
                    <div class="flex gap-6 md:gap-8">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">2026</span>
                            </div>
                        </div>
                        <div class="flex-1 pt-2">
                            <h4 class="text-xl font-semibold text-white mb-2">{{ __('Present & Future') }}</h4>
                            <p class="text-white/70 leading-relaxed">
                                {{ __('Today, Pesaro continues to lead the industry with innovative designs, sustainable practices, and a dedication to exceeding client expectations in every project we undertake.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-16 bg-dark-lighter">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('Ready to Transform Your Space?') }}
                </h2>
                <p class="text-lg text-white/80 mb-8">
                    {{ __('Let\'s discuss your project and bring your vision to life with Pesaro\'s expertise and dedication.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact.' . app()->getLocale()) }}"
                       class="inline-block bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-md font-medium transition-colors">
                        {{ __('Contact Us Today') }}
                    </a>
                    <a href="{{ route('services.index.' . app()->getLocale()) }}"
                       class="inline-block bg-secondary hover:bg-secondary-lighter text-white px-8 py-4 rounded-md font-medium transition-colors">
                        {{ __('View Our Services') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
