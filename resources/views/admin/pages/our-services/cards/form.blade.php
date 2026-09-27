@extends('admin.layouts.app')

@section('title', ($card->exists ? 'Edit' : 'Add').' Service Card')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <a href="{{ route('admin.pages.our-services.cards.index') }}">Service Cards</a>
        <span>{{ $card->exists ? 'Edit' : 'Add' }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2>{{ $card->exists ? 'Edit Service Card' : 'Add Service Card' }}</h2>
        </div>

        <form action="{{ $card->exists ? route('admin.pages.our-services.cards.update', $card) : route('admin.pages.our-services.cards.store') }}"
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
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="admin-form-control"
                    value="{{ old('title', $card->title) }}">
            </div>
            <div class="admin-form-group">
                <label for="intro">Intro Paragraph</label>
                <textarea id="intro" name="intro" rows="4" class="admin-form-control admin-textarea">{{ old('intro', $card->intro) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label for="bullets">Bullet Points (one per line)</label>
                <textarea id="bullets" name="bullets" rows="6" class="admin-form-control admin-textarea">{{ old('bullets', $card->bullets) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label for="button_text">Button Text</label>
                <input type="text" id="button_text" name="button_text" class="admin-form-control"
                    value="{{ old('button_text', $card->button_text) }}">
            </div>
            <div class="admin-form-group">
                <label for="button_route">Button Link</label>
                <select id="button_route" name="button_route" class="admin-form-control">
                    <option value="">— Select page —</option>
                    @foreach ($routes as $routeName => $routeLabel)
                        <option value="{{ $routeName }}" @selected(old('button_route', $card->button_route) === $routeName)>
                            {{ $routeLabel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label for="image_alt">Image Alt Text</label>
                <input type="text" id="image_alt" name="image_alt" class="admin-form-control"
                    value="{{ old('image_alt', $card->image_alt) }}">
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
