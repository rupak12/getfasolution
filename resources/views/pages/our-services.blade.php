@extends('layouts.app')

@section('title', 'Higher Education Financial Aid Services | FA Solutions')
@section('body_class', 'about-page')
@section('current_page', 'our-services')

@section('main')
    @php
        $settings = \App\Models\OurServicesSetting::current();
        $serviceCards = \App\Models\OurServicesCard::activeOrdered();
        $whyItems = \App\Models\OurServicesWhyItem::activeOrdered();
    @endphp
    <main class="about-page">
        <section class="inner-banner">
            <div class="inner-banner-text">
                @if ($settings->banner_label)
                    <span>{{ $settings->banner_label }}</span>
                @endif
                @if ($settings->banner_title)
                    <h1>{{ $settings->banner_title }}</h1>
                @endif
            </div>
        </section>

        <section class="services-section">
            <div class="page_wrapper">
                @if ($settings->core_section_title)
                    <h2>{{ $settings->core_section_title }}</h2>
                @endif
                @if ($settings->core_section_intro)
                    <div class="services-section-para">
                        <p>{{ html_to_plain($settings->core_section_intro) }}</p>
                    </div>
                @endif
                <div class="services-grid">
                    @foreach ($serviceCards as $card)
                        <div class="service-card">
                            @if ($card->image)
                                <div class="service-img">
                                    <img src="{{ page_image($card->image) }}" alt="{{ $card->image_alt ?? '' }}">
                                </div>
                            @endif
                            <div class="service-body">
                                @if ($card->title)
                                    <h3>{{ $card->title }}</h3>
                                @endif
                                @if ($card->intro)
                                    <p>{{ html_to_plain($card->intro) }}</p>
                                @endif
                                @include('pages.partials.bullet-list', ['text' => $card->bullets])
                                @if ($card->button_text)
                                    <a href="{{ page_route_url($card->button_route) }}" class="btn-green">{{ $card->button_text }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="why-section">
            <div class="why-section_wrapper">
                <div class="why-card">
                    @if ($settings->why_section_title)
                        <h2>{{ $settings->why_section_title }}</h2>
                    @endif
                    <div class="why-grid why-grid-service-page">
                        @foreach ($whyItems as $item)
                            <div class="why-item">
                                <div class="why-icon-wrap">
                                    <div class="why-icon-shadow"></div>
                                    <div class="why-icon-box">
                                        @if ($item->icon)
                                            <img src="{{ page_image($item->icon) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                @if ($item->title)
                                    <h4>{{ $item->title }}</h4>
                                @endif
                                @if ($item->description)
                                    <p>{{ html_to_plain($item->description) }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="why-divider"></div>
                    @if ($settings->why_cta_button_text)
                        <div class="why-cta">
                            <a href="{{ page_route_url($settings->why_cta_button_route) }}" class="btn-green">{{ $settings->why_cta_button_text }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @include('pages.partials.shared-home-faq', [
            'sectionClass' => 'faq-section about-faq-section',
            'titleClass' => 'about-faq-title',
        ])
    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection
