<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Blog Preview | TeknoLite Admin'; ?></title>

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

        .article-preview-hero {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }

        .article-body {
            font-size: 15px;
            line-height: 1.8;
            color: #334155;
        }
        .article-body h2 {
            font-size: 22px;
            font-weight: 700;
            margin-top: 28px;
            margin-bottom: 12px;
            color: #0f172a;
        }
        .article-body h3 {
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #1e293b;
        }
        .article-body p {
            margin-bottom: 16px;
        }
        .article-body ul, .article-body ol {
            margin-bottom: 16px;
            padding-left: 24px;
        }
        .article-body li {
            margin-bottom: 8px;
        }
        .article-body blockquote {
            border-left: 4px solid #04308c;
            padding: 12px 18px;
            background: #f8fafc;
            margin: 20px 0;
            font-style: italic;
            border-radius: 0 8px 8px 0;
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
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'PREVIEW BLOG']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <div class="container-fluid">

                <!-- Page Header Title & Actions -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= base_url('admin/blogs'); ?>" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Back to Blogs">
                            <i class="bx bx-arrow-back fs-16"></i>
                        </a>
                        <div>
                            <h4 class="fw-bold mb-0">Article Preview</h4>
                            <span class="text-muted fs-13">ID #<?= $blog['id']; ?> &bull; Slug: <code><?= htmlspecialchars($blog['slug']); ?></code></span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('blog/' . $blog['slug']); ?>" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bx bx-link-external fs-16"></i>
                            <span>View Live on Site</span>
                        </a>
                        <a href="<?= base_url('admin/blogedit/' . $blog['id']); ?>" class="btn btn-primary d-flex align-items-center gap-1" style="background-color: #04308c; border-color: #04308c;">
                            <i class="bx bx-edit fs-16"></i>
                            <span>Edit Article</span>
                        </a>
                        <a href="<?= base_url('admin/blogdelete/' . $blog['id']); ?>" class="btn btn-outline-danger d-flex align-items-center gap-1" onclick="return confirm('Are you sure you want to delete this blog post?');">
                            <i class="bx bx-trash fs-16"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    
                    <!-- Left: Article Content -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm p-4">
                            
                            <!-- Badges & Meta Top -->
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary px-3 py-1 fs-13 fw-semibold">
                                    <?= htmlspecialchars($blog['category']); ?>
                                </span>
                                <?php if ($blog['status'] === 'active'): ?>
                                    <span class="badge bg-success-subtle text-success px-2 py-1 fs-12">
                                        <i class="bx bx-check-circle me-1"></i>Published
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-12">
                                        <i class="bx bx-hide me-1"></i>Draft
                                    </span>
                                <?php endif; ?>
                                <span class="text-muted fs-13 ms-auto">
                                    <i class="bx bx-time-five me-1"></i><?= $blog['read_time']; ?>
                                </span>
                            </div>

                            <!-- Title -->
                            <h2 class="fw-bold text-dark mb-3" style="font-size: 26px; line-height: 1.3;">
                                <?= htmlspecialchars($blog['title']); ?>
                            </h2>

                            <!-- Author & Date -->
                            <div class="d-flex align-items-center gap-3 text-muted fs-13 border-bottom pb-3 mb-4">
                                <span><i class="bx bx-user text-primary me-1"></i><?= htmlspecialchars($blog['author']); ?></span>
                                <span><i class="bx bx-calendar text-primary me-1"></i><?= $blog['formatted_date']; ?></span>
                                <span><i class="bx bx-show text-primary me-1"></i><?= number_format($blog['views']); ?> Views</span>
                            </div>

                            <!-- Featured Image -->
                            <div class="mb-4">
                                <img src="<?= $blog['image_url']; ?>" alt="<?= htmlspecialchars($blog['title']); ?>" class="article-preview-hero">
                            </div>

                            <!-- Short Description / Lead -->
                            <div class="p-3 bg-light rounded-3 mb-4 border-start border-4 border-primary">
                                <p class="mb-0 fw-medium text-dark fs-15 fst-italic">
                                    <?= nl2br(htmlspecialchars($blog['short_description'])); ?>
                                </p>
                            </div>

                            <!-- Full Content -->
                            <div class="article-body">
                                <?= $blog['content']; ?>
                            </div>

                        </div>
                    </div>

                    <!-- Right: Metadata & Info -->
                    <div class="col-lg-4">
                        
                        <!-- Metadata Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3">
                                <h5 class="card-title mb-0 fs-16 fw-semibold">Article Information</h5>
                            </div>
                            <div class="card-body p-3">
                                <table class="table table-borderless fs-13 mb-0">
                                    <tr>
                                        <td class="text-muted py-1" style="width: 110px;">Status:</td>
                                        <td class="py-1">
                                            <a href="<?= base_url('admin/blogstatus/' . $blog['id']); ?>" class="badge bg-<?= ($blog['status'] === 'active') ? 'success' : 'secondary'; ?>-subtle text-<?= ($blog['status'] === 'active') ? 'success' : 'secondary'; ?>">
                                                <?= ucfirst($blog['status']); ?> (Click to toggle)
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Category:</td>
                                        <td class="py-1 fw-semibold"><?= htmlspecialchars($blog['category']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Author:</td>
                                        <td class="py-1"><?= htmlspecialchars($blog['author']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Publish Date:</td>
                                        <td class="py-1"><?= $blog['formatted_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Total Views:</td>
                                        <td class="py-1 fw-semibold text-info"><?= number_format($blog['views']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Created At:</td>
                                        <td class="py-1 text-muted"><?= date('Y-m-d H:i', strtotime($blog['created_at'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Updated At:</td>
                                        <td class="py-1 text-muted"><?= date('Y-m-d H:i', strtotime($blog['updated_at'])); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- SEO Metadata Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3">
                                <h5 class="card-title mb-0 fs-16 fw-semibold">SEO Configuration</h5>
                            </div>
                            <div class="card-body p-3 fs-13">
                                <div class="mb-2">
                                    <strong class="d-block text-muted">Meta Title:</strong>
                                    <span><?= htmlspecialchars($blog['meta_title'] ?: 'Default: ' . $blog['title']); ?></span>
                                </div>
                                <div class="mb-2">
                                    <strong class="d-block text-muted">Meta Description:</strong>
                                    <span><?= htmlspecialchars($blog['meta_description'] ?: 'None set'); ?></span>
                                </div>
                                <div class="mb-0">
                                    <strong class="d-block text-muted">Meta Keywords:</strong>
                                    <span><?= htmlspecialchars($blog['meta_keywords'] ?: 'None set'); ?></span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

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
