<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Category Edit | Teknolite Admin'; ?></title>

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

        /* Left Preview Box */
        .category-preview-box {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 220px;
            border: 1px solid #eef2f6;
        }

        [data-bs-theme="dark"] .category-preview-box {
            background-color: #0f172a;
            border-color: #334155;
        }

        .category-preview-box img {
            max-width: 100%;
            max-height: 190px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            transition: transform 0.2s ease;
        }

        .avatar-xxl {
            width: 130px;
            height: 130px;
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
            background-color: rgba(4, 48, 140, 0.02);
        }

        .action-bar-container {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 14px 18px;
            border: 1px solid #e2e8f0;
        }

        [data-bs-theme="dark"] .action-bar-container {
            background-color: #1e293b;
            border-color: #334155;
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
            object-fit: contain;
            transition: transform 0.15s ease, border-color 0.15s ease;
            background: #fff;
        }

        .preset-img-thumb:hover, .preset-img-thumb.active {
            border-color: #04308c;
            transform: scale(1.08);
            box-shadow: 0 2px 6px rgba(4, 48, 140, 0.25);
        }

        .admin-footer {
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Kept identical to Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'categorieedit']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CATEGORY EDIT']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <?php 
                    $catId = $category['id'] ?? 'cobspot-light';
                    $catName = $category['name'] ?? 'Cobspot Light';
                    $catImage = !empty($category['image']) ? base_url($category['image']) : base_url('assets/images/products/gamma.png');
                    $catStock = $category['stock'] ?? 486;
                    $catPrice = $category['starting_price'] ?? 1450;
                    $catTagId = $category['tag_id'] ?? 'FS16276';
                    $catCreatedBy = $category['created_by'] ?? 'Admin';
                    $catOrder = $category['display_order'] ?? 1;
                    $catStatus = $category['status'] ?? 'active';
                    $catShortDesc = $category['short_description'] ?? '';
                    $catDesc = $category['description'] ?? '';
                    $metaTitle = $category['meta_title'] ?? ($catName . ' | TeknoLite');
                    $metaKeywords = $category['meta_keywords'] ?? strtolower($catName);
                    $metaDesc = $category['meta_description'] ?? '';
                ?>
                <form id="categoryEditForm" method="post" action="<?= base_url('admin/categorieedit/' . $catId); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="selected_preset_img" id="selectedPresetImg" value="">

                    <div class="row g-3">

                        <!-- Right Column: Edit Forms -->
                        <div class="col-xl-9 col-lg-8">

                            <!-- Card 1: Add Thumbnail Photo -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title fs-15 fw-bold mb-0 text-dark">Add / Update Thumbnail Photo</h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="Teknolite-dropzone-box" id="dropzoneBox" onclick="document.getElementById('categoryThumbInput').click();">
                                        <input type="file" id="categoryThumbInput" name="category_thumb" accept="image/*" class="d-none">
                                        <div class="dz-message">
                                            <i class="bx bx-cloud-upload fs-48" style="font-size: 48px; color: #04308c;"></i>
                                            <h3 class="mt-3 fs-16 fw-semibold text-dark">
                                                Drop your images here, or <span style="color: #04308c;">click to browse</span>
                                            </h3>
                                            <span class="text-muted fs-13">
                                                1600 x 1200 (4:3) recommended. PNG, JPG, GIF and WebP allowed
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Dropzone Preview Container -->
                                    <ul class="list-unstyled mb-0 mt-3" id="dropzonePreviewList">
                                        <li class="border rounded p-2 d-flex align-items-center justify-content-between" id="previewItem" style="display: none !important;">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded me-3 d-flex align-items-center justify-content-center p-1" style="width: 44px; height: 44px;">
                                                    <img id="dzThumbImg" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 40px;">
                                                </div>
                                                <div>
                                                    <h6 class="fs-13 mb-1 fw-bold text-dark" id="dzFileName">category_image.png</h6>
                                                    <p class="fs-12 text-muted mb-0" id="dzFileSize">120 KB</p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary" id="dzRemoveBtn" style="background-color: #04308c; border-color: #04308c;">Delete</button>
                                        </li>
                                    </ul>

                                    <!-- Quick Presets -->
                                    <div class="mt-3 pt-2 border-top">
                                        <span class="text-muted fs-12 me-2">Catalog Presets:</span>
                                        <div class="d-inline-flex align-items-center gap-2 flex-wrap mt-1">
                                            <img src="<?= base_url('assets/images/products/gamma.png'); ?>" class="preset-img-thumb" title="Cobspot Light" alt="Cobspot" data-title="Cobspot Light" data-rel="assets/images/products/gamma.png">
                                            <img src="<?= base_url('assets/images/products/mv8box.png'); ?>" class="preset-img-thumb" title="Down Lights" alt="Downlight" data-title="Down Lights" data-rel="assets/images/products/mv8box.png">
                                            <img src="<?= base_url('assets/images/products/spotlight.png'); ?>" class="preset-img-thumb" title="Spot Lights" alt="Spotlight" data-title="Spot Lights" data-rel="assets/images/products/spotlight.png">
                                            <img src="<?= base_url('assets/images/products/glight.png'); ?>" class="preset-img-thumb" title="Garden Lights" alt="Garden" data-title="Garden Lights" data-rel="assets/images/products/glight.png">
                                            <img src="<?= base_url('assets/images/products/rldrd.png'); ?>" class="preset-img-thumb" title="Linear Lighting" alt="Linear" data-title="Linear Lighting" data-rel="assets/images/products/rldrd.png">
                                            <img src="<?= base_url('assets/images/products/ely.png'); ?>" class="preset-img-thumb" title="Track Lighting" alt="Track" data-title="Track Lighting" data-rel="assets/images/products/ely.png">
                                            <img src="<?= base_url('assets/images/products/rldsq.png'); ?>" class="preset-img-thumb" title="Wall Washers" alt="Wall Washer" data-title="Wall Washers" data-rel="assets/images/products/rldsq.png">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: General Information -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title fs-15 fw-bold mb-0 text-dark">General Information</h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="category-title" class="form-label fs-13 fw-semibold text-dark">Category Title <span class="text-danger">*</span></label>
                                                <input type="text" id="category-title" name="name" class="form-control" placeholder="Enter Title" value="<?= htmlspecialchars($catName); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div>
                                                <label for="crater" class="form-label fs-13 fw-semibold text-dark">Created By</label>
                                                <select class="form-select" id="crater" name="created_by">
                                                    <option value="Admin" <?= ($catCreatedBy === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                                    <option value="Seller" <?= ($catCreatedBy === 'Seller') ? 'selected' : ''; ?>>Seller</option>
                                                    <option value="Other" <?= ($catCreatedBy === 'Other') ? 'selected' : ''; ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="product-stock" class="form-label fs-13 fw-semibold text-dark">Estimated Stock</label>
                                                <input type="number" id="product-stock" name="stock" class="form-control" placeholder="Quantity" value="<?= $catStock; ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="starting-price" class="form-label fs-13 fw-semibold text-dark">Starting Price (₹)</label>
                                                <input type="number" id="starting-price" name="starting_price" class="form-control" placeholder="1000" value="<?= $catPrice; ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="product-id" class="form-label fs-13 fw-semibold text-dark">Tag ID</label>
                                                <input type="text" id="product-id" name="tag_id" class="form-control" placeholder="#******" value="<?= htmlspecialchars($catTagId); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div>
                                                <label for="display-order" class="form-label fs-13 fw-semibold text-dark">Display Order</label>
                                                <input type="number" id="display-order" name="display_order" class="form-control" value="<?= $catOrder; ?>" min="1">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div>
                                                <label for="status" class="form-label fs-13 fw-semibold text-dark">Active / Inactive Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="active" <?= ($catStatus === 'active') ? 'selected' : ''; ?>>Active</option>
                                                    <option value="inactive" <?= ($catStatus === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div>
                                                <label for="short-description" class="form-label fs-13 fw-semibold text-dark">Short Description</label>
                                                <input type="text" id="short-description" name="short_description" class="form-control" value="<?= htmlspecialchars($catShortDesc); ?>" placeholder="Short category summary">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div>
                                                <label for="description" class="form-label fs-13 fw-semibold text-dark">Full Description</label>
                                                <textarea class="form-control bg-light-subtle" id="description" name="description" rows="5" placeholder="Type description"><?= htmlspecialchars($catDesc); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Meta Options -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title fs-15 fw-bold mb-0 text-dark">Meta Options (SEO)</h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="meta-title" class="form-label fs-13 fw-semibold text-dark">Meta Title</label>
                                                <input type="text" id="meta-title" name="meta_title" class="form-control" placeholder="Enter Title" value="<?= htmlspecialchars($metaTitle); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div>
                                                <label for="meta-tag" class="form-label fs-13 fw-semibold text-dark">Meta Tag Keyword</label>
                                                <input type="text" id="meta-tag" name="meta_keywords" class="form-control" placeholder="Enter word" value="<?= htmlspecialchars($metaKeywords); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div>
                                                <label for="meta-description" class="form-label fs-13 fw-semibold text-dark">Description</label>
                                                <textarea class="form-control bg-light-subtle" id="meta-description" name="meta_description" rows="3" placeholder="Type description"><?= htmlspecialchars($metaDesc); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div class="action-bar-container mb-4">
                                <div class="row justify-content-end g-2">
                                    <div class="col-sm-3 col-md-2 col-6">
                                        <button type="submit" id="saveCategoryBtn" class="btn btn-outline-secondary w-100 fs-13 py-2 fw-semibold text-nowrap">
                                            Save Changes
                                        </button>
                                    </div>
                                    <div class="col-sm-3 col-md-2 col-6">
                                        <a href="<?= base_url('admin/categorie'); ?>" class="btn btn-primary w-100 fs-13 py-2 fw-semibold text-nowrap" style="background-color: #04308c; border-color: #04308c;">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </main>

            <!-- Teknolite Admin Footer -->
            <footer class="admin-footer text-center py-3 text-muted border-top mt-auto">
                <div class="container-fluid">
                    2026 &copy; Teknolite. Crafted by <span class="text-danger">&#10084;</span> <strong class="text-dark">Nexmoves solution</strong>
                </div>
            </footer>
        </div>
    </div>

    <!-- Theme Settings Offcanvas Drawer -->
    <?php $this->load->view('admin/components/theme-settings'); ?>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Iconify Icons -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewTitle = document.getElementById('previewCategoryTitle');
        const previewCreatedBy = document.getElementById('previewCreatedBy');
        const previewStock = document.getElementById('previewStock');
        const previewTagId = document.getElementById('previewTagId');
        const previewImg = document.getElementById('previewCategoryImg');
        const presetHidden = document.getElementById('selectedPresetImg');

        const titleInput = document.getElementById('category-title');
        const createdBySelect = document.getElementById('crater');
        const stockInput = document.getElementById('product-stock');
        const tagIdInput = document.getElementById('product-id');

        // Live input updates
        if (titleInput && previewTitle) {
            titleInput.addEventListener('input', function() {
                previewTitle.textContent = this.value.trim() || "Category Title";
            });
        }
        if (createdBySelect && previewCreatedBy) {
            createdBySelect.addEventListener('change', function() {
                previewCreatedBy.textContent = this.value || "Seller";
            });
        }
        if (stockInput && previewStock) {
            stockInput.addEventListener('input', function() {
                previewStock.textContent = this.value || "0";
            });
        }
        if (tagIdInput && previewTagId) {
            tagIdInput.addEventListener('input', function() {
                previewTagId.textContent = this.value.trim() || "#******";
            });
        }

        // Dropzone & File Upload handling
        const fileInput = document.getElementById('categoryThumbInput');
        const dropzoneBox = document.getElementById('dropzoneBox');
        const previewItem = document.getElementById('previewItem');
        const dzThumbImg = document.getElementById('dzThumbImg');
        const dzFileName = document.getElementById('dzFileName');
        const dzFileSize = document.getElementById('dzFileSize');
        const dzRemoveBtn = document.getElementById('dzRemoveBtn');

        if (dropzoneBox && fileInput) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzoneBox.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzoneBox.style.borderColor = '#04308c';
                    dropzoneBox.style.backgroundColor = 'rgba(4, 48, 140, 0.05)';
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzoneBox.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzoneBox.style.borderColor = '#cbd5e1';
                    dropzoneBox.style.backgroundColor = '#ffffff';
                }, false);
            });

            dropzoneBox.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileUpload(files[0]);
                }
            }, false);

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    handleFileUpload(this.files[0]);
                }
            });
        }

        function handleFileUpload(file) {
            if (!file.type.match('image.*')) {
                alert('Please upload a valid image file (PNG, JPG, GIF, WebP).');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgUrl = e.target.result;
                if (previewImg) previewImg.src = imgUrl;
                if (dzThumbImg) dzThumbImg.src = imgUrl;
                if (dzFileName) dzFileName.textContent = file.name;
                if (dzFileSize) dzFileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                if (previewItem) previewItem.style.setProperty('display', 'flex', 'important');
                if (presetHidden) presetHidden.value = '';
            };
            reader.readAsDataURL(file);
        }

        if (dzRemoveBtn) {
            dzRemoveBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (fileInput) fileInput.value = '';
                if (previewItem) previewItem.style.setProperty('display', 'none', 'important');
            });
        }

        // Preset Thumbnails Selector
        const presetThumbs = document.querySelectorAll('.preset-img-thumb');
        presetThumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                presetThumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const newSrc = this.src;
                if (previewImg) previewImg.src = newSrc;

                if (this.dataset.rel && presetHidden) {
                    presetHidden.value = this.dataset.rel;
                }

                if (this.dataset.title && titleInput) {
                    titleInput.value = this.dataset.title;
                    if (previewTitle) previewTitle.textContent = this.dataset.title;
                }
            });
        });
    });
    </script>
</body>
</html>
