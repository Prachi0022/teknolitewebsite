<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Product List | Teknolite Admin'; ?></title>

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

    <!-- Page Specific Styles for Teknolite Product List -->
    <style>
        .fs-12 { font-size: 12px !important; }
        .fs-13 { font-size: 13px !important; }
        .fs-14 { font-size: 14px !important; }
        .fs-15 { font-size: 15px !important; }
        .fs-18 { font-size: 18px !important; }

        .Teknolite-product-avatar {
            width: 52px;
            height: 52px;
            min-width: 52px;
            max-width: 52px;
            border-radius: 8px;
            background-color: #f8fafc;
            border: 1px solid #eef2f6;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            overflow: hidden;
            flex-shrink: 0;
        }

        [data-bs-theme="dark"] .Teknolite-product-avatar {
            background-color: #0f172a;
            border-color: #334155;
        }

        .Teknolite-product-avatar img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .btn-Teknolite-add {
            background-color: #04308c;
            border-color: #04308c;
            color: #ffffff;
            font-weight: 500;
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-Teknolite-add:hover {
            background-color: #03256c;
            border-color: #03256c;
            color: #ffffff;
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: #64748b;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .btn-action-icon:hover {
            color: #ffffff;
        }

        .btn-action-icon.view:hover {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-action-icon.edit:hover {
            background-color: #04308c;
            border-color: #04308c;
        }

        .btn-action-icon.delete:hover {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .rating-badge {
            background-color: #fffbeb;
            color: #b45309;
            font-weight: 600;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #fef3c7;
            display: inline-flex;
            align-items: center;
        }

        .badge-status-active {
            background-color: #dcfce7;
            color: #15803d;
            font-weight: 600;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            cursor: pointer;
            border: 1px solid #bbf7d0;
            transition: all 0.2s;
        }
        .badge-status-active:hover {
            background-color: #bbf7d0;
        }

        .badge-status-inactive {
            background-color: #fee2e2;
            color: #b91c1c;
            font-weight: 600;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            cursor: pointer;
            border: 1px solid #fecaca;
            transition: all 0.2s;
        }
        .badge-status-inactive:hover {
            background-color: #fecaca;
        }

        .badge-price-request {
            background-color: #fef3c7;
            color: #b45309;
            font-weight: 600;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #fde68a;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Unified with Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'productlist']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'PRODUCT LIST']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">

                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                        <i class="bx bx-check-circle fs-18"></i>
                        <div><?= $this->session->flashdata('success'); ?></div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                        <i class="bx bx-error-circle fs-18"></i>
                        <div><?= $this->session->flashdata('error'); ?></div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Metrics Summary Cards -->
                <div class="row g-3 mb-3">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted fs-13 mb-1 fw-medium">Total Fixtures</p>
                                    <h4 class="mb-0 fw-bold text-dark"><?= $metrics['total'] ?? count($products); ?></h4>
                                </div>
                                <div class="avatar-md bg-light-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(4, 48, 140, 0.1);">
                                    <i class="bx bx-box fs-22" style="color: #04308c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted fs-13 mb-1 fw-medium">Active in Catalog</p>
                                    <h4 class="mb-0 fw-bold text-success"><?= $metrics['active'] ?? 0; ?></h4>
                                </div>
                                <div class="avatar-md bg-light-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.1);">
                                    <i class="bx bx-check-double fs-22 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted fs-13 mb-1 fw-medium">Well Stocked (>100)</p>
                                    <h4 class="mb-0 fw-bold text-primary"><?= $metrics['in_stock'] ?? 0; ?></h4>
                                </div>
                                <div class="avatar-md bg-light-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(59, 130, 246, 0.1);">
                                    <i class="bx bx-archive fs-22 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted fs-13 mb-1 fw-medium">Categories Active</p>
                                    <h4 class="mb-0 fw-bold text-dark"><?= $metrics['categories_count'] ?? count($all_categories); ?></h4>
                                </div>
                                <div class="avatar-md bg-light-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.1);">
                                    <i class="bx bx-category fs-22 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-3">
                            <!-- Card Header -->
                            <div class="card-header d-flex justify-content-between align-items-center gap-2 py-3 px-3 flex-wrap">
                                <div>
                                    <h4 class="card-title mb-0 fs-16 fw-bold">All Products Catalog</h4>
                                    <p class="text-muted fs-12 mb-0">Manage architectural lighting fixtures, pricing, specifications, and inventory</p>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <!-- Search Input -->
                                    <div class="position-relative">
                                        <input type="text" id="tableSearch" class="form-control form-control-sm ps-4" placeholder="Search fixture or SKU..." style="min-width: 220px;" onkeyup="filterTable()">
                                        <i class="bx bx-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted fs-15"></i>
                                    </div>

                                    <!-- Category Filter Select -->
                                    <select class="form-select form-select-sm" id="categoryFilter" style="width: auto;" onchange="filterCategory(this.value)">
                                        <option value="">All Categories</option>
                                        <?php foreach ($all_categories as $cat): ?>
                                            <option value="<?= htmlspecialchars($cat); ?>" <?= ($active_filter['category'] ?? '') === $cat ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($cat); ?> (<?= $category_counts[$cat] ?? 0; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Add Product Button -->
                                    <a href="<?= base_url('admin/productadd'); ?>" class="btn-Teknolite-add">
                                        <i class="bx bx-plus fs-16"></i> Add Product
                                    </a>
                                </div>
                            </div>

                            <!-- Table Responsive Area -->
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered table-nowrap" id="productTable">
                                    <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                        <tr>
                                            <th class="ps-3">Product &amp; SKU</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Badges</th>
                                            <th class="text-end pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        <?php if (!empty($products)): ?>
                                            <?php foreach ($products as $p): ?>
                                                <?php 
                                                    $pId = $p['id'];
                                                    $pName = $p['name'] ?? 'Untitled';
                                                    $pSku = $p['sku'] ?? 'N/A';
                                                    $pCat = $p['category'] ?? 'General';
                                                    $pSubcat = $p['subcategory'] ?? '';
                                                    $pPrice = $p['price'] ?? 0;
                                                    $isPriceReq = !empty($p['price_on_request']);
                                                    $pStock = $p['stock'] ?? 0;
                                                    $pStatus = $p['status'] ?? 'active';
                                                    $isFeatured = !empty($p['is_featured']);
                                                    $isBestseller = !empty($p['is_bestseller']);
                                                    
                                                    // Image path handling
                                                    $img = $p['featured_image'] ?? 'assets/images/products/gamma.png';
                                                    $imgSrc = (strpos($img, 'http') === 0) ? $img : base_url($img);
                                                    
                                                    // Specs summary
                                                    $wattages = !empty($p['specifications']['wattage']) ? implode(', ', array_slice($p['specifications']['wattage'], 0, 3)) : '';
                                                ?>
                                                <tr data-name="<?= strtolower(htmlspecialchars($pName . ' ' . $pSku)); ?>" data-category="<?= htmlspecialchars($pCat); ?>" id="product-row-<?= $pId; ?>">
                                                    <td class="ps-3">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="Teknolite-product-avatar">
                                                                <img src="<?= $imgSrc; ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/gamma.png'); ?>';" alt="<?= htmlspecialchars($pName); ?>">
                                                            </div>
                                                            <div>
                                                                <a href="<?= base_url('admin/productlistdetail/' . $pId); ?>" class="text-dark fw-semibold fs-14 text-decoration-none">
                                                                    <?= htmlspecialchars($pName); ?>
                                                                </a>
                                                                <p class="text-muted mb-0 mt-1 fs-12">
                                                                    <span class="text-dark fw-medium">SKU:</span> <?= htmlspecialchars($pSku); ?>
                                                                    <?php if ($wattages): ?>
                                                                        &bull; <span class="text-muted"><?= htmlspecialchars($wattages); ?></span>
                                                                    <?php endif; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark border fs-12 fw-medium">
                                                            <?= htmlspecialchars($pCat); ?>
                                                        </span>
                                                        <?php if ($pSubcat): ?>
                                                            <p class="text-muted fs-11 mb-0 mt-1"><?= htmlspecialchars($pSubcat); ?></p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($isPriceReq): ?>
                                                            <span class="badge-price-request">
                                                                <i class="bx bx-envelope me-1"></i> Price on Request
                                                            </span>
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-baseline gap-1">
                                                                <span class="fw-bold text-dark fs-14">&#8377;<?= number_format($pPrice, 2); ?></span>
                                                                <?php if (!empty($p['regular_price']) && $p['regular_price'] > $pPrice): ?>
                                                                    <del class="text-muted fs-12">&#8377;<?= number_format($p['regular_price'], 2); ?></del>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <p class="mb-1 text-dark fw-medium fs-13">
                                                            <?= number_format($pStock); ?> units
                                                        </p>
                                                        <?php if ($pStock > 100): ?>
                                                            <small class="text-success fs-11"><i class="bx bx-check-circle"></i> In Stock</small>
                                                        <?php else: ?>
                                                            <small class="text-warning fs-11"><i class="bx bx-time"></i> Low Stock</small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="<?= ($pStatus === 'active') ? 'badge-status-active' : 'badge-status-inactive'; ?>" 
                                                              title="Click to toggle status"
                                                              onclick="toggleProductStatus('<?= $pId; ?>', this)">
                                                            <?= ucfirst($pStatus); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column gap-1">
                                                            <?php if ($isFeatured): ?>
                                                                <span class="badge bg-primary text-white fs-11" style="width: fit-content; background-color: #04308c !important;">
                                                                    <i class="bx bxs-star me-1"></i> Featured
                                                                </span>
                                                            <?php endif; ?>
                                                            <?php if ($isBestseller): ?>
                                                                <span class="badge bg-warning text-dark fs-11" style="width: fit-content;">
                                                                    <i class="bx bxs-flame me-1"></i> Best Seller
                                                                </span>
                                                            <?php endif; ?>
                                                            <?php if (!$isFeatured && !$isBestseller): ?>
                                                                <span class="text-muted fs-12">-</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-3">
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <a href="<?= base_url('admin/productlistdetail/' . $pId); ?>" class="btn-action-icon view" title="View Details">
                                                                <iconify-icon icon="solar:eye-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <a href="<?= base_url('admin/productedit/' . $pId); ?>" class="btn-action-icon edit" title="Edit Product">
                                                                <iconify-icon icon="solar:pen-2-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn-action-icon delete" title="Delete Product" onclick="confirmDelete('<?= $pId; ?>', '<?= addslashes(htmlspecialchars($pName)); ?>')">
                                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <div class="text-muted">
                                                        <i class="bx bx-package fs-48 mb-2 text-muted"></i>
                                                        <h5 class="fw-bold">No Products Found</h5>
                                                        <p class="fs-13">Try clearing search filters or add a new architectural lighting fixture.</p>
                                                        <a href="<?= base_url('admin/productadd'); ?>" class="btn btn-sm btn-primary" style="background-color: #04308c; border-color: #04308c;">
                                                            Add New Product
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer bg-white border-top py-3 px-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <span class="text-muted fs-13" id="tableCountText">
                                    Showing <?= count($products); ?> architectural lighting fixtures
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="<?= base_url('product'); ?>" target="_blank" class="btn btn-sm btn-outline-secondary fs-13">
                                        <i class="bx bx-globe me-1"></i> View Website Storefront
                                    </a>
                                </div>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center p-3">
                <div class="modal-body">
                    <div class="avatar-lg bg-danger-subtle rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.1);">
                        <i class="bx bx-trash fs-28 text-danger"></i>
                    </div>
                    <h5 class="fw-bold fs-16 mb-1">Delete Product?</h5>
                    <p class="text-muted fs-13 mb-3">
                        Are you sure you want to delete <strong id="deleteProductName"></strong>? This action cannot be undone.
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light fs-13 fw-semibold px-3" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger fs-13 fw-semibold px-3">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Master Admin JS -->
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>

    <script>
        function filterTable() {
            const query = document.getElementById('tableSearch').value.toLowerCase().trim();
            const rows = document.querySelectorAll('#productTableBody tr');
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                if (!query || name.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('tableCountText').textContent = 'Showing ' + visibleCount + ' architectural lighting fixtures';
        }

        function filterCategory(cat) {
            const rows = document.querySelectorAll('#productTableBody tr');
            let visibleCount = 0;

            rows.forEach(row => {
                const itemCat = row.getAttribute('data-category') || '';
                if (!cat || itemCat === cat) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('tableCountText').textContent = 'Showing ' + visibleCount + ' architectural lighting fixtures';
        }

        function confirmDelete(id, name) {
            document.getElementById('deleteProductName').textContent = name;
            document.getElementById('confirmDeleteBtn').href = '<?= base_url("admin/productdelete/"); ?>' + id;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        function toggleProductStatus(id, badge) {
            fetch('<?= base_url("admin/productstatus/"); ?>' + id, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.status === 'active') {
                        badge.className = 'badge-status-active';
                        badge.textContent = 'Active';
                    } else {
                        badge.className = 'badge-status-inactive';
                        badge.textContent = 'Inactive';
                    }
                }
            })
            .catch(err => console.error('Status toggle failed:', err));
        }
    </script>
</body>
</html>
