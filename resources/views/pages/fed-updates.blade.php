@extends('layouts.app')

@section('title', 'Federal Financial Aid Updates | FA Solutions')
@section('body_class', '')
@section('current_page', 'fed-updates')

@section('main')
<main class="blogs-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="container">
                <span class="page-hero-label">Resources</span>
                <h1>Fed-Updates</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'fed-updates'])

        <!-- Newsletter List -->
        <section class="fed-updates-section">
            <div class="container">

                <article class="fed-row">
                    <a class="fed-thumb" href="{{ route('fed-updates-september-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-september-2026') }}">Fed-Updates Financial Aid Newsletter September
                                2026</a></h2>
                        <p class="blog-date">September 8, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – September 2026</p>
                    </div>
                </article>

                <article class="fed-row">
                    <a class="fed-thumb" href="{{ route('fed-updates-august-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-august-2026') }}">Fed-Updates Financial Aid Newsletter August 2026</a>
                        </h2>
                        <p class="blog-date">August 6, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter August 2026</p>
                    </div>
                </article>

                <article class="fed-row">
                    <a class="fed-thumb" href="{{ route('fed-updates-july-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-july-2026') }}">Fed-Updates Financial Aid Newsletter July 2026</a></h2>
                        <p class="blog-date">July 6, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – July 2026</p>
                    </div>
                </article>

                <article class="fed-row">
                    <a class="fed-thumb" href="{{ route('fed-updates-june-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-june-2026') }}">Fed-Updates Financial Aid Newsletter June 2026</a></h2>
                        <p class="blog-date">June 8, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – June 2026</p>
                    </div>
                </article>

                <article class="fed-row">
                    <a class="fed-thumb" href="{{ route('fed-updates-may-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-may-2026') }}">Fed-Updates Financial Aid Newsletter May 2026</a></h2>
                        <p class="blog-date">May 7, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – May 2026</p>
                    </div>
                </article>

                <article class="fed-row is-hidden">
                    <a class="fed-thumb" href="{{ route('fed-updates-april-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-april-2026') }}">Fed-Updates Financial Aid Newsletter April 2026</a>
                        </h2>
                        <p class="blog-date">April 15, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – April 2026</p>
                    </div>
                </article>

                <article class="fed-row is-hidden">
                    <a class="fed-thumb" href="{{ route('fed-updates-march-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-march-2026') }}">Fed-Updates Financial Aid Newsletter – March 2026</a>
                        </h2>
                        <p class="blog-date">March 23, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – March 2026</p>
                    </div>
                </article>

                <article class="fed-row is-hidden">
                    <a class="fed-thumb" href="{{ route('fed-updates-february-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-february-2026') }}">Fed-Updates Financial Aid Newsletter February
                                2026</a></h2>
                        <p class="blog-date">February 9, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – February 2026</p>
                    </div>
                </article>

                <article class="fed-row is-hidden">
                    <a class="fed-thumb" href="{{ route('fed-updates-january-2026') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-january-2026') }}">Fed-Updates Financial Aid Newsletter January 2026</a>
                        </h2>
                        <p class="blog-date">January 12, 2026</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – January 2026</p>
                    </div>
                </article>

                <article class="fed-row is-hidden">
                    <a class="fed-thumb" href="{{ route('fed-updates-december-2025') }}">
                        <img src="{{ media_asset('images/logo.png') }}" alt="FA Solutions">
                        <span>Fed-Updates</span>
                    </a>
                    <div class="fed-info">
                        <h2><a href="{{ route('fed-updates-december-2025') }}">Fed-Updates Financial Aid Newsletter December
                                2025</a></h2>
                        <p class="blog-date">December 4, 2025</p>
                        <p class="blog-snippet">Fed-Updates Financial Aid Newsletter – December 2025</p>
                    </div>
                </article>

                <div class="blogs-more">
                    <button type="button" class="btn-blue" id="fed-show-more">Show More</button>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

