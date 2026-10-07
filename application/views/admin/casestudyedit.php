<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Edit Case Study | Teknolite Admin'; ?></title>

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
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'casestudies']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Top Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'EDIT CASE STUDY']); ?>

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

                <?php 
                    $isActive = strtolower($case_study['status'] ?? 'active') === 'active';
                    $curImg = $case_study['featured_image'] ?? 'assets/images/project/project1.jpeg';
                ?>

                <!-- Page Header Title & Navigation -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Back to Case Studies">
                                <i class="bx bx-arrow-back fs-16"></i>
                            </a>
                            <h4 class="fw-bold mb-0">Edit Case Study: <?= html_escape($case_study['title']); ?></h4>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-12 ms-2"><?= html_escape($case_study['id']); ?></span>
                        </div>
                        <p class="text-muted mb-0 fs-14">Update project specifications, architectural photographs, client overview, and SEO parameters.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('casestudydetail/' . ($case_study['slug'] ?? '')); ?>" target="_blank" class="btn btn-outline-info d-flex align-items-center gap-1">
                            <i class="bx bx-link-external fs-16"></i>
                            <span>View Live</span>
                        </a>
                        <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" form="caseStudyEditForm" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="bx bx-save fs-18"></i>
                            <span>Update Case Study</span>
                        </button>
                    </div>
                </div>

                <!-- Form -->
                <form id="caseStudyEditForm" method="POST" action="<?= base_url('admin/casestudyedit/' . $case_study['id']); ?>" enctype="multipart/form-data">
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
                                        <input type="text" name="title" id="titleInput" class="form-control" placeholder="e.g. Modern Luxury Residence Lighting" required value="<?= html_escape(set_value('title', $case_study['title'] ?? '')); ?>">
                                        <div class="form-text fs-12">The prominent title shown on project listing and case study banner.</div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <!-- Client / Project Name -->
                                        <div class="col-md-6">
                                            <label for="clientInput" class="form-label fw-semibold fs-14">
                                                Client / Project Name <span class="text-muted fw-normal">(Optional)</span>
                                            </label>
                                            <input type="text" name="client" id="clientInput" class="form-control" placeholder="e.g. The Horizon Villa / Apex Corp" value="<?= html_escape(set_value('client', $case_study['client'] ?? '')); ?>">
                                        </div>

                                        <!-- Industry -->
                                        <div class="col-md-6">
                                            <label for="industrySelect" class="form-label fw-semibold fs-14">
                                                Industry / Sector <span class="text-danger">*</span>
                                            </label>
                                            <?php $curInd = $case_study['industry'] ?? 'Residential'; ?>
                                            <select name="industry" id="industrySelect" class="form-select" required>
                                                <option value="Residential" <?= ($curInd === 'Residential') ? 'selected' : ''; ?>>Residential</option>
                                                <option value="Commercial" <?= ($curInd === 'Commercial') ? 'selected' : ''; ?>>Commercial / Corporate</option>
                                                <option value="Hospitality" <?= ($curInd === 'Hospitality') ? 'selected' : ''; ?>>Hospitality & Resorts</option>
                                                <option value="Retail" <?= ($curInd === 'Retail') ? 'selected' : ''; ?>>Retail & Boutiques</option>
                                                <option value="Architectural" <?= ($curInd === 'Architectural') ? 'selected' : ''; ?>>Architectural / Monuments</option>
                                                <option value="Industrial" <?= ($curInd === 'Industrial') ? 'selected' : ''; ?>>Industrial & Warehouses</option>
                                                <option value="Outdoor & Landscape" <?= ($curInd === 'Outdoor & Landscape') ? 'selected' : ''; ?>>Outdoor & Landscape</option>
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
                                            <input type="text" name="location" id="locationInput" class="form-control" placeholder="e.g. South Mumbai, Maharashtra, India" required value="<?= html_escape(set_value('location', $case_study['location'] ?? '')); ?>">
                                        </div>
                                    </div>

                                    <!-- Solution -->
                                    <div class="mb-3">
                                        <label for="solutionInput" class="form-label fw-semibold fs-14">
                                            Lighting Solution Delivered <span class="text-muted fw-normal">(Optional)</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="bx bx-bulb text-warning"></i></span>
                                            <input type="text" name="solution" id="solutionInput" class="form-control" placeholder="e.g. Architectural LED Lighting" value="<?= html_escape(set_value('solution', $case_study['solution'] ?? 'Architectural LED Lighting')); ?>">
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label for="shortDescInput" class="form-label fw-semibold fs-14">
                                            Short Description <span class="text-muted fw-normal">(Optional)</span>
                                        </label>
                                        <textarea name="short_description" id="shortDescInput" rows="2" class="form-control" placeholder="A concise 1-2 sentence summary displayed under the project title..."><?= html_escape(set_value('short_description', $case_study['short_description'] ?? '')); ?></textarea>
                                        <div class="form-text fs-12">Introductory summary displayed under the project name on the case study detail page.</div>
                                    </div>

                                    <!-- Project Overview -->
                                    <div class="mb-0">
                                        <label for="overviewInput" class="form-label fw-semibold fs-14">
                                            Project Overview & Scope <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="overview" id="overviewInput" rows="6" class="form-control" placeholder="Describe the lighting project, requirements, architectural challenges, and solutions delivered by TeknoLite..." required><?= html_escape(set_value('overview', $case_study['overview'] ?? '')); ?></textarea>
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
                                            <input type="text" name="slug" id="slugInput" class="form-control" placeholder="modern-luxury-residence" value="<?= html_escape(set_value('slug', $case_study['slug'] ?? '')); ?>">
                                            <button type="button" id="btnAutoSlug" class="btn btn-outline-secondary" title="Auto-generate from title">
                                                <i class="bx bx-refresh"></i> Auto
                                            </button>
                                        </div>
                                        <div class="form-text fs-12">Controls the URL address for this case study. Lowercase letters, numbers, and dashes only.</div>
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="mb-3">
                                        <label for="metaTitleInput" class="form-label fw-semibold fs-14">
                                            Meta Title
                                        </label>
                                        <input type="text" name="meta_title" id="metaTitleInput" class="form-control" placeholder="e.g. Modern Luxury Residence Lighting | TeknoLite Case Study" value="<?= html_escape(set_value('meta_title', $case_study['meta_title'] ?? '')); ?>">
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="mb-3">
                                        <label for="metaDescInput" class="form-label fw-semibold fs-14">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" id="metaDescInput" rows="3" class="form-control" placeholder="Search engine snippet describing this project..."><?= html_escape(set_value('meta_description', $case_study['meta_description'] ?? '')); ?></textarea>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="mb-0">
                                        <label for="metaKeywordsInput" class="form-label fw-semibold fs-14">
                                            Meta Keywords
                                        </label>
                                        <input type="text" name="meta_keywords" id="metaKeywordsInput" class="form-control" placeholder="e.g. luxury lighting, architectural COB downlights, residential LED fixtures" value="<?= html_escape(set_value('meta_keywords', $case_study['meta_keywords'] ?? '')); ?>">
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
                                            <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" name="status" value="active" <?= $isActive ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-medium ms-2 <?= $isActive ? 'text-success' : 'text-danger'; ?>" for="statusSwitch" id="statusLabel">
                                                <?= $isActive ? 'Active (Visible on Website)' : 'Inactive (Hidden Draft)'; ?>
                                            </label>
                                        </div>
                                        <div class="form-text fs-12 mt-2">When active, this case study is displayed in the public project portfolio and filters.</div>
                                    </div>

                                    <hr>

                                    <!-- Timestamps -->
                                    <div class="fs-12 text-muted">
                                        <div class="mb-1"><i class="bx bx-calendar me-1"></i> Created: <?= html_escape($case_study['created_at'] ?? 'N/A'); ?></div>
                                        <div><i class="bx bx-time-five me-1"></i> Last Updated: <?= html_escape($case_study['updated_at'] ?? 'N/A'); ?></div>
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
                                        <img id="imagePreview" src="<?= base_url($curImg); ?>" alt="Featured Preview" class="img-preview-box" onerror="this.src='<?= base_url('assets/images/project/project1.jpeg'); ?>'">
                                    </div>

                                    <!-- Upload Control -->
                                    <label class="upload-dropzone d-block mb-3" for="featuredImageInput">
                                        <i class="bx bx-cloud-upload text-primary fs-28 d-block mb-1"></i>
                                        <span class="fw-semibold text-dark fs-14 d-block">Change Project Image</span>
                                        <span class="text-muted fs-12 d-block">JPG, PNG, WEBP up to 5MB</span>
                                        <input type="file" name="featured_image" id="featuredImageInput" class="d-none" accept="image/*">
                                    </label>

                                    <!-- Or Preset Selection -->
                                    <div class="text-start">
                                        <label class="form-label fw-semibold fs-13 text-muted">Or Choose Existing Preset Project Asset:</label>
                                        <select name="image_url" id="presetImageSelect" class="form-select form-select-sm">
                                            <option value="">-- Keep Current Image (<?= html_escape(basename($curImg)); ?>) --</option>
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
                                        <span class="fw-semibold">Update Case Study</span>
                                    </button>
                                    <a href="<?= base_url('admin/casestudies'); ?>" class="btn btn-outline-secondary w-100 py-2">
                                        Discard Changes
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
            const btnAutoSlug = document.getElementById('btnAutoSlug');

            const statusSwitch = document.getElementById('statusSwitch');
            const statusLabel = document.getElementById('statusLabel');

            const fileInput = document.getElementById('featuredImageInput');
            const imagePreview = document.getElementById('imagePreview');
            const presetSelect = document.getElementById('presetImageSelect');

            function slugify(text) {
                return text.toString().toLowerCase().trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
            }

            btnAutoSlug.addEventListener('click', function () {
                slugInput.value = slugify(titleInput.value);
            });

            statusSwitch.addEventListener('change', function () {
                if (this.checked) {
                    statusLabel.textContent = "Active (Visible on Website)";
                    statusLabel.className = "form-check-label fw-medium ms-2 text-success";
                } else {
                    statusLabel.textContent = "Inactive (Hidden Draft)";
                    statusLabel.className = "form-check-label fw-medium ms-2 text-danger";
                }
            });

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
