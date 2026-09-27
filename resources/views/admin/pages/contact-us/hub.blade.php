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
                <p class="admin-card-subtitle">Manage banner, form labels, and social cards in dedicated tables.</p>
            </div>
            @if ($page->route_name && Route::has($page->route_name))
                <a href="{{ route($page->route_name) }}" target="_blank" rel="noopener" class="admin-btn admin-btn-secondary">
                    View Page
                </a>
            @endif
        </div>

        <div class="pages-section-list">
            <a href="{{ route('admin.pages.contact-us.settings.edit') }}" class="pages-section-card">
                <div>
                    <h3>Page &amp; Form Settings</h3>
                    <p>Banner, submit button, and field placeholders</p>
                </div>
                <span class="pages-section-edit">Edit &rarr;</span>
            </a>
            <a href="{{ route('admin.pages.contact-us.social-cards.index') }}" class="pages-section-card">
                <div>
                    <h3>Social Cards</h3>
                    <p>Stay Connected cards — add, edit, or remove</p>
                </div>
                <span class="pages-section-edit">Manage &rarr;</span>
            </a>
        </div>
    </div>
@endsection
