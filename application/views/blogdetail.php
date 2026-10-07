<?php
// Fallback if blog wasn't passed or is empty
if (empty($blog) && class_exists('CI_Controller')) {
    $CI =& get_instance();
    if (!isset($CI->blog_model)) {
        $CI->load->model('Blog_model', 'blog_model');
    }
    $allActive = $CI->blog_model->getActiveBlogs();
    $blog = !empty($allActive) ? $allActive[0] : null;
}

$pageTitle = !empty($blog['meta_title']) ? $blog['meta_title'] : (!empty($blog['title']) ? $blog['title'] . ' | TeknoLite' : 'Blog Article | TeknoLite');
$metaDesc = !empty($blog['meta_description']) ? $blog['meta_description'] : (!empty($blog['short_description']) ? $blog['short_description'] : 'Explore expert lighting tips, product guides, and architectural design insights.');
$featuredImg = !empty($blog['image_url']) ? $blog['image_url'] : base_url('assets/images/blog/blog-details.jpg');
$authorName = !empty($blog['author']) ? $blog['author'] : 'TeknoLite';
$pubDate = !empty($blog['published_date']) ? $blog['published_date'] : date('Y-m-d');
$pubDateFormatted = !empty($blog['formatted_date']) ? $blog['formatted_date'] : date('F d, Y', strtotime($pubDate));
$blogCat = !empty($blog['category']) ? $blog['category'] : 'Lighting Insights';
$catSlug = !empty($blog['category_slug']) ? $blog['category_slug'] : url_title(strtolower($blogCat), '-', TRUE);
$viewsCount = isset($blog['views']) ? (int)$blog['views'] : 0;
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
	<meta charset="utf-8">
	<title><?= htmlspecialchars($pageTitle); ?></title>

	<meta name="description"
		content="<?= htmlspecialchars($metaDesc); ?>">
    <?php if (!empty($blog['meta_keywords'])): ?>
    <meta name="keywords" content="<?= htmlspecialchars($blog['meta_keywords']); ?>">
    <?php endif; ?>

	<meta name="robots" content="index, follow">
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
		<?php $this->load->view('components/header')?>
		<!-- /Header -->

		<!-- =====================================================
             PAGE BANNER & BREADCRUMB
        ====================================================== -->
		<div class="page-title relative">
			<div class="paralaximg" data-parallax="scroll" data-image-src="<?= base_url('assets/images/page-title/page-title-1.jpg'); ?>">
			</div>
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3 class="title"><?= htmlspecialchars($blog['category'] ?? 'Lighting Blog'); ?></h3>
							<ul class="breadcrumb">
								<li><a href="<?= base_url(); ?>">Home</a></li>
								<li><a href="<?= base_url('blog'); ?>">Blogs</a></li>
								<?php if (!empty($blog['category'])): ?>
								<li><a href="<?= base_url('blog?category=' . urlencode($catSlug)); ?>"><?= htmlspecialchars($blog['category']); ?></a></li>
								<?php endif; ?>
								<li class="active"><?= htmlspecialchars(mb_strimwidth($blog['title'] ?? 'Article', 0, 45, '...')); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.page-title -->

		<!-- =========================================================
     MAIN CONTENT
========================================================= -->

		<div class="main-content">

			<!-- =====================================================
         BREADCRUMB BAR
    ====================================================== -->
			<div class="teknolite-blog-breadcrumb">
				<div class="container">
					<nav aria-label="Breadcrumb">
						<ul class="breadcrumb">
							<li>
								<a href="<?= base_url(); ?>">Home</a>
							</li>
							<li>
								<a href="<?= base_url('blog'); ?>">Blogs</a>
							</li>
							<?php if (!empty($blog['category'])): ?>
							<li>
								<a href="<?= base_url('blog?category=' . urlencode($catSlug)); ?>">
									<?= htmlspecialchars($blog['category']); ?>
								</a>
							</li>
							<?php endif; ?>
							<li aria-current="page" class="text-truncate" style="max-width: 500px;">
								<?= htmlspecialchars($blog['title'] ?? 'Article'); ?>
							</li>
						</ul>
					</nav>
				</div>
			</div>



			<!-- =====================================================
         BLOG ARTICLE
    ====================================================== -->

			<article class="blog-detail-wrap teknolite-blog-detail">

				<div class="inner">


					<!-- =================================================
                 ARTICLE HEADER
            ================================================== -->

					<header class="heading">


						<!-- CATEGORY -->

						<ul class="list-tags has-bg">

							<li>

								<a href="<?= base_url('blog?category=' . urlencode($catSlug)); ?>" class="link">

									<?= htmlspecialchars($blogCat); ?>

								</a>

							</li>

						</ul>



						<!-- SEO MAIN TITLE -->

						<h1 class="teknolite-blog-title">

							<?= htmlspecialchars($blog['title'] ?? ''); ?>

						</h1>



						<!-- META -->

						<div class="wrap-meta">

							<ul class="meta">

								<li class="text-body-1">

									<i class="icon-calendar"></i>

									<time datetime="<?= htmlspecialchars($pubDate); ?>">

										<?= htmlspecialchars($pubDateFormatted); ?>

									</time>

								</li>

								<li class="text-body-1">

									<i class="icon-user"></i>

									<span class="text-secondary"><?= htmlspecialchars($authorName); ?></span>

								</li>

								<li class="text-body-1">

									<i class="icon-folder"></i>

									<a href="<?= base_url('blog?category=' . urlencode($catSlug)); ?>" class="link">

										<?= htmlspecialchars($blogCat); ?>

									</a>

								</li>

								<li class="text-body-1">

									<i class="icon-view"></i>

									<span class="text-secondary"><?= $viewsCount; ?> views</span>

								</li>

							</ul>

						</div>


					</header>



					<!-- =================================================
                 FEATURED IMAGE
            ================================================== -->

					<figure class="image-wrap teknolite-featured-image" style="border-radius: 12px; overflow: hidden; max-height: 520px;">

						<img class="lazyload" data-src="<?= $featuredImg; ?>"
							src="<?= $featuredImg; ?>" decoding="async"
							alt="<?= htmlspecialchars($blog['title'] ?? 'TeknoLite Blog'); ?>"
							style="width: 100%; height: 100%; object-fit: cover;">

					</figure>



					<!-- =================================================
                 INTRODUCTION
            ================================================== -->

					<?php if (!empty($blog['short_description'])): ?>
					<div class="content teknolite-article-content">
						<p class="teknolite-blog-intro">
							<?= nl2br(htmlspecialchars($blog['short_description'])); ?>
						</p>
					</div>
					<?php endif; ?>

					<!-- =================================================
                 ARTICLE BODY CONTENT
            ================================================== -->
					<div class="content teknolite-article-content blog-dynamic-body">
						<?= !empty($blog['content']) ? $blog['content'] : '<p class="text-secondary">No article content available.</p>'; ?>
					</div>

					<!-- =================================================
                 RELATED ARTICLES
            ================================================== -->
					<?php if (!empty($recent_blogs)): ?>
					<section class="teknolite-related-section my-5 pt-4 border-top">
						<div class="d-flex justify-content-between align-items-center mb-4">
							<h3 class="mb-0 fs-4 fw-bold">Related Articles</h3>
							<a href="<?= base_url('blog'); ?>" class="tf-btn-line">View All <i class="icon-arrow-up-right ms-1"></i></a>
						</div>
						<div class="row g-4">
							<?php foreach ($recent_blogs as $rb): 
								$rbUrl = base_url('blog/' . $rb['slug']);
								$rbImg = !empty($rb['image_url']) ? $rb['image_url'] : base_url('assets/images/blog/blog-details.jpg');
							?>
							<div class="col-md-4">
								<div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
									<a href="<?= $rbUrl; ?>" class="d-block overflow-hidden" style="height: 180px;">
										<img src="<?= $rbImg; ?>" alt="<?= htmlspecialchars($rb['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
									</a>
									<div class="card-body p-3 d-flex flex-column">
										<div class="small text-muted mb-2"><i class="icon-calendar me-1"></i><?= $rb['formatted_date']; ?> &bull; <?= htmlspecialchars($rb['category']); ?></div>
										<h5 class="card-title fs-6 fw-bold mb-2">
											<a href="<?= $rbUrl; ?>" class="text-dark text-decoration-none">
												<?= htmlspecialchars($rb['title']); ?>
											</a>
										</h5>
										<p class="card-text text-muted small flex-grow-1">
											<?= htmlspecialchars(mb_strimwidth($rb['short_description'] ?? '', 0, 95, '...')); ?>
										</p>
										<a href="<?= $rbUrl; ?>" class="text-primary fw-semibold small text-decoration-none mt-2">Read More &rarr;</a>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</section>
					<?php endif; ?>





				</div>

			</article>

		</div>
		<!-- /main-content -->

		<!-- .footer -->
		<?php $this->load->view('components/footer')?>
		<!-- /.footer -->

		<!-- toolbar-bottom -->
		<div class="tf-toolbar-bottom">
			<div class="toolbar-item">
				<a href="#">
					<div class="toolbar-icon">
						<span class="icon icon-squaresfour"></span>
					</div>
					<div class="toolbar-label">Shop</div>
				</a>
			</div>
			<div class="toolbar-item">
				<a href="#shopCategories" data-bs-toggle="offcanvas" aria-controls="shopCategories">
					<div class="toolbar-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000"
							viewBox="0 0 256 256">
							<path
								d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
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
						<span class="title">Chair</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forChair" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/product-1.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Saddle Chair</span></a>
							</li>
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/product-1.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Ergonomic Chair</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forDesk" data-bs-toggle="collapse"
						aria-expanded="true" aria-controls="forDesk">
						<img class="avt" src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt">
						<span class="title">Desk</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forDesk" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Office Desk</span></a>
							</li>
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/popup-slidebar-item-2.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Standing Desk</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forPhone"
						data-bs-toggle="collapse" aria-expanded="true" aria-controls="forPhone">
						<img class="avt" src="assets/images/shop/product-5.jpg" alt="avt">
						<span class="title">Phone</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forPhone" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/product-5.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Charging Pad</span></a>
							</li>
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/shop/product-5.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Charging Stand</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="wd-facet-categories">
					<div role="dialog" class="facet-title collapsed" data-bs-target="#forLamp" data-bs-toggle="collapse"
						aria-expanded="true" aria-controls="forLamp">
						<img class="avt" src="assets/images/gallery/gallery-3.jpg" alt="avt">
						<span class="title">Lamp</span>
						<span class="icon icon-down"></span>
					</div>
					<div id="forLamp" class="collapse">
						<ul class="facet-body">
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/gallery/gallery-3.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Reflection Lamp</span></a>
							</li>
							<li>
								<a href="#" class="item link"><img class="avt"
										src="assets/images/gallery/gallery-3.jpg" alt="avt"><span
										class="title-sub text-caption-1 text-secondary">Shore Lamp</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Categories -->

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
				<div>
					<h5 class="mb_16">Feature keywords Today</h5>
					<ul class="list-tags">
						<li><a href="#" class="radius-60 link">Dresses</a></li>
						<li><a href="#" class="radius-60 link">Dresses women</a></li>
						<li><a href="#" class="radius-60 link">Dresses midi</a></li>
						<li><a href="#" class="radius-60 link">Dress summer</a></li>
					</ul>
				</div>
				<div>
					<h6 class="mb_16">Recently viewed products</h6>
					<div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4 loadmore-item" data-display="4"
						data-count="4">
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-1.jpg"
										src="assets/images/shop/product-1.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-1.1.jpg"
										src="assets/images/shop/product-1.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Ergonomic Chair Pro</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-1.2.jpg"
											src="assets/images/shop/product-1.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-1.3.jpg"
											src="assets/images/shop/product-1.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-2.jpg"
										src="assets/images/shop/product-2.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-2.1.jpg"
										src="assets/images/shop/product-2.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Open Box - Adjustable Laptop Stand</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-2.jpg"
											src="assets/images/shop/product-2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-2.2.jpg"
											src="assets/images/shop/product-2.2.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-3.jpg"
										src="assets/images/shop/product-3.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-3.1.jpg"
										src="assets/images/shop/product-3.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Laptop Stand</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$89.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Orange</span>
										<span class="swatch-value bg-light-orange"></span>
										<img class="lazyload" data-src="assets/images/shop/product-3.2.jpg"
											src="assets/images/shop/product-3.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-light-grey"></span>
										<img class="lazyload" data-src="assets/images/shop/product-3.3.jpg"
											src="assets/images/shop/product-3.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-4.jpg"
										src="assets/images/shop/product-4.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-4.1.jpg"
										src="assets/images/shop/product-4.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Double Standing Desk</a>
								<div class="price text-body-default ">$69.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Brown</span>
										<span class="swatch-value bg-light-brown"></span>
										<img class="lazyload" data-src="assets/images/shop/product-4.2.jpg"
											src="assets/images/shop/product-4.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Bink</span>
										<span class="swatch-value bg-light-pink"></span>
										<img class="lazyload" data-src="assets/images/shop/product-4.3.jpg"
											src="assets/images/shop/product-4.3.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-dark-grey-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-4.4.jpg"
											src="assets/images/shop/product-4.4.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-5.jpg"
										src="assets/images/shop/product-5.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-5.1.jpg"
										src="assets/images/shop/product-5.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Wireless Charging Dock</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$89.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Orange</span>
										<span class="swatch-value bg-light-orange"></span>
										<img class="lazyload" data-src="assets/images/shop/product-5.2.jpg"
											src="assets/images/shop/product-5.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-light-grey"></span>
										<img class="lazyload" data-src="assets/images/shop/product-5.3.jpg"
											src="assets/images/shop/product-5.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-6.jpg"
										src="assets/images/shop/product-6.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-6.1.jpg"
										src="assets/images/shop/product-6.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Ergonomic Headrest</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-6.jpg"
											src="assets/images/shop/product-6.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-6.2.jpg"
											src="assets/images/shop/product-6.2.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-7.jpg"
										src="assets/images/shop/product-7.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-7.1.jpg"
										src="assets/images/shop/product-7.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Hybrid Laptop Sleeve</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-7.2.jpg"
											src="assets/images/shop/product-7.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-7.3.jpg"
											src="assets/images/shop/product-7.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-8.jpg"
										src="assets/images/shop/product-8.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-8.1.jpg"
										src="assets/images/shop/product-8.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Wireless Charging Tray</a>
								<div class="price text-body-default ">$69.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Brown</span>
										<span class="swatch-value bg-light-brown"></span>
										<img class="lazyload" data-src="assets/images/shop/product-8.2.jpg"
											src="assets/images/shop/product-8.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Bink</span>
										<span class="swatch-value bg-light-pink"></span>
										<img class="lazyload" data-src="assets/images/shop/product-8.3.jpg"
											src="assets/images/shop/product-8.3.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-dark-grey-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-8.4.jpg"
											src="assets/images/shop/product-8.4.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-9.jpg"
										src="assets/images/shop/product-9.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-9.1.jpg"
										src="assets/images/shop/product-9.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Softside Chair</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-9.2.jpg"
											src="assets/images/shop/product-9.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-9.3.jpg"
											src="assets/images/shop/product-9.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-10.jpg"
										src="assets/images/shop/product-10.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-10.1.jpg"
										src="assets/images/shop/product-10.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Double Standing Desk</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$79.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue"></span>
										<img class="lazyload" data-src="assets/images/shop/product-10.2.jpg"
											src="assets/images/shop/product-10.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Blue</span>
										<span class="swatch-value bg-light-blue-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-10.3.jpg"
											src="assets/images/shop/product-10.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-11.jpg"
										src="assets/images/shop/product-11.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-11.1.jpg"
										src="assets/images/shop/product-11.1.jpg" alt="image-product">
								</a>
								<div class="on-sale-wrap"><span class="on-sale-item">-25%</span>
								</div>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Duo Standing Desk</a>
								<div class="price text-body-default "><span
										class="text-caption-1 old-price">$98.00</span>$89.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Orange</span>
										<span class="swatch-value bg-light-orange"></span>
										<img class="lazyload" data-src="assets/images/shop/product-11.2.jpg"
											src="assets/images/shop/product-11.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-light-grey"></span>
										<img class="lazyload" data-src="assets/images/shop/product-11.3.jpg"
											src="assets/images/shop/product-11.3.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
						<div class="card-product style-1 fl-item">
							<div class="card-product-wrapper">
								<a href="<?= base_url('productdetail'); ?>" class="image-wrap">
									<img class="lazyload img-product" data-src="assets/images/shop/product-12.jpg"
										src="assets/images/shop/product-12.jpg" alt="image-product">
									<img class="lazyload img-hover" data-src="assets/images/shop/product-12.1.jpg"
										src="assets/images/shop/product-12.1.jpg" alt="image-product">
								</a>
								<div class="list-product-btn">
									<a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
										<span class="icon icon-heart"></span>
										<span class="tooltip">Wishlist</span>
									</a>
									<a href="#compare" data-bs-toggle="modal" aria-controls="compare"
										class="box-icon compare ">
										<span class="icon icon-compare"></span>
										<span class="tooltip">Compare</span>
									</a>
									<a href="#quickView" data-bs-toggle="modal"
										class="box-icon quickview tf-btn-loading">
										<span class="icon icon-eye"></span>
										<span class="tooltip">Quick View</span>
									</a>
								</div>
								<div class="list-btn-main">
									<a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
										cart</a>
								</div>
							</div>
							<div class="card-product-info ">
								<a href="<?= base_url('productdetail'); ?>" class="title link">Alumina Lamp</a>
								<div class="price text-body-default ">$69.99</div>
								<ul class="list-color-product">
									<li class="list-color-item color-swatch active">
										<span class="d-none text-capitalize color-filter">Light Brown</span>
										<span class="swatch-value bg-light-brown"></span>
										<img class="lazyload" data-src="assets/images/shop/product-12.2.jpg"
											src="assets/images/shop/product-12.2.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Bink</span>
										<span class="swatch-value bg-light-pink"></span>
										<img class="lazyload" data-src="assets/images/shop/product-12.3.jpg"
											src="assets/images/shop/product-12.3.jpg" alt="image-product">
									</li>
									<li class="list-color-item color-swatch">
										<span class="d-none text-capitalize color-filter">Light Grey</span>
										<span class="swatch-value bg-dark-grey-2"></span>
										<img class="lazyload" data-src="assets/images/shop/product-12.4.jpg"
											src="assets/images/shop/product-12.4.jpg" alt="image-product">
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Load Item -->
				<div class="wd-load view-more-button text-center">
					<button class="tf-loading btn-loadmore tf-btn btn-reset"><span
							class="text text-btn text-btn-uppercase">Load more</span></button>
				</div>
			</div>
		</div>
	</div>
	<!-- /search -->

	<!-- shoppingCart -->
	<div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="tf-minicart-recommendations">
					<h6 class="title">You May Also Like</h6>
					<div class="wrap-recommendations">
						<div class="list-cart">
							<div class="list-cart-item">
								<div class="image">
									<img class="lazyload" data-src="assets/images/shop/popup-slidebar-item-1.jpg"
										src="assets/images/shop/popup-slidebar-item-1.jpg" alt="">
								</div>
								<div class="content">
									<div class="name">
										<a class="link text-line-clamp-1" href="<?= base_url('productdetail'); ?>">Ergonomic Chair
											Pro</a>
									</div>
									<div class="cart-item-bot">
										<div class="text-button price">$59.99</div>
										<a class="link text-button" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="list-cart-item">
								<div class="image">
									<img class="lazyload" data-src="assets/images/shop/popup-slidebar-item-2.jpg"
										src="assets/images/shop/popup-slidebar-item-2.jpg" alt="">
								</div>
								<div class="content">
									<div class="name">
										<a class="link text-line-clamp-1" href="<?= base_url('productdetail'); ?>">Double Standing
											Desk</a>
									</div>
									<div class="cart-item-bot">
										<div class="text-button price">$59.99</div>
										<a class="link text-button" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="list-cart-item">
								<div class="image">
									<img class="lazyload" data-src="assets/images/shop/popup-slidebar-item-3.jpg"
										src="assets/images/shop/popup-slidebar-item-3.jpg" alt="">
								</div>
								<div class="content">
									<div class="name">
										<a class="link text-line-clamp-1" href="<?= base_url('productdetail'); ?>">Duo Standing
											Desk</a>
									</div>
									<div class="cart-item-bot">
										<div class="text-button price">$59.99</div>
										<a class="link text-button" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="list-cart-item">
								<div class="image">
									<img class="lazyload" data-src="assets/images/shop/popup-slidebar-item-4.jpg"
										src="assets/images/shop/popup-slidebar-item-4.jpg" alt="">
								</div>
								<div class="content">
									<div class="name">
										<a class="link text-line-clamp-1" href="<?= base_url('productdetail'); ?>">Alumina
											Lamp</a>
									</div>
									<div class="cart-item-bot">
										<div class="text-button price">$59.99</div>
										<a class="link text-button" href="#">Add to cart</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex flex-column flex-grow-1 h-100">
					<div class="header">
						<h5 class="title">Shopping Cart</h5>
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
								Congratulations! You've got free shipping!
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
																class="link line-clamp-1">Open Box -
																Adjustable...</a>
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
													data-src="assets/images/shop/popup-cart-item-2.jpg"
													src="assets/images/shop/popup-cart-item-2.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">Ergonomic Chair Pro</a>
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
													data-src="assets/images/shop/popup-cart-item-3.jpg"
													src="assets/images/shop/popup-cart-item-3.jpg" alt="">
											</div>
											<div class="tf-mini-cart-info flex-grow-1">
												<div class="content">
													<div class="left">
														<div class="text-title"><a href="<?= base_url('productdetail'); ?>"
																class="link line-clamp-1">Double Standing Desk</a>
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
																class="link line-clamp-1">Wireless Charging Dock</a>
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
																class="link line-clamp-1">Ergonomic Headrest</a>
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
											cart</a>
										<a href="#enquiryForm" data-bs-toggle="modal" class="tf-btn w-100 btn-onsurface">Check
											Out</a>
									</div>
									<div class="text-center">
										<a class="link btn-line" href="#">Or continue
											shopping</a>
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
											<textarea name="note" id="Cart-note"
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
												name="address[zip]" value="">
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
												tabindex="2" value="" aria-required="true" required="">
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

	<!-- Javascript -->
	<?php $this->load->view('components/script'); ?>
</body>

</html>
