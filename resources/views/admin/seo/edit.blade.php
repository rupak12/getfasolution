@extends('admin.layouts.app')

@section('title', $entry['label'].' — SEO Settings')
@section('page_title', 'SEO Settings')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.seo.index') }}">SEO Settings</a>
        <span>{{ $entry['label'] }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>{{ $entry['label'] }}</h2>
                <p class="admin-card-subtitle">Route: {{ $entry['route'] }}</p>
            </div>
            <a href="{{ route('admin.seo.index') }}" class="admin-btn admin-btn-secondary">Back to Pages</a>
        </div>

        <section class="admin-seo-preview">
            <h3>Current Live Preview</h3>
            <p class="section-desc">This is what search engines and social platforms see in the page head right now.</p>
            <div class="admin-seo-preview-box">
                <div><strong>&lt;title&gt;</strong> {{ $resolved['meta_title'] }}</div>
                <div><strong>meta description</strong> {{ $resolved['meta_description'] ?: '—' }}</div>
                @if ($resolved['meta_keywords'])
                    <div><strong>meta keywords</strong> {{ $resolved['meta_keywords'] }}</div>
                @endif
                <div><strong>robots</strong> {{ $resolved['meta_robots'] }}</div>
                <div><strong>canonical</strong> {{ $resolved['canonical_url'] ?: '—' }}</div>
                <div><strong>og:title</strong> {{ $resolved['og_title'] }}</div>
                <div><strong>og:description</strong> {{ $resolved['og_description'] ?: '—' }}</div>
                @if ($resolved['og_image_url'])
                    <div class="admin-seo-preview-image">
                        <strong>og:image</strong>
                        <img src="{{ $resolved['og_image_url'] }}" alt="Open Graph preview">
                    </div>
                @endif
                <div><strong>twitter:card</strong> {{ $resolved['twitter_card'] }}</div>
                <div><strong>twitter:title</strong> {{ $resolved['twitter_title'] }}</div>
            </div>
        </section>

        <form action="{{ route('admin.seo.update', $slug) }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <section class="admin-panel admin-form-section">
                <h2>Basic SEO</h2>

                <div class="admin-form-group">
                    <label for="meta_title">Meta Title</label>
                    <input id="meta_title" type="text" name="meta_title" class="admin-form-control"
                        value="{{ old('meta_title', $values['meta_title'] ?? '') }}" required maxlength="200">
                    @if ($entry['route'] === 'team.member')
                        <small class="admin-help">Use <code>{member_name}</code> for the team member's name.</small>
                    @endif
                </div>

                <div class="admin-form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="admin-form-control admin-textarea" rows="3"
                        required maxlength="500">{{ old('meta_description', $values['meta_description'] ?? '') }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input id="meta_keywords" type="text" name="meta_keywords" class="admin-form-control"
                        value="{{ old('meta_keywords', $values['meta_keywords'] ?? '') }}" maxlength="500"
                        placeholder="financial aid, compliance, higher education">
                </div>

                <div class="admin-form-group">
                    <label for="meta_robots">Robots</label>
                    <select id="meta_robots" name="meta_robots" class="admin-form-control">
                        @foreach (['index, follow', 'index, nofollow', 'noindex, follow', 'noindex, nofollow'] as $robots)
                            <option value="{{ $robots }}" @selected(old('meta_robots', $values['meta_robots'] ?? '') === $robots)>{{ $robots }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-form-group">
                    <label for="canonical_url">Canonical URL (optional)</label>
                    <input id="canonical_url" type="url" name="canonical_url" class="admin-form-control"
                        value="{{ old('canonical_url', $values['canonical_url'] ?? '') }}"
                        placeholder="Leave blank to use the page URL automatically">
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Open Graph (Facebook / LinkedIn)</h2>

                <div class="admin-form-group">
                    <label for="og_title">OG Title</label>
                    <input id="og_title" type="text" name="og_title" class="admin-form-control"
                        value="{{ old('og_title', $values['og_title'] ?? '') }}" maxlength="200"
                        placeholder="Leave blank to use Meta Title">
                </div>

                <div class="admin-form-group">
                    <label for="og_description">OG Description</label>
                    <textarea id="og_description" name="og_description" class="admin-form-control admin-textarea" rows="3"
                        maxlength="500" placeholder="Leave blank to use Meta Description">{{ old('og_description', $values['og_description'] ?? '') }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label>OG Image</label>
                    @include('admin.seo.partials.image-field', [
                        'inputName' => 'og_image',
                        'removeName' => 'og_image_remove',
                        'value' => $values['og_image'] ?? null,
                    ])
                </div>

                <div class="admin-form-group">
                    <label for="og_type">OG Type</label>
                    <select id="og_type" name="og_type" class="admin-form-control">
                        @foreach (['website', 'article'] as $type)
                            <option value="{{ $type }}" @selected(old('og_type', $values['og_type'] ?? 'website') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </section>

            <section class="admin-panel admin-form-section">
                <h2>Twitter / X</h2>

                <div class="admin-form-group">
                    <label for="twitter_card">Twitter Card Type</label>
                    <select id="twitter_card" name="twitter_card" class="admin-form-control">
                        <option value="summary_large_image" @selected(old('twitter_card', $values['twitter_card'] ?? '') === 'summary_large_image')>Summary with large image</option>
                        <option value="summary" @selected(old('twitter_card', $values['twitter_card'] ?? '') === 'summary')>Summary</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label for="twitter_title">Twitter Title</label>
                    <input id="twitter_title" type="text" name="twitter_title" class="admin-form-control"
                        value="{{ old('twitter_title', $values['twitter_title'] ?? '') }}" maxlength="200"
                        placeholder="Leave blank to use OG Title">
                </div>

                <div class="admin-form-group">
                    <label for="twitter_description">Twitter Description</label>
                    <textarea id="twitter_description" name="twitter_description" class="admin-form-control admin-textarea" rows="3"
                        maxlength="500" placeholder="Leave blank to use OG Description">{{ old('twitter_description', $values['twitter_description'] ?? '') }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label>Twitter Image</label>
                    @include('admin.seo.partials.image-field', [
                        'inputName' => 'twitter_image',
                        'removeName' => 'twitter_image_remove',
                        'value' => $values['twitter_image'] ?? null,
                    ])
                    <small class="admin-help">Leave blank to use the OG image.</small>
                </div>
            </section>

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
                <button type="submit" class="admin-btn admin-btn-primary">Save SEO Settings</button>
            </div>
        </form>
    </div>
@endsection
