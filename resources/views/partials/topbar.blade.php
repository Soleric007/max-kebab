@php
    $socialLinks = collect($brand['socials'] ?? [])
        ->filter(fn (array $social) => filled($social['url'] ?? null) && ($social['url'] ?? null) !== '#')
        ->values();
@endphp

<div class="topbar bg-main">
    <div class="container">
        <div class="topbar-inner {{ $socialLinks->isEmpty() ? 'topbar-inner-centered' : '' }}">
            @if ($socialLinks->isNotEmpty())
                <div class="topbar-item topbar-padding">
                    <ul class="social-list social-list-white">
                        @foreach ($socialLinks as $social)
                            <li>
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}">
                                    @if (! empty($social['icon'] ?? null))
                                        <i class="{{ $social['icon'] }}"></i>
                                    @else
                                        <span class="social-label-icon">{{ $social['text_icon'] ?? substr($social['label'], 0, 2) }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="topbar-item">
                <div class="topbar-right d-flex flex-wrap justify-content-center justify-content-md-start full-height">
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-clock"></i>
                        {{ $brand['service_modes'] }}
                    </div>
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-placeholder-1"></i>
                        {{ $brand['short_address'] }}
                    </div>
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-smartphone-call"></i>
                        <a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}" class="color-white">{{ $brand['phone_display'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
