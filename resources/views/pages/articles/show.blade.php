@extends('layouts.app')

@section('body_class', 'resource-article-page')

@section('main')
@php
    $parentRoute = $article['parent_route'] ?? 'home';
    $parentLabel = $article['parent_label'] ?? 'Back';
@endphp
<main class="blogs-page resource-article-main">
        <section class="inner-banner">
            <div class="inner-banner-text">
                <span>{{ $article['category'] ?? 'Resources' }}</span>
                <h1>{{ $article['title'] }}</h1>
            </div>
        </section>

        <section class="blogs-section resource-article-section">
            <div class="page_wrapper">
                <article class="resource-article">
                    @if (! empty($article['date']))
                        <p class="blog-date">{{ $article['date'] }}</p>
                    @endif

                    @if (! empty($article['image']))
                        <div class="resource-article-image">
                            <img src="{{ media_asset($article['image']) }}" alt="{{ $article['title'] }}">
                        </div>
                    @endif

                    @if (! empty($article['intro']))
                        <p class="resource-article-intro">{{ $article['intro'] }}</p>
                    @endif

                    @foreach ($article['sections'] ?? [] as $section)
                        @if (! empty($section['heading']))
                            <h2>{{ $section['heading'] }}</h2>
                        @endif
                        @if (! empty($section['body']))
                            <p>{{ $section['body'] }}</p>
                        @endif
                    @endforeach

                    @if (! empty($article['bullets']))
                        <ul class="resource-article-list">
                            @foreach ($article['bullets'] as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @foreach ($article['paragraphs'] ?? [] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach

                    <p class="resource-article-back">
                        <a href="{{ route($parentRoute) }}">&larr; {{ $parentLabel }}</a>
                    </p>
                </article>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection
