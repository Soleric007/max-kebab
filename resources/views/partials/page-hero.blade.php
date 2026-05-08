@php
    $breadcrumbs = $breadcrumbs ?? [];
@endphp

<div class="header-bg header-bg-page">
    <div class="header-padding position-relative">
        <div class="header-page-shape">
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-2.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-3.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-4.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="{{ asset('assets/images/header-shape-3.png') }}" alt="shape">
            </div>
        </div>
        <div class="container">
            <div class="header-page-content">
                <h1>{{ $pageTitle }}</h1>
                @if (! empty($pageSubtitle))
                    <p class="page-hero-subtitle">{{ $pageSubtitle }}</p>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (! empty($breadcrumb['url']))
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
