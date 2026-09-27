<div class="pages-tree-item" style="--depth: {{ $depth }}">
    <div class="pages-tree-row">
        @if ($page->is_group)
            <div class="pages-tree-group">
                <span class="pages-tree-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                    </svg>
                </span>
                <strong>{{ $page->title }}</strong>
            </div>
        @else
            <a href="{{ route('admin.pages.show', $page) }}" class="pages-tree-link">
                <span class="pages-tree-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" />
                    </svg>
                </span>
                <span>{{ $page->title }}</span>
                @if ($page->route_name)
                    <span class="pages-tree-meta">{{ $page->editorSectionCount() }} sections</span>
                @endif
            </a>
        @endif
    </div>

    @if ($page->children->isNotEmpty())
        <div class="pages-tree-children">
            @foreach ($page->children as $child)
                @include('admin.pages.partials.tree-item', ['page' => $child, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</div>
