<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Edit Product | Teknolite Admin'; ?></title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- TeknoLite Admin Master Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/app.css'); ?>">

    <style>
        .fs-11 { font-size: 11px !important; }
        .fs-12 { font-size: 12px !important; }
        .fs-13 { font-size: 13px !important; }
        .fs-14 { font-size: 14px !important; }
        .fs-15 { font-size: 15px !important; }
        .fs-16 { font-size: 16px !important; }
        .fs-18 { font-size: 18px !important; }

        /* Left Preview Card */
        .product-preview-box {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 240px;
            border: 1px solid #eef2f6;
        }

        [data-bs-theme="dark"] .product-preview-box {
            background-color: #0f172a;
            border-color: #334155;
        }

        .product-preview-box img {
            max-width: 100%;
            max-height: 210px;
            object-fit: contain;
            display: block;
        }

        .color-swatch-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            margin-right: 6px;
            vertical-align: middle;
        }

        .color-swatch-dot.active {
            box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #04308c;
            transform: scale(1.1);
        }

        /* Dropzone Box */
        .Teknolite-dropzone-box {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 30px 20px;
            text-align: center;
            background-color: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        [data-bs-theme="dark"] .Teknolite-dropzone-box {
            background-color: #1e293b;
            border-color: #475569;
        }

        .Teknolite-dropzone-box:hover {
            border-color: #04308c;
            background-color: rgba(4, 48, 140, 0.03);
        }

        .action-bar-container {
            background-color: #e2e8f0;
            border-radius: 8px;
            padding: 14px 18px;
        }

        [data-bs-theme="dark"] .action-bar-container {
            background-color: #1e293b;
        }

        .form-control, .form-select {
            border-color: #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #04308c;
            box-shadow: 0 0 0 0.15rem rgba(4, 48, 140, 0.2);
        }

        .preset-img-thumb {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            padding: 2px;
            cursor: pointer;
            background: #fff;
            transition: all 0.15s;
        }
        .preset-img-thumb:hover {
            border-color: #04308c;
            transform: scale(1.06);
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Unified with Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'productedit']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'PRODUCT EDIT']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <?php 
                    $pId = $product['id'] ?? 'item';
                    $pName = $product['name'] ?? 'Product';
                    $pSku = $product['sku'] ?? '';
                    $pCat = $product['category'] ?? 'Cobspot Light';
                    $pSubcat = $product['subcategory'] ?? 'Recessed Trimless';
                    $pPrice = $product['price'] ?? 0;
                    $pRegPrice = $product['regular_price'] ?? 0;
                    $isPriceReq = !empty($product['price_on_request']);
                    $pStock = $product['stock'] ?? 100;
                    $pStatus = $product['status'] ?? 'active';
                    $isFeatured = !empty($product['is_featured']);
                    $isBestseller = !empty($product['is_bestseller']);
                    $pOrder = $product['display_order'] ?? 1;

                    // Image
                    $featuredImg = $product['featured_image'] ?? 'assets/images/products/gamma.png';
                    $imgSrc = (strpos($featuredImg, 'http') === 0) ? $featuredImg : base_url($featuredImg);

                    // Specs & features
                    $specs = $product['specifications'] ?? [];
                    $wattagesStr = implode(', ', $specs['wattage'] ?? []);
                    $cctStr = implode(', ', $specs['cct'] ?? []);
                    $beamStr = implode(', ', $specs['beam_angles'] ?? []);
                    $finishesStr = implode(', ', $specs['finishes'] ?? []);
                    $featuresStr = implode("\n", $product['features'] ?? []);
                    $appsStr = implode("\n", $product['applications'] ?? []);
                    $seo = $product['seo'] ?? [];
                ?>

                <form id="productEditForm" action="<?= base_url('admin/productedit/' . $pId); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">

                        <!-- Right Column: Full Product Configuration Cards -->
                        <div class="col-xl-9 col-lg-8">

                            <!-- 1. Featured Image & Gallery -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">1. Featured Image &amp; Gallery</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Featured Image Dropzone -->
                                        <div class="col-md-7">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Featured Fixture Photo (Upload new to replace)</label>
                                            <div class="Teknolite-dropzone-box" onclick="document.getElementById('featuredImageInput').click();">
                                                <div class="mb-2">
                                                    <i class="bx bx-cloud-upload" style="font-size: 44px; color: #04308c;"></i>
                                                </div>
                                                <h6 class="fs-14 fw-bold text-dark mb-1">
                                                    Drop new photo here, or <span style="color: #04308c; cursor: pointer;">browse</span>
                                                </h6>
                                                <p class="text-muted fs-12 mb-0">Current: <?= htmlspecialchars($featuredImg); ?></p>
                                                <input type="file" name="featured_image" id="featuredImageInput" accept="image/*" style="display: none;" onchange="handleFeaturedUpload(this)">
                                            </div>
                                            <input type="hidden" name="featured_image" id="selectedFeaturedPreset" value="<?= htmlspecialchars($featuredImg); ?>">
                                        </div>

                                        <!-- Quick Pick from TeknoLite Catalog Presets -->
                                        <div class="col-md-5">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Or Switch to Catalog Preset:</label>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <img src="<?= base_url('assets/images/products/gamma.png'); ?>" class="preset-img-thumb" title="Gamma Downlight" onclick="pickPreset('assets/images/products/gamma.png')">
                                                <img src="<?= base_url('assets/images/products/glight.png'); ?>" class="preset-img-thumb" title="Track Light" onclick="pickPreset('assets/images/products/glight.png')">
                                                <img src="<?= base_url('assets/images/products/gls.png'); ?>" class="preset-img-thumb" title="Garden Light" onclick="pickPreset('assets/images/products/gls.png')">
                                                <img src="<?= base_url('assets/images/products/mv8box.png'); ?>" class="preset-img-thumb" title="Surface Downlight" onclick="pickPreset('assets/images/products/mv8box.png')">
                                                <img src="<?= base_url('assets/images/products/spotlight.png'); ?>" class="preset-img-thumb" title="Spotlight" onclick="pickPreset('assets/images/products/spotlight.png')">
                                                <img src="<?= base_url('assets/images/products/rldrd.png'); ?>" class="preset-img-thumb" title="Round Recessed" onclick="pickPreset('assets/images/products/rldrd.png')">
                                                <img src="<?= base_url('assets/images/products/rldsq.png'); ?>" class="preset-img-thumb" title="Square Recessed" onclick="pickPreset('assets/images/products/rldsq.png')">
                                                <img src="<?= base_url('assets/images/products/ely.png'); ?>" class="preset-img-thumb" title="Linear Pendant" onclick="pickPreset('assets/images/products/ely.png')">
                                            </div>

                                            <!-- Multiple Gallery Upload -->
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Add Additional Gallery Photos</label>
                                            <input type="file" name="gallery_images[]" multiple class="form-control form-control-sm" accept="image/*" id="galleryInput" onchange="handleGalleryUpload(this)">
                                            <div class="d-flex flex-wrap gap-2 mt-2" id="galleryThumbnails">
                                                <?php if (!empty($product['gallery_images'])): ?>
                                                    <?php foreach ($product['gallery_images'] as $gImg): ?>
                                                        <img src="<?= (strpos($gImg, 'http') === 0) ? $gImg : base_url($gImg); ?>" class="preset-img-thumb">
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Basic Product Information -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">2. Basic Product Information</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Product Name -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="inputProductName" value="<?= htmlspecialchars($pName); ?>" required oninput="syncTitle(this.value)">
                                        </div>

                                        <!-- Product SKU / Code -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Product Code / SKU <span class="text-danger">*</span></label>
                                            <input type="text" name="sku" class="form-control" id="inputProductSku" value="<?= htmlspecialchars($pSku); ?>" required oninput="syncSku(this.value)">
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Category <span class="text-danger">*</span></label>
                                            <select name="category" class="form-select" id="inputProductCategory" onchange="syncCategory(this.value)">
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= htmlspecialchars($cat); ?>" <?= ($cat === $pCat) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($cat); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Subcategory -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Subcategory</label>
                                            <select name="subcategory" class="form-select">
                                                <?php foreach ($subcategories as $subcat): ?>
                                                    <option value="<?= htmlspecialchars($subcat); ?>" <?= ($subcat === $pSubcat) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($subcat); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Display Order -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Display Order</label>
                                            <input type="number" name="display_order" class="form-control" value="<?= htmlspecialchars($pOrder); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Pricing, Inventory & Status -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">3. Pricing, Inventory &amp; Status</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Price -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Price (&#8377;)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-muted fs-13 fw-bold">&#8377;</span>
                                                <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($pPrice); ?>" id="inputPrice" oninput="syncPrice(this.value)">
                                            </div>
                                        </div>

                                        <!-- Regular Price -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Regular Price (&#8377;)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-muted fs-13">&#8377;</span>
                                                <input type="number" step="0.01" name="regular_price" class="form-control" value="<?= htmlspecialchars($pRegPrice); ?>" id="inputRegularPrice" oninput="syncRegularPrice(this.value)">
                                            </div>
                                        </div>

                                        <!-- Stock Quantity -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Stock Quantity</label>
                                            <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($pStock); ?>">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Catalog Status</label>
                                            <select name="status" class="form-select" onchange="syncStatus(this.value)">
                                                <option value="active" <?= ($pStatus === 'active') ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?= ($pStatus === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Checkboxes -->
                                        <div class="col-12 pt-2">
                                            <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded-2 border">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="price_on_request" id="checkPriceOnRequest" <?= $isPriceReq ? 'checked' : ''; ?> onchange="togglePriceOnRequest(this)">
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkPriceOnRequest">
                                                        Price on Request <small class="text-muted fw-normal">(Hide price and show Request Quote)</small>
                                                    </label>
                                                </div>

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_featured" id="checkFeatured" <?= $isFeatured ? 'checked' : ''; ?>>
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkFeatured">
                                                        Featured Product <small class="text-muted fw-normal">(Show on homepage highlight)</small>
                                                    </label>
                                                </div>

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_bestseller" id="checkBestseller" <?= $isBestseller ? 'checked' : ''; ?>>
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkBestseller">
                                                        Best Seller / Popular
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Product Descriptions -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">4. Product Descriptions</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold text-muted mb-1">Short Description (Summary)</label>
                                        <textarea name="short_description" class="form-control" rows="2"><?= htmlspecialchars($product['short_description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label fs-13 fw-semibold text-muted mb-1">Full Architectural Description</label>
                                        <textarea name="full_description" class="form-control" rows="4"><?= htmlspecialchars($product['full_description'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Technical Specifications, Features & Applications -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">5. Technical Specifications, Features &amp; Applications</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Wattages -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Wattage Options (comma separated)</label>
                                            <input type="text" name="spec_wattage" class="form-control" value="<?= htmlspecialchars($wattagesStr); ?>" oninput="syncWattages(this.value)">
                                        </div>

                                        <!-- CCT -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Colour Temperatures (CCT)</label>
                                            <input type="text" name="spec_cct" class="form-control" value="<?= htmlspecialchars($cctStr); ?>">
                                        </div>

                                        <!-- Beam Angles -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Beam Angles</label>
                                            <input type="text" name="spec_beam_angles" class="form-control" value="<?= htmlspecialchars($beamStr); ?>">
                                        </div>

                                        <!-- Finishes -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Body Finishes</label>
                                            <input type="text" name="spec_finishes" class="form-control" value="<?= htmlspecialchars($finishesStr); ?>">
                                        </div>

                                        <!-- CRI -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Color Rendering (CRI)</label>
                                            <input type="text" name="spec_cri" class="form-control" value="<?= htmlspecialchars($specs['cri'] ?? '> 90 Ra'); ?>">
                                        </div>

                                        <!-- Input Voltage -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Input Voltage</label>
                                            <input type="text" name="spec_voltage" class="form-control" value="<?= htmlspecialchars($specs['input_voltage'] ?? 'AC 220-240V, 50/60Hz'); ?>">
                                        </div>

                                        <!-- IP Rating -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">IP Rating</label>
                                            <input type="text" name="spec_ip" class="form-control" value="<?= htmlspecialchars($specs['ip_rating'] ?? 'IP20'); ?>">
                                        </div>

                                        <!-- Mounting Type -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Mounting Type</label>
                                            <input type="text" name="spec_mounting" class="form-control" value="<?= htmlspecialchars($specs['mounting'] ?? 'Ceiling Recessed'); ?>">
                                        </div>

                                        <!-- Dimensions & Cutout -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Dimensions &amp; Cutout</label>
                                            <input type="text" name="spec_dimensions" class="form-control" value="<?= htmlspecialchars($specs['dimensions'] ?? ''); ?>">
                                        </div>

                                        <!-- Lumens & UGR -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Luminous Output &amp; UGR</label>
                                            <input type="text" name="spec_lumens" class="form-control" value="<?= htmlspecialchars(($specs['luminous_flux'] ?? '') . ' • ' . ($specs['ugr'] ?? '')); ?>">
                                        </div>

                                        <!-- Features -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Key Features (One per line)</label>
                                            <textarea name="features" class="form-control" rows="4"><?= htmlspecialchars($featuresStr); ?></textarea>
                                        </div>

                                        <!-- Applications -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Recommended Applications (One per line)</label>
                                            <textarea name="applications" class="form-control" rows="4"><?= htmlspecialchars($appsStr); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 6. Search Engine Optimization (SEO) -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">6. Search Engine Optimization (SEO)</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Meta Title -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($seo['meta_title'] ?? ($pName . ' | TeknoLite')); ?>" id="metaTitle">
                                        </div>

                                        <!-- SEO Slug -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">SEO-Friendly URL / Slug</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-muted fs-12">teknolite.com/product/</span>
                                                <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($seo['slug'] ?? $pId); ?>" id="slugInput">
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="col-12">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" value="<?= htmlspecialchars($seo['meta_keywords'] ?? ''); ?>">
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="col-12">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Description</label>
                                            <textarea name="meta_description" class="form-control" rows="2"><?= htmlspecialchars($seo['meta_description'] ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 7. Save & Cancel Action Bar -->
                            <div class="action-bar-container d-flex justify-content-end align-items-center gap-2 mb-4">
                                <button type="submit" class="btn btn-primary fw-semibold px-4 fs-13" style="background-color: #04308c; border-color: #04308c; color: #ffffff;">
                                    <i class="bx bx-check me-1"></i> Update &amp; Save Product
                                </button>
                                <a href="<?= base_url('admin/productlist'); ?>" class="btn btn-light bg-white border fw-semibold px-4 fs-13 text-dark">
                                    Cancel
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </main>

            <!-- Admin Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>

        <!-- Theme Settings Offcanvas Drawer -->
        <?php $this->load->view('admin/components/theme-settings'); ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Master Admin JS -->
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>

    <!-- Interactive Synchronization Scripts -->
    <script>
        function syncTitle(val) {
            const titleEl = document.getElementById('displayProductName');
            const catEl = document.getElementById('displayProductCategory');
            const currentCat = catEl ? catEl.textContent : '';
            if (val.trim()) {
                titleEl.innerHTML = val + ' <span class="text-muted fw-normal fs-13" id="displayProductCategory">' + currentCat + '</span>';
            }
        }

        function syncSku(val) {
            document.getElementById('displayProductSku').textContent = 'SKU: ' + (val.trim() ? val : '');
        }

        function syncCategory(val) {
            const catEl = document.getElementById('displayProductCategory');
            if (catEl) {
                catEl.textContent = '(' + val + ')';
            }
        }

        function syncPrice(val) {
            const priceEl = document.getElementById('displayPrice');
            if (priceEl) {
                priceEl.textContent = val.trim() ? '₹' + parseFloat(val).toLocaleString() : '₹0';
            }
        }

        function syncRegularPrice(val) {
            const regEl = document.getElementById('displayRegularPrice');
            if (regEl) {
                regEl.textContent = val.trim() ? '₹' + parseFloat(val).toLocaleString() : '';
            }
        }

        function togglePriceOnRequest(checkbox) {
            const wrap = document.getElementById('displayPriceWrap');
            if (checkbox.checked) {
                wrap.innerHTML = '<span class="badge bg-warning text-dark fs-12 px-2 py-1"><i class="bx bx-envelope me-1"></i> Price on Request</span>';
            } else {
                const p = document.getElementById('inputPrice').value;
                const r = document.getElementById('inputRegularPrice').value;
                let html = '';
                if (r) html += '<del class="text-muted fs-13 fw-medium" id="displayRegularPrice">₹' + parseFloat(r).toLocaleString() + '</del> ';
                html += '<span class="text-dark fw-bold fs-16 ms-1" id="displayPrice">₹' + (p ? parseFloat(p).toLocaleString() : '0') + '</span>';
                wrap.innerHTML = html;
            }
        }

        function syncStatus(val) {
            const badge = document.getElementById('displayStatusBadge');
            if (val === 'active') {
                badge.className = 'badge bg-success text-white';
                badge.textContent = 'Active';
            } else {
                badge.className = 'badge bg-danger text-white';
                badge.textContent = 'Inactive';
            }
        }

        function syncWattages(val) {
            const wrap = document.getElementById('previewWattages');
            if (!val.trim()) return;
            const parts = val.split(',');
            let html = '';
            parts.forEach((p, idx) => {
                const item = p.trim();
                if (item) {
                    html += `<span class="badge ${idx === 0 ? 'bg-primary text-white' : 'bg-light text-dark border'}" style="${idx === 0 ? 'background-color: #04308c !important;' : ''}">${item}</span> `;
                }
            });
            wrap.innerHTML = html;
        }

        function pickPreset(imagePath) {
            document.getElementById('previewImage').src = '<?= base_url(); ?>' + imagePath;
            document.getElementById('selectedFeaturedPreset').value = imagePath;
        }

        function handleFeaturedUpload(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                document.getElementById('selectedFeaturedPreset').value = '';
            }
        }

        function handleGalleryUpload(input) {
            const container = document.getElementById('galleryThumbnails');
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'preset-img-thumb';
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>
