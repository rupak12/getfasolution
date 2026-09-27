@extends('admin.layouts.app')

@section('title', 'Footer Banner')
@section('page_title', 'Footer Banner')

@section('content')
    <p class="section-desc" style="margin-bottom: 1.5rem;">
        Edit the contact and newsletter banner shown above the footer on most pages.
        Phone number and website link come from <a href="{{ route('admin.settings.edit') }}">Global Settings → Contact Information</a>.
    </p>

    <section class="admin-seo-preview" style="margin-bottom: 1.5rem;">
        <h3>Current Live Preview</h3>
        <p class="section-desc">This is what visitors see on the website right now.</p>
        <div class="admin-footer-banner-preview">
            <div class="admin-footer-banner-preview-col">
                <h4>{{ $settings->footerCtaTitle() }}</h4>
                <p>{{ $settings->footerCtaText() }}</p>
                <p class="admin-help">{{ $settings->contact_phone }} · {{ $settings->websiteLabel() }}</p>
            </div>
            <div class="admin-footer-banner-preview-col">
                <h4>{{ $settings->footerNewsletterTitle() }}</h4>
                <p>{{ $settings->footerNewsletterText() }}</p>
                <span class="admin-badge admin-badge-success">{{ $settings->footerNewsletterButtonText() }}</span>
            </div>
        </div>
    </section>

    <form action="{{ route('admin.footer-banner.update') }}" method="POST" class="admin-settings-form">
        @csrf
        @method('PUT')

        <div class="admin-settings-grid">
            <section class="admin-panel admin-form-section">
                <h2>Get in Touch (Left Side)</h2>

                <div class="admin-form-group">
                    <label for="footer_cta_title">Title</label>
                    <input id="footer_cta_title" type="text" name="footer_cta_title" class="admin-form-control"
                        value="{{ old('footer_cta_title', $settings->footerCtaTitle()) }}" required>
                </div>

                <div class="admin-form-group">
                    <label for="footer_cta_text">Description</label>
                    <textarea id="footer_cta_text" name="footer_cta_text" class="admin-form-control admin-textarea" rows="3"
                        required>{{ old('footer_cta_text', $settings->footerCtaText()) }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label>Phone &amp; Website (read-only)</label>
                    <p class="admin-help" style="margin: 0;">
                        {{ $settings->contact_phone }} · {{ $settings->websiteLabel() }}
                    </p>
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Newsletter (Right Side)</h2>

                <div class="admin-form-group">
                    <label for="footer_newsletter_title">Title</label>
                    <input id="footer_newsletter_title" type="text" name="footer_newsletter_title" class="admin-form-control"
                        value="{{ old('footer_newsletter_title', $settings->footerNewsletterTitle()) }}" required>
                </div>

                <div class="admin-form-group">
                    <label for="footer_newsletter_text">Description</label>
                    <textarea id="footer_newsletter_text" name="footer_newsletter_text" class="admin-form-control admin-textarea" rows="4"
                        required>{{ old('footer_newsletter_text', $settings->footerNewsletterText()) }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label for="footer_newsletter_button_text">Subscribe Button Text</label>
                    <input id="footer_newsletter_button_text" type="text" name="footer_newsletter_button_text" class="admin-form-control"
                        value="{{ old('footer_newsletter_button_text', $settings->footerNewsletterButtonText()) }}" required>
                </div>
            </section>
        </div>

        @if ($errors->any())
            <div class="admin-alert admin-alert-danger">
                <ul class="admin-error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn-primary">Save Footer Banner</button>
        </div>
    </form>
@endsection
