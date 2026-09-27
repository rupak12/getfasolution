@extends('layouts.app')

@section('title', 'Get Started with FA Solutions | Financial Aid Support')
@section('body_class', '')
@section('current_page', 'get-started')

@section('main')
@php
    $started = normalize_get_started_started(page_content('get-started', 'started') ?? []);
    $startedFollow = page_content('get-started', 'started_follow') ?? [];
    $killers = page_content('get-started', 'killers') ?? [];

    $killerTitles = ['The Bottleneck', 'The Risk', 'The Burnout'];
    $killerCopy = [
        $killers['paragraph_1'] ?? null,
        $killers['paragraph_2'] ?? null,
        $killers['paragraph_3'] ?? null,
    ];
@endphp
<main class="started-page">

        @include('pages.partials.inner-banner', ['pageSlug' => 'get-started'])

        <section class="started-section">
            <div class="page_wrapper">
                <div class="started-grid">
                    <div class="started-copy">
                        @if (! empty($started['title']))
                            <h2>{{ $started['title'] }}</h2>
                        @endif
                        @if (! empty($started['paragraph_1']))
                            <p>{{ html_to_plain($started['paragraph_1']) }}</p>
                        @endif

                        <div class="started-lower">
                            <div class="started-newsletter">
                                @if (! empty($started['newsletter_label']))
                                    <span class="started-news-label">{{ $started['newsletter_label'] }}</span>
                                @endif
                                <form action="{{ route('forms.newsletter') }}" method="POST">
                            @csrf
                                    @include('pages.partials.form-submit-error')
                                    <div class="underline-field">
                                        <input type="text" name="first_name" placeholder="First Name" maxlength="100" required>
                                    </div>
                                    <div class="underline-field">
                                        <input type="text" name="last_name" placeholder="Last Name" maxlength="100" required>
                                    </div>
                                    <div class="underline-field">
                                        <input type="email" name="email" placeholder="Email" maxlength="255" required>
                                    </div>
                                    <button type="submit" class="btn-green">Subscribe</button>
                                </form>
                            </div>

                            <div class="started-actions">
                                @if (! empty($started['button_1_text']))
                                    <div class="started-action">
                                        <a href="{{ page_button_url($started, 'button_1', route('webinar')) }}" class="btn-green">{{ $started['button_1_text'] }}</a>
                                        <div class="started-action-icon" aria-hidden="true">
                                            <img src="{{ media_asset('images/started/action-0.svg') }}" alt="">
                                        </div>
                                    </div>
                                @endif
                                @if (! empty($started['button_2_text']))
                                    <div class="started-action">
                                        <a href="{{ page_button_url($started, 'button_2', route('who-we-are')) }}" class="btn-green">{{ $started['button_2_text'] }}</a>
                                        <div class="started-action-icon" aria-hidden="true">
                                            <img src="{{ media_asset('images/started/action-1.svg') }}" alt="">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="contact-form-card started-form-card" id="get-in-touch">
                        @if (! empty($started['contact_form_title']))
                            <h3>{{ $started['contact_form_title'] }}</h3>
                        @endif
                        <form action="{{ route('forms.contact') }}" method="POST">
                            @csrf
                            @include('pages.partials.form-submit-error')
                            <div class="form-row">
                                <input type="text" name="first_name" class="input-field" placeholder="First Name" maxlength="100" required>
                                <input type="text" name="last_name" class="input-field" placeholder="Last Name" maxlength="100" required>
                            </div>
                            <div class="form-row">
                                <input type="email" name="email" class="input-field" placeholder="Email Address" maxlength="255" required>
                                <input type="tel" name="phone" class="input-field" placeholder="Phone Number" maxlength="30">
                            </div>
                            <div class="form-row">
                                <input type="text" name="job_title" class="input-field" placeholder="Job Title" maxlength="150">
                                <input type="text" name="institution" class="input-field" placeholder="School/Institution" maxlength="200">
                            </div>
                            <div class="full-width">
                                <textarea name="message" class="input-field textarea-field" placeholder="Message" rows="4" maxlength="5000"></textarea>
                            </div>
                            @if (! empty($started['recaptcha_notice']))
                                <p class="recaptcha-notice">{{ html_to_plain($started['recaptcha_notice']) }}</p>
                            @else
                                <p class="recaptcha-notice">This site is protected by reCAPTCHA. Google's <a
                                        href="https://policies.google.com/privacy" target="_blank"
                                        rel="noopener">Privacy Policy</a> and <a href="https://policies.google.com/terms"
                                        target="_blank" rel="noopener">Terms of Service</a> apply.</p>
                            @endif
                            <div class="form-submit-wrap">
                                <button type="submit" class="submit-btn submit-btn-pill">Submit Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="started-follow">
            <div class="page_wrapper">
                @if (! empty($startedFollow['title']))
                    <h3>{{ $startedFollow['title'] }}</h3>
                @endif
                <div class="started-follow-social">
                    <a class="social-ig" href="https://www.instagram.com/get_fasolutions" target="_blank" rel="noopener"
                        aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke="#fff" stroke-width="2" />
                            <circle cx="12" cy="12" r="4" stroke="#fff" stroke-width="2" />
                            <circle cx="17.2" cy="6.8" r="1" fill="#fff" />
                        </svg>
                    </a>
                    <a class="social-yt" href="https://www.youtube.com/channel/UC-qnY7C0CVdCbLFUcmGsH4Q" target="_blank"
                        rel="noopener" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.6 7.2a2.7 2.7 0 0 0-1.9-1.9C18 5 12 5 12 5s-6 0-7.7.3A2.7 2.7 0 0 0 2.4 7.2 28 28 0 0 0 2 12a28 28 0 0 0 .4 4.8 2.7 2.7 0 0 0 1.9 1.9C6 19 12 19 12 19s6 0 7.7-.3a2.7 2.7 0 0 0 1.9-1.9A28 28 0 0 0 22 12a28 28 0 0 0-.4-4.8zM10 15.5v-7l6 3.5-6 3.5z" />
                        </svg>
                    </a>
                    <a class="social-li" href="https://www.linkedin.com/company/getfasolutions/" target="_blank"
                        rel="noopener" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.5 9.5H4V20h2.5V9.5zM5.2 4C4.4 4 3.7 4.7 3.7 5.6S4.4 7.2 5.2 7.2 6.8 6.5 6.8 5.6 6.1 4 5.2 4zM20 20h-2.5v-5.1c0-1.2 0-2.8-1.7-2.8s-2 1.3-2 2.7V20H11.3V9.5h2.4v1.4h.1c.3-.6 1.2-1.7 2.8-1.7 3 0 3.5 2 3.5 4.5V20z" />
                        </svg>
                    </a>
                    <a class="social-fb" href="https://www.facebook.com/GetFASolutions" target="_blank" rel="noopener"
                        aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.5 8.5V6.8c0-.7.5-1.1 1.2-1.1h1.3V3h-2.2C12.2 3 11 4.4 11 6.6v1.9H9v2.7h2V21h3.5v-9.8h2.3l.4-2.7h-2.7z" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="killers-section">
            <div class="page_wrapper">
                @if (! empty($killers['title']))
                    <h2>{{ $killers['title'] }}</h2>
                @endif
                <div class="killers-grid">
                    @foreach ($killerTitles as $index => $killerTitle)
                        @if (! empty($killerCopy[$index]))
                            <div class="killer-item">
                                <div class="killer-icon">
                                    <img src="{{ media_asset('images/killers/icon-'.$index.'.svg') }}" alt="">
                                </div>
                                <h3>{{ $killerTitle }}</h3>
                                <p>{{ html_to_plain($killerCopy[$index]) }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="why-divider"></div>
                @if (! empty($killers['button_text']))
                    <a href="{{ page_route_url($killers['button_route'] ?? null, '#get-in-touch') }}" class="btn-green">{{ $killers['button_text'] }}</a>
                @endif
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'plain'])
@endsection
