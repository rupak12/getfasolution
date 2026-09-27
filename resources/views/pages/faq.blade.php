@extends('layouts.app')

@section('title', 'Financial Aid Services Faqs | FA Solutions')
@section('body_class', '')
@section('current_page', 'faq')

@section('main')
    @php
        $pageSettings = \App\Models\FaqSetting::current();
        $faqItems = \App\Models\FaqItem::activeOrdered();
    @endphp
    <main>
        <section class="inner-banner">
            <div class="inner-banner-text">
                @if ($pageSettings->banner_label)
                    <span>{{ $pageSettings->banner_label }}</span>
                @endif
                @if ($pageSettings->banner_title)
                    <h1>{{ $pageSettings->banner_title }}</h1>
                @endif
            </div>
        </section>

        <section class="faqs-top">
            <div class="page_wrapper">
                @if ($pageSettings->intro_title)
                    <h2>{{ $pageSettings->intro_title }}</h2>
                @endif
                <div class="faqs-top-box">
                    @if ($pageSettings->intro_paragraph)
                        <p>{{ html_to_plain($pageSettings->intro_paragraph) }}</p>
                    @endif
                    @if ($pageSettings->intro_button_text)
                        <a href="{{ page_route_url($pageSettings->intro_button_route) }}"
                            class="faq-info-btn">{{ $pageSettings->intro_button_text }}</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="faqs-bottom">
            <div class="page_wrapper">
                <div class="faq-content">
                    <div class="faq-accordion">
                        @foreach ($faqItems as $index => $item)
                            <div class="faq-item {{ $index === 0 ? 'is-open' : '' }}">
                                <button class="faq-question" type="button">
                                    <span>{{ $item->question }}</span>
                                    <span class="faq-toggle">{{ $index === 0 ? '−' : '+' }}</span>
                                </button>
                                <div class="faq-answer">
                                    @include('pages.partials.faq-answer', [
                                        'item' => [
                                            'answer' => $item->answer,
                                            'bullets' => $item->bullets,
                                        ],
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection
