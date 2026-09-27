@extends('admin.layouts.app')

@section('title', 'FAQ Settings')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Page &amp; Intro Settings</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Page &amp; Intro Settings</h2>
                <p class="admin-card-subtitle">Stored in <code>faq_settings</code></p>
            </div>
            <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
        </div>

        <form action="{{ route('admin.pages.faq.settings.update') }}" method="POST" class="admin-form">
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

            <h3 class="admin-form-subheading">Intro Section</h3>
            <div class="admin-form-group">
                <label for="intro_title">Intro Heading</label>
                <input type="text" id="intro_title" name="intro_title" class="admin-form-control"
                    value="{{ old('intro_title', $settings->intro_title) }}">
            </div>
            <div class="admin-form-group">
                <label for="intro_paragraph">Intro Paragraph</label>
                <textarea id="intro_paragraph" name="intro_paragraph" rows="4" class="admin-form-control admin-textarea">{{ old('intro_paragraph', $settings->intro_paragraph) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label for="intro_button_text">Button Text</label>
                <input type="text" id="intro_button_text" name="intro_button_text" class="admin-form-control"
                    value="{{ old('intro_button_text', $settings->intro_button_text) }}">
            </div>
            <div class="admin-form-group">
                <label for="intro_button_route">Button Link (route name)</label>
                <select id="intro_button_route" name="intro_button_route" class="admin-form-control">
                    <option value="">— Select page —</option>
                    @foreach ($routes as $routeName => $routeLabel)
                        <option value="{{ $routeName }}" @selected(old('intro_button_route', $settings->intro_button_route) === $routeName)>
                            {{ $routeLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
