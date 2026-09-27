@extends('admin.layouts.app')

@section('title', 'Service Cards')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Service Cards</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Service Cards</h2>
                <p class="admin-card-subtitle"><code>our_services_cards</code></p>
            </div>
            <div class="admin-card-actions">
                <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
                <a href="{{ route('admin.pages.our-services.cards.create') }}" class="admin-btn admin-btn-primary">Add Card</a>
            </div>
        </div>

        @if ($cards->isEmpty())
            <p class="admin-empty">No service cards yet.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <td>{{ $card->sort_order }}</td>
                                <td>{{ $card->title }}</td>
                                <td>{{ $card->is_active ? 'Yes' : 'No' }}</td>
                                <td class="admin-table-actions">
                                    <a href="{{ route('admin.pages.our-services.cards.edit', $card) }}" class="admin-btn admin-btn-secondary admin-btn-sm">Edit</a>
                                    <form action="{{ route('admin.pages.our-services.cards.destroy', $card) }}" method="POST"
                                        onsubmit="return confirm('Delete this service card?');">
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
