@extends('layouts.app')

@section('title', 'Financial Aid Case Studies | FA Solutions')
@section('body_class', '')
@section('current_page', 'case-studies')

@section('main')
<main class="cases-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Case Studies</span>
                <h1>Solving Challenges, Driving Results</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'case-studies'])

        <!-- Case Studies Grid -->
        <section class="cases-page-section">
            <div class="page_wrapper">
                <div class="cases-grid">
                    <article class="case-card">
                        <div class="case-logo">
                            <img src="{{ media_asset('images/nmsu.png') }}" alt="New Mexico State University">
                        </div>
                        <h3>New Mexico State University</h3>
                        <p>New Mexico State University required outbound communication support to assist students through
                            the admissions process during peak periods.</p>
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

