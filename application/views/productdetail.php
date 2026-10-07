<?php
// Fallback if $product is not provided
if (empty($product) || !is_array($product)) {
    $product = [
        'id' => 1,
        'numeric_id' => 1,
        'slug' => 'led-cob-downlight',
        'name' => 'LED COB Downlight',
        'sku' => 'TL-COB-01',
        'category' => 'Cobspot Light',
        'subcategory' => 'Recessed Trimless',
        'featured_image' => 'assets/images/products/gamma.png',
        'hover_image' => 'assets/images/products/gamma_hover.jpeg',
        'gallery_images' => ['assets/images/products/gamma.png'],
        'price' => 0,
        'price_on_request' => true,
        'stock' => 50,
        'short_description' => 'High-performance LED COB Downlight designed for residential, commercial and architectural lighting applications.',
        'full_description' => 'High-performance architectural lighting solution providing focused and uniform illumination with clean recessed finishes.',
        'specifications' => [
            'wattage' => ['12W', '18W', '24W'],
            'cct' => ['3000K', '4000K', '6500K'],
            'beam_angles' => ['24°', '36°', '60°'],
            'finishes' => ['Matt White', 'Matt Black'],
            'mounting' => 'Ceiling Recessed',
            'input_voltage' => 'AC 220-240V, 50/60Hz',
            'cri' => '> 90 Ra',
            'ip_rating' => 'IP20',
            'dimensions' => 'Standard',
            'luminous_flux' => '1200 lm',
            'ugr' => '< 16 Anti-Glare'
        ],
        'features' => [
            'Energy-efficient LED technology',
            'Focused and uniform illumination',
            'Clean recessed ceiling finish',
            'Low glare UGR < 16 design',
            'Multiple wattage and CCT options'
        ],
        'applications' => [
            'Offices', 'Showrooms', 'Retail Stores', 'Hotels', 'Luxury Residences'
        ]
    ];
}

if (!function_exists('resolve_prod_img')) {
    function resolve_prod_img($path, $fallback = 'assets/images/products/gamma.png') {
        if (empty($path)) return base_url($fallback);
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
        if (strpos($path, 'assets/') === 0 || strpos($path, 'uploads/') === 0) return base_url($path);
        return base_url('assets/images/products/' . $path);
    }
}

$prodMainImg = resolve_prod_img($product['featured_image'] ?? '');
$prodDetailUrl = base_url('productdetail/' . ($product['slug'] ?? ($product['id'] ?? 'item')));

$galleryImages = [];
if (!empty($product['gallery_images']) && is_array($product['gallery_images'])) {
    $galleryImages = $product['gallery_images'];
}
if (!empty($product['featured_image']) && !in_array($product['featured_image'], $galleryImages)) {
    array_unshift($galleryImages, $product['featured_image']);
}
if (!empty($product['hover_image']) && !in_array($product['hover_image'], $galleryImages)) {
    $galleryImages[] = $product['hover_image'];
}
$galleryImages = array_values(array_unique(array_filter($galleryImages)));
if (empty($galleryImages)) {
    $galleryImages = ['assets/images/products/gamma.png'];
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en-US"
      lang="en-US">

<head>

    <meta charset="utf-8">

    <title><?= htmlspecialchars($product['name']); ?> | TeknoLite</title>

    <meta name="description"
          content="<?= htmlspecialchars(!empty($product['short_description']) ? strip_tags($product['short_description']) : ('Explore TeknoLite ' . $product['name'] . ' specifications, features and applications.')); ?>">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1">


    <?php $this->load->view('components/head')?>


    <!-- PRODUCT DETAIL CSS -->
    <link rel="stylesheet"
          href="<?= base_url('assets/css/product-detail.css'); ?>">

    <style>
        /* =========================================================
           Product Detail Multiple Images Gallery
        ========================================================= */
        .thumbs-slider {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        /* Vertical Thumbnails */
        .tf-product-media-thumbs {
            width: 84px;
            flex-shrink: 0;
            max-height: 520px;
            overflow: hidden;
            position: relative;
        }

        .tf-product-media-thumbs .swiper-slide {
            width: 80px !important;
            height: 80px !important;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .tf-product-media-thumbs .item {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            transition: all 0.25s ease;
            opacity: 0.6;
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tf-product-media-thumbs .item img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .tf-product-media-thumbs .swiper-slide-thumb-active .item,
        .tf-product-media-thumbs .item.active,
        .tf-product-media-thumbs .item:hover {
            border-color: #04308c;
            opacity: 1;
            box-shadow: 0 4px 14px rgba(4, 48, 140, 0.2);
            transform: translateY(-2px);
        }

        /* Main Image Slider */
        .tf-product-media-main {
            flex-grow: 1;
            width: calc(100% - 100px);
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #eef2f6;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        }

        .tf-product-media-main.w-100 {
            width: 100% !important;
        }

        .tf-product-media-main .item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 520px;
            background: #ffffff;
            overflow: hidden;
            padding: 20px;
        }

        .tf-product-media-main .item img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
            transition: transform 0.3s ease;
        }

        /* Navigation Arrows */
        .thumbs-slider .button-style-arrow {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            color: #1e293b;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            z-index: 10;
        }

        .thumbs-slider .button-style-arrow:after {
            font-size: 16px;
            font-weight: bold;
        }

        .thumbs-slider .button-style-arrow:hover {
            background: #04308c;
            color: #ffffff;
            border-color: #04308c;
        }

        /* Mobile & Tablet Layout */
        @media (max-width: 767px) {
            .thumbs-slider {
                flex-direction: column !important;
                gap: 12px;
            }

            .tf-product-media-main {
                width: 100% !important;
            }

            .tf-product-media-main .item {
                height: 350px;
                padding: 12px;
            }

            .tf-product-media-thumbs {
                width: 100% !important;
                order: 2;
                max-height: none;
            }

            .tf-product-media-thumbs .swiper-slide {
                width: 70px !important;
                height: 70px !important;
                margin-bottom: 0 !important;
                margin-right: 10px !important;
            }

            .tf-product-media-thumbs .item {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>



<body class="preload-wrapper">


    <!-- SCROLL TOP -->

    <button id="scroll-top" class="style-1">

        <svg width="24"
             height="25"
             viewBox="0 0 24 25"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">

            <path
                d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round" />

        </svg>

    </button>



    <!-- PRELOADER -->

    <div class="preload preload-container">

        <div class="preload-logo">

            <div class="spinner"></div>

        </div>

    </div>



    <!-- WRAPPER -->

    <div id="wrapper">


        <!-- HEADER -->

        <?php $this->load->view('components/header')?>



        <!-- =====================================================
             BREADCRUMB
        ====================================================== -->

        <!-- Breadcrumb -->
<!-- =========================================
     PRODUCT DETAIL BREADCRUMB
========================================= -->

<div class="tf-breadcrumb teknolite-breadcrumb"
     style="background-image: url('<?= base_url('assets/images/page-title/page-title-9.jpg'); ?>');">

    <div class="container">

        <div class="tf-breadcrumb-wrap">

            <!-- LEFT -->
            <div class="tf-breadcrumb-list">

                <a href="<?= base_url(); ?>"
                   class="text text-caption-1">
                    Home
                </a>

                <i class="icon icon-right"></i>

                <a href="<?= base_url('product'); ?>"
                   class="text text-caption-1">
                    Products
                </a>

                <i class="icon icon-right"></i>

                <span class="text text-caption-1">
                    <?= htmlspecialchars($product['name']); ?>
                </span>

            </div>


            <!-- RIGHT -->
            <div class="tf-breadcrumb-prev-next">

                <a href="#"
                   class="tf-breadcrumb-prev">
                    <i class="icon icon-left"></i>
                </a>

                <a href="<?= base_url('product'); ?>"
                   class="tf-breadcrumb-back">
                    <i class="icon icon-squaresfour"></i>
                </a>

                <a href="#"
                   class="tf-breadcrumb-next">
                    <i class="icon icon-right"></i>
                </a>

            </div>

        </div>

    </div>

</div>

<!-- /PRODUCT DETAIL BREADCRUMB -->
<!-- /Breadcrumb -->



        <!-- =====================================================
             PRODUCT MAIN
        ====================================================== -->

        <section class="flat-spacing">

            <div class="container">

                <div class="row">


                    <!-- PRODUCT GALLERY -->

                    <div class="col-md-6">


                        <div class="tf-product-media-wrap sticky-top">


                            <div class="thumbs-slider">

                                <?php if (count($galleryImages) > 1): ?>
                                <!-- THUMBNAILS -->
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($galleryImages as $tIdx => $tImg): ?>
                                            <?php $tUrl = resolve_prod_img($tImg); ?>
                                            <div class="swiper-slide" data-index="<?= $tIdx; ?>">
                                                <div class="item <?= $tIdx === 0 ? 'active' : ''; ?>">
                                                    <img class="lazyload"
                                                         data-src="<?= $tUrl; ?>"
                                                         src="<?= $tUrl; ?>"
                                                         alt="<?= htmlspecialchars($product['name']); ?> thumb <?= $tIdx + 1; ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- MAIN IMAGES -->
                                <div
                                    dir="ltr"
                                    class="swiper tf-product-media-main <?= count($galleryImages) <= 1 ? 'w-100' : ''; ?>"
                                    id="gallery-swiper-started">

                                    <div class="swiper-wrapper">
                                        <?php foreach ($galleryImages as $mIdx => $mImg): ?>
                                            <?php $mUrl = resolve_prod_img($mImg); ?>
                                            <div class="swiper-slide" data-index="<?= $mIdx; ?>">
                                                <a href="<?= $mUrl; ?>"
                                                   target="_blank"
                                                   class="item"
                                                   data-pswp-width="1200px"
                                                   data-pswp-height="1200px">
                                                    <img class="tf-image-zoom lazyload"
                                                         data-zoom="<?= $mUrl; ?>"
                                                         data-src="<?= $mUrl; ?>"
                                                         src="<?= $mUrl; ?>"
                                                         loading="lazy"
                                                         decoding="async"
                                                         alt="<?= htmlspecialchars($product['name']); ?>">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <?php if (count($galleryImages) > 1): ?>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- PRODUCT INFORMATION -->

                    <div class="col-md-6">


                        <div class="tf-product-info-wrap position-relative">


                            <div class="tf-product-info-list">


                                <div class="tf-product-info-heading">


                                    <div class="tf-product-info-name">


                                        <span class="teknolite-product-category text-caption-1">
                                            <?= htmlspecialchars($product['category'] ?? 'Lighting'); ?>
                                            <?php if (!empty($product['subcategory'])): ?>
                                                / <?= htmlspecialchars($product['subcategory']); ?>
                                            <?php endif; ?>
                                        </span>

                                        <h3 class="name">
                                            <?= htmlspecialchars($product['name']); ?>
                                        </h3>

                                    </div>

                                    <div class="tf-product-info-desc">

                                        <div class="tf-product-info-price teknolite-product-price">
                                            <h4 class="price-on-sale">
                                                <?= (!empty($product['price_on_request']) || empty($product['price'])) ? 'Price on Request' : ('₹' . number_format($product['price'], 2)); ?>
                                            </h4>
                                        </div>

                                        <p class="teknolite-product-description">
                                            <?= nl2br(htmlspecialchars($product['short_description'] ?: ($product['full_description'] ?: 'High-performance architectural lighting solution.'))); ?>
                                        </p>

                                    </div>

                                </div>

                                <div class="tf-product-info-choose-option">

                                    <?php $wattages = $product['specifications']['wattage'] ?? []; ?>
                                    <?php if (!empty($wattages)): ?>
                                    <!-- WATTAGE -->
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label mb_12">
                                            Wattage:
                                            <span class="text-title variant-picker-label-value"><?= htmlspecialchars($wattages[0]); ?></span>
                                        </div>
                                        <div class="variant-picker-values gap12">
                                            <?php foreach ($wattages as $wIdx => $watt): ?>
                                                <input type="radio" name="wattage" id="wattage_<?= $wIdx; ?>" value="<?= htmlspecialchars($watt); ?>" <?= $wIdx === 0 ? 'checked' : ''; ?>>
                                                <label class="style-text size-btn" for="wattage_<?= $wIdx; ?>">
                                                    <span class="text-title"><?= htmlspecialchars($watt); ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php $ccts = $product['specifications']['cct'] ?? []; ?>
                                    <?php if (!empty($ccts)): ?>
                                    <!-- CCT -->
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label mb_12">
                                            Colour Temperature:
                                            <span class="text-title variant-picker-label-value"><?= htmlspecialchars($ccts[0]); ?></span>
                                        </div>
                                        <div class="variant-picker-values gap12">
                                            <?php foreach ($ccts as $cIdx => $cct): ?>
                                                <input type="radio" name="cct" id="cct_<?= $cIdx; ?>" value="<?= htmlspecialchars($cct); ?>" <?= $cIdx === 0 ? 'checked' : ''; ?>>
                                                <label class="style-text size-btn" for="cct_<?= $cIdx; ?>">
                                                    <span class="text-title"><?= htmlspecialchars($cct); ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php $beams = $product['specifications']['beam_angles'] ?? []; ?>
                                    <?php if (!empty($beams)): ?>
                                    <!-- BEAM ANGLES -->
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label mb_12">
                                            Beam Angle:
                                            <span class="text-title variant-picker-label-value"><?= htmlspecialchars($beams[0]); ?></span>
                                        </div>
                                        <div class="variant-picker-values gap12">
                                            <?php foreach ($beams as $bIdx => $beam): ?>
                                                <input type="radio" name="beam_angle" id="beam_<?= $bIdx; ?>" value="<?= htmlspecialchars($beam); ?>" <?= $bIdx === 0 ? 'checked' : ''; ?>>
                                                <label class="style-text size-btn" for="beam_<?= $bIdx; ?>">
                                                    <span class="text-title"><?= htmlspecialchars($beam); ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php $finishes = $product['specifications']['finishes'] ?? []; ?>
                                    <?php if (!empty($finishes)): ?>
                                    <!-- FINISHES -->
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label mb_12">
                                            Finish / Color:
                                            <span class="text-title variant-picker-label-value"><?= htmlspecialchars($finishes[0]); ?></span>
                                        </div>
                                        <div class="variant-picker-values gap12">
                                            <?php foreach ($finishes as $fIdx => $fin): ?>
                                                <input type="radio" name="finish" id="finish_<?= $fIdx; ?>" value="<?= htmlspecialchars($fin); ?>" <?= $fIdx === 0 ? 'checked' : ''; ?>>
                                                <label class="style-text size-btn" for="finish_<?= $fIdx; ?>">
                                                    <span class="text-title"><?= htmlspecialchars($fin); ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <!-- QUANTITY -->
                                    <div class="tf-product-info-quantity">
                                        <div class="title mb_12">Quantity:</div>
                                        <div class="wg-quantity">
                                            <span class="btn-quantity btn-decrease">-</span>
                                            <input class="quantity-product" id="productQuantity" type="text" name="number" value="1">
                                            <span class="btn-quantity btn-increase">+</span>
                                        </div>
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="teknolite-action-buttons mb_16">
                                        <a href="#enquiryForm"
                                           data-bs-toggle="modal"
                                           data-bs-target="#enquiryForm"
                                           data-product-name="<?= htmlspecialchars($product['name']); ?>"
                                           data-product-category="<?= htmlspecialchars($product['category']); ?>"
                                           data-product-image="<?= $prodMainImg; ?>"
                                           data-product-url="<?= $prodDetailUrl; ?>"
                                           data-product-quantity="1"
                                           class="tf-btn btn-onsurface">
                                            Add to Enquiry
                                            <i class="icon-arrow-up-right"></i>
                                        </a>

                                        <a href="<?= base_url('contact'); ?>"
                                           class="tf-btn btn-white has-border">
                                            Request Quote
                                            <i class="icon-arrow-up-right"></i>
                                        </a>

                                        <a href="javascript:void(0);"
                                           class="tf-btn btn-white has-border teknolite-btn-wishlist"
                                           data-product-id="<?= htmlspecialchars($product['id'] ?? $product['slug']); ?>"
                                           data-product-name="<?= htmlspecialchars($product['name']); ?>"
                                           data-product-category="<?= htmlspecialchars($product['category']); ?>"
                                           data-product-image="<?= $prodMainImg; ?>"
                                           data-product-url="<?= $prodDetailUrl; ?>"
                                           title="Save to Wishlist">
                                            <span class="icon icon-heart"></span>
                                            <span class="wishlist-btn-text">Save to Wishlist</span>
                                        </a>
                                    </div>

                                    <!-- WHATSAPP -->
                                    <a href="https://wa.me/917021247619?text=<?= urlencode('Hello TeknoLite, I want to enquire about ' . $product['name'] . ' (' . $prodDetailUrl . ').'); ?>"
                                       target="_blank"
                                       rel="noopener"
                                       class="tf-btn btn-white has-border w-full teknolite-whatsapp-btn">
                                        WhatsApp Enquiry
                                        <i class="icon-arrow-up-right"></i>
                                    </a>

                                    <!-- META -->
                                    <div class="teknolite-product-meta">
                                        <p>
                                            <strong>Category:</strong>
                                            <span class="text_secondary"><?= htmlspecialchars($product['category']); ?></span>
                                        </p>
                                        <?php if (!empty($product['subcategory'])): ?>
                                        <p>
                                            <strong>Subcategory:</strong>
                                            <span class="text_secondary"><?= htmlspecialchars($product['subcategory']); ?></span>
                                        </p>
                                        <?php endif; ?>
                                        <?php if (!empty($product['sku'])): ?>
                                        <p>
                                            <strong>SKU:</strong>
                                            <span class="text_secondary"><?= htmlspecialchars($product['sku']); ?></span>
                                        </p>
                                        <?php endif; ?>
                                        <p>
                                            <strong>Availability:</strong>
                                            <span class="text_secondary"><?= ($product['stock'] > 0) ? 'In Stock (' . $product['stock'] . ' available)' : 'Available on Enquiry'; ?></span>
                                        </p>
                                    </div>


                                </div>


                            </div>


                        </div>

                    </div>


                </div>

            </div>

        </section>



        <!-- =====================================================
             DETAILS TABS
        ====================================================== -->

        <section class="teknolite-product-tabs">

            <div class="container">

                <div class="widget-tabs style-1">


                    <ul class="widget-menu-tab">


                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Specifications</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Features</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Applications</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Technical Details</span>
                        </li>

                        <li class="item-title">
                            <span class="inner">Downloads</span>
                        </li>


                    </ul>



                    <div class="widget-content-tab">


                        <!-- DESCRIPTION -->
                        <div class="widget-content-inner active">
                            <div class="tab-description">
                                <div class="right">
                                    <h6 class="mb_12">
                                        <?= htmlspecialchars($product['name']); ?>
                                    </h6>
                                    <p class="text_secondary">
                                        <?= nl2br(htmlspecialchars($product['full_description'] ?: ($product['short_description'] ?: 'TeknoLite ' . $product['name'] . ' provides focused, energy-efficient illumination designed with clean architectural lines.'))); ?>
                                    </p>
                                </div>

                                <div class="left">
                                    <h6 class="mb_12">
                                        Product Highlights
                                    </h6>
                                    <ul class="list-text type-disc gap-6">
                                        <?php if (!empty($product['features'])): ?>
                                            <?php foreach (array_slice($product['features'], 0, 5) as $f): ?>
                                                <li class="text_secondary"><?= htmlspecialchars($f); ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="text_secondary">Architectural recessed &amp; surface integration</li>
                                            <li class="text_secondary">High-efficiency LED light engine</li>
                                            <li class="text_secondary">Premium die-cast thermal heat sink</li>
                                            <li class="text_secondary">Multiple optical beam distributions</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- SPECIFICATIONS -->
                        <div class="widget-content-inner">
                            <div class="table-responsive">
                                <table class="teknolite-spec-table">
                                    <tbody>
                                        <tr>
                                            <th>Product Name</th>
                                            <td><?= htmlspecialchars($product['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td><?= htmlspecialchars($product['category'] . (!empty($product['subcategory']) ? ' / ' . $product['subcategory'] : '')); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SKU</th>
                                            <td><?= htmlspecialchars($product['sku']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Wattage</th>
                                            <td><?= htmlspecialchars(is_array($product['specifications']['wattage']) ? implode(' / ', $product['specifications']['wattage']) : $product['specifications']['wattage']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Colour Temperature (CCT)</th>
                                            <td><?= htmlspecialchars(is_array($product['specifications']['cct']) ? implode(' / ', $product['specifications']['cct']) : $product['specifications']['cct']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Beam Angle</th>
                                            <td><?= htmlspecialchars(is_array($product['specifications']['beam_angles']) ? implode(' / ', $product['specifications']['beam_angles']) : $product['specifications']['beam_angles']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Available Finishes</th>
                                            <td><?= htmlspecialchars(is_array($product['specifications']['finishes']) ? implode(' / ', $product['specifications']['finishes']) : $product['specifications']['finishes']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Mounting</th>
                                            <td><?= htmlspecialchars($product['specifications']['mounting'] ?: 'Ceiling Recessed'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><?= !empty($product['price_on_request']) || empty($product['price']) ? 'Price on Request' : '₹' . number_format($product['price'], 2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- FEATURES -->
                        <div class="widget-content-inner">
                            <div class="teknolite-feature-list">
                                <?php if (!empty($product['features'])): ?>
                                    <?php foreach ($product['features'] as $feat): ?>
                                        <div class="teknolite-feature-item">
                                            <i class="icon icon-checkcircle"></i>
                                            <span class="text_secondary">
                                                <?= htmlspecialchars($feat); ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="teknolite-feature-item">
                                        <i class="icon icon-checkcircle"></i>
                                        <span class="text_secondary">Energy-efficient LED luminaire technology</span>
                                    </div>
                                    <div class="teknolite-feature-item">
                                        <i class="icon icon-checkcircle"></i>
                                        <span class="text_secondary">Focused and uniform illumination without glare</span>
                                    </div>
                                    <div class="teknolite-feature-item">
                                        <i class="icon icon-checkcircle"></i>
                                        <span class="text_secondary">Clean architectural recessed installation</span>
                                    </div>
                                    <div class="teknolite-feature-item">
                                        <i class="icon icon-checkcircle"></i>
                                        <span class="text_secondary">Multiple wattage, optic, and finish configurations</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- APPLICATIONS -->
                        <div class="widget-content-inner">
                            <div class="tab-description">
                                <div class="right">
                                    <h6 class="mb_12">
                                        Commercial Applications
                                    </h6>
                                    <ul class="list-text type-disc gap-6">
                                        <?php 
                                        $apps = !empty($product['applications']) ? $product['applications'] : ['Offices', 'Showrooms', 'Retail Stores', 'Hotels', 'Restaurants', 'Living Rooms', 'Bedrooms', 'Galleries'];
                                        $half = ceil(count($apps) / 2);
                                        $apps1 = array_slice($apps, 0, $half);
                                        $apps2 = array_slice($apps, $half);
                                        foreach ($apps1 as $item): ?>
                                            <li class="text_secondary"><?= htmlspecialchars($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="left">
                                    <h6 class="mb_12">
                                        Residential &amp; Hospitality
                                    </h6>
                                    <ul class="list-text type-disc gap-6">
                                        <?php if (!empty($apps2)): ?>
                                            <?php foreach ($apps2 as $item): ?>
                                                <li class="text_secondary"><?= htmlspecialchars($item); ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="text_secondary">Luxury Residences</li>
                                            <li class="text_secondary">Hotels &amp; Lounges</li>
                                            <li class="text_secondary">Corridors &amp; Lobbies</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- TECHNICAL -->
                        <div class="widget-content-inner">
                            <div class="table-responsive">
                                <table class="teknolite-spec-table">
                                    <tbody>
                                        <tr>
                                            <th>Input Voltage</th>
                                            <td><?= htmlspecialchars($product['specifications']['input_voltage'] ?: 'AC 220-240V, 50/60Hz'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Color Rendering Index (CRI)</th>
                                            <td><?= htmlspecialchars($product['specifications']['cri'] ?: '> 90 Ra'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ingress Protection</th>
                                            <td><?= htmlspecialchars($product['specifications']['ip_rating'] ?: 'IP20'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Anti-Glare Rating (UGR)</th>
                                            <td><?= htmlspecialchars($product['specifications']['ugr'] ?: '< 16 Anti-Glare'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td><?= htmlspecialchars($product['specifications']['dimensions'] ?: 'Standard'); ?></td>
                                        </tr>
                                        <?php if (!empty($product['specifications']['luminous_flux'])): ?>
                                        <tr>
                                            <th>Luminous Flux</th>
                                            <td><?= htmlspecialchars($product['specifications']['luminous_flux']); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- DOWNLOAD -->
                        <div class="widget-content-inner">
                            <div class="teknolite-download-box">
                                <div>
                                    <h6 class="mb_6">
                                        <?= htmlspecialchars($product['name']); ?> Specifications
                                    </h6>
                                    <p class="text_secondary">
                                        View and save product technical specifications and photometric parameters.
                                    </p>
                                </div>
                                <a
                                    href="javascript:void(0)"
                                    onclick="window.print()"
                                    class="tf-btn btn-white has-border">
                                    Print / Save Specs
                                    <i class="icon-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>


                    </div>


                </div>

            </div>

        </section>



        <!-- =====================================================
             RELATED PRODUCTS
        ====================================================== -->

        <section class="flat-spacing-7">

            <div class="container flat-animate-tab">


                <ul class="tab-product justify-content-center wow fadeInUp">

                    <li class="nav-tab-item">

                        <a class="active h4">
                            Related Products
                        </a>

                    </li>

                </ul>



                <div
                    dir="ltr"
                    class="swiper tf-sw-latest"
                    data-preview="4"
                    data-tablet="3"
                    data-mobile="2"
                    data-space-lg="30"
                    data-space-md="30"
                    data-space="15"
                    data-pagination="1">


                    <div class="swiper-wrapper">
                        <?php if (!empty($related_products)): ?>
                            <?php foreach ($related_products as $rp): 
                                $rpUrl = base_url('productdetail/' . (!empty($rp['slug']) ? $rp['slug'] : $rp['id']));
                                $rpImg = resolve_prod_img($rp['featured_image'] ?? '');
                                $rpHover = !empty($rp['hover_image']) ? resolve_prod_img($rp['hover_image']) : $rpImg;
                                $rpWattage = is_array($rp['specifications']['wattage'] ?? null) 
                                    ? implode(' / ', $rp['specifications']['wattage']) 
                                    : ($rp['specifications']['wattage'] ?? ($rp['subcategory'] ?? 'Architectural'));
                                $rpPrice = (!empty($rp['price_on_request']) || empty($rp['price'])) 
                                    ? 'Price on Request' 
                                    : '₹' . number_format($rp['price'], 2);
                            ?>
                            <div class="swiper-slide">
                                <div class="card-product style-1">
                                    <div class="card-product-wrapper">
                                        <a href="<?= $rpUrl; ?>" class="image-wrap">
                                            <img
                                                class="lazyload img-product"
                                                src="<?= $rpImg; ?>"
                                                loading="lazy"
                                                decoding="async"
                                                alt="<?= htmlspecialchars($rp['name']); ?>">
                                            <img
                                                class="lazyload img-hover"
                                                src="<?= $rpHover; ?>"
                                                loading="lazy"
                                                decoding="async"
                                                alt="<?= htmlspecialchars($rp['name']); ?>">
                                        </a>
                                        <div class="list-btn-main">
                                            <a
                                                href="#enquiryForm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#enquiryForm"
                                                data-product-name="<?= htmlspecialchars($rp['name']); ?>"
                                                data-product-image="<?= $rpImg; ?>"
                                                data-product-category="<?= htmlspecialchars($rp['category']); ?>"
                                                data-product-url="<?= $rpUrl; ?>"
                                                class="btn-main-product">
                                                Add to Enquiry
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="<?= $rpUrl; ?>" class="title link">
                                            <?= htmlspecialchars($rp['name']); ?>
                                        </a>
                                        <p class="text-caption-1 text_secondary">
                                            <?= htmlspecialchars($rpWattage); ?>
                                        </p>
                                        <div class="price text-body-default">
                                            <?= $rpPrice; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-4">
                                <p class="text_secondary">Explore our complete collection in the <a href="<?= base_url('product'); ?>" class="link text-decoration-underline">Product Catalog</a>.</p>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>


                </div>


            </div>

        </section>



        <!-- FOOTER -->

        <?php $this->load->view('components/footer')?>


    </div>
    <!-- /wrapper -->



    <!-- MOBILE MENU -->

    <?php $this->load->view('components/offcanvas')?>



    <!-- ENQUIRY CART -->

    <div
        class="modal fullRight fade modal-shopping-cart style-empty"
        id="shoppingCart">


        <div class="modal-dialog">

            <div class="modal-content">


                <div class="d-flex flex-column flex-grow-1 h-100">


                    <div class="header">

                        <h5 class="title">
                            Enquiry Cart
                        </h5>

                        <span
                            class="icon-close icon-close-popup"
                            data-bs-dismiss="modal">
                        </span>

                    </div>


                    <div class="wrap">

                        <div class="content-inner">

                            <h4>
                                Product Added to Enquiry
                            </h4>

                            <p>
                                <?= htmlspecialchars($product['name']); ?> has been selected for enquiry.
                            </p>

                            <a
                                href="#enquiryForm"
                                data-bs-dismiss="modal"
                                data-bs-toggle="modal"
                                data-bs-target="#enquiryForm"
                                class="tf-btn btn-onsurface w-full mx-auto">

                                Proceed to Enquiry

                                <i class="icon-arrow-up-right"></i>

                            </a>

                        </div>

                    </div>


                </div>


            </div>

        </div>

    </div>



    <!-- COMMON JS -->

    <?php $this->load->view('components/script')?>

    <script>
        (function($) {
            $(document).ready(function() {
                // Handle thumbnail click sync
                $(document).on('click', '.tf-product-media-thumbs .swiper-slide', function(e) {
                    var idx = $(this).index();
                    var mainSwiperEl = document.querySelector('.tf-product-media-main');
                    if (mainSwiperEl && mainSwiperEl.swiper) {
                        mainSwiperEl.swiper.slideTo(idx);
                    }
                    $('.tf-product-media-thumbs .item').removeClass('active');
                    $(this).find('.item').addClass('active');
                });

                // Sync active thumb when main slide changes
                var pollSwiper = setInterval(function() {
                    var mainSwiperEl = document.querySelector('.tf-product-media-main');
                    if (mainSwiperEl && mainSwiperEl.swiper) {
                        clearInterval(pollSwiper);
                        mainSwiperEl.swiper.on('slideChange', function() {
                            var activeIdx = this.activeIndex;
                            $('.tf-product-media-thumbs .item').removeClass('active');
                            var targetThumb = $('.tf-product-media-thumbs .swiper-slide').eq(activeIdx);
                            targetThumb.find('.item').addClass('active');
                            targetThumb.addClass('swiper-slide-thumb-active').siblings().removeClass('swiper-slide-thumb-active');
                            var thumbsSwiperEl = document.querySelector('.tf-product-media-thumbs');
                            if (thumbsSwiperEl && thumbsSwiperEl.swiper) {
                                thumbsSwiperEl.swiper.slideTo(activeIdx);
                            }
                        });
                    }
                }, 100);
                setTimeout(function() { clearInterval(pollSwiper); }, 3000);
            });
        })(jQuery);
    </script>




</body>

</html>