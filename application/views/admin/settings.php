<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Settings | Larkon Admin'; ?></title>

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

        .logo-preview-box {
            width: 100%;
            height: 120px;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            padding: 10px;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .logo-preview-box.dark-bg {
            background-color: #0878ff;
            border-color: #04308c;
        }
        .logo-preview-box img {
            max-height: 90px;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'settings']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'SETTINGS']); ?>

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

                <?php
                    $headerLogoUrl = function_exists('get_setting_image') 
                        ? get_setting_image('header_logo', 'assets/images/logo/logo.png') 
                        : base_url('assets/images/logo/logo.png');
                    $headerLogo2Url = function_exists('get_setting_image') 
                        ? get_setting_image('header_logo_2', get_setting_image('footer_logo', 'assets/images/logo/logo.png')) 
                        : base_url('assets/images/logo/logo.png');
                ?>

                <form action="<?= base_url('admin/savesettings'); ?>" method="post" enctype="multipart/form-data">
                    
                    <!-- 1. Branding & Logos -->
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:gallery-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Website Logos & Branding
                                    </h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-4">
                                        <!-- Header Logo -->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-13 fw-semibold">Header Logo <span class="text-muted fw-normal">(Primary / Transparent Header)</span></label>
                                            <div class="logo-preview-box mb-2" id="headerLogoBox">
                                                <img src="<?= $headerLogoUrl; ?>" alt="Header Logo" id="headerLogoPreview">
                                            </div>
                                            <input type="file" name="header_logo" id="headerLogoInput" class="form-control form-control-sm" accept="image/png, image/jpeg, image/webp, image/svg+xml">
                                            <small class="text-muted fs-12">Displayed on page top with dark background. Recommended: White or light PNG/SVG with transparent background.</small>
                                        </div>

                                        <!-- Header 2nd Logo (Sticky Header & Footer Logo) -->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-13 fw-semibold">Header 2nd Logo <span class="text-muted fw-normal">(Sticky Header &amp; Footer Logo)</span></label>
                                            <div class="logo-preview-box mb-2" id="headerLogo2Box" style="background-color: #f1f5f9;">
                                                <img src="<?= $headerLogo2Url; ?>" alt="Header 2nd Logo" id="headerLogo2Preview">
                                            </div>
                                            <input type="file" name="header_logo_2" id="headerLogo2Input" class="form-control form-control-sm" accept="image/png, image/jpeg, image/webp, image/svg+xml">
                                            <small class="text-muted fs-12">Second logo shown when scrolling (sticky header with white background), and automatically used in the website footer.</small>
                                        </div>

                                        <!-- Store / Company Name -->
                                        <div class="col-lg-12">
                                            <label for="store_name" class="form-label fs-13 fw-semibold">Company / Store Name</label>
                                            <input type="text" name="store_name" id="store_name" class="form-control" placeholder="TeknoLite" value="<?= htmlspecialchars($settings['store_name'] ?? 'TeknoLite Architectural Lighting'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Contact Information -->
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:phone-calling-rounded-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Contact Information
                                    </h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <!-- Primary Phone -->
                                        <div class="col-lg-6">
                                            <label for="contact_phone" class="form-label fs-13 fw-semibold">Primary Contact Phone</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                <input type="text" name="contact_phone" id="contact_phone" class="form-control" placeholder="+91 7021247655" value="<?= htmlspecialchars($settings['contact_phone'] ?? ($settings['owner_phone'] ?? '+91 7021247655')); ?>">
                                            </div>
                                            <small class="text-muted fs-12">Shown in website header, footer, and contact page.</small>
                                        </div>

                                        <!-- WhatsApp Number -->
                                        <div class="col-lg-6">
                                            <label for="contact_whatsapp" class="form-label fs-13 fw-semibold">WhatsApp Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bxl-whatsapp text-success"></i></span>
                                                <input type="text" name="contact_whatsapp" id="contact_whatsapp" class="form-control" placeholder="917021247619" value="<?= htmlspecialchars($settings['contact_whatsapp'] ?? '917021247619'); ?>">
                                            </div>
                                            <small class="text-muted fs-12">Used for WhatsApp chat button (include country code without + or spaces).</small>
                                        </div>

                                        <!-- Primary Email -->
                                        <div class="col-lg-6">
                                            <label for="contact_email" class="form-label fs-13 fw-semibold">Primary Contact Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                <input type="email" name="contact_email" id="contact_email" class="form-control" placeholder="teknolite@gmail.com" value="<?= htmlspecialchars($settings['contact_email'] ?? ($settings['owner_email'] ?? 'teknolite@gmail.com')); ?>">
                                            </div>
                                            <small class="text-muted fs-12">Shown in footer and contact page.</small>
                                        </div>

                                        <!-- Support Email -->
                                        <div class="col-lg-6">
                                            <label for="contact_email_support" class="form-label fs-13 fw-semibold">Support / Alternate Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-support"></i></span>
                                                <input type="email" name="contact_email_support" id="contact_email_support" class="form-control" placeholder="contact@teknolite.in" value="<?= htmlspecialchars($settings['contact_email_support'] ?? 'contact@teknolite.in'); ?>">
                                            </div>
                                        </div>

                                        <!-- Working Hours -->
                                        <div class="col-lg-6">
                                            <label for="contact_working_hours" class="form-label fs-13 fw-semibold">Working Hours</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                                                <input type="text" name="contact_working_hours" id="contact_working_hours" class="form-control" placeholder="Mon - Sat: 9:30 AM - 6:30 PM" value="<?= htmlspecialchars($settings['contact_working_hours'] ?? 'Mon - Sat: 9:30 AM - 6:30 PM'); ?>">
                                            </div>
                                        </div>

                                        <!-- Website URL -->
                                        <div class="col-lg-6">
                                            <label for="contact_website" class="form-label fs-13 fw-semibold">Official Website URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-globe"></i></span>
                                                <input type="url" name="contact_website" id="contact_website" class="form-control" placeholder="https://teknolite.in" value="<?= htmlspecialchars($settings['contact_website'] ?? 'https://teknolite.in'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Address & Location -->
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:map-point-wave-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Physical Address & Location
                                    </h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <!-- Street Address -->
                                        <div class="col-lg-12">
                                            <label for="address" class="form-label fs-13 fw-semibold">Street / Building Address</label>
                                            <textarea name="address" class="form-control bg-light-subtle" id="address" rows="3" placeholder="Plot No. 42, Marol Industrial Area, Andheri East"><?= htmlspecialchars($settings['address'] ?? 'Plot No. 42, Marol Industrial Area, Andheri East'); ?></textarea>
                                            <small class="text-muted fs-12">Displayed on Contact Us page and in Footer.</small>
                                        </div>

                                        <!-- City -->
                                        <div class="col-lg-3">
                                            <label for="city" class="form-label fs-13 fw-semibold">City</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="Mumbai" value="<?= htmlspecialchars($settings['city'] ?? 'Mumbai'); ?>">
                                        </div>

                                        <!-- State -->
                                        <div class="col-lg-3">
                                            <label for="state" class="form-label fs-13 fw-semibold">State / Province</label>
                                            <input type="text" name="state" id="state" class="form-control" placeholder="Maharashtra" value="<?= htmlspecialchars($settings['state'] ?? 'Maharashtra'); ?>">
                                        </div>

                                        <!-- Zipcode -->
                                        <div class="col-lg-3">
                                            <label for="zipcode" class="form-label fs-13 fw-semibold">Zip / Postal Code</label>
                                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="400059" value="<?= htmlspecialchars($settings['zipcode'] ?? '400059'); ?>">
                                        </div>

                                        <!-- Country -->
                                        <div class="col-lg-3">
                                            <label for="country" class="form-label fs-13 fw-semibold">Country</label>
                                            <input type="text" name="country" id="country" class="form-control" placeholder="India" value="<?= htmlspecialchars($settings['country'] ?? 'India'); ?>">
                                        </div>

                                        <!-- Google Maps Embed -->
                                        <div class="col-lg-12">
                                            <label for="google_map_iframe" class="form-label fs-13 fw-semibold">Google Maps Embed URL / Iframe Code</label>
                                            <textarea name="google_map_iframe" class="form-control bg-light-subtle" id="google_map_iframe" rows="2" placeholder="https://www.google.com/maps/embed?... or <iframe src='...'></iframe>"><?= htmlspecialchars($settings['google_map_iframe'] ?? ''); ?></textarea>
                                            <small class="text-muted fs-12">Paste your Google Maps embed URL or the full <code>&lt;iframe&gt;</code> code. This map will be embedded directly on the website Contact Us page.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Social Media Links -->
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:share-circle-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Social Media Profiles
                                    </h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <!-- Facebook -->
                                        <div class="col-lg-6">
                                            <label for="social_facebook" class="form-label fs-13 fw-semibold">Facebook Page URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-primary"><i class="bx bxl-facebook"></i></span>
                                                <input type="url" name="social_facebook" id="social_facebook" class="form-control" placeholder="https://www.facebook.com/TeknoliteIndia" value="<?= htmlspecialchars($settings['social_facebook'] ?? 'https://www.facebook.com/TeknoliteIndia'); ?>">
                                            </div>
                                        </div>

                                        <!-- Instagram -->
                                        <div class="col-lg-6">
                                            <label for="social_instagram" class="form-label fs-13 fw-semibold">Instagram Profile URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-danger"><i class="bx bxl-instagram"></i></span>
                                                <input type="url" name="social_instagram" id="social_instagram" class="form-control" placeholder="https://www.instagram.com/teknolite_india" value="<?= htmlspecialchars($settings['social_instagram'] ?? 'https://www.instagram.com/teknolite_india'); ?>">
                                            </div>
                                        </div>

                                        <!-- LinkedIn -->
                                        <div class="col-lg-6">
                                            <label for="social_linkedin" class="form-label fs-13 fw-semibold">LinkedIn Profile URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-info"><i class="bx bxl-linkedin"></i></span>
                                                <input type="url" name="social_linkedin" id="social_linkedin" class="form-control" placeholder="https://www.linkedin.com/company/teknovision-pvt-ltd" value="<?= htmlspecialchars($settings['social_linkedin'] ?? 'https://www.linkedin.com/company/teknovision-pvt-ltd'); ?>">
                                            </div>
                                        </div>

                                        <!-- Twitter / X -->
                                        <div class="col-lg-6">
                                            <label for="social_twitter" class="form-label fs-13 fw-semibold">Twitter / X URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-dark"><i class="bx bxl-twitter"></i></span>
                                                <input type="url" name="social_twitter" id="social_twitter" class="form-control" placeholder="https://twitter.com/TeknoLite" value="<?= htmlspecialchars($settings['social_twitter'] ?? ''); ?>">
                                            </div>
                                        </div>

                                        <!-- YouTube -->
                                        <div class="col-lg-6">
                                            <label for="social_youtube" class="form-label fs-13 fw-semibold">YouTube Channel URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-danger"><i class="bx bxl-youtube"></i></span>
                                                <input type="url" name="social_youtube" id="social_youtube" class="form-control" placeholder="https://www.youtube.com/@TeknoLite" value="<?= htmlspecialchars($settings['social_youtube'] ?? ''); ?>">
                                            </div>
                                        </div>

                                        <!-- Pinterest -->
                                        <div class="col-lg-6">
                                            <label for="social_pinterest" class="form-label fs-13 fw-semibold">Pinterest URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light text-danger"><i class="bx bxl-pinterest"></i></span>
                                                <input type="url" name="social_pinterest" id="social_pinterest" class="form-control" placeholder="https://pinterest.com/TeknoLite" value="<?= htmlspecialchars($settings['social_pinterest'] ?? ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. General & SEO Settings -->
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:settings-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        General & SEO Settings
                                    </h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <label for="meta_title" class="form-label fs-13 fw-semibold">Website Meta Title</label>
                                            <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Title" value="<?= htmlspecialchars($settings['meta_title'] ?? 'TeknoLite - Architectural Lighting Solutions'); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="meta_keyword" class="form-label fs-13 fw-semibold">Meta Keywords</label>
                                            <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Enter keywords separated by comma" value="<?= htmlspecialchars($settings['meta_keyword'] ?? 'architectural lighting, commercial downlights'); ?>">
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="description" class="form-label fs-13 fw-semibold">Company / Meta Description</label>
                                            <textarea name="description" class="form-control bg-light-subtle" id="description" rows="3" placeholder="Brief company summary"><?= htmlspecialchars($settings['description'] ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Buttons -->
                    <div class="text-end mb-4">
                        <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-outline-secondary px-3 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: #04308c; border-color: #04308c;">
                            <i class="bx bx-save me-1"></i> Save Changes
                        </button>
                    </div>

                </form>

                <!-- 6. Showroom & Branch Locations -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-bottom py-3 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <h4 class="card-title d-flex align-items-center gap-1 fs-16 fw-bold mb-0">
                                        <iconify-icon icon="solar:shop-2-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Showrooms &amp; Branch Locations
                                    </h4>
                                    <small class="text-muted fs-12">Manage physical experience centres and store locations shown on the About Us website page.</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1" style="background-color: #04308c; border-color: #04308c;" onclick="openAddBranchModal()">
                                    <i class="bx bx-plus fs-16"></i> Add New Showroom
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light fs-13">
                                            <tr>
                                                <th style="width: 70px;" class="ps-3">Photo</th>
                                                <th>Store / Centre Name</th>
                                                <th>City / Badge</th>
                                                <th>Location in Text</th>
                                                <th>Exact Google Maps URL</th>
                                                <th>Status</th>
                                                <th style="width: 110px;" class="text-end pe-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-13">
                                            <?php if (!empty($branches)): ?>
                                                <?php foreach ($branches as $b): 
                                                    $bImg = !empty($b['image']) 
                                                        ? (strpos($b['image'], 'http') === 0 ? $b['image'] : base_url($b['image'])) 
                                                        : base_url('assets/images/shop/exp-andheri.jpeg');
                                                ?>
                                                <tr>
                                                    <td class="ps-3">
                                                        <img src="<?= $bImg; ?>" alt="<?= htmlspecialchars($b['name']); ?>" class="rounded" style="width: 48px; height: 48px; object-fit: cover; border: 1px solid #e2e8f0;">
                                                    </td>
                                                    <td class="fw-semibold text-dark">
                                                        <?= htmlspecialchars($b['name']); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary fw-medium px-2 py-1"><?= htmlspecialchars($b['city_or_badge'] ?: 'Showroom'); ?></span>
                                                    </td>
                                                    <td class="text-muted" style="max-width: 260px;">
                                                        <?= nl2br(htmlspecialchars($b['address'])); ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($b['map_link'])): ?>
                                                            <a href="<?= htmlspecialchars($b['map_link']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1 fs-12 px-2 py-1">
                                                                <i class="bx bx-map-pin"></i> Visit Showroom Link <i class="bx bx-link-external fs-12"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted fs-12">No link configured</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (($b['status'] ?? 'active') === 'active'): ?>
                                                            <span class="badge bg-success-subtle text-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-end pe-3">
                                                        <button type="button" class="btn btn-sm btn-light border px-2 py-1 me-1" title="Edit Showroom" onclick='openEditBranchModal(<?= json_encode($b, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
                                                            <i class="bx bx-edit text-primary"></i>
                                                        </button>
                                                        <a href="<?= base_url('admin/branchdelete/' . $b['id']); ?>" class="btn btn-sm btn-light border px-2 py-1 text-danger" title="Delete Showroom" onclick="return confirm('Are you sure you want to delete this showroom location?');">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted">
                                                        No showroom locations found. Click "+ Add New Showroom" above to add one.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Showroom Branch Modal -->
            <div class="modal fade" id="branchModal" tabindex="-1" aria-labelledby="branchModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <form action="<?= base_url('admin/branchsave'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title fs-15 fw-bold" id="branchModalTitle">Add New Showroom Location</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-3">
                                <input type="hidden" name="branch_id" id="branch_id" value="">

                                <div class="mb-3">
                                    <label for="branch_name" class="form-label fs-13 fw-semibold">Store / Centre Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="branch_name" class="form-control" placeholder="e.g. TeknoLite Experience Centre" required>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-sm-7">
                                        <label for="branch_city" class="form-label fs-13 fw-semibold">City / Location Badge</label>
                                        <input type="text" name="city_or_badge" id="branch_city" class="form-control" placeholder="e.g. Andheri, Vashi, Chembur">
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="branch_status" class="form-label fs-13 fw-semibold">Status</label>
                                        <select name="status" id="branch_status" class="form-select">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="branch_address" class="form-label fs-13 fw-semibold">Location Address in Text <span class="text-danger">*</span></label>
                                    <textarea name="address" id="branch_address" class="form-control" rows="3" placeholder="Building No., Street, Area, City — Pincode" required></textarea>
                                    <small class="text-muted fs-12">Displayed on the website showroom card.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="branch_map_link" class="form-label fs-13 fw-semibold">Exact Google Maps URL ("Visit Showroom" button)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-map-pin text-danger"></i></span>
                                        <input type="url" name="map_link" id="branch_map_link" class="form-control" placeholder="https://maps.app.goo.gl/... or https://maps.google.com/...">
                                    </div>
                                    <small class="text-muted fs-12">When users click "Visit Showroom", this exact Google Maps location opens.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="branch_image" class="form-label fs-13 fw-semibold">Store / Showroom Photo</label>
                                    <input type="file" name="image" id="branch_image" class="form-control" accept="image/*">
                                    <small class="text-muted fs-12">Upload photo of the store / experience centre.</small>
                                    <div class="mt-2">
                                        <img src="" id="branchImagePreview" alt="Store Photo Preview" class="rounded border" style="max-height: 90px; display: none;">
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="branch_sort_order" class="form-label fs-13 fw-semibold">Sort / Display Order</label>
                                    <input type="number" name="sort_order" id="branch_sort_order" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="modal-footer border-top bg-light-subtle">
                                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm px-4" style="background-color: #04308c; border-color: #04308c;">Save Showroom</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>

    <!-- Instant Logo Preview Script & Branch Modal Script -->
    <script>
        function bindImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!input || !img) return;

            input.addEventListener('change', function() {
                const file = this.files && this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function openAddBranchModal() {
            document.getElementById('branchModalTitle').textContent = 'Add New Showroom Location';
            document.getElementById('branch_id').value = '';
            document.getElementById('branch_name').value = 'TeknoLite Experience Centre';
            document.getElementById('branch_city').value = '';
            document.getElementById('branch_address').value = '';
            document.getElementById('branch_map_link').value = '';
            document.getElementById('branch_status').value = 'active';
            document.getElementById('branch_sort_order').value = '0';
            const prev = document.getElementById('branchImagePreview');
            prev.src = '';
            prev.style.display = 'none';
            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('branchModal'));
            modal.show();
        }

        function openEditBranchModal(data) {
            document.getElementById('branchModalTitle').textContent = 'Edit Showroom Location';
            document.getElementById('branch_id').value = data.id || '';
            document.getElementById('branch_name').value = data.name || '';
            document.getElementById('branch_city').value = data.city_or_badge || '';
            document.getElementById('branch_address').value = data.address || '';
            document.getElementById('branch_map_link').value = data.map_link || '';
            document.getElementById('branch_status').value = data.status || 'active';
            document.getElementById('branch_sort_order').value = data.sort_order || '0';
            const prev = document.getElementById('branchImagePreview');
            if (data.image) {
                prev.src = data.image.indexOf('http') === 0 ? data.image : '<?= base_url(); ?>' + data.image;
                prev.style.display = 'block';
            } else {
                prev.src = '';
                prev.style.display = 'none';
            }
            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('branchModal'));
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            bindImagePreview('headerLogoInput', 'headerLogoPreview');
            bindImagePreview('headerLogo2Input', 'headerLogo2Preview');
            bindImagePreview('branch_image', 'branchImagePreview');
        });
    </script>
</body>
</html>
