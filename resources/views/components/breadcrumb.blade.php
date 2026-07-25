@props(['items'])

<nav aria-label="{{ __('Breadcrumb') }}" class="mb-6">
    <ol class="flex items-center space-x-2 rtl:space-x-reverse text-sm">
        @foreach($items as $index => $item)
            <li class="flex items-center">
                @if($index > 0)
                    <svg class="w-4 h-4 mx-2 text-white/40 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                @endif

                @if(isset($item['url']) && !$loop->last)
                    @php
                        // Handle both relative URIs and absolute URLs
                        $itemUrl = (str_starts_with($item['url'], 'http://') || str_starts_with($item['url'], 'https://'))
                            ? $item['url']
                            : url($item['url']);
                    @endphp
                    <a href="{{ $itemUrl }}" class="text-white/70 hover:text-primary transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-primary">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
