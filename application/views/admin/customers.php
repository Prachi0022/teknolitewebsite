<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Customers List | Teknolite Admin'; ?></title>

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
        .fs-18 { font-size: 18px !important; }
        .fs-22 { font-size: 22px !important; }
        .fs-28 { font-size: 28px !important; }

        .stat-card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 10px;
        }
        .stat-card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .avatar-md {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .status-pill-filter {
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            background-color: #f1f5f9;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pill-filter:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }
        .status-pill-filter.active {
            background-color: #04308c;
            color: #ffffff;
        }
        .status-pill-filter.active .badge-count {
            background-color: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }

        .btn-soft-primary {
            background-color: rgba(4, 48, 140, 0.12);
            color: #04308c;
            border: none;
        }
        .btn-soft-primary:hover {
            background-color: #04308c;
            color: #ffffff;
        }

        .btn-soft-danger {
            background-color: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            border: none;
        }
        .btn-soft-danger:hover {
            background-color: #ef4444;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'customers']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CUSTOMERS LIST']); ?>

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

                <!-- Top 4 Summary Cards -->
                <div class="row g-3 mb-4">
                    <!-- 1. Total Customers -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/customers'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Total Registered</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['total'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:users-group-two-rounded-bold-duotone" class="fs-28 text-primary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 2. Active Accounts -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/customers?status=active'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Active Accounts</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['active'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-success bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-28 text-success avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 3. Inactive Accounts -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/customers?status=inactive'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Inactive Accounts</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['inactive'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-secondary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:user-block-rounded-bold-duotone" class="fs-28 text-secondary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 4. Business & GST Accounts -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card stat-card-hover border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Business / GST Entities</h4>
                                        <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['business'] ?? 0); ?></p>
                                    </div>
                                    <div>
                                        <div class="avatar-md bg-info bg-opacity-10 rounded">
                                            <iconify-icon icon="solar:buildings-bold-duotone" class="fs-28 text-info avatar-title"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Customers Table Card -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card border-0 shadow-sm mb-4">
                            <!-- Card Header -->
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div>
                                        <h4 class="card-title mb-1 fs-16 fw-bold text-dark">Registered Customer Directory</h4>
                                        <p class="text-muted mb-0 fs-13">View profiles, contact information, GST numbers, and enquiry histories.</p>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <!-- Search Form -->
                                        <form method="get" action="<?= base_url('admin/customers'); ?>" class="d-flex align-items-center gap-1">
                                            <?php if (!empty($selected_status)): ?>
                                                <input type="hidden" name="status" value="<?= htmlspecialchars($selected_status); ?>">
                                            <?php endif; ?>
                                            <div class="input-group input-group-sm" style="width: 250px;">
                                                <input type="text" name="search" class="form-control" placeholder="Search name, GST, city..." value="<?= htmlspecialchars($search ?? ''); ?>">
                                                <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                                            </div>
                                            <?php if (!empty($search)): ?>
                                                <a href="<?= base_url('admin/customers'); ?>" class="btn btn-sm btn-outline-danger" title="Clear Search"><i class="bx bx-x"></i></a>
                                            <?php endif; ?>
                                        </form>

                                        <!-- Add Customer Button -->
                                        <button type="button" class="btn btn-sm btn-primary fw-semibold px-3" data-bs-toggle="modal" data-bs-target="#customerModal" style="background-color: #04308c; border-color: #04308c;">
                                            <i class="bx bx-plus me-1"></i> Add Customer
                                        </button>
                                    </div>
                                </div>

                                <!-- Status Filters -->
                                <div class="d-flex flex-wrap align-items-center gap-2 mt-3 pt-3 border-top">
                                    <span class="fs-12 text-muted fw-semibold me-1 text-uppercase">Filter Status:</span>
                                    <a href="<?= base_url('admin/customers'); ?>" class="status-pill-filter <?= empty($selected_status) ? 'active' : ''; ?>">
                                        All Accounts <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['total'] ?? 0; ?></span>
                                    </a>
                                    <a href="<?= base_url('admin/customers?status=active'); ?>" class="status-pill-filter <?= ($selected_status === 'active') ? 'active' : ''; ?>">
                                        Active <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['active'] ?? 0; ?></span>
                                    </a>
                                    <a href="<?= base_url('admin/customers?status=inactive'); ?>" class="status-pill-filter <?= ($selected_status === 'inactive') ? 'active' : ''; ?>">
                                        Inactive <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['inactive'] ?? 0; ?></span>
                                    </a>
                                </div>
                            </div>

                            <!-- Table Area -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered table-nowrap">
                                        <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                            <tr>
                                                <th class="ps-3">Customer Name</th>
                                                <th>Contact Details</th>
                                                <th>Company / Studio</th>
                                                <th>Location</th>
                                                <th>GST Number</th>
                                                <th>Registered Date</th>
                                                <th>Status</th>
                                                <th class="text-end pe-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($customers)): ?>
                                                <?php foreach ($customers as $cust): 
                                                    $isActive = (strtolower($cust['status'] ?? 'active') === 'active');
                                                    $firstLetter = strtoupper(substr($cust['name'] ?? 'C', 0, 1));
                                                ?>
                                                    <tr>
                                                         <td class="ps-3">
                                                             <div class="d-flex align-items-center gap-2">
                                                                 <?php if (!empty($cust['avatar'])): ?>
                                                                     <img src="<?= htmlspecialchars($cust['avatar_url'] ?? base_url($cust['avatar'])); ?>" alt="<?= htmlspecialchars($cust['name'] ?? 'Customer'); ?>" class="rounded-circle object-fit-cover shadow-sm" style="width: 36px; height: 36px;" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'avatar-sm rounded-circle bg-primary-subtle text-primary fw-bold fs-14 d-flex align-items-center justify-content-center\' style=\'width: 36px; height: 36px;\'><?= $firstLetter; ?></div>';">
                                                                 <?php else: ?>
                                                                     <div class="avatar-sm rounded-circle bg-primary-subtle text-primary fw-bold fs-14 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                                         <?= $firstLetter; ?>
                                                                     </div>
                                                                 <?php endif; ?>
                                                                 <div>
                                                                     <a href="<?= base_url('admin/customerprofile/' . $cust['id']); ?>" class="fw-semibold text-dark text-decoration-none fs-14">
                                                                         <?= htmlspecialchars($cust['name'] ?? 'Customer'); ?>
                                                                     </a>
                                                                     <small class="text-muted d-block fs-12"><?= htmlspecialchars($cust['id']); ?></small>
                                                                 </div>
                                                             </div>
                                                         </td>
                                                        <td>
                                                            <div class="fs-13">
                                                                <div class="text-dark"><i class="bx bx-envelope text-muted me-1"></i><?= htmlspecialchars($cust['email'] ?? '-'); ?></div>
                                                                <div class="text-muted fs-12"><i class="bx bx-phone text-muted me-1"></i><?= htmlspecialchars($cust['mobile'] ?? '-'); ?></div>
                                                            </div>
                                                        </td>
                                                        <td class="fs-13 fw-medium text-dark">
                                                            <?= !empty($cust['company']) && $cust['company'] !== '-' ? htmlspecialchars(mb_strimwidth($cust['company'], 0, 30, '...')) : '<span class="text-muted">Individual Client</span>'; ?>
                                                        </td>
                                                        <td class="fs-13">
                                                            <div class="text-dark"><?= htmlspecialchars($cust['city'] ?? 'Mumbai'); ?>, <?= htmlspecialchars($cust['state'] ?? 'Maharashtra'); ?></div>
                                                            <small class="text-muted">PIN: <?= htmlspecialchars($cust['pincode'] ?? '400001'); ?></small>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($cust['gst_number'])): ?>
                                                                <span class="badge bg-light text-dark border font-monospace fs-12">
                                                                    <?= htmlspecialchars($cust['gst_number']); ?>
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="text-muted fs-13">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="fs-13 text-muted">
                                                            <?= htmlspecialchars($cust['date_formatted'] ?? date('M d, Y', strtotime($cust['registered_at'] ?? 'now'))); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('admin/customerstatus/' . $cust['id']); ?>" 
                                                               class="badge status-toggle-pill px-2 py-1 fs-12 <?= $isActive ? 'bg-success text-white' : 'bg-secondary text-white'; ?>" 
                                                               title="Click to toggle Active/Inactive">
                                                                <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i>
                                                                <?= $isActive ? 'Active' : 'Inactive'; ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-end pe-3">
                                                            <div class="d-flex justify-content-end gap-2">
                                                                <!-- View Profile & Enquiry History -->
                                                                <a href="<?= base_url('admin/customerprofile/' . $cust['id']); ?>" class="btn btn-light btn-sm" title="View Profile & Enquiry History">
                                                                    <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                                </a>

                                                                <!-- Edit Customer Modal -->
                                                                <button type="button" class="btn btn-soft-primary btn-sm btn-edit-customer" 
                                                                        data-id="<?= htmlspecialchars($cust['id']); ?>"
                                                                        data-name="<?= htmlspecialchars($cust['name'] ?? ''); ?>"
                                                                        data-email="<?= htmlspecialchars($cust['email'] ?? ''); ?>"
                                                                        data-mobile="<?= htmlspecialchars($cust['mobile'] ?? ''); ?>"
                                                                        data-company="<?= htmlspecialchars($cust['company'] ?? ''); ?>"
                                                                        data-gst="<?= htmlspecialchars($cust['gst_number'] ?? ''); ?>"
                                                                        data-address="<?= htmlspecialchars($cust['address'] ?? ''); ?>"
                                                                        data-city="<?= htmlspecialchars($cust['city'] ?? ''); ?>"
                                                                        data-state="<?= htmlspecialchars($cust['state'] ?? ''); ?>"
                                                                        data-pincode="<?= htmlspecialchars($cust['pincode'] ?? ''); ?>"
                                                                        data-status="<?= htmlspecialchars($cust['status'] ?? 'active'); ?>"
                                                                        title="Edit Customer">
                                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                </button>

                                                                <!-- Delete Customer -->
                                                                <button type="button" class="btn btn-soft-danger btn-sm btn-delete-customer" 
                                                                        data-id="<?= htmlspecialchars($cust['id']); ?>" 
                                                                        data-name="<?= htmlspecialchars($cust['name'] ?? 'Customer'); ?>"
                                                                        title="Delete Customer">
                                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center py-5 text-muted">
                                                        <i class="bx bx-user-x fs-36 d-block mb-2 text-secondary"></i>
                                                        <h5 class="fs-15 fw-semibold">No customers found</h5>
                                                        <p class="fs-13 mb-0">Try changing your search keywords or filter options.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Card Footer Pagination -->
                            <div class="card-footer border-top bg-transparent py-3 px-3">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="fs-13 text-muted">
                                        Showing <strong><?= count($customers); ?></strong> of <strong><?= $total_items ?? count($customers); ?></strong> customers
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-end mb-0">
                                            <?php 
                                                $currentPage = $current_page_num ?? 1;
                                                $totalPages = $total_pages ?? 1;
                                                $baseUrl = base_url('admin/customers');
                                                $queryPrefix = '?';
                                                if (!empty($selected_status)) $queryPrefix .= 'status=' . urlencode($selected_status) . '&';
                                                if (!empty($search)) $queryPrefix .= 'search=' . urlencode($search) . '&';
                                            ?>
                                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= $baseUrl . $queryPrefix . 'page=' . ($currentPage - 1); ?>">Previous</a>
                                            </li>
                                            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                                <li class="page-item <?= ($p === $currentPage) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="<?= $baseUrl . $queryPrefix . 'page=' . $p; ?>"><?= $p; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="<?= $baseUrl . $queryPrefix . 'page=' . ($currentPage + 1); ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>
    </div>

    <!-- Add / Edit Customer Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <form action="<?= base_url('admin/customerupdate'); ?>" method="post" id="customerForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="formCustomerId">
                    <input type="hidden" name="redirect_to" value="admin/customers">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fs-16 fw-bold" id="customerModalLabel">Customer Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Customer Full Name *</label>
                                <input type="text" name="name" id="custName" class="form-control" required placeholder="e.g. Gail C. Anderson">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Email Address *</label>
                                <input type="email" name="email" id="custEmail" class="form-control" required placeholder="name@company.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Mobile Number *</label>
                                <input type="text" name="mobile" id="custMobile" class="form-control" required placeholder="+91 98201 45892">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Company / Firm Name</label>
                                <input type="text" name="company" id="custCompany" class="form-control" placeholder="Studio / Firm Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Customer Avatar / Photo</label>
                                <input type="file" name="avatar" id="custAvatar" class="form-control" accept="image/*">
                                <small class="text-muted fs-11">Recommended: Square JPG, PNG, WebP (Max 2MB)</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold" id="custPasswordLabel">Account Password</label>
                                <input type="password" name="password" id="custPassword" class="form-control" placeholder="Set password (default: Customer@123 if blank)">
                                <small class="text-muted fs-11" id="custPasswordHelp">Leave blank when editing to keep current password.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">GST Number (if applicable)</label>
                                <input type="text" name="gst_number" id="custGst" class="form-control" placeholder="e.g. 27AABCW9603R1ZN">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Account Status</label>
                                <select name="status" id="custStatus" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-13 fw-semibold">Street Address</label>
                                <input type="text" name="address" id="custAddress" class="form-control" placeholder="Premises / Street address">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">City</label>
                                <input type="text" name="city" id="custCity" class="form-control" placeholder="Mumbai">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">State</label>
                                <input type="text" name="state" id="custState" class="form-control" placeholder="Maharashtra">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">PIN Code</label>
                                <input type="text" name="pincode" id="custPincode" class="form-control" placeholder="400051">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #04308c; border-color: #04308c;">Save Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Customer Modal -->
    <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow text-center p-3">
                <div class="modal-body">
                    <div class="avatar-lg mx-auto mb-3 bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; margin: 0 auto;">
                        <i class="bx bx-trash fs-28"></i>
                    </div>
                    <h5 class="fs-16 fw-bold mb-2">Delete Customer?</h5>
                    <p class="text-muted fs-13 mb-3">Are you sure you want to remove <strong id="deleteCustomerName"></strong>? Their enquiry records will remain preserved.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteCustomerBtn" class="btn btn-danger btn-sm px-3">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const customerModal = new bootstrap.Modal(document.getElementById('customerModal'));
            
            // Edit trigger
            document.querySelectorAll('.btn-edit-customer').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('customerModalLabel').textContent = 'Edit Customer Profile';
                    document.getElementById('formCustomerId').value = this.getAttribute('data-id');
                    document.getElementById('custName').value = this.getAttribute('data-name');
                    document.getElementById('custEmail').value = this.getAttribute('data-email');
                    document.getElementById('custMobile').value = this.getAttribute('data-mobile');
                    document.getElementById('custCompany').value = this.getAttribute('data-company');
                    document.getElementById('custGst').value = this.getAttribute('data-gst');
                    document.getElementById('custAddress').value = this.getAttribute('data-address');
                    document.getElementById('custCity').value = this.getAttribute('data-city');
                    document.getElementById('custState').value = this.getAttribute('data-state');
                    document.getElementById('custPincode').value = this.getAttribute('data-pincode');
                    document.getElementById('custStatus').value = this.getAttribute('data-status') || 'active';
                    
                    const avatarInput = document.getElementById('custAvatar');
                    if (avatarInput) avatarInput.value = '';
                    const pwdInput = document.getElementById('custPassword');
                    if (pwdInput) {
                        pwdInput.value = '';
                        pwdInput.placeholder = 'Leave blank to keep current password';
                    }
                    const pwdHelp = document.getElementById('custPasswordHelp');
                    if (pwdHelp) pwdHelp.textContent = 'Leave blank when editing to keep current password.';
                    const pwdLabel = document.getElementById('custPasswordLabel');
                    if (pwdLabel) pwdLabel.textContent = 'New Password (Optional)';

                    customerModal.show();
                });
            });

            // Reset modal for Add
            const addBtn = document.querySelector('[data-bs-target="#customerModal"]');
            if (addBtn) {
                addBtn.addEventListener('click', function () {
                    document.getElementById('customerModalLabel').textContent = 'Register New Customer';
                    document.getElementById('customerForm').reset();
                    document.getElementById('formCustomerId').value = '';
                    const avatarInput = document.getElementById('custAvatar');
                    if (avatarInput) avatarInput.value = '';
                    const pwdInput = document.getElementById('custPassword');
                    if (pwdInput) {
                        pwdInput.value = '';
                        pwdInput.placeholder = 'Set password (default: Customer@123 if blank)';
                    }
                    const pwdHelp = document.getElementById('custPasswordHelp');
                    if (pwdHelp) pwdHelp.textContent = 'If left blank, default password "Customer@123" will be assigned.';
                    const pwdLabel = document.getElementById('custPasswordLabel');
                    if (pwdLabel) pwdLabel.textContent = 'Account Password';
                });
            }

            // Delete trigger
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'));
            document.querySelectorAll('.btn-delete-customer').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    document.getElementById('deleteCustomerName').textContent = name;
                    document.getElementById('confirmDeleteCustomerBtn').href = '<?= base_url('admin/customerdelete/'); ?>' + id;
                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>
