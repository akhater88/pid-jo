{{-- Service Gallery Block --}}
<section class="py-12 bg-dark">
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
                    @foreach($service->getMedia('gallery') as $media)
                        <div class="aspect-square rounded-lg overflow-hidden group cursor-pointer">
                            <img src="{{ $media->getUrl('card') }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
