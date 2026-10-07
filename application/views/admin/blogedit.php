<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Edit Blog Post | TeknoLite Admin'; ?></title>

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

        .upload-dropzone {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            background: #fbfbfb;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .upload-dropzone:hover {
            border-color: #04308c;
            background: #edf2fb;
        }

        .img-preview-box {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
        }

        .content-toolbar button {
            font-size: 12px;
            padding: 2px 8px;
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
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'EDIT BLOG POST']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <div class="container-fluid">

                <!-- Alert Messages -->
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                        <i class="bx bx-error-circle fs-20 me-2"></i>
                        <div><?= $this->session->flashdata('error'); ?></div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Page Header Title & Actions -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <a href="<?= base_url('admin/blogs'); ?>" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Back to Blogs">
                                <i class="bx bx-arrow-back fs-16"></i>
                            </a>
                            <h4 class="fw-bold mb-0">Edit Blog Article</h4>
                        </div>
                        <p class="text-muted mb-0 fs-14">Editing: <span class="text-primary fw-semibold"><?= htmlspecialchars($blog['title']); ?></span></p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('blog/' . $blog['slug']); ?>" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bx bx-link-external fs-16"></i>
                            <span>View on Website</span>
                        </a>
                        <a href="<?= base_url('admin/blogs'); ?>" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" form="blogForm" class="btn btn-primary d-flex align-items-center gap-1" style="background-color: #04308c; border-color: #04308c;">
                            <i class="bx bx-save fs-18"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>

                <!-- Form -->
                <form id="blogForm" action="<?= base_url('admin/blogedit/' . $blog['id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="row g-4">
                        
                        <!-- Left Column: Main Content -->
                        <div class="col-lg-8">
                            
                            <!-- Article Info Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h5 class="card-title mb-0 fs-16 fw-semibold">Article Content</h5>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label fs-13 fw-semibold">Article Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control form-control-lg fs-15" placeholder="e.g. How to Choose the Right LED Lighting for Your Space" required value="<?= htmlspecialchars(set_value('title', $blog['title'])); ?>">
                                    </div>

                                    <!-- Slug -->
                                    <div class="mb-3">
                                        <label for="slug" class="form-label fs-13 fw-semibold">URL Slug <span class="text-muted fw-normal">(Unique web address)</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text fs-13 text-muted"><?= base_url('blog/'); ?></span>
                                            <input type="text" name="slug" id="slug" class="form-control fs-13" value="<?= htmlspecialchars(set_value('slug', $blog['slug'])); ?>">
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label for="short_description" class="form-label fs-13 fw-semibold">Short Summary / Excerpt <span class="text-danger">*</span></label>
                                        <textarea name="short_description" id="short_description" rows="3" class="form-control fs-14" placeholder="Brief summary of the article displayed on the blog card and search listings..." required><?= htmlspecialchars(set_value('short_description', $blog['short_description'])); ?></textarea>
                                        <small class="text-muted fs-12">Recommended length: 120-180 characters.</small>
                                    </div>

                                    <!-- Full Article Content -->
                                    <div class="mb-0">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label for="content" class="form-label fs-13 fw-semibold mb-0">Full Article Content (HTML allowed) <span class="text-danger">*</span></label>
                                            <div class="btn-group btn-group-sm content-toolbar">
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<h2>', '</h2>')">H2</button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<h3>', '</h3>')">H3</button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<strong>', '</strong>')"><b>B</b></button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<em>', '</em>')"><i>I</i></button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<ul>\n  <li>', '</li>\n</ul>')">List</button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<p>', '</p>')">P</button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="insertTag('<blockquote>', '</blockquote>')">Quote</button>
                                            </div>
                                        </div>
                                        <textarea name="content" id="content" rows="16" class="form-control font-monospace fs-13" required><?= htmlspecialchars(set_value('content', $blog['content'])); ?></textarea>
                                        <small class="text-muted fs-12">Use HTML formatting for rich paragraphs, subheadings, bullet lists, and quotes.</small>
                                    </div>

                                </div>
                            </div>

                            <!-- SEO Meta Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h5 class="card-title mb-0 fs-16 fw-semibold">Search Engine Optimization (SEO)</h5>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label fs-13 fw-semibold">Meta Title</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control fs-14" placeholder="Page title tag for Google" value="<?= htmlspecialchars(set_value('meta_title', $blog['meta_title'])); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label fs-13 fw-semibold">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control fs-14" placeholder="led lighting guide, commercial lighting, colour temperature" value="<?= htmlspecialchars(set_value('meta_keywords', $blog['meta_keywords'])); ?>">
                                    </div>
                                    <div class="mb-0">
                                        <label for="meta_description" class="form-label fs-13 fw-semibold">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="2" class="form-control fs-14" placeholder="Snippet for search results..."><?= htmlspecialchars(set_value('meta_description', $blog['meta_description'])); ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column: Settings, Featured Image, Category -->
                        <div class="col-lg-4">
                            
                            <!-- Publishing Settings Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h5 class="card-title mb-0 fs-16 fw-semibold">Publish Settings</h5>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    
                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label fs-13 fw-semibold">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="active" <?= ($blog['status'] === 'active') ? 'selected' : ''; ?>>Published (Visible)</option>
                                            <option value="inactive" <?= ($blog['status'] === 'inactive') ? 'selected' : ''; ?>>Draft (Hidden)</option>
                                        </select>
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label fs-13 fw-semibold">Category <span class="text-danger">*</span></label>
                                        <input type="text" name="category" id="category" list="categoryList" class="form-control" placeholder="Select or type category..." required value="<?= htmlspecialchars(set_value('category', $blog['category'])); ?>">
                                        <datalist id="categoryList">
                                            <option value="Guides">
                                            <option value="Product Information">
                                            <option value="Industry Insights">
                                            <option value="Company News">
                                            <?php if (!empty($categories)): ?>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= htmlspecialchars($cat['category']); ?>">
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </datalist>
                                        <small class="text-muted fs-12">Select from list or type a new category name.</small>
                                    </div>

                                    <!-- Author -->
                                    <div class="mb-3">
                                        <label for="author" class="form-label fs-13 fw-semibold">Author</label>
                                        <input type="text" name="author" id="author" class="form-control" value="<?= htmlspecialchars(set_value('author', $blog['author'])); ?>">
                                    </div>

                                    <!-- Published Date -->
                                    <div class="mb-0">
                                        <label for="published_date" class="form-label fs-13 fw-semibold">Publish Date</label>
                                        <input type="date" name="published_date" id="published_date" class="form-control" value="<?= htmlspecialchars(set_value('published_date', $blog['published_date'])); ?>">
                                    </div>

                                </div>
                            </div>

                            <!-- Featured Image Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h5 class="card-title mb-0 fs-16 fw-semibold">Featured Image</h5>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    
                                    <!-- Image Preview -->
                                    <div class="mb-3">
                                        <img src="<?= $blog['image_url']; ?>" alt="Preview" id="imagePreview" class="img-preview-box">
                                    </div>

                                    <!-- Upload File -->
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold">Change Featured Image</label>
                                        <input type="file" name="featured_image" id="featuredImageInput" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted fs-12">Leave empty to keep existing image.</small>
                                    </div>

                                    <!-- Or Custom Image URL -->
                                    <div class="mb-0">
                                        <label for="image_url" class="form-label fs-13 fw-semibold">Or Image Asset Path / URL</label>
                                        <input type="text" name="image_url" id="image_url" class="form-control form-control-sm" value="<?= htmlspecialchars($blog['featured_image']); ?>">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                </div><!-- /container-fluid -->
            </main>

            <!-- Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>

    <script>
        // Instant image preview
        document.getElementById('featuredImageInput').addEventListener('change', function() {
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Insert HTML tag into content textarea
        function insertTag(openTag, closeTag) {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const text = textarea.value;
            const selected = text.substring(start, end);
            const replacement = openTag + selected + closeTag;
            textarea.value = text.substring(0, start) + replacement + text.substring(end);
            textarea.focus();
            textarea.selectionStart = start + openTag.length;
            textarea.selectionEnd = start + openTag.length + selected.length;
        }
    </script>
</body>
</html>
