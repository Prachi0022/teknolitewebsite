<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Blog Management | TeknoLite Admin'; ?></title>

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

        .blog-thumb {
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
</head>
<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Sidebar -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'blogs']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Top Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'BLOG CMS']); ?>

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
                        <h4 class="fw-bold mb-1">Blog Articles CMS</h4>
                        <p class="text-muted mb-0 fs-14">Create, edit, and publish dynamic articles, lighting guides, and industry insights for your website.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('blog'); ?>" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bx bx-link-external fs-16"></i>
                            <span>View Blog on Site</span>
                        </a>
                        <a href="<?= base_url('admin/blogadd'); ?>" class="btn btn-primary d-flex align-items-center gap-1" style="background-color: #04308c; border-color: #04308c;">
                            <i class="bx bx-plus fs-18"></i>
                            <span>Add New Blog</span>
                        </a>
                    </div>
                </div>

                <!-- 1. Statistics Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fs-13 text-uppercase fw-semibold">Total Articles</span>
                                        <h3 class="fw-bold my-1 fs-28"><?= number_format($stats['total'] ?? 0); ?></h3>
                                        <span class="text-muted fs-12">In database</span>
                                    </div>
                                    <div class="avatar avatar-lg rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bx bx-news fs-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fs-13 text-uppercase fw-semibold">Published</span>
                                        <h3 class="fw-bold my-1 text-success fs-28"><?= number_format($stats['active'] ?? 0); ?></h3>
                                        <span class="text-success fs-12"><i class="bx bx-check-double"></i> Live on website</span>
                                    </div>
                                    <div class="avatar avatar-lg rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bx bx-check-circle fs-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fs-13 text-uppercase fw-semibold">Draft / Inactive</span>
                                        <h3 class="fw-bold my-1 text-warning fs-28"><?= number_format($stats['inactive'] ?? 0); ?></h3>
                                        <span class="text-muted fs-12">Hidden from website</span>
                                    </div>
                                    <div class="avatar avatar-lg rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bx bx-hide fs-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm stat-card-hover">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-muted fs-13 text-uppercase fw-semibold">Total Views</span>
                                        <h3 class="fw-bold my-1 text-info fs-28"><?= number_format($stats['total_views'] ?? 0); ?></h3>
                                        <span class="text-muted fs-12">Article readers</span>
                                    </div>
                                    <div class="avatar avatar-lg rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bx bx-show fs-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Main Card: Filters & Data Table -->
                <div class="card border-0 shadow-sm">
                    <!-- Filters Header -->
                    <div class="card-header bg-transparent border-bottom py-3 px-3 px-md-4">
                        <form method="get" action="<?= base_url('admin/blogs'); ?>" class="row g-2 align-items-center">
                            <!-- Search -->
                            <div class="col-md-5 col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bx bx-search"></i></span>
                                    <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Search title, excerpt, content..." value="<?= htmlspecialchars($search); ?>">
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-3 col-lg-3">
                                <select name="category" class="form-select bg-light">
                                    <option value="all">All Categories</option>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= htmlspecialchars($cat['category_slug']); ?>" <?= ($category === $cat['category_slug'] || $category === $cat['category']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($cat['category']); ?> (<?= $cat['count']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-2 col-lg-2">
                                <select name="status" class="form-select bg-light">
                                    <option value="all" <?= ($status === '' || $status === 'all') ? 'selected' : ''; ?>>All Status</option>
                                    <option value="active" <?= ($status === 'active') ? 'selected' : ''; ?>>Published</option>
                                    <option value="inactive" <?= ($status === 'inactive') ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>

                            <!-- Submit & Reset -->
                            <div class="col-md-2 col-lg-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-3">Filter</button>
                                <?php if (!empty($search) || !empty($status) || !empty($category)): ?>
                                    <a href="<?= base_url('admin/blogs'); ?>" class="btn btn-light border px-2" title="Reset Filters"><i class="bx bx-reset"></i></a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Table of Articles -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light fs-13">
                                    <tr>
                                        <th style="width: 80px;" class="ps-3">Image</th>
                                        <th>Article Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Publish Date</th>
                                        <th>Views</th>
                                        <th>Status</th>
                                        <th style="width: 130px;" class="text-end pe-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <?php if (!empty($items)): ?>
                                        <?php foreach ($items as $item): ?>
                                            <tr>
                                                <!-- Image -->
                                                <td class="ps-3">
                                                    <a href="<?= base_url('admin/blogview/' . $item['id']); ?>">
                                                        <img src="<?= $item['image_url']; ?>" alt="<?= htmlspecialchars($item['title']); ?>" class="blog-thumb">
                                                    </a>
                                                </td>

                                                <!-- Title & Excerpt -->
                                                <td>
                                                    <a href="<?= base_url('admin/blogview/' . $item['id']); ?>" class="fw-semibold text-dark text-decoration-none d-block mb-1">
                                                        <?= htmlspecialchars($item['title']); ?>
                                                    </a>
                                                    <div class="text-muted fs-12 line-clamp-1" style="max-width: 380px;">
                                                        <?= htmlspecialchars(mb_strimwidth($item['short_description'], 0, 90, '...')); ?>
                                                    </div>
                                                </td>

                                                <!-- Category -->
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary fw-medium px-2 py-1">
                                                        <?= htmlspecialchars($item['category'] ?: 'Guides'); ?>
                                                    </span>
                                                </td>

                                                <!-- Author -->
                                                <td class="text-muted">
                                                    <i class="bx bx-user me-1"></i><?= htmlspecialchars($item['author'] ?: 'TeknoLite'); ?>
                                                </td>

                                                <!-- Published Date -->
                                                <td class="text-muted">
                                                    <i class="bx bx-calendar me-1"></i><?= htmlspecialchars($item['formatted_date_short']); ?>
                                                </td>

                                                <!-- Views -->
                                                <td>
                                                    <span class="text-muted"><i class="bx bx-show me-1"></i><?= number_format($item['views'] ?? 0); ?></span>
                                                </td>

                                                <!-- Status Toggle -->
                                                <td>
                                                    <a href="<?= base_url('admin/blogstatus/' . $item['id']); ?>" class="status-toggle-pill" title="Click to toggle status">
                                                        <?php if ($item['status'] === 'active'): ?>
                                                            <span class="badge bg-success-subtle text-success">
                                                                <i class="bx bxs-circle fs-8 me-1"></i>Published
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary-subtle text-secondary">
                                                                <i class="bx bxs-circle fs-8 me-1"></i>Draft
                                                            </span>
                                                        <?php endif; ?>
                                                    </a>
                                                </td>

                                                <!-- Actions -->
                                                <td class="text-end pe-3">
                                                    <div class="d-inline-flex gap-1">
                                                        <!-- View on Admin -->
                                                        <a href="<?= base_url('admin/blogview/' . $item['id']); ?>" class="btn btn-sm btn-light border px-2 py-1" title="Preview Article">
                                                            <i class="bx bx-show text-muted"></i>
                                                        </a>

                                                        <!-- View on Website -->
                                                        <a href="<?= base_url('blog/' . $item['slug']); ?>" target="_blank" class="btn btn-sm btn-light border px-2 py-1" title="Open on Website">
                                                            <i class="bx bx-link-external text-info"></i>
                                                        </a>

                                                        <!-- Edit -->
                                                        <a href="<?= base_url('admin/blogedit/' . $item['id']); ?>" class="btn btn-sm btn-light border px-2 py-1" title="Edit Article">
                                                            <i class="bx bx-edit text-primary"></i>
                                                        </a>

                                                        <!-- Delete -->
                                                        <a href="<?= base_url('admin/blogdelete/' . $item['id']); ?>" class="btn btn-sm btn-light border px-2 py-1 text-danger" title="Delete Article" onclick="return confirm('Are you sure you want to delete this blog post? This cannot be undone.');">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center py-5 text-muted">
                                                <div class="mb-3">
                                                    <i class="bx bx-news fs-40 text-secondary"></i>
                                                </div>
                                                <h5 class="fw-semibold">No Blog Articles Found</h5>
                                                <p class="text-muted fs-13 mb-3">Try adjusting your search criteria or create your first blog article.</p>
                                                <a href="<?= base_url('admin/blogadd'); ?>" class="btn btn-primary btn-sm px-3" style="background-color: #04308c; border-color: #04308c;">
                                                    <i class="bx bx-plus me-1"></i> Add New Blog
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Footer -->
                    <?php if ($total_pages > 1): ?>
                        <div class="card-footer bg-transparent border-top py-3 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <span class="text-muted fs-13">
                                Showing <?= count($items); ?> of <?= $total_items; ?> articles (Page <?= $current_page_num; ?> of <?= $total_pages; ?>)
                            </span>
                            <ul class="pagination pagination-sm mb-0">
                                <?php if ($current_page_num > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('admin/blogs?' . http_build_query(array_merge($_GET, ['page' => $current_page_num - 1]))); ?>">Previous</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                    <li class="page-item <?= ($p == $current_page_num) ? 'active' : ''; ?>">
                                        <a class="page-link" href="<?= base_url('admin/blogs?' . http_build_query(array_merge($_GET, ['page' => $p]))); ?>"><?= $p; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($current_page_num < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('admin/blogs?' . http_build_query(array_merge($_GET, ['page' => $current_page_num + 1]))); ?>">Next</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div><!-- /card -->

                </div><!-- /container-fluid -->
            </main>

            <!-- Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
</body>
</html>
