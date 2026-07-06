{{-- Service Hero Block --}}
<section class="relative bg-dark py-20 md:py-32 overflow-hidden">
    @if(!empty($data['background_image']))
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $data['background_image']) }}"
                 alt="{{ $data['title'] ?? '' }}"
                 class="w-full h-full object-cover opacity-20">
        </div>
    @endif

    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            @if(!empty($data['title']))
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    {{ $data['title'] }}
                </h1>
            @endif

            @if(!empty($data['description']))
                <p class="text-xl md:text-2xl text-white/80 leading-relaxed">
                    {{ $data['description'] }}
                </p>
            @endif
        </div>
    </div>
</section>
