@php
    $inputName = 'content[items]';
    $rows = is_array($content['items'] ?? null) ? $content['items'] : [];
    $count = count($rows);
@endphp

<div class="admin-repeater admin-webinar-manager" data-repeater="{{ $inputName }}">
    <div class="admin-webinar-manager-bar">
        <div class="admin-webinar-manager-bar-start">
            <span class="admin-webinar-count-badge">{{ $count }} {{ str('webinar')->plural($count) }}</span>
            <input type="search" class="admin-form-control admin-webinar-search" placeholder="Search by title or slug…" aria-label="Search webinars">
        </div>
        <button type="button" class="admin-btn admin-btn-primary admin-repeater-add" data-target="{{ $inputName }}">+ Add webinar</button>
    </div>

    <div class="admin-webinar-list" data-repeater-items="{{ $inputName }}">
        @forelse ($rows as $index => $row)
            @include('admin.pages.partials.webinar-sessions-card', [
                'index' => $index,
                'row' => $row,
            ])
        @empty
            <p class="admin-webinar-empty">No webinars yet. Click <strong>Add webinar</strong> to create one.</p>
            @include('admin.pages.partials.webinar-sessions-card', [
                'index' => 0,
                'row' => [],
            ])
        @endforelse
    </div>

    <template class="admin-repeater-template" data-template="{{ $inputName }}">
        @include('admin.pages.partials.webinar-sessions-card', [
            'index' => '__INDEX__',
            'row' => [],
        ])
    </template>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const list = document.querySelector('.admin-webinar-list');
    const manager = document.querySelector('.admin-webinar-manager');
    if (!list || !manager) return;

    const searchInput = manager.querySelector('.admin-webinar-search');
    const countBadge = manager.querySelector('.admin-webinar-count-badge');

    const updateCount = () => {
        const total = list.querySelectorAll('.admin-webinar-item').length;
        if (countBadge) {
            countBadge.textContent = `${total} webinar${total === 1 ? '' : 's'}`;
        }
    };

    const syncItemSummary = (item) => {
        const titleInput = item.querySelector('.admin-webinar-title-input');
        const slugInput = item.querySelector('.admin-webinar-slug-input');
        const videoInput = item.querySelector('.admin-webinar-video-input');
        const titleEl = item.querySelector('.admin-webinar-item-title');
        const slugEl = item.querySelector('.admin-webinar-slug-preview');

        const index = [...list.querySelectorAll('.admin-webinar-item')].indexOf(item) + 1;
        const title = titleInput?.value.trim() ?? '';
        const slug = slugInput?.value.trim() ?? '';
        const hasVideo = (videoInput?.value.trim() ?? '') !== '';

        if (titleEl) {
            titleEl.textContent = title !== '' ? title : `Untitled webinar ${index}`;
        }

        if (slugEl) {
            const slugPart = slug !== '' ? slug : 'No URL slug yet';
            slugEl.textContent = `${slugPart} · ${hasVideo ? 'Video linked' : 'No video URL'}`;
        }

        item.dataset.search = `${title} ${slug}`.toLowerCase();
    };

    const closeAll = () => {
        list.querySelectorAll('.admin-webinar-item').forEach((item) => {
            item.classList.add('is-collapsed');
        });
    };

    const openItem = (item) => {
        closeAll();
        item.classList.remove('is-collapsed');
        item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        item.querySelector('.admin-webinar-title-input')?.focus();
    };

    list.querySelectorAll('.admin-webinar-item').forEach((item) => syncItemSummary(item));

    list.addEventListener('click', (event) => {
        const editBtn = event.target.closest('.admin-webinar-edit-btn');
        const doneBtn = event.target.closest('.admin-webinar-done-btn');

        if (editBtn) {
            openItem(editBtn.closest('.admin-webinar-item'));
            return;
        }

        if (doneBtn) {
            doneBtn.closest('.admin-webinar-item')?.classList.add('is-collapsed');
        }
    });

    list.addEventListener('input', (event) => {
        if (event.target.matches('.admin-webinar-title-input, .admin-webinar-slug-input, .admin-webinar-video-input')) {
            syncItemSummary(event.target.closest('.admin-webinar-item'));
        }
    });

    searchInput?.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();
        list.querySelectorAll('.admin-webinar-item').forEach((item) => {
            const haystack = item.dataset.search ?? '';
            item.classList.toggle('is-filtered-out', query !== '' && !haystack.includes(query));
        });
    });

    const observer = new MutationObserver(() => {
        list.querySelectorAll('.admin-webinar-item').forEach((item) => syncItemSummary(item));
        updateCount();
        list.querySelector('.admin-webinar-empty')?.remove();
    });
    observer.observe(list, { childList: true });

    manager.querySelector('.admin-repeater-add')?.addEventListener('click', () => {
        setTimeout(() => {
            const last = list.querySelector('.admin-webinar-item:last-child');
            if (last) {
                syncItemSummary(last);
                openItem(last);
            }
        }, 0);
    });
});
</script>
@endpush
