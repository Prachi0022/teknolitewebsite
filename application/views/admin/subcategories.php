<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Subcategories List | Teknolite Admin'; ?></title>

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

        .metric-card {
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
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
            padding: 0;
        }

        .btn-action-icon:hover {
            color: #ffffff;
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
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'subcategories']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'SUBCATEGORIES LIST']); ?>

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

                <!-- Overview Metric Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card metric-card border-0 shadow-sm">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted fs-12 fw-semibold d-block text-uppercase">Total Subcategories</span>
                                    <h3 class="mb-0 fs-22 fw-bold text-dark mt-1"><?= (int)($all_count ?? 0); ?></h3>
                                </div>
                                <div class="avatar-md bg-primary-subtle text-primary rounded d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: #eff6ff; color: #2563eb;">
                                    <i class="bx bx-git-branch fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card metric-card border-0 shadow-sm">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted fs-12 fw-semibold d-block text-uppercase">Active Subcategories</span>
                                    <h3 class="mb-0 fs-22 fw-bold text-success mt-1"><?= (int)($active_count ?? 0); ?></h3>
                                </div>
                                <div class="avatar-md bg-success-subtle text-success rounded d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: #f0fdf4; color: #16a34a;">
                                    <i class="bx bx-check-shield fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card metric-card border-0 shadow-sm">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted fs-12 fw-semibold d-block text-uppercase">Parent Categories</span>
                                    <h3 class="mb-0 fs-22 fw-bold text-dark mt-1"><?= count($all_categories ?? []); ?></h3>
                                </div>
                                <div class="avatar-md bg-warning-subtle text-warning rounded d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: #fef3c7; color: #d97706;">
                                    <i class="bx bx-folder fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card metric-card border-0 shadow-sm">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted fs-12 fw-semibold d-block text-uppercase">Quick Action</span>
                                    <a href="<?= base_url('admin/subcategoryadd'); ?>" class="btn btn-sm btn-primary mt-1 fw-semibold" style="background-color: #04308c; border-color: #04308c;">
                                        <i class="bx bx-plus me-1"></i> Add Subcategory
                                    </a>
                                </div>
                                <div class="avatar-md bg-secondary-subtle text-secondary rounded d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: #f1f5f9; color: #475569;">
                                    <i class="bx bx-category fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subcategories List Table Card -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-3 border-0 shadow-sm">
                            <!-- Card Header with Filters -->
                            <div class="card-header d-flex justify-content-between align-items-center gap-2 py-3 px-3 flex-wrap bg-transparent border-bottom">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h4 class="card-title mb-0 fs-16 fw-bold text-dark">All Subcategories List</h4>
                                    <span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">
                                        <?= (int)($total_items ?? count($subcategories ?? [])); ?> Total
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <!-- Search & Filter Form -->
                                    <form method="get" action="<?= base_url('admin/subcategories'); ?>" class="d-flex align-items-center gap-2 flex-wrap" id="filterForm">
                                        <!-- Parent Category Filter -->
                                        <select name="category" class="form-select form-select-sm" style="min-width: 170px;" onchange="document.getElementById('filterForm').submit();">
                                            <option value="all">All Categories</option>
                                            <?php if (!empty($all_categories)): ?>
                                                <?php foreach ($all_categories as $parentCat): ?>
                                                    <option value="<?= htmlspecialchars($parentCat['id']); ?>" <?= (($selected_category ?? '') === $parentCat['id']) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($parentCat['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>

                                        <!-- Search input -->
                                        <div class="input-group input-group-sm" style="max-width: 220px;">
                                            <input type="text" name="search" class="form-control" placeholder="Search subcategory..." value="<?= htmlspecialchars($search ?? ''); ?>">
                                            <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                        <?php if (!empty($search) || (!empty($selected_category) && $selected_category !== 'all')): ?>
                                            <a href="<?= base_url('admin/subcategories'); ?>" class="btn btn-sm btn-outline-danger" title="Clear Filters"><i class="bx bx-x"></i></a>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>

                            <!-- Table Area -->
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered table-nowrap" id="subcategoriesTable">
                                    <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="checkAllSubcategories">
                                                    <label class="form-check-label" for="checkAllSubcategories"></label>
                                                </div>
                                            </th>
                                            <th>Subcategory</th>
                                            <th>Parent Category</th>
                                            <th>Tag ID</th>
                                            <th>Display Order</th>
                                            <th>Product Count</th>
                                            <th>Status</th>
                                            <th class="text-end pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($subcategories)): ?>
                                            <?php foreach ($subcategories as $sub): 
                                                $isActive = (($sub['status'] ?? 'active') === 'active');
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check ms-1">
                                                            <input type="checkbox" class="form-check-input subcategory-check" value="<?= htmlspecialchars($sub['id']); ?>">
                                                            <label class="form-check-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h6 class="fs-14 fw-bold mb-0">
                                                                <a href="<?= base_url('admin/subcategoryedit/' . $sub['id']); ?>" class="text-dark text-decoration-none">
                                                                    <?= htmlspecialchars($sub['name']); ?>
                                                                </a>
                                                            </h6>
                                                            <small class="text-muted fs-12">
                                                                <?= !empty($sub['description']) ? htmlspecialchars(mb_strimwidth($sub['description'], 0, 50, '...')) : 'Architectural subcategory mounting'; ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-12 border">
                                                            <i class="bx bx-folder-open me-1"></i><?= htmlspecialchars($sub['category_name'] ?? 'Category'); ?>
                                                        </span>
                                                    </td>
                                                    <td class="fs-13 text-muted">
                                                        <?= htmlspecialchars($sub['tag_id'] ?? ('#SUB-' . substr($sub['id'], 0, 5))); ?>
                                                    </td>
                                                    <td class="fs-13 fw-semibold">
                                                        <span class="badge bg-light text-dark border px-2 py-1">
                                                            #<?= (int)($sub['display_order'] ?? 1); ?>
                                                        </span>
                                                    </td>
                                                    <td class="fs-13">
                                                        <span class="badge bg-light text-dark border">
                                                            <?= (int)($sub['product_count'] ?? 0); ?> fixtures
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/subcategorystatus/' . $sub['id']); ?>" 
                                                           class="badge status-toggle-pill px-2 py-1 fs-12 <?= $isActive ? 'bg-success text-white' : 'bg-secondary text-white'; ?>"
                                                           data-id="<?= $sub['id']; ?>"
                                                           title="Click to toggle Active/Inactive">
                                                            <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i>
                                                            <span class="status-text"><?= ucfirst($sub['status'] ?? 'active'); ?></span>
                                                        </a>
                                                    </td>
                                                    <td class="text-end pe-3">
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <a href="<?= base_url('admin/subcategoryedit/' . $sub['id']); ?>" class="btn-action-icon edit" title="Edit Subcategory">
                                                                <iconify-icon icon="solar:pen-2-broken" class="fs-18"></iconify-icon>
                                                            </a>
                                                            <button type="button" class="btn-action-icon delete btn-delete-sub" 
                                                                    data-id="<?= $sub['id']; ?>" 
                                                                    data-name="<?= htmlspecialchars($sub['name']); ?>" 
                                                                    title="Delete Subcategory">
                                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18"></iconify-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="bx bx-git-branch fs-36 text-muted mb-2 d-block"></i>
                                                    <h6 class="fw-bold mb-1">No subcategories found</h6>
                                                    <p class="fs-13 mb-3">No subcategories match your selected filter criteria.</p>
                                                    <a href="<?= base_url('admin/subcategoryadd'); ?>" class="btn btn-sm btn-primary" style="background-color: #04308c; border-color: #04308c;">
                                                        Add New Subcategory
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
                                $queryStr = '';
                                if (!empty($search)) $queryStr .= '&search=' . urlencode($search);
                                if (!empty($selected_category) && $selected_category !== 'all') $queryStr .= '&category=' . urlencode($selected_category);
                            ?>
                            <div class="card-footer d-flex justify-content-between align-items-center py-3 px-3 bg-transparent border-top flex-wrap gap-2">
                                <div class="text-muted fs-13">
                                    Showing <strong class="text-dark"><?= count($subcategories ?? []); ?></strong> of <strong class="text-dark"><?= (int)($total_items ?? 0); ?></strong> subcategories
                                </div>
                                <?php if ($totalPages > 1): ?>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item <?= ($currPage <= 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/subcategories?page=' . ($currPage - 1) . $queryStr); ?>">Previous</a>
                                            </li>
                                            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                                <li class="page-item <?= ($currPage == $p) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="<?= base_url('admin/subcategories?page=' . $p . $queryStr); ?>"><?= $p; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= ($currPage >= $totalPages) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/subcategories?page=' . ($currPage + 1) . $queryStr); ?>">Next</a>
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
                    2026 &copy; Teknolite. Crafted by <span class="text-danger">&#10084;</span> <strong class="text-dark">Techzaa</strong>
                </div>
            </footer>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSubcategoryModal" tabindex="-1" aria-labelledby="deleteSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center p-3">
                <div class="modal-body p-3">
                    <div class="avatar-lg bg-danger-subtle text-danger rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background-color: #fee2e2;">
                        <i class="bx bx-trash fs-28"></i>
                    </div>
                    <h5 class="fs-16 fw-bold mb-2">Delete Subcategory?</h5>
                    <p class="text-muted fs-13 mb-3">
                        Are you sure you want to delete <strong id="deleteSubName" class="text-dark">this subcategory</strong>? This action cannot be undone.
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light btn-sm px-3 fw-medium" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteSubBtn" class="btn btn-danger btn-sm px-3 fw-medium">Yes, Delete</a>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Master Checkbox Select All
        const checkAll = document.getElementById('checkAllSubcategories');
        const itemChecks = document.querySelectorAll('.subcategory-check');

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                itemChecks.forEach(cb => cb.checked = this.checked);
            });
        }

        // Delete Confirmation Modal Handling
        const deleteModalEl = document.getElementById('deleteSubcategoryModal');
        const deleteModal = deleteModalEl ? new bootstrap.Modal(deleteModalEl) : null;
        const deleteSubName = document.getElementById('deleteSubName');
        const confirmDeleteSubBtn = document.getElementById('confirmDeleteSubBtn');

        document.querySelectorAll('.btn-delete-sub').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const name = this.dataset.name;

                if (deleteSubName) deleteSubName.textContent = '"' + name + '"';
                if (confirmDeleteSubBtn) confirmDeleteSubBtn.href = "<?= base_url('admin/subcategorydelete/'); ?>" + id;

                if (deleteModal) deleteModal.show();
            });
        });

        // AJAX Status Toggle Pill
        document.querySelectorAll('.status-toggle-pill').forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const url = "<?= base_url('admin/subcategorystatus/'); ?>" + id;
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
                    window.location.href = url;
                });
            });
        });
    });
    </script>
</body>
</html>
