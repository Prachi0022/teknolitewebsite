<!-- font -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/fonts.css'); ?>">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/font-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/swiper-bundle.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/drift-basic.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/photoswipe.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css?v=' . (@filemtime(FCPATH . 'assets/css/styles.css') ?: '1.0')); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive-overrides.css?v=' . (@filemtime(FCPATH . 'assets/css/responsive-overrides.css') ?: '1.0')); ?>">

    <style>
        /* Keep the first paint identical to the loaded header layout. */
        #header {
            position: absolute;
            top: unset;
            left: 0;
            right: 0;
            width: 100%;
            min-height: 88px;
            z-index: 99999;
        }

        #header .main-header {
            min-height: 88px;
        }

        #header .logo-header {
            display: flex;
            align-items: center;
            min-height: 88px;
        }

        #header .logo-header img {
            display: block;
            width: 180px;
            height: auto;
            aspect-ratio: 180 / 44;
            object-fit: contain;
        }

        #header:not(.is-sticky) .logo-header .logo-black {
            display: none !important;
        }
        #header.is-sticky .logo-header .logo {
            display: none !important;
        }
        #header.is-sticky .logo-header .logo-black {
            display: block !important;
        }

        @media (min-width: 1200px) {
            #header.header-style-2 {
                margin-left: 32px;
                margin-right: 32px;
                width: auto;
                border-radius: 0 0 18px 18px;
                overflow: visible;
            }

            #header.header-style-2 .main-header,
            #header.header-style-2 .container-full {
                overflow: visible;
            }

            #header.header-style-2 .container-full {
                max-width: 1320px;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 1199px) {
            #header .main-header,
            #header .logo-header {
                min-height: 69px;
            }
        }
    </style>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/logo/favicon.png">

    <?php
        $preloadedWishlist = [];
        if ($this->session->userdata('logged_in')) {
            $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);
            if ($customerId) {
                if (!isset($this->wishlist_model)) {
                    $this->load->model('Wishlist_model', 'wishlist_model');
                }
                $preloadedWishlist = $this->wishlist_model->getItemsByCustomerId($customerId);
            }
        }
    ?>
    <script>
        window.BASE_URL = "<?= base_url(); ?>";
        window.TEKNOLITE_LOGGED_IN = <?= $this->session->userdata('logged_in') ? 'true' : 'false'; ?>;
        window.TEKNOLITE_LOGIN_URL = "<?= site_url('login'); ?>";
        window.TEKNOLITE_CUSTOMER_ID = "<?= html_escape($this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? '')); ?>";
        window.TEKNOLITE_USER_EMAIL = "<?= html_escape($this->session->userdata('user_account')['email'] ?? ''); ?>";
        window.TEKNOLITE_SAVED_WISHLIST = <?= json_encode($preloadedWishlist); ?>;
    </script>
