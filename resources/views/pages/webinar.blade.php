@extends('layouts.app')

@section('title', 'Higher Education Financial Aid Webinars | FA Solutions')
@section('body_class', '')
@section('current_page', 'webinar')

@section('main')
@php
    $webinars = \App\Data\WebinarCatalog::items();
    $main = page_content('webinar', 'main') ?? [];
    $reopenSlug = old('webinar_slug', session('webinar_modal_slug', request('watch')));
    $reopenWebinar = $reopenSlug
        ? collect($webinars)->firstWhere('slug', $reopenSlug)
        : null;
@endphp
<main class="webinar-page">

        @include('pages.partials.inner-banner', ['pageSlug' => 'webinar', 'bannerClass' => 'inner-banner-webiner'])

        <section class="webinar-content">
            <div class="container">
                @if (! empty($main['title']))
                    <h2 class="webinar-access-title">{{ $main['title'] }}</h2>
                @else
                    <h2 class="webinar-access-title">Access our previous Webinar Recorded Sessions here!</h2>
                @endif
                @if (! empty($main['paragraph_1']))
                    <p class="webinar-intro">{{ html_to_plain($main['paragraph_1']) }}</p>
                @else
                    <p class="webinar-intro">We are both dependable and responsive to our school partners, with the mutual
                        goal<br>of enhancing the overall student experience.</p>
                @endif

                @foreach ($webinars as $item)
                    <article class="webinar-row">
                        <div class="webinar-thumb">
                            <img src="{{ media_asset($item['image']) }}" alt="{{ $item['title'] }}">
                        </div>
                        <div class="webinar-info">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['summary'] }}</p>
                            <button
                                type="button"
                                class="btn-green js-webinar-open"
                                data-webinar-slug="{{ $item['slug'] }}"
                                data-webinar-title="{{ $item['title'] }}"
                            >WATCH WEBINAR</button>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        @include('pages.partials.webinar-register-modal', [
            'modalId' => 'webinarRegisterModal',
            'dynamic' => true,
        ])

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('webinarRegisterModal');
    if (!modal) return;

    const subtitle = document.getElementById('webinarRegisterModal-subtitle');
    const slugInput = document.getElementById('webinarRegisterModal-slug');
    const openButtons = document.querySelectorAll('.js-webinar-open');
    const closeTargets = modal.querySelectorAll('[data-webinar-modal-close]');

    const openModal = (slug, title) => {
        if (slugInput && slug) slugInput.value = slug;
        if (subtitle && title) subtitle.textContent = title;
        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('webinar-modal-open');
        const firstInput = modal.querySelector('input:not([type="hidden"])');
        if (firstInput) firstInput.focus();
    };

    const closeModal = () => {
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('webinar-modal-open');
    };

    openButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            openModal(btn.dataset.webinarSlug, btn.dataset.webinarTitle);
        });
    });

    closeTargets.forEach((el) => el.addEventListener('click', closeModal));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.hidden) closeModal();
    });

    @if ($reopenWebinar)
    openModal(@json($reopenWebinar['slug']), @json($reopenWebinar['title']));
    @endif
});
</script>
@endpush
