<header class="pesaro-header" x-data="{ mobileMenuOpen: false }">
    <div class="pesaro-header-container">
        <!-- Logo -->
        <div class="pesaro-logo">
            <a href="{{ route('home.' . app()->getLocale()) }}">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Pesaro Interior">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="pesaro-nav">
            <a href="{{ route('home.' . app()->getLocale()) }}"
               class="{{ request()->routeIs('home.*') ? 'active' : '' }}">
                <span>{{ __('Home') }}</span>
                @if(request()->routeIs('home.*'))
                    <img class="pesaro-nav-underline"
                         src="{{ asset('images/menu-underline.png') }}"
                         alt="">
                @endif
            </a>
            <a href="{{ route('about.' . app()->getLocale()) }}"
               class="{{ request()->routeIs('about.*') ? 'active' : '' }}">
                <span>{{ __('About us') }}</span>
                @if(request()->routeIs('about.*'))
                    <img class="pesaro-nav-underline"
                         src="{{ asset('images/menu-underline.png') }}"
                         alt="">
                @endif
            </a>
            <a href="{{ route('services.index.' . app()->getLocale()) }}"
               class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                <span>{{ __('Our Services') }}</span>
                @if(request()->routeIs('services.*'))
                    <img class="pesaro-nav-underline"
                         src="{{ asset('images/menu-underline.png') }}"
                         alt="">
                @endif
            </a>
            <a href="{{ route('blog.index.' . app()->getLocale()) }}"
               class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                <span>{{ __('News & Blogs') }}</span>
                @if(request()->routeIs('blog.*'))
                    <img class="pesaro-nav-underline"
                         src="{{ asset('images/menu-underline.png') }}"
                         alt="">
                @endif
            </a>
        </nav>

        <!-- Right Side: Language Switcher & Contact Button -->
        <div class="pesaro-header-right">
            <!-- Language Switcher -->
            <a href="{{ route('locale.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}"
               class="pesaro-lang-switcher"
               aria-label="{{ app()->getLocale() === 'en' ? __('Switch to Arabic') : __('Switch to English') }}">
                <img src="{{ asset('images/us-flag.png') }}"
                     alt="{{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}"
                     width="24"
                     height="24">
                <span>{{ app()->getLocale() === 'en' ? 'ENG' : 'عربي' }}</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path d="M6 8l4 4 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <!-- Contact Button -->
            <a href="{{ route('contact.' . app()->getLocale()) }}"
               class="pesaro-contact-btn">
                {{ __('Contact US') }}
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="pesaro-mobile-menu-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="pesaro-mobile-menu"
         style="display: none;">
        <a href="{{ route('home.' . app()->getLocale()) }}">{{ __('Home') }}</a>
        <a href="{{ route('about.' . app()->getLocale()) }}">{{ __('About us') }}</a>
        <a href="{{ route('services.index.' . app()->getLocale()) }}">{{ __('Our Services') }}</a>
        <a href="{{ route('blog.index.' . app()->getLocale()) }}">{{ __('News & Blogs') }}</a>

        <!-- Language Switcher (Mobile) -->
        <a href="{{ route('locale.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}"
           class="pesaro-mobile-lang-switcher">
            <img src="{{ asset('images/us-flag.png') }}"
                 alt="{{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}"
                 width="24"
                 height="24">
            <span>{{ app()->getLocale() === 'en' ? __('Switch to Arabic') : __('Switch to English') }}</span>
        </a>

        <a href="{{ route('contact.' . app()->getLocale()) }}" class="pesaro-contact-btn">
            {{ __('Contact US') }}
        </a>
    </div>
</header>
