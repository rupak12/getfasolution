@extends('layouts.app')

@section('title', 'Webinar: '.$webinar['title'].' | FA Solutions')
@section('body_class', 'webinar-detail-page')
@section('current_page', 'webinar')

@section('main')
<main class="webinar-page webinar-detail">
    <section class="webinar-detail-section">
        <div class="container">
            <article class="webinar-row webinar-detail-row">
                <div class="webinar-thumb">
                    <img src="{{ media_asset($webinar['image']) }}" alt="{{ $webinar['title'] }}">
                </div>
                <div class="webinar-info">
                    <h1>{{ $webinar['title'] }}</h1>
                    <p>{{ $webinar['summary'] }}</p>
                    <button type="button" class="btn-green js-webinar-open" data-webinar-modal="webinarRegisterModal">
                        WATCH WEBINAR
                    </button>
                </div>
            </article>
        </div>
    </section>

    @include('pages.partials.webinar-register-modal', ['webinar' => $webinar])
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

    const openButtons = document.querySelectorAll('.js-webinar-open');
    const closeTargets = modal.querySelectorAll('[data-webinar-modal-close]');

    const openModal = () => {
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

    openButtons.forEach((btn) => btn.addEventListener('click', openModal));
    closeTargets.forEach((el) => el.addEventListener('click', closeModal));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.hidden) closeModal();
    });

    @if ($openRegisterModal || session('webinar_watch_success') || (isset($errors) && $errors->any()))
    openModal();
    @endif
});
</script>
@endpush
