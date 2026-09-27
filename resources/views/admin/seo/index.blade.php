@extends('admin.layouts.app')

@section('title', 'SEO Settings')
@section('page_title', 'SEO Settings')

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>SEO Settings</h2>
                <p class="admin-card-subtitle">Manage meta tags, Open Graph, and Twitter cards for every public page.</p>
            </div>
        </div>

        <div class="pages-section-list">
            @foreach ($entries as $entry)
                <a href="{{ route('admin.seo.edit', $entry['slug']) }}" class="pages-section-row">
                    <div class="pages-section-info">
                        <strong>{{ $entry['label'] }}</strong>
                        <span class="pages-tree-meta">{{ $entry['route'] }}</span>
                    </div>
                    <div class="pages-section-preview">
                        <span class="seo-preview-title">{{ $entry['meta_title'] }}</span>
                        <span class="seo-preview-desc">{{ \Illuminate\Support\Str::limit($entry['meta_description'], 90) }}</span>
                    </div>
                    @if ($entry['has_custom'])
                        <span class="admin-badge admin-badge-success">Custom</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endsection
