<?php $this->load->view('components/wishlist-modal'); ?>

    <!-- Core JS (jQuery first) -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/swiper-bundle.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/carousel.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap-select.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/lazysize.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/wow.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/multiple-modal.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/nouislider.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/shop.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/count-down.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/parallax.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/simpleParallaxVanilla.umd.js'); ?>"></script>
    <script type="module" src="<?= base_url('assets/js/model-viewer.min.js'); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSiPhoDaOJ7aqtJVtQhYhLzwwJ7rQlmA"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/map-contact.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/marker.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/infobox.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-validate.js'); ?>"></script>
    <script type="module" src="<?= base_url('assets/js/zoom.js'); ?>"></script>
    <script type="module" src="<?= base_url('assets/js/drift.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js'); ?>"></script>

    <!-- Preloader failsafe: guarantees preloader dismisses even on slow connections or deep routes -->
    <script>
        (function() {
            function removePreloader() {
                var preloaderEl = document.querySelector('.preload');
                if (preloaderEl) {
                    preloaderEl.style.transition = 'opacity 0.25s ease';
                    preloaderEl.style.opacity = '0';
                    setTimeout(function() {
                        if (preloaderEl && preloaderEl.parentNode) {
                            preloaderEl.parentNode.removeChild(preloaderEl);
                        }
                        document.body.classList.remove('preload-wrapper');
                    }, 250);
                }
            }
            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                setTimeout(removePreloader, 200);
            } else {
                window.addEventListener('DOMContentLoaded', function() { setTimeout(removePreloader, 200); });
                window.addEventListener('load', function() { removePreloader(); });
            }
            setTimeout(removePreloader, 1200);
        })();
    </script>
<?php
$is_logged_in = (bool)$this->session->userdata('logged_in');
$user_account = $this->session->userdata('user_account') ?: [];
$user_email = $user_account['email'] ?? '';
$user_id = $this->session->userdata('customer_id') ?? ($user_account['id'] ?? '');
?>
    <script>
        window.TEKNOLITE_LOGGED_IN = <?= $is_logged_in ? 'true' : 'false'; ?>;
        window.TEKNOLITE_LOGIN_URL = '<?= base_url('login'); ?>';
        window.TEKNOLITE_CUSTOMER_ID = '<?= html_escape($user_id); ?>';
        window.TEKNOLITE_USER_EMAIL = '<?= html_escape($user_email); ?>';
        window.TeknoLiteAuth = {
            isLoggedIn: <?= $is_logged_in ? 'true' : 'false'; ?>,
            loginUrl: '<?= base_url('login'); ?>',
            userEmail: '<?= html_escape($user_email); ?>',
            customerId: '<?= html_escape($user_id); ?>'
        };
    </script>
    <script type="text/javascript" src="<?= base_url('assets/js/wishlist.js?v=' . time()); ?>"></script>
