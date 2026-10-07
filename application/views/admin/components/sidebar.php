<!-- Left Admin Navigation Sidebar (Teknolite Theme) -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Brand Logo -->
    <div class="sidebar-brand">
    <a href="<?= base_url('admin/productlist'); ?>" class="brand-link">

        <?php
            $sidebarLogo = function_exists('get_setting_image') 
                ? get_setting_image('header_logo', 'assets/images/logo/logo.png') 
                : base_url('assets/images/logo/logo.png');
        ?>
        <img 
            src="<?= $sidebarLogo; ?>" 
            alt="Logo" 
            class="sidebar-logo">
    </a>
</div>

    <!-- Sidebar Navigation Menu (Flat direct links without dropdowns) -->
    <!-- Sidebar Navigation Menu -->
<div class="sidebar-menu-wrapper">
    <ul class="sidebar-menu" style="list-style: none !important; margin: 0; padding: 0;">

        <?php
            $activePage = isset($current_page) ? $current_page : 'productlist';

            $isEnquiryActive = in_array($activePage, [
                'enquiries',
                'enquiry',
                'enquirydetail',
                'enquirieslist'
            ]);

            $isCategoryActive = in_array($activePage, [
                'categorie',
                'categories',
                'category',
                'categorieedit',
                'categoryedit',
                'categoriesadd',
                'categoryadd',
                'categorieadd'
            ]);

            $isSubcategoryActive = in_array($activePage, [
                'subcategories',
                'subcategoryadd',
                'subcategoryedit'
            ]);

            $isProductActive = in_array($activePage, [
                'productlist',
                'productadd',
                'productlistdetail',
                'productedit',
                'products'
            ]);

            $isProductManagementActive =
                $isCategoryActive ||
                $isSubcategoryActive ||
                $isProductActive;

            $isCustomerActive = in_array($activePage, [
                'customers',
                'customerprofile'
            ]);

            $isCasestudyActive = in_array($activePage, [
                'casestudies',
                'casestudy',
                'casestudyadd',
                'casestudyedit'
            ]);

            $isBlogActive = in_array($activePage, [
                'blogs',
                'blog',
                'blogadd',
                'blogedit',
                'blogview'
            ]);
        ?>

        <!-- Dashboard -->
        <li class="menu-item <?= ($activePage === 'dashboard') ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/dashboard'); ?>" class="menu-link">
                <i class="menu-icon bx bxs-dashboard"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>


        <!-- Enquiries -->
        <li class="menu-item <?= $isEnquiryActive ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/enquiries'); ?>" class="menu-link">
                <i class="menu-icon bx bx-envelope-open"></i>
                <span class="menu-text">Enquiries</span>
            </a>
        </li>


        <!-- Product Management Dropdown -->
        <li class="menu-item has-submenu <?= $isProductManagementActive ? 'active open' : ''; ?>">

            <a href="javascript:void(0);" class="menu-link product-menu-toggle">
                <i class="menu-icon bx bx-package"></i>

                <span class="menu-text">Product Management</span>

                <i class="bx bx-chevron-down submenu-arrow"></i>
            </a>

            <ul class="submenu">

                <!-- Category -->
                <li class="submenu-item <?= $isCategoryActive ? 'active' : ''; ?>">
                    <a href="<?= base_url('admin/categorie'); ?>" class="submenu-link">
                        <i class="bx bx-category"></i>
                        <span>Category</span>
                    </a>
                </li>


                <!-- Subcategory -->
                <li class="submenu-item <?= $isSubcategoryActive ? 'active' : ''; ?>">
                    <a href="<?= base_url('admin/subcategories'); ?>" class="submenu-link">
                        <i class="bx bx-category-alt"></i>
                        <span>Subcategory</span>
                    </a>
                </li>


                <!-- Products -->
                <li class="submenu-item <?= $isProductActive ? 'active' : ''; ?>">
                    <a href="<?= base_url('admin/productlist'); ?>" class="submenu-link">
                        <i class="bx bx-t-shirt"></i>
                        <span>Products</span>
                    </a>
                </li>

            </ul>
        </li>


        <!-- Customers -->
        <li class="menu-item <?= $isCustomerActive ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/customers'); ?>" class="menu-link">
                <i class="menu-icon bx bx-group"></i>
                <span class="menu-text">Customers</span>
            </a>
        </li>


        <!-- Case Studies -->
        <li class="menu-item <?= $isCasestudyActive ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/casestudies'); ?>" class="menu-link">
                <i class="menu-icon bx bx-briefcase-alt-2"></i>
                <span class="menu-text">Case Studies</span>
            </a>
        </li>


        <!-- Blogs -->
        <li class="menu-item <?= $isBlogActive ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/blogs'); ?>" class="menu-link">
                <i class="menu-icon bx bx-news"></i>
                <span class="menu-text">Blogs</span>
            </a>
        </li>


        <!-- Settings -->
        <li class="menu-item <?= ($activePage === 'settings') ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/settings'); ?>" class="menu-link">
                <i class="menu-icon bx bx-cog"></i>
                <span class="menu-text">Settings</span>
            </a>
        </li>

    </ul>
</div>
</aside>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
<style>
    .sidebar-logo {
        max-width: 200px;
        height: 60px;
        object-fit: contain;
        display: block;
    }

    .sidebar-brand .brand-link {
        display: flex;
        align-items: center;
    }
</style>
<style>
    /* Product Management Dropdown */
    .has-submenu .submenu {
        list-style: none;
        margin: 0;
        padding: 5px 0 5px 48px;
        display: none;
    }

    .has-submenu.open .submenu {
        display: block;
    }

    .product-menu-toggle {
        position: relative;
    }

    .submenu-arrow {
        margin-left: auto;
        font-size: 20px;
        transition: transform 0.3s ease;
    }

    .has-submenu.open .submenu-arrow {
        transform: rotate(180deg);
    }

    .submenu-item {
        margin: 3px 0;
    }

    .submenu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
    }

    .submenu-link i {
        font-size: 17px;
    }

    .submenu-item.active .submenu-link {
        font-weight: 600;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const productToggle = document.querySelector('.product-menu-toggle');

    if (productToggle) {
        productToggle.addEventListener('click', function (e) {
            e.preventDefault();

            const parent = this.closest('.has-submenu');

            parent.classList.toggle('open');
        });
    }

});
</script>