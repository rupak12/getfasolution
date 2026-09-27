@extends('admin.layouts.app')

@section('title', 'Contact Us Settings')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Page &amp; Form Settings</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Page &amp; Form Settings</h2>
                <p class="admin-card-subtitle">Stored in <code>contact_us_settings</code></p>
            </div>
            <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
        </div>

        <form action="{{ route('admin.pages.contact-us.settings.update') }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <h3 class="admin-form-subheading">Banner</h3>
            <div class="admin-form-group">
                <label for="banner_label">Banner Label</label>
                <input type="text" id="banner_label" name="banner_label" class="admin-form-control"
                    value="{{ old('banner_label', $settings->banner_label) }}">
            </div>
            <div class="admin-form-group">
                <label for="banner_title">Banner Title</label>
                <input type="text" id="banner_title" name="banner_title" class="admin-form-control"
                    value="{{ old('banner_title', $settings->banner_title) }}">
            </div>

            <h3 class="admin-form-subheading">Contact Form</h3>
            <div class="admin-form-group">
                <label for="submit_button_text">Submit Button Text</label>
                <input type="text" id="submit_button_text" name="submit_button_text" class="admin-form-control"
                    value="{{ old('submit_button_text', $settings->submit_button_text) }}">
            </div>
            @foreach ([
                'placeholder_first_name' => 'First Name Placeholder',
                'placeholder_last_name' => 'Last Name Placeholder',
                'placeholder_email' => 'Email Placeholder',
                'placeholder_phone' => 'Phone Placeholder',
                'placeholder_job_title' => 'Job Title Placeholder',
                'placeholder_institution' => 'School/Institution Placeholder',
                'placeholder_message' => 'Message Placeholder',
            ] as $field => $label)
                <div class="admin-form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="text" id="{{ $field }}" name="{{ $field }}" class="admin-form-control"
                        value="{{ old($field, $settings->{$field}) }}">
                </div>
            @endforeach

            <h3 class="admin-form-subheading">Social Section</h3>
            <div class="admin-form-group">
                <label for="social_section_title">“Stay Connected” Heading</label>
                <input type="text" id="social_section_title" name="social_section_title" class="admin-form-control"
                    value="{{ old('social_section_title', $settings->social_section_title) }}">
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
