document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const dropdownParents = document.querySelectorAll('.has-dropdown');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            const isOpen = mainNav.classList.toggle('is-open');
            menuToggle.classList.toggle('is-active', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    dropdownParents.forEach((parent) => {
        const link = parent.querySelector(':scope > a');

        if (!link) {
            return;
        }

        link.addEventListener('click', (event) => {
            if (window.innerWidth <= 1024) {
                event.preventDefault();
                parent.classList.toggle('is-open');
            }
        });
    });

    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach((item) => {
        const btn = item.querySelector('.faq-question');
        const toggle = item.querySelector('.faq-toggle');

        if (!btn || !toggle) {
            return;
        }

        btn.addEventListener('click', () => {
            const isOpen = item.classList.contains('is-open');

            faqItems.forEach((faqItem) => {
                faqItem.classList.remove('is-open');

                const faqToggle = faqItem.querySelector('.faq-toggle');

                if (faqToggle) {
                    faqToggle.textContent = '+';
                }
            });

            if (!isOpen) {
                item.classList.add('is-open');
                toggle.textContent = '−';
            }
        });
    });
});
