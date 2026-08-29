@php
// Testimonials Grid Block - Display testimonials in a 3-column grid
$section_label = $data['section_label'] ?? 'Testimonials';
$section_title = $data['section_title'] ?? 'Explore Our Comprehensive Interior Design Services';
$limit = $data['limit'] ?? 3;

// Fetch testimonials
$testimonials = \App\Models\Testimonial::query()
    ->published()
    ->ordered()
    ->limit($limit)
    ->get();
@endphp

<section class="pesaro-testimonials-section">
    <div class="pesaro-testimonials-container">
        <!-- Decorative Scribbles -->
        <div class="pesaro-testimonials-decoration pesaro-testimonials-decoration-left">
            <img src="{{ asset('images/testimonial-scribble-left.png') }}" alt="">
        </div>
        <div class="pesaro-testimonials-decoration pesaro-testimonials-decoration-right">
            <img src="{{ asset('images/testimonial-scribble-right.png') }}" alt="">
        </div>

        <!-- Section Header -->
        <div class="pesaro-testimonials-header">
            <!-- Badge -->
            @if(isset($data['subheading']) && !empty($data['subheading']))
                <div class="pesaro-testimonials-badge">
                    <ul><li>{{ $data['subheading'] }}</li></ul>
                </div>
            @endif

            <!-- Title -->
            @if(isset($data['heading']) && !empty($data['heading']))
                <h2 class="pesaro-testimonials-title">
                    {!! $data['heading'] !!}
                </h2>
            @endif
        </div>

        <!-- Testimonials Grid -->
        @if($testimonials->isNotEmpty())
            <div class="pesaro-testimonials-grid">
                @foreach($testimonials as $testimonial)
                    <div class="pesaro-testimonial-card">
                        <!-- Quote Icon Badge -->
                        <div class="pesaro-testimonial-quote-badge">
                            <div class="pesaro-testimonial-quote-icon">
                                <img src="{{ asset('images/quote-icon.png') }}" alt="">
                            </div>
                        </div>

                        <!-- Author Info (at top with RTL layout) -->
                        <div class="pesaro-testimonial-author">
                            <!-- Avatar -->
                            <div class="pesaro-testimonial-avatar">
                                @if($testimonial->hasMedia('avatar'))
                                    <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'thumb') }}"
                                         alt="{{ $testimonial->getTranslation('client_name', app()->getLocale()) }}">
                                @else
                                    <img src="{{ asset('images/testimonial-avatar.jpg') }}"
                                         alt="{{ $testimonial->getTranslation('client_name', app()->getLocale()) }}">
                                @endif
                            </div>

                            <!-- Name & Role -->
                            <div class="pesaro-testimonial-author-info">
                                <h5>{{ $testimonial->getTranslation('client_name', app()->getLocale()) }}</h5>
                                @if($testimonial->getTranslation('client_title', app()->getLocale()))
                                    <p class="gold">{{ $testimonial->getTranslation('client_title', app()->getLocale()) }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="pesaro-testimonial-text">
                            {{ $testimonial->getTranslation('testimonial', app()->getLocale()) }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="pesaro-text-center">
                <p>{{ __('No testimonials available at the moment.') }}</p>
            </div>
        @endif
    </div>
</section>
