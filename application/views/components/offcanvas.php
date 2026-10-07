<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">

    <!-- CLOSE -->
    <span class="icon-close icon-close-popup"
          data-bs-dismiss="offcanvas"
          aria-label="Close">
    </span>

    <div class="mb-canvas-content">

        <div class="mb-body">

            <!-- MOBILE NAVIGATION -->
            <ul class="nav-ul-mb" id="wrapper-menu-navigation">

                <li class="nav-mb-item active">
                    <a href="<?= base_url(); ?>" class="mb-menu-link">
                        <span>Home</span>
                    </a>
                </li>

                <li class="nav-mb-item">
                    <a href="<?= base_url('about'); ?>" class="mb-menu-link">
                        <span>About Us</span>
                    </a>
                </li>

                <li class="nav-mb-item">
                    <a href="#mobileProducts" class="mb-menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="mobileProducts">
                        <span>Products</span><span class="btn-open-sub" aria-hidden="true"></span>
                    </a>
                    <div class="collapse" id="mobileProducts">
                        <ul class="sub-nav-menu">
                            <li><a href="<?= base_url('product'); ?>" class="sub-nav-link">All Products</a></li>
                            <li><a href="<?= base_url('product'); ?>?category=indoor" class="sub-nav-link">Indoor Lighting</a></li>
                            <li><a href="<?= base_url('product'); ?>?category=commercial" class="sub-nav-link">Commercial Lighting</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-mb-item">
                    <a href="<?= base_url('casestudy'); ?>" class="mb-menu-link">
                        <span>Case Study</span>
                    </a>
                </li>

                <li class="nav-mb-item">
                    <a href="<?= base_url('blog'); ?>" class="mb-menu-link">
                        <span>Blogs</span>
                    </a>
                </li>

                <li class="nav-mb-item">
                    <a href="<?= base_url('contact'); ?>" class="mb-menu-link">
                        <span>Contact Us</span>
                    </a>
                </li>

            </ul>


            <!-- EXTRA LINKS -->
            <div class="mb-other-content">

                <div class="group-icon">

                    <!-- SEARCH -->
                    <a href="#search"
                       data-bs-toggle="modal"
                       class="site-nav-icon">

                        <span class="icon icon-search"></span>
                        Search

                    </a>

                    <!-- WISHLIST -->
                    <a href="#wishlistModal"
                       data-bs-toggle="modal"
                       class="site-nav-icon wishlist-trigger">

                        <span class="icon icon-heart"></span>
                        Wishlist
                        <span class="mobile-wishlist-badge wishlist-count" style="margin-left:auto;">0</span>

                    </a>

                    <!-- LOGIN -->
                    <?php if (!$this->session->userdata('logged_in')): ?>
                    <a href="<?= base_url('login'); ?>"
                       class="site-nav-icon">

                        <span class="icon icon-user"></span>
                        Login / Register

                    </a>
                    <?php endif; ?>

                </div>


                <!-- MY ACCOUNT LINKS -->
                <?php if ($this->session->userdata('logged_in')): ?>
                <?php $sidebar_user = $this->session->userdata('user_account') ?: []; ?>
                <div class="mobile-account-menu">

                    <h6>My Account</h6>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="<?= html_escape($sidebar_user['image'] ?? base_url('assets/images/avatar/avatar-3.jpg')); ?>" alt="Profile picture" width="44" height="44" style="border-radius:50%; object-fit:cover;">
                        <div>
                            <strong><?= html_escape($sidebar_user['name'] ?? 'Account User'); ?></strong>
                            <small class="d-block"><?= html_escape($sidebar_user['email'] ?? ''); ?></small>
                        </div>
                    </div>

                    <ul>

                        <li>
                            <a href="<?= base_url('profile'); ?>">
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('orderhistory'); ?>">
                                My Enquiries
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('profile'); ?>">
                                Change Password
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('logout'); ?>"
                               class="mobile-logout">
                                Logout
                            </a>
                        </li>

                    </ul>

                </div><?php endif; ?>


                <!-- CONTACT INFO -->
                <div class="mb-notice">
                    <a href="<?= base_url('contact'); ?>"
                       class="text-need">
                        Need Help?
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>