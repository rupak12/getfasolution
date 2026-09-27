@extends('admin.layouts.app')

@section('title', 'Menu Settings')
@section('page_title', 'Menu Settings')

@section('content')
    <div class="admin-panel admin-form-section menu-settings-intro">
        <h2>Header Menu Manager</h2>
        <p class="section-desc">Drag and drop menu items to change their order in the website header. Drag submenu items
            between parent menus or reorder them inside a dropdown.</p>
        <p id="menu-save-status" class="menu-save-status" aria-live="polite"></p>
    </div>

    <div class="admin-settings-grid menu-settings-grid">
        <section class="admin-panel admin-form-section">
            <h2>Add Menu Item</h2>

            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf

                <div class="admin-form-group">
                    <label for="title">Title</label>
                    <input id="title" type="text" name="title" class="admin-form-control" required maxlength="150">
                </div>

                <div class="admin-form-group">
                    <label for="parent_id">Parent Menu (optional)</label>
                    <select id="parent_id" name="parent_id" class="admin-form-control">
                        <option value="">Top Level Menu</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-form-group">
                    <label for="route_name">Page Route</label>
                    <select id="route_name" name="route_name" class="admin-form-control">
                        <option value="">Dropdown / Custom URL</option>
                        @foreach ($routes as $routeKey => $routeLabel)
                            <option value="{{ $routeKey }}">{{ $routeLabel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-form-row-inline">
                    <div class="admin-form-group">
                        <label for="url_fragment">URL Fragment</label>
                        <input id="url_fragment" type="text" name="url_fragment" class="admin-form-control"
                            placeholder="faqs">
                    </div>
                    <div class="admin-form-group">
                        <label for="custom_url">Custom URL</label>
                        <input id="custom_url" type="text" name="custom_url" class="admin-form-control" placeholder="#">
                    </div>
                </div>

                <label class="admin-checkbox">
                    <input type="checkbox" name="is_active" value="1" checked>
                    Visible in header
                </label>

                <button type="submit" class="admin-btn admin-btn-primary">Add Menu Item</button>
            </form>
        </section>

        <section class="admin-panel admin-form-section">
            <h2>Drag &amp; Drop Menu Order</h2>
            <p class="section-desc">Changes save automatically when you drop an item.</p>

            <ul id="menu-sortable-root" class="menu-sortable" data-reorder-url="{{ route('admin.menu.reorder') }}">
                @foreach ($menuItems as $item)
                    @include('admin.menu.partials.item', ['item' => $item])
                @endforeach
            </ul>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <script src="{{ asset('js/admin-menu.js') }}?v=1"></script>
@endpush
