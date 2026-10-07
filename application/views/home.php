<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
	<meta charset="utf-8">
	<title>TeknoLite - Premium LED Lighting Solutions</title>

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
	</div><!-- /preload -->

	<div id="wrapper">

		<div class="space-1"></div>

		<!-- .header -->
		<?php $this->load->view('components/header')?>
		<!-- /.header -->


		<!-- =====================================================
             1. HERO BANNER - EXISTING SECTION
             Existing: heading, description, banner image, Explore Collection CTA
             TODO: Request a Quote CTA is NOT present in the original code.
             Space reserved here; no new CTA has been created.
        ====================================================== -->
		<!-- .silideshow -->
		<div class="tf-slideshow style-3 slider-effect-fade ">
			<div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1"
				data-centered="false" data-space="15" data-space-mb="0" data-loop="false" data-auto-play="true">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="wrap-slider">
							<div class="img-style">
								<img class="lazyload"
									data-src="<?php echo base_url()?>assets/images/banner/banner1.jpeg"
									src="<?php echo base_url()?>assets/images/banner/banner1.jpeg" alt="banner-cls">
							</div>
							<div class="box-content">
								<div class="box-title">
									<div class="text-white text-display fade-item fade-item-1 ">Leading LED Lighting
										Manufacturer in
										India</div>
									<p class="text-body-1 text_white fade-item fade-item-2">Premium Commercial &
										Architectural Lighting Solutions for Every Project</p>
								</div>
								<div class="fade-item fade-item-3">
									<a href="#quoteForm" class="tf-btn btn-white mx-auto " data-bs-toggle="modal"
										data-bs-target="#quoteForm">Get a Project Quote</a>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide">

						<div class="wrap-slider">

							<div class="img-style">
								<img class="lazyload"
									data-src="<?php echo base_url()?>assets/images/banner/banner2.jpeg"
									src="<?php echo base_url()?>assets/images/banner/banner2.jpeg"
									alt="Teknolite Lighting">
							</div>

							<div class="box-content">

								<div class="box-title">

									<div class="text-white text-display fade-item fade-item-1">
										Transform Your Vision<br>
										with Premium Lighting
									</div>

									<p class="text-body-1 text-white fade-item fade-item-2">
										Custom LED Lighting Solutions for Architects, Builders & Interior Designers
									</p>

								</div>

								<div class="fade-item fade-item-3">
									<a href="#quoteForm" class="tf-btn btn-white mx-auto" data-bs-toggle="modal"
										data-bs-target="#quoteForm">
										Consult Our Lighting Experts
									</a>
								</div>

							</div>

						</div>

					</div>
					<div class="swiper-slide">
						<div class="wrap-slider ">
							<div class="img-style">
								<img class="lazyload"
									data-src="<?php echo base_url()?>assets/images/banner/banner3.jpeg"
									src="<?php echo base_url()?>assets/images/banner/banner3.jpeg" alt="banner-cls">
							</div>
							<div class="box-content">
								<div class="box-title">
									<div class="text-white text-display fade-item fade-item-1">Ready to Light Up Your
										Next
										Interior
										Project?</div>
									<p class="text-body-1 text-white fade-item fade-item-2">Helping you choose the
										right LED lighting solution for every project.</p>
								</div>
								<div class="fade-item fade-item-3">
									<a href="#quoteForm" class="tf-btn btn-white mx-auto " data-bs-toggle="modal"
										data-bs-target="#quoteForm">Discuss Your Project</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wrap-pagination">
					<div class="container">
						<div class="sw-dots sw-pagination-slider type-circle white-circle-line justify-content-center">
						</div>
					</div>
				</div>
				<div class="sw-button swiper-button-next navigation-next-slider"></div>
				<div class="sw-button swiper-button-prev navigation-prev-slider"></div>
			</div>
		</div>
		<!-- /.silideshow -->

		<!-- =====================================================
             2. PRODUCT CATEGORIES - EXISTING SECTION
             Existing: category image, category name, item count, View All Products CTA
             TODO: Individual View Products CTA is NOT present in the original category cards.
        ====================================================== -->
		<!-- .categories -->
		<section class="flat-spacing-2">
			<div class="container-2">

				<div class="row">
					<div class="col-12">

						<!-- Heading -->
						<div class="heading-section text-center mb_43">

							<h3 class="wow fadeInUp mb-2 header" style="font-weight:600;">
								Why Professionals Prefer
								<span class="text-primary">TeknoLite</span>
							</h3>

							<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">

								Architects, builders, lighting consultants, MEP consultants,
								electrical contractors, interior designers, and developers choose
								TeknoLite because we combine manufacturing excellence with innovative
								lighting technology. Our commitment to precision engineering,
								premium materials, energy efficiency, and dedicated after-sales
								support ensures reliable lighting solutions that deliver lasting
								performance.

							</p>

						</div>


						<!-- Slider -->
						<div class="swiper tf-sw-collection" data-preview="4" data-tablet="3" data-mobile-sm="2"
							data-mobile="1" data-space-lg="30" data-space-md="20" data-space="15" data-loop="false">

							<div class="swiper-wrapper">


								<!-- Residential -->
								<div class="swiper-slide">

									<div class="collection-position hover-img style-4 wow fadeInUp" data-wow-delay="0s">

										<a href="#" class="img-style" data-bs-toggle="modal"
											data-bs-target="#enquiryForm">

											<img class="lazyload"
												data-src="<?php echo base_url()?>assets/images/banner/residential.jpeg"
												src="<?php echo base_url()?>assets/images/banner/residential.jpeg"
												alt="Residential Lighting">

										</a>

										<div class="content cls-content">

											<h4>
												<a href="<?= base_url('productdetail'); ?>" class="link"
													data-bs-toggle="modal" data-bs-target="#enquiryForm">
													Residential
												</a>
											</h4>

											<h6>120+ Items</h6>

										</div>

									</div>

								</div>


								<!-- Commercial -->
								<div class="swiper-slide">

									<div class="collection-position hover-img style-4 wow fadeInUp"
										data-wow-delay="0.1s">

										<a href="<?= base_url('productdetail'); ?>" class="img-style"
											data-bs-toggle="modal" data-bs-target="#enquiryForm">

											<img class="lazyload"
												data-src="<?php echo base_url()?>assets/images/banner/commercial.jpeg"
												src="<?php echo base_url()?>assets/images/banner/commercial.jpeg"
												alt="Commercial Lighting">

										</a>

										<div class="content cls-content">

											<h4>
												<a href="#" class="link" data-bs-toggle="modal"
													data-bs-target="#enquiryForm">
													Commercial
												</a>
											</h4>

											<h6>150+ Items</h6>

										</div>

									</div>

								</div>


								<!-- Retail -->
								<div class="swiper-slide">

									<div class="collection-position hover-img style-4 wow fadeInUp"
										data-wow-delay="0.2s">

										<a href="#" class="img-style" data-bs-toggle="modal"
											data-bs-target="#enquiryForm">

											<img class="lazyload"
												data-src="<?php echo base_url()?>assets/images/banner/retail.jpeg"
												src="<?php echo base_url()?>assets/images/banner/retail.jpeg"
												alt="Retail Lighting">

										</a>

										<div class="content cls-content">

											<h4>
												<a href="#" class="link" data-bs-toggle="modal"
													data-bs-target="#enquiryForm">
													Retail
												</a>
											</h4>

											<h6>80+ Items</h6>

										</div>

									</div>

								</div>


								<!-- Hospitality -->
								<div class="swiper-slide">

									<div class="collection-position hover-img style-4 wow fadeInUp"
										data-wow-delay="0.3s">

										<a href="#" class="img-style" data-bs-toggle="modal"
											data-bs-target="#enquiryForm">

											<img class="lazyload"
												data-src="<?php echo base_url()?>assets/images/banner/hospitality.jpeg"
												src="<?php echo base_url()?>assets/images/banner/hospitality.jpeg"
												alt="Hospitality Lighting">

										</a>

										<div class="content cls-content">

											<h4>
												<a href="#" class="link" data-bs-toggle="modal"
													data-bs-target="#enquiryForm">
													Hospitality
												</a>
											</h4>

											<h6>Browse All</h6>

										</div>

									</div>

								</div>


							</div>


							<!-- Mobile Pagination -->
							<div class="wrap-pagination d-block">

								<div class="container">

									<div class="row">

										<div class="col-12">

											<div class="sw-dots sw-pagination-collection 
                                                type-circle d-flex d-md-none 
                                                justify-content-center">
											</div>

										</div>

									</div>

								</div>

							</div>


							<!-- Navigation -->
							<div class="sw-button swiper-button-next nav-next-collection md-none"></div>

							<div class="sw-button swiper-button-prev nav-prev-collection md-none"></div>


						</div>

					</div>
				</div>

			</div>
		</section>
		<!-- /.categories -->

		<!-- =====================================================
             3. FEATURED PRODUCTS - EXISTING "OUR PICKS FOR YOU" SECTION
             Existing: product image, product name, price, wishlist/compare/quick view, Add To Cart
             TODO: Short specification, View Details CTA and Add to Enquiry are NOT present as requested.
        ====================================================== -->
		<!-- top-pick -->
		<section class="flat-spacing-2 pt-0">
			<div class="container">
				<div class="row">
					<div class="col-12">

						<!-- Heading -->
						<div class="heading-section text-center">

							<h3 class="wow fadeInUp">
								Explore Our Commercial & Architectural Lighting Range
							</h3>

							<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">
								Elevate Your Project with Premium Lighting.
							</p>

						</div>


						<?php
						if (!isset($new_products) || empty($new_products)) {
							if (!isset($this->product_model)) {
								$this->load->model('Product_model', 'product_model');
							}
							$new_products = $this->product_model->getLatestProducts(8);
						}

						if (!function_exists('resolve_home_prod_img')) {
							function resolve_home_prod_img($path, $fallback = 'assets/images/products/gamma.png') {
								if (empty($path)) return base_url($fallback);
								if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
								if (strpos($path, 'assets/') === 0 || strpos($path, 'uploads/') === 0) return base_url($path);
								return base_url('assets/images/products/' . $path);
							}
						}
						?>
						<style>
						/* Homepage 4-Column Products Grid: Exactly 4 cards in Row 1 & 4 cards in Row 2 on desktop */
						.home-products-4col {
							display: grid !important;
							grid-template-columns: repeat(4, 1fr) !important;
							column-gap: 24px !important;
							row-gap: 32px !important;
							margin-bottom: 40px !important;
						}
						@media (min-width: 1200px) {
							.home-products-4col {
								grid-template-columns: repeat(4, 1fr) !important;
							}
						}
						@media (min-width: 992px) and (max-width: 1199px) {
							.home-products-4col {
								grid-template-columns: repeat(4, 1fr) !important;
							}
						}
						@media (min-width: 768px) and (max-width: 991px) {
							.home-products-4col {
								grid-template-columns: repeat(3, 1fr) !important;
							}
						}
						@media (min-width: 576px) and (max-width: 767px) {
							.home-products-4col {
								grid-template-columns: repeat(2, 1fr) !important;
							}
						}
						@media (max-width: 575px) {
							.home-products-4col {
								grid-template-columns: repeat(2, 1fr) !important;
								column-gap: 12px !important;
								row-gap: 20px !important;
							}
						}
						/* Extra safety override if any stylesheet cached 5col */
						.home-products-5col {
							grid-template-columns: repeat(4, 1fr) !important;
						}
						</style>
						<!-- Product Grid: Exactly 4 Products Per Row on Desktop (Total 8 cards: 4 in row 1, 4 in row 2) -->
						<div class="tf-grid-layout tf-col-4 home-products-4col">

							<?php if (!empty($new_products)): ?>
							<?php foreach ($new_products as $index => $prod): 
									$prodId = (string)($prod['numeric_id'] ?? ($prod['id'] ?? ($index + 1)));
									$prodSlug = $prod['slug'] ?? ($prod['id'] ?? $prodId);
									$prodName = $prod['name'] ?? 'TeknoLite LED Light';
									$prodCat = $prod['category'] ?? 'Architectural Lighting';
									$prodImg = resolve_home_prod_img($prod['featured_image'] ?? '', 'assets/images/products/gamma.png');
									$prodHover = resolve_home_prod_img($prod['hover_image'] ?? '', $prod['featured_image'] ?? 'assets/images/products/gamma.png');
									$prodUrl = base_url('productdetail/' . $prodSlug);
								?>
							<div class="card-product style-5 wow fadeInUp" data-wow-delay="<?= ($index % 4) * 0.1; ?>s"
								data-product-id="<?= $prodId; ?>"
								data-product-name="<?= htmlspecialchars($prodName); ?>"
								data-product-category="<?= htmlspecialchars($prodCat); ?>"
								data-product-image="<?= $prodImg; ?>" data-product-hover="<?= $prodHover; ?>"
								data-product-url="<?= $prodUrl; ?>">

								<div class="card-product-wrapper">

									<a href="<?= $prodUrl; ?>" class="image-wrap">
										<img class="lazyload img-product" data-src="<?= $prodImg; ?>"
											src="<?= $prodImg; ?>" alt="<?= htmlspecialchars($prodName); ?>">

										<img class="lazyload img-hover" data-src="<?= $prodHover; ?>"
											src="<?= $prodHover; ?>" alt="<?= htmlspecialchars($prodName); ?>">
									</a>

									<div class="list-product-btn">
										<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action"
											data-product-id="<?= $prodId; ?>"
											data-product-name="<?= htmlspecialchars($prodName); ?>"
											data-product-category="<?= htmlspecialchars($prodCat); ?>"
											data-product-image="<?= $prodImg; ?>"
											data-product-hover="<?= $prodHover; ?>" data-product-url="<?= $prodUrl; ?>"
											aria-label="Save <?= htmlspecialchars($prodName); ?>">
											<span class="icon icon-heart"></span>
											<span class="tooltip">Save Product</span>
										</a>

										<a href="<?= $prodUrl; ?>" class="box-icon quickview tf-btn-loading">
											<span class="icon icon-eye"></span>
											<span class="tooltip">View Details</span>
										</a>
									</div>

									<div class="list-btn-main">
										<a href="<?= $prodUrl; ?>" class="btn-main-product btn-quickview">
											View Details
										</a>

										<a href="#" data-bs-toggle="modal" data-bs-target="#enquiryForm"
											class="btn-main-product">
											Enquiry Now
										</a>
									</div>

								</div>

								<div class="card-product-info">
									<a href="<?= $prodUrl; ?>" class="title link">
										<?= htmlspecialchars($prodName); ?>
									</a>

									<div class="price text-body-default">
										<?= htmlspecialchars($prodCat); ?>
									</div>
								</div>

							</div>
							<?php endforeach; ?>
							<?php else: ?>
							<div class="col-12 text-center py-5">
								<p class="text-muted">No products available at the moment.</p>
							</div>
							<?php endif; ?>

						</div>
						<!-- home-products-4col ENDS HERE -->


						<!-- Explore More -->
						<div class="center-btn-wrap wow fadeInUp">
							<a href="<?= base_url('product'); ?>" class="tf-btn btn-white">
								Explore More
							</a>
						</div>


					</div>
				</div>
			</div>
		</section>
		<!-- /.top-pick -->

		<!-- =====================================================
             4. ABOUT COMPANY - SECTION NOT PRESENT IN ORIGINAL CODE
             SPACE RESERVED TO ADD THIS SECTION LATER.
             Do not add content here until the section is designed/approved.
        ====================================================== -->
		<style>
			/* === About Redesign === */
			.about-section {
				padding: 100px 0;
				background: linear-gradient(180deg, #ffffff, #fafafa);
			}

			.about-tag {
				display: inline-block;
				font-size: 11px;
				font-weight: 700;
				letter-spacing: 0.18em;
				text-transform: uppercase;
				color: #0d6efd;
				background: rgba(224, 123, 26, 0.09);
				border: 1px solid rgba(224, 123, 26, 0.22);
				border-radius: 50px;
				padding: 5px 16px;
				margin-bottom: 22px;
			}

			.about-new-title {
				font-size: clamp(28px, 4vw, 48px);
				font-weight: 600;
				line-height: 1.25;
				color: #111;
				letter-spacing: -0.5px;
				margin-bottom: 50px;
			}

			.about-new-title span {
				color: #999;
				font-weight: 400;
			}

			.about-new-desc {
				font-size: 15px;
				line-height: 1.85;
				color: #666;
				margin-bottom: 0;
			}

			.about-new-desc strong {
				color: #111;
			}

			.about-new-img-wrap {
				border-radius: 10px;
				width: 100%;
				height: 100%;
				min-height: 100%;
				overflow: hidden;
				position: relative;
				box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
			}

			@media (max-width: 991px) {
				.about-new-img-wrap {
					height: 350px;
					min-height: auto;
				}
			}

			.about-new-img-wrap img,
			.about-new-img-wrap video {
				width: 100%;
				height: 140%;
				object-fit: cover;
				position: absolute;
				top: -20%;
				left: 0;
				will-change: transform;
				transition: transform 0.1s ease-out;
			}

			.about-stats {
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-top: 60px;
				padding-top: 40px;
				border-top: 1px solid #e8e8e8;
			}

			.about-stat {
				text-align: center;
				flex: 1;
			}

			.about-stat:not(:last-child) {
				border-right: 1px solid #ececec;
			}

			.about-stat h3 {
				font-size: 42px;
				font-weight: 700;
				color: #0d6efd;
				margin-bottom: 8px;
			}

			.about-stat p {
				margin: 0;
				color: #666;
				font-size: 13px;
				text-transform: uppercase;
				letter-spacing: 1px;
				font-weight: 500;
			}

			@media (max-width: 991px) {
				.about-section {
					padding: 60px 0;
				}

				.about-new-title {
					margin-bottom: 30px;
				}

				.about-stats {
					margin-top: 40px;
					padding-top: 30px;
				}
			}

			@media (max-width: 767px) {
				.about-stats {
					flex-direction: column;
					gap: 30px;
				}

				.about-stat {
					width: 100%;
				}

				.about-stat:not(:last-child) {
					border-right: none;
					border-bottom: 1px solid #ececec;
					padding-bottom: 20px;
				}
			}

			/* === Who We Serve === */
			.who-we-serve-section {
				padding: 90px 0;
				background: linear-gradient(160deg, #0a0a0a 0%, #111827 55%, #0d0d0d 100%);
				position: relative;
				overflow: hidden;
			}

			.who-we-serve-section::before {
				content: '';
				position: absolute;
				top: 0;
				left: 10%;
				right: 10%;
				height: 1px;
				background: linear-gradient(90deg, transparent, rgba(224, 123, 26, 0.5), transparent);
			}

			.who-we-serve-section::after {
				content: '';
				position: absolute;
				inset: 0;
				background: radial-gradient(ellipse at 50% 0%, rgba(224, 123, 26, 0.06) 0%, transparent 60%);
				pointer-events: none;
			}

			.wws-section-badge {
				display: inline-block;
				font-size: 11px;
				font-weight: 700;
				letter-spacing: 0.18em;
				text-transform: uppercase;
				color: #0d6efd;
				background: rgba(224, 123, 26, 0.1);
				border: 1px solid rgba(224, 123, 26, 0.25);
				border-radius: 50px;
				padding: 5px 18px;
				margin-bottom: 18px;
			}

			.wws-heading {
				font-size: clamp(30px, 4vw, 44px);
				font-weight: 700;
				color: #fff;
				margin-bottom: 10px;
				letter-spacing: -0.3px;
			}

			.wws-heading span {
				color: #0d6efd;
			}

			.wws-subtitle {
				color: rgba(255, 255, 255, 0.5);
				font-size: 15px;
				margin-bottom: 0;
			}

			/* Flip card structure */
			.flip-card-wrapper {
				perspective: 1100px;
				height: 300px;
				opacity: 1;
				transform: translateY(36px);
				transition: opacity 0.55s ease, transform 0.55s ease;
			}

			.flip-card-wrapper.wws-visible {
				opacity: 1;
				transform: translateY(0);
			}

			.flip-card-inner {
				position: relative;
				width: 100%;
				height: 100%;
				transform-style: preserve-3d;
				transition: transform 0.65s cubic-bezier(0.4, 0.2, 0.2, 1);
			}

			.flip-card-wrapper:hover .flip-card-inner {
				transform: rotateY(180deg);
			}

			.flip-card-front,
			.flip-card-back {
				position: absolute;
				inset: 0;
				background-color: #3b82f62e;
				border: 1px solid #3b82f62e;
				border-radius: 10px;
				backface-visibility: hidden;
				-webkit-backface-visibility: hidden;
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				padding: 36px 28px;
				text-align: center;
				overflow: hidden;
			}

			/* Subtle glow corner on front */
			.flip-card-front::before {
				content: '';
				position: absolute;
				top: -40px;
				right: -40px;
				width: 100px;
				height: 100px;
				/* background: radial-gradient(circle, rgba(224,123,26,0.18) 0%, transparent 70%); */
				border-radius: 50%;
				pointer-events: none;
			}

			.flip-card-back {
				transform: rotateY(180deg);
				background: linear-gradient(to right, #3b82f6, #1e3a8a);
				border-color: transparent;
			}

			/* Icon circle on front */
			.flip-icon-wrap {
				width: 76px;
				height: 76px;
				border-radius: 50%;
				background: linear-gradient(to right, #3b82f64f, #1e3a8a8a);
				border: 1px solid rgba(224, 123, 26, 0.2);
				display: flex;
				align-items: center;
				justify-content: center;
				margin-bottom: 22px;
				transition: background 0.3s ease, transform 0.3s ease;
			}

			.flip-card-wrapper:hover .flip-icon-wrap {
				background: linear-gradient(to right, #3b82f64f, #1e3a8a8a);
				transform: scale(1.1);
			}

			.flip-icon-wrap img {
				width: 40px;
				height: 40px;
				object-fit: contain;
				filter: brightness(0) invert(1);
			}

			.flip-card-front h5 {
				font-size: 15px;
				font-weight: 700;
				letter-spacing: 0.06em;
				color: #fff;
				margin: 0;
			}

			.flip-card-front .flip-hint {
				font-size: 11px;
				color: rgba(255, 255, 255, 0.35);
				margin-top: 10px;
				letter-spacing: 0.05em;
				text-transform: uppercase;
				display: flex;
				align-items: center;
				gap: 5px;
			}

			.flip-hint-arrow {
				display: inline-block;
				animation: hint-nudge 1.6s ease-in-out infinite;
			}

			@keyframes hint-nudge {

				0%,
				100% {
					transform: translateX(0);
				}

				50% {
					transform: translateX(4px);
				}
			}

			/* Back content */
			.flip-back-icon {
				font-size: 36px;
				color: rgba(255, 255, 255, 0.9);
				margin-bottom: 16px;
			}

			.flip-card-back h5 {
				font-size: 16px;
				font-weight: 700;
				color: #fff;
				margin-bottom: 12px;
				letter-spacing: 0.04em;
			}

			.flip-card-back p {
				font-size: 14px;
				color: rgba(255, 255, 255, 0.88);
				line-height: 1.7;
				margin: 0;
			}

			.flip-card-back .flip-divider {
				width: 36px;
				height: 2px;
				background: rgba(255, 255, 255, 0.4);
				border-radius: 2px;
				margin: 12px auto;
			}

			/* === Responsive === */
			@media (max-width: 991px) {
				.about-hero {
					padding: 60px 0 50px;
				}

				.about-story,
				.about-vision-mission {
					padding: 50px 0;
				}

				.about-lifestyle {
					padding: 0 0 50px;
				}

				.about-lifestyle-img {
					height: 320px;
				}

				.about-story-img-wrap img {
					height: 300px;
				}

				.who-we-serve-section {
					padding: 50px 0;
				}

				.vm-card {
					padding: 28px 22px;
				}

				.flip-card-wrapper {
					height: 270px;
				}

				.tf-counter-section {
					padding: 50px 0;
				}

				.tf-counter-section .counter-box {
					padding: 24px 12px;
				}

				.tf-counter-section .counter-icon {
					font-size: 26px;
					width: 52px;
					height: 52px;
					margin-bottom: 14px;
				}

				.tf-counter-section .counter-number {
					font-size: 2rem;
				}
			}

			@media (max-width: 575.98px) {
				.about-hero-heading {
					font-size: 32px;
				}

				.about-hero-lead {
					font-size: 15px;
				}

				.about-lifestyle-img {
					height: 230px;
					border-radius: 16px;
				}

				.about-story-img-wrap img {
					height: 240px;
				}

				.about-story-stats {
					flex-wrap: wrap;
				}

				.about-story-stat {
					flex: 0 0 50%;
					border-right: none;
					border-bottom: 1px solid #ececec;
				}

				.about-story-stat:nth-child(odd) {
					border-right: 1px solid #ececec;
				}

				.flip-card-wrapper {
					height: 260px;
				}

				.flip-card-front,
				.flip-card-back {
					padding: 28px 18px;
				}
			}

			/* === Read More / Collapse Section === */
			.about-collapse-content {
				max-height: 0;
				overflow: hidden;
				opacity: 0;
				transition: max-height 0.4s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.35s ease-out;
			}

			.btn-readmore {

				color: #0d6efd;
				font-weight: 600;
				font-size: 13px;
				letter-spacing: 0.05em;
				text-transform: uppercase;
				padding: 8px 20px;
				margin-top: 15px;
				border-radius: 50px;
				display: inline-flex;
				align-items: center;
				cursor: pointer;
				transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
				gap: 8px;
				outline: none;
			}

			.btn-readmore:hover {
				color: #0d6efd;
				transform: translateY(-1px);
			}

			.btn-readmore:active {
				transform: translateY(0);
			}

			.btn-readmore .icon-arrow {
				width: 6px;
				height: 6px;
				border-right: 2px solid currentColor;
				border-bottom: 2px solid currentColor;
				transform: rotate(45deg);
				transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), margin-bottom 0.3s ease;
				display: inline-block;
				margin-bottom: 2px;
			}

			.btn-readmore[aria-expanded="true"] .icon-arrow {
				transform: rotate(-135deg);
				margin-bottom: -1px;
			}

			/* Responsive behavior for mobile & laptop Read More states */

			/* Laptop (>= 768px): make paragraph 2 always visible */
			@media (min-width: 768px) {
				.about-collapse-mobile {
					max-height: none !important;
					opacity: 1 !important;
					overflow: visible !important;
				}
			}

		</style>
		<script>
			(function () {
				var cards = document.querySelectorAll('.flip-card-wrapper');
				if (!cards.length) return;

				if ('IntersectionObserver' in window) {
					var obs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.wwsIn) {
								entry.target.dataset.wwsIn = '1';
								var delay = parseInt(entry.target.getAttribute('data-wws-delay') || '0', 10);
								setTimeout(function () {
									entry.target.classList.add('wws-visible');
								}, delay);
								obs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.2
					});
					cards.forEach(function (c) {
						obs.observe(c);
					});
				} else {
					cards.forEach(function (c) {
						c.classList.add('wws-visible');
					});
				}
			}());

		</script>

		<script>
			function initAboutFeatures() {
				/* Counter animation */
				function animateCounter(element, to, duration) {
					var suffix = element.getAttribute('data-suffix') || '';
					var startTime = performance.now();

					function update(now) {
						var elapsed = now - startTime;
						var progress = Math.min(elapsed / duration, 1);
						var eased = 1 - Math.pow(1 - progress, 3);
						var current = Math.floor(eased * to);
						element.innerHTML = current + (suffix ? '<span class="counter-suffix">' + suffix + '</span>' : '');
						if (progress < 1) requestAnimationFrame(update);
					}
					requestAnimationFrame(update);
				}

				var counters = document.querySelectorAll('.about-stat .stat-number');

				if ('IntersectionObserver' in window) {
					var counterObs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.animated) {
								entry.target.dataset.animated = 'true';
								var target = parseInt(entry.target.getAttribute('data-count'), 10);
								animateCounter(entry.target, target, 1600);
								counterObs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.4
					});
					counters.forEach(function (c) {
						counterObs.observe(c);
					});
				} else {
					counters.forEach(function (c) {
						animateCounter(c, parseInt(c.getAttribute('data-count'), 10), 1600);
					});
				}

				/* Progress bar animation */
				var progressBars = document.querySelectorAll('.about-progress-bar');

				if ('IntersectionObserver' in window) {
					var progObs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.animated) {
								entry.target.dataset.animated = 'true';
								entry.target.style.width = entry.target.getAttribute('data-width') + '%';
								progObs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.3
					});
					progressBars.forEach(function (bar) {
						progObs.observe(bar);
					});
				} else {
					progressBars.forEach(function (bar) {
						bar.style.width = bar.getAttribute('data-width') + '%';
					});
				}

				/* Parallax effect for About image/video */
				var parallaxMedia = document.querySelector('.about-new-img-wrap img, .about-new-img-wrap video');
				if (parallaxMedia) {
					window.addEventListener('scroll', function () {
						var rect = parallaxMedia.parentElement.getBoundingClientRect();
						var viewHeight = window.innerHeight;
						if (rect.top < viewHeight && rect.bottom > 0) {
							var total = viewHeight + rect.height;
							var current = viewHeight - rect.top;
							var pct = current / total;
							var y = (pct - 0.5) * 50; // Shift range +/- 25px
							parallaxMedia.style.transform = 'translateY(' + y + 'px)';
						}
					});
				}

				/* Read More toggles for Mobile and Laptop */
				var btnReadMore = document.getElementById('btnReadMore');
				var collapseMobile = document.getElementById('aboutCollapseMobile');
				var collapseLaptop = document.getElementById('aboutCollapseLaptop');

				if (btnReadMore && collapseMobile && collapseLaptop) {
					btnReadMore.addEventListener('click', function () {
						var isExpanded = btnReadMore.getAttribute('aria-expanded') === 'true';
						var isMobile = window.innerWidth < 768;

						if (isExpanded) {
							// Collapse
							if (isMobile) {
								collapseMobile.style.maxHeight = '0px';
								collapseMobile.style.opacity = '0';
							}
							collapseLaptop.style.maxHeight = '0px';
							collapseLaptop.style.opacity = '0';

							btnReadMore.setAttribute('aria-expanded', 'false');
							btnReadMore.querySelector('span').textContent = 'Read More';

							// Scroll back to the button
							var rect = btnReadMore.getBoundingClientRect();
							var absoluteTop = (window.scrollY || window.pageYOffset) + rect.top;
							if ('scrollBehavior' in document.documentElement.style) {
								window.scrollTo({
									top: absoluteTop - 200,
									behavior: 'smooth'
								});
							} else {
								window.scrollTo(0, absoluteTop - 200);
							}
						} else {
							// Expand
							if (isMobile) {
								collapseMobile.style.maxHeight = collapseMobile.scrollHeight + 'px';
								collapseMobile.style.opacity = '1';
							}
							collapseLaptop.style.maxHeight = collapseLaptop.scrollHeight + 'px';
							collapseLaptop.style.opacity = '1';

							btnReadMore.setAttribute('aria-expanded', 'true');
							btnReadMore.querySelector('span').textContent = 'Read Less';
						}
					});

					// Update max-height on window resize if currently expanded
					window.addEventListener('resize', function () {
						var isExpanded = btnReadMore.getAttribute('aria-expanded') === 'true';
						var isMobile = window.innerWidth < 768;

						if (isExpanded) {
							if (isMobile) {
								collapseMobile.style.maxHeight = collapseMobile.scrollHeight + 'px';
							} else {
								collapseMobile.style.maxHeight = ''; // reset inline so CSS overrides it
							}
							collapseLaptop.style.maxHeight = collapseLaptop.scrollHeight + 'px';
						} else {
							if (!isMobile) {
								collapseMobile.style.maxHeight = ''; // reset inline style
								collapseMobile.style.opacity = '';
							} else {
								collapseMobile.style.maxHeight = '0px';
								collapseMobile.style.opacity = '0';
							}
						}
					});
				}
			}

			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', initAboutFeatures);
			} else {
				initAboutFeatures();
			}

		</script>

		<!-- 1. NEW ABOUT SECTION -->
		<section class="about-section">
			<div class="container">

				<!-- Tag -->
				<!-- <span class="about-tag">About Us</span> -->

				<!-- Large Statement Title -->
				<!-- <h2 class="about-new-title">
			Find out how TeknoLite got its start <span>with the simple goal of making</span> long-lasting, high-performance LED lighting <span>that add</span> style and brilliance <span>to every space.</span>
		    </h2> -->

				<div class="heading-section">
					<h3 class="wow fadeInUp mb-2 header" style="font-weight:600;"><span class="text-primary">
							TeknoLite</span> India's Trusted LED Lighting Manufacturer</h3>
				</div>

				<!-- Two text columns + Image Column -->
				<div class="row align-items-stretch mt-5">
					<div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
						<!-- Paragraph 1 -->
						<p class="about-new-desc text-justify">
							With over 45 years of industry experience, TeknoLite has established itself as one of
							India's
							leading LED lighting manufacturers, delivering innovative, energy-efficient, and
							high-performance
							lighting solutions for commercial, architectural, industrial, hospitality, retail, and
							residential
							projects.</p>

						<!-- Mobile Collapse Block (Paragraph 2) -->
						<div class="about-collapse-content about-collapse-mobile" id="aboutCollapseMobile"
							style="max-height: 0px; opacity: 0; overflow: hidden;">
							<!-- Paragraph 2 -->
							<p class="about-new-desc text-justify"> Backed by 3 state-of-the-art manufacturing plants,
								12+ offices across India, a strong network
								of 500+ authorised dealers, and the successful completion of 1,000+ lighting projects,
								TeknoLite has
								earned the trust of architects, builders, developers, MEP consultants, interior
								designers,
								electrical contractors, and infrastructure professionals nationwide.
								As a trusted lighting manufacturing company, we design and manufacture a comprehensive
								range of
								premium LED lighting solutions, including indoor lighting, outdoor lighting,
								architectural lighting,
								facade lighting, commercial lighting, office lighting, retail lighting, hospitality
								lighting, and
								landscape lighting.</p>
						</div>

						<!-- Laptop Collapse Block (Paragraphs 3-6) -->
						<div class="about-collapse-content about-collapse-laptop" id="aboutCollapseLaptop"
							style="max-height: 0px; opacity: 0; overflow: hidden;">
							<p class="about-new-desc text-justify"> Every product is developed using advanced
								engineering, precision manufacturing, and strict
								quality standards to ensure exceptional illumination, durability, energy efficiency, and
								longevity.</p>
							<p class="about-new-desc text-justify"> Whether it's a corporate office, luxury residence,
								hotel, retail showroom, healthcare facility,
								educational institution, or large-scale commercial development, TeknoLite delivers
								lighting
								solutions that combine performance, design, and sustainability.</p>
							<p class="about-new-desc text-justify">Our commitment to quality, innovation, and customer
								satisfaction has made TeknoLite a preferred commercial lighting manufacturer and
								architectural lighting solutions provider for projects across India.</p>
							<p class="about-new-desc text-justify">More than a manufacturer, TeknoLite is your trusted
								lighting partner—committed to innovation, quality and delivering excellence in every
								project.</p>
						</div>

						<!-- Single Toggle Button -->
						<button type="button" class="btn-readmore" id="btnReadMore" aria-expanded="false"
							aria-controls="aboutCollapseMobile aboutCollapseLaptop">
							<span>Read More</span> <span class="icon-arrow"></span>
						</button>
					</div>
					<div class="col-lg-6">
						<div class="about-new-img-wrap">
							<video autoplay loop muted playsinline>
								<source src="<?php echo base_url() ?>assets/images/banner/about.mp4" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
					</div>
				</div>

				<!-- Clean horizontal statistics strip -->
				<div class="about-stats">
					<div class="about-stat">
						<h3 class="stat-number" data-count="45" data-suffix="+">0</h3>
						<p>Years Experience</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="3">0</h3>
						<p>Plants</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="12" data-suffix="+">0</h3>
						<p>Offices</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="500" data-suffix="+">0</h3>
						<p>Dealers</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="1000" data-suffix="+">0</h3>
						<p>Projects</p>
					</div>
				</div>

			</div>
		</section>


		<!-- =====================================================
             5. WHY CHOOSE US - EXACT SECTION NOT PRESENT IN ORIGINAL CODE
             Requested items: Quality Products, Competitive Pricing, Expert Support,
             Custom Solutions, Reliable Service, Quick Response.
             Original template has a separate Benefits block with different items;
             it has not been used here as a replacement.
             SPACE RESERVED TO ADD THIS SECTION LATER.
        ====================================================== -->
		<!-- 6. WHO WE SERVE -->
		<section class="who-we-serve-section">
			<div class="container position-relative" style="z-index:1;">

				<!-- Heading -->
				<div class="row justify-content-center text-center mb-5">
					<div class="col-lg-7">
						<!-- <span class="wws-section-badge">Our Clients</span> -->
						<h3 class="wow fadeInUp mb-2 header text-white" style="font-weight:600;">Who We<span
								class="text-primary"> Serve</span></h3>
						<p class="wws-subtitle">Premium lighting solutions tailored for Architects, Interior Designers,
							Builders and Lighting Consultants.</p>
					</div>
				</div>

				<!-- Flip Cards -->
				<div class="row gy-4 justify-content-center">

					<!-- Card 1: Architects -->
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="flip-card-wrapper" data-wws-delay="0">
							<div class="flip-card-inner">
								<!-- Front -->
								<div class="flip-card-front">
									<div class="flip-icon-wrap">
										<img src="<?php echo base_url()?>assets/images/icons/light.png"
											alt="Architects">
									</div>
									<h5>ARCHITECTS</h5>
									<p class="flip-hint">Hover to explore <span class="flip-hint-arrow">&#8594;</span>
									</p>
								</div>
								<!-- Back -->
								<div class="flip-card-back">
									<div class="flip-back-icon"><i class="icon-pencilline"></i></div>
									<h5>ARCHITECTS</h5>
									<div class="flip-divider"></div>
									<p>Lighting consultation &amp; bespoke solutions crafted for every architectural
										vision and
										space.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Card 2: Interior Designers -->
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="flip-card-wrapper" data-wws-delay="120">
							<div class="flip-card-inner">
								<div class="flip-card-front">
									<div class="flip-icon-wrap">
										<img src="<?php echo base_url()?>assets/images/icons/ceiling.png"
											alt="Interior Designers">
									</div>
									<h5>INTERIOR DESIGNERS</h5>
									<p class="flip-hint">Hover to explore <span class="flip-hint-arrow">&#8594;</span>
									</p>
								</div>
								<div class="flip-card-back">
									<div class="flip-back-icon"><i class="icon-swatchbook"></i></div>
									<h5>INTERIOR DESIGNERS</h5>
									<div class="flip-divider"></div>
									<p>Elegant &amp; decorative LED fixtures that elevate interiors with warmth, style
										and
										atmosphere.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Card 3: Builders & Developers -->
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="flip-card-wrapper" data-wws-delay="240">
							<div class="flip-card-inner">
								<div class="flip-card-front">
									<div class="flip-icon-wrap">
										<img src="<?php echo base_url()?>assets/images/icons/bulb.png"
											alt="Builders Developers">
									</div>
									<h5>BUILDERS &amp; DEVELOPERS</h5>
									<p class="flip-hint">Hover to explore <span class="flip-hint-arrow">&#8594;</span>
									</p>
								</div>
								<div class="flip-card-back">
									<div class="flip-back-icon"><i class="icon-buildings"></i></div>
									<h5>BUILDERS &amp; DEVELOPERS</h5>
									<div class="flip-divider"></div>
									<p>Bulk supply, reliable on-site delivery and dedicated project support at every
										scale.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Card 4: Commercial Projects -->
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="flip-card-wrapper" data-wws-delay="360">
							<div class="flip-card-inner">
								<div class="flip-card-front">
									<div class="flip-icon-wrap">
										<img src="<?php echo base_url()?>assets/images/icons/lamp.png"
											alt="Commercial Projects">
									</div>
									<h5>COMMERCIAL PROJECTS</h5>
									<p class="flip-hint">Hover to explore <span class="flip-hint-arrow">&#8594;</span>
									</p>
								</div>
								<div class="flip-card-back">
									<div class="flip-back-icon"><i class="icon-storefront"></i></div>
									<h5>COMMERCIAL PROJECTS</h5>
									<div class="flip-divider"></div>
									<p>End-to-end LED lighting solutions for offices, hotels, retail, healthcare &amp;
										large
										developments.</p>
								</div>
							</div>
						</div>
					</div>

				</div><!-- /row -->
			</div><!-- /container -->
		</section>


		<!-- =====================================================
             6. CASE STUDIES & TESTIMONIAL SHOWCASE - DYNAMIC SECTION
        ====================================================== -->
		<?php
		if (empty($case_studies)) {
			if (isset($this->casestudy_model)) {
				$case_studies = $this->casestudy_model->getActiveCaseStudies();
			}
		}
		if (empty($case_studies)) {
			$case_studies = [
				[
					'title' => 'Indoor Residential Lighting Collection',
					'slug' => 'indoor-lighting-collection',
					'client' => 'The Horizon Villa',
					'industry' => 'Residential',
					'location' => 'South Mumbai, Maharashtra',
					'featured_image' => 'assets/images/project/project1.jpeg',
					'overview' => 'Fantastic shop! Great selection, fair prices, and friendly staff. Highly recommended. The quality of the products is exceptional, and the prices are very reasonable!'
				],
				[
					'title' => 'Modern Office Lighting Solution',
					'slug' => 'modern-office-lighting-solution',
					'client' => 'NexGen Fintech Headquarters',
					'industry' => 'Commercial',
					'location' => 'Bandra-Kurla Complex (BKC), Mumbai',
					'featured_image' => 'assets/images/project/project2.jpeg',
					'overview' => 'High-performance commercial lighting solution designed to create comfortable, balanced and functional illumination across a modern workspace with anti-glare linear profiles.'
				],
				[
					'title' => 'Decorative LED Fixtures for Hospitality',
					'slug' => 'decorative-led-fixtures-hospitality',
					'client' => 'The Grand Pavilion Resort & Spa',
					'industry' => 'Hospitality',
					'location' => 'North Goa, India',
					'featured_image' => 'assets/images/project/project3.jpeg',
					'overview' => 'Sophisticated architectural and accent lighting tailored for luxury hotel lobbies, fine dining restaurants, and outdoor landscape illumination with bespoke decorative fixtures.'
				],
				[
					'title' => 'Architectural Retail Gallery Illumination',
					'slug' => 'architectural-retail-gallery-illumination',
					'client' => 'Lumina Luxury Boutique',
					'industry' => 'Retail',
					'location' => 'Indiranagar, Bengaluru',
					'featured_image' => 'assets/images/project/project11.jpeg',
					'overview' => 'High-CRI track and spot lighting system engineered to bring out rich colors and textures of premium designer collections with museum-grade color rendering.'
				]
			];
		}
		?>
		<!-- =====================================================
             6. OUR PROJECTS - DYNAMIC SHOWCASE SECTION
        ====================================================== -->
		<section class="flat-spacing-2 pt-9 section-case-studies">
			<div class="container">
				<!-- Section Heading -->
				<div class="heading-section style-2 mb_40 align-items-center">
					<div class="left">
						<h3 class="wow fadeInUp">
							Our <span class="text-primary">Projects</span>
						</h3>
						<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">
							Explore our diverse range of lighting solutions crafted for commercial, residential and architectural spaces.
						</p>
					</div>
					<div class="right d-flex align-items-center gap-20 wow fadeInUp">
						<a href="<?= base_url('casestudy'); ?>" class="btn-line">
							<span>View All Projects</span>
							<i class="icon-arrow-up-right"></i>
						</a>
						<div class="wrap-button d-none d-md-flex gap-12">
							<div class="sw-button swiper-button-prev nav-prev-project has-border"></div>
							<div class="sw-button swiper-button-next nav-next-project has-border"></div>
						</div>
					</div>
				</div>

				<!-- Unified Swiper: Content & Matching Image slide together simultaneously -->
				<div class="swiper tf-sw-our-projects" data-preview="1" data-space-lg="30" data-space-md="20" data-space="15">
					<div class="swiper-wrapper">
						<?php foreach ($case_studies as $cs): ?>
						<?php 
							$featuredImg = !empty($cs['featured_image']) ? base_url($cs['featured_image']) : base_url('assets/images/project/project1.jpeg');
							$csDetailUrl = base_url('casestudydetail/' . ($cs['slug'] ?? ''));
						?>
						<div class="swiper-slide">
							<div class="row align-items-center g-4">
								<!-- Left Column: Project Name, Overview, Client -->
								<div class="col-lg-6 col-md-12">
									<div class="testimonial-item hover-img style-3 our-project-item">
										<div class="content">
											<div class="content-top mb-0">
												<div class="box-icon wow fadeInUp">
													<div class="icon">
														<i class="icon-quote-1"></i>
													</div>
													<p class="text-title text-primary font-weight-600">
														<?= html_escape($cs['industry'] ?? 'Lighting'); ?> Project
													</p>
												</div>

												<!-- Prominent Project Name -->
												<div class="project-header-info wow fadeInUp" data-wow-delay="0.08s">
													<h3 class="project-title text-onsurface mb-2">
														<a href="<?= $csDetailUrl; ?>" class="link">
															<?= html_escape($cs['title'] ?? 'Our Project'); ?>
														</a>
													</h3>
													<div class="project-tags-row d-flex align-items-center flex-wrap gap-2 mb-3">
														<span class="text-body-small text_secondary">
															<i class="icon-map-pin"></i> <?= html_escape($cs['location'] ?? 'India'); ?>
														</span>
														<?php if (!empty($cs['case_study_code'])): ?>
															<span class="text_secondary2">&bull;</span>
															<span class="text-body-small text-primary font-weight-600"><?= html_escape($cs['case_study_code']); ?></span>
														<?php endif; ?>
													</div>
												</div>

												<!-- Project Overview / Quote -->
												<h5 class="text-onsurface project-quote wow fadeInUp" data-wow-delay="0.12s">
													"<?= html_escape(trim($cs['overview'] ?? '', '"\' ')); ?>"
												</h5>

												<!-- Client, Rating & Slide Navigation Controls -->
												<div class="box-author d-flex align-items-center justify-content-between flex-wrap gap-3 pt-2 wow fadeInUp" data-wow-delay="0.16s">
													<div class="author-meta">
														<div class="list-star-default color-primary mb-1">
															<i class="icon icon-star"></i>
															<i class="icon icon-star"></i>
															<i class="icon icon-star"></i>
															<i class="icon icon-star"></i>
															<i class="icon icon-star"></i>
														</div>
														<h6 class="author mb-0">
															<a href="<?= $csDetailUrl; ?>" class="link">
																<?= html_escape($cs['client'] ?? 'Client'); ?><span
																	class="text-title text_secondary2"> / <?= html_escape($cs['industry'] ?? 'Architecture'); ?></span>
															</a>
														</h6>
													</div>

													<div class="d-flex align-items-center flex-wrap gap-2">
														<a href="<?= $csDetailUrl; ?>" class="tf-btn btn-sm btn-fill radius-4">
															<span>Explore Project</span>
															<i class="icon-arrow-up-right"></i>
														</a>
														<div class="wrap-button d-flex gap-2">
															<div class="sw-button swiper-button-prev nav-prev-project has-border" title="Previous Project"></div>
															<div class="sw-button swiper-button-next nav-next-project has-border" title="Next Project"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Right Column: Matching Image of the Same Project -->
								<div class="col-lg-6 col-md-12">
									<div class="collection-position style-3 our-project-banner">
										<div class="img-style">
											<a href="<?= $csDetailUrl; ?>" class="d-block w-100 h-100">
												<img class="lazyload effect-paralax"
													data-src="<?= $featuredImg; ?>"
													src="<?= $featuredImg; ?>"
													alt="<?= html_escape($cs['title'] ?? 'Our Project'); ?>">
											</a>
										</div>
										<div class="content cls-content">
											<div class="cart-item style-2 bundle-hover-item">
												<div class="image-cart">
													<a href="<?= $csDetailUrl; ?>">
														<img class="lazyload"
															data-src="<?= $featuredImg; ?>"
															src="<?= $featuredImg; ?>"
															alt="<?= html_escape($cs['title'] ?? 'Our Project'); ?>">
													</a>
												</div>
												<div class="info">
													<div class="name text-body-default">
														<a href="<?= $csDetailUrl; ?>" class="link text-title">
															<?= html_escape($cs['title'] ?? 'Project Details'); ?>
														</a>
													</div>
													<div class="price text-button">
														<a href="<?= $csDetailUrl; ?>" class="link text-primary">
															<?= html_escape($cs['location'] ?? 'India'); ?> &bull; View Project <i class="icon-arrow-up-right"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

					<!-- Bottom Navigation Arrows (mobile visible) -->
					<div class="wrap-button our-projects-nav-bottom d-flex d-md-none justify-content-center mt-4 gap-12">
						<div class="sw-button swiper-button-prev nav-prev-project has-border"></div>
						<div class="sw-button swiper-button-next nav-next-project has-border"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- /OUR PROJECTS -->

		<script>
			(function() {
				function initOurProjects() {
					if (typeof Swiper !== 'undefined') {
						var el = document.querySelector('.tf-sw-our-projects');
						if (el && !el.swiper) {
							new Swiper(el, {
								slidesPerView: 1,
								spaceBetween: 30,
								speed: 800,
								loop: true,
								observer: true,
								observeParents: true,
								navigation: {
									clickable: true,
									nextEl: ".nav-next-project",
									prevEl: ".nav-prev-project",
								},
							});
						}
					} else {
						setTimeout(initOurProjects, 100);
					}
				}
				if (document.readyState === 'loading') {
					document.addEventListener('DOMContentLoaded', initOurProjects);
				} else {
					initOurProjects();
				}
			})();
		</script>


		<!-- =====================================================
             7. LATEST BLOGS - EXISTING "NEWS INSIGHT" SECTION
             Existing: blog image, title, date, short description, Read More CTA
        ====================================================== -->
		<!-- News Insight -->
		<?php 
		$homeBlogs = !empty($latest_blogs) ? $latest_blogs : [];
		if (empty($homeBlogs) && class_exists('CI_Controller')) {
			$CI =& get_instance();
			if (!isset($CI->blog_model)) {
				$CI->load->model('Blog_model', 'blog_model');
			}
			$homeBlogs = $CI->blog_model->getLatestBlogs(3);
		}
		$mainBlog = !empty($homeBlogs[0]) ? $homeBlogs[0] : null;
		$sideBlogs = array_slice($homeBlogs, 1, 2);
		?>
		<section class="flat-spacing-2 section-news-insight">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-section">
							<h3 class="wow fadeInUp">Lighting Insights</h3>
							<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">Discover
								premium LED lighting solutions designed for every project and space. </p>
						</div>
					</div>
				</div>
				<div class="row">
					<?php if ($mainBlog): 
						$mainUrl = base_url('blog/' . $mainBlog['slug']);
						$mainImg = !empty($mainBlog['image_url']) ? $mainBlog['image_url'] : base_url('assets/images/banner/news.jpg');
					?>
					<div class="col-lg-6 col-xl-7">
						<div class="collection-position style-2 spacing-2 has-over">
							<a href="<?= $mainUrl; ?>" class="img-style no-opacity w-100">
								<img class="lazyload " data-src="<?= $mainImg; ?>"
									src="<?= $mainImg; ?>" alt="<?= htmlspecialchars($mainBlog['title']); ?>">
							</a>
							<div class="content cls-content">
								<div class="cls-heading">
									<ul class="meta mb-0">
										<li class="text-button-small"><a href="<?= $mainUrl; ?>" class="link text-white"><?= htmlspecialchars($mainBlog['formatted_date']); ?></a></li>
										<li class="text-button-small text-white">by <a href="<?= $mainUrl; ?>"
												class="link text-white"><?= htmlspecialchars($mainBlog['author']); ?></a></li>
									</ul>
									<div>
										<h4 class="mb_8">
											<a href="<?= $mainUrl; ?>" class="link text_white"><?= htmlspecialchars($mainBlog['title']); ?></a>
										</h4>
										<p class="text_white"><?= htmlspecialchars(mb_strimwidth($mainBlog['short_description'] ?? '', 0, 120, '...')); ?></p>
									</div>
								</div>
								<a href="<?= $mainUrl; ?>" class="link text-white text-button">Read More</a>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="col-lg-6 col-xl-7">
						<div class="collection-position style-2 spacing-2 has-over">
							<a href="<?= base_url('blog'); ?>" class="img-style no-opacity w-100">
								<img class="lazyload " data-src="assets/images/banner/news.jpg"
									src="assets/images/banner/news.jpg" alt="banner-cls">
							</a>
							<div class="content cls-content">
								<div class="cls-heading">
									<ul class="meta mb-0">
										<li class="text-button-small"><a href="<?= base_url('blog'); ?>" class="link text-white"><?= date('F d, Y'); ?></a></li>
										<li class="text-button-small text-white">by <a href="<?= base_url('blog'); ?>"
												class="link text-white">TeknoLite</a></li>
									</ul>
									<div>
										<h4 class="mb_8">
											<a href="<?= base_url('blog'); ?>" class="link text_white">Lighting Design for Modern Architecture</a>
										</h4>
										<p class="text_white">Explore practical lighting ideas, product guidance and design insights for better illumination.</p>
									</div>
								</div>
								<a href="<?= base_url('blog'); ?>" class="link text-white text-button">Read More</a>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<div class="col-lg-6 col-xl-5">
						<div class="relatest-post">
							<?php if (!empty($sideBlogs)): ?>
								<?php foreach ($sideBlogs as $sb): 
									$sbUrl = base_url('blog/' . $sb['slug']);
									$sbImg = !empty($sb['image_url']) ? $sb['image_url'] : base_url('assets/images/banner/insights1.jpg');
								?>
								<div class="relatest-post-item style-2 style-row hover-image">
									<div class="image">
										<a href="<?= $sbUrl; ?>">
											<img class="lazyload" data-src="<?= $sbImg; ?>"
												src="<?= $sbImg; ?>" alt="<?= htmlspecialchars($sb['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
										</a>
										<div class="article-label">
											<a href="<?= base_url('blog?category=' . urlencode($sb['category_slug'])); ?>" class="text-button-small"><?= htmlspecialchars($sb['category']); ?></a>
										</div>
									</div>
									<div class="content">
										<ul class="meta">
											<li class="text-button-small"><a href="<?= $sbUrl; ?>" class="link"><?= htmlspecialchars($sb['formatted_date']); ?></a></li>
											<li class="text-button-small">by <a href="<?= $sbUrl; ?>" class="link"><?= htmlspecialchars($sb['author']); ?></a></li>
										</ul>
										<h5 class="title mb-0">
											<a class="link" href="<?= $sbUrl; ?>"><?= htmlspecialchars($sb['title']); ?></a>
										</h5>
										<p><?= htmlspecialchars(mb_strimwidth($sb['short_description'] ?? '', 0, 100, '...')); ?></p>
										<a href="<?= $sbUrl; ?>" class="text-button link text-decoration">Read More</a>
									</div>
								</div>
								<?php endforeach; ?>
							<?php else: ?>
								<div class="relatest-post-item style-2 style-row hover-image">
									<div class="image">
										<a href="<?= base_url('blog'); ?>">
											<img class="lazyload" data-src="assets/images/banner/insights1.jpg"
												src="assets/images/banner/insights1.jpg" alt="">
										</a>
										<div class="article-label">
											<a href="<?= base_url('blog'); ?>" class="text-button-small">Lighting Guide</a>
										</div>
									</div>
									<div class="content">
										<ul class="meta">
											<li class="text-button-small"><a href="<?= base_url('blog'); ?>" class="link"><?= date('F d, Y'); ?></a></li>
											<li class="text-button-small">by <a href="<?= base_url('blog'); ?>" class="link">TeknoLite</a></li>
										</ul>
										<h5 class="title mb-0">
											<a class="link" href="<?= base_url('blog'); ?>">Lighting Tips for Modern Spaces</a>
										</h5>
										<p>Explore practical lighting ideas, product guidance and design insights.</p>
										<a href="<?= base_url('blog'); ?>" class="text-button link text-decoration">Read More</a>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section><!-- /.News Insight -->

		<!-- Continuous testimonial wall -->
		<section class="flat-spacing-2 pt-0 teknolite-testimonial-wall">
			<div class="container">
				<div class="testimonial-grid" aria-label="Client testimonials">
					<?php
					$testimonials = [
						['text' => 'Excellent product quality, modern lighting options and responsive project support. TeknoLite has been a dependable lighting partner from selection through delivery.', 'name' => 'Sanjay Kulkarni', 'role' => 'Commercial Consultant'],
						['text' => 'The team understood our architectural brief quickly and helped us create a warm, polished lighting scheme for the entire property.', 'name' => 'Priya Mehta', 'role' => 'Interior Designer'],
						['text' => 'Reliable products, clear technical guidance and a smooth delivery process. We would gladly work with TeknoLite again.', 'name' => 'Arjun Shah', 'role' => 'Project Director'],
						['text' => 'The lighting quality is excellent and the support team made product selection easy for our commercial renovation.', 'name' => 'Neha Rao', 'role' => 'Architect'],
						['text' => 'TeknoLite delivered a consistent finish across every space. The result looks refined both day and night.', 'name' => 'Vikram Iyer', 'role' => 'Hospitality Consultant'],
						['text' => 'Thoughtful recommendations, dependable timelines and fixtures that perform exactly as specified.', 'name' => 'Rhea Kapoor', 'role' => 'Design Lead']
					];
					for ($column = 0; $column < 3; $column++):
					?>
					<div class="testimonial-column <?= $column === 1 ? 'scroll-down' : 'scroll-up'; ?>">
						<div class="testimonial-track">
							<?php for ($copy = 0; $copy < 2; $copy++): ?>
							<?php foreach ($testimonials as $testimonial): ?>
							<article class="testimonial-wall-card">
								<div class="testimonial-wall-stars" aria-label="5 out of 5 stars">
									<i class="icon icon-star"></i><i class="icon icon-star"></i><i
										class="icon icon-star"></i><i class="icon icon-star"></i><i
										class="icon icon-star"></i>
								</div>
								<p><?= html_escape($testimonial['text']); ?></p>
								<div class="testimonial-wall-author">
									<span
										class="testimonial-wall-avatar"><?= html_escape(substr($testimonial['name'], 0, 1)); ?></span>
									<span><strong><?= html_escape($testimonial['name']); ?></strong><small><?= html_escape($testimonial['role']); ?></small></span>
								</div>
							</article>
							<?php endforeach; ?>
							<?php endfor; ?>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
		</section><!-- /.testimonial -->

		<!-- CTA Section is loaded globally via components/footer.php -->


		<!-- =====================================================
             14. FOOTER - EXISTING COMPONENT INCLUDE
             Footer content is maintained in components/footer.php.
             Its internal fields cannot be verified from this home.php file alone.
        ====================================================== -->
		<!-- .footer -->
		<?php $this->load->view('components/footer')?>

		<!-- /.footer -->

	</div>

	<!-- mobile menu -->
	<?php $this->load->view('components/offcanvas')?>
	<!-- /mobile menu -->

	<!-- Categories -->
	<div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
		<div class="canvas-wrapper">
			<div class="canvas-header">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
					<path
						d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
					</path>
				</svg>
				<h5>Categories</h5>
				<span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
			</div>
			<div class="canvas-body">
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forChair"
						data-bs-toggle="collapse" aria-expanded="true" aria-controls="forChair">
						<img class="avt" src="assets/images/shop/product-1.jpg" alt="avt">
						<span class="title">Indoor Lighting</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forChair" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/product-1.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Down Lights</span></a>
							</li>
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/product-1.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Spot Lights</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forDesk" data-bs-toggle="collapse"
						aria-expanded="true" aria-controls="forDesk">
						<img class="avt" src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt">
						<span class="title">Commercial Lighting</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forDesk" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Office Lighting</span></a>
							</li>
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Retail Lighting</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forPhone"
						data-bs-toggle="collapse" aria-expanded="true" aria-controls="forPhone">
						<img class="avt" src="assets/images/shop/product-5.jpg" alt="avt">
						<span class="title">Outdoor Lighting</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forPhone" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/product-5.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Garden Lights</span></a>
							</li>
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/shop/product-5.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Facade Lighting</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forLamp" data-bs-toggle="collapse"
						aria-expanded="true" aria-controls="forLamp">
						<img class="avt" src="assets/images/gallery/gallery-3.jpg" alt="avt">
						<span class="title">Decorative Lighting</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forLamp" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/gallery/gallery-3.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Decorative Light</span></a>
							</li>
							<li>
								<a href="<?= base_url('product'); ?>" class="item link"><img class="avt"
										src="assets/images/gallery/gallery-3.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Architectural Light</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Categories -->



	<!-- .quickView -->
	<div class="modal fullRight fade modal-quick-view" id="quickView">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="tf-quick-view-image">
					<div class="wrap-quick-view wrapper-scroll-quickview">
						<div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
							<img class="lazyload" data-src="assets/images/shop/quickview-slidebar-1.jpg"
								src="assets/images/shop/quickview-slidebar-1.jpg" alt="">
						</div>
						<div class="quickView-item item-scroll-quickview" data-scroll-quickview="gray">
							<img class="lazyload" data-src="assets/images/shop/quickview-slidebar-2.jpg"
								src="assets/images/shop/quickview-slidebar-2.jpg" alt="">
						</div>
						<div class="quickView-item item-scroll-quickview" data-scroll-quickview="grey">
							<img class="lazyload" data-src="assets/images/shop/quickview-slidebar-3.jpg"
								src="assets/images/shop/quickview-slidebar-3.jpg" alt="">
						</div>
						<div class="quickView-item item-scroll-quickview">
							<img class="lazyload" data-src="assets/images/shop/quickview-slidebar-4.jpg"
								src="assets/images/shop/quickview-slidebar-4.jpg" alt="">
						</div>
						<div class="quickView-item item-scroll-quickview">
							<img class="lazyload" data-src="assets/images/shop/quickview-slidebar-5.jpg"
								src="assets/images/shop/quickview-slidebar-5.jpg" alt="">
						</div>
					</div>
				</div>
				<div class="wrap">
					<div class="header">
						<h5 class="title">Quick View</h5>
						<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
					</div>
					<div class="tf-product-info-list">
						<div class="tf-product-info-heading">
							<div class="tf-product-info-name">
								<h3 class="name">COB Spot Light</h3>
								<div class="sub">
									<div class="tf-product-info-rate">
										<div class="list-star-default">
											<i class="icon icon-star"></i>
											<i class="icon icon-star"></i>
											<i class="icon icon-star"></i>
											<i class="icon icon-star"></i>
											<i class="icon icon-star"></i>
										</div>
										<div class="text text-caption-1">(134 reviews)</div>
									</div>
									<div class="tf-product-info-sold">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M16.7076 9.80077L7.95759 19.1758C7.86487 19.2747 7.74247 19.3408 7.60888 19.3641C7.47528 19.3874 7.33773 19.3666 7.21699 19.3049C7.09625 19.2432 6.99886 19.1438 6.93953 19.0219C6.88019 18.8999 6.86213 18.762 6.88806 18.6289L8.03338 12.9L3.53103 11.2094C3.43434 11.1732 3.34811 11.1136 3.28005 11.036C3.21199 10.9584 3.16422 10.8651 3.14101 10.7645C3.11779 10.6639 3.11986 10.5591 3.14702 10.4595C3.17418 10.3599 3.22559 10.2686 3.29666 10.1937L12.0467 0.818744C12.1394 0.719788 12.2618 0.653675 12.3954 0.630383C12.529 0.60709 12.6665 0.627882 12.7873 0.68962C12.908 0.751359 13.0054 0.850694 13.0647 0.972636C13.1241 1.09458 13.1421 1.23251 13.1162 1.36562L11.9677 7.10077L16.4701 8.78906C16.5661 8.82547 16.6516 8.88496 16.7191 8.96228C16.7867 9.0396 16.8341 9.13236 16.8573 9.23237C16.8805 9.33237 16.8786 9.43655 16.852 9.53569C16.8253 9.63482 16.7747 9.72587 16.7045 9.80077H16.7076Z"
												fill="#DC9056" />
										</svg>

										<div class="text text-caption-1">18 sold in last 32 hours</div>
									</div>
								</div>
							</div>
							<div class="tf-product-info-desc">
								<div class="tf-product-info-price">
									<h5 class="price-on-sale">$79.99</h5>
									<div class="compare-at-price">$98.99</div>
									<div class="badges-on-sale text-btn-uppercase">-25%
									</div>
								</div>
								<p>Engineered for efficient illumination, reliable performance and long service life
									across modern lighting applications.</p>
								<div class="tf-product-info-liveview">
									<i class="icon icon-eye"></i>
									<p class="text-caption-1">
										<span class="liveview-count">28</span>
										people are viewing this right now
									</p>
								</div>
							</div>
						</div>
						<div class="tf-product-info-choose-option">
							<div class="variant-picker-item">
								<div class="variant-picker-label mb_12">
									Finishes:<span class="text-title variant-picker-label-value">Beige</span>
								</div>
								<div class="variant-picker-values">
									<input id="values-beige1" type="radio" name="color2" checked>
									<label
										class="hover-tooltip tooltip-bot radius-60 color-btn btn-scroll-quickview active"
										data-slide="0" data-price="79.99" for="values-beige1" data-value="Beige"
										data-scroll-quickview="beige">
										<span class="btn-checkbox bg-color-beige1"></span>
										<span class="tooltip">Beige</span>
									</label>
									<input id="values-gray1" type="radio" name="color2">
									<label class="hover-tooltip tooltip-bot radius-60 color-btn btn-scroll-quickview"
										data-slide="1" data-price="79.99" for="values-gray1" data-value="Gray"
										data-scroll-quickview="gray">
										<span class="btn-checkbox bg-color-gray"></span>
										<span class="tooltip">Gray</span>
									</label>
									<input id="values-grey1" type="radio" name="color2">
									<label class="hover-tooltip tooltip-bot radius-60 color-btn btn-scroll-quickview"
										data-slide="2" data-price="89.99" for="values-grey1" data-value="Grey"
										data-scroll-quickview="grey">
										<span class="btn-checkbox bg-color-grey"></span>
										<span class="tooltip">Grey</span>
									</label>
								</div>
							</div>
							<div class="variant-picker-item">
								<div class="d-flex justify-content-between mb_12">
									<div class="variant-picker-label">
										Wattage:<span class="text-title variant-picker-label-value">18W</span>
									</div>
									<a class="size-guide text-title link show-size-guide">Specification Guide</a>
								</div>
								<div class="variant-picker-values gap12">
									<input type="radio" name="size2" id="values-s1">
									<label class="style-text size-btn" for="values-s1" data-value="Size A - Small">
										<span class="text-title">7W</span>
									</label>
									<input type="radio" name="size2" id="values-m1">
									<label class="style-text size-btn" for="values-m1" data-price="89.99"
										data-value="Size B - Medium">
										<span class="text-title">12W</span>
									</label>

								</div>
							</div>
							<div class="tf-product-info-quantity">
								<div class="title mb_12">Quantity:</div>
								<div class="wg-quantity">
									<span class="btn-quantity btn-decrease">-</span>
									<input class="quantity-product" type="text" name="number" value="1">
									<span class="btn-quantity btn-increase">+</span>
								</div>
							</div>
							<div>
								<div class="tf-product-info-by-btn mb_10">
									<a class="tf-btn btn-onsurface flex-grow-1   show-shopping-cart">
										<span>Add to cart -&nbsp;</span>
										<span class="tf-qty-price total-price">$79.99</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon hover-tooltip compare  show-compare">
										<span class="icon icon-compare"></span>
										<span class="tooltip text-caption-2">Compare</span>
									</a>
									<a href="javascript:void(0);"
										class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip text-caption-2">Wishlist</span>
									</a>
								</div>
								<a href="#" class="tf-btn btn-primary w-full">Enquire Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.quickView -->

	<!-- .compare -->
	<div class="modal fade modal-compare" id="compare">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
				<div class="tf-compare-table">
					<div class="tf-compare-row tf-compare-grid">
						<div class="tf-compare-col d-md-block d-none"></div>
						<div class="tf-compare-col">
							<div class="tf-compare-item">
								<a class="tf-compare-image" href="<?= base_url('productdetail'); ?>">
									<img class="lazyload" data-src="assets/images/shop/product-10.jpg" loading="lazy"
										decoding="async" src="assets/images/shop/product-10.jpg" alt="img-compare">
								</a>
								<div class="tf-compare-content">
									<a class="link text-title text-line-clamp-1"
										href="<?= base_url('productdetail'); ?>">RLD RD Down
										Light</a>
								</div>
							</div>
						</div>
						<div class="tf-compare-col">
							<div class="tf-compare-item">
								<a class="tf-compare-image" href="<?= base_url('productdetail'); ?>">
									<img class="lazyload" data-src="assets/images/shop/product-4.jpg" loading="lazy"
										decoding="async" src="assets/images/shop/product-4.jpg" alt="img-compare">
								</a>
								<div class="tf-compare-content">
									<a class="link text-title text-line-clamp-1"
										href="<?= base_url('productdetail'); ?>">Office
										Lighting </a>
								</div>
							</div>
						</div>
						<div class="tf-compare-col">
							<div class="tf-compare-item">
								<a class="tf-compare-image" href="<?= base_url('productdetail'); ?>">
									<img class="lazyload" data-src="assets/images/shop/product-11.jpg" loading="lazy"
										decoding="async" src="assets/images/shop/product-11.jpg" alt="img-compare">
								</a>
								<div class="tf-compare-content">
									<a class="link text-title text-line-clamp-1"
										href="<?= base_url('productdetail'); ?>">Premium LED
										Downlight</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Rating</h6>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-rate">
							<div class="list-star">
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
							</div>
							<span>(134 reviews)</span>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-rate">
							<div class="list-star">
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
							</div>
							<span>(134 reviews)</span>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-rate">
							<div class="list-star">
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
								<span class="icon icon-star"></span>
							</div>
							<span>(134 reviews)</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Price</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="price">$68.00</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="price">$68.00</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="price">$68.00</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Type</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="type">Downlight</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="type">Downlight</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="type">Downlight</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Brand</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="brand">-</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="brand">-</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="brand">-</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Wattage</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Size A, Size B</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Size A, Size B</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Size A, Size B</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>CCT</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<div class="list-compare-color justify-content-center">
								<span class="item bg-color-beige1"></span>
								<span class="item bg-color-grey"></span>
								<span class="item bg-color-grey"></span>

							</div>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<div class="list-compare-color justify-content-center">
								<span class="item bg-color-beige1"></span>
								<span class="item bg-color-grey"></span>
								<span class="item bg-color-grey"></span>

							</div>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<div class="list-compare-color justify-content-center">
								<span class="item bg-color-beige1"></span>
								<span class="item bg-color-grey"></span>
								<span class="item bg-color-grey"></span>

							</div>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Material</h6>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Aluminium</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Polycarbonate</span>
						</div>
						<div class="tf-compare-col tf-compare-field text-center">
							<span class="size">Glass</span>
						</div>
					</div>
					<div class="tf-compare-row">
						<div class="tf-compare-col tf-compare-field d-md-block d-none">
							<h6>Add to Enquiry</h6>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center">
							<a href="#wishlistModal" data-bs-toggle="modal" class="btn-view-cart">Add to Enquiry</a>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center">
							<a href="#wishlistModal" data-bs-toggle="modal" class="btn-view-cart">Add to Enquiry</a>
						</div>
						<div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center">
							<a href="#wishlistModal" data-bs-toggle="modal" class="btn-view-cart">Add to Enquiry</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.compare -->

	<!-- size-guide -->
	<div class="modal fade modal-size-guide" id="size-guide">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content widget-tabs style-2">
				<table class="tab-sizeguide-table">
					<thead>
						<tr>
							<th>Size</th>
							<th>US</th>
							<th>Bust</th>
							<th>Waist</th>
							<th>Low Hip</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>XS</td>
							<td>2</td>
							<td>32</td>
							<td>24 - 25</td>
							<td>33 - 34</td>
						</tr>
						<tr>
							<td>S</td>
							<td>4</td>
							<td>26 - 27</td>
							<td>34 - 35</td>
							<td>35 - 26</td>
						</tr>
						<tr>
							<td>M</td>
							<td>6</td>
							<td>28 - 29</td>
							<td>36 - 37</td>
							<td>38 - 40</td>
						</tr>
						<tr>
							<td>L</td>
							<td>8</td>
							<td>30 - 31</td>
							<td>38 - 29</td>
							<td>42 - 44</td>
						</tr>
						<tr>
							<td>XL</td>
							<td>10</td>
							<td>32 - 33</td>
							<td>40 - 41</td>
							<td>45 - 47</td>
						</tr>
						<tr>
							<td>XXL</td>
							<td>12</td>
							<td>34 - 35</td>
							<td>42 - 43</td>
							<td>48 - 50</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- /size-guide -->

	<!-- search -->
	<div class="modal fade modal-search" id="search">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="d-flex justify-content-between align-items-center">
					<h5>Search</h5>
					<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
				</div>
				<form class="form-search">
					<fieldset class="text">
						<input type="text" placeholder="Searching..." class="" name="text" tabindex="0" value=""
							aria-required="true" required="">
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
	<!-- /search -->

	<!-- Javascript -->
	<?php $this->load->view('components/script')?>

</body>

</html>
