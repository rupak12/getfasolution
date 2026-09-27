@extends('layouts.app')

@section('title', 'Financial Aid Careers | FA Solutions')
@section('body_class', '')
@section('current_page', 'careers')

@section('main')
@php
    $culture = page_content('careers', 'culture') ?? [];
    $who = page_content('careers', 'who') ?? [];
    $growth = page_content('careers', 'growth') ?? [];
    $jobs = page_content('careers', 'jobs') ?? [];
    $eeo = page_content('careers', 'eeo') ?? [];
    $faq = page_content('careers', 'faq') ?? [];

    $whoBullets = [];
    foreach (['paragraph_1', 'paragraph_2', 'paragraph_3'] as $field) {
        foreach (page_bullet_lines($who[$field] ?? null) as $line) {
            if (! in_array($line, $whoBullets, true)) {
                $whoBullets[] = $line;
            }
        }
    }

    $growthCardOne = page_bullet_lines($growth['paragraph_1'] ?? null);
    $growthCardTwo = page_bullet_lines($growth['paragraph_3'] ?? null);
    if ($growthCardTwo === []) {
        $growthCardTwo = page_bullet_lines($growth['paragraph_2'] ?? null);
    }

    $faqItems = $faq['items'] ?? [];
    $faqSplitAt = (int) ceil(count($faqItems) / 2);
    $faqColumnOne = array_slice($faqItems, 0, $faqSplitAt);
    $faqColumnTwo = array_slice($faqItems, $faqSplitAt);

    $cultureImage = ! empty($culture['image'])
        ? page_image($culture['image'])
        : media_asset('images/career-1.webp');
    $whoImage = ! empty($who['image'])
        ? page_image($who['image'])
        : media_asset('images/career-2.webp');
    $growthImage = ! empty($growth['image'])
        ? page_image($growth['image'])
        : media_asset('images/career-3.webp');
@endphp
<main class="careers-page">

        @include('pages.partials.inner-banner', ['pageSlug' => 'careers'])

        <section class="careers-culture-section">
            <div class="page_wrapper">
                <div class="careers-split">
                    <div class="careers-photo">
                         <img src="{{ $cultureImage }}" alt="FA Solutions team collaborating around a table">
                    </div>
                    <div class="careers-copy">
                        @if (! empty($culture['title']))
                            <h2>{{ $culture['title'] }}</h2>
                        @endif
                        @include('pages.partials.paragraphs', ['section' => $culture])
                    </div>
                </div>
            </div>
        </section>

        <section class="careers-who-section">
            <div class="page_wrapper">
                <div class="careers-split careers-split-reverse">
                    <div class="careers-copy">
                        @if (! empty($who['title']))
                            <h2>{{ $who['title'] }}</h2>
                        @endif
                        @if ($whoBullets !== [])
                            <ul class="careers-checks">
                                @foreach ($whoBullets as $bullet)
                                    <li>{{ $bullet }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if (! empty($who['button_text']))
                            <a href="{{ page_route_url($who['button_route'] ?? null, route('financial-aid-processing')) }}" class="btn-green">{{ $who['button_text'] }}</a>
                        @endif
                    </div>
                    <div class="careers-photo">
                          <img src="{{ $whoImage }}" alt="Financial aid professionals working together">
                    </div>
                </div>
            </div>
        </section>

        <section class="careers-growth-section">
            <div class="page_wrapper">
                <div class="careers-growth-grid">
                    <div class="careers-growth-cards">
                        @if ($growthCardOne !== [])
                            <article class="careers-growth-card">
                                <h3>{{ $growth['title'] ?? 'Professional growth' }}</h3>
                                <ul>
                                    @foreach ($growthCardOne as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            </article>
                        @endif
                        @if ($growthCardTwo !== [])
                            <article class="careers-growth-card">
                                <h3>Work-life balance</h3>
                                <ul>
                                    @foreach ($growthCardTwo as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            </article>
                        @endif
                    </div>
                    <div class="careers-photo careers-growth-photo">
                          <img src="{{ $growthImage }}" alt="Team member working on a laptop">
                    </div>
                </div>
            </div>
        </section>

        <section class="careers-jobs-section" id="openings">
            <div class="page_wrapper">
                @if (! empty($jobs['title']))
                    <h2>{{ $jobs['title'] }}</h2>
                @endif
                @if (! empty($jobs['paragraph_1']))
                    <p>{{ html_to_plain($jobs['paragraph_1']) }}</p>
                @endif

                <div class="jobs-toolbar">
                    <div class="jobs-search">
                        <input type="search" id="jobSearch" placeholder="Search jobs" aria-label="Search jobs">
                    </div>
                    <select id="jobDept" aria-label="All Departments">
                        <option value="">All Departments</option>
                        <option value="Communications">Communications</option>
                        <option value="Student Experience">Student Experience</option>
                        <option value="Operations">Operations</option>
                    </select>
                    <select id="jobOffice" aria-label="All Offices">
                        <option value="">All Offices</option>
                        <option value="St. Petersburg">St. Petersburg</option>
                        <option value="Remote">Remote</option>
                    </select>
                    <select id="jobRemote" aria-label="Remote">
                        <option value="">All</option>
                        <option value="yes">Remote</option>
                        <option value="no">On-site</option>
                    </select>
                </div>

                <div class="jobs-list" id="jobsList">
                    <article class="job-row" data-dept="Communications" data-office="St. Petersburg" data-remote="no">
                        <h3>Communications Specialist</h3>
                        <a href="{{ page_route_url($jobs['button_route'] ?? null, route('get-started')) }}" class="btn-green">{{ $jobs['button_text'] ?? 'Apply Now' }}</a>
                    </article>
                    <article class="job-row" data-dept="Student Experience" data-office="Remote" data-remote="yes">
                        <h3>Call Center Agent (REMOTE)</h3>
                        <a href="{{ page_route_url($jobs['button_route'] ?? null, route('get-started')) }}" class="btn-green">{{ $jobs['button_text'] ?? 'Apply Now' }}</a>
                    </article>
                    <article class="job-row" data-dept="Operations" data-office="Remote" data-remote="yes">
                        <h3>Program Director (REMOTE)</h3>
                        <a href="{{ page_route_url($jobs['button_route'] ?? null, route('get-started')) }}" class="btn-green">{{ $jobs['button_text'] ?? 'Apply Now' }}</a>
                    </article>
                </div>
                @if (! empty($jobs['paragraph_2']))
                    <p class="jobs-empty" id="jobsEmpty">{{ html_to_plain($jobs['paragraph_2']) }}</p>
                @else
                    <p class="jobs-empty" id="jobsEmpty">No job openings match your search.</p>
                @endif
            </div>
        </section>

        <section class="careers-eeo-section">
            <div class="page_wrapper">
                <div class="careers-eeo">
                    @include('pages.partials.paragraphs', ['section' => $eeo])
                </div>
            </div>
        </section>

        <section class="careers-faq-section">
            <div class="page_wrapper">
                @if (! empty($faq['title']))
                    <h2>{{ $faq['title'] }}</h2>
                @endif
                <p class="careers-faq-intro">If your questions are not answered here, please contact us.</p>
                @if ($faqItems !== [])
                    <div class="careers-faq-grid">
                        <div class="faq-accordion">
                            @foreach ($faqColumnOne as $item)
                                <div class="faq-item">
                                    <button class="faq-question" type="button">
                                        <span>{{ $item['question'] ?? '' }}</span>
                                        <span class="faq-toggle">+</span>
                                    </button>
                                    <div class="faq-answer">
                                        @include('pages.partials.plain-text', ['text' => $item['answer'] ?? ''])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="faq-accordion">
                            @foreach ($faqColumnTwo as $item)
                                <div class="faq-item">
                                    <button class="faq-question" type="button">
                                        <span>{{ $item['question'] ?? '' }}</span>
                                        <span class="faq-toggle">+</span>
                                    </button>
                                    <div class="faq-answer">
                                        @include('pages.partials.plain-text', ['text' => $item['answer'] ?? ''])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection
