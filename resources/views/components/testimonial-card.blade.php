@props(['testimonial'])

<div class="bg-secondary rounded-lg p-8 h-full flex flex-col">
    <!-- Quote Icon -->
    <div class="text-primary mb-4">
        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
    </div>

    <!-- Content -->
    <div class="flex-grow mb-6">
        <p class="text-white/80 text-base leading-relaxed">
            {{ $testimonial->content }}
        </p>
    </div>

    <!-- Author -->
    <div class="flex items-center pt-6 border-t border-white/10">
        @if($testimonial->hasMedia('avatar'))
            <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'thumb') }}"
                 alt="{{ $testimonial->client_name }}"
                 class="w-12 h-12 rounded-full object-cover me-4">
        @else
            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center me-4">
                <span class="text-primary font-bold text-lg">
                    {{ substr($testimonial->client_name, 0, 1) }}
                </span>
            </div>
        @endif

        <div>
            <h4 class="text-white font-semibold">
                {{ $testimonial->client_name }}
            </h4>

            @if($testimonial->client_title)
                <p class="text-white/50 text-sm">
                    {{ $testimonial->client_title }}
                </p>
            @endif
        </div>
    </div>

    <!-- Rating if exists -->
    @if(isset($testimonial->rating) && $testimonial->rating)
        <div class="flex mt-4 space-x-1 rtl:space-x-reverse">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-primary' : 'text-white/20' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>
    @endif
</div>
