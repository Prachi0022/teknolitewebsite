<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Add New Case Study | Teknolite Admin'; ?></title>

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
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Sidebar -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'casestudyadd']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Top Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'ADD CASE STUDY']); ?>

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

                <!-- Page Header Title & Navigation -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Back to Case Studies">
                                <i class="bx bx-arrow-back fs-16"></i>
                            </a>
                            <h4 class="fw-bold mb-0">Create New Case Study</h4>
                        </div>
                        <p class="text-muted mb-0 fs-14">Add a new architectural project or client installation to the website portfolio.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" form="caseStudyForm" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="bx bx-save fs-18"></i>
                            <span>Save Case Study</span>
                        </button>
                    </div>
                </div>

                <!-- Form -->
                <form id="caseStudyForm" method="POST" action="<?= base_url('admin/casestudyadd'); ?>" enctype="multipart/form-data">
                    <div class="row g-4">

                        <!-- Left Column: Core Project Information -->
                        <div class="col-lg-8">

                            <!-- Project Details Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="card-title mb-0 d-flex align-items-center gap-2 text-dark">
                                        <iconify-icon icon="solar:document-text-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Project Information
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Case Study Title -->
                                    <div class="mb-3">
                                        <label for="titleInput" class="form-label fw-semibold fs-14">
                                            Case Study Title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title" id="titleInput" class="form-control" placeholder="e.g. Modern Luxury Residence Lighting" required value="<?= set_value('title'); ?>">
                                        <div class="form-text fs-12">The prominent title shown on project listing and case study banner.</div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <!-- Client / Project Name -->
                                        <div class="col-md-6">
                                            <label for="clientInput" class="form-label fw-semibold fs-14">
                                                Client / Project Name <span class="text-muted fw-normal">(Optional)</span>
                                            </label>
                                            <input type="text" name="client" id="clientInput" class="form-control" placeholder="e.g. The Horizon Villa / Apex Corp" value="<?= set_value('client'); ?>">
                                        </div>

                                        <!-- Industry -->
                                        <div class="col-md-6">
                                            <label for="industrySelect" class="form-label fw-semibold fs-14">
                                                Industry / Sector <span class="text-danger">*</span>
                                            </label>
                                            <select name="industry" id="industrySelect" class="form-select" required>
                                                <option value="Residential" <?= (set_value('industry') === 'Residential') ? 'selected' : ''; ?>>Residential</option>
                                                <option value="Commercial" <?= (set_value('industry') === 'Commercial') ? 'selected' : ''; ?>>Commercial / Corporate</option>
                                                <option value="Hospitality" <?= (set_value('industry') === 'Hospitality') ? 'selected' : ''; ?>>Hospitality & Resorts</option>
                                                <option value="Retail" <?= (set_value('industry') === 'Retail') ? 'selected' : ''; ?>>Retail & Boutiques</option>
                                                <option value="Architectural" <?= (set_value('industry') === 'Architectural') ? 'selected' : ''; ?>>Architectural / Monuments</option>
                                                <option value="Industrial" <?= (set_value('industry') === 'Industrial') ? 'selected' : ''; ?>>Industrial & Warehouses</option>
                                                <option value="Outdoor & Landscape" <?= (set_value('industry') === 'Outdoor & Landscape') ? 'selected' : ''; ?>>Outdoor & Landscape</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3">
                                        <label for="locationInput" class="form-label fw-semibold fs-14">
                                            Project Location <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="bx bx-map-pin text-danger"></i></span>
                                            <input type="text" name="location" id="locationInput" class="form-control" placeholder="e.g. South Mumbai, Maharashtra, India" required value="<?= set_value('location'); ?>">
                                        </div>
                                    </div>

                                    <!-- Solution -->
                                    <div class="mb-3">
                                        <label for="solutionInput" class="form-label fw-semibold fs-14">
                                            Lighting Solution Delivered <span class="text-muted fw-normal">(Optional)</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="bx bx-bulb text-warning"></i></span>
                                            <input type="text" name="solution" id="solutionInput" class="form-control" placeholder="e.g. Architectural LED Lighting" value="<?= set_value('solution', 'Architectural LED Lighting'); ?>">
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label for="shortDescInput" class="form-label fw-semibold fs-14">
                                            Short Description <span class="text-muted fw-normal">(Optional)</span>
                                        </label>
                                        <textarea name="short_description" id="shortDescInput" rows="2" class="form-control" placeholder="A concise 1-2 sentence summary displayed under the project title..."><?= set_value('short_description'); ?></textarea>
                                        <div class="form-text fs-12">Introductory summary displayed under the project name on the case study detail page.</div>
                                    </div>

                                    <!-- Project Overview -->
                                    <div class="mb-0">
                                        <label for="overviewInput" class="form-label fw-semibold fs-14">
                                            Project Overview & Scope <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="overview" id="overviewInput" rows="6" class="form-control" placeholder="Describe the lighting project, requirements, architectural challenges, and solutions delivered by TeknoLite..." required><?= set_value('overview'); ?></textarea>
                                        <div class="form-text fs-12">Detailed brief describing the client's lighting requirements and fixture specifications.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Metadata Card -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="card-title mb-0 d-flex align-items-center gap-2 text-dark">
                                        <iconify-icon icon="solar:global-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        SEO Optimization & URL Slug
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <!-- URL Slug -->
                                    <div class="mb-3">
                                        <label for="slugInput" class="form-label fw-semibold fs-14">
                                            SEO-friendly URL Slug
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-muted fs-13"><?= base_url('casestudydetail/'); ?></span>
                                            <input type="text" name="slug" id="slugInput" class="form-control" placeholder="modern-luxury-residence" value="<?= set_value('slug'); ?>">
                                            <button type="button" id="btnAutoSlug" class="btn btn-outline-secondary" title="Auto-generate from title">
                                                <i class="bx bx-refresh"></i> Auto
                                            </button>
                                        </div>
                                        <div class="form-text fs-12">Auto-generated from the Case Study Title. Lowercase letters, numbers, and dashes only.</div>
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="mb-3">
                                        <label for="metaTitleInput" class="form-label fw-semibold fs-14">
                                            Meta Title
                                        </label>
                                        <input type="text" name="meta_title" id="metaTitleInput" class="form-control" placeholder="e.g. Modern Luxury Residence Lighting | TeknoLite Case Study" value="<?= set_value('meta_title'); ?>">
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="mb-3">
                                        <label for="metaDescInput" class="form-label fw-semibold fs-14">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" id="metaDescInput" rows="3" class="form-control" placeholder="Search engine snippet describing this project..."><?= set_value('meta_description'); ?></textarea>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="mb-0">
                                        <label for="metaKeywordsInput" class="form-label fw-semibold fs-14">
                                            Meta Keywords
                                        </label>
                                        <input type="text" name="meta_keywords" id="metaKeywordsInput" class="form-control" placeholder="e.g. luxury lighting, architectural COB downlights, residential LED fixtures" value="<?= set_value('meta_keywords'); ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column: Featured Image & Status Settings -->
                        <div class="col-lg-4">

                            <!-- Status & Visibility Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="card-title mb-0 d-flex align-items-center gap-2 text-dark">
                                        <iconify-icon icon="solar:settings-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Publishing Status
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-14">Active / Inactive Status</label>
                                        <div class="form-check form-switch fs-15 mt-1">
                                            <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" name="status" value="active" checked>
                                            <label class="form-check-label fw-medium ms-2" for="statusSwitch" id="statusLabel">
                                                Active (Visible on Website)
                                            </label>
                                        </div>
                                        <div class="form-text fs-12 mt-2">When active, this case study is displayed in the public project portfolio and filters.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Featured Image Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="card-title mb-0 d-flex align-items-center gap-2 text-dark">
                                        <iconify-icon icon="solar:gallery-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Featured Image
                                    </h5>
                                </div>
                                <div class="card-body p-4 text-center">
                                    <!-- Image Preview -->
                                    <div class="mb-3">
                                        <img id="imagePreview" src="<?= base_url('assets/images/project/project1.jpeg'); ?>" alt="Featured Preview" class="img-preview-box">
                                    </div>

                                    <!-- Upload Control -->
                                    <label class="upload-dropzone d-block mb-3" for="featuredImageInput">
                                        <i class="bx bx-cloud-upload text-primary fs-28 d-block mb-1"></i>
                                        <span class="fw-semibold text-dark fs-14 d-block">Upload Project Image</span>
                                        <span class="text-muted fs-12 d-block">JPG, PNG, WEBP up to 5MB</span>
                                        <input type="file" name="featured_image" id="featuredImageInput" class="d-none" accept="image/*">
                                    </label>

                                    <!-- Or Preset Selection -->
                                    <div class="text-start">
                                        <label class="form-label fw-semibold fs-13 text-muted">Or Choose Existing Preset Project Asset:</label>
                                        <select name="image_url" id="presetImageSelect" class="form-select form-select-sm">
                                            <option value="">-- Custom Upload Above --</option>
                                            <option value="assets/images/project/project1.jpeg">Project 1 - Residential Interior</option>
                                            <option value="assets/images/project/project2.jpeg">Project 2 - Commercial Workspace</option>
                                            <option value="assets/images/project/project3.jpeg">Project 3 - Hospitality & Lounge</option>
                                            <option value="assets/images/project/project11.jpeg">Project 11 - Architectural Track Lighting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Action Card -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <button type="submit" class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center gap-2 mb-2">
                                        <i class="bx bx-save fs-18"></i>
                                        <span class="fw-semibold">Publish Case Study</span>
                                    </button>
                                    <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-outline-secondary w-100 py-2">
                                        Discard
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>

                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('titleInput');
            const slugInput = document.getElementById('slugInput');
            const metaTitleInput = document.getElementById('metaTitleInput');
            const metaDescInput = document.getElementById('metaDescInput');
            const overviewInput = document.getElementById('overviewInput');
            const btnAutoSlug = document.getElementById('btnAutoSlug');

            const statusSwitch = document.getElementById('statusSwitch');
            const statusLabel = document.getElementById('statusLabel');

            const fileInput = document.getElementById('featuredImageInput');
            const imagePreview = document.getElementById('imagePreview');
            const presetSelect = document.getElementById('presetImageSelect');

            // Helper to generate slug
            function slugify(text) {
                return text.toString().toLowerCase().trim()
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-');        // Replace multiple - with single -
            }

            // Auto-fill slug & meta fields when title changes
            titleInput.addEventListener('input', function () {
                const slug = slugify(this.value);
                if (!slugInput.dataset.manual) {
                    slugInput.value = slug;
                }
                if (!metaTitleInput.dataset.manual) {
                    metaTitleInput.value = this.value ? (this.value + ' | TeknoLite Case Study') : '';
                }
            });

            slugInput.addEventListener('input', function () {
                this.dataset.manual = "true";
            });

            metaTitleInput.addEventListener('input', function () {
                this.dataset.manual = "true";
            });

            btnAutoSlug.addEventListener('click', function () {
                slugInput.value = slugify(titleInput.value);
                slugInput.dataset.manual = "";
            });

            // Auto-fill meta description from overview
            overviewInput.addEventListener('input', function () {
                if (!metaDescInput.dataset.manual) {
                    metaDescInput.value = this.value.substring(0, 155);
                }
            });

            metaDescInput.addEventListener('input', function () {
                this.dataset.manual = "true";
            });

            // Status switch label toggle
            statusSwitch.addEventListener('change', function () {
                if (this.checked) {
                    statusLabel.textContent = "Active (Visible on Website)";
                    statusLabel.className = "form-check-label fw-medium ms-2 text-success";
                } else {
                    statusLabel.textContent = "Inactive (Hidden Draft)";
                    statusLabel.className = "form-check-label fw-medium ms-2 text-danger";
                }
            });

            // Image File Upload Preview
            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                    presetSelect.value = "";
                }
            });

            // Preset Select change
            presetSelect.addEventListener('change', function () {
                if (this.value) {
                    imagePreview.src = '<?= base_url(); ?>' + this.value;
                    fileInput.value = "";
                }
            });
        });
    </script>
</body>
</html>
