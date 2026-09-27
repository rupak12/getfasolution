@extends('layouts.app')

@section('title', 'Financial Aid Consulting & Strategy | FA Solutions')
@section('body_class', '')
@section('current_page', 'financial-aid-consulting')

@section('main')
<main class="service-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Our Services</span>
                <h1>Financial Aid Consulting &amp; Operational Strategy</h1>
            </div>
        </section> -->
        @include('pages.partials.inner-banner', ['pageSlug' => 'financial-aid-consulting'])

        <!-- Intro -->
        <section class="service-intro-section">
            <div class="page_wrapper">
                <div class="service-intro-grid">
                    <div class="service-intro-image">
                        <img src="{{ media_asset('images/Financial+Aid+Processing+FA+Solutions+(1)-1920w.webp') }}"
                            alt="Financial aid documents with a graduation cap">
                    </div>
                    <div class="service-intro-copy">
                        <p>Staying compliant with financial aid regulations is critical, yet many institutions don’t
                            identify risks until it’s too late. At FA Solutions, we provide expert consulting services
                            to help schools navigate complex regulatory requirements, improve operational efficiency,
                            and mitigate compliance risks before they become costly issues. Our tailored approach
                            ensures your institution remains aligned with industry best practices while maintaining
                            financial stability.</p>
                        <p>From Title IV approval to accreditation consulting and heightened cash monitoring (HCM1 &amp;
                            HCM2) support, we specialize in guiding institutions through challenging compliance
                            landscapes. Whether you're looking to streamline operations or regain financial health, our
                            team of higher education experts is here to help.</p>
                        <a href="{{ route('get-started') }}" class="btn-green">Get Expert Compliance Support</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Expertise -->
        <section class="service-simplify-section">
            <div class="why-section_wrapper">
                <div class="service-simplify-card">
                    <h2>Our Compliance &amp; Consulting Expertise</h2>
                    <div class="service-simplify-grid">
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <rect x="8" y="28" width="8" height="12" rx="1.5" fill="#00a651" />
                                        <rect x="20" y="18" width="8" height="22" rx="1.5" fill="#00a651" />
                                        <rect x="32" y="10" width="8" height="30" rx="1.5" fill="#00a651" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Operational Efficiency Assessments</h3>
                            <p>We evaluate and optimize your financial aid processes to align with best practices and
                                regulatory requirements.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path d="M16 8h16l8 8v24a3 3 0 0 1-3 3H16a3 3 0 0 1-3-3V11a3 3 0 0 1 3-3z"
                                            stroke="#00a651" stroke-width="2.5" />
                                        <path d="M32 8v8h8" stroke="#00a651" stroke-width="2.5"
                                            stroke-linejoin="round" />
                                        <path d="M24 22l2.5 5.2 5.7.6-4.3 3.8 1.2 5.6L24 34.4l-5.1 2.8 1.2-5.6-4.3-3.8 5.7-.6L24 22z"
                                            fill="#00a651" />
                                    </svg>
                                </div>
                            </div>
                            <h3>Title IV &amp; Accreditation Support</h3>
                            <p>Our experts guide institutions through Title IV approval and accreditation, ensuring a
                                smooth and compliant process.</p>
                        </div>
                        <div class="service-feature">
                            <div class="service-feature-icon">
                                <div class="icon-inner">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <rect x="7" y="10" width="34" height="22" rx="3" stroke="#00a651"
                                            stroke-width="2.5" />
                                        <path d="M16 38h16" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" />
                                        <path d="M24 32v6" stroke="#00a651" stroke-width="2.5"
                                            stroke-linecap="round" />
                                        <path d="M24 16v12M20.5 19c.4-1.6 1.8-2.4 3.5-2.4 2 0 3.5 1 3.5 2.6 0 1.5-1.2 2.3-3.5 2.8s-3.5 1.2-3.5 3c0 1.7 1.6 2.8 3.5 2.8 1.8 0 3.2-.8 3.6-2.4"
                                            stroke="#00a651" stroke-width="2.4" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <h3>HCM1 &amp; HCM2 Solutions</h3>
                            <p>Unlike many providers, we specialize in helping schools under heightened cash monitoring
                                regain financial stability.</p>
                        </div>
                    </div>
                    <a href="{{ route('get-started') }}" class="btn-green">Get Expert Compliance Support</a>
                </div>
            </div>
        </section>

        <!-- Case Studies -->
        <section class="service-cases-section">
            <div class="page_wrapper">
                <div class="cases-header">
                    <span class="cases-label">Case Studies</span>
                    <h2>Strengthening Compliance &amp; Operations</h2>
                </div>
                <div class="cases-grid">
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

