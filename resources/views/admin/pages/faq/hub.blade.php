@extends('admin.layouts.app')

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
                <p class="admin-card-subtitle">Manage banner, intro, and FAQ items in dedicated tables.</p>
            </div>
            @if ($page->route_name && Route::has($page->route_name))
                <a href="{{ route($page->route_name) }}" target="_blank" rel="noopener" class="admin-btn admin-btn-secondary">
                    View Page
                </a>
            @endif
        </div>

        <div class="pages-section-list">
            <a href="{{ route('admin.pages.faq.settings.edit') }}" class="pages-section-card">
                <div>
                    <h3>Page &amp; Intro Settings</h3>
                    <p>Banner and top intro section with CTA button</p>
                </div>
                <span class="pages-section-edit">Edit &rarr;</span>
            </a>
            <a href="{{ route('admin.pages.faq.items.index') }}" class="pages-section-card">
                <div>
                    <h3>FAQ Items</h3>
                    <p>Accordion questions — full create, edit, delete</p>
                </div>
                <span class="pages-section-edit">Manage &rarr;</span>
            </a>
        </div>
    </div>
@endsection
