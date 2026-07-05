@php
// Rich Text Block - For flexible content areas
$content = $data['content'] ?? '';
$background = $data['background'] ?? 'dark'; // dark, light, secondary
$max_width = $data['max_width'] ?? 'prose'; // prose (default), wide, full

$bgClasses = [
    'dark' => 'bg-dark',
    'light' => 'bg-dark-lighter',
    'secondary' => 'bg-secondary',
];

$widthClasses = [
    'prose' => 'max-w-prose',
    'wide' => 'max-w-4xl',
    'full' => 'max-w-none',
];
@endphp

<section class="py-16 md:py-24 {{ $bgClasses[$background] ?? $bgClasses['dark'] }}">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="{{ $widthClasses[$max_width] ?? $widthClasses['prose'] }} mx-auto prose prose-invert prose-primary">
            {!! $content !!}
        </div>
    </div>
</section>

<style>
/* Custom prose styles for rich text content */
.prose-primary {
    --tw-prose-headings: theme('colors.white');
    --tw-prose-links: theme('colors.primary.DEFAULT');
    --tw-prose-bold: theme('colors.white');
    --tw-prose-body: theme('colors.white / 80%');
}

.prose-primary a {
    color: var(--tw-prose-links);
    text-decoration: none;
    transition: color 0.2s;
}

.prose-primary a:hover {
    color: theme('colors.primary.600');
}

.prose-primary h2,
.prose-primary h3,
.prose-primary h4 {
    color: var(--tw-prose-headings);
    font-weight: 700;
}

.prose-primary ul,
.prose-primary ol {
    color: var(--tw-prose-body);
}

.prose-primary img {
    border-radius: 0.5rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.prose-primary blockquote {
    border-left-color: theme('colors.primary.DEFAULT');
    color: var(--tw-prose-body);
    font-style: italic;
}

[dir="rtl"] .prose-primary blockquote {
    border-left: none;
    border-right: 4px solid theme('colors.primary.DEFAULT');
    padding-right: 1em;
    padding-left: 0;
}
</style>
