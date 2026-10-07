<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Product Details | TeknoLite Admin'; ?></title>

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
        .product-detail-carousel {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            border: 1px solid #e2e8f0;
            min-height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        [data-bs-theme="dark"] .product-detail-carousel {
            background-color: #0f172a;
            border-color: #334155;
        }
        .product-detail-carousel img {
            max-height: 280px;
            max-width: 100%;
            object-fit: contain;
            display: block;
        }
        .thumb-nav-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            object-fit: contain;
            cursor: pointer;
            padding: 4px;
            background: #fff;
            transition: all 0.2s ease;
        }
        .thumb-nav-img.active,
        .thumb-nav-img:hover {
            border-color: #04308c;
            transform: scale(1.05);
        }
        .spec-item {
            padding: 10px 14px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        [data-bs-theme="dark"] .spec-item {
            background: #1e293b;
            border-color: #334155;
        }
        .spec-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .spec-value {
            font-size: 13.5px;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2px;
        }
        [data-bs-theme="dark"] .spec-value {
            color: #f1f5f9;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Unified with Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'productlistdetail']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'PRODUCT DETAILS']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <?php 
                    $pId = $product['id'] ?? 'item';
                    $pName = $product['name'] ?? 'Product';
                    $pSku = $product['sku'] ?? ($product['model'] ?? 'N/A');
                    $pCat = $product['category'] ?? 'Cobspot Light';
                    $pSubcat = $product['subcategory'] ?? '';
                    $pPrice = $product['price'] ?? 0;
                    $pRegPrice = $product['regular_price'] ?? 0;
                    $isPriceReq = !empty($product['price_on_request']);
                    $pStock = $product['stock'] ?? 100;
                    $pStatus = $product['status'] ?? 'active';
                    $isFeatured = !empty($product['is_featured']);
                    $isBestseller = !empty($product['is_bestseller']);

                    // Main Image
                    $featuredImg = $product['featured_image'] ?? ($product['image'] ?? 'assets/images/products/gamma.png');
                    $imgSrc = (strpos($featuredImg, 'http') === 0) ? $featuredImg : base_url($featuredImg);

                    // Gallery images
                    $gallery = !empty($product['gallery_images']) ? $product['gallery_images'] : [$featuredImg];
                    if (!empty($product['hover_image']) && !in_array($product['hover_image'], $gallery)) {
                        $gallery[] = $product['hover_image'];
                    }

                    $specs = $product['specifications'] ?? [];
                    $features = $product['features'] ?? [];
                    $applications = $product['applications'] ?? [];
                    $seo = $product['seo'] ?? [];
                ?>

                <!-- Breadcrumb & Actions -->
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-1 fs-13">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/productlist'); ?>" class="text-muted text-decoration-none">Products</a></li>
                                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page"><?= htmlspecialchars($pName); ?></li>
                            </ol>
                        </nav>
                        <h4 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($pName); ?></h4>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="<?= base_url('admin/productlist'); ?>" class="btn btn-sm btn-outline-secondary fs-13">
                            <i class="bx bx-arrow-back me-1"></i> Back to Catalog
                        </a>
                        <a href="<?= base_url('admin/productedit/' . $pId); ?>" class="btn btn-sm btn-primary fs-13" style="background-color: #04308c; border-color: #04308c;">
                            <i class="bx bx-edit me-1"></i> Edit Product
                        </a>
                        <a href="<?= base_url('admin/productadd'); ?>" class="btn btn-sm btn-light border fs-13">
                            <i class="bx bx-plus me-1"></i> Add New Fixture
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Left: Gallery & Images -->
                    <div class="col-lg-5">
                        <div class="card p-3 mb-3">
                            <div class="product-detail-carousel mb-3">
                                <img id="mainProductImage" src="<?= $imgSrc; ?>" alt="<?= htmlspecialchars($pName); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/gamma.png'); ?>';">
                            </div>

                            <!-- Thumbnail Strip -->
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                <?php foreach ($gallery as $idx => $gImg): ?>
                                    <?php $thumbSrc = (strpos($gImg, 'http') === 0) ? $gImg : base_url($gImg); ?>
                                    <img src="<?= $thumbSrc; ?>" 
                                         class="thumb-nav-img <?= $idx === 0 ? 'active' : ''; ?>" 
                                         alt="Gallery <?= $idx + 1; ?>"
                                         onclick="document.getElementById('mainProductImage').src = this.src; document.querySelectorAll('.thumb-nav-img').forEach(el => el.classList.remove('active')); this.classList.add('active');"
                                         onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/gamma.png'); ?>';">
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- SEO Metadata Card -->
                        <div class="card p-3 mb-3">
                            <h6 class="fw-bold text-dark fs-14 mb-2"><i class="bx bx-search-alt-2 text-primary me-1"></i> SEO Information</h6>
                            <div class="p-2 bg-light rounded border fs-12 mb-2">
                                <span class="text-muted d-block">Public URL Preview:</span>
                                <a href="<?= base_url('productdetail'); ?>" target="_blank" class="text-primary text-decoration-none fw-medium text-break">
                                    <?= base_url('product/' . ($seo['slug'] ?? $pId)); ?>
                                </a>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted fs-12 d-block fw-semibold">Meta Title:</span>
                                <span class="text-dark fs-13"><?= htmlspecialchars($seo['meta_title'] ?? $pName); ?></span>
                            </div>
                            <?php if (!empty($seo['meta_description'])): ?>
                                <div class="mb-2">
                                    <span class="text-muted fs-12 d-block fw-semibold">Meta Description:</span>
                                    <span class="text-dark fs-13"><?= htmlspecialchars($seo['meta_description']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($seo['meta_keywords'])): ?>
                                <div>
                                    <span class="text-muted fs-12 d-block fw-semibold">Meta Keywords:</span>
                                    <span class="text-muted fs-12"><?= htmlspecialchars($seo['meta_keywords']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Right: Product Information, Specs & Applications -->
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <!-- Category, Subcategory & Status Badges -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary text-white fs-12 px-3 py-1 rounded-pill" style="background-color: #04308c !important;">
                                        <?= htmlspecialchars($pCat); ?>
                                    </span>
                                    <?php if ($pSubcat): ?>
                                        <span class="badge bg-light text-dark border fs-12 px-3 py-1 rounded-pill">
                                            <?= htmlspecialchars($pSubcat); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="badge <?= ($pStatus === 'active') ? 'bg-success' : 'bg-danger'; ?> text-white fs-12 px-3 py-1 rounded-pill">
                                        <i class="bx <?= ($pStatus === 'active') ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i> <?= ucfirst($pStatus); ?>
                                    </span>
                                </div>
                            </div>

                            <h3 class="fw-bold text-dark mb-1"><?= htmlspecialchars($pName); ?></h3>
                            <p class="text-muted fs-13 mb-3">Product SKU / Model Code: <strong class="text-dark"><?= htmlspecialchars($pSku); ?></strong></p>

                            <!-- Price Display -->
                            <div class="d-flex align-items-baseline gap-3 mb-4 p-3 bg-light rounded-3">
                                <?php if ($isPriceReq): ?>
                                    <span class="badge bg-warning text-dark fs-14 px-3 py-2 fw-bold">
                                        <i class="bx bx-envelope me-1"></i> Price on Request
                                    </span>
                                <?php else: ?>
                                    <h2 class="fw-bold text-dark mb-0">&#8377;<?= number_format($pPrice, 2); ?></h2>
                                    <?php if ($pRegPrice > $pPrice): ?>
                                        <span class="text-muted text-decoration-line-through fs-15">&#8377;<?= number_format($pRegPrice, 2); ?></span>
                                        <span class="badge bg-danger-subtle text-danger fs-12">Save &#8377;<?= number_format($pRegPrice - $pPrice, 2); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="ms-auto text-muted fs-13">Stock: <strong class="text-dark"><?= number_format($pStock); ?> Units</strong></span>
                            </div>

                            <!-- Short Description -->
                            <?php if (!empty($product['short_description'])): ?>
                                <h6 class="fw-bold text-dark mb-1 fs-14">Summary</h6>
                                <p class="text-muted fs-13 lh-base mb-3"><?= htmlspecialchars($product['short_description']); ?></p>
                            <?php endif; ?>

                            <!-- Full Description -->
                            <h6 class="fw-bold text-dark mb-1 fs-14">Full Architectural Description</h6>
                            <p class="text-muted fs-13 lh-base mb-4">
                                <?= htmlspecialchars($product['full_description'] ?? ($product['description'] ?? '')); ?>
                            </p>

                            <!-- Technical Specifications Grid -->
                            <h6 class="fw-bold text-dark mb-3 fs-14">Technical Specifications</h6>
                            <div class="row g-2 mb-4">
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Wattage Options</div>
                                        <div class="spec-value"><?= !empty($specs['wattage']) ? implode(', ', $specs['wattage']) : 'Standard'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Color Temp (CCT)</div>
                                        <div class="spec-value"><?= !empty($specs['cct']) ? implode(', ', $specs['cct']) : '3000K, 4000K'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Beam Angle</div>
                                        <div class="spec-value"><?= !empty($specs['beam_angles']) ? implode(', ', $specs['beam_angles']) : '24°, 36°'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Body Finishes</div>
                                        <div class="spec-value"><?= !empty($specs['finishes']) ? implode(', ', $specs['finishes']) : 'Matt White, Matt Black'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Color Rendering (CRI)</div>
                                        <div class="spec-value"><?= $specs['cri'] ?? '> 90 Ra'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">IP Rating</div>
                                        <div class="spec-value"><?= $specs['ip_rating'] ?? 'IP20'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Input Voltage</div>
                                        <div class="spec-value"><?= $specs['input_voltage'] ?? 'AC 220-240V'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Mounting Type</div>
                                        <div class="spec-value"><?= $specs['mounting'] ?? 'Ceiling Recessed'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Dimensions</div>
                                        <div class="spec-value"><?= $specs['dimensions'] ?? 'Standard'; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="spec-item">
                                        <div class="spec-label">Luminous Flux &amp; UGR</div>
                                        <div class="spec-value"><?= ($specs['luminous_flux'] ?? '') . ' ' . ($specs['ugr'] ?? ''); ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Features -->
                            <?php if (!empty($features)): ?>
                                <h6 class="fw-bold text-dark mb-2 fs-14">Key Architectural Features</h6>
                                <ul class="list-unstyled mb-4">
                                    <?php foreach ($features as $f): ?>
                                        <li class="fs-13 text-muted mb-1 d-flex align-items-start gap-2">
                                            <i class="bx bx-check-circle text-success fs-16 mt-1 flex-shrink-0"></i>
                                            <span><?= htmlspecialchars($f); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <!-- Applications -->
                            <?php if (!empty($applications)): ?>
                                <h6 class="fw-bold text-dark mb-2 fs-14">Recommended Applications</h6>
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <?php foreach ($applications as $app): ?>
                                        <span class="badge bg-light text-dark border fs-12 px-3 py-2">
                                            <i class="bx bx-building me-1 text-primary"></i> <?= htmlspecialchars($app); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Bottom Action Buttons -->
                            <div class="d-flex align-items-center gap-2 pt-3 border-top flex-wrap">
                                <a href="<?= base_url('admin/productedit/' . $pId); ?>" class="btn btn-primary px-4 fs-13" style="background-color: #04308c; border-color: #04308c;">
                                    <i class="bx bx-edit me-1"></i> Edit Fixture
                                </a>
                                <a href="<?= base_url('admin/productlist'); ?>" class="btn btn-outline-secondary px-4 fs-13">
                                    Back to Catalogue
                                </a>
                                <a href="<?= base_url('productdetail'); ?>" target="_blank" class="btn btn-light border px-3 fs-13 ms-auto">
                                    <i class="bx bx-globe me-1"></i> View on Storefront
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>
</html>
