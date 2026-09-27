@extends('admin.layouts.app')

@section('title', 'Contact Us Social Cards')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Social Cards</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Social Cards</h2>
                <p class="admin-card-subtitle">Stored in <code>contact_us_social_cards</code></p>
            </div>
            <div class="admin-card-actions">
                <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
                <a href="{{ route('admin.pages.contact-us.social-cards.create') }}" class="admin-btn admin-btn-primary">Add Card</a>
            </div>
        </div>

        @if ($cards->isEmpty())
            <p class="admin-empty">No social cards yet.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <td>{{ $card->sort_order }}</td>
                                <td>{{ $card->title }}</td>
                                <td><a href="{{ $card->url }}" target="_blank" rel="noopener">{{ $card->url }}</a></td>
                                <td>{{ $card->is_active ? 'Yes' : 'No' }}</td>
                                <td class="admin-table-actions">
                                    <a href="{{ route('admin.pages.contact-us.social-cards.edit', $card) }}" class="admin-btn admin-btn-secondary admin-btn-sm">Edit</a>
                                    <form action="{{ route('admin.pages.contact-us.social-cards.destroy', $card) }}" method="POST"
                                        onsubmit="return confirm('Delete this social card?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn-danger admin-btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
