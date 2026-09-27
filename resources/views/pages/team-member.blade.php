@extends('layouts.app')

@section('title', $member['name'] . ' | Leadership Team | FA Solutions')
@section('body_class', '')
@section('current_page', 'team-member')

@section('main')
    <main class="member-page">
        <section class="inner-banner">
            <div class="inner-banner-text"><span>Meet Our</span>
                <h1>Team Member</h1>
            </div>
        </section>

        <section class="member-profile-heading">
            <div class="page_wrapper">
                <div class="member-profile-grid">
                    <div class="member-profile-copy member-profile-copy-center">
                        <h2>{{ $member['name'] }}</h2>
                        <p class="member-role">{{ $member['title'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="member-profile-section">
            <div class="page_wrapper">
                <div class="member-profile-grid">
                    <div class="member-profile-copy">
                        <div class="member-bio">
                            {!! $member['bio'] !!}
                        </div>
                    </div>

                    <div class="member-photo-col">
                        <div class="member-photo-ring">
                            <img src="{{ media_asset($member['image']) }}" alt="{{ $member['name'] }}">
                        </div>
                        @if (! empty($member['linkedin']))
                            <a class="btn-linkedin" href="{{ $member['linkedin'] }}" target="_blank"
                                rel="noopener noreferrer">View my profile on LinkedIn</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="member-lower-section">
            <div class="page_wrapper">
                <div class="about-commitment-grid">
                    <div class="about-commitment-left">
                        <h3>Our Commitment:</h3>
                        <div class="commitment-list">
                            <div class="commitment-item">
                                <div class="commitment-icon">
                                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <circle cx="22" cy="24" r="8" stroke="#fff" stroke-width="2.5" fill="none" />
                                        <circle cx="42" cy="24" r="8" stroke="#fff" stroke-width="2.5" fill="none" />
                                        <path d="M12 46c0-8 6-12 10-12s10 4 10 12" stroke="#fff" stroke-width="2.5"
                                            stroke-linecap="round" />
                                        <path d="M32 46c0-8 6-12 10-12s10 4 10 12" stroke="#fff" stroke-width="2.5"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="commitment-text">
                                    <h4>Real People, Real Expertise</h4>
                                    <p>We work as an extension of your financial aid office, offering long-term,
                                        sustainable solutions.</p>
                                </div>
                            </div>
                            <div class="commitment-item">
                                <div class="commitment-icon">
                                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path d="M32 10c-8 0-14 6-14 14 0 10 14 22 14 22s14-12 14-22c0-8-6-14-14-14z"
                                            stroke="#fff" stroke-width="2.5" fill="none" />
                                        <path d="M24 52h16" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M28 52v4h8v-4" stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M32 18v8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M28 22h8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="commitment-text">
                                    <h4>Customized Support</h4>
                                    <p>No one-size-fits-all approach; we tailor our services based on each institution's
                                        needs.</p>
                                </div>
                            </div>
                            <div class="commitment-item">
                                <div class="commitment-icon">
                                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path d="M32 8l6 12h14l-11 9 4 14-13-8-13 8 4-14-11-9h14z" stroke="#fff"
                                            stroke-width="2.5" stroke-linejoin="round" fill="none" />
                                        <circle cx="32" cy="44" r="10" stroke="#fff" stroke-width="2.5" fill="none" />
                                        <path d="M32 38v8M28 42h8" stroke="#fff" stroke-width="2.5"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="commitment-text">
                                    <h4>Operational Efficiency &amp; Compliance</h4>
                                    <p>We help schools navigate financial aid challenges while mitigating risk and
                                        maintaining regulatory compliance.</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('get-started') }}" class="btn-green">Schedule a Consultation to Learn More</a>
                    </div>

                    <div class="contact-form-card about-contact-form" id="get-in-touch">
                        <h3>Get in Touch</h3>

                        @if (session('contact_success'))
                            <p class="form-success">{{ session('contact_success') }}</p>
                        @endif

                        <form action="{{ route('forms.contact') }}" method="POST">
                            @csrf
                            @include('pages.partials.form-submit-error')
                            <div class="form-row">
                                <input type="text" name="first_name" class="input-field" placeholder="First Name"
                                    value="{{ old('first_name') }}" required maxlength="100">
                                <input type="text" name="last_name" class="input-field" placeholder="Last Name"
                                    value="{{ old('last_name') }}" required maxlength="100">
                            </div>
                            <div class="form-row">
                                <input type="email" name="email" class="input-field" placeholder="Email Address"
                                    value="{{ old('email') }}" required maxlength="255">
                                <input type="tel" name="phone" class="input-field" placeholder="Phone Number"
                                    value="{{ old('phone') }}" maxlength="30">
                            </div>
                            <div class="form-row">
                                <input type="text" name="job_title" class="input-field" placeholder="Job Title"
                                    value="{{ old('job_title') }}" maxlength="150">
                                <input type="text" name="institution" class="input-field" placeholder="School/Institution"
                                    value="{{ old('institution') }}" maxlength="200">
                            </div>
                            <div class="full-width">
                                <textarea name="message" class="input-field textarea-field" placeholder="Message"
                                    rows="4" maxlength="5000">{{ old('message') }}</textarea>
                            </div>
                            <p class="recaptcha-notice">This site is protected by reCAPTCHA. Google's <a
                                    href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Privacy
                                    Policy</a> and <a href="https://policies.google.com/terms" target="_blank"
                                    rel="noopener noreferrer">Terms of Service</a> apply.</p>
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
