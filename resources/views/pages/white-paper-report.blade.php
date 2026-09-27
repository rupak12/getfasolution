@extends('layouts.app')

@section('title', 'Financial Aid Compliance White Papers | FA Solutions')
@section('body_class', '')
@section('current_page', 'white-paper-report')

@section('main')
<main class="white-papers-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">Resources</span>
                <h1>White Paper Reports</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'white-paper-report'])

        <!-- Reports List -->
        <section class="white-papers-section">
            <div class="page_wrapper">

                <article class="paper-row">
                    <a class="paper-thumb" href="{{ route('higher-education-opportunity-act-white-paper') }}">
                        <div class="paper-thumb-text">
                            <p>An overview of the recent changes to the Higher Education Opportunity Act and their
                                impact on financial aid.</p>
                            <span>White Paper Report</span>
                        </div>
                        <div class="paper-thumb-photo">
                            <img src="{{ media_asset('images/FA+Solutions+FAFSA+(1)-1000h.webp') }}"
                                alt="Financial aid professional reviewing documents">
                        </div>
                    </a>
                    <div class="paper-info">
                        <h2>An Overview of the Recent Changes to the Higher Education Opportunity Act and Their Impact
                            on Financial Aid</h2>
                        <p>The Higher Education Opportunity Act went into place in 2008 and made substantial changes to
                            the way students obtained financial aid.</p>
                        <p>It amended the Higher Education Act of 1965 and reauthorized components of it. It also
                            created changes for schools that had to help prospective students and consumers understand
                            the net price of their education.</p>
                        <a href="{{ route('higher-education-opportunity-act-white-paper') }}" class="btn-green">View Full
                            Report</a>
                    </div>
                </article>

                <article class="paper-row">
                    <a class="paper-thumb" href="{{ route('best-practices-on-consumer-information') }}">
                        <div class="paper-thumb-text">
                            <p>Best practices on consumer information, policies and procedures.</p>
                            <span>White Paper Report</span>
                        </div>
                        <div class="paper-thumb-photo">
                            <img src="{{ media_asset('images/FAFSA+FA+Solutions+(1)-1920w.webp') }}"
                                alt="Team reviewing consumer information and policies">
                        </div>
                    </a>
                    <div class="paper-info">
                        <h2>Best Practices on Consumer Information, Policies and Procedures</h2>
                        <p>Disseminate required information while keeping your website compliant.</p>
                        <p>Know everything about checklist of the policy and procedure manual and website data that
                            needs to be updated for your school.</p>
                        <a href="{{ route('best-practices-on-consumer-information') }}" class="btn-green">View Full Report</a>
                    </div>
                </article>

                <article class="paper-row">
                    <a class="paper-thumb" href="{{ route('creating-an-efficient-financial-aid-office') }}">
                        <div class="paper-thumb-text">
                            <p>Creating an efficient financial aid office by eliminating unnecessary processes.</p>
                            <span>White Paper Report</span>
                        </div>
                        <div class="paper-thumb-photo">
                            <img src="{{ media_asset('images/2.+Financial+Aid+Staffing-1920w.webp') }}"
                                alt="Financial aid staff working through office processes">
                        </div>
                    </a>
                    <div class="paper-info">
                        <h2>Creating an Efficient Financial Aid Office by Eliminating Unnecessary Processes</h2>
                        <p>ED does not specify what documentation or how to resolve conflicting information.</p>
                        <p>This white paper outlines how financial aid offices can streamline workflows, reduce
                            redundant steps, and keep processing accurate without adding unnecessary burden on staff or
                            students.</p>
                        <a href="{{ route('creating-an-efficient-financial-aid-office') }}" class="btn-green">View Full Report</a>
                    </div>
                </article>

                <article class="paper-row">
                    <a class="paper-thumb" href="{{ route('professional-judgments-white-paper') }}">
                        <div class="paper-thumb-text">
                            <p>Professional judgments—a way to compliance and student success.</p>
                            <span>White Paper Report</span>
                        </div>
                        <div class="paper-thumb-photo">
                            <img src="{{ media_asset('images/FA+SOLUTIONS+(2)-1800w.webp') }}"
                                alt="Students collaborating in a campus setting">
                        </div>
                    </a>
                    <div class="paper-info">
                        <h2>Professional Judgments—A Way to Compliance and Student Success</h2>
                        <p>The Higher Education Act provides authority for the Financial Aid Administrator to exercise
                            discretion in several areas.</p>
                        <p>Allows the Financial Aid Administrator to treat a student individually when the student has
                            special circumstances that are not specifically addressed by the traditional application
                            process.</p>
                        <a href="{{ route('professional-judgments-white-paper') }}" class="btn-green">View Full Report</a>
                    </div>
                </article>

            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

