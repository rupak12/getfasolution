@php
    $banner = page_content($pageSlug, 'banner') ?? [];
    $bannerClass = $bannerClass ?? '';
@endphp

<section class="inner-banner {{ $bannerClass }}">
    <div class="inner-banner-text">
        <span>{{ $banner['label'] ?? '' }}</span>
        <h1>{{ $banner['title'] ?? '' }}</h1>
        @if (! empty($banner['button_text']))
            <a href="{{ page_route_url($banner['button_route'] ?? null) }}" class="btn-green sign-up-green">{{ $banner['button_text'] }}</a>
        @endif
    </div>
</section>
