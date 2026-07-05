@php
// Gallery Grid Block - Display gallery images with lightbox
$heading = $data['heading'] ?? '';
$subheading = $data['subheading'] ?? '';
$columns = $data['columns'] ?? 3; // 2, 3, or 4
$limit = $data['limit'] ?? 12;

// Fetch gallery images
$images = \App\Models\GalleryImage::query()
    ->published()
    ->ordered()
    ->limit($limit)
    ->get();

$gridClasses = [
    2 => 'md:grid-cols-2',
    3 => 'md:grid-cols-2 lg:grid-cols-3',
    4 => 'md:grid-cols-2 lg:grid-cols-4',
];
@endphp

<section class="py-16 md:py-24 bg-dark">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if($heading)
            <!-- Section Heading -->
            <x-section-heading :title="$heading" :subtitle="$subheading" />
        @endif

        @if($images->isNotEmpty())
            <!-- Gallery Grid with Lightbox -->
            <div x-data="{
                open: false,
                currentIndex: 0,
                images: {{ $images->pluck('id')->toJson() }},
                urls: {{ $images->map(fn($img) => $img->getFirstMediaUrl('image', 'hero'))->toJson() }},
                titles: {{ $images->pluck('title')->toJson() }},
                openLightbox(index) {
                    this.currentIndex = index;
                    this.open = true;
                    document.body.style.overflow = 'hidden';
                },
                closeLightbox() {
                    this.open = false;
                    document.body.style.overflow = '';
                },
                prev() {
                    this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
                },
                next() {
                    this.currentIndex = this.currentIndex === this.images.length - 1 ? 0 : this.currentIndex + 1;
                }
            }" @keydown.escape.window="closeLightbox()" @keydown.left.window="prev()" @keydown.right.window="next()">

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 {{ $gridClasses[$columns] ?? $gridClasses[3] }} gap-4">
                    @foreach($images as $index => $image)
                        <button @click="openLightbox({{ $index }})"
                                class="group relative aspect-square overflow-hidden rounded-lg bg-secondary cursor-pointer">
                            <img src="{{ $image->getFirstMediaUrl('image', 'card') }}"
                                 alt="{{ $image->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                            <!-- Overlay on Hover -->
                            <div class="absolute inset-0 bg-dark/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </button>
                    @endforeach
                </div>

                <!-- Lightbox -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4"
                     @click="closeLightbox()"
                     style="display: none;">

                    <!-- Close Button -->
                    <button @click="closeLightbox()"
                            class="absolute top-4 {{ app()->isLocale('ar') ? 'left' : 'right' }}-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Image Container -->
                    <div class="relative max-w-7xl w-full" @click.stop>
                        <img :src="urls[currentIndex]"
                             :alt="titles[currentIndex]"
                             class="w-full h-auto max-h-[85vh] object-contain rounded-lg">

                        <!-- Navigation -->
                        <button @click="prev()"
                                class="absolute top-1/2 {{ app()->isLocale('ar') ? 'right' : 'left' }}-4 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 {{ app()->isLocale('ar') ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <button @click="next()"
                                class="absolute top-1/2 {{ app()->isLocale('ar') ? 'left' : 'right' }}-4 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 {{ app()->isLocale('ar') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <!-- Counter -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 text-white px-4 py-2 rounded-full text-sm">
                            <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-white/50">{{ __('No images available at the moment.') }}</p>
            </div>
        @endif
    </div>
</section>
