<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
	<meta charset="utf-8">
	<title>TeknoLite | Commercial & Architectural Lighting Range</title>

	<meta name="author" content="themesflat.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php $this->load->view('components/head')?>

<style>
/* =========================================================
   TEKNOLITE PRODUCT PAGE - LEFT FILTER LAYOUT
========================================================= */
.tk-product-page {
    padding-top: 42px;
}

.tk-shop-container {
    width: min(1600px, calc(100% - 30px));
    max-width: 1600px;
}

.tk-shop-shell {
    display: grid;
    grid-template-columns: 250px minmax(0, 1fr);
    align-items: start;
    border-top: 1px solid #ececec;
    border-bottom: 1px solid #ececec;
}

/* ---------- FILTER SIDEBAR ---------- */
.tk-filter-panel {
    border-right: 1px solid #e7e7e7;
    background: #fff;
    min-height: 100%;
    position: sticky;
    top: 85px;
    z-index: 6;
}

.tk-filter-heading {
    min-height: 52px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    border-bottom: 1px solid #e7e7e7;
    font-size: 15px;
    color: #111;
}

.tk-filter-close {
    display: none;
    border: 0;
    background: transparent;
    font-size: 30px;
    line-height: 1;
    padding: 0;
}

.tk-filter-group {
    padding: 20px 24px;
    border-bottom: 1px solid #e7e7e7;
}

.tk-filter-title {
    display: block;
    margin: 0 0 14px;
    font-size: 13px;
    line-height: 1.2;
    font-weight: 700;
    color: #161b32;
    letter-spacing: .01em;
}

.tk-search-box {
    position: relative;
}

.tk-search-box input {
    width: 100%;
    height: 40px;
    border: 1px solid #dfe2e7;
    border-radius: 4px;
    padding: 0 38px 0 12px;
    font-size: 13px;
    outline: none;
}

.tk-search-box input:focus {
    border-color: #0d6efd;
}

.tk-search-box .icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #6f7580;
}

.tk-check-row {
    display: flex;
    align-items: center;
    min-height: 29px;
    gap: 10px;
    cursor: pointer;
    margin: 0;
    font-size: 13px;
    color: #252a3d;
}

.tk-check-row input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.tk-checkmark {
    width: 16px;
    height: 16px;
    flex: 0 0 16px;
    border: 1px solid #c9ced7;
    border-radius: 2px;
    background: #fff;
    position: relative;
}

.tk-check-row input:checked + .tk-checkmark {
    background: #0d6efd;
    border-color: #0d6efd;
}

.tk-check-row input:checked + .tk-checkmark::after {
    content: '';
    position: absolute;
    left: 4px;
    top: 1px;
    width: 5px;
    height: 9px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.tk-filter-name {
    flex: 1;
}

.tk-filter-count {
    font-size: 11px;
    color: #8b92a0;
}

.tk-temp-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    flex: 0 0 14px;
}

.tk-temp-dot.warm {
    background: #ffd99a;
}

.tk-temp-dot.neutral {
    background: #e9e4c2;
}

.tk-filter-actions {
    padding: 20px 24px 24px;
}

.tk-clear-btn {
    width: 100%;
    height: 40px;
    border: 1px solid #1b1f2a;
    background: #fff;
    color: #1b1f2a;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 600;
}

.tk-clear-btn:hover {
    background: #1b1f2a;
    color: #fff;
}

/* ---------- RIGHT PANEL ---------- */
.tk-products-panel {
    min-width: 0;
    background: #fff;
}

.tk-product-toolbar {
    min-height: 52px;
    border-bottom: 1px solid #e7e7e7;
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 0 18px 0 26px;
}

.tk-quick-filters {
    display: flex;
    align-items: center;
    gap: 28px;
    flex: 1;
    min-width: 0;
    overflow-x: auto;
    scrollbar-width: none;
}

.tk-quick-filters::-webkit-scrollbar {
    display: none;
}

.tk-quick-filter {
    appearance: none;
    border: 0;
    background: transparent;
    padding: 16px 0;
    white-space: nowrap;
    color: #192039;
    font-size: 13px;
    position: relative;
}

.tk-quick-filter:hover,
.tk-quick-filter.active {
    color: #0d6efd;
}

.tk-quick-filter.active::after {
    content: '';
    position: absolute;
    height: 2px;
    left: 0;
    right: 0;
    bottom: -1px;
    background: #0d6efd;
}

.tk-chevron {
    font-size: 14px;
    margin-left: 4px;
    color: #a2a8b4;
}

.tk-sort-wrap {
    display: flex;
    align-items: center;
    height: 38px;
    border: 1px solid #d6dae1;
    background: #fff;
    padding-left: 14px;
    white-space: nowrap;
}

.tk-sort-wrap label {
    margin: 0;
    font-size: 12px;
    color: #4f5563;
}

.tk-sort-wrap select {
    height: 36px;
    border: 0;
    outline: none;
    background: transparent;
    padding: 0 28px 0 5px;
    font-size: 12px;
    font-weight: 700;
    color: #181d2e;
}

.tk-mobile-filter-btn {
    display: none;
    border: 1px solid #d6dae1;
    background: #fff;
    height: 38px;
    padding: 0 14px;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 600;
}

.tk-results-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 17px 26px 8px;
    font-size: 12px;
    color: #7b8290;
}

#tkProductCount {
    font-weight: 700;
    color: #202637;
}

/* ---------- PRODUCT GRID ---------- */
.tk-product-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 32px 24px;
    padding: 14px 26px 42px;
}

.tk-product-card {
    min-width: 0;
}

.tk-product-card .card-product-wrapper {
    background: #f3f4f4;
    border-radius: 30px;
    overflow: hidden;
}

.tk-product-card .card-product-wrapper .image-wrap {
    height:270px;
    border-radius:30px;
    display: block;
    aspect-ratio: 4 / 5;
    overflow: hidden;
}

.tk-product-card .card-product-wrapper .image-wrap img {
    width: 100%;
    height: 270px;
    object-fit: cover;
}

.tk-product-card .card-product-info {
    padding-top: 10px;
}

.tk-product-card .card-product-info .title {
    display: block;
    font-size: 15px;
    line-height: 1.35;
    font-weight: 700;
    color: #10162a;
    margin-bottom: 2px;
}

.tk-card-category {
    font-size: 13px;
    color: #454d62;
    margin-bottom: 5px;
}

.tk-card-meta {
    font-size: 11px;
    color: #8c93a1;
    line-height: 1.45;
    margin-bottom: 5px;
}

.tk-card-meta span {
    margin: 0 3px;
}

.tk-product-card .price {
    margin-top: 2px;
    font-size: 13px;
    color: #141a2b;
}

.tk-product-card .on-sale-wrap {
    left: 8px;
    top: 8px;
}

.tk-product-card .on-sale-item {
    border-radius: 2px;
}

.tk-no-results {
    text-align: center;
    padding: 80px 20px;
}

.tk-no-results h5 {
    margin-bottom: 8px;
}

.tk-no-results p {
    margin: 0;
    color: #777;
}


/* ---------- PAGE HEADING ---------- */
.tk-products-heading {
    text-align: center;
    margin-bottom: 34px;
}

.tk-products-heading h2 {
    margin: 0 0 10px;
    font-size: clamp(28px, 3vw, 42px);
    line-height: 1.2;
    font-weight: 700;
    color: #111;
}

.tk-products-heading h2 span {
    color: #0d6efd;
}

.tk-products-heading p {
    margin: 0;
    color: #747b88;
    font-size: 14px;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 1399px) {
    .tk-product-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .tk-quick-filters {
        gap: 20px;
    }
}

@media (max-width: 991px) {
    .tk-shop-container {
        width: calc(100% - 24px);
    }

    .tk-shop-shell {
        display: block;
    }

    .tk-filter-panel {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: min(320px, 88vw);
        height: 100vh;
        overflow-y: auto;
        transform: translateX(-105%);
        transition: transform .3s ease;
        z-index: 9999;
        box-shadow: 10px 0 30px rgba(0,0,0,.12);
    }

    .tk-filter-panel.mobile-open {
        transform: translateX(0);
    }

    .tk-filter-close {
        display: block;
    }

    .tk-mobile-filter-btn {
        display: inline-flex;
    }

    .tk-product-toolbar {
        padding: 8px 12px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .tk-quick-filters {
        order: 3;
        width: 100%;
        flex-basis: 100%;
    }

    .tk-sort-wrap {
        margin-left: auto;
    }

    .tk-results-bar {
        padding-left: 12px;
        padding-right: 12px;
    }

    .tk-product-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        padding-left: 12px;
        padding-right: 12px;
        gap: 26px 16px;
    }
}

@media (max-width: 767px) {
    .tk-product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .tk-results-bar {
        align-items: flex-start;
        flex-direction: column;
        gap: 3px;
    }
}

@media (max-width: 479px) {
    .tk-product-grid {
        grid-template-columns: 1fr;
    }

    .tk-sort-wrap label {
        display: none;
    }

    .tk-sort-wrap {
        padding-left: 4px;
    }
}
</style>

</head>

<body class="preload-wrapper">

	<button id="scroll-top" class="style-1">
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

	<!-- #wrapper -->
	<div id="wrapper">


		<!-- Header -->
		<?php $this->load->view('components/header')?>
		<!-- /Header -->

		<!-- .page-title -->
		<div class="page-title relative">

			<div class="paralaximg" data-parallax="scroll"
				data-image-src="<?= base_url('assets/images/page-title/page-title-9.jpg'); ?>">
			</div>

			<div class="content">

				<div class="container">

					<div class="row">

						<div class="col-12">

							<h3 class="title">
								Our Products
							</h3>

							<ul class="breadcrumb">

								<li>
									<a href="<?= base_url(); ?>">
										Home
									</a>
								</li>

								<li>
									Products
								</li>

							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- /.page-title -->



		<!-- =========================================================
     PRODUCT SECTION - LEFT FILTER + PRODUCT GRID
========================================================= -->

<?php
// Resolve categories dynamically
$categoryLabels = [];
if (!empty($active_categories) && is_array($active_categories)) {
    foreach ($active_categories as $ac) {
        $slug = $ac['slug'] ?? $ac['id'];
        $categoryLabels[$slug] = $ac['name'];
    }
}

// Helper to resolve clean product image URL
if (!function_exists('resolve_prod_img')) {
    function resolve_prod_img($path, $fallback = 'assets/images/products/gamma.png') {
        if (empty($path)) return base_url($fallback);
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
        if (strpos($path, 'assets/') === 0 || strpos($path, 'uploads/') === 0) return base_url($path);
        return base_url('assets/images/products/' . $path);
    }
}

// Convert DB products to gridProducts
$gridProducts = [];
if (!empty($products) && is_array($products)) {
    foreach ($products as $p) {
        $catSlug = $p['category_slug'] ?? (is_array($p['category']) ? 'general' : strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $p['category']))));
        $catLabel = $p['category'] ?? ($categoryLabels[$catSlug] ?? 'Lighting');
        if (!isset($categoryLabels[$catSlug])) {
            $categoryLabels[$catSlug] = $catLabel;
        }

        $featuredUrl = resolve_prod_img($p['featured_image'] ?? '');
        $hoverUrl = resolve_prod_img($p['hover_image'] ?? '', $p['featured_image'] ?? 'assets/images/products/gamma.png');

        $gridProducts[] = [
            'id' => $p['numeric_id'] ?? ($p['id'] ?? 1),
            'slug' => $p['slug'] ?? ($p['id'] ?? 'item'),
            'name' => $p['name'],
            'category' => $catSlug,
            'category_label' => $catLabel,
            'image' => $featuredUrl,
            'hover' => $hoverUrl,
            'price' => !empty($p['price_on_request']) || empty($p['price']) ? 'Price on Request' : ('₹' . number_format($p['price'], 2)),
            'raw_price' => $p['price'] ?? 0,
            'url' => base_url('productdetail/' . ($p['slug'] ?? $p['id']))
        ];
    }
}

// Calculate dynamic category counts
$categoryCounts = [];
foreach ($gridProducts as $product) {
    $categoryCounts[$product['category']] = ($categoryCounts[$product['category']] ?? 0) + 1;
}
?>

<section class="flat-spacing tk-product-page">
    <div class="container tk-shop-container">

        <!-- PRODUCT PAGE TITLE -->
        <div class="tk-products-heading">
            <h2 class="wow fadeInUp">
                Explore Our <span>Commercial &amp; Architectural</span> Lighting Range
            </h2>
            <p class="wow fadeInUp" data-wow-delay="0.1s">
                Elevate Your Project with Premium Lighting.
            </p>
        </div>

        <div class="tk-shop-shell">

            <!-- ================= LEFT FILTER SIDEBAR ================= -->
            <aside class="tk-filter-panel" id="tkFilterPanel">

                <div class="tk-filter-heading">
                    <strong>FILTERS</strong>
                    <button type="button" class="tk-filter-close" id="tkFilterClose" aria-label="Close filters">×</button>
                </div>

                <!-- SEARCH -->
                <div class="tk-filter-group tk-search-group">
                    <label class="tk-filter-title" for="tkProductSearch">SEARCH</label>
                    <div class="tk-search-box">
                        <input type="search" id="tkProductSearch" placeholder="Search products..." autocomplete="off" maxlength="100" aria-label="Search products">
                        <span class="icon icon-search"></span>
                    </div>
                </div>

                <!-- CATEGORY -->
                <div class="tk-filter-group">
                    <h6 class="tk-filter-title">CATEGORY</h6>

                    <label class="tk-check-row">
                        <input type="checkbox" class="tk-category-check" value="all" checked>
                        <span class="tk-checkmark"></span>
                        <span class="tk-filter-name">All Products</span>
                        <span class="tk-filter-count"><?= count($gridProducts); ?></span>
                    </label>

                    <?php foreach ($categoryLabels as $categoryKey => $categoryLabel): ?>
                        <label class="tk-check-row">
                            <input type="checkbox" class="tk-category-check" value="<?= htmlspecialchars($categoryKey); ?>">
                            <span class="tk-checkmark"></span>
                            <span class="tk-filter-name"><?= htmlspecialchars($categoryLabel); ?></span>
                            <span class="tk-filter-count"><?= $categoryCounts[$categoryKey] ?? 0; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="tk-filter-actions">
                    <button type="button" id="tkClearFilters" class="tk-clear-btn">Clear All Filters</button>
                </div>

            </aside>


            <!-- ================= RIGHT PRODUCTS ================= -->
            <div class="tk-products-panel">

                <!-- TOP QUICK CATEGORY BAR -->
                <div class="tk-product-toolbar">

                    <button type="button" class="tk-mobile-filter-btn" id="tkMobileFilterBtn">
                        <span class="icon icon-filter"></span>
                        Filters
                    </button>

                    <div class="tk-quick-filters">
                        <button type="button" class="tk-quick-filter active" data-category="all">All Products</button>

                        <?php foreach ($categoryLabels as $categoryKey => $categoryLabel): ?>
                            <button type="button" class="tk-quick-filter" data-category="<?= htmlspecialchars($categoryKey); ?>">
                                <?= htmlspecialchars($categoryLabel); ?>
                                <span class="tk-chevron">⌄</span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div class="tk-sort-wrap">
                        <label for="tkProductSort">Sort by :</label>
                        <select id="tkProductSort">
                            <option value="recommended">Recommended</option>
                            <option value="a-z">Name, A-Z</option>
                            <option value="z-a">Name, Z-A</option>
                        </select>
                    </div>

                </div>

                <div class="tk-results-bar">
                    <span id="tkProductCount"><?= count($gridProducts); ?> Products</span>
                    <span id="tkActiveFilterText">Showing all products</span>
                </div>

                <!-- PRODUCT CARDS -->
                <div class="tk-product-grid" id="tkProductGrid">

                    <?php foreach ($gridProducts as $index => $product): ?>

                        <div class="card-product style-5 teknolite-product tk-product-card wow fadeInUp"
                             data-index="<?= $index; ?>"
                             data-name="<?= htmlspecialchars($product['name']); ?>"
                             data-category="<?= htmlspecialchars($product['category']); ?>"
                             data-category-label="<?= htmlspecialchars($product['category_label']); ?>">

                            <div class="card-product-wrapper">

                                <a href="<?= $product['url']; ?>" class="image-wrap">
                                    <img class="lazyload img-product"
                                         data-src="<?= $product['image']; ?>"
                                         src="<?= $product['image']; ?>"
                                         loading="lazy"
                                         decoding="async"
                                         alt="<?= htmlspecialchars($product['name']); ?>">

                                    <img class="lazyload img-hover"
                                         data-src="<?= $product['hover']; ?>"
                                         src="<?= $product['hover']; ?>"
                                         loading="lazy"
                                         decoding="async"
                                         alt="<?= htmlspecialchars($product['name']); ?>">
                                </a>

                                <div class="list-product-btn">
                                    <a href="javascript:void(0);"
                                       class="box-icon wishlist btn-icon-action"
                                       data-product-id="<?= $product['id']; ?>"
                                       data-product-name="<?= htmlspecialchars($product['name']); ?>"
                                       data-product-category="<?= htmlspecialchars($product['category_label']); ?>"
                                       data-product-image="<?= $product['image']; ?>"
                                       data-product-hover="<?= $product['hover']; ?>"
                                       data-product-url="<?= $product['url']; ?>"
                                       aria-label="Save <?= htmlspecialchars($product['name']); ?>">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Save Product</span>
                                    </a>

                                    <a href="<?= $product['url']; ?>"
                                       class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">View Details</span>
                                    </a>
                                </div>

                                <div class="list-btn-main">
                                    <a href="<?= $product['url']; ?>" class="btn-main-product btn-quickview">
                                        View Details
                                    </a>

                                    <a href="#!"
                                       data-bs-toggle="modal"
                                       data-bs-target="#enquiryForm"
                                       data-product-name="<?= htmlspecialchars($product['name']); ?>"
                                       data-product-category="<?= htmlspecialchars($product['category_label']); ?>"
                                       data-product-image="<?= $product['image']; ?>"
                                       data-product-url="<?= $product['url']; ?>"
                                       class="btn-main-product">
                                        Enquiry Now
                                    </a>
                                </div>

                            </div>

                            <div class="card-product-info">
                                <a href="<?= $product['url']; ?>" class="title link">
                                    <?= htmlspecialchars($product['name']); ?>
                                </a>

                                <div class="tk-card-category">
                                    <?= htmlspecialchars($product['category_label']); ?>
                                </div>

                                <div class="price">
                                    <?= htmlspecialchars($product['price']); ?>
                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <div id="tkNoResults" class="tk-no-results" style="display:none;">
                    <h5>No products found</h5>
                    <p>Try changing your search or category filters.</p>
                </div>

            </div>

        </div>

    </div>
</section>
<!-- /Section product -->

		<!-- .footer -->
		<?php $this->load->view('components/footer')?>
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
	<!-- /wrapper -->

	<!-- mobile menu -->
	<?php $this->load->view('components/offcanvas')?>
	<!-- /mobile menu -->


	<!-- shoppingCart-Emty-->
	<div class="modal fullRight fade modal-shopping-cart style-empty" id="shoppingCart">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="d-flex flex-column flex-grow-1 h-100">
					<div class="header">
						<h5 class="title">Shopping Cart</h5>
						<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
					</div>
					<div class="wrap">
						<div class="tf-mini-cart-threshold">
							<div class="tf-progress-bar">
								<div class="value" style="width: 0%;" data-progress="0">
									<i class="icon icon-shipping"></i>
								</div>
							</div>
							<div class="text-caption-1">
								Free Shipping for all orders of $100.00
							</div>
						</div>
						<div class="content-inner">
							<h4>Your cart is empty</h4>
							<p>You may check out all the available products and buy some in the shop</p>
							<a href="<?= base_url('product'); ?>" class="tf-btn btn-onsurface w-full mx-auto">Return to shop<i
									class="icon-arrow-up-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- shoppingCart-Emty-->



	<!-- Javascript -->
	<?php $this->load->view('components/script')?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('tkProductGrid');
    if (!grid) return;

    const cards = Array.from(grid.querySelectorAll('.tk-product-card'));
    const categoryChecks = Array.from(document.querySelectorAll('.tk-category-check'));
    const quickFilters = Array.from(document.querySelectorAll('.tk-quick-filter'));
    const searchInput = document.getElementById('tkProductSearch');
    const sortSelect = document.getElementById('tkProductSort');
    const clearButton = document.getElementById('tkClearFilters');
    const countBox = document.getElementById('tkProductCount');
    const activeText = document.getElementById('tkActiveFilterText');
    const noResults = document.getElementById('tkNoResults');
    const filterPanel = document.getElementById('tkFilterPanel');
    const mobileFilterBtn = document.getElementById('tkMobileFilterBtn');
    const filterClose = document.getElementById('tkFilterClose');

    const querySearch = new URLSearchParams(window.location.search).get('q');
    if (querySearch && searchInput) searchInput.value = querySearch;

    const allCategory = categoryChecks.find(el => el.value === 'all');

    function checkedCategories() {
        return categoryChecks
            .filter(el => el.checked && el.value !== 'all')
            .map(el => el.value);
    }

    function setQuickFilter(category) {
        quickFilters.forEach(button => {
            button.classList.toggle('active', button.dataset.category === category);
        });
    }

    function normalizeCategoryChecks(source) {
        if (source && source.value === 'all') {
            if (source.checked) {
                categoryChecks.forEach(el => {
                    if (el.value !== 'all') el.checked = false;
                });
            }
        } else {
            const specificChecked = categoryChecks.some(el => el.value !== 'all' && el.checked);
            if (allCategory) allCategory.checked = !specificChecked;
        }
    }

    function applyFilters() {
        const search = (searchInput?.value || '').trim().toLowerCase();
        const categories = checkedCategories();
        let visible = 0;

        cards.forEach(card => {
            const name = (card.dataset.name || '').toLowerCase();
            const category = card.dataset.category || '';
            const categoryLabel = (card.dataset.categoryLabel || '').toLowerCase();

            const matchesSearch = !search || name.includes(search) || categoryLabel.includes(search);
            const matchesCategory = categories.length === 0 || categories.includes(category);
            const show = matchesSearch && matchesCategory;

            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (countBox) {
            countBox.textContent = visible + (visible === 1 ? ' Product' : ' Products');
        }

        if (noResults) {
            noResults.style.display = visible ? 'none' : 'block';
        }

        if (activeText) {
            const parts = [];
            if (search) parts.push('Search: “' + searchInput.value.trim() + '”');
            if (categories.length) parts.push(categories.length + ' categor' + (categories.length === 1 ? 'y' : 'ies'));
            activeText.textContent = parts.length ? parts.join(' • ') : 'Showing all products';
        }

        if (categories.length === 1) {
            setQuickFilter(categories[0]);
        } else if (categories.length === 0) {
            setQuickFilter('all');
        } else {
            quickFilters.forEach(button => button.classList.remove('active'));
        }
    }

    function sortProducts() {
        const value = sortSelect?.value || 'recommended';
        const sorted = [...cards].sort((a, b) => {
            if (value === 'a-z') return a.dataset.name.localeCompare(b.dataset.name);
            if (value === 'z-a') return b.dataset.name.localeCompare(a.dataset.name);
            return Number(a.dataset.index) - Number(b.dataset.index);
        });

        sorted.forEach(card => grid.appendChild(card));
        applyFilters();
    }

    categoryChecks.forEach(check => {
        check.addEventListener('change', function () {
            normalizeCategoryChecks(this);
            applyFilters();
        });
    });

    quickFilters.forEach(button => {
        button.addEventListener('click', function () {
            const category = this.dataset.category;

            categoryChecks.forEach(check => {
                check.checked = category === 'all'
                    ? check.value === 'all'
                    : check.value === category;
            });

            setQuickFilter(category);
            applyFilters();
        });
    });

    searchInput?.addEventListener('input', applyFilters);
    sortSelect?.addEventListener('change', sortProducts);

    clearButton?.addEventListener('click', function () {
        categoryChecks.forEach(check => {
            check.checked = check.value === 'all';
        });

        if (searchInput) searchInput.value = '';
        if (sortSelect) sortSelect.value = 'recommended';

        sortProducts();
        setQuickFilter('all');
    });

    mobileFilterBtn?.addEventListener('click', function () {
        filterPanel?.classList.add('mobile-open');
    });

    filterClose?.addEventListener('click', function () {
        filterPanel?.classList.remove('mobile-open');
    });

    applyFilters();
});
</script>

</body>

</html>
