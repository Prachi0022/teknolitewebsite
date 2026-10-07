<header id="header" class="header-default header-absolute header-style-2 header-fixed">
	<div class="main-header has-border-y">
		<div class="container-full">
			<div class="row wrapper-header align-items-center">
    <!-- LOGO LEFT -->
    <div class="col-xl-3 col-8">
        <a href="<?= base_url(); ?>" class="logo-header d-flex justify-content-start">
            <?php
                $siteHeaderLogo = function_exists('get_setting_image')
                    ? get_setting_image('header_logo', 'assets/images/logo/logo.png')
                    : base_url('assets/images/logo/logo.png');
                $siteHeaderLogo2 = function_exists('get_setting_image')
                    ? get_setting_image('header_logo_2', get_setting_image('footer_logo', $siteHeaderLogo))
                    : $siteHeaderLogo;
                $siteBrandName = function_exists('get_setting')
                    ? get_setting('store_name', 'TeknoLite')
                    : 'TeknoLite';
            ?>
            <img src="<?= $siteHeaderLogo; ?>"
                 alt="<?= html_escape($siteBrandName); ?>"
                 class="logo">

            <img src="<?= $siteHeaderLogo2; ?>"
                 alt="<?= html_escape($siteBrandName); ?>"
                 class="logo-black">

        </a>
    </div>

	<!-- MOBILE MENU -->
	<div class="col-2 d-xl-none mobile-menu-col">
		<a href="#mobileMenu"
		   class="mobile-menu"
		   data-bs-toggle="offcanvas"
		   aria-controls="mobileMenu"
		   aria-label="Open navigation">
			<span class="mobile-menu-lines" aria-hidden="true"><span></span><span></span><span></span></span>
		</a>
	</div>


    <!-- MENU LINKS RIGHT -->
    <div class="col-xl-6 d-none d-xl-flex justify-content-end">

        <nav class="box-navigation">

            <ul class="box-nav-ul justify-content-end">

                <li class="menu-item">
                    <a href="<?php echo base_url()?>"
                       class="item-link text_white ">
                        Home
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo base_url()?>about"
                       class="item-link text_white">
                        About Us
                    </a>
                </li>

				<li class="menu-item dropdown">
					<a href="<?= base_url('product'); ?>"
					   class="item-link text_white ">
                        Products
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= base_url('casestudy'); ?>"
                       class="item-link text_white">
                       Projects
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= base_url('blog'); ?>"
                       class="item-link text_white">
                        Blogs
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= base_url('contact'); ?>"
                       class="item-link text_white">
                        Contact Us
                    </a>
                </li>

            </ul>

        </nav>

    </div>


    <!-- ICONS RIGHT -->
    <div class="col-xl-3 col-2">

        <ul class="nav-icon justify-content-end">

            <!-- SEARCH -->
            <li class="nav-search">
                <a href="#search"
                   data-bs-toggle="modal"
                   class="nav-icon-item text_white">

                    <span class="icon icon-search"></span>

                </a>
            </li>


            <!-- ACCOUNT -->
            <li class="nav-account account-dropdown">

                <a href="javascript:void(0);"
                   class="nav-icon-item text_white account-toggle">

                    <span class="icon icon-user"></span>

                </a>

                <div class="account-dropdown-menu">
					<?php if (!$this->session->userdata('logged_in')): ?>
					<a href="<?= base_url('login'); ?>">
                        <span class="icon icon-user"></span>
                        Login / Register
                    </a>
					<?php else: ?>
                    <a href="<?= base_url('profile'); ?>">
                        <span class="icon icon-user"></span>
                        My Profile
                    </a>

                    <a href="<?= base_url('orderhistory'); ?>">
                        <span class="icon icon-bag"></span>
                        My Enquiries
                    </a>


                    <a href="<?= base_url('profile'); ?>">
                        <span class="icon icon-lock"></span>
                        Change Password
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="<?= base_url('logout'); ?>"
                       class="logout-link">

                        <span class="icon icon-logout"></span>
                        Logout

                    </a>
					<?php endif; ?>
                </div>

            </li>

	<?php if ($this->session->userdata('logged_in')): ?>
	<li class="nav-wishlist">
									<a href="#wishlistModal" data-bs-toggle="modal" class="nav-icon-item wishlist-trigger" title="Wishlist" aria-label="Open wishlist">
                                        <span class="icon icon-heart"></span>
                                        <span class="count-box wishlist-count">0</span>
                                    </a>
								</li>
								<?php endif; ?>

        </ul>

    </div>

</div>
		</div>
	</div>
</header>
<div class="modal fade modal-search" id="search">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="d-flex justify-content-between align-items-center">
					<h5>Search</h5>
					<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
				</div>
				<form class="form-search" action="<?= site_url('product'); ?>" method="get">
					<fieldset class="text">
						<input type="search" placeholder="Searching..." class="" name="q" tabindex="0" value=""
							maxlength="100" aria-label="Search" aria-required="true" required>
					</fieldset>
					<button class="" type="submit">
						<svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
								stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round"></path>
						</svg>
					</button>
				</form>
			</div>
		</div>
</div>
<!-- shoppingCart -->
	<div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="d-flex flex-column flex-grow-1 h-100">
					<div class="header">
						<h5 class="title">Enquiry Cart</h5>
						<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
					</div>
					<div class="wrap">
						<div class="tf-mini-cart-threshold">
							<div class="tf-progress-bar">
								<div class="value" style="width: 0%;" data-progress="75">
									<i class="icon icon-shipping"></i>
								</div>
							</div>
							<div class="text-caption-1">
								Your selected products are ready for enquiry!
							</div>
						</div>
						<div class="tf-mini-cart-wrap">
							<div class="tf-mini-cart-main">
								<div class="tf-mini-cart-sroll">
									<div class="tf-mini-cart-items">
										<div class="tf-mini-cart-item file-delete">
											<div class="tf-mini-cart-image">
												<img class="lazyload"
													data-src="assets/images/shop/popup-cart-item-1.jpg"
													src="assets/images/shop/popup-cart-item-1.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">Gamma Down Light</a>
														</div>
														<div class="text-secondary-2">Gray, Size C</div>
														<div class="wg-quantity">
															<span class="btn-quantity btn-decrease">-</span>
															<input type="number" class="quantity-product" name="number"
																value="1" min="1" max="999999" step="1" required>
															<span class="btn-quantity btn-increase">+</span>
														</div>
													</div>
													<div class="right">
														<div class="text-button tf-btn-remove remove">Remove</div>
														<div class="text-button">1 X $60.00</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tf-mini-cart-item file-delete">
											<div class="tf-mini-cart-image">
												<img class="lazyload"
													data-src="assets/images/shop/popup-cart-item-2.jpg"
													src="assets/images/shop/popup-cart-item-2.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">COB Spot Light</a>
														</div>
														<div class="text-secondary-2">Gray, Size C</div>
														<div class="wg-quantity">
															<span class="btn-quantity btn-decrease">-</span>
															<input type="number" class="quantity-product" name="number"
																value="1" min="1" max="999999" step="1" required>
															<span class="btn-quantity btn-increase">+</span>
														</div>
													</div>
													<div class="right">
														<div class="text-button tf-btn-remove remove">Remove</div>
														<div class="text-button">1 X $60.00</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tf-mini-cart-item file-delete">
											<div class="tf-mini-cart-image">
												<img class="lazyload"
													data-src="assets/images/shop/popup-cart-item-3.jpg"
													src="assets/images/shop/popup-cart-item-3.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">RLD RD Down Light</a>
														</div>
														<div class="text-secondary-2">Gray, Size C</div>
														<div class="wg-quantity">
															<span class="btn-quantity btn-decrease">-</span>
															<input type="text" class="quantity-product" name="number"
																value="1">
															<span class="btn-quantity btn-increase">+</span>
														</div>
													</div>
													<div class="right">
														<div class="text-button tf-btn-remove remove">Remove</div>
														<div class="text-button">1 X $60.00</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tf-mini-cart-item file-delete">
											<div class="tf-mini-cart-image">
												<img class="lazyload"
													data-src="assets/images/shop/popup-cart-item-4.jpg"
													src="assets/images/shop/popup-cart-item-4.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">RLD SQ Spot Light</a>
														</div>
														<div class="text-secondary-2">Gray, Size C</div>
														<div class="wg-quantity">
															<span class="btn-quantity btn-decrease">-</span>
															<input type="text" class="quantity-product" name="number"
																value="1">
															<span class="btn-quantity btn-increase">+</span>
														</div>
													</div>
													<div class="right">
														<div class="text-button tf-btn-remove remove">Remove</div>
														<div class="text-button">1 X $60.00</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tf-mini-cart-item file-delete">
											<div class="tf-mini-cart-image">
												<img class="lazyload"
													data-src="assets/images/shop/popup-cart-item-5.jpg"
													src="assets/images/shop/popup-cart-item-5.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">SL CB Garden Light</a>
														</div>
														<div class="text-secondary-2">Gray, Size C</div>
														<div class="wg-quantity">
															<span class="btn-quantity btn-decrease">-</span>
															<input type="text" class="quantity-product" name="number"
																value="1">
															<span class="btn-quantity btn-increase">+</span>
														</div>
													</div>
													<div class="right">
														<div class="text-button tf-btn-remove remove">Remove</div>
														<div class="text-button">1 X $60.00</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tf-mini-cart-bottom">
								<div class="tf-mini-cart-tool">
									<div class="tf-mini-cart-tool-btn btn-add-note">
										<svg width="21" height="20" viewBox="0 0 21 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip0_6133_36620)">
												<path
													d="M10 3.33325H4.16667C3.72464 3.33325 3.30072 3.50885 2.98816 3.82141C2.67559 4.13397 2.5 4.55789 2.5 4.99992V16.6666C2.5 17.1086 2.67559 17.5325 2.98816 17.8451C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H15.8333C16.2754 18.3333 16.6993 18.1577 17.0118 17.8451C17.3244 17.5325 17.5 17.1086 17.5 16.6666V10.8333"
													stroke="#181818" stroke-width="1.5" stroke-linecap="round"
													stroke-linejoin="round" />
												<path
													d="M16.25 2.0832C16.5815 1.75168 17.0312 1.56543 17.5 1.56543C17.9688 1.56543 18.4185 1.75168 18.75 2.0832C19.0815 2.41472 19.2678 2.86436 19.2678 3.3332C19.2678 3.80204 19.0815 4.25168 18.75 4.5832L10.8333 12.4999L7.5 13.3332L8.33333 9.99986L16.25 2.0832Z"
													stroke="#181818" stroke-width="1.5" stroke-linecap="round"
													stroke-linejoin="round" />
											</g>
											<defs>
												<clipPath id="clip0_6133_36620">
													<rect width="20" height="20" fill="white"
														transform="translate(0.833008)" />
												</clipPath>
											</defs>
										</svg>
										<div class="text-caption-1">Note</div>
									</div>
									<div class="tf-mini-cart-tool-btn btn-estimate-shipping">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M13.333 2.5H0.833008V13.3333H13.333V2.5Z" stroke="#181818"
												stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M13.333 6.66675H16.6663L19.1663 9.16675V13.3334H13.333V6.66675Z"
												stroke="#181818" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
											<path
												d="M4.58333 17.4999C5.73393 17.4999 6.66667 16.5672 6.66667 15.4166C6.66667 14.266 5.73393 13.3333 4.58333 13.3333C3.43274 13.3333 2.5 14.266 2.5 15.4166C2.5 16.5672 3.43274 17.4999 4.58333 17.4999Z"
												stroke="#181818" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
											<path
												d="M15.4163 17.4999C16.5669 17.4999 17.4997 16.5672 17.4997 15.4166C17.4997 14.266 16.5669 13.3333 15.4163 13.3333C14.2657 13.3333 13.333 14.266 13.333 15.4166C13.333 16.5672 14.2657 17.4999 15.4163 17.4999Z"
												stroke="#181818" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
										<div class="text-caption-1">Shipping</div>
									</div>
									<div class="tf-mini-cart-tool-btn btn-add-coupon">
										<svg width="21" height="20" viewBox="0 0 21 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M17.3247 11.1751L11.3497 17.1501C11.1949 17.305 11.0111 17.428 10.8087 17.5118C10.6064 17.5957 10.3895 17.6389 10.1705 17.6389C9.95148 17.6389 9.7346 17.5957 9.53227 17.5118C9.32994 17.428 9.14613 17.305 8.99134 17.1501L1.83301 10.0001V1.66675H10.1663L17.3247 8.82508C17.6351 9.13735 17.8093 9.55977 17.8093 10.0001C17.8093 10.4404 17.6351 10.8628 17.3247 11.1751V11.1751Z"
												stroke="#181818" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M5.99902 5.83325H6.00902" stroke="#181818" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round" />
										</svg>
										<div class="text-caption-1">Coupon</div>
									</div>
								</div>
								<div class="tf-mini-cart-bottom-wrap">
									<div class="tf-cart-totals-discounts">
										<h5>Subtotal</h5>
										<h5 class="tf-totals-total-value">$186,99</h5>
									</div>
									<div class="tf-cart-checkbox">
										<div class="tf-checkbox-wrapp">
											<input class="" type="checkbox" id="CartDrawer-Form_agree"
												name="agree_checkbox">
											<div>
												<i class="icon-check"></i>
											</div>
										</div>
										<label for="CartDrawer-Form_agree">
											I agree with
											<a href="javascript:void(0);" class="link" title="Terms of Service">Terms &
												Conditions</a>
										</label>
									</div>
									<div class="tf-mini-cart-view-checkout">
										<a href="#wishlistModal" data-bs-toggle="modal" class="tf-btn w-100 btn-white has-border">View
											Enquiry</a>
										<a href="#enquiryForm" data-bs-toggle="modal" class="tf-btn w-100 btn-onsurface">Submit Enquiry</a>
									</div>
									<div class="text-center">
										<a class="link btn-line" href="<?= base_url('product'); ?>">Continue Browsing Products</a>
									</div>
								</div>
							</div>
							<div class="tf-mini-cart-tool-openable add-note">
								<div class="tf-mini-cart-tool-content">
									<label for="Cart-note" class="tf-mini-cart-tool-text">
										<span class="icon">
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<g clip-path="url(#clip0_6766_32777)">
													<path
														d="M9.16699 3.33325H3.33366C2.89163 3.33325 2.46771 3.50885 2.15515 3.82141C1.84259 4.13397 1.66699 4.55789 1.66699 4.99992V16.6666C1.66699 17.1086 1.84259 17.5325 2.15515 17.8451C2.46771 18.1577 2.89163 18.3333 3.33366 18.3333H15.0003C15.4424 18.3333 15.8663 18.1577 16.1788 17.8451C16.4914 17.5325 16.667 17.1086 16.667 16.6666V10.8333"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path
														d="M15.417 2.0832C15.7485 1.75168 16.1981 1.56543 16.667 1.56543C17.1358 1.56543 17.5855 1.75168 17.917 2.0832C18.2485 2.41472 18.4348 2.86436 18.4348 3.3332C18.4348 3.80204 18.2485 4.25168 17.917 4.5832L10.0003 12.4999L6.66699 13.3332L7.50033 9.99986L15.417 2.0832Z"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath>
														<rect width="20" height="20" fill="white" />
													</clipPath>
												</defs>
											</svg>
										</span>
										<span class="text-title">Note</span>
									</label>
									<form class="form-add-note tf-mini-cart-tool-wrap">
										<fieldset class="d-flex">
											<textarea name="note" id="Cart-note" maxlength="1000"
												placeholder="Add special instructions for your order..."></textarea>
										</fieldset>
										<div class="tf-cart-tool-btns">
											<button type="submit" class="tf-btn btn-onsurface w-full ">Save</button>
											<div
												class="text-center link w-full text-btn-uppercase tf-mini-cart-tool-close">
												Cancel</div>
										</div>
									</form>
								</div>
							</div>
							<div class="tf-mini-cart-tool-openable estimate-shipping">
								<div class="tf-mini-cart-tool-content">
									<label class="tf-mini-cart-tool-text">
										<span class="icon">
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<g clip-path="url(#clip0_6766_32777)">
													<path
														d="M9.16699 3.33325H3.33366C2.89163 3.33325 2.46771 3.50885 2.15515 3.82141C1.84259 4.13397 1.66699 4.55789 1.66699 4.99992V16.6666C1.66699 17.1086 1.84259 17.5325 2.15515 17.8451C2.46771 18.1577 2.89163 18.3333 3.33366 18.3333H15.0003C15.4424 18.3333 15.8663 18.1577 16.1788 17.8451C16.4914 17.5325 16.667 17.1086 16.667 16.6666V10.8333"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path
														d="M15.417 2.0832C15.7485 1.75168 16.1981 1.56543 16.667 1.56543C17.1358 1.56543 17.5855 1.75168 17.917 2.0832C18.2485 2.41472 18.4348 2.86436 18.4348 3.3332C18.4348 3.80204 18.2485 4.25168 17.917 4.5832L10.0003 12.4999L6.66699 13.3332L7.50033 9.99986L15.417 2.0832Z"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath>
														<rect width="20" height="20" fill="white" />
													</clipPath>
												</defs>
											</svg>
										</span>
										<span class="text-title">Estimate shipping rates</span>
									</label>
									<form class="form-estimate-shipping tf-mini-cart-tool-wrap"
										id="form-estimate-shipping">

										<div class="mb_12">
											<div class="text-caption-1 text-secondary mb_8">Country</div>
											<div class="tf-select">
												<select class="text-title" id="shipping-country-form"
													name="address[country]" data-default="">
													<option value="Australia"
														data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'>
														Australia</option>
													<option value="Austria" data-provinces='[]'>Austria</option>
													<option value="Belgium" data-provinces='[]'>Belgium</option>
													<option value="Canada"
														data-provinces='[["Ontario","Ontario"],["Quebec","Quebec"]]'>
														Canada
													</option>
													<option value="Czech Republic" data-provinces='[]'>Czechia</option>
													<option value="Denmark" data-provinces='[]'>Denmark</option>
													<option value="Finland" data-provinces='[]'>Finland</option>
													<option value="France" data-provinces='[]'>France</option>
													<option value="Germany" data-provinces='[]'>Germany</option>
													<option selected value="United States"
														data-provinces='[["Alabama","Alabama"],["California","California"],["Florida","Florida"]]'>
														United States</option>
													<option value="United Kingdom"
														data-provinces='[["England","England"],["Scotland","Scotland"],["Wales","Wales"],["Northern Ireland","Northern Ireland"]]'>
														United Kingdom</option>
													<option value="India" data-provinces='[]'>India</option>
													<option value="Japan" data-provinces='[]'>Japan</option>
													<option value="Mexico" data-provinces='[]'>Mexico</option>
													<option value="South Korea" data-provinces='[]'>South Korea</option>
													<option value="Spain" data-provinces='[]'>Spain</option>
													<option value="Italy" data-provinces='[]'>Italy</option>
													<option value="Vietnam"
														data-provinces='[["Ha Noi","Ha Noi"],["Da Nang","Da Nang"],["Ho Chi Minh","Ho Chi Minh"]]'>
														Vietnam</option>
												</select>
											</div>
										</div>
										<div class="mb_12">
											<div class="text-caption-1 text-secondary mb_8">State/Province</div>
											<div class="tf-select">
												<select class="text-title" name="address[province]"
													id="shipping-province-form" data-default=""></select>
											</div>
										</div>
										<fieldset class="mb_12">
											<div class="text-caption-1 text-secondary mb_8">Postal/Zip Code</div>
											<input type="text" placeholder="100000" data-opend-focus id="zipcode"
												name="address[zip]" value="" maxlength="10" pattern="[A-Za-z0-9 -]{3,10}" required>
										</fieldset>
										<div id="zipcode-message" class="error mb_12" style="display: none;">
											We found one shipping rate available for undefined.
										</div>
										<div id="zipcode-success" class="success mb_12" style="display: none;">
											<p>We found one shipping rate available for your address:</p>
											<p class="standard">Standard at <span class="standard-price">$8.00</span>
												USD</p>
										</div>
										<div class="tf-cart-tool-btns">
											<button type="submit" class="tf-btn btn-onsurface w-full w-100">
												Calculator</button>
											<div class="text-center w-100 link tf-mini-cart-tool-close">
												Cancel</div>
										</div>
									</form>
								</div>
							</div>
							<div class="tf-mini-cart-tool-openable add-coupon">
								<div class="tf-mini-cart-tool-content">
									<label class="tf-mini-cart-tool-text">
										<span class="icon">
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<g clip-path="url(#clip0_6766_32777)">
													<path
														d="M9.16699 3.33325H3.33366C2.89163 3.33325 2.46771 3.50885 2.15515 3.82141C1.84259 4.13397 1.66699 4.55789 1.66699 4.99992V16.6666C1.66699 17.1086 1.84259 17.5325 2.15515 17.8451C2.46771 18.1577 2.89163 18.3333 3.33366 18.3333H15.0003C15.4424 18.3333 15.8663 18.1577 16.1788 17.8451C16.4914 17.5325 16.667 17.1086 16.667 16.6666V10.8333"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path
														d="M15.417 2.0832C15.7485 1.75168 16.1981 1.56543 16.667 1.56543C17.1358 1.56543 17.5855 1.75168 17.917 2.0832C18.2485 2.41472 18.4348 2.86436 18.4348 3.3332C18.4348 3.80204 18.2485 4.25168 17.917 4.5832L10.0003 12.4999L6.66699 13.3332L7.50033 9.99986L15.417 2.0832Z"
														stroke="#181818" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath>
														<rect width="20" height="20" fill="white" />
													</clipPath>
												</defs>
											</svg>
										</span>
										<span class="text-title">Add A Coupon Code</span>
									</label>
									<form class="form-add-coupon tf-mini-cart-tool-wrap">
										<fieldset class="">
											<div class="text-caption-1 text-secondary mb_8">Enter Code</div>
											<input class="" type="text" placeholder="Discount code" name="text"
												tabindex="2" value="" maxlength="50" pattern="[A-Za-z0-9_-]{1,50}" aria-required="true" required>
										</fieldset>
										<div class="tf-cart-tool-btns">
											<button type="submit" class="tf-btn btn-onsurface w-full w-100">
												Save</button>
											<div class="text-center w-100 link tf-mini-cart-tool-close">
												Cancel</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /shoppingCart -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const header = document.getElementById('header');

    if (!header) return;

    function handleStickyHeader() {

        if (window.scrollY > 100) {
            header.classList.add('is-sticky');
        } else {
            header.classList.remove('is-sticky');
        }

    }

    handleStickyHeader();

    window.addEventListener('scroll', handleStickyHeader);

});
</script>