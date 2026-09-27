document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.admin-repeater-add').forEach((button) => {
        button.addEventListener('click', () => {
            const target = button.dataset.target;
            const container = document.querySelector(`[data-repeater-items="${target}"]`);
            const template = document.querySelector(`[data-template="${target}"]`);

            if (!container || !template) {
                return;
            }

            const index = container.querySelectorAll('.admin-repeater-item').length;
            const html = template.innerHTML
                .replace(/__INDEX__/g, String(index))
                .replace(/__NUMBER__/g, String(index + 1));

            container.insertAdjacentHTML('beforeend', html);

            const skipReindex = container.classList.contains('admin-webinar-list');
            if (! skipReindex) {
                reindexRepeater(container);
            }

            const newItem = container.lastElementChild;
            if (newItem?.classList.contains('admin-webinar-item')) {
                newItem.classList.remove('is-collapsed');
            }
        });
    });

    document.addEventListener('click', (event) => {
        const removeButton = event.target.closest('.admin-repeater-remove');

        if (!removeButton) {
            return;
        }

        const item = removeButton.closest('.admin-repeater-item');
        const container = removeButton.closest('[data-repeater-items]');

        if (!item || !container) {
            return;
        }

        item.remove();
        reindexRepeater(container);
    });

    document.querySelectorAll('form.admin-form').forEach((form) => {
        form.addEventListener('submit', () => {
            form.querySelectorAll('[data-repeater-items="content[items]"]').forEach((container) => {
                reindexRepeater(container);
            });
        });
    });
});

function reindexRepeater(container) {
    container.querySelectorAll('.admin-repeater-item').forEach((item, index) => {
        item.dataset.index = String(index);
        const heading = item.querySelector('.admin-repeater-item-header strong');

        if (heading) {
            heading.textContent = `Item ${index + 1}`;
        }

        const titleEl = item.querySelector('.admin-webinar-item-title');
        const titleInput = item.querySelector('.admin-webinar-title-input');

        if (titleEl && titleInput) {
            const title = titleInput.value.trim();
            titleEl.textContent = title !== '' ? title : `Untitled webinar ${index + 1}`;
        }

        const numEl = item.querySelector('.admin-webinar-item-num');
        if (numEl) {
            numEl.textContent = String(index + 1);
        }

        item.querySelectorAll('[name]').forEach((input) => {
            if (input.name.includes('content[items]')) {
                input.name = input.name.replace(/content\[items\]\[\d+\]/, `content[items][${index}]`);
            } else {
                input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            }
        });

        item.querySelectorAll('[id^="webinar_"]').forEach((input) => {
            if (input.id) {
                input.id = input.id.replace(/webinar_\d+_/, `webinar_${index}_`);
            }
        });

        item.querySelectorAll('label[for^="webinar_"]').forEach((label) => {
            const forAttr = label.getAttribute('for');
            if (forAttr) {
                label.setAttribute('for', forAttr.replace(/webinar_\d+_/, `webinar_${index}_`));
            }
        });
    });
}
