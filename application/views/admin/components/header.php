<!-- Admin Topbar Header (Teknolite Theme) -->
<header class="admin-topbar">
    <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
        <!-- Left: Dynamic Title -->
        <div class="d-flex align-items-center gap-3">
            <?php 
                if (isset($topbar_title)) {
                    $pageHeading = $topbar_title;
                } else if (isset($current_page) && in_array($current_page, ['productlist', 'products'])) {
                    $pageHeading = 'PRODUCT LIST';
                } else if (isset($current_page) && $current_page === 'productadd') {
                    $pageHeading = 'ADD PRODUCT';
                } else if (isset($current_page) && $current_page === 'productlistdetail') {
                    $pageHeading = 'PRODUCT DETAILS';
                } else {
                    $pageHeading = 'WELCOME!';
                }
            ?>
            <button type="button" class="btn btn-sm btn-light border d-lg-none" id="mobileSidebarToggleBtn" aria-label="Toggle navigation menu">
                <i class="bx bx-menu fs-20"></i>
            </button>
            <h4 class="topbar-welcome-title mb-0"><?= $pageHeading; ?></h4>
        </div>

        <!-- Right: Actions, Avatar & Search -->
        <div class="d-flex align-items-center gap-3">

            <!-- User Avatar & Dropdown -->
            <?php 
                $adminUser = $this->session->userdata('admin_user');
                $adminName = !empty($adminUser['name']) ? $adminUser['name'] : 'Administrator';
                $adminRole = !empty($adminUser['role']) ? $adminUser['role'] : 'Super Admin';
                $adminAvatar = !empty($adminUser['avatar']) ? base_url($adminUser['avatar']) : base_url('assets/admin/images/avatar.jpg');
            ?>
            <div class="dropdown">
                <a href="javascript:void(0);" class="topbar-avatar-link d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 2px 6px; border-radius: 20px;">
                    <div class="d-none d-xl-block text-start">
                        <span class="d-block fw-semibold text-dark fs-12 lh-1"><?= html_escape($adminName); ?></span>
                        <small class="text-muted fs-11"><?= html_escape($adminRole); ?></small>
                    </div>
                    <i class="bx bx-chevron-down d-none d-xl-inline text-muted fs-14"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="min-width: 220px;">
                    <li>
                        <div class="px-3 py-2 border-bottom">
                            <h6 class="mb-0 text-dark fs-13 fw-semibold"><?= html_escape($adminName); ?></h6>
                            <small class="text-muted fs-11"><?= html_escape($adminRole); ?></small>
                        </div>
                    </li>
                    <li><a class="dropdown-item py-2 text-danger fw-medium" href="<?= base_url('admin/logout'); ?>"><i class="bx bx-log-out me-2"></i>Sign Out</a></li>
                </ul>
            </div>

            <!-- Search Input Pill -->
            <div class="topbar-search-wrap">
                <i class="bx bx-search topbar-search-icon"></i>
                <input type="text" class="topbar-search-input" placeholder="Search..." aria-label="Search">
            </div>
        </div>
    </div>
</header>

