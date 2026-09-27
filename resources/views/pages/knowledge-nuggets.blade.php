@extends('layouts.app')

@section('title', 'FAFSA Simplification Resources | FA Solutions')
@section('body_class', '')
@section('current_page', 'knowledge-nuggets')

@section('main')
<main class="nuggets-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">FAFSA Simplification</span>
                <h1>Knowledge Nuggets</h1>
            </div>
        </section> -->
        @include('pages.partials.inner-banner', ['pageSlug' => 'knowledge-nuggets'])

        <!-- Nugget -->
        <section class="nuggets-section">
            <div class="page_wrapper">
                <article class="paper-row">
                    <a class="paper-thumb" href="{{ route('embracing-the-future-fafsa-simplification') }}">
                        <div class="paper-thumb-text">
                            <p>Embracing the Future: Best Practices in Change Management for FAFSA Simplification</p>
                            <span>Knowledge Brief</span>
                            <p class="nugget-thumb-desc">A practical look at how institutions can prepare people,
                                processes, and systems for FAFSA simplification.</p>
                        </div>
                        <div class="paper-thumb-photo">
                            <img src="{{ media_asset('images/FA+SOLUTIONS+(2)-1800w.webp') }}"
                                alt="Students collaborating during FAFSA simplification planning">
                        </div>
                    </a>
                    <div class="paper-info">
                        <h2>Preparing for FAFSA Simplification</h2>
                        <p>FAFSA simplification is not a simple tech change but a comprehensive, broad updating that’s
                            both necessary and complex. Find out how colleges and universities can improve outcomes by
                            getting some help throughout this transition.</p>
                        <a href="{{ route('embracing-the-future-fafsa-simplification') }}" class="btn-green">Learn More</a>
                    </div>
                </article>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

