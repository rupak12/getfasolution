@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Edit' : 'Add').' FAQ Item')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <a href="{{ route('admin.pages.faq.items.index') }}">FAQ Items</a>
        <span>{{ $item->exists ? 'Edit' : 'Add' }}</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2>{{ $item->exists ? 'Edit FAQ Item' : 'Add FAQ Item' }}</h2>
        </div>

        <form action="{{ $item->exists ? route('admin.pages.faq.items.update', $item) : route('admin.pages.faq.items.store') }}"
            method="POST" class="admin-form">
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
                <label for="question">Question</label>
                <input type="text" id="question" name="question" class="admin-form-control" required
                    value="{{ old('question', $item->question) }}">
            </div>
            <div class="admin-form-group">
                <label for="answer">Answer (paragraphs separated by a blank line)</label>
                <textarea id="answer" name="answer" rows="8" class="admin-form-control admin-textarea">{{ old('answer', $item->answer) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label for="bullets">Bullet Points (one per line, optional)</label>
                <textarea id="bullets" name="bullets" rows="6" class="admin-form-control admin-textarea">{{ old('bullets', $item->bullets) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active))>
                    Active
                </label>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">Save FAQ Item</button>
        </form>
    </div>
@endsection
