<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>GearO - Office equipment eCommerce HTML Template</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php $this->load->view('components/head')?>
</head>

<body class="preload-wrapper">



    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
                <path
                    d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_15741_24194">
                    <rect width="24" height="24" fill="white" transform="translate(0 0.66748)" />
                </clipPath>
            </defs>
        </svg>
    </button>

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">


        <!-- Header -->
         <?php $this->load->view('components/header'); ?>

        <!-- .page-title -->
        <div class="page-title relative">
            <div class="paralaximg" data-parallax="scroll" data-image-src="assets/images/page-title/page-title-5.jpg">
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="title">Login</h3>
                            <ul class="breadcrumb">
                                <li><a href="<?= base_url(); ?>">Homepage</a></li>
                                <li>Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-title -->

        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4>Login</h4>
                        </div>
                        <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success"><?= html_escape($this->session->flashdata('success')); ?></div><?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger"><?= html_escape($this->session->flashdata('error')); ?></div><?php endif; ?>
                        <form action="<?= site_url('login'); ?>" method="post" class="form-login form-has-password">
                            <div class="wrap">
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Username or email address*" name="email"
                                        tabindex="1" maxlength="150" autocomplete="email" aria-required="true" required>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Password*"
                                        name="password" tabindex="2" value="" minlength="6" maxlength="72" autocomplete="current-password" aria-required="true" required>
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide"></i>
                                    </span>
                                </fieldset>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            <input class="" type="checkbox" id="login-form_agree"
                                                name="remember_me" value="1">
                                            <div>
                                                <i class="icon-check"></i>
                                            </div>
                                        </div>
                                        <label for="login-form_agree" style="cursor: pointer;">Remember me</label>
                                    </div>
                                    <a href="<?= site_url('forgetpassword'); ?>"
                                        class="text-button forget-password link">Forgot Your Password?</a>
                                </div>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-onsurface" type="submit">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary text-body-default">Be part of our growing family of new customers!
                            Join us today and unlock a world of exclusive benefits, offers, and personalized
                            experiences.</p>
                        <a href="<?= base_url('register'); ?>" class="tf-btn btn-onsurface">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- .footer -->
        <?php $this->load->view('components/footer'); ?>
        <!-- /.footer -->

        <!-- toolbar-bottom -->
        <div class="tf-toolbar-bottom">
            <div class="toolbar-item">
                <a href="<?= base_url('product'); ?>">
                    <div class="toolbar-icon">
                        <span class="icon icon-squaresfour"></span>    
                    </div>
                    <div class="toolbar-label">Shop</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#shopCategories" data-bs-toggle="offcanvas" aria-controls="shopCategories">
                    <div class="toolbar-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                                    <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                                    </path>
                                </svg> 
                    </div>
                    <div class="toolbar-label">Categories</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#search" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <span class="icon icon-search"></span>                            
                    </div>
                    <div class="toolbar-label">Search</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#wishlistModal" data-bs-toggle="modal" class="wishlist-trigger">
                    <div class="toolbar-icon">
                        <span class="icon icon-heart"></span>  
                    </div>
                    <div class="toolbar-label">Wishlist</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#shoppingCart" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <span class="icon icon-cart"></span>  
                    </div>
                    <div class="toolbar-label">Cart</div>
                </a>
            </div>
        </div>
        <!-- /toolbar-bottom -->

    </div>

    <!-- mobile menu -->
    <?php $this->load->view('components/offcanvas'); ?>
    <!-- /mobile menu -->

    <!-- Categories -->
    <div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
        <div class="canvas-wrapper">
            <div class="canvas-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                                    <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                                    </path>
                                </svg>
                <h5>Categories</h5>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </div>
            <div class="canvas-body">
                <div class="wd-facet-categories">
                    <div role="dialog" class="facet-title collapsed" data-bs-target="#forChair" data-bs-toggle="collapse" aria-expanded="true" aria-controls="forChair">
                        <img class="avt" srce=images/shop/product-1.jpg" alt="avt">
                        <span class="title">Chair</span>
                        <span class="icon icon-down"></span>
                    </div>
                    <div id="forChair" class="collapse">
                        <ul class="facet-body">
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/product-1.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Saddle Chair</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/product-1.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Ergonomic Chair</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wd-facet-categories">
                    <div role="dialog" class="facet-title collapsed" data-bs-target="#forDesk" data-bs-toggle="collapse" aria-expanded="true" aria-controls="forDesk">
                        <img class="avt" srce=images/shop/popup-slidebar-item-2.jpg" alt="avt">
                        <span class="title">Desk</span>
                        <span class="icon icon-down"></span>
                    </div>
                    <div id="forDesk" class="collapse">
                        <ul class="facet-body">
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/popup-slidebar-item-2.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Office Desk</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/popup-slidebar-item-2.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Standing Desk</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wd-facet-categories">
                    <div role="dialog" class="facet-title collapsed" data-bs-target="#forPhone" data-bs-toggle="collapse" aria-expanded="true" aria-controls="forPhone">
                        <img class="avt" srce=images/shop/product-5.jpg" alt="avt">
                        <span class="title">Phone</span>
                        <span class="icon icon-down"></span>
                    </div>
                    <div id="forPhone" class="collapse">
                        <ul class="facet-body">
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/product-5.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Charging Pad</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/shop/product-5.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Charging Stand</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wd-facet-categories">
                    <div role="dialog" class="facet-title collapsed" data-bs-target="#forLamp" data-bs-toggle="collapse" aria-expanded="true" aria-controls="forLamp">
                        <img class="avt" srce=images/gallery/gallery-3.jpg" alt="avt">
                        <span class="title">Lamp</span>
                        <span class="icon icon-down"></span>
                    </div>
                    <div id="forLamp" class="collapse">
                        <ul class="facet-body">
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/gallery/gallery-3.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Reflection Lamp</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('product'); ?>" class="item link"><img class="avt" srce=images/gallery/gallery-3.jpg" alt="avt"><span class="title-sub text-caption-1 text-secondary">Shore Lamp</span></a>
                            </li>
                        </ul>
                    </div>
                </div>     
            </div>
        </div>
    </div> 
    <!-- /Categories -->


    <!-- Javascript -->
    <?php $this->load->view('components/script')?>
</body>

</html>