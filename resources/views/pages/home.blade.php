@extends('layouts.app')

@section('title', 'New Fa Solutions')
@section('body_class', 'home-page')
@section('current_page', 'home')

@section('main')
@php
    $hero = page_content('home', 'hero') ?? [];
    $intro = page_content('home', 'intro') ?? [];
    $difference = page_content('home', 'difference') ?? [];
    $why = page_content('home', 'why') ?? [];
    $services = page_content('home', 'services') ?? [];
    $success = page_content('home', 'success') ?? [];
    $gallery = page_content('home', 'image_gallery') ?? [];
    $faq = page_content('home', 'faq') ?? [];
@endphp
<main class="homepage">

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-section_wrapper">
                <div class="hero-grid">
                    <div class="hero-content">
                        <h1 class="hero-title">{{ $hero['title'] ?? '' }}</h1>
                        <h2 class="hero-subtitle">{{ $hero['subtitle'] ?? '' }}</h2>
                        @if (! empty($hero['paragraph_1']))
                            <p class="hero-text">{{ $hero['paragraph_1'] }}</p>
                        @endif
                        @if (! empty($hero['paragraph_2']))
                            <p class="hero-text">{{ $hero['paragraph_2'] }}</p>
                        @endif
                        @if (! empty($hero['button_text']))
                            <a href="{{ page_route_url($hero['button_route'] ?? null) }}" class="btn-green">{{ $hero['button_text'] }}</a>
                        @endif
                    </div>
                    <div class="hero-images">
                        @if (! empty($hero['image_1']))
                            <div class="hero-img hero-img-1">
                                <img src="{{ page_image($hero['image_1']) }}" alt="{{ $hero['image_1_alt'] ?? '' }}">
                            </div>
                        @endif
                        @if (! empty($hero['image_2']))
                            <div class="hero-img hero-img-2">
                                <img src="{{ page_image($hero['image_2']) }}" alt="{{ $hero['image_2_alt'] ?? '' }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Real People Section -->
        <section class="intro-section">
            <div class="page_wrapper">
                <div class="intro-content">
                    @if (! empty($intro['title']))
                        <h2>{{ $intro['title'] }}</h2>
                    @endif
                    @include('pages.partials.paragraphs', ['section' => $intro])
                    @if (! empty($intro['button_text']))
                        <a href="{{ page_route_url($intro['button_route'] ?? null) }}" class="btn-green">{{ $intro['button_text'] }}</a>
                    @endif
                </div>
            </div>
        </section>

        <!-- Our Difference & Contact Form -->
        <section class="difference-section">
            <div class="page_wrapper">
                <div class="difference-grid">
                    <div class="difference-list">
                        @if (! empty($difference['title']))
                            <h2>{{ $difference['title'] }}</h2>
                        @endif
                        @foreach ($difference['items'] ?? [] as $item)
                            <div class="difference-item">
                                <div class="difference-icon">
                                    @if (! empty($item['icon']))
                                        <img src="{{ page_image($item['icon']) }}" class="difference-icon-pic" alt="">
                                    @endif
                                </div>
                                <div class="difference-text">
                                    @if (! empty($item['title']))
                                        <h4>{{ $item['title'] }}</h4>
                                    @endif
                                    @if (! empty($item['content']))
                                        <p>{{ $item['content'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="contact-form-card">
                        <h2>{{ $difference['form_title'] ?? 'Get in Touch' }}</h2>
                        <form action="{{ route('forms.contact') }}" method="POST">
                            @csrf
                            @include('pages.partials.form-submit-error')
                            <div class="form-row">
                                <input type="text" name="first_name" class="input-field" placeholder="First Name" maxlength="100" required>
                                <input type="text" name="last_name" class="input-field" placeholder="Last Name" maxlength="100" required>
                            </div>
                            <div class="form-row">
                                <input type="email" name="email" class="input-field" placeholder="Email Address" maxlength="255" required>
                                <input type="tel" name="phone" class="input-field" placeholder="Phone Number" maxlength="30">
                            </div>
                            <div class="form-row">
                                <input type="text" name="job_title" class="input-field" placeholder="Job Title" maxlength="150">
                                <input type="text" name="institution" class="input-field" placeholder="School/Institution" maxlength="200">
                            </div>
                            <div class="full-width">
                                <textarea name="message" class="input-field textarea-field" placeholder="Message" rows="4" maxlength="5000"></textarea>
                            </div>
                            <p class="recaptcha-notice">This site is protected by reCAPTCHA. Google's <a
                                    href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy
                                    Policy</a> and <a href="https://policies.google.com/terms" target="_blank"
                                    rel="noopener">Terms of Service</a> apply.</p>
                            <div class="form-submit-wrap">
                                <button type="submit" class="submit-btn submit-btn-pill">Submit Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why FA Solutions -->
        <section class="why-section">
            <div class="why-section_wrapper">
                <div class="why-card">
                    @if (! empty($why['title']))
                        <h2>{{ $why['title'] }}</h2>
                    @endif
                    <div class="why-grid">
                        @foreach ($why['items'] ?? [] as $item)
                            <div class="why-item">
                                <div class="why-icon-wrap">
                                    <div class="why-icon-shadow"></div>
                                    <div class="why-icon-box">
                                        @include('pages.partials.home-why-icon', ['index' => $loop->index])
                                    </div>
                                </div>
                                @if (! empty($item['title']))
                                    <h4>{{ $item['title'] }}</h4>
                                @endif
                                @if (! empty($item['content']))
                                    <p>{{ $item['content'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="why-divider"></div>
                    @if (! empty($why['button_text']))
                        <div class="why-cta">
                            <a href="{{ page_route_url($why['button_route'] ?? null) }}" class="btn-green">{{ $why['button_text'] }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Our Services -->
        <section class="services-section">
            <div class="page_wrapper">
                @if (! empty($services['title']))
                    <h2>{{ $services['title'] }}</h2>
                @endif
                <div class="services-grid">
                    @foreach ($services['cards'] ?? [] as $card)
                        <div class="service-card">
                            @if (! empty($card['image']))
                                <div class="service-img">
                                    <img src="{{ page_image($card['image']) }}" alt="{{ $card['image_alt'] ?? '' }}">
                                </div>
                            @endif
                            <div class="service-body">
                                @if (! empty($card['title']))
                                    <h3>{{ $card['title'] }}</h3>
                                @endif
                                @if (! empty($card['intro']))
                                    <p>{{ $card['intro'] }}</p>
                                @endif
                                @include('pages.partials.bullet-list', ['text' => $card['bullets'] ?? null])
                                @if (! empty($card['button_text']))
                                    <a href="{{ page_route_url($card['button_route'] ?? null) }}" class="btn-green">{{ $card['button_text'] }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Client Success Stories -->
        <section class="success-section">
            <div class="why-section_wrapper">
                <div class="success-card">
                    <div class="success-top">
                        <div class="success-left">
                            <div class="success-icon-wrap"></div>
                            @if (! empty($success['title']))
                                <h2>{{ $success['title'] }}</h2>
                            @endif
                        </div>
                        <div class="success-divider"></div>
                        <div class="success-right">
                            @if (! empty($success['subtitle']))
                                <h3>{{ $success['subtitle'] }}</h3>
                            @endif
                            <ul class="success-list">
                                @foreach ($success['items'] ?? [] as $item)
                                    <li>{{ $item['content'] ?? '' }}</li>
                                @endforeach
                            </ul>
                            @if (! empty($success['button_text']))
                                <a href="{{ page_route_url($success['button_route'] ?? null) }}" class="btn-green success-cta">{{ $success['button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client Success Stories Images -->
        <section class="image-section">
            <div class="image-container">
                <div class="image-bg"></div>
                <div class="image-wrapper">
                    @if (! empty($gallery['image_1']))
                        <div class="big-image">
                            <img class="img-fluid" src="{{ page_image($gallery['image_1']) }}" alt="{{ $gallery['image_1_alt'] ?? '' }}">
                        </div>
                    @endif
                    @if (! empty($gallery['image_2']))
                        <div class="small-image">
                            <img class="img-fluid" src="{{ page_image($gallery['image_2']) }}" alt="{{ $gallery['image_2_alt'] ?? '' }}">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @include('pages.partials.shared-home-faq', ['faq' => $faq])
    @include('layouts.footer', ['type' => 'full'])
</main>
@endsection
