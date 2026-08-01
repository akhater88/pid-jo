@extends('layouts.app')

@section('content')
    {{-- Contact Hero Section --}}
    <section class="pesaro-about-hero">
        {{-- Background Image --}}
        <div class="pesaro-about-hero-background">
            @if(file_exists(public_path('images/contact-hero-bg.jpg')))
                <img src="{{ asset('images/contact-hero-bg.jpg') }}"
                     alt="{{ __('Contact Us') }}">
            @else
                {{-- Fallback gradient background if image doesn't exist --}}
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #222126 0%, #353535 100%);"></div>
            @endif
            {{-- Overlay Gradients --}}
            <div class="pesaro-about-hero-overlay"></div>
        </div>

        {{-- Content --}}
        <div class="pesaro-about-hero-content">
            {{-- Page Title --}}
            <h1 class="pesaro-about-hero-title">
                {{ __('Contact Us') }}
            </h1>

            {{-- Breadcrumb --}}
            <nav class="pesaro-about-hero-breadcrumb" aria-label="Breadcrumb">
                <div class="pesaro-about-hero-breadcrumb-item">
                    <a href="{{ route('home.' . app()->getLocale()) }}" class="pesaro-about-hero-breadcrumb-link">
                        {{ __('Home') }}
                    </a>
                    <div class="pesaro-about-hero-breadcrumb-separator">
                        <svg width="14" height="7" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1.5L8.5 8.5L15.5 1.5" stroke="#C09A5B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <span class="pesaro-about-hero-breadcrumb-current">{{ __('Contact Us') }}</span>
            </nav>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-16 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Contact Form --}}
                <div>
                    <div class="bg-secondary rounded-lg p-8">
                        <h2 class="text-2xl font-bold text-white mb-6">{{ __('Send us a Message') }}</h2>

                        @if(session('success'))
                            <div class="bg-primary/20 border border-primary/50 text-white px-4 py-3 rounded-lg mb-6">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.store.' . app()->getLocale()) }}" method="POST" class="space-y-6">
                            @csrf

                            {{-- Honeypot Field --}}
                            <input type="text" name="pesaro_field" class="hidden" tabindex="-1" autocomplete="off">

                            {{-- Full Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-white mb-2">
                                    {{ __('Full Name') }} <span class="text-primary">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                       class="w-full px-4 py-3 bg-dark border border-white/10 rounded-lg text-white placeholder-white/40 focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-white mb-2">
                                    {{ __('Email') }} <span class="text-primary">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       class="w-full px-4 py-3 bg-dark border border-white/10 rounded-lg text-white placeholder-white/40 focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Phone (Optional) --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-white mb-2">
                                    {{ __('Phone') }}
                                </label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 bg-dark border border-white/10 rounded-lg text-white placeholder-white/40 focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Subject (Optional) --}}
                            <div>
                                <label for="subject" class="block text-sm font-medium text-white mb-2">
                                    {{ __('Subject') }}
                                </label>
                                <input type="text"
                                       id="subject"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       class="w-full px-4 py-3 bg-dark border border-white/10 rounded-lg text-white placeholder-white/40 focus:border-primary focus:ring-1 focus:ring-primary transition-colors @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message" class="block text-sm font-medium text-white mb-2">
                                    {{ __('Your Message') }} <span class="text-primary">*</span>
                                </label>
                                <textarea id="message"
                                          name="message"
                                          rows="6"
                                          required
                                          class="w-full px-4 py-3 bg-dark border border-white/10 rounded-lg text-white placeholder-white/40 focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit"
                                    class="w-full bg-primary hover:bg-primary-600 text-white px-8 py-4 rounded-lg font-medium transition-colors">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Contact Information --}}
                <div>
                    <div class="space-y-8">
                        {{-- Administration Contact --}}
                        <div class="bg-secondary rounded-lg p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Administration') }}</h3>
                                    <p class="text-white/70 mb-1">+962 6 55 3 11 77</p>
                                    <p class="text-white/70">+962 77 00 2 32 42</p>
                                </div>
                            </div>
                        </div>

                        {{-- Showroom Contact --}}
                        <div class="bg-secondary rounded-lg p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Showroom') }}</h3>
                                    <p class="text-white/70 mb-1">+962 6 567 58 58</p>
                                    <p class="text-white/70">+962 77 100 23 23</p>
                                </div>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="bg-secondary rounded-lg p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Email us') }}</h3>
                                    <a href="mailto:info@pid-jo.com" class="text-primary hover:text-primary-400 transition-colors">
                                        info@pid-jo.com
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="bg-secondary rounded-lg p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Our Location') }}</h3>
                                    <p class="text-white/70">{{ __('Amman, Jordan') }}</p>
                                    <p class="text-white/70">{{ __('Khalda, Rawan Mall') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="bg-secondary rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-white mb-4">{{ __('Connect with us:') }}</h3>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 bg-dark hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-dark hover:bg-primary rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
