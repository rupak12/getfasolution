@extends('layouts.app')

@section('title', 'Financial Aid Staffing Solutions | FA Solutions')
@section('body_class', '')
@section('current_page', 'financial-aid-staffing')

@section('main')
<main class="service-page service-page--staffing">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Our Services</span>
                <h1>Financial Aid Staffing</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'financial-aid-staffing'])

        <!-- Intro -->
        <section class="service-intro-section">
            <div class="page_wrapper">
                <div class="service-intro-grid">
                    <div class="service-intro-image">
                        <img src="{{ media_asset('images/staffing-intro.jpg') }}"
                            alt="Financial aid professionals reviewing documents together">
                    </div>
                    <div class="service-intro-copy">
                        <p>Staffing shortages can lead to processing delays, compliance risks, and lost revenue for
                            institutions. At FA Solutions, we provide experienced financial aid professionals who
                            seamlessly integrate into your team—whether remote, hybrid, or on-site. Our staffing
                            solutions ensure your institution remains efficient, compliant, and fully supported, helping
                            you avoid disruptions and maintain student satisfaction.</p>
                        <p>Unlike short-term fixes, we offer long-term, dependable staffing solutions with built-in
                            redundancy. Each role is supported by 2-3 professionals, ensuring uninterrupted service. Our
                            clients have seen revenue growth from $30K to $60-70K annually through improved operational
                            efficiency. Let us help you build a stronger, more reliable financial aid team.</p>
                        <a href="{{ route('get-started') }}" class="btn-green">Find Your Staffing Solution</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Institutions Trust Us -->
        <section class="why-section">
            <div class="why-section_wrapper">
                <div class="why-card">
                    <h2>Why Institutions Trust Our Staffing Solutions</h2>
                    <div class="why-grid">
                        <div class="why-item">
                            <div class="why-icon-wrap">
                                <div class="why-icon-shadow"></div>
                                <div class="why-icon-box">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <title>Experienced full-time financial aid professionals</title>
                                        <circle cx="26" cy="22" r="9" fill="none" stroke="#00a651" stroke-width="3" />
                                        <path d="M10 50c0-9 7-14 16-14s16 5 16 14" fill="none" stroke="#00a651"
                                            stroke-width="3" stroke-linecap="round" />
                                        <circle cx="46" cy="42" r="12" fill="#00a651" />
                                        <path d="M41 42l3.5 3.5 7-7" fill="none" stroke="#fff" stroke-width="2.8"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <h4>Experienced, Full-Time Professionals</h4>
                            <p>We provide highly skilled financial aid experts who offer long-term support, not
                                temporary solutions.</p>
                        </div>
                        <div class="why-item">
                            <div class="why-icon-wrap">
                                <div class="why-icon-shadow"></div>
                                <div class="why-icon-box">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <title>Redundant staffing model for uninterrupted coverage</title>
                                        <path fill="#00a651"
                                            d="M28.2 6.5h7.6l1.2 6.5c1.8.6 3.4 1.6 4.8 2.9l6.3-2 3.8 6.6-5.1 4c.2.9.4 1.9.4 2.9s-.1 2-.4 2.9l5.1 4-3.8 6.6-6.3-2c-1.4 1.3-3 2.3-4.8 2.9l-1.2 6.5h-7.6l-1.2-6.5c-1.8-.6-3.4-1.6-4.8-2.9l-6.3 2-3.8-6.6 5.1-4c-.2-.9-.4-1.9-.4-2.9s.1-2 .4-2.9l-5.1-4 3.8-6.6 6.3 2c1.4-1.3 3-2.3 4.8-2.9l1.2-6.5z" />
                                        <circle cx="32" cy="32.2" r="8.5" fill="#fff" />
                                        <circle cx="32" cy="32.2" r="4.5" fill="#00a651" />
                                        <path fill="#00a651"
                                            d="M50.5 10.5l1.3 2.7 3 .3-2.3 2.1.7 2.9-2.7-1.5-2.7 1.5.7-2.9-2.3-2.1 3-.3zM11.5 14.5l1.1 2.3 2.5.3-1.9 1.7.6 2.4-2.3-1.2-2.3 1.2.6-2.4-1.9-1.7 2.5-.3z" />
                                    </svg>
                                </div>
                            </div>
                            <h4>Redundant Staffing Model</h4>
                            <p>Each role is backed by multiple professionals, ensuring coverage during staff transitions
                                or high-demand periods.</p>
                        </div>
                        <div class="why-item">
                            <div class="why-icon-wrap">
                                <div class="why-icon-shadow"></div>
                                <div class="why-icon-box">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <title>Seamless team integration for remote, hybrid, or on-site support</title>
                                        <circle cx="32" cy="20" r="7" fill="none" stroke="#00a651" stroke-width="3" />
                                        <circle cx="16" cy="24" r="6" fill="none" stroke="#00a651" stroke-width="3" />
                                        <circle cx="48" cy="24" r="6" fill="none" stroke="#00a651" stroke-width="3" />
                                        <path d="M20 50c0-8 5.5-13 12-13s12 5 12 13" fill="none" stroke="#00a651"
                                            stroke-width="3" stroke-linecap="round" />
                                        <path d="M6 50c0-7 4.5-11 10-11 2.2 0 4.2.6 5.9 1.7" fill="none"
                                            stroke="#00a651" stroke-width="3" stroke-linecap="round" />
                                        <path d="M42.1 40.7c1.7-1.1 3.7-1.7 5.9-1.7 5.5 0 10 4 10 11" fill="none"
                                            stroke="#00a651" stroke-width="3" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <h4>Seamless Team Integration</h4>
                            <p>Whether your institution operates remotely, in-person, or hybrid, our staff easily adapt
                                to your processes and culture.</p>
                        </div>
                    </div>
                    <div class="why-divider"></div>
                    <div class="why-cta">
                        <a href="{{ route('get-started') }}" class="btn-green">Find Your Staffing Solution</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Case Studies -->
        <section class="service-cases-section">
            <div class="page_wrapper">
                <div class="cases-header">
                    <span class="cases-label">Case Studies</span>
                    <h2>How We Helped Institutions Like Yours</h2>
                </div>
                <div class="cases-grid">
                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/luther-rice.png') }}" alt="Luther Rice College &amp; Seminary">
                        </div>
                        <h3>Luther Rice College &amp; Seminary</h3>
                        <p>Luther Rice College &amp; Seminary faced similar challenges as Faith International
                            University, coming from a third-party servicer with outdated technology and slow processing
                            times.</p>
                        <a href="{{ route('luther-rice-college-seminary') }}" class="read-more">Read More →</a>
                    </article>

                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/concordia-university.png') }}" alt="Concordia University, Saint Paul">
                        </div>
                        <h3>Concordia University, St. Paul, Minnesota</h3>
                        <p>Concordia University faced challenges due to rapid growth. It struggled to keep up with
                            financial aid packaging, document verification, and timely communication with students.</p>
                        <a href="{{ route('concordia-university-st-paul-minnesota') }}" class="read-more">Read More →</a>
                    </article>

                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/faith-international-university.png') }}" alt="Faith International University">
                        </div>
                        <h3>Faith International University</h3>
                        <p>Faith International University previously worked with a third-party servicer for financial
                            aid processing but faced issues with outdated technology, delayed aid packaging, and slow
                            customer service response times, leading to delays in receiving federal financial aid.</p>
                        <a href="{{ route('faith-international-university') }}" class="read-more">Read More →</a>
                    </article>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

