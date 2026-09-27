@extends('layouts.app')

@section('title', 'Financial Aid Leadership Team | FA Solutions')
@section('body_class', '')
@section('current_page', 'team')

@section('main')
<main class="team-page">
        <!-- <section class="page-hero"> <div class="page_wrapper"><span class="page-hero-label">Meet Our</span> <h1>Leadership Team</h1></div></section> -->
        @include('pages.partials.inner-banner', ['pageSlug' => 'team'])

        <section class="team-section">
            <div class="page_wrapper">
                <div class="team-grid">
                    <a class="team-card" href="{{ route('team.member', 'brenda-wright') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/brenda-wright.webp') }}" alt="Brenda Wright">
                        </div>
                        <h2>Brenda Wright</h2>
                        <p>Executive Chief Operating Officer</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'rob-wright') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/rob-wright.webp') }}" alt="Rob Wright">
                        </div>
                        <h2>Rob Wright</h2>
                        <p>Co-Founder and Managing Member</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'kim-dean') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/kim-din.webp') }}" alt="Kim Dean">
                        </div>
                        <h2>Kim Dean</h2>
                        <p>Chief Financial Officer</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'bridget-mcguire') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/Bridget McGuire.webp') }}" alt="Bridget McGuire">
                        </div>
                        <h2>Bridget McGuire</h2>
                        <p>Chief Operating Officer</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'tiffany-badgero') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/Tiffany Badgero.webp') }}" alt="Tiffany Badgero">
                        </div>
                        <h2>Tiffany Badgero</h2>
                        <p>Vice President of People &amp; Business Operations</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'michael-holmes') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/michle.webp') }}" alt="Michael Holmes">
                        </div>
                        <h2>Michael Holmes</h2>
                        <p>Vice President of Technology &amp; Compliance</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'melanie-lindenmeyer') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/Melanie Lindenmeyer.webp') }}" alt="Melanie Lindenmeyer">
                        </div>
                        <h2>Melanie Lindenmeyer</h2>
                        <p>Vice President Regulatory Compliance, Audit &amp; Training</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'julie-anderson') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/julie.webp') }}" alt="Julie Anderson">
                        </div>
                        <h2>Julie Anderson</h2>
                        <p>Director of FA Operations</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'erin-baxley') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/erin.webp') }}" alt="Erin Baxley">
                        </div>
                        <h2>Erin Baxley</h2>
                        <p>Director of FA Operations</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'tammy-bentze') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/tammy.webp') }}" alt="Tammy Bentze">
                        </div>
                        <h2>Tammy Bentze</h2>
                        <p>Director of FA Operations</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'michael-dozier') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/Michael Dozier.webp') }}" alt="Michael Dozier">
                        </div>
                        <h2>Michael Dozier</h2>
                        <p>Director of FA Operations</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'katie-norris') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/katie.webp') }}" alt="Katie Norris">
                        </div>
                        <h2>Katie Norris</h2>
                        <p>Director of Growth &amp; Partnerships</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'amy-norton') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/amy.webp') }}" alt="Amy Norton">
                        </div>
                        <h2>Amy Norton</h2>
                        <p>Director of Business Information Systems</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'heather-taynor') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/Heather Taynor.webp') }}" alt="Heather Taynor">
                        </div>
                        <h2>Heather Taynor</h2>
                        <p>Strategic Client &amp; Growth Advisor</p>
                    </a>
                    <a class="team-card" href="{{ route('team.member', 'nydia-willard') }}">
                        <div class="team-card-photo">
                            <img src="{{ media_asset('images/nydia.webp') }}" alt="Nydia Willard">
                        </div>
                        <h2>Nydia Willard</h2>
                        <p>Director of Student Experience</p>
                    </a>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'plain'])
@endsection

