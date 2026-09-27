<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | FA Solutions Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\GlobalSetting::current()->faviconUrl() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>

<body class="admin-body">
    <div class="admin-layout">
        @php($adminSettings = \App\Models\GlobalSetting::current())
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ $adminSettings->headerLogoUrl() }}" alt="{{ $adminSettings->site_name }}">
                </a>
            </div>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M3 10.5L12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9.5z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.menu.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M4 6h16M4 12h16M4 18h10" />
                    </svg>
                    Menu Setting
                </a>
                <a href="{{ route('admin.pages.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" />
                    </svg>
                    Page Editor
                </a>
                <a href="{{ route('admin.footer-banner.edit') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.footer-banner.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M3 15h18M8 21h8" />
                    </svg>
                    Footer Banner
                </a>
                <a href="{{ route('admin.seo.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    SEO Settings
                </a>
                <a href="{{ route('admin.hubspot.edit') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.hubspot.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                    HubSpot Setting
                </a>
                <a href="{{ route('admin.settings.edit') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                    </svg>
                    Global Setting
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                &copy; {{ date('Y') }} FA Solutions
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <h1>@yield('page_title', 'Dashboard')</h1>

                <div class="admin-topbar-actions">
                    @php($authAdmin = Auth::guard('admin')->user())
                    <div class="admin-user-chip">
                        <span class="admin-avatar">{{ strtoupper(substr($authAdmin->name, 0, 1)) }}</span>
                        <span>{{ $authAdmin->name }}</span>
                    </div>

                    <form class="admin-logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="admin-btn admin-btn-secondary">Logout</button>
                    </form>
                </div>
            </header>

            <main class="admin-content">
                @if (session('status'))
                    <div class="admin-alert admin-alert-success">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
