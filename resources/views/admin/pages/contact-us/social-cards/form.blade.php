@extends('admin.layouts.app')

@section('title', ($card->exists ? 'Edit' : 'Add').' Social Card')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <a href="{{ route('admin.pages.contact-us.social-cards.index') }}">Social Cards</a>
        <span>{{ $card->exists ? 'Edit' : 'Add' }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2>{{ $card->exists ? 'Edit Social Card' : 'Add Social Card' }}</h2>
        </div>

        <form action="{{ $card->exists ? route('admin.pages.contact-us.social-cards.update', $card) : route('admin.pages.contact-us.social-cards.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @if ($card->exists)
                @method('PUT')
            @endif

            <div class="admin-form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" min="0" class="admin-form-control"
                    value="{{ old('sort_order', $card->sort_order) }}">
            </div>
            <div class="admin-form-group">
                <label for="title">Card Title</label>
                <input type="text" id="title" name="title" class="admin-form-control"
                    value="{{ old('title', $card->title) }}">
            </div>
            <div class="admin-form-group">
                <label for="url">Link URL</label>
                <input type="url" id="url" name="url" class="admin-form-control"
                    value="{{ old('url', $card->url) }}">
            </div>
            <div class="admin-form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $card->is_active))>
                    Active
                </label>
            </div>

            @include('admin.pages.partials.image-field', [
                'inputName' => 'image',
                'value' => $card->image,
            ])
            @if ($card->image)
                <div class="admin-form-group">
                    <label>
                        <input type="checkbox" name="remove_image" value="1">
                        Remove current image
                    </label>
                </div>
            @endif

            <button type="submit" class="admin-btn admin-btn-primary">Save Card</button>
        </form>
    </div>
@endsection
