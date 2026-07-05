<div class="flex items-center">
    @if(app()->isLocale('en'))
        <a href="{{ url('/locale/ar') }}"
           class="text-white hover:text-primary transition-colors font-medium"
           aria-label="{{ __('Switch language to Arabic') }}">
            العربية
        </a>
    @else
        <a href="{{ url('/locale/en') }}"
           class="text-white hover:text-primary transition-colors font-medium"
           aria-label="{{ __('Switch language to English') }}">
            ENG
        </a>
    @endif
</div>
