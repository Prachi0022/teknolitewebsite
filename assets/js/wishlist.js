/**
 * TeknoLite Wishlist System
 * High-performance e-commerce wishlist with compact card rendering,
 * real-time badge updates, enquiry integration, and multi-tab sync.
 */
(function ($) {
    'use strict';

    const STORAGE_KEY = 'teknolite_wishlist';
    let memoryItems = [];

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    const Wishlist = {
        init: function () {
            this.bindEvents();
            if (this.isLoggedIn()) {
                this.loadInitialItems();
            } else {
                this.updateCounters(false);
                this.syncButtonStates();
                this.renderModal();
            }
            this.bindStorageSync();
        },

        getUrl: function (path) {
            const base = (window.BASE_URL || '/').replace(/\/+$/, '') + '/';
            return base + path.replace(/^\/+/, '');
        },

        loadInitialItems: function () {
            const self = this;

            // Purge old unkeyed guest localStorage to avoid any bleed between customer accounts
            try {
                localStorage.removeItem(STORAGE_KEY);
            } catch (e) {}

            // 1. If server preloaded items exist (always supplied for logged-in users via head.php)
            if (Array.isArray(window.TEKNOLITE_SAVED_WISHLIST)) {
                memoryItems = window.TEKNOLITE_SAVED_WISHLIST;
                self.saveItems(memoryItems);
                self.updateCounters(false);
                self.syncButtonStates();
                self.renderModal();
                return;
            }

            // 2. Otherwise fetch freshly from server API for this customer
            self.fetchFromServer();
        },

        fetchFromServer: function () {
            if (!this.isLoggedIn()) return;
            const self = this;
            $.ajax({
                url: self.getUrl('wishlist/get'),
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    if (res && res.success && Array.isArray(res.items)) {
                        memoryItems = res.items;
                        self.saveItems(memoryItems);
                        self.updateCounters(false);
                        self.syncButtonStates();
                        self.renderModal();
                    }
                }
            });
        },

        syncWithServer: function (itemsToSync) {
            if (!this.isLoggedIn() || !Array.isArray(itemsToSync) || itemsToSync.length === 0) return;
            const self = this;
            $.ajax({
                url: self.getUrl('wishlist/sync'),
                type: 'POST',
                data: { items: itemsToSync },
                dataType: 'json',
                success: function (res) {
                    if (res && res.success && Array.isArray(res.items)) {
                        memoryItems = res.items;
                        self.saveItems(memoryItems);
                        self.updateCounters(false);
                        self.syncButtonStates();
                        self.renderModal();
                    }
                }
            });
        },

        isLoggedIn: function () {
            return Boolean(window.TEKNOLITE_LOGGED_IN || (window.TeknoLiteAuth && window.TeknoLiteAuth.isLoggedIn));
        },

        getLoginUrl: function () {
            return window.TEKNOLITE_LOGIN_URL || (window.TeknoLiteAuth && window.TeknoLiteAuth.loginUrl) || this.getUrl('login');
        },

        getStorageKey: function () {
            if (!this.isLoggedIn()) return null;
            const email = (window.TEKNOLITE_USER_EMAIL || (window.TeknoLiteAuth && window.TeknoLiteAuth.userEmail) || '').toLowerCase().trim();
            if (email) {
                return STORAGE_KEY + '_' + email.replace(/[^a-z0-9]+/g, '_');
            }
            const custId = (window.TEKNOLITE_CUSTOMER_ID || (window.TeknoLiteAuth && window.TeknoLiteAuth.customerId) || '').toLowerCase().trim();
            if (custId) {
                return STORAGE_KEY + '_' + custId.replace(/[^a-z0-9]+/g, '_');
            }
            return STORAGE_KEY;
        },

        getItems: function () {
            if (!this.isLoggedIn()) {
                return [];
            }
            const key = this.getStorageKey();
            if (!key) return [];
            try {
                const stored = localStorage.getItem(key);
                if (stored) {
                    const parsed = JSON.parse(stored);
                    memoryItems = Array.isArray(parsed) ? parsed : [];
                } else {
                    memoryItems = [];
                }
            } catch (error) {
                // Return in-memory items if storage is blocked
            }
            return Array.isArray(memoryItems) ? memoryItems : [];
        },

        saveItems: function (items) {
            if (!this.isLoggedIn()) return;
            const key = this.getStorageKey();
            if (!key) return;
            memoryItems = Array.isArray(items) ? items : [];
            try {
                localStorage.setItem(key, JSON.stringify(memoryItems));
            } catch (error) {
                // Keep the current-page Wishlist usable
            }
        },

        hasItem: function (id) {
            if (!this.isLoggedIn()) return false;
            const strId = String(id);
            return this.getItems().some(function (item) {
                return String(item.id) === strId;
            });
        },

        extractProductFromElement: function (element) {
            const $button = $(element);
            const $card = $button.closest('.card-product, .tk-product-card, .list-cart-item');

            let name = $button.attr('data-product-name') ||
                       $card.attr('data-product-name') ||
                       $card.find('.title, .name').first().text().trim() ||
                       'LED Light';

            let category = $button.attr('data-product-category') ||
                           $card.attr('data-product-category') ||
                           $card.find('.tk-card-category, .price').first().text().trim() ||
                           'Architectural Lighting';

            let image = $button.attr('data-product-image') ||
                        $card.find('.img-product, img').first().attr('src') ||
                        $card.find('.img-product, img').first().attr('data-src') ||
                        'assets/images/products/gamma.png';

            let hover = $button.attr('data-product-hover') ||
                        $card.find('.img-hover').attr('src') ||
                        image;

            let id = $button.attr('data-product-id') ||
                     $card.attr('data-product-id') ||
                     name.toLowerCase().replace(/[^a-z0-9]+/g, '-');

            let rawUrl = $button.attr('data-product-url') ||
                         $card.find('a.image-wrap, a.title, a.name').first().attr('href') ||
                         'productdetail';

            // Clean up static demo links
            let url = rawUrl.replace(/\.html$/, '');
            if (url === '#' || url === '#!' || !url) url = 'productdetail';

            return {
                id: String(id),
                name: name,
                category: category,
                category_label: category,
                image: image,
                hover: hover,
                url: url
            };
        },

        add: function (product, openDrawer) {
            if (!this.isLoggedIn()) {
                window.location.href = this.getLoginUrl();
                return;
            }

            const items = this.getItems();
            const exists = items.some(function (item) {
                return String(item.id) === String(product.id);
            });

            if (!exists) {
                items.unshift(product);
                this.saveItems(items);
            }

            this.updateCounters(true);
            this.syncButtonStates();
            this.renderModal();

            if (openDrawer !== false) {
                $('#wishlistModal').modal('show');
            }

            // Persist to server database
            const self = this;
            $.ajax({
                url: self.getUrl('wishlist/add'),
                type: 'POST',
                data: product,
                dataType: 'json',
                success: function (res) {
                    if (res && res.success && Array.isArray(res.items)) {
                        memoryItems = res.items;
                        self.saveItems(memoryItems);
                        self.updateCounters(false);
                        self.syncButtonStates();
                    }
                }
            });
        },

        remove: function (id) {
            const strId = String(id);
            const filtered = this.getItems().filter(function (item) {
                return String(item.id) !== strId;
            });

            this.saveItems(filtered);
            this.updateCounters(true);
            this.syncButtonStates();
            this.renderModal();

            // Persist removal to server database
            const self = this;
            $.ajax({
                url: self.getUrl('wishlist/remove'),
                type: 'POST',
                data: { id: strId },
                dataType: 'json',
                success: function (res) {
                    if (res && res.success && Array.isArray(res.items)) {
                        memoryItems = res.items;
                        self.saveItems(memoryItems);
                        self.updateCounters(false);
                        self.syncButtonStates();
                    }
                }
            });
        },

        toggle: function (element) {
            if (!this.isLoggedIn()) {
                window.location.href = this.getLoginUrl();
                return;
            }
            const product = this.extractProductFromElement(element);
            if (this.hasItem(product.id)) {
                this.remove(product.id);
            } else {
                this.add(product, true);
            }
        },

        clearAll: function () {
            this.saveItems([]);
            this.updateCounters(true);
            this.syncButtonStates();
            this.renderModal();

            // Persist clear to server database
            const self = this;
            $.ajax({
                url: self.getUrl('wishlist/clear'),
                type: 'POST',
                dataType: 'json'
            });
        },

        updateCounters: function (animate) {
            const count = this.getItems().length;
            const displayCount = count > 99 ? '99+' : String(count);

            // Update all badge elements across header, bottom toolbar, and offcanvas
            $('.wishlist-count').each(function () {
                const $badge = $(this);
                $badge.text(displayCount);

                if (count > 0) {
                    $badge.css('display', 'inline-flex');
                    if (animate) {
                        $badge.addClass('bump anim-pulse');
                        setTimeout(function () {
                            $badge.removeClass('bump anim-pulse');
                        }, 350);
                    }
                } else {
                    $badge.css('display', 'none');
                }
            });

            // Update modal header badge
            const $headerBadge = $('#wishlistHeaderCount');
            if ($headerBadge.length) {
                $headerBadge.text(count);
            }

            // Update modal footer count summary
            const $countText = $('#wishlistModalCount');
            if ($countText.length) {
                $countText.text(count + (count === 1 ? ' item' : ' items'));
            }

            // Toggle visibility of Enquire All button based on count
            const $enquireAllBtn = $('#wishlistEnquireAll');
            if ($enquireAllBtn.length) {
                $enquireAllBtn.prop('disabled', count === 0).toggle(count > 0);
            }
        },

        syncButtonStates: function () {
            const items = this.getItems();
            const self = this;

            $('.btn-icon-action.wishlist, .box-icon.wishlist, .teknolite-btn-wishlist, .wishlist-btn').each(function () {
                const $button = $(this);
                const product = self.extractProductFromElement(this);
                const active = items.some(function (item) {
                    return String(item.id) === String(product.id);
                });

                $button.toggleClass('active', active);
                $button.attr('aria-label', (active ? 'Remove ' : 'Save ') + product.name + (active ? ' from' : ' to') + ' Wishlist');

                const $btnText = $button.find('.wishlist-btn-text');
                if ($btnText.length) {
                    $btnText.text(active ? 'Saved in Wishlist' : 'Save to Wishlist');
                }
            });
        },

        renderModal: function () {
            const container = document.getElementById('wishlistModalItems');
            if (!container) return;

            if (!this.isLoggedIn()) {
                container.innerHTML =
                    '<div class="wishlist-modal-empty">' +
                        '<div class="wishlist-modal-empty-icon">' +
                            '<span class="icon icon-user"></span>' +
                        '</div>' +
                        '<h6>Sign In to View Wishlist</h6>' +
                        '<p>Please log in to your account to save products and view your wishlist items.</p>' +
                        '<a href="' + (window.TEKNOLITE_LOGIN_URL || 'login') + '" class="tf-btn btn-onsurface">' +
                            'Login / Register' +
                        '</a>' +
                    '</div>';
                const countText = document.getElementById('wishlistModalCount');
                if (countText) countText.textContent = 'Sign in required';
                const headerBadge = document.getElementById('wishlistHeaderCount');
                if (headerBadge) headerBadge.textContent = '0';
                $('#wishlistEnquireAll').hide();
                return;
            }

            const items = this.getItems();

            if (!items.length) {
                container.innerHTML =
                    '<div class="wishlist-modal-empty">' +
                        '<div class="wishlist-modal-empty-icon">' +
                            '<span class="icon icon-heart"></span>' +
                        '</div>' +
                        '<h6>Your Wishlist is Empty</h6>' +
                        '<p>Save your favorite TeknoLite architectural lighting fixtures to enquire about them easily.</p>' +
                        '<a href="product" class="tf-btn btn-onsurface" data-bs-dismiss="modal">' +
                            'Explore Products' +
                        '</a>' +
                        '<div class="wishlist-empty-recs">' +
                            '<div class="wishlist-empty-recs-title">Popular Lighting</div>' +
                            '<div class="wishlist-empty-rec-item">' +
                                '<img src="assets/images/products/gamma.png" alt="LED COB Downlight">' +
                                '<div class="wishlist-empty-rec-info">' +
                                    '<div class="name">LED COB Downlight</div>' +
                                    '<div class="cat">Indoor Lighting</div>' +
                                '</div>' +
                                '<button type="button" class="wishlist-empty-rec-btn" data-rec-id="cob-downlight" data-rec-name="LED COB Downlight" data-rec-cat="Indoor Lighting" data-rec-img="assets/images/products/gamma.png" data-rec-url="productdetail">+ Save</button>' +
                            '</div>' +
                            '<div class="wishlist-empty-rec-item">' +
                                '<img src="assets/images/products/glight.png" alt="LED Track Light">' +
                                '<div class="wishlist-empty-rec-info">' +
                                    '<div class="name">LED Track Light</div>' +
                                    '<div class="cat">Commercial Lighting</div>' +
                                '</div>' +
                                '<button type="button" class="wishlist-empty-rec-btn" data-rec-id="track-light" data-rec-name="LED Track Light" data-rec-cat="Commercial Lighting" data-rec-img="assets/images/products/glight.png" data-rec-url="productdetail">+ Save</button>' +
                            '</div>' +
                            '<div class="wishlist-empty-rec-item">' +
                                '<img src="assets/images/products/gls.png" alt="Garden Light">' +
                                '<div class="wishlist-empty-rec-info">' +
                                    '<div class="name">Garden Light</div>' +
                                    '<div class="cat">Outdoor Lighting</div>' +
                                '</div>' +
                                '<button type="button" class="wishlist-empty-rec-btn" data-rec-id="garden-light" data-rec-name="Garden Light" data-rec-cat="Outdoor Lighting" data-rec-img="assets/images/products/gls.png" data-rec-url="productdetail">+ Save</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                return;
            }

            container.innerHTML = items.map(function (item) {
                const image = item.image || 'assets/images/products/gamma.png';
                const category = item.category_label || item.category || 'Architectural Lighting';
                const safeId = escapeHtml(item.id);
                const safeName = escapeHtml(item.name);
                const safeCat = escapeHtml(category);
                const safeImg = escapeHtml(image);
                const safeUrl = escapeHtml(item.url);

                return '<article class="wishlist-modal-item" data-wishlist-id="' + safeId + '">' +
                    '<a class="wishlist-modal-image" href="' + safeUrl + '" title="' + safeName + '">' +
                        '<img src="' + safeImg + '" alt="' + safeName + '" loading="lazy">' +
                    '</a>' +
                    '<div class="wishlist-modal-info">' +
                        '<a class="wishlist-modal-name" href="' + safeUrl + '" title="' + safeName + '">' + safeName + '</a>' +
                        '<span class="wishlist-modal-category">' + safeCat + '</span>' +
                        '<div class="wishlist-modal-item-actions">' +
                            '<button type="button" class="wishlist-modal-btn-enquire" ' +
                                'data-product-name="' + safeName + '" ' +
                                'data-product-category="' + safeCat + '" ' +
                                'data-product-image="' + safeImg + '" ' +
                                'data-product-url="' + safeUrl + '" ' +
                                'aria-label="Enquire about ' + safeName + '">' +
                                '<span>Enquire</span>' +
                                '<i class="icon-arrow-up-right"></i>' +
                            '</button>' +
                            '<a class="wishlist-modal-btn-view" href="' + safeUrl + '">Details</a>' +
                        '</div>' +
                    '</div>' +
                    '<button type="button" class="wishlist-modal-remove" data-remove-id="' + safeId + '" aria-label="Remove ' + safeName + ' from wishlist">&times;</button>' +
                '</article>';
            }).join('');
        },

        enquireSingleItem: function (data) {
            $('#wishlistModal').modal('hide');

            $('#enquiryProductName').text(data.name);
            $('#enquiryProductCategory').text(data.category);
            $('#enquiryProductImage').attr({ src: data.image, alt: data.name });

            $('#enquiry_product_name').val(data.name);
            $('#enquiry_product_category').val(data.category);
            $('#enquiry_product_image').val(data.image);
            $('#enquiry_product_url').val(data.url);
            $('#enquiry_subject').val('Product Enquiry - ' + data.name);
            $('#enquiry_message').val('Hello TeknoLite, I am interested in ' + data.name + ' (' + data.category + '). Please share technical specifications, pricing, and availability.');

            setTimeout(function () {
                $('#enquiryForm').modal('show');
            }, 300);
        },

        enquireAllItems: function () {
            const items = this.getItems();
            if (!items.length) return;

            $('#wishlistModal').modal('hide');

            const first = items[0];
            const productList = items.map(function (item, index) {
                return (index + 1) + '. ' + item.name + ' (' + (item.category_label || item.category || 'Lighting') + ')';
            }).join('\n');

            $('#enquiryProductName').text('Wishlist Enquiry (' + items.length + ' Items)');
            $('#enquiryProductCategory').text('Multiple Saved Products');
            $('#enquiryProductImage').attr({ src: first.image || 'assets/images/products/gamma.png', alt: 'Wishlist items' });

            $('#enquiry_product_name').val('Wishlist (' + items.length + ' Items)');
            $('#enquiry_product_category').val('Wishlist Products');
            $('#enquiry_product_image').val(first.image || '');
            $('#enquiry_product_url').val(window.location.href);
            $('#enquiry_subject').val('Wishlist Enquiry - ' + items.length + ' Products');
            $('#enquiry_message').val(
                'Hello TeknoLite,\n\nI would like to request a quotation and technical specifications for the following products saved in my Wishlist:\n\n' +
                productList +
                '\n\nPlease provide catalog details, pricing, and availability.'
            );

            setTimeout(function () {
                $('#enquiryForm').modal('show');
            }, 300);
        },

        bindStorageSync: function () {
            const self = this;
            window.addEventListener('storage', function (e) {
                const key = self.getStorageKey();
                if (key && e.key === key) {
                    self.updateCounters(true);
                    self.syncButtonStates();
                    self.renderModal();
                }
            });
        },

        bindEvents: function () {
            const self = this;
            const heartSelector = '.btn-icon-action.wishlist, .box-icon.wishlist, .teknolite-btn-wishlist, .wishlist-btn';

            // Global delegated click handler for heart buttons
            $(document).on('click', heartSelector, function (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
                if (!self.isLoggedIn()) {
                    window.location.href = self.getLoginUrl();
                    return;
                }
                self.toggle(this);
            });

            // Remove single item with smooth animation
            $(document).on('click', '.wishlist-modal-remove', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const id = $(this).attr('data-remove-id');
                const $item = $(this).closest('.wishlist-modal-item');

                $item.addClass('removing');
                setTimeout(function () {
                    self.remove(id);
                }, 220);
            });

            // Enquire on single saved item
            $(document).on('click', '.wishlist-modal-btn-enquire', function (event) {
                event.preventDefault();
                event.stopPropagation();
                const $btn = $(this);
                self.enquireSingleItem({
                    name: $btn.attr('data-product-name') || 'TeknoLite LED Light',
                    category: $btn.attr('data-product-category') || '',
                    image: $btn.attr('data-product-image') || 'assets/images/products/gamma.png',
                    url: $btn.attr('data-product-url') || 'productdetail'
                });
            });

            // Enquire all saved items
            $(document).on('click', '#wishlistEnquireAll', function (event) {
                event.preventDefault();
                event.stopPropagation();
                self.enquireAllItems();
            });

            // Quick add recommendation from empty state
            $(document).on('click', '.wishlist-empty-rec-btn', function (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
                if (!self.isLoggedIn()) {
                    window.location.href = self.getLoginUrl();
                    return;
                }
                const $btn = $(this);
                self.add({
                    id: $btn.attr('data-rec-id'),
                    name: $btn.attr('data-rec-name'),
                    category: $btn.attr('data-rec-cat'),
                    category_label: $btn.attr('data-rec-cat'),
                    image: $btn.attr('data-rec-img'),
                    hover: $btn.attr('data-rec-img'),
                    url: $btn.attr('data-rec-url')
                }, true);
            });

            // Clear all
            $(document).on('click', '#wishlistClearAll', function (event) {
                event.preventDefault();
                event.stopPropagation();
                self.clearAll();
            });

            // Sync on modal show
            $(document).on('show.bs.modal shown.bs.modal', '#wishlistModal', function () {
                self.renderModal();
                self.updateCounters(false);
            });
        }
    };

    window.TeknoLiteWishlist = Wishlist;

    $(document).ready(function () {
        Wishlist.init();
    });
})(jQuery);

