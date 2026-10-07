const themeStorageKey = 'admin-theme';

const applyTheme = (theme) => {
    document.documentElement.classList.toggle('dark', theme === 'dark');
    localStorage.setItem(themeStorageKey, theme);
};

const currentTheme = () =>
    document.documentElement.classList.contains('dark') ? 'dark' : 'light';

const closeOpenMenus = (exception) => {
    document.querySelectorAll('[data-menu].open').forEach((menu) => {
        if (menu !== exception) {
            menu.classList.remove('open');
        }
    });
};

const closeOpenMultiselects = (exception) => {
    document.querySelectorAll('[data-multiselect].open').forEach((multiselect) => {
        if (multiselect !== exception) {
            multiselect.classList.remove('open');
        }
    });
};

const updateMultiselectSummary = (root) => {
    const summary = root.querySelector('[data-multiselect-summary]');
    const options = root.querySelectorAll('[data-multiselect-option]');

    if (! (summary instanceof HTMLElement)) {
        return;
    }

    const selectedCount = [...options].filter((option) => option instanceof HTMLInputElement && option.checked).length;

    if (selectedCount === 0) {
        summary.textContent = summary.dataset.placeholder ?? 'Select options';
        return;
    }

    if (options.length > 0 && selectedCount === options.length) {
        summary.textContent = `All ${selectedCount} selected`;
        return;
    }

    summary.textContent = `${selectedCount} selected`;
};

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            applyTheme(currentTheme() === 'dark' ? 'light' : 'dark');
        });
    });

    document.querySelectorAll('[data-menu-toggle]').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            const menu = button.closest('[data-menu]');

            if (! menu) {
                return;
            }

            closeOpenMenus(menu);
            closeOpenMultiselects();
            menu.classList.toggle('open');
        });
    });

    document.querySelector('[data-sidebar-toggle]')?.addEventListener('click', () => {
        document.querySelector('[data-sidebar]')?.classList.toggle('open');
        document.querySelector('[data-sidebar-backdrop]')?.classList.toggle('open');
    });

    document.querySelector('[data-sidebar-backdrop]')?.addEventListener('click', () => {
        document.querySelector('[data-sidebar]')?.classList.remove('open');
        document.querySelector('[data-sidebar-backdrop]')?.classList.remove('open');
    });

    document.querySelectorAll('[data-nav-group-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            button.closest('[data-nav-group]')?.classList.toggle('open');
        });
    });

    document.querySelectorAll('[data-multiselect-toggle]').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            const root = button.closest('[data-multiselect]');

            if (! root) {
                return;
            }

            closeOpenMenus();
            closeOpenMultiselects(root);
            root.classList.toggle('open');
        });
    });

    document.querySelectorAll('[data-multiselect-panel]').forEach((panel) => {
        panel.addEventListener('click', (event) => event.stopPropagation());
    });

    document.querySelectorAll('[data-select-all]').forEach((button) => {
        button.addEventListener('click', () => {
            const root = button.closest('[data-multiselect]');

            if (! root) {
                return;
            }

            root.querySelectorAll('[data-multiselect-option]').forEach((input) => {
                if (input instanceof HTMLInputElement) {
                    input.checked = true;
                }
            });

            updateMultiselectSummary(root);
        });
    });

    document.querySelectorAll('[data-clear-group]').forEach((button) => {
        button.addEventListener('click', () => {
            const root = button.closest('[data-multiselect]');

            document.querySelectorAll(`input[name="${button.dataset.clearGroup}"]`).forEach((input) => {
                if (input instanceof HTMLInputElement) {
                    input.checked = false;
                }
            });

            if (root) {
                updateMultiselectSummary(root);
            }
        });
    });

    document.querySelectorAll('[data-multiselect-option]').forEach((input) => {
        input.addEventListener('change', () => {
            const root = input.closest('[data-multiselect]');

            if (root) {
                updateMultiselectSummary(root);
            }
        });
    });

    document.addEventListener('click', () => {
        closeOpenMenus();
        closeOpenMultiselects();
    });

    const bindBulletRemove = (button) => {
        button.addEventListener('click', () => {
            const row = button.closest('[data-bullet-row]');
            const list = button.closest('[data-bullet-list]');
            const rows = list?.querySelectorAll('[data-bullet-rows] [data-bullet-row]') ?? [];

            if (rows.length <= 1) {
                const input = row?.querySelector('input');

                if (input instanceof HTMLInputElement) {
                    input.value = '';
                }

                return;
            }

            row?.remove();
        });
    };

    document.querySelectorAll('[data-bullet-list]').forEach((list) => {
        list.querySelectorAll('[data-bullet-rows] [data-bullet-remove]').forEach((button) => {
            if (button instanceof HTMLButtonElement) {
                bindBulletRemove(button);
            }
        });

        list.querySelector('[data-bullet-add]')?.addEventListener('click', () => {
            const template = list.querySelector('template[data-bullet-template]');
            const rows = list.querySelector('[data-bullet-rows]');

            if (! (template instanceof HTMLTemplateElement) || ! (rows instanceof HTMLElement)) {
                return;
            }

            const fragment = template.content.cloneNode(true);
            const button = fragment.querySelector('[data-bullet-remove]');

            if (button instanceof HTMLButtonElement) {
                bindBulletRemove(button);
            }

            rows.appendChild(fragment);
        });
    });
});
