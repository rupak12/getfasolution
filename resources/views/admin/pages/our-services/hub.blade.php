@extends('admin.layouts.app')

@php
    $homePage = \App\Models\Page::query()->where('slug', 'home')->first();
    $homeFaqSection = $homePage
        ? \App\Models\PageSection::query()->where('page_id', $homePage->id)->where('key', 'faq')->first()
        : null;
@endphp

@section('title', $page->title.' — Page Editor')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <span>{{ $page->title }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>{{ $page->title }}</h2>
                <p class="admin-card-subtitle">Content is stored in dedicated <code>our_services_*</code> tables. FAQ is shared with the Home page.</p>
            </div>
            @if ($page->route_name && Route::has($page->route_name))
                <a href="{{ route($page->route_name) }}" target="_blank" rel="noopener" class="admin-btn admin-btn-secondary">
                    View Page
                </a>
            @endif
        </div>

        <div class="pages-section-list">
            <a href="{{ route('admin.pages.our-services.settings.edit') }}" class="pages-section-card">
                <div>
                    <h3>Page &amp; Section Settings</h3>
                    <p>Banner, core services intro, and “Why Choose” heading</p>
                </div>
                <span class="pages-section-edit">Edit &rarr;</span>
            </a>
            <a href="{{ route('admin.pages.our-services.cards.index') }}" class="pages-section-card">
                <div>
                    <h3>Service Cards</h3>
                    <p>Core service blocks — add, edit, or remove</p>
                </div>
                <span class="pages-section-edit">Manage &rarr;</span>
            </a>
            <a href="{{ route('admin.pages.our-services.why-items.index') }}" class="pages-section-card">
                <div>
                    <h3>Why Choose Items</h3>
                    <p>Icon grid below service cards</p>
                </div>
                <span class="pages-section-edit">Manage &rarr;</span>
            </a>
            @if ($homePage && $homeFaqSection)
                <a href="{{ route('admin.pages.sections.edit', [$homePage, $homeFaqSection]) }}" class="pages-section-card">
                    <div>
                        <h3>FAQ Section (shared with Home)</h3>
                        <p>Same FAQ content on Home and Our Services pages</p>
                    </div>
                    <span class="pages-section-edit">Edit &rarr;</span>
                </a>
            @endif
        </div>
    </div>
@endsection
