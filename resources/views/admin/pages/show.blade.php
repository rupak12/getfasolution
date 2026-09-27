@extends('admin.layouts.app')

@section('title', $page->title.' — Page Editor')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        @foreach ($breadcrumbs as $crumb)
            @if ($crumb->id === $page->id)
                <span>{{ $crumb->title }}</span>
            @elseif (! $crumb->is_group)
                <a href="{{ route('admin.pages.show', $crumb) }}">{{ $crumb->title }}</a>
            @else
                <span class="admin-breadcrumb-muted">{{ $crumb->title }}</span>
            @endif
        @endforeach
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>{{ $page->title }}</h2>
                <p class="admin-card-subtitle">Select a section below to customize its content.</p>
            </div>
            @if ($page->route_name && Route::has($page->route_name))
                <a href="{{ route($page->route_name) }}" target="_blank" rel="noopener" class="admin-btn admin-btn-secondary">
                    View Page
                </a>
            @endif
        </div>

        <div class="pages-section-list">
            @forelse ($page->sections as $section)
                <a href="{{ route('admin.pages.sections.edit', [$page, $section]) }}" class="pages-section-card">
                    <div>
                        <h3>{{ $section->label() }}</h3>
                        <p>Section key: <code>{{ $section->key }}</code></p>
                    </div>
                    <span class="pages-section-edit">Edit &rarr;</span>
                </a>
            @empty
                <p class="admin-empty">No sections defined for this page yet.</p>
            @endforelse
        </div>
    </div>
@endsection
