@extends('layouts.app')

@section('title', 'Contact Us Fa Solutions | Financial Aid Support')
@section('body_class', '')
@section('current_page', 'contact-us')

@section('main')
    @php
        $pageSettings = \App\Models\ContactUsSetting::current();
        $socialCards = \App\Models\ContactUsSocialCard::activeOrdered();
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

        <section class="contact-page-form">
            <div class="contact-page-form-area">
                @if (session('contact_success'))
                    <p class="form-success-message">{{ session('contact_success') }}</p>
                @endif

                <div class="contact-form">
                    <form action="{{ route('forms.contact') }}" method="POST">
                        @csrf
                        @include('pages.partials.form-submit-error')
                        <div class="input-row">
                            <div class="input-column">
                                <input type="text" name="first_name"
                                    placeholder="{{ $pageSettings->placeholder_first_name ?? 'First Name' }}" maxlength="100"
                                    value="{{ old('first_name') }}">
                                <p class="error-message">@error('first_name') {{ $message }} @enderror</p>
                            </div>
                            <div class="input-column">
                                <input type="text" name="last_name"
                                    placeholder="{{ $pageSettings->placeholder_last_name ?? 'Last Name' }}" maxlength="100"
                                    value="{{ old('last_name') }}">
                                <p class="error-message">@error('last_name') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-column">
                                <input type="email" name="email"
                                    placeholder="{{ $pageSettings->placeholder_email ?? 'Email Address' }}" maxlength="255"
                                    value="{{ old('email') }}">
                                <p class="error-message">@error('email') {{ $message }} @enderror</p>
                            </div>
                            <div class="input-column">
                                <input type="tel" name="phone"
                                    placeholder="{{ $pageSettings->placeholder_phone ?? 'Phone Number' }}" maxlength="30"
                                    value="{{ old('phone') }}">
                                <p class="error-message">@error('phone') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-column">
                                <input type="text" name="job_title"
                                    placeholder="{{ $pageSettings->placeholder_job_title ?? 'Job Title' }}" maxlength="150"
                                    value="{{ old('job_title') }}">
                                <p class="error-message">@error('job_title') {{ $message }} @enderror</p>
                            </div>
                            <div class="input-column">
                                <input type="text" name="institution"
                                    placeholder="{{ $pageSettings->placeholder_institution ?? 'School/Institution' }}"
                                    maxlength="200" value="{{ old('institution') }}">
                                <p class="error-message">@error('institution') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <textarea name="message"
                            placeholder="{{ $pageSettings->placeholder_message ?? 'Message' }}"
                            maxlength="5000">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <div class="submit-area">
                            <button type="submit">{{ $pageSettings->submit_button_text ?? 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="contact-page-form-social">
            <div class="page_wrapper">
                @if ($pageSettings->social_section_title)
                    <h2>{{ $pageSettings->social_section_title }}</h2>
                @endif
                <div class="social-card-wrapper">
                    @foreach ($socialCards as $card)
                        @if ($card->url)
                            <a target="_blank" rel="noopener noreferrer" href="{{ $card->url }}" class="social-card">
                                @if ($card->image)
                                    <div @class(['social-icon' => str_contains($card->image, 'linkedin')])>
                                        <img src="{{ page_image($card->image) }}" alt="{{ $card->title ?? '' }}">
                                    </div>
                                @endif
                                <span class="social-line"></span>
                                @if ($card->title)
                                    <h3>{{ $card->title }}</h3>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'plain'])
@endsection
