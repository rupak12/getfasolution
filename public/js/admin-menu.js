document.addEventListener('DOMContentLoaded', () => {
    const rootList = document.getElementById('menu-sortable-root');
    const statusEl = document.getElementById('menu-save-status');
    const reorderUrl = rootList.dataset.reorderUrl;

    if (!rootList || !reorderUrl || typeof Sortable === 'undefined') {
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    document.querySelectorAll('.menu-edit-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const panel = button.closest('.menu-sortable-item')?.querySelector('.menu-edit-panel');
            panel?.classList.toggle('is-open');
        });
    });

    const serializeList = (listEl) => Array.from(listEl.children)
        .filter((item) => item.classList.contains('menu-sortable-item'))
        .map((item) => {
            const childList = item.querySelector(':scope > .menu-sortable-children');
            return {
                id: Number(item.dataset.id),
                children: childList ? serializeList(childList) : [],
            };
        });

    const showStatus = (message, isError = false) => {
        if (!statusEl) {
            return;
        }

        statusEl.textContent = message;
        statusEl.classList.toggle('is-error', isError);
    };

    const saveOrder = async () => {
        showStatus('Saving menu order...');

        try {
            const response = await fetch(reorderUrl, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    items: serializeList(rootList),
                }),
            });

            if (!response.ok) {
                throw new Error('Failed to save menu order.');
            }

            showStatus('Menu order saved successfully.');
        } catch (error) {
            showStatus(error.message || 'Unable to save menu order.', true);
        }
    };

    document.querySelectorAll('.menu-sortable').forEach((listEl) => {
        Sortable.create(listEl, {
            group: 'header-menu',
            handle: '.menu-drag-handle',
            animation: 180,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            onEnd: saveOrder,
        });
    });
});
