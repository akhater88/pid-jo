{{-- Service CTA Block --}}
<section class="py-16 bg-primary">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            @if(!empty($data['heading']))
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ $data['heading'] }}
                </h2>
            @endif

            @if(!empty($data['description']))
                <p class="text-lg text-white/90 mb-8">
                    {{ $data['description'] }}
                </p>
            @endif

            @if(!empty($data['button_text']) && !empty($data['button_link']))
                <a href="{{ $data['button_link'] }}"
                   class="inline-block bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                    {{ $data['button_text'] }}
                </a>
            @endif
        </div>
    </div>
</section>
