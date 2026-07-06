{{-- Service Content Block --}}
<section class="py-12 bg-dark-lighter">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            @if(!empty($data['content']))
                <div class="prose prose-invert prose-lg max-w-none">
                    <div class="text-white/80 leading-relaxed">
                        {!! $data['content'] !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
