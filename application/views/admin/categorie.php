<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Categories List | Teknolite Admin'; ?></title>

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
        .fs-12 { font-size: 12px !important; }
        .fs-13 { font-size: 13px !important; }
        .fs-14 { font-size: 14px !important; }
        .fs-15 { font-size: 15px !important; }
        .fs-16 { font-size: 16px !important; }
        .fs-18 { font-size: 18px !important; }

        /* Top 4 Category Cards */
        .category-overview-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 10px;
        }
        .category-overview-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .category-img-box {
            width: 100%;
            height: 135px;
            max-width: 220px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            padding: 10px;
            overflow: hidden;
        }

        .category-img-box img {
            max-width: 100%;
            max-height: 115px;
            object-fit: contain;
            display: block;
            transition: transform 0.25s ease;
        }

        .category-overview-card:hover .category-img-box img {
            transform: scale(1.05);
        }

        /* Avatar Box in Table */
        .avatar-category-box {
            width: 48px;
            height: 48px;
            min-width: 48px;
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

        [data-bs-theme="dark"] .avatar-category-box {
            background-color: #0f172a;
            border-color: #334155;
        }

        .avatar-category-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        /* Action Buttons */
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
            padding: 0;
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

        .pagination .page-item.active .page-link {
            background-color: #04308c;
            border-color: #04308c;
            color: #ffffff;
        }

        .status-toggle-pill {
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }
        .status-toggle-pill:hover {
            opacity: 0.85;
            transform: scale(1.03);
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Unified with Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'categorie']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CATEGORIES LIST']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">

                <!-- Flash Message Alerts -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
                        <i class="bx bx-check-circle fs-18 me-2"></i>
                        <div><?= $this->session->flashdata('success'); ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
                        <i class="bx bx-error-circle fs-18 me-2"></i>
                        <div><?= $this->session->flashdata('error'); ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- All Categories List Table Card -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-3 border-0 shadow-sm">
                            <!-- Card Header -->
                            <div class="card-header d-flex justify-content-between align-items-center gap-2 py-3 px-3 flex-wrap bg-transparent border-bottom">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <h4 class="card-title mb-0 fs-16 fw-bold text-dark">All Categories List</h4>
                                    <span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">
                                        <?= (int)($total_items ?? count($categories ?? [])); ?> Total
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <!-- Search Form -->
                                    <form method="get" action="<?= base_url('admin/categorie'); ?>" class="d-flex align-items-center gap-1">
                                        <div class="input-group input-group-sm" style="max-width: 220px;">
                                            <input type="text" name="search" class="form-control" placeholder="Search category..." value="<?= htmlspecialchars($search ?? ''); ?>">
                                            <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                        <?php if (!empty($search)): ?>
                                            <a href="<?= base_url('admin/categorie'); ?>" class="btn btn-sm btn-outline-danger" title="Clear search"><i class="bx bx-x"></i></a>
                                        <?php endif; ?>
                                    </form>

                                    <!-- Subcategories Button -->
                                    <a href="<?= base_url('admin/subcategories'); ?>" class="btn btn-sm btn-outline-secondary fw-semibold px-3">
                                        <i class="bx bx-git-branch me-1"></i> Subcategories
                                    </a>

                                    <!-- Add Category Button -->
                                    <a href="<?= base_url('admin/categoriesadd'); ?>" class="btn btn-sm btn-primary fw-semibold px-3" style="background-color: #04308c; border-color: #04308c;">
                                        <i class="bx bx-plus me-1"></i> Add Category
                                    </a>

                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light text-dark border" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px 12px; font-size: 13px;">
                                            This Month
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <a href="#!" class="dropdown-item fs-13"><i class="bx bx-download me-2 text-muted"></i>Download</a>
                                            <a href="#!" class="dropdown-item fs-13"><i class="bx bx-export me-2 text-muted"></i>Export</a>
                                            <a href="#!" class="dropdown-item fs-13"><i class="bx bx-import me-2 text-muted"></i>Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Area -->
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered table-nowrap" id="categoriesTable">
                                    <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="checkAllCategories">
                                                    <label class="form-check-label" for="checkAllCategories"></label>
                                                </div>
                                            </th>
                                            <th>Categories</th>
                                            <th>Starting Price</th>
                                            <th>Create by</th>
                                            <th>Tag ID</th>
                                            <th>Stock / Count</th>
                                            <th>Status</th>
                                            <th class="text-end pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $cat): 
                                                $imgSrc = !empty($cat['image']) ? base_url($cat['image']) : base_url('assets/images/products/gamma.png');
                                                $isActive = (($cat['status'] ?? 'active') === 'active');
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check ms-1">
                                                            <input type="checkbox" class="form-check-input category-check" value="<?= htmlspecialchars($cat['id']); ?>">
                                                            <label class="form-check-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="avatar-category-box">
                                                                <img src="<?= $imgSrc; ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/gamma.png'); ?>';" alt="<?= htmlspecialchars($cat['name']); ?>">
                                                            </div>
                                                            <div>
                                                                <h6 class="fs-14 fw-bold mb-0">
                                                                    <a href="<?= base_url('admin/categorieedit/' . $cat['id']); ?>" class="text-dark text-decoration-none">
                                                                        <?= htmlspecialchars($cat['name']); ?>
                                                                    </a>
                                                                </h6>
                                                                <small class="text-muted fs-12">
                                                                    <?= !empty($cat['short_description']) ? htmlspecialchars(mb_strimwidth($cat['short_description'], 0, 45, '...')) : 'Architectural lighting fixture'; ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fs-13 fw-semibold text-dark">
                                                        ₹<?= number_format($cat['starting_price'] ?? 1000); ?>
                                                    </td>
                                                    <td>
                                                        <?php if (($cat['created_by'] ?? 'Admin') === 'Admin'): ?>
                                                            <span class="badge bg-soft-primary text-primary px-2 py-1 fs-12" style="background-color: #eff6ff; color: #2563eb;">Admin</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-soft-success text-success px-2 py-1 fs-12" style="background-color: #f0fdf4; color: #16a34a;">Seller</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="fs-13 text-muted">
                                                        <?= htmlspecialchars($cat['tag_id'] ?? ('#CAT-' . substr($cat['id'], 0, 5))); ?>
                                                    </td>
                                                    <td class="fs-13">
                                                        <span class="fw-bold text-dark"><?= number_format($cat['stock'] ?? 100); ?></span>
                                                        <small class="text-muted">(<?= (int)($cat['product_count'] ?? 0); ?> items)</small>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/categorystatus/' . $cat['id']); ?>" 
                                                           class="badge status-toggle-pill px-2 py-1 fs-12 <?= $isActive ? 'bg-success text-white' : 'bg-secondary text-white'; ?>"
                                                           data-id="<?= $cat['id']; ?>"
                                                           title="Click to toggle Active/Inactive">
                                                            <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i>
                                                            <span class="status-text"><?= ucfirst($cat['status'] ?? 'active'); ?></span>
                                                        </a>
                                                    </td>
                                                    <td class="text-end pe-3">
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <a href="<?= base_url('admin/subcategories?category=' . urlencode($cat['id'])); ?>" class="btn-action-icon" title="View Subcategories" style="color: #6366f1;">
                                                                <iconify-icon icon="solar:diagram-up-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <a href="<?= base_url('product?category=' . ($cat['slug'] ?? $cat['id'])); ?>" target="_blank" class="btn-action-icon view" title="View on Website">
                                                                <iconify-icon icon="solar:eye-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <a href="<?= base_url('admin/categorieedit/' . $cat['id']); ?>" class="btn-action-icon edit" title="Edit Category">
                                                                <iconify-icon icon="solar:pen-2-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <button type="button" class="btn-action-icon delete btn-delete-cat" 
                                                                    data-id="<?= $cat['id']; ?>" 
                                                                    data-name="<?= htmlspecialchars($cat['name']); ?>" 
                                                                    title="Delete Category">
                                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18"></iconify-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="bx bx-folder-open fs-36 text-muted mb-2 d-block"></i>
                                                    <h6 class="fw-bold mb-1">No categories found</h6>
                                                    <p class="fs-13 mb-3">No categories match your search criteria.</p>
                                                    <a href="<?= base_url('admin/categoriesadd'); ?>" class="btn btn-sm btn-primary" style="background-color: #04308c; border-color: #04308c;">
                                                        Add New Category
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Card Footer: Pagination -->
                            <?php 
                                $totalPages = $total_pages ?? 1;
                                $currPage = $current_page_num ?? 1;
                            ?>
                            <div class="card-footer d-flex justify-content-between align-items-center py-3 px-3 bg-transparent border-top flex-wrap gap-2">
                                <div class="text-muted fs-13">
                                    Showing <strong class="text-dark"><?= count($categories ?? []); ?></strong> of <strong class="text-dark"><?= (int)($total_items ?? 0); ?></strong> categories
                                </div>
                                <?php if ($totalPages > 1): ?>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item <?= ($currPage <= 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/categorie?page=' . ($currPage - 1) . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>">Previous</a>
                                            </li>
                                            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                                <li class="page-item <?= ($currPage == $p) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="<?= base_url('admin/categorie?page=' . $p . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>"><?= $p; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= ($currPage >= $totalPages) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/categorie?page=' . ($currPage + 1) . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Teknolite Admin Footer -->
            <footer class="admin-footer text-center py-3 text-muted fs-13 border-top mt-auto">
                <div class="container-fluid">
                    2026 &copy; Teknolite. Crafted by <span class="text-danger">&#10084;</span> <strong class="text-dark">Nexmoves Solution</strong>
                </div>
            </footer>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center p-3">
                <div class="modal-body p-3">
                    <div class="avatar-lg bg-danger-subtle text-danger rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background-color: #fee2e2;">
                        <i class="bx bx-trash fs-28"></i>
                    </div>
                    <h5 class="fs-16 fw-bold mb-2">Delete Category?</h5>
                    <p class="text-muted fs-13 mb-3">
                        Are you sure you want to delete <strong id="deleteCatName" class="text-dark">this category</strong>? This action cannot be undone.
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light btn-sm px-3 fw-medium" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger btn-sm px-3 fw-medium">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Theme Settings Offcanvas Drawer -->
    <?php $this->load->view('admin/components/theme-settings'); ?>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Iconify Icons -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <!-- Category Table Interactive JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Master Checkbox Select All
        const checkAll = document.getElementById('checkAllCategories');
        const itemChecks = document.querySelectorAll('.category-check');

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                itemChecks.forEach(cb => cb.checked = this.checked);
            });
        }

        // Delete Confirmation Modal Handling
        const deleteModalEl = document.getElementById('deleteCategoryModal');
        const deleteModal = deleteModalEl ? new bootstrap.Modal(deleteModalEl) : null;
        const deleteCatName = document.getElementById('deleteCatName');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        document.querySelectorAll('.btn-delete-cat').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const name = this.dataset.name;

                if (deleteCatName) deleteCatName.textContent = '"' + name + '"';
                if (confirmDeleteBtn) confirmDeleteBtn.href = "<?= base_url('admin/categoriedelete/'); ?>" + id;

                if (deleteModal) deleteModal.show();
            });
        });

        // AJAX Status Toggle Pill
        document.querySelectorAll('.status-toggle-pill').forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const url = "<?= base_url('admin/categorystatus/'); ?>" + id;
                const self = this;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const isNowActive = (data.status === 'active');
                        self.className = 'badge status-toggle-pill px-2 py-1 fs-12 ' + (isNowActive ? 'bg-success text-white' : 'bg-secondary text-white');
                        const icon = self.querySelector('i');
                        if (icon) icon.className = 'bx ' + (isNowActive ? 'bx-check-circle' : 'bx-x-circle') + ' me-1';
                        const text = self.querySelector('.status-text');
                        if (text) text.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                    }
                })
                .catch(err => {
                    // Fallback to regular navigation
                    window.location.href = url;
                });
            });
        });
    });
    </script>
</body>
</html>
