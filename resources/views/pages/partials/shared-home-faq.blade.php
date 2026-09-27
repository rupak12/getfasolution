@php
    $faq = $faq ?? page_content('home', 'faq') ?? [];
    $sectionClass = $sectionClass ?? 'faq-section faq-section-home';
    $titleClass = $titleClass ?? '';
    $fallbackMoreRoute = $fallbackMoreRoute ?? 'faq';
    $fallbackMoreLabel = $fallbackMoreLabel ?? 'View More FAQs';
@endphp

<section class="{{ $sectionClass }}" id="faqs">
    <div class="page_wrapper">
        @if (! empty($faq['title']))
            <h2 @if ($titleClass) class="{{ $titleClass }}" @endif>{{ $faq['title'] }}</h2>
        @endif
        <div class="faq-grid">
            @if (! empty($faq['image']))
                <div class="faq-image">
                    <img src="{{ page_image($faq['image']) }}" alt="{{ $faq['image_alt'] ?? 'FAQ' }}">
                </div>
            @endif
            <div class="faq-content">
                <div class="faq-accordion">
                    @foreach ($faq['items'] ?? [] as $index => $item)
                        <div class="faq-item {{ $index === 0 ? 'is-open' : '' }}">
                            <button class="faq-question" type="button">
                                <span>{{ $item['question'] ?? '' }}</span>
                                <span class="faq-toggle">{{ $index === 0 ? '−' : '+' }}</span>
                            </button>
                            <div class="faq-answer">
                                @include('pages.partials.plain-text', ['text' => $item['answer'] ?? null])
                            </div>
                        </div>
                    @endforeach
                </div>
                @if (! empty($faq['button_text']))
                    <a href="{{ page_route_url($faq['button_route'] ?? null, route($fallbackMoreRoute)) }}" class="btn-green">{{ $faq['button_text'] }}</a>
                @else
                    <a href="{{ route($fallbackMoreRoute) }}" class="btn-green">{{ $fallbackMoreLabel }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
