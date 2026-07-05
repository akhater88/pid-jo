@php
// Timeline Block - Two-column grid layout for company history/milestones
$section_label = $data['section_label'] ?? 'Our Story';
$section_title = $data['section_title'] ?? 'Explore Our Comprehensive Interior Design Services';
$items = $data['items'] ?? [];
@endphp

<section class="pesaro-section pesaro-section-lighter">
    <div class="pesaro-container">
        <!-- Section Header -->
        <div class="pesaro-section-header">
            <p class="pesaro-section-label">
                {{ $section_label }}
            </p>
            <h2 class="pesaro-section-title">
                {{ $section_title }}
            </h2>
        </div>

        <!-- Timeline Grid -->
        @if(!empty($items))
            <div class="pesaro-timeline-container">
                <div class="pesaro-grid-2">
                    @foreach($items as $item)
                        <div class="pesaro-timeline-item">
                            <!-- Card -->
                            <div class="pesaro-timeline-card">
                                <!-- Year Badge -->
                                @if(isset($item['year']))
                                    <div class="pesaro-timeline-badge">
                                        {{ $item['year'] }}
                                    </div>
                                @endif

                                <!-- Content -->
                                @if(isset($item['title']))
                                    <h4>{{ $item['title'] }}</h4>
                                @endif

                                @if(isset($item['description']))
                                    <p>{{ $item['description'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="pesaro-text-center">
                <p>{{ __('No timeline items configured.') }}</p>
            </div>
        @endif
    </div>
</section>
