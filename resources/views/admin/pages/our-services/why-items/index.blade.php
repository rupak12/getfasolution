@extends('admin.layouts.app')

@section('title', 'Why Choose Items')
@section('page_title', 'Page Editor')

@section('content')
    <nav class="admin-breadcrumb">
        <a href="{{ route('admin.pages.index') }}">Page Editor</a>
        <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
        <span>Why Choose Items</span>
    </nav>

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Why Choose Items</h2>
                <p class="admin-card-subtitle"><code>our_services_why_items</code></p>
            </div>
            <div class="admin-card-actions">
                <a href="{{ route('admin.pages.show', $page) }}" class="admin-btn admin-btn-secondary">Back</a>
                <a href="{{ route('admin.pages.our-services.why-items.create') }}" class="admin-btn admin-btn-primary">Add Item</a>
            </div>
        </div>

        @if ($items->isEmpty())
            <p class="admin-empty">No items yet.</p>
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
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->sort_order }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                                <td class="admin-table-actions">
                                    <a href="{{ route('admin.pages.our-services.why-items.edit', $item) }}" class="admin-btn admin-btn-secondary admin-btn-sm">Edit</a>
                                    <form action="{{ route('admin.pages.our-services.why-items.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Delete this item?');">
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
