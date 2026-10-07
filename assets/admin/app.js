import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
/**
 * TeknoLite Admin Master JavaScript (Teknolite Theme)
 * Located in assets/admin/app.js
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
(function () {
    'use strict';

    const TeknoLiteAdmin = {
        init: function () {
            this.initSidebar();
            this.initSearchFilter();
            this.initTableSelection();
            this.initQuickEditModal();
        },

        // 1. Sidebar Collapse, Submenu, & Mobile Navigation
        initSidebar: function () {
            const toggleBtns = document.querySelectorAll('#sidebarToggleBtn, #mobileSidebarToggleBtn');
            const backdrop = document.getElementById('sidebarBackdrop');

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (window.innerWidth < 992) {
                        document.body.classList.toggle('sidebar-mobile-open');
                    } else {
                        document.body.classList.toggle('sidebar-collapsed');
                    }
                });
            });

            // Submenu accordion toggles
            document.querySelectorAll('.menu-dropdown-toggle').forEach(function (toggle) {
                toggle.addEventListener('click', function (e) {
                    // If user clicked the chevron arrow icon specifically, toggle accordion without navigating
                    if (e.target.closest('.menu-arrow')) {
                        e.preventDefault();
                        e.stopPropagation();
                        const parent = this.closest('.has-submenu');
                        if (parent) {
                            const submenu = parent.querySelector('.sidebar-submenu');
                            const isOpen = parent.classList.contains('open');
                            
                            if (isOpen) {
                                parent.classList.remove('open');
                                if (submenu) submenu.style.display = 'none';
                            } else {
                                parent.classList.add('open');
                                if (submenu) submenu.style.display = 'block';
                            }
                        }
                        return;
                    }
                    // Otherwise, allow navigation to href (e.g. admin/productlist)
                });
            });

            // Dark/Light Mode Toggle
            const lightDarkBtn = document.getElementById('lightDarkModeToggle');
            if (lightDarkBtn) {
                lightDarkBtn.addEventListener('click', function () {
                    const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                    const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-bs-theme', nextTheme);
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = nextTheme === 'dark' ? 'bx bx-sun' : 'bx bx-moon';
                    }
                });
            }

            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    document.body.classList.remove('sidebar-mobile-open');
                });
            }

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 992) {
                    document.body.classList.remove('sidebar-mobile-open');
                }
            });
        },

        // 2. Client-side Realtime Product Search Filter
        initSearchFilter: function () {
            const searchInput = document.querySelector('.topbar-search-input');
            const tableBody = document.getElementById('productTableBody');
            const noRow = document.getElementById('noProductsRow');

            if (searchInput && tableBody) {
                searchInput.addEventListener('input', function () {
                    const query = this.value.trim().toLowerCase();
                    const rows = tableBody.querySelectorAll('tr[data-name]');
                    let visibleCount = 0;

                    rows.forEach(row => {
                        const name = (row.getAttribute('data-name') || '').toLowerCase();
                        if (name.includes(query)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    if (noRow) {
                        noRow.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
                    }
                });
            }
        },

        // 3. Table Select All Checkbox
        initTableSelection: function () {
            const checkAll = document.getElementById('checkAll');
            if (checkAll) {
                checkAll.addEventListener('change', function () {
                    const checkboxes = document.querySelectorAll('.product-check');
                    checkboxes.forEach(cb => {
                        cb.checked = checkAll.checked;
                    });
                });
            }
        },

        // 4. Quick Edit Modal Handler
        initQuickEditModal: function () {
            document.querySelectorAll('.btn-edit-product').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    const stock = this.getAttribute('data-stock');

                    const idInput = document.getElementById('editProductId');
                    const nameInput = document.getElementById('editProductName');
                    const priceInput = document.getElementById('editProductPrice');
                    const stockInput = document.getElementById('editProductStock');

                    if (idInput) idInput.value = id || '';
                    if (nameInput) nameInput.value = name || '';
                    if (priceInput) priceInput.value = price || '';
                    if (stockInput) stockInput.value = stock || '';

                    const modalEl = document.getElementById('editProductModal');
                    if (modalEl && window.bootstrap && window.bootstrap.Modal) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            });

            const editForm = document.getElementById('editProductForm');
            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const modalEl = document.getElementById('editProductModal');
                    if (modalEl && window.bootstrap && window.bootstrap.Modal) {
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                    }
                    alert('Product updated successfully!');
                });
            }

            // Delete button confirmation
            document.querySelectorAll('.btn-delete-product').forEach(btn => {
                btn.addEventListener('click', function () {
                    const name = this.getAttribute('data-name') || 'this product';
                    if (confirm('Are you sure you want to remove ' + name + '?')) {
                        const tr = this.closest('tr');
                        if (tr) tr.remove();
                    }
                });
            });
        },

        // 5. Theme Settings Offcanvas Customizer
        initThemeSettings: function () {
            // Color Scheme: Light / Dark
            document.querySelectorAll('input[name="data-bs-theme"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const theme = this.value;
                    document.documentElement.setAttribute('data-bs-theme', theme);
                    const moonIcon = document.querySelector('#lightDarkModeToggle i');
                    if (moonIcon) {
                        moonIcon.className = theme === 'dark' ? 'bx bx-sun fs-18' : 'bx bx-moon fs-18';
                    }
                });
            });

            // Topbar Color: Light / Dark
            document.querySelectorAll('input[name="data-topbar-color"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const topbar = document.querySelector('.admin-topbar');
                    if (topbar) {
                        if (this.value === 'dark') {
                            topbar.style.backgroundColor = '#1e293b';
                            topbar.style.color = '#ffffff';
                        } else {
                            topbar.style.backgroundColor = '';
                            topbar.style.color = '';
                        }
                    }
                });
            });

            // Menu Color: Light / Dark
            document.querySelectorAll('input[name="data-menu-color"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const sidebar = document.querySelector('.admin-sidebar');
                    if (sidebar) {
                        if (this.value === 'light') {
                            sidebar.style.backgroundColor = '#ffffff';
                            sidebar.style.color = '#475569';
                            sidebar.style.borderRight = '1px solid #e2e8f0';
                        } else {
                            sidebar.style.backgroundColor = '';
                            sidebar.style.color = '';
                            sidebar.style.borderRight = '';
                        }
                    }
                });
            });

            // Sidebar Size: Default, Condensed, Hidden, Small Hover Active, Small Hover
            document.querySelectorAll('input[name="data-menu-size"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const val = this.value;
                    document.body.classList.remove('sidebar-collapsed', 'sidebar-hidden', 'sidebar-sm-hover');
                    if (val === 'condensed') {
                        document.body.classList.add('sidebar-collapsed');
                    } else if (val === 'hidden') {
                        document.body.classList.add('sidebar-hidden');
                    } else if (val === 'sm-hover' || val === 'sm-hover-active') {
                        document.body.classList.add('sidebar-collapsed', 'sidebar-sm-hover');
                    }
                });
            });

            // Reset Layout Button
            const resetBtn = document.getElementById('reset-layout');
            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    // Reset theme
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                    const lightRadio = document.getElementById('layout-color-light');
                    if (lightRadio) lightRadio.checked = true;

                    // Reset topbar
                    const topbarLight = document.getElementById('topbar-color-light');
                    if (topbarLight) topbarLight.checked = true;
                    const topbar = document.querySelector('.admin-topbar');
                    if (topbar) {
                        topbar.style.backgroundColor = '';
                        topbar.style.color = '';
                    }

                    // Reset menu
                    const menuDark = document.getElementById('leftbar-color-dark');
                    if (menuDark) menuDark.checked = true;
                    const sidebar = document.querySelector('.admin-sidebar');
                    if (sidebar) {
                        sidebar.style.backgroundColor = '';
                        sidebar.style.color = '';
                        sidebar.style.borderRight = '';
                    }

                    // Reset size
                    const sizeDefault = document.getElementById('leftbar-size-default');
                    if (sizeDefault) sizeDefault.checked = true;
                    document.body.classList.remove('sidebar-collapsed', 'sidebar-hidden', 'sidebar-sm-hover');

                    // Reset icon
                    const moonIcon = document.querySelector('#lightDarkModeToggle i');
                    if (moonIcon) moonIcon.className = 'bx bx-moon fs-18';
                });
            }
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        TeknoLiteAdmin.init();
        TeknoLiteAdmin.initThemeSettings();
    });
})();
