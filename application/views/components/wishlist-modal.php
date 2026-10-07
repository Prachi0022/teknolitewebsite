<div class="modal fullRight fade wishlist-modal" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="wishlist-modal-main">
                <!-- Header -->
                <div class="wishlist-modal-header">
                    <div class="wishlist-modal-title-wrap">
                        <span class="icon icon-heart"></span>
                        <h5 class="wishlist-modal-title" id="wishlistModalTitle">My Wishlist</h5>
                        <span class="wishlist-modal-title-badge" id="wishlistHeaderCount">0</span>
                    </div>
                    <button type="button" class="wishlist-modal-close" data-bs-dismiss="modal" aria-label="Close wishlist">
                        &times;
                    </button>
                </div>

                <!-- Scrollable Body for Saved Items -->
                <div class="wishlist-modal-body" id="wishlistModalItems"></div>

                <!-- Footer with Summary & Actions -->
                <div class="wishlist-modal-footer" id="wishlistModalFooter">
                    <div class="wishlist-modal-summary">
                        <span>Items saved:</span>
                        <strong id="wishlistModalCount">0 items</strong>
                    </div>
                    <button type="button" class="wishlist-modal-btn-enquire-all" id="wishlistEnquireAll">
                        <span>Enquire All Items</span>
                        <i class="icon-arrow-up-right"></i>
                    </button>
                    <div class="wishlist-modal-actions">
                        <button type="button" class="tf-btn btn-white has-border" id="wishlistClearAll">Clear All</button>
                        <a href="<?= base_url('product'); ?>" class="tf-btn btn-white has-border" data-bs-dismiss="modal">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
