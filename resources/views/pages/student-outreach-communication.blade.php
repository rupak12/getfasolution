@extends('layouts.app')

@section('title', 'Student Outreach & Communication | FA Solutions')
@section('body_class', '')
@section('current_page', 'student-outreach-communication')

@section('main')
<main class="service-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Our Services</span>
                <h1>Student Outreach &amp; Communication</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'student-outreach-communication'])

        <!-- Intro -->
        <section class="service-intro-section">
            <div class="page_wrapper">
                <div class="service-intro-grid">
                    <div class="service-intro-image">
                        <img src="{{ media_asset('images/outreach-intro.jpg') }}"
                            alt="Students using smartphones for outreach and communication">
                    </div>
                    <div class="service-intro-copy">
                        <p>Effective communication is key to student engagement and financial aid success, yet many
                            institutions struggle with reaching students in a timely and efficient manner. FA Solutions
                            provides a full-service contact center designed to streamline student outreach through
                            phone, email, and text messaging. Our team ensures that students receive the information
                            they need—when and how they prefer—reducing missed deadlines and incomplete applications.
                        </p>
                        <p>With AI-powered two-way texting and custom outreach programs, we help institutions
                            proactively connect with students. Whether it's responding to inquiries, sending deadline
                            reminders, or assisting with financial aid documentation, our solutions improve engagement
                            and drive better enrollment outcomes.</p>
                        <a href="{{ route('get-started') }}" class="btn-green">Improve Student Communication</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How We Improve Student Engagement -->
        <section class="service-simplify-section">
            <div class="why-section_wrapper">
                <div class="service-simplify-card">
                    <h2>How We Improve Student Engagement</h2>
                    <div class="service-simplify-grid">
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path d="M16 10h8c1.1 0 2 .9 2 2v24c0 1.1-.9 2-2 2h-8c-1.1 0-2-.9-2-2V12c0-1.1.9-2 2-2z"
                                            stroke="#00a651" stroke-width="2.5" />
                                        <path d="M18 14h4M20 34h.01" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" />
                                        <path d="M32 18c4 2.5 6.5 6.5 6.5 11S36 37.5 32 40" stroke="#00a651"
                                            stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M29 22c2.2 1.5 3.5 3.6 3.5 6s-1.3 4.5-3.5 6" stroke="#00a651"
                                            stroke-width="2.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Multi-Channel Support</h3>
                            <p>We provide inbound and outbound assistance via phone, email, and mass text messaging,
                                ensuring students stay informed.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <rect x="14" y="6" width="20" height="36" rx="4" stroke="#00a651"
                                            stroke-width="2.5" />
                                        <path d="M20 10h8" stroke="#00a651" stroke-width="2.5" stroke-linecap="round" />
                                        <rect x="19" y="16" width="16" height="12" rx="2" fill="#00a651" />
                                        <path d="M24 38h.01" stroke="#00a651" stroke-width="3" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>AI-Powered Real-Time Texting</h3>
                            <p>Students prefer texting over calls. Our AI-driven system enables instant, two-way
                                communication.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path d="M24 8c1.2 6 4 10 8 13-4 1-7 4-8 9-1-5-4-8-8-9 4-3 6.8-7 8-13z"
                                            fill="#00a651" />
                                        <circle cx="24" cy="36" r="6" stroke="#00a651" stroke-width="2.5" />
                                        <path d="M24 32v2.2M24 38.5V40M20.6 36H22.8M25.2 36H27.4" stroke="#00a651"
                                            stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Custom Outreach Strategies</h3>
                            <p>Schools can personalize messaging to notify students about missing documents, upcoming
                                deadlines, and financial aid updates.</p>
                        </div>
                    </div>
                    <a href="{{ route('get-started') }}" class="btn-green">Improve Student Communication</a>
                </div>
            </div>
        </section>

        <!-- Case Studies -->
        <section class="service-cases-section">
            <div class="page_wrapper">
                <div class="cases-header">
                    <span class="cases-label">Case Studies</span>
                    <h2>Transforming Student Communication</h2>
                </div>
                <div class="cases-grid">
                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/nmsu.png') }}" alt="New Mexico State University">
                        </div>
                        <h3>New Mexico State University</h3>
                        <p>New Mexico State University required outbound communication support to assist students
                            through the admissions process during peak periods.</p>
                        <a href="{{ route('new-mexico-state-university') }}" class="read-more">Read More →</a>
                    </article>

                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/howard-university.png') }}" alt="Howard University">
                        </div>
                        <h3>Howard University Success Story | FA Solutions</h3>
                        <p>Howard University initially worked with another call center company, which lacked experienced
                            financial aid professionals. This resulted in approximately 500 daily escalations back to
                            the school and a transactional billing method that led to inefficiencies.</p>
                        <a href="{{ route('howard-university') }}" class="read-more">Read More →</a>
                    </article>

                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/horry-georgetown.png') }}" alt="Horry Georgetown Technical College">
                        </div>
                        <h3>Horry Georgetown Technical College</h3>
                        <p>Horry Georgetown Technical College, estimated to have started working with FA Solutions in
                            2017, faced challenges with their third-party call center for financial aid inquiries.</p>
                        <a href="{{ route('horry-georgetown-technical-college') }}" class="read-more">Read More →</a>
                    </article>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

