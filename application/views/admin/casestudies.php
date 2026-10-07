<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Case Studies CMS | Teknolite Admin'; ?></title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Iconify CDN -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

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
        .fs-20 { font-size: 20px !important; }
        .fs-28 { font-size: 28px !important; }

        .stat-card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 10px;
        }
        .stat-card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .cs-thumb {
            width: 60px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
        }

        .status-toggle-pill {
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .status-toggle-pill:hover {
            opacity: 0.85;
            transform: scale(1.03);
        }
    </style>
<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Sidebar -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'casestudies']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Top Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CASE STUDIES CMS']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <div class="container-fluid">

                <!-- Alert Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                        <i class="bx bx-check-circle fs-20 me-2"></i>
                        <div><?= $this->session->flashdata('success'); ?></div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                        <i class="bx bx-error-circle fs-20 me-2"></i>
                        <div><?= $this->session->flashdata('error'); ?></div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Page Header Title & Breadcrumb -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Case Studies CMS</h4>
                        <p class="text-muted mb-0 fs-14">Create, edit, and publish dynamic architectural case studies and project portfolios for the website.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('casestudy'); ?>" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bx bx-link-external fs-16"></i>
                            <span>View On Website</span>
                        </a>
                        <a href="<?= base_url('admin/casestudyadd'); ?>" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="bx bx-plus fs-18"></i>
                            <span>Add Case Study</span>
                        </a>
                    </div>
                </div>

                <!-- 4 KPI Stat Cards -->
                <div class="row g-3 mb-4">
                    <!-- Total Case Studies -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fw-semibold fs-13 text-uppercase">Total Projects</span>
                                        <h3 class="fw-bold my-1 text-dark"><?= $stats['total'] ?? 0; ?></h3>
                                        <span class="text-muted fs-12">All registered case studies</span>
                                    </div>
                                    <div class="rounded bg-primary-subtle p-3 text-primary d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:documents-minimalistic-bold-duotone" class="fs-28"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Published -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fw-semibold fs-13 text-uppercase">Active / Live</span>
                                        <h3 class="fw-bold my-1 text-success"><?= $stats['active'] ?? 0; ?></h3>
                                        <span class="text-success fs-12 fw-medium"><i class="bx bx-check"></i> Published on website</span>
                                    </div>
                                    <div class="rounded bg-success-subtle p-3 text-success d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-28"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive / Drafts -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fw-semibold fs-13 text-uppercase">Inactive / Draft</span>
                                        <h3 class="fw-bold my-1 text-warning"><?= $stats['inactive'] ?? 0; ?></h3>
                                        <span class="text-muted fs-12">Hidden from frontend</span>
                                    </div>
                                    <div class="rounded bg-warning-subtle p-3 text-warning d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:eye-closed-bold-duotone" class="fs-28"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Industries Covered -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fw-semibold fs-13 text-uppercase">Industries</span>
                                        <h3 class="fw-bold my-1 text-info"><?= $stats['industries_count'] ?? 0; ?></h3>
                                        <span class="text-muted fs-12">Sectors & applications</span>
                                    </div>
                                    <div class="rounded bg-info-subtle p-3 text-info d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:buildings-bold-duotone" class="fs-28"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Data Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="row g-3 align-items-center">
                            <!-- Left: Status Filter Pills -->
                            <div class="col-md-5">
                                <div class="btn-group" role="group">
                                    <a href="<?= base_url('admin/casestudies' . ($search ? '?search=' . urlencode($search) : '')); ?>" 
                                       class="btn btn-sm <?= (empty($status) || $status === 'all') ? 'btn-primary' : 'btn-outline-secondary'; ?>">
                                        All (<?= $stats['total']; ?>)
                                    </a>
                                    <a href="<?= base_url('admin/casestudies?status=active' . ($search ? '&search=' . urlencode($search) : '') . ($industry ? '&industry=' . urlencode($industry) : '')); ?>" 
                                       class="btn btn-sm <?= ($status === 'active') ? 'btn-success text-white' : 'btn-outline-secondary'; ?>">
                                        Active (<?= $stats['active']; ?>)
                                    </a>
                                    <a href="<?= base_url('admin/casestudies?status=inactive' . ($search ? '&search=' . urlencode($search) : '') . ($industry ? '&industry=' . urlencode($industry) : '')); ?>" 
                                       class="btn btn-sm <?= ($status === 'inactive') ? 'btn-warning text-dark' : 'btn-outline-secondary'; ?>">
                                        Inactive (<?= $stats['inactive']; ?>)
                                    </a>
                                </div>
                            </div>

                            <!-- Right: Industry Filter & Search Form -->
                            <div class="col-md-7">
                                <form method="GET" action="<?= base_url('admin/casestudies'); ?>" class="d-flex gap-2 justify-content-md-end">
                                    <?php if ($status): ?>
                                        <input type="hidden" name="status" value="<?= html_escape($status); ?>">
                                    <?php endif; ?>

                                    <!-- Industry select -->
                                    <select name="industry" class="form-select form-select-sm" style="max-width: 170px;" onchange="this.form.submit()">
                                        <option value="">All Industries</option>
                                        <?php foreach ($industries as $ind): ?>
                                            <option value="<?= html_escape($ind); ?>" <?= ($industry === $ind) ? 'selected' : ''; ?>>
                                                <?= html_escape($ind); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Search input -->
                                    <div class="input-group input-group-sm" style="max-width: 250px;">
                                        <input type="text" name="search" class="form-control" placeholder="Search case study..." value="<?= html_escape($search); ?>">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bx bx-search"></i>
                                        </button>
                                        <?php if (!empty($search) || !empty($status) || !empty($industry)): ?>
                                            <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-outline-danger" title="Clear filters">
                                                <i class="bx bx-x"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light fs-13 text-uppercase text-muted">
                                <tr>
                                    <th style="width: 75px;">Image</th>
                                    <th>Case Study & Client</th>
                                    <th>Industry</th>
                                    <th>Location</th>
                                    <th>SEO Slug</th>
                                    <th>Status</th>
                                    <th class="text-end" style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($items)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bx bx-folder-open fs-28 d-block mb-2 text-secondary"></i>
                                                <h6 class="fw-semibold mb-1">No case studies found</h6>
                                                <p class="fs-13 mb-3">Try adjusting your search criteria or add a new case study.</p>
                                                <a href="<?= base_url('admin/casestudyadd'); ?>" class="btn btn-primary btn-sm">
                                                    <i class="bx bx-plus me-1"></i> Add Case Study
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($items as $cs): ?>
                                        <?php 
                                            $isActive = strtolower($cs['status'] ?? 'active') === 'active'; 
                                            $imgSrc = base_url($cs['featured_image'] ?? 'assets/images/project/project1.jpeg');
                                        ?>
                                        <tr>
                                            <!-- Featured Image Thumbnail -->
                                            <td>
                                                <img src="<?= $imgSrc; ?>" alt="<?= html_escape($cs['title'] ?? ''); ?>" class="cs-thumb" onerror="this.src='<?= base_url('assets/images/project/project1.jpeg'); ?>'">
                                            </td>

                                            <!-- Title & Client -->
                                            <td>
                                                <div class="fw-bold text-dark fs-14">
                                                    <a href="<?= base_url('admin/casestudyedit/' . $cs['id']); ?>" class="text-dark text-decoration-none">
                                                        <?= html_escape($cs['title'] ?? 'Untitled'); ?>
                                                    </a>
                                                </div>
                                                <div class="fs-12 text-muted d-flex align-items-center gap-1">
                                                    <i class="bx bx-user text-primary"></i>
                                                    <span><?= html_escape($cs['client'] ?? 'TeknoLite Project'); ?></span>
                                                    <span class="badge bg-light text-secondary border ms-1 fs-11"><?= html_escape($cs['id']); ?></span>
                                                </div>
                                            </td>

                                            <!-- Industry Badge -->
                                            <td>
                                                <?php 
                                                    $ind = $cs['industry'] ?? 'General';
                                                    $badgeClass = 'bg-primary-subtle text-primary border-primary-subtle';
                                                    if (stripos($ind, 'residential') !== false) $badgeClass = 'bg-info-subtle text-info border-info-subtle';
                                                    elseif (stripos($ind, 'commercial') !== false) $badgeClass = 'bg-primary-subtle text-primary border-primary-subtle';
                                                    elseif (stripos($ind, 'hospitality') !== false) $badgeClass = 'bg-warning-subtle text-warning border-warning-subtle';
                                                    elseif (stripos($ind, 'retail') !== false) $badgeClass = 'bg-danger-subtle text-danger border-danger-subtle';
                                                ?>
                                                <span class="badge <?= $badgeClass; ?> border py-1 px-2 fs-12">
                                                    <?= html_escape($ind); ?>
                                                </span>
                                            </td>

                                            <!-- Location -->
                                            <td>
                                                <div class="fs-13 text-secondary d-flex align-items-center gap-1">
                                                    <i class="bx bx-map-pin text-danger fs-14"></i>
                                                    <span><?= html_escape($cs['location'] ?? 'India'); ?></span>
                                                </div>
                                            </td>

                                            <!-- Slug -->
                                            <td>
                                                <code class="text-primary fs-12 bg-light px-2 py-1 rounded border">
                                                    /<?= html_escape($cs['slug'] ?? ''); ?>
                                                </code>
                                            </td>

                                            <!-- Status Toggle -->
                                            <td>
                                                <a href="<?= base_url('admin/casestudystatus/' . $cs['id']); ?>" 
                                                   class="badge rounded-pill <?= $isActive ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'; ?> status-toggle-pill border px-2 py-1 fs-12 text-decoration-none"
                                                   title="Click to toggle status">
                                                    <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-x-circle'; ?>"></i>
                                                    <?= $isActive ? 'Active' : 'Inactive'; ?>
                                                </a>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-1">
                                                    <!-- Live Preview on Frontend -->
                                                    <a href="<?= base_url('casestudydetail/' . ($cs['slug'] ?? '')); ?>" 
                                                       target="_blank" 
                                                       class="btn btn-sm btn-outline-info p-1 px-2" 
                                                       title="View on Website">
                                                        <i class="bx bx-show fs-16"></i>
                                                    </a>
                                                    <!-- Edit -->
                                                    <a href="<?= base_url('admin/casestudyedit/' . $cs['id']); ?>" 
                                                       class="btn btn-sm btn-outline-primary p-1 px-2" 
                                                       title="Edit Case Study">
                                                        <i class="bx bx-edit fs-16"></i>
                                                    </a>
                                                    <!-- Delete Modal Trigger -->
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger p-1 px-2 btn-delete-cs" 
                                                            data-id="<?= html_escape($cs['id']); ?>"
                                                            data-title="<?= html_escape($cs['title'] ?? ''); ?>"
                                                            title="Delete Case Study">
                                                        <i class="bx bx-trash fs-16"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Card Footer: Pagination & Count -->
                    <?php if (!empty($items)): ?>
                        <div class="card-footer bg-white border-top py-3">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div class="text-muted fs-13">
                                    Showing <span class="fw-semibold"><?= count($items); ?></span> of <span class="fw-semibold"><?= $total_items; ?></span> case studies
                                </div>
                                <?php if ($total_pages > 1): ?>
                                    <nav aria-label="Case Studies Pagination">
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous -->
                                            <li class="page-item <?= ($current_page_num <= 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/casestudies?page=' . ($current_page_num - 1) . ($search ? '&search=' . urlencode($search) : '') . ($status ? '&status=' . urlencode($status) : '') . ($industry ? '&industry=' . urlencode($industry) : '')); ?>">
                                                    <i class="bx bx-chevron-left"></i>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                                <li class="page-item <?= ($p == $current_page_num) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="<?= base_url('admin/casestudies?page=' . $p . ($search ? '&search=' . urlencode($search) : '') . ($status ? '&status=' . urlencode($status) : '') . ($industry ? '&industry=' . urlencode($industry) : '')); ?>">
                                                        <?= $p; ?>
                                                    </a>
                                                </li>
                                            <?php endfor; ?>

                                            <!-- Next -->
                                            <li class="page-item <?= ($current_page_num >= $total_pages) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= base_url('admin/casestudies?page=' . ($current_page_num + 1) . ($search ? '&search=' . urlencode($search) : '') . ($status ? '&status=' . urlencode($status) : '') . ($industry ? '&industry=' . urlencode($industry) : '')); ?>">
                                                    <i class="bx bx-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCsModal" tabindex="-1" aria-labelledby="deleteCsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom py-3">
                    <h5 class="modal-title text-danger d-flex align-items-center gap-2" id="deleteCsModalLabel">
                        <i class="bx bx-error-circle fs-20"></i> Delete Case Study
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="avatar-lg bg-danger-subtle text-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                        <i class="bx bx-trash fs-28"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Are you sure you want to delete this case study?</h5>
                    <p class="text-muted fs-14 mb-0">
                        "<strong id="deleteCsTitle"></strong>" will be permanently deleted from the database and will no longer appear on the website.
                    </p>
                </div>
                <div class="modal-footer border-top py-3 justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDeleteCsBtn" class="btn btn-danger">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteCsModal'));
            document.querySelectorAll('.btn-delete-cs').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    document.getElementById('deleteCsTitle').textContent = title;
                    document.getElementById('confirmDeleteCsBtn').href = '<?= base_url('admin/casestudydelete/'); ?>' + id;
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>
