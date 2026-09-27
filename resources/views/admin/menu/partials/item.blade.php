@php
    $isChild = $isChild ?? false;
@endphp

<li class="menu-sortable-item" data-id="{{ $item->id }}">
    <div class="menu-item-row {{ $isChild ? 'is-child' : 'is-parent' }}">
        <span class="menu-drag-handle" title="Drag to reorder">&#9776;</span>

        <div class="menu-item-main">
            <strong>{{ $item->title }}</strong>
            <span class="menu-item-link">
                @if ($item->route_name)
                    Route: {{ $item->route_name }}@if($item->url_fragment)#{{ $item->url_fragment }}@endif
                @else
                    URL: {{ $item->custom_url ?: '#' }}
                @endif
            </span>
        </div>

        <div class="menu-item-actions">
            <span class="menu-status {{ $item->is_active ? 'is-active' : 'is-inactive' }}">
                {{ $item->is_active ? 'Active' : 'Hidden' }}
            </span>
            <button type="button" class="admin-btn admin-btn-secondary menu-edit-toggle">Edit</button>
            <form action="{{ route('admin.menu.destroy', $item) }}" method="POST"
                onsubmit="return confirm('Delete this menu item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="menu-edit-panel">
        <form action="{{ route('admin.menu.update', $item) }}" method="POST" class="menu-edit-form">
            @csrf
            @method('PUT')

            <div class="admin-form-row-inline">
                <div class="admin-form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="admin-form-control" value="{{ $item->title }}" required>
                </div>
                <div class="admin-form-group">
                    <label>Page Route</label>
                    <select name="route_name" class="admin-form-control">
                        <option value="">Dropdown / Custom URL</option>
                        @foreach ($routes as $routeKey => $routeLabel)
                            <option value="{{ $routeKey }}" @selected($item->route_name === $routeKey)>{{ $routeLabel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="admin-form-row-inline">
                <div class="admin-form-group">
                    <label>URL Fragment (#section)</label>
                    <input type="text" name="url_fragment" class="admin-form-control"
                        value="{{ $item->url_fragment }}" placeholder="faqs">
                </div>
                <div class="admin-form-group">
                    <label>Custom URL (for dropdown parent use #)</label>
                    <input type="text" name="custom_url" class="admin-form-control"
                        value="{{ $item->custom_url }}" placeholder="#">
                </div>
            </div>

            <label class="admin-checkbox">
                <input type="checkbox" name="is_active" value="1" @checked($item->is_active)>
                Visible in header
            </label>

            <button type="submit" class="admin-btn admin-btn-primary">Update Item</button>
        </form>
    </div>

    @if (! $isChild)
        <ul class="menu-sortable menu-sortable-children">
            @foreach ($item->children as $child)
                @include('admin.menu.partials.item', ['item' => $child, 'isChild' => true])
            @endforeach
        </ul>
    @endif
</li>
