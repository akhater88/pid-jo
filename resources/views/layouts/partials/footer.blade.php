@php
    $settings = app(\App\Settings\SiteSettings::class);
@endphp

<footer class="pesaro-footer">
    {{-- Background Image Section --}}
    <div class="pesaro-footer-bg">
        <img src="{{ asset('images/footer-bg-image.jpg') }}" alt="">
    </div>

    {{-- Main Footer Content --}}
    <div class="pesaro-footer-main">
        <div class="pesaro-footer-container">
            {{-- Contact Info Card (Left Sidebar) --}}
            <div class="pesaro-footer-contact-card">
                {{-- Decorative Shapes --}}
                <div class="pesaro-footer-card-shapes">
                    <div class="pesaro-footer-card-shape"></div>
                    <div class="pesaro-footer-card-shape"></div>
                    <div class="pesaro-footer-card-shape"></div>
                    <div class="pesaro-footer-card-shape"></div>
                </div>

                {{-- Logo --}}
                <div class="pesaro-footer-logo">
                    <img src="{{ asset('images/footer-logo.svg') }}" alt="Pesaro">
                </div>

                {{-- Contact Info --}}
                <div class="pesaro-footer-contact-content">
                    {{-- Heading --}}
                    <div class="pesaro-footer-contact-heading">
                        <h3><span class="gold">{{ __('CONTACT') }}</span> {{ __('INFO') }}</h3>
                        <div class="divider"></div>
                    </div>

                    {{-- Contact Items --}}
                    <div class="pesaro-footer-contact-items">
                        {{-- Administration Phone --}}
                        <div class="pesaro-footer-contact-item">
                            <div class="pesaro-footer-contact-icon">
                                <img src="{{ asset('images/footer-phone-icon.svg') }}" alt="">
                            </div>
                            <div class="pesaro-footer-contact-text">
                                <span class="label">{{ __('Administration') }}</span>
                                <span class="value">{{ $settings->administration_phone[app()->getLocale()] }}</span>
                            </div>
                        </div>

                        {{-- Showroom Phone --}}
                        <div class="pesaro-footer-contact-item">
                            <div class="pesaro-footer-contact-icon">
                                <img src="{{ asset('images/footer-phone-icon.svg') }}" alt="">
                            </div>
                            <div class="pesaro-footer-contact-text">
                                <span class="label">{{ __('Showroom') }}</span>
                                <span class="value">{{ $settings->showroom_phone[app()->getLocale()] }}</span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="pesaro-footer-contact-item">
                            <div class="pesaro-footer-contact-icon">
                                <img src="{{ asset('images/footer-email-icon.svg') }}" alt="">
                            </div>
                            <div class="pesaro-footer-contact-text">
                                <span class="label">{{ __('Email us') }}</span>
                                <span class="value">{{ $settings->email }}</span>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="pesaro-footer-contact-item">
                            <div class="pesaro-footer-contact-icon">
                                <img src="{{ asset('images/footer-location-icon.svg') }}" alt="">
                            </div>
                            <div class="pesaro-footer-contact-text">
                                <span class="label">{{ __('Our Location') }}</span>
                                <span class="value">{{ $settings->location[app()->getLocale()] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="pesaro-footer-social">
                        <div class="pesaro-footer-social-heading">
                            <img src="{{ asset('images/footer-line-decoration.svg') }}" alt="">
                            <p>{{ __('Connect with us:') }}</p>
                        </div>
                        <div class="pesaro-footer-social-icons">
                            @if($settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}" class="pesaro-footer-social-icon" aria-label="Facebook" target="_blank" rel="noopener">
                                    <img src="{{ asset('images/social-facebook.svg') }}" alt="Facebook">
                                </a>
                            @endif

                            @if($settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}" class="pesaro-footer-social-icon {{ $settings->instagram_url ? 'active' : '' }}" aria-label="Instagram" target="_blank" rel="noopener">
                                    <img src="{{ asset('images/social-instagram.svg') }}" alt="Instagram">
                                </a>
                            @endif

                            @if($settings->linkedin_url)
                                <a href="{{ $settings->linkedin_url }}" class="pesaro-footer-social-icon" aria-label="LinkedIn" target="_blank" rel="noopener">
                                    <img src="{{ asset('images/social-linkedin.svg') }}" alt="LinkedIn">
                                </a>
                            @endif

                            @if($settings->youtube_url)
                                <a href="{{ $settings->youtube_url }}" class="pesaro-footer-social-icon" aria-label="YouTube" target="_blank" rel="noopener">
                                    <img src="{{ asset('images/social-youtube.svg') }}" alt="YouTube">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Columns --}}
            <div class="pesaro-footer-columns">
                {{-- Pesaro Services --}}
                <div class="pesaro-footer-column">
                    <h3><span class="gold">{{ __('Pesaro') }}</span> {{ __('Services') }}</h3>
                    <div class="divider"></div>
                    <div class="pesaro-footer-links">
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Kitchens') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Interior design') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Decoration') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Consultations') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Woodworks') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('services.index') }}">{{ __('Finishing Services') }}</a>
                        </div>
                    </div>
                </div>

                {{-- Useful Links --}}
                <div class="pesaro-footer-column">
                    <h3><span class="gold">{{ __('Useful') }}</span> {{ __('Links') }}</h3>
                    <div class="divider"></div>
                    <div class="pesaro-footer-links">
                        <div class="pesaro-footer-link">
                            <a href="#">{{ __('About Us') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('blog.index') }}">{{ __('Events & Links') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="#">{{ __('Contact Us') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="{{ route('faq.' . app()->getLocale()) }}">{{ __('FAQ Questions') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="#">{{ __('Privacy Policy') }}</a>
                        </div>
                        <div class="pesaro-footer-link">
                            <a href="#">{{ __('Terms & Conditions') }}</a>
                        </div>
                    </div>
                </div>

                {{-- Pesaro Gallery --}}
                <div class="pesaro-footer-column">
                    <div class="pesaro-footer-gallery">
                        <div class="pesaro-footer-gallery-heading">
                            <h3><span class="gold">{{ __('Pesaro') }}</span> {{ __('Gallery') }}</h3>
                            <div class="divider"></div>
                        </div>
                        <div class="pesaro-footer-gallery-grid">
                            @php
                                $footerImages = \App\Models\GalleryImage::query()
                                    ->published()
                                    ->footer()
                                    ->ordered()
                                    ->limit(9)
                                    ->get();
                            @endphp

                            @forelse($footerImages as $image)
                                <a href="{{ route('gallery') }}" class="pesaro-footer-gallery-item">
                                    <img src="{{ $image->getFirstMediaUrl('image', 'thumb') }}"
                                         alt="{{ $image->getTranslation('title', app()->getLocale()) }}">
                                </a>
                            @empty
                                {{-- Placeholder images from Figma --}}
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-1.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-2.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-3.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-3.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-1.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-2.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-2.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-3.png') }}" alt="">
                                </div>
                                <div class="pesaro-footer-gallery-item">
                                    <img src="{{ asset('images/footer-gallery-1.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright Section --}}
    <div class="pesaro-footer-copyright">
        <div class="pesaro-footer-copyright-container">
            <p>{{ __('© All Copy Right Are Reserved') }}</p>
        </div>
    </div>
</footer>
