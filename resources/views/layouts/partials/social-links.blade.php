@php
    $iconPrefix = $iconPrefix ?? 'footer';
    $iconMap = [
        'head' => [
            'facebook' => 'facebook-head.svg',
            'instagram' => 'instagram-head.svg',
            'youtube' => 'youtube-head.svg',
            'linkedin' => 'linkedin-head.svg',
        ],
        'footer' => [
            'facebook' => 'footer-fb.svg',
            'instagram' => 'footer-insta.svg',
            'youtube' => 'footer-youtube.svg',
            'linkedin' => 'footer-linkedin.svg',
        ],
    ];
    $icons = $iconMap[$iconPrefix] ?? $iconMap['footer'];
@endphp

@if ($settings->facebook_url)
    <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ media_asset('images/'.$icons['facebook']) }}" alt="Facebook">
    </a>
@endif
@if ($settings->instagram_url)
    <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ media_asset('images/'.$icons['instagram']) }}" alt="Instagram">
    </a>
@endif
@if ($settings->youtube_url)
    <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ media_asset('images/'.$icons['youtube']) }}" alt="YouTube">
    </a>
@endif
@if ($settings->linkedin_url)
    <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ media_asset('images/'.$icons['linkedin']) }}" alt="LinkedIn">
    </a>
@endif
