@php
// Section Heading Block - Standalone heading block for page builder
$title = $data['title'] ?? '';
$subtitle = $data['subtitle'] ?? '';
$description = $data['description'] ?? '';
$align = $data['align'] ?? 'center'; // left, center, right
@endphp

<section class="pesaro-section">
    <div class="pesaro-container">
        <div class="pesaro-section-header">
            @if($subtitle)
                <p class="pesaro-section-label">{{ $subtitle }}</p>
            @endif

            @if($title)
                <h2 class="pesaro-section-title">{{ $title }}</h2>
            @endif

            @if($description)
                <p>{{ $description }}</p>
            @endif
        </div>
    </div>
</section>
