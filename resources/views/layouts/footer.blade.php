@php
    $type = $type ?? 'full';
    $isPlain = $type === 'plain';
@endphp

@if ($isPlain)
    <footer class="footer-plain">
        <div class="page_wrapper">
            <div class="footer-bottom">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ $settings->footerLogoUrl() }}" alt="{{ $settings->site_name }} Logo" />
                    </div>
                    <p>{{ $settings->footer_about }}</p>
                </div>

                <div class="footer-nav">
                    <h3>Browse Our Website</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about-us') }}">About</a></li>
                        <li><a href="{{ route('our-services') }}">Our Services</a></li>
                        <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                        <li><a href="{{ route('get-started') }}">Get Started</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h3>Contact Information</h3>
                    <p class="hq-title">FA SOLUTIONS HEADQUARTERS</p>

                    <div class="contact-details">
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-location.svg') }}" alt="">
                            <span>{{ $settings->contact_address }}</span>
                        </div>
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-call.svg') }}" alt="">
                            <a href="{{ $settings->phoneHref() }}">{{ $settings->contact_phone }}</a>
                        </div>
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-mail.svg') }}" alt="">
                            <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>
                        </div>
                    </div>

                    <div class="social-links">
                        @include('layouts.partials.social-links', ['iconPrefix' => 'footer'])
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <p>{{ $settings->renderedCopyright() }}</p>
            </div>
        </div>
    </footer>
@else
    <footer>
        <div class="page_wrapper">
            <div class="footer-form">
                <div class="footer-text">
                    <h2>{{ $settings->footerCtaTitle() }}</h2>
                    <p>{{ $settings->footerCtaText() }}</p>

                    <div class="contact-info">
                        <a href="{{ $settings->phoneHref() }}" class="contact-item">
                            <img src="{{ media_asset('images/form-call.svg') }}" alt="">
                            <span>{{ $settings->contact_phone }}</span>
                        </a>
                        <a href="{{ $settings->websiteHref() }}" target="_blank" rel="noopener noreferrer" class="contact-item">
                            <img src="{{ media_asset('images/form-web.svg') }}" alt="">
                            <span>{{ $settings->websiteLabel() }}</span>
                        </a>
                    </div>
                </div>

                <div class="newsletter">
                    <h2>{{ $settings->footerNewsletterTitle() }}</h2>
                    <p>{{ $settings->footerNewsletterText() }}</p>

                    @if (session('newsletter_success'))
                        <p class="form-success">{{ session('newsletter_success') }}</p>
                    @endif

                    <form action="{{ route('forms.newsletter') }}" method="POST">
                        @csrf
                        @include('pages.partials.form-submit-error')
                        <div class="form-row">
                            <input type="text" name="first_name" class="input-field" placeholder="First Name" value="{{ old('first_name') }}" required maxlength="100">
                            <input type="text" name="last_name" class="input-field" placeholder="Last Name" value="{{ old('last_name') }}" required maxlength="100">
                        </div>

                        <div class="full-width">
                            <input type="email" name="email" class="input-field" placeholder="Enter email address" value="{{ old('email') }}" required maxlength="255">
                        </div>

                        <button type="submit" class="submit-btn">{{ $settings->footerNewsletterButtonText() }}</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ $settings->footerLogoUrl() }}" alt="{{ $settings->site_name }} Logo" />
                    </div>
                    <p>{{ $settings->footer_about }}</p>
                </div>

                <div class="footer-nav">
                    <h3>Browse Our Website</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about-us') }}">About</a></li>
                        <li><a href="{{ route('our-services') }}">Our Services</a></li>
                        <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                        <li><a href="{{ route('get-started') }}">Get Started</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h3>Contact Information</h3>
                    <p class="hq-title">FA SOLUTIONS HEADQUARTERS</p>

                    <div class="contact-details">
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-location.svg') }}" alt="">
                            <span>{{ $settings->contact_address }}</span>
                        </div>
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-call.svg') }}" alt="">
                            <a href="{{ $settings->phoneHref() }}">{{ $settings->contact_phone }}</a>
                        </div>
                        <div class="detail-item">
                            <img src="{{ media_asset('images/footer-mail.svg') }}" alt="">
                            <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>
                        </div>
                    </div>

                    <div class="social-links">
                        @include('layouts.partials.social-links', ['iconPrefix' => 'footer'])
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <p>{{ $settings->renderedCopyright() }}</p>
            </div>
        </div>
    </footer>
@endif
