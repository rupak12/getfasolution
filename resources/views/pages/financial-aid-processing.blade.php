@extends('layouts.app')

@section('title', 'Financial Aid Processing Services | FA Solutions')
@section('body_class', '')
@section('current_page', 'financial-aid-processing')

@section('main')
<main class="service-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Our Services</span>
                <h1>Financial Aid Processing &amp; Compliance</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'financial-aid-processing'])

        <!-- Intro -->
        <section class="service-intro-section">
            <div class="page_wrapper">
                <div class="service-intro-grid">
                    <div class="service-intro-image">
                        <!-- <img src="{{ media_asset('images/FA+SOLUTIONS+(2)-1800w.webp') }}"
                            alt="Students collaborating around a table in a campus library"> -->
                            <img src="{{ media_asset('images/fap-1.webp') }}" alt="Students collaborating around a table in a campus library">
                    </div>
                    <div class="service-intro-copy">
                        <p>Managing financial aid processing is a critical yet complex task for institutions. Delays,
                            compliance risks, and inefficient systems can negatively impact student enrollment and
                            retention. At FA Solutions, we specialize in providing fast, accurate, and fully compliant
                            financial aid processing tailored to your institution’s needs. Our experienced team ensures
                            your operations run smoothly while meeting all federal and Title IV regulations.</p>
                        <p>With our dedicated support, you won’t have to worry about slow processing times or
                            compliance pitfalls. We work with most major student systems, provide real-time customer
                            support, and proactively manage regulatory requirements. Let us help you streamline
                            financial aid operations, reduce risk, and enhance the student experience.</p>
                        <a href="{{ route('get-started') }}" class="btn-green">Get Reliable Financial Aid Support</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How We Simplify -->
        <section class="service-simplify-section">
            <div class="page_wrapper">
                <div class="service-simplify-card">
                    <h2>How We Simplify Financial Aid Processing</h2>
                    <div class="service-simplify-grid">
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <rect x="8" y="30" width="32" height="8" rx="2" fill="#00a651" />
                                        <rect x="12" y="20" width="24" height="8" rx="2" fill="#00a651" />
                                        <rect x="16" y="10" width="16" height="8" rx="2" fill="#00a651" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Seamless System Integration</h3>
                            <p>We support major systems like Anthology, Colleague, Banner, PowerFAIDS, Regent, and
                                Campus Café, ensuring a smooth, unchanged transition.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <circle cx="24" cy="16" r="7" stroke="#00a651" stroke-width="2.5" />
                                        <path d="M12 38c0-7 5-11 12-11s12 4 12 11" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" />
                                        <path d="M14 16a10 10 0 0 0-3 7v4h4" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M34 16a10 10 0 0 1 3 7v4h-4" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Real-Time Assistance</h3>
                            <p>Our live customer support team is available throughout the day, eliminating frustrating
                                ticketing queues and long wait times.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <rect x="14" y="8" width="20" height="32" rx="3" stroke="#00a651"
                                            stroke-width="2.5" />
                                        <rect x="19" y="6" width="10" height="5" rx="1.5" fill="#00a651" />
                                        <path d="M20 20l3 3 7-7" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20 30l3 3 7-7" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Regulatory Expertise</h3>
                            <p>Compliance is our priority. We help institutions meet Title IV and federal financial aid
                                regulations, reducing audit risks and ensuring smooth operations.</p>
                        </div>
                    </div>
                    <a href="{{ route('get-started') }}" class="btn-green">Get Reliable Financial Aid Support</a>
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
                            <img src="{{ media_asset('images/concordia-university.png') }}" alt="Concordia University, St. Paul">
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

