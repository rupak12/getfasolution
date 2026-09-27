@extends('layouts.app')

@section('title', 'Higher Education Partnerships | FA Solutions')
@section('body_class', '')
@section('current_page', 'our-partnership')

@section('main')
@php
    $logos = page_content('our-partnership', 'partner_logos') ?? [];
    $impact = page_content('our-partnership', 'partner_impact') ?? [];
    $commitment = page_content('our-partnership', 'partner_commitment') ?? [];
@endphp
<main class="partnership-page">

        @include('pages.partials.inner-banner', ['pageSlug' => 'our-partnership'])

        <section class="partner-logos-section">
            <div class="page_wrapper">
                <div class="partner-logos">
                    @foreach ($logos['logos'] ?? [] as $logo)
                        @if (! empty($logo['image']))
                            <div class="partner-logo">
                                <img src="{{ page_image($logo['image']) }}" alt="{{ $logo['alt'] ?? '' }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section class="partner-impact-section">
            <div class="page_wrapper">
                <div class="partner-impact-grid">
                    <div class="partner-impact-copy">
                        @if (! empty($impact['title']))
                            <h2>{{ $impact['title'] }}</h2>
                        @endif
                        @if (! empty($impact['paragraph_1']))
                            <p>{{ $impact['paragraph_1'] }}</p>
                        @endif
                        @if (! empty($impact['paragraph_2']))
                            <p>{{ $impact['paragraph_2'] }}</p>
                        @endif
                    </div>
                    @if (! empty($impact['card_image']))
                        <a class="become-partner-card" href="{{ page_route_url($impact['card_link_route'] ?? 'get-started') }}">
                            <img src="{{ page_image($impact['card_image']) }}" class="img-fluid" alt="Become a partner">
                        </a>
                    @endif
                </div>
            </div>
        </section>

        <section class="partner-commitment-section">
            <div class="page_wrapper">
                <div class="about-commitment-grid">
                    <div class="about-commitment-left">
                        @if (! empty($commitment['title']))
                            <h3>{{ $commitment['title'] }}</h3>
                        @endif
                        <div class="commitment-list">
                            @foreach ($commitment['items'] ?? [] as $index => $item)
                                <div class="commitment-item">
                                    <div class="commitment-icon">
                                        @include('pages.partials.commitment-icon', ['index' => $index])
                                    </div>
                                    <div class="commitment-text">
                                        @if (! empty($item['title']))
                                            <h4>{{ $item['title'] }}</h4>
                                        @endif
                                        @if (! empty($item['description']))
                                            <p>{{ $item['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if (! empty($commitment['button_text']))
                            <a href="{{ page_route_url($commitment['button_route'] ?? null) }}" class="btn-green">{{ $commitment['button_text'] }}</a>
                        @endif
                    </div>

                    <div class="contact-form-card about-contact-form" id="get-in-touch">
                        <h3>Get in Touch</h3>
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
                            <p class="recaptcha-notice">This site is protected by reCAPTCHA. Google's <a
                                    href="https://policies.google.com/privacy" target="_blank"
                                    rel="noopener">Privacy Policy</a> and <a href="https://policies.google.com/terms"
                                    target="_blank" rel="noopener">Terms of Service</a> apply.</p>
                            <div class="form-submit-wrap">
                                <button type="submit" class="submit-btn submit-btn-pill">Submit Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'plain'])
@endsection
