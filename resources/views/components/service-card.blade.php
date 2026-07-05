@props(['service'])

<a href="{{ route('services.show.' . app()->getLocale(), $service->slug) }}"
   class="group block bg-secondary hover:bg-secondary-lighter rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-primary/10">

    <!-- Image -->
    <div class="aspect-[4/3] overflow-hidden">
        @if($service->hasMedia('hero'))
            <img src="{{ $service->getFirstMediaUrl('hero', 'card') }}"
                 alt="{{ $service->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-dark flex items-center justify-center">
                <svg class="w-16 h-16 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors">
            {{ $service->title }}
        </h3>

        @if($service->short_description)
            <p class="text-white/70 text-sm line-clamp-3 mb-4">
                {{ $service->short_description }}
            </p>
        @endif

        <div class="flex items-center text-primary text-sm font-semibold">
            <span>{{ __('Learn More') }}</span>
            <svg class="w-4 h-4 ms-2 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>
</a>
