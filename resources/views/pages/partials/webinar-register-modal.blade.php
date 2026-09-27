@php
    $webinar = $webinar ?? [];
    $modalId = $modalId ?? 'webinarRegisterModal';
    $dynamic = $dynamic ?? false;
@endphp

<div class="webinar-modal" id="{{ $modalId }}" hidden aria-hidden="true">
    <div class="webinar-modal__backdrop" data-webinar-modal-close></div>
    <div class="webinar-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="{{ $modalId }}-title">
        <button type="button" class="webinar-modal__close" data-webinar-modal-close aria-label="Close registration form">&times;</button>

        <h2 class="webinar-modal__title" id="{{ $modalId }}-title">Register to Watch</h2>
        @if ($dynamic)
            <p class="webinar-modal__subtitle" id="{{ $modalId }}-subtitle"></p>
        @else
            <p class="webinar-modal__subtitle">{{ $webinar['title'] ?? '' }}</p>
        @endif

        @if (session('webinar_watch_success'))
            <p class="webinar-modal__success">Thank you for filling out the form.</p>
        @else
            <form class="webinar-modal__form" action="{{ route('forms.webinar.watch') }}" method="POST">
                @csrf
                <input type="hidden" name="webinar_slug" id="{{ $modalId }}-slug" value="{{ $dynamic ? old('webinar_slug') : ($webinar['slug'] ?? '') }}">

                <div class="webinar-modal__fields">
                    <div class="webinar-modal__field">
                        <label for="{{ $modalId }}-first-name">First Name:</label>
                        <input type="text" name="first_name" id="{{ $modalId }}-first-name" value="{{ old('first_name') }}" maxlength="100" required>
                        @error('first_name')
                            <span class="webinar-modal__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="webinar-modal__field">
                        <label for="{{ $modalId }}-last-name">Last Name:</label>
                        <input type="text" name="last_name" id="{{ $modalId }}-last-name" value="{{ old('last_name') }}" maxlength="100" required>
                        @error('last_name')
                            <span class="webinar-modal__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="webinar-modal__field webinar-modal__field--full">
                        <label for="{{ $modalId }}-email">Email:</label>
                        <input type="email" name="email" id="{{ $modalId }}-email" value="{{ old('email') }}" maxlength="255" required>
                        @error('email')
                            <span class="webinar-modal__error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <p class="webinar-modal__recaptcha">This site is protected by reCAPTCHA. Google's <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Terms of Service</a> apply.</p>

                <div class="webinar-modal__submit-wrap">
                    <button type="submit" class="webinar-modal__submit">Watch Webinar</button>
                </div>
            </form>
        @endif
    </div>
</div>
