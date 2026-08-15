@props(['service'])

@php
    $projects = $service->projects()->published()->get();
@endphp

@if($projects->count() > 0)
<section class="pesaro-projects-section bg-[#222126] border-b-2 border-[#403e3e] py-16">
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-12">
            <div class="inline-block mb-3">
                <div class="pesaro-badge">
                    <ul><li>{{ __('Our Projects') }}</li></ul>
                </div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ __('Portfolio & Case Studies') }}
            </h2>
            <p class="text-white/70 max-w-2xl mx-auto">
                {{ __('Explore our completed projects and see the quality of our work') }}
            </p>
        </div>

        {{-- Projects Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($projects as $project)
                @php
                    $firstImage = $project->getFirstMedia('gallery');
                    $projectUrl = route('projects.show.' . app()->getLocale(), [
                        'serviceSlug' => $service->slug,
                        'projectSlug' => $project->slug
                    ]);
                @endphp

                <a href="{{ $projectUrl }}"
                   class="group relative block rounded-lg overflow-hidden bg-[#2a2830] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    {{-- Project Image --}}
                    <div class="aspect-[4/3] overflow-hidden">
                        @if($firstImage)
                            <img src="{{ $firstImage->hasGeneratedConversion('card') ? $firstImage->getUrl('card') : $firstImage->getUrl() }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#2a2830] to-[#1a1a1e]">
                                <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Project Info Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="text-white font-semibold text-lg mb-1 line-clamp-2">
                                {{ $project->title }}
                            </h3>
                            <p class="text-[#c09a5b] text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ $project->customer_name }}
                            </p>
                        </div>
                    </div>

                    {{-- Image Count Badge --}}
                    @if($project->getMedia('gallery')->count() > 1)
                        <div class="absolute top-3 end-3 bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $project->getMedia('gallery')->count() }}
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
