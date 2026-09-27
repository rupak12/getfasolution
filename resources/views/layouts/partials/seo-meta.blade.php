@php
    $seo = $seo ?? [];
@endphp

<title>{{ $seo['meta_title'] ?? 'FA Solutions' }}</title>

@if (! empty($seo['meta_description']))
    <meta name="description" content="{{ $seo['meta_description'] }}">
@endif

@if (! empty($seo['meta_keywords']))
    <meta name="keywords" content="{{ $seo['meta_keywords'] }}">
@endif

@if (! empty($seo['meta_robots']))
    <meta name="robots" content="{{ $seo['meta_robots'] }}">
@endif

@if (! empty($seo['canonical_url']))
    <link rel="canonical" href="{{ $seo['canonical_url'] }}">
@endif

<meta property="og:site_name" content="{{ $settings->site_name ?? 'FA Solutions' }}">
<meta property="og:locale" content="en_US">

@if (! empty($seo['og_title']))
    <meta property="og:title" content="{{ $seo['og_title'] }}">
@endif

@if (! empty($seo['og_description']))
    <meta property="og:description" content="{{ $seo['og_description'] }}">
@endif

@if (! empty($seo['og_type']))
    <meta property="og:type" content="{{ $seo['og_type'] }}">
@endif

@if (! empty($seo['canonical_url']))
    <meta property="og:url" content="{{ $seo['canonical_url'] }}">
@endif

@if (! empty($seo['og_image_url']))
    <meta property="og:image" content="{{ $seo['og_image_url'] }}">
@endif

<meta name="twitter:card" content="{{ $seo['twitter_card'] ?? 'summary_large_image' }}">

@if (! empty($seo['twitter_title']))
    <meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
@endif

@if (! empty($seo['twitter_description']))
    <meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
@endif

@if (! empty($seo['twitter_image_url']))
    <meta name="twitter:image" content="{{ $seo['twitter_image_url'] }}">
@elseif (! empty($seo['og_image_url']))
    <meta name="twitter:image" content="{{ $seo['og_image_url'] }}">
@endif
