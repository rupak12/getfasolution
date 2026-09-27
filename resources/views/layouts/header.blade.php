<header class="site-header">
    <div class="header_wrapper">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ $settings->headerLogoUrl() }}" alt="{{ $settings->site_name }}" class="img-fluid">
                </a>
            </div>

            <nav class="main-nav">
                <ul class="menu">
                    @include('layouts.partials.header-menu')

                    <li class="nav-btn mobile-active mobile-contact mobile-contact-color">
                        <a href="{{ route('contact-us') }}">Contact Us</a>
                    </li>
                    <li class="nav-btn nav-btn2 mobile-active mobile-contact">
                        <a href="https://mysolfia.com/CampusPortal/login-form">Solfia Login</a>
                    </li>

                    <li class="mobile-active">
                        <ul>
                            @if ($settings->facebook_url)
                                <li>
                                    <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ media_asset('images/facebook-head.svg') }}" alt="Facebook">
                                    </a>
                                </li>
                            @endif
                            @if ($settings->instagram_url)
                                <li>
                                    <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ media_asset('images/instagram-head.svg') }}" alt="Instagram">
                                    </a>
                                </li>
                            @endif
                            @if ($settings->youtube_url)
                                <li>
                                    <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ media_asset('images/youtube-head.svg') }}" alt="YouTube">
                                    </a>
                                </li>
                            @endif
                            @if ($settings->linkedin_url)
                                <li>
                                    <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ media_asset('images/linkedin-head.svg') }}" alt="LinkedIn">
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="header-controls">
                <div class="nav-btn mobile-inactive">
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </div>
                <div class="nav-btn nav-btn2 mobile-inactive">
                    <a href="https://mysolfia.com/CampusPortal/login-form">Solfia Login</a>
                </div>

                <div class="nav-social">
                    <ul>
                        @if ($settings->facebook_url)
                            <li>
                                <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ media_asset('images/facebook-head.svg') }}" alt="Facebook">
                                </a>
                            </li>
                        @endif
                        @if ($settings->instagram_url)
                            <li>
                                <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ media_asset('images/instagram-head.svg') }}" alt="Instagram">
                                </a>
                            </li>
                        @endif
                        @if ($settings->youtube_url)
                            <li>
                                <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ media_asset('images/youtube-head.svg') }}" alt="YouTube">
                                </a>
                            </li>
                        @endif
                        @if ($settings->linkedin_url)
                            <li>
                                <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ media_asset('images/linkedin-head.svg') }}" alt="LinkedIn">
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <button type="button" class="menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>
