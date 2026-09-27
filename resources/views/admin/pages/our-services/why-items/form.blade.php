@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Edit' : 'Add').' Why Item')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <a href="{{ route('admin.pages.our-services.why-items.index') }}">Why Choose Items</a>
        <span>{{ $item->exists ? 'Edit' : 'Add' }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2>{{ $item->exists ? 'Edit Why Item' : 'Add Why Item' }}</h2>
        </div>

        <form action="{{ $item->exists ? route('admin.pages.our-services.why-items.update', $item) : route('admin.pages.our-services.why-items.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @if ($item->exists)
                @method('PUT')
            @endif

            <div class="admin-form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" min="0" class="admin-form-control"
                    value="{{ old('sort_order', $item->sort_order) }}">
            </div>
            <div class="admin-form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="admin-form-control"
                    value="{{ old('title', $item->title) }}">
            </div>
            <div class="admin-form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" class="admin-form-control admin-textarea">{{ old('description', $item->description) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active))>
                    Active
                </label>
            </div>

            @include('admin.pages.partials.image-field', [
                'inputName' => 'icon',
                'value' => $item->icon,
            ])
            @if ($item->icon)
                <div class="admin-form-group">
                    <label>
                        <input type="checkbox" name="remove_icon" value="1">
                        Remove current icon
                    </label>
                </div>
            @endif

            <button type="submit" class="admin-btn admin-btn-primary">Save Item</button>
        </form>
    </div>
@endsection
