@extends('layouts.app')

@section('title', 'About FA Solutions | Financial Aid Experts')
@section('body_class', '')
@section('current_page', 'who-we-are')

@section('main')
@php
    $aboutPartner = page_content('who-we-are', 'about_partner') ?? [];
    $aboutBelieve = page_content('who-we-are', 'about_believe') ?? [];
    $clients = page_content('who-we-are', 'clients') ?? [];
    $faq = page_content('who-we-are', 'faq') ?? [];
@endphp
<main class="about-page">
        @include('pages.partials.inner-banner', ['pageSlug' => 'who-we-are'])

        <section class="about-partner-section">
            <div class="page_wrapper">
                <div class="about-intro-grid">
                    <div class="about-intro-text">
                        @if (! empty($aboutPartner['title']))
                            <h2>{{ $aboutPartner['title'] }}</h2>
                        @endif
                        @include('pages.partials.paragraphs', ['section' => $aboutPartner])
                    </div>
                    @if (! empty($aboutPartner['image']))
                        <div class="about-partner-image">
                            <img src="{{ page_image($aboutPartner['image']) }}" alt="Students walking on campus">
                        </div>
                    @endif
                </div>

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
                        @if (! empty($aboutPartner['button_text']))
                            <a href="{{ page_route_url($aboutPartner['button_route'] ?? null) }}" class="btn-green">{{ $aboutPartner['button_text'] }}</a>
                        @endif
                    </div>

                    <div class="contact-form-card about-contact-form">
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

        <!-- What We Believe -->
        <section class="about-believe-section">
            <div class="why-section_wrapper">
                <div class="about-believe-card">
                    <div class="about-believe-grid">
                        @if (! empty($aboutBelieve['image']))
                            <div class="about-believe-image">
                                <img class="img-fluid" src="{{ page_image($aboutBelieve['image']) }}" alt="Financial aid professionals collaborating">
                            </div>
                        @endif
                        <div class="about-believe-content">
                            @if (! empty($aboutBelieve['title']))
                                <h2>{{ $aboutBelieve['title'] }}</h2>
                            @endif
                            @include('pages.partials.paragraphs', ['section' => $aboutBelieve])
                            @if (! empty($aboutBelieve['button_text']))
                                <a href="{{ page_route_url($aboutBelieve['button_route'] ?? null) }}" class="btn-green">{{ $aboutBelieve['button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partial List Of Our Clients -->
        <section class="clients-section" id="current-clients">
            <div class="page_wrapper">
                @if (! empty($clients['title']))
                    <h2>{{ $clients['title'] }}</h2>
                @endif
                @include('pages.partials.paragraphs', ['section' => $clients])
                <div class="clients-logos">
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-1.webp') }}" alt="Valencia College">
                    </div>
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-2.webp') }}" alt="Concordia">
                    </div>
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-3.webp') }}" alt="JSU">
                    </div>
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-4.webp') }}" alt="Presidio">
                    </div>
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-5.webp') }}" alt="Southwestern Christian College">
                    </div>
                    <div class="client-logo">
                        <img src="{{ media_asset('images/client-6.webp') }}" alt="Luther Rice">
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section about-faq-section" id="faqs">
            <div class="page_wrapper">
                @if (! empty($faq['title']))
                    <h2 class="about-faq-title">{{ $faq['title'] }}</h2>
                @endif
                <div class="faq-grid">
                    @if (! empty($faq['image']))
                        <div class="faq-image">
                            <img src="{{ page_image($faq['image']) }}" alt="Financial aid processing and compliance">
                        </div>
                    @endif
                    <div class="faq-content">
                        <div class="faq-accordion">
                            @foreach ($faq['items'] ?? [] as $index => $item)
                                <div class="faq-item {{ $index === 0 ? 'is-open' : '' }}">
                                    <button class="faq-question" type="button">
                                        <span>{{ $item['question'] ?? '' }}</span>
                                        <span class="faq-toggle">{{ $index === 0 ? '−' : '+' }}</span>
                                    </button>
                                    <div class="faq-answer">
                                        @include('pages.partials.plain-text', ['text' => $item['answer'] ?? null])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('faq') }}" class="btn-green">View More FAQs</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

