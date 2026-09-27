@extends('admin.layouts.app')

@section('title', 'Our Services Settings')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Page Settings</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Page &amp; Section Settings</h2>
            <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
        </div>

        <form action="{{ route('admin.pages.our-services.settings.update') }}" method="POST" class="admin-form">
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

            <h3 class="admin-form-subheading">Core Services</h3>
            <div class="admin-form-group">
                <label for="core_section_title">Section Title</label>
                <input type="text" id="core_section_title" name="core_section_title" class="admin-form-control"
                    value="{{ old('core_section_title', $settings->core_section_title) }}">
            </div>
            <div class="admin-form-group">
                <label for="core_section_intro">Intro Paragraph</label>
                <textarea id="core_section_intro" name="core_section_intro" rows="4" class="admin-form-control admin-textarea">{{ old('core_section_intro', $settings->core_section_intro) }}</textarea>
            </div>

            <h3 class="admin-form-subheading">Why Choose Section</h3>
            <div class="admin-form-group">
                <label for="why_section_title">Section Title</label>
                <input type="text" id="why_section_title" name="why_section_title" class="admin-form-control"
                    value="{{ old('why_section_title', $settings->why_section_title) }}">
            </div>
            <div class="admin-form-group">
                <label for="why_cta_button_text">CTA Button Text</label>
                <input type="text" id="why_cta_button_text" name="why_cta_button_text" class="admin-form-control"
                    value="{{ old('why_cta_button_text', $settings->why_cta_button_text) }}">
            </div>
            <div class="admin-form-group">
                <label for="why_cta_button_route">CTA Button Link</label>
                <select id="why_cta_button_route" name="why_cta_button_route" class="admin-form-control">
                    <option value="">— Select page —</option>
                    @foreach ($routes as $routeName => $routeLabel)
                        <option value="{{ $routeName }}" @selected(old('why_cta_button_route', $settings->why_cta_button_route) === $routeName)>
                            {{ $routeLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
