{{-- Service Gallery Block --}}
<section class="py-12 bg-dark" x-data="serviceGalleryViewer()">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            @if(!empty($data['heading']))
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 text-center">
                    {{ $data['heading'] }}
                </h2>
            @endif

            @if(!empty($data['description']))
                <p class="text-lg text-white/70 mb-8 text-center max-w-2xl mx-auto">
                    {{ $data['description'] }}
                </p>
            @endif

            @if($service->hasMedia('gallery'))
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($service->getMedia('gallery') as $index => $media)
                        <button @click="openGallery({{ $index }})"
                                class="group relative block aspect-square overflow-hidden rounded-lg bg-secondary cursor-pointer">
                            <img src="{{ $media->getUrl('card') }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-dark/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-center text-white px-4">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    <h3 class="font-semibold text-sm">{{ __('View Image') }}</h3>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Lightbox Modal --}}
                <div x-show="isOpen"
                     x-cloak
                     @keydown.escape.window="close()"
                     @keydown.arrow-left.window="prev()"
                     @keydown.arrow-right.window="next()"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/95"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">

                    {{-- Close Button --}}
                    <button @click="close()"
                            class="absolute top-4 right-4 z-10 text-white hover:text-primary transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- Image Counter --}}
                    <div class="absolute top-4 left-4 z-10 text-white bg-black/50 px-4 py-2 rounded-lg">
                        <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                    </div>

                    {{-- Previous Button --}}
                    <button @click="prev()"
                            class="absolute left-4 top-1/2 -translate-y-1/2 z-10 text-white hover:text-primary transition-colors p-2 bg-black/50 rounded-full">
                        <svg class="w-8 h-8 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    {{-- Image Container --}}
                    <div class="relative max-w-7xl max-h-[90vh] mx-auto px-16" @click.self="close()">
                        <img :src="images[currentIndex]?.url"
                             :alt="images[currentIndex]?.title"
                             class="max-w-full max-h-[90vh] object-contain mx-auto"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100">

                        {{-- Image Title --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-center">
                            <h3 x-text="images[currentIndex]?.title"
                                class="text-xl font-semibold text-white"></h3>
                        </div>
                    </div>

                    {{-- Next Button --}}
                    <button @click="next()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 z-10 text-white hover:text-primary transition-colors p-2 bg-black/50 rounded-full">
                        <svg class="w-8 h-8 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>

    @if($service->hasMedia('gallery'))
        @push('scripts')
        <script>
        function serviceGalleryViewer() {
            return {
                isOpen: false,
                currentIndex: 0,
                images: [
                    @foreach($service->getMedia('gallery') as $media)
                        {
                            url: '{{ $media->getUrl() }}',
                            title: '{{ addslashes($service->title) }}'
                        },
                    @endforeach
                ],

                openGallery(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                close() {
                    this.isOpen = false;
                    document.body.style.overflow = '';
                },

                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                },

                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                }
            }
        }
        </script>
        @endpush
    @endif
</section>
