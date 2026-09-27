@extends('layouts.app')

@section('title', 'Financial Aid Regulatory and Compliance Checklist | FA Solutions')
@section('body_class', '')
@section('current_page', 'financial-aid-regulatory-and-compliance-checklist')

@section('main')
<main class="checklist-page">

        <!-- <section class="page-hero">
            <div class="container">
                <span class="page-hero-label">Resources</span>
                <h1>Stay Compliant, Stay Updated!</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'financial-aid-regulatory-and-compliance-checklist'])

        <section class="checklist-section">
            <div class="container">

                <article class="checklist-block">
                    <div class="checklist-preview">
                        <img src="{{ media_asset('images/checklist/december-2024.png') }}"
                            alt="FA Solutions FY 2024-25 Financial Aid Regulatory and Compliance Checklist">
                        <a href="{{ media_asset('files/FAS_Checklist_December_2024.pdf') }}" class="btn-green" target="_blank"
                            rel="noopener" download>Download Your Checklist</a>
                    </div>
                    <div class="checklist-copy">
                        <h2>December 2024</h2>
                        <p>Are you ready to simplify complex regulations and stay ahead of essential deadlines? Download
                            our <strong>Financial Aid Regulatory and Compliance Checklist</strong> today and make
                            compliance easier for your team!</p>
                        <p>Our Financial Aid Regulatory and Compliance Checklist is here to make it easier for you! This
                            comprehensive guide simplifies complex regulations, helping higher education professionals
                            stay on top of essential deadlines and tasks.</p>
                        <h3>What’s Inside?</h3>
                        <ul>
                            <li><strong>Key Deadlines:</strong> Never miss a critical date</li>
                            <li><strong>Must-Do Tasks:</strong> Ensure your institution remains compliant</li>
                            <li><strong>FAFSA Updates:</strong> Stay informed on the latest changes</li>
                            <li><strong>Verification Requirements:</strong> Get clear on what’s needed</li>
                        </ul>
                        <h3>Why You Need This Checklist:</h3>
                        <ul>
                            <li><strong>Avoid</strong> costly penalties by staying compliant</li>
                            <li><strong>Access</strong> regularly updated insights to keep you ahead of federal
                                regulations</li>
                            <li><strong>Save time</strong> with a straightforward, actionable guide tailored for your
                                needs</li>
                        </ul>
                    </div>
                </article>

                <article class="checklist-block">
                    <div class="checklist-preview">
                        <img src="{{ media_asset('images/checklist/september-2024.png') }}"
                            alt="FA Solutions FY 2023-24 Financial Aid Regulatory and Compliance Checklist">
                        <a href="{{ media_asset('files/FAS_Checklist_September_2024.pdf') }}" class="btn-green" target="_blank"
                            rel="noopener" download>Download Your Checklist</a>
                    </div>
                    <div class="checklist-copy">
                        <h2>September 2024</h2>
                        <p>Are you ready to simplify complex regulations and stay ahead of essential deadlines? Download
                            our <strong>Financial Aid Regulatory and Compliance Checklist</strong> today and make
                            compliance easier for your team!</p>
                        <p>Our Financial Aid Regulatory and Compliance Checklist is here to make it easier for you! This
                            comprehensive guide simplifies complex regulations, helping higher education professionals
                            stay on top of essential deadlines and tasks.</p>
                        <h3>What’s Inside?</h3>
                        <ul>
                            <li><strong>Key Deadlines:</strong> Never miss a critical date</li>
                            <li><strong>Must-Do Tasks:</strong> Ensure your institution remains compliant</li>
                            <li><strong>FAFSA Updates:</strong> Stay informed on the latest changes</li>
                            <li><strong>Verification Requirements:</strong> Get clear on what’s needed</li>
                        </ul>
                        <h3>Why You Need This Checklist:</h3>
                        <ul>
                            <li><strong>Avoid</strong> costly penalties by staying compliant</li>
                            <li><strong>Access</strong> regularly updated insights to keep you ahead of federal
                                regulations</li>
                            <li><strong>Save time</strong> with a straightforward, actionable guide tailored for your
                                needs</li>
                        </ul>
                    </div>
                </article>

            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

