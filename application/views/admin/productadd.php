<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Create Product | Teknolite Admin'; ?></title>

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

        .pill-toggle-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }

        .pill-toggle-badge.active,
        .pill-toggle-badge:hover {
            background-color: #04308c;
            color: #ffffff;
            border-color: #04308c;
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
            padding: 36px 20px;
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

        .section-header-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #04308c;
            margin-bottom: 12px;
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
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'productadd']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CREATE PRODUCT']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <form id="productAddForm" action="<?= base_url('admin/productadd'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">

                        <!-- Right Column: Full Product Configuration Cards -->
                        <div class="col-xl-9 col-lg-8">

                            <!-- 1. Add Product Photo & Gallery -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">1. Featured Image &amp; Media Gallery</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Featured Image Dropzone -->
                                        <div class="col-md-7">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Featured Image (Primary Display) <span class="text-danger">*</span></label>
                                            <div class="Teknolite-dropzone-box" onclick="document.getElementById('featuredImageInput').click();">
                                                <div class="mb-2">
                                                    <i class="bx bx-cloud-upload" style="font-size: 46px; color: #04308c;"></i>
                                                </div>
                                                <h6 class="fs-14 fw-bold text-dark mb-1">
                                                    Drop featured fixture photo here, or <span style="color: #04308c; cursor: pointer;">browse</span>
                                                </h6>
                                                <p class="text-muted fs-12 mb-0">PNG, JPG, WEBP. Transparent or white background recommended.</p>
                                                <input type="file" name="featured_image" id="featuredImageInput" accept="image/*" style="display: none;" onchange="handleFeaturedUpload(this)">
                                            </div>
                                            <input type="hidden" name="featured_image" id="selectedFeaturedPreset" value="assets/images/products/gamma.png">
                                        </div>

                                        <!-- Quick Pick from TeknoLite Catalog Presets -->
                                        <div class="col-md-5">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Or Pick Existing Fixture Preset:</label>
                                            <p class="text-muted fs-12 mb-2">Click any fixture to use as primary image:</p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <img src="<?= base_url('assets/images/products/gamma.png'); ?>" class="preset-img-thumb" title="Gamma Downlight" onclick="pickPreset('assets/images/products/gamma.png', 'LED COB Downlight')">
                                                <img src="<?= base_url('assets/images/products/glight.png'); ?>" class="preset-img-thumb" title="Track Light" onclick="pickPreset('assets/images/products/glight.png', 'LED Track Light')">
                                                <img src="<?= base_url('assets/images/products/gls.png'); ?>" class="preset-img-thumb" title="Garden Light" onclick="pickPreset('assets/images/products/gls.png', 'Garden & Landscape Light')">
                                                <img src="<?= base_url('assets/images/products/mv8box.png'); ?>" class="preset-img-thumb" title="Surface Downlight" onclick="pickPreset('assets/images/products/mv8box.png', 'Surface Mount Downlight')">
                                                <img src="<?= base_url('assets/images/products/spotlight.png'); ?>" class="preset-img-thumb" title="Spotlight" onclick="pickPreset('assets/images/products/spotlight.png', 'Spotlight Accent Series')">
                                                <img src="<?= base_url('assets/images/products/rldrd.png'); ?>" class="preset-img-thumb" title="Round Recessed" onclick="pickPreset('assets/images/products/rldrd.png', 'Round Linear Recessed Light')">
                                                <img src="<?= base_url('assets/images/products/rldsq.png'); ?>" class="preset-img-thumb" title="Square Recessed" onclick="pickPreset('assets/images/products/rldsq.png', 'Square Recessed Downlight')">
                                                <img src="<?= base_url('assets/images/products/ely.png'); ?>" class="preset-img-thumb" title="Linear Pendant" onclick="pickPreset('assets/images/products/ely.png', 'Architectural Linear Pendant')">
                                            </div>

                                            <!-- Multiple Gallery Upload -->
                                            <div class="mt-3">
                                                <label class="form-label fs-13 fw-semibold text-muted mb-1">Multiple Gallery Photos</label>
                                                <input type="file" name="gallery_images[]" multiple class="form-control form-control-sm" accept="image/*" id="galleryInput" onchange="handleGalleryUpload(this)">
                                                <small class="text-muted fs-11">Hold Ctrl/Cmd to upload multiple dimension or application photos.</small>
                                                <div class="d-flex flex-wrap gap-2 mt-2" id="galleryThumbnails"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Basic Information -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">2. Basic Product Information</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Product Name -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="inputProductName" placeholder="e.g. LED COB Downlight" required oninput="syncTitle(this.value)">
                                        </div>

                                        <!-- Product SKU / Code -->
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="form-label fs-13 fw-semibold text-muted mb-0">Product Code / SKU <span class="text-danger">*</span></label>
                                                <button type="button" class="btn btn-link p-0 text-decoration-none fs-12 fw-medium text-primary" onclick="generateSku(true)" title="Generate unique SKU code">
                                                    <i class="bx bx-refresh"></i> Auto-Generate
                                                </button>
                                            </div>
                                            <input type="text" name="sku" class="form-control" id="inputProductSku" placeholder="e.g. TL-BASIC-01" required oninput="handleSkuInput(this.value)">
                                            <small class="text-muted fs-11">Uniquely generated (auto-resolves if code already exists).</small>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Category <span class="text-danger">*</span></label>
                                            <select name="category" class="form-select" id="inputProductCategory" onchange="syncCategory(this.value)">
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= htmlspecialchars($cat); ?>" <?= ($cat === 'Cobspot Light') ? 'selected' : ''; ?>>
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
                                                    <option value="<?= htmlspecialchars($subcat); ?>">
                                                        <?= htmlspecialchars($subcat); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Display Order -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Display Order</label>
                                            <input type="number" name="display_order" class="form-control" placeholder="1" value="1">
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
                                                <input type="number" step="0.01" name="price" class="form-control" placeholder="1450" id="inputPrice" oninput="syncPrice(this.value)">
                                            </div>
                                        </div>

                                        <!-- Regular / MRP Price -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Regular Price (&#8377;)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-muted fs-13">&#8377;</span>
                                                <input type="number" step="0.01" name="regular_price" class="form-control" placeholder="1800" id="inputRegularPrice" oninput="syncRegularPrice(this.value)">
                                            </div>
                                        </div>

                                        <!-- Stock Quantity -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Stock Quantity</label>
                                            <input type="number" name="stock" class="form-control" placeholder="250" value="100">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-3">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Catalog Status</label>
                                            <select name="status" class="form-select" onchange="syncStatus(this.value)">
                                                <option value="active" selected>Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Checkboxes: Price on Request, Featured, Best Seller -->
                                        <div class="col-12 pt-2">
                                            <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded-2 border">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="price_on_request" id="checkPriceOnRequest" onchange="togglePriceOnRequest(this)">
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkPriceOnRequest">
                                                        Price on Request <small class="text-muted fw-normal">(Hide price and show Request Quote)</small>
                                                    </label>
                                                </div>

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_featured" id="checkFeatured">
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkFeatured">
                                                        Featured Product <small class="text-muted fw-normal">(Show on homepage highlight)</small>
                                                    </label>
                                                </div>

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_bestseller" id="checkBestseller">
                                                    <label class="form-check-label fw-semibold fs-13 text-dark" for="checkBestseller">
                                                        Best Seller / Popular
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Descriptions -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">4. Product Descriptions</h5>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold text-muted mb-1">Short Description (Summary on catalogue cards)</label>
                                        <textarea name="short_description" class="form-control" rows="2" placeholder="Architectural recessed LED COB downlight with deep-set anti-glare optics and vibrant color fidelity."></textarea>
                                    </div>

                                    <!-- Full Description -->
                                    <div class="mb-0">
                                        <label class="form-label fs-13 fw-semibold text-muted mb-1">Full Architectural Description</label>
                                        <textarea name="full_description" class="form-control" rows="4" placeholder="Comprehensive fixture details, thermal engineering, reflector optics, and architectural integration notes..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Technical Specifications & Features -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">5. Technical Specifications, Features &amp; Applications</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Wattages -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Wattage Options (comma separated)</label>
                                            <input type="text" name="spec_wattage" class="form-control" placeholder="7W, 12W, 18W, 24W" value="7W, 12W, 18W, 24W" oninput="syncWattages(this.value)">
                                            <small class="text-muted fs-11">e.g. 7W, 12W, 18W, 24W</small>
                                        </div>

                                        <!-- CCT / Colour Temperatures -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Colour Temperatures (CCT)</label>
                                            <input type="text" name="spec_cct" class="form-control" placeholder="3000K Warm, 4000K Natural, 6000K Cool" value="3000K Warm White, 4000K Natural White, 6000K Cool White">
                                        </div>

                                        <!-- Beam Angles -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Beam Angles</label>
                                            <input type="text" name="spec_beam_angles" class="form-control" placeholder="15°, 24°, 36°, 60°" value="15°, 24°, 36°, 60°">
                                        </div>

                                        <!-- Body Finishes -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Body Finishes</label>
                                            <input type="text" name="spec_finishes" class="form-control" placeholder="Matt White, Matt Black, Brushed Gold" value="Matt White, Matt Black, Brushed Gold">
                                        </div>

                                        <!-- CRI -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Color Rendering (CRI)</label>
                                            <input type="text" name="spec_cri" class="form-control" placeholder="> 90 Ra" value="> 90 Ra">
                                        </div>

                                        <!-- Input Voltage -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Input Voltage</label>
                                            <input type="text" name="spec_voltage" class="form-control" placeholder="AC 220-240V, 50/60Hz" value="AC 220-240V, 50/60Hz">
                                        </div>

                                        <!-- IP Rating -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">IP Rating</label>
                                            <input type="text" name="spec_ip" class="form-control" placeholder="IP20 / IP44 Optional" value="IP20 / IP44 Optional">
                                        </div>

                                        <!-- Mounting Type -->
                                        <div class="col-md-4">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Mounting Type</label>
                                            <input type="text" name="spec_mounting" class="form-control" placeholder="Ceiling Recessed" value="Ceiling Recessed">
                                        </div>

                                        <!-- Dimensions & Cutout -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Dimensions &amp; Cutout</label>
                                            <input type="text" name="spec_dimensions" class="form-control" placeholder="Ø85mm x 70mm (Cutout Ø75mm)" value="Ø85mm x 70mm (Cutout Ø75mm)">
                                        </div>

                                        <!-- Lumens & UGR -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Luminous Output &amp; UGR</label>
                                            <input type="text" name="spec_lumens" class="form-control" placeholder="950 - 2400 Lumens • UGR < 16" value="950 - 2400 Lumens • UGR < 16">
                                        </div>

                                        <!-- Features (One per line) -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Key Architectural Features (One per line)</label>
                                            <textarea name="features" class="form-control" rows="4" placeholder="Deep recessed anti-glare optical chamber (UGR < 16)&#10;Heavy-duty die-cast aluminum heat sink&#10;Flicker-free isolated constant current driver&#10;50,000+ hours L70 rated lifespan">Deep recessed anti-glare optical chamber (UGR < 16)
Heavy-duty die-cast aluminum thermal heat dissipation
Flicker-free isolated constant current LED driver
50,000+ hours L70 rated operating lifespan</textarea>
                                        </div>

                                        <!-- Applications (One per line) -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Recommended Applications (One per line)</label>
                                            <textarea name="applications" class="form-control" rows="4" placeholder="Luxury Residential Villas&#10;High-End Retail Boutiques&#10;Hospitality & Hotel Suites&#10;Corporate Boardrooms">Luxury Residential Villas
High-End Retail Boutiques
Hospitality & Hotel Guestrooms
Art Galleries & Museums
Corporate Executive Boardrooms</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 6. SEO Metadata -->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="card-title mb-0 fs-15 fw-bold text-dark">6. Search Engine Optimization (SEO)</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <!-- Meta Title -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" placeholder="LED COB Downlight | Architectural Lighting | TeknoLite" id="metaTitle">
                                        </div>

                                        <!-- SEO Slug -->
                                        <div class="col-md-6">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">SEO-Friendly URL / Slug</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-muted fs-12">teknolite.com/product/</span>
                                                <input type="text" name="slug" class="form-control" placeholder="led-cob-downlight" id="slugInput">
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="col-12">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Keywords (comma separated)</label>
                                            <input type="text" name="meta_keywords" class="form-control" placeholder="LED Downlight, Recessed Light, Architectural Lighting, TeknoLite">
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="col-12">
                                            <label class="form-label fs-13 fw-semibold text-muted mb-1">Meta Description</label>
                                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Explore TeknoLite LED COB Downlight specifications, features, applications and technical details."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 7. Save & Cancel Action Bar -->
                            <div class="action-bar-container d-flex justify-content-end align-items-center gap-2 mb-4">
                                <button type="submit" class="btn btn-primary fw-semibold px-4 fs-13" style="background-color: #04308c; border-color: #04308c; color: #ffffff;">
                                    <i class="bx bx-save me-1"></i> Save &amp; Publish Product
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
        function handleSkuInput(val) {
            const input = document.getElementById('inputProductSku');
            if (input) {
                input.dataset.customized = 'true';
            }
            syncSku(val);
        }

        function generateSku(force = false) {
            const skuInput = document.getElementById('inputProductSku');
            if (!skuInput) return;
            if (!force && skuInput.dataset.customized && skuInput.value.trim()) {
                return;
            }
            const name = document.getElementById('inputProductName').value.trim();
            let prefix = 'TL-';
            if (name) {
                const clean = name.replace(/[^a-zA-Z0-9]/g, '').toUpperCase().substring(0, 6);
                prefix += (clean ? clean : 'PROD') + '-';
            } else {
                prefix += 'PROD-';
            }
            const randNum = Math.floor(100 + Math.random() * 900);
            const newSku = prefix + randNum;
            skuInput.value = newSku;
            syncSku(newSku);
        }

        function syncTitle(val) {
            const titleEl = document.getElementById('displayProductName');
            const catEl = document.getElementById('displayProductCategory');
            const metaTitleEl = document.getElementById('metaTitle');
            const slugEl = document.getElementById('slugInput');
            const currentCat = catEl ? catEl.textContent : '(Cobspot Light)';

            if (val.trim()) {
                titleEl.innerHTML = val + ' <span class="text-muted fw-normal fs-13" id="displayProductCategory">' + currentCat + '</span>';
                if (!metaTitleEl.value) {
                    metaTitleEl.value = val + ' | TeknoLite Architectural Lighting';
                }
                if (!slugEl.dataset.customized) {
                    slugEl.value = val.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
                }
                const skuInput = document.getElementById('inputProductSku');
                if (skuInput && (!skuInput.dataset.customized || !skuInput.value.trim())) {
                    generateSku(false);
                }
            } else {
                titleEl.innerHTML = 'LED COB Downlight <span class="text-muted fw-normal fs-13" id="displayProductCategory">' + currentCat + '</span>';
            }
        }

        function syncSku(val) {
            document.getElementById('displayProductSku').textContent = 'SKU: ' + (val.trim() ? val : 'TL-AUTO');
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
                priceEl.textContent = val.trim() ? '₹' + parseFloat(val).toLocaleString() : '₹1,450';
            }
        }

        function syncRegularPrice(val) {
            const regEl = document.getElementById('displayRegularPrice');
            if (regEl) {
                regEl.textContent = val.trim() ? '₹' + parseFloat(val).toLocaleString() : '₹1,800';
            }
        }

        function togglePriceOnRequest(checkbox) {
            const wrap = document.getElementById('displayPriceWrap');
            if (checkbox.checked) {
                wrap.innerHTML = '<span class="badge bg-warning text-dark fs-12 px-2 py-1"><i class="bx bx-envelope me-1"></i> Price on Request</span>';
            } else {
                const p = document.getElementById('inputPrice').value;
                const r = document.getElementById('inputRegularPrice').value;
                wrap.innerHTML = '<del class="text-muted fs-13 fw-medium" id="displayRegularPrice">₹' + (r || '1,800') + '</del>' +
                                 '<span class="text-dark fw-bold fs-16 ms-1" id="displayPrice">₹' + (p || '1,450') + '</span>';
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
            if (!val.trim()) {
                wrap.innerHTML = '<span class="badge bg-light text-dark border">12W</span>';
                return;
            }
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

        function pickPreset(imagePath, defaultName) {
            document.getElementById('previewImage').src = '<?= base_url(); ?>' + imagePath;
            document.getElementById('selectedFeaturedPreset').value = imagePath;
            const nameInput = document.getElementById('inputProductName');
            if (!nameInput.value.trim()) {
                nameInput.value = defaultName;
                syncTitle(defaultName);
            }
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
            container.innerHTML = '';
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

        document.getElementById('slugInput').addEventListener('input', function() {
            this.dataset.customized = 'true';
        });
    </script>
</body>
</html>
