@extends('admin.layouts.app')

@section('title', 'Global Settings')
@section('page_title', 'Global Settings')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="admin-settings-form">
        @csrf
        @method('PUT')

        <div class="admin-settings-grid">
            <section class="admin-panel admin-form-section">
                <h2>Branding</h2>
                <p class="section-desc">Update site logo and favicon shown on the public website.</p>

                <div class="admin-form-group">
                    <label for="site_name">Site Name</label>
                    <input id="site_name" type="text" name="site_name" class="admin-form-control"
                        value="{{ old('site_name', $settings->site_name) }}" required>
                </div>

                <div class="admin-upload-grid">
                    <div class="admin-form-group">
                        <label for="header_logo">Header Logo</label>
                        <div class="admin-preview-box">
                            <img src="{{ $settings->headerLogoUrl() }}" alt="Header logo preview">
                        </div>
                        <input id="header_logo" type="file" name="header_logo" class="admin-form-control" accept="image/*">
                        <small class="admin-help">PNG, JPG, WEBP or SVG. Max 2MB.</small>
                    </div>

                    <div class="admin-form-group">
                        <label for="footer_logo">Footer Logo</label>
                        <div class="admin-preview-box">
                            <img src="{{ $settings->footerLogoUrl() }}" alt="Footer logo preview">
                        </div>
                        <input id="footer_logo" type="file" name="footer_logo" class="admin-form-control" accept="image/*">
                        <small class="admin-help">PNG, JPG, WEBP or SVG. Max 2MB.</small>
                    </div>

                    <div class="admin-form-group">
                        <label for="favicon">Favicon</label>
                        <div class="admin-preview-box admin-preview-favicon">
                            <img src="{{ $settings->faviconUrl() }}" alt="Favicon preview">
                        </div>
                        <input id="favicon" type="file" name="favicon" class="admin-form-control" accept="image/png,image/x-icon,image/jpeg,image/webp">
                        <small class="admin-help">PNG or ICO recommended. Max 1MB.</small>
                    </div>
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Social Media</h2>
                <p class="section-desc">Links used in the website header and footer.</p>

                <div class="admin-form-group">
                    <label for="facebook_url">Facebook URL</label>
                    <input id="facebook_url" type="url" name="facebook_url" class="admin-form-control"
                        value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/...">
                </div>

                <div class="admin-form-group">
                    <label for="instagram_url">Instagram URL</label>
                    <input id="instagram_url" type="url" name="instagram_url" class="admin-form-control"
                        value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/...">
                </div>

                <div class="admin-form-group">
                    <label for="youtube_url">YouTube URL</label>
                    <input id="youtube_url" type="url" name="youtube_url" class="admin-form-control"
                        value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/...">
                </div>

                <div class="admin-form-group">
                    <label for="linkedin_url">LinkedIn URL</label>
                    <input id="linkedin_url" type="url" name="linkedin_url" class="admin-form-control"
                        value="{{ old('linkedin_url', $settings->linkedin_url) }}" placeholder="https://linkedin.com/...">
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Contact Information</h2>
                <p class="section-desc">Displayed in the footer and contact sections.</p>

                <div class="admin-form-group">
                    <label for="contact_phone">Phone Number</label>
                    <input id="contact_phone" type="text" name="contact_phone" class="admin-form-control"
                        value="{{ old('contact_phone', $settings->contact_phone) }}" required>
                </div>

                <div class="admin-form-group">
                    <label for="contact_email">Email Address</label>
                    <input id="contact_email" type="email" name="contact_email" class="admin-form-control"
                        value="{{ old('contact_email', $settings->contact_email) }}" required>
                </div>

                <div class="admin-form-group">
                    <label for="contact_address">Address</label>
                    <textarea id="contact_address" name="contact_address" class="admin-form-control admin-textarea" rows="3"
                        required>{{ old('contact_address', $settings->contact_address) }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label for="contact_website">Website URL</label>
                    <input id="contact_website" type="text" name="contact_website" class="admin-form-control"
                        value="{{ old('contact_website', $settings->contact_website) }}" placeholder="https://GetFASolutions.com">
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Footer Content</h2>
                <p class="section-desc">About text and copyright line for the website footer.</p>

                <div class="admin-form-group">
                    <label for="footer_about">Footer About Text</label>
                    <textarea id="footer_about" name="footer_about" class="admin-form-control admin-textarea" rows="5"
                        required>{{ old('footer_about', $settings->footer_about) }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label for="copyright_text">Copyright Text</label>
                    <textarea id="copyright_text" name="copyright_text" class="admin-form-control admin-textarea" rows="3"
                        required>{{ old('copyright_text', $settings->copyright_text) }}</textarea>
                    <small class="admin-help">Use <code>{year}</code> to automatically insert the current year.</small>
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
            <button type="submit" class="admin-btn admin-btn-primary">Save Global Settings</button>
        </div>
    </form>
@endsection
