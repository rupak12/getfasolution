@extends('admin.layouts.app')

@section('title', $section->label().' — '.$page->title)
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        @foreach ($breadcrumbs as $crumb)
            @if ($crumb->id === $page->id)
                <a href="{{ route('admin.pages.show', $crumb) }}">{{ $crumb->title }}</a>
            @elseif (! $crumb->is_group)
                <a href="{{ route('admin.pages.show', $crumb) }}">{{ $crumb->title }}</a>
            @else
                <span class="admin-breadcrumb-muted">{{ $crumb->title }}</span>
            @endif
        @endforeach
        <span>{{ $section->label() }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>{{ $section->label() }}</h2>
                <p class="admin-card-subtitle">{{ $page->title }} &middot; {{ $section->key }}</p>
            </div>
            <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back to Sections</a>
        </div>

        <form action="{{ route('admin.pages.sections.update', [$page, $section]) }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            @if (! empty($schema['description']))
                <p class="admin-section-desc">{{ $schema['description'] }}</p>
            @endif

            @if ($page->slug === 'webinar' && $section->key === 'sessions')
                @include('admin.pages.partials.webinar-sessions-editor', [
                    'content' => $content,
                ])
            @elseif ($page->slug === 'get-started' && $section->key === 'started')
                @include('admin.pages.partials.get-started-form-editor', [
                    'content' => $content,
                    'schema' => $schema,
                    'routes' => $routes,
                ])
            @else
                @foreach ($schema['fields'] ?? [] as $fieldName => $field)
                    @include('admin.pages.partials.field', [
                        'fieldName' => $fieldName,
                        'field' => $field,
                        'value' => $content[$fieldName] ?? null,
                        'prefix' => 'content',
                        'routes' => $routes,
                    ])
                @endforeach
            @endif

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary">Save Section</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin-pages.js') }}"></script>
@endpush
