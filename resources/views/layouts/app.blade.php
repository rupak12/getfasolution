<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.seo-meta', ['seo' => $seo ?? []])
    <link rel="icon" type="image/x-icon" href="{{ $settings->faviconUrl() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body @if(trim($__env->yieldContent('body_class'))) class="@yield('body_class')" @endif>
    @include('layouts.header')

    @yield('main')

    @hasSection('footer')
        @yield('footer')
    @endif

    <script src="{{ asset('js/main.js') }}?v=2"></script>
    @stack('scripts')
</body>

</html>
