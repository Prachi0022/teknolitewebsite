<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Enquiries & Quotation Requests | TeknoLite Admin'; ?></title>

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

        .enquiry-row:hover {
            background-color: #f8fafc;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'enquiries']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'PRODUCT ENQUIRIES & QUOTATIONS']); ?>

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

                <!-- Top 8 Summary Cards (2 Rows of 4 matching Teknolite Twig layout) -->
                <div class="row g-3 mb-4">
                    <!-- 1. New Enquiries -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?status=New'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">New Enquiries</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['new'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:chat-round-money-broken" class="fs-28 text-primary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 2. In Review -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?status=' . urlencode('In Review')); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">In Review</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['in_review'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-warning bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:clock-circle-broken" class="fs-28 text-warning avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 3. Quotation Sent -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?status=' . urlencode('Quotation Sent')); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Quotation Sent</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['quotation_sent'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-info bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:letter-opened-broken" class="fs-28 text-info avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 4. Confirmed -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?status=Confirmed'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Confirmed Orders</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['confirmed'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-success bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:clipboard-check-broken" class="fs-28 text-success avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 5. Closed -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?status=Closed'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Closed / Fulfilled</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['closed'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-secondary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:box-broken" class="fs-28 text-secondary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 6. High Priority -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?search=High'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">High Priority</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['high_priority'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-danger bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:danger-circle-broken" class="fs-28 text-danger avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 7. This Month -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries?date_filter=this_month'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">This Month</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['this_month'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:calendar-date-broken" class="fs-28 text-primary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- 8. Total Enquiries -->
                    <div class="col-md-6 col-xl-3">
                        <a href="<?= base_url('admin/enquiries'); ?>" class="text-decoration-none">
                            <div class="card stat-card-hover border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="card-title mb-2 fs-14 text-muted fw-medium">Total Enquiries</h4>
                                            <p class="text-dark fw-bold fs-22 mb-0"><?= number_format($stats['total'] ?? 0); ?></p>
                                        </div>
                                        <div>
                                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                <iconify-icon icon="solar:inbox-line-broken" class="fs-28 text-primary avatar-title"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Main Enquiries Table Card -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card border-0 shadow-sm mb-4">
                            <!-- Card Header -->
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div>
                                        <h4 class="card-title mb-1 fs-16 fw-bold text-dark">All Order & Enquiry List</h4>
                                        <p class="text-muted mb-0 fs-13">Track client quotation requests, review product quantities, and update statuses.</p>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <!-- Search Form -->
                                        <form method="get" action="<?= base_url('admin/enquiries'); ?>" class="d-flex align-items-center gap-1">
                                            <?php if (!empty($selected_status)): ?>
                                                <input type="hidden" name="status" value="<?= htmlspecialchars($selected_status); ?>">
                                            <?php endif; ?>
                                            <?php if (!empty($date_filter)): ?>
                                                <input type="hidden" name="date_filter" value="<?= htmlspecialchars($date_filter); ?>">
                                            <?php endif; ?>
                                            <div class="input-group input-group-sm" style="width: 240px;">
                                                <input type="text" name="search" class="form-control" placeholder="Search customer, company..." value="<?= htmlspecialchars($search ?? ''); ?>">
                                                <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                                            </div>
                                            <?php if (!empty($search)): ?>
                                                <a href="<?= base_url('admin/enquiries'); ?>" class="btn btn-sm btn-outline-danger" title="Clear Search"><i class="bx bx-x"></i></a>
                                            <?php endif; ?>
                                        </form>

                                        <!-- Date Filter Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-calendar me-1"></i>
                                                <?php 
                                                    $dateLabels = [
                                                        'today' => 'Today',
                                                        'this_week' => 'This Week',
                                                        'this_month' => 'This Month',
                                                        'all' => 'All Time'
                                                    ];
                                                    echo $dateLabels[$date_filter] ?? 'This Month';
                                                ?>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm fs-13">
                                                <li><a class="dropdown-item <?= ($date_filter === 'today') ? 'active' : ''; ?>" href="<?= base_url('admin/enquiries?date_filter=today' . (!empty($selected_status) ? '&status=' . urlencode($selected_status) : '')); ?>">Today</a></li>
                                                <li><a class="dropdown-item <?= ($date_filter === 'this_week') ? 'active' : ''; ?>" href="<?= base_url('admin/enquiries?date_filter=this_week' . (!empty($selected_status) ? '&status=' . urlencode($selected_status) : '')); ?>">This Week</a></li>
                                                <li><a class="dropdown-item <?= (empty($date_filter) || $date_filter === 'this_month') ? 'active' : ''; ?>" href="<?= base_url('admin/enquiries?date_filter=this_month' . (!empty($selected_status) ? '&status=' . urlencode($selected_status) : '')); ?>">This Month</a></li>
                                                <li><a class="dropdown-item <?= ($date_filter === 'all') ? 'active' : ''; ?>" href="<?= base_url('admin/enquiries?date_filter=all' . (!empty($selected_status) ? '&status=' . urlencode($selected_status) : '')); ?>">All Time</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Flow Filter Tabs -->
                                <div class="d-flex flex-wrap align-items-center gap-2 mt-3 pt-3 border-top">
                                    <span class="fs-12 text-muted fw-semibold me-1 text-uppercase">Status Flow:</span>
                                    
                                    <a href="<?= base_url('admin/enquiries'); ?>" class="status-pill-filter <?= empty($selected_status) ? 'active' : ''; ?>">
                                        All <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['total'] ?? 0; ?></span>
                                    </a>

                                    <a href="<?= base_url('admin/enquiries?status=New'); ?>" class="status-pill-filter <?= ($selected_status === 'New') ? 'active' : ''; ?>">
                                        New <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['new'] ?? 0; ?></span>
                                    </a>

                                    <a href="<?= base_url('admin/enquiries?status=' . urlencode('In Review')); ?>" class="status-pill-filter <?= ($selected_status === 'In Review') ? 'active' : ''; ?>">
                                        In Review <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['in_review'] ?? 0; ?></span>
                                    </a>

                                    <a href="<?= base_url('admin/enquiries?status=' . urlencode('Quotation Sent')); ?>" class="status-pill-filter <?= ($selected_status === 'Quotation Sent') ? 'active' : ''; ?>">
                                        Quotation Sent <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['quotation_sent'] ?? 0; ?></span>
                                    </a>

                                    <a href="<?= base_url('admin/enquiries?status=Confirmed'); ?>" class="status-pill-filter <?= ($selected_status === 'Confirmed') ? 'active' : ''; ?>">
                                        Confirmed <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['confirmed'] ?? 0; ?></span>
                                    </a>

                                    <a href="<?= base_url('admin/enquiries?status=Closed'); ?>" class="status-pill-filter <?= ($selected_status === 'Closed') ? 'active' : ''; ?>">
                                        Closed <span class="badge bg-secondary badge-count rounded-pill fs-12 ms-1"><?= $stats['closed'] ?? 0; ?></span>
                                    </a>
                                </div>
                            </div>

                            <!-- Table Area -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered table-nowrap">
                                        <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                            <tr>
                                                <th class="ps-3" style="width: 140px;">Order / Enquiry ID</th>
                                                <th>Created at</th>
                                                <th>Customer</th>
                                                <th>Priority</th>
                                                <th>Estimated Total</th>
                                                <th>Contact Details</th>
                                                <th>Products / Qty</th>
                                                <th>Status Flow</th>
                                                <th class="text-end pe-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($enquiries)): ?>
                                                <?php foreach ($enquiries as $enq): 
                                                    $status = $enq['status'] ?? 'New';
                                                    $statusBadgeClass = 'border border-secondary text-secondary';
                                                    if ($status === 'New') {
                                                        $statusBadgeClass = 'border border-secondary text-secondary';
                                                    } else if ($status === 'In Review') {
                                                        $statusBadgeClass = 'border border-warning text-warning';
                                                    } else if ($status === 'Quotation Sent') {
                                                        $statusBadgeClass = 'border border-primary text-primary';
                                                    } else if ($status === 'Confirmed') {
                                                        $statusBadgeClass = 'border border-success text-success';
                                                    } else if ($status === 'Closed') {
                                                        $statusBadgeClass = 'border border-dark text-dark';
                                                    }

                                                    $priority = $enq['priority'] ?? 'Normal';
                                                    $totalAmt = $enq['financials']['total_amount'] ?? 0;
                                                    $firstProduct = !empty($enq['products']) ? $enq['products'][0] : null;
                                                ?>
                                                    <tr class="enquiry-row">
                                                        <td class="ps-3">
                                                            <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="fw-semibold text-primary text-decoration-none">
                                                                <?= htmlspecialchars($enq['reference'] ?? ('#' . $enq['id'])); ?>
                                                            </a>
                                                        </td>
                                                        <td class="fs-13 text-muted">
                                                            <?= htmlspecialchars($enq['date_formatted'] ?? date('M d, Y', strtotime($enq['created_at'] ?? 'now'))); ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="link-primary fw-medium fs-14 text-decoration-none d-block">
                                                                    <?= htmlspecialchars($enq['customer_name'] ?? 'Client'); ?>
                                                                </a>
                                                                <small class="text-muted fs-12">
                                                                    <?= htmlspecialchars(mb_strimwidth($enq['company_name'] ?? '-', 0, 30, '...')); ?>
                                                                </small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if (strtolower($priority) === 'high' || strtolower($priority) === 'urgent'): ?>
                                                                <span class="badge bg-danger-subtle text-danger fs-12 px-2 py-1">High</span>
                                                            <?php else: ?>
                                                                <span class="text-dark fs-13">Normal</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <span class="fw-bold text-dark fs-14">₹<?= number_format($totalAmt, 2); ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="fs-12">
                                                                <div class="text-dark"><i class="bx bx-phone me-1 text-muted"></i><?= htmlspecialchars($enq['mobile'] ?? '-'); ?></div>
                                                                <div class="text-muted"><i class="bx bx-envelope me-1 text-muted"></i><?= htmlspecialchars($enq['email'] ?? '-'); ?></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <?php if ($firstProduct && !empty($firstProduct['image'])): ?>
                                                                    <img src="<?= base_url($firstProduct['image']); ?>" onerror="this.src='<?= base_url('assets/images/products/gamma.png'); ?>';" class="rounded" width="32" height="32" style="object-fit:cover;">
                                                                <?php endif; ?>
                                                                <div>
                                                                    <span class="fw-semibold text-dark fs-13"><?= (int)($enq['total_quantity'] ?? 1); ?> Fixtures</span>
                                                                    <small class="d-block text-muted fs-12"><?= htmlspecialchars(mb_strimwidth($firstProduct['name'] ?? 'Enquiry Items', 0, 20, '...')); ?></small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge <?= $statusBadgeClass; ?> px-2 py-1 fs-13">
                                                                <?= htmlspecialchars($status); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-3">
                                                            <div class="d-flex justify-content-end gap-2">
                                                                <!-- View Details -->
                                                                <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="btn btn-light btn-sm" title="View Enquiry Details">
                                                                    <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                                </a>

                                                                <!-- Quick Edit Status -->
                                                                <button type="button" class="btn btn-soft-primary btn-sm btn-quick-status" 
                                                                        data-id="<?= htmlspecialchars($enq['id']); ?>" 
                                                                        data-ref="<?= htmlspecialchars($enq['reference'] ?? ('#' . $enq['id'])); ?>"
                                                                        data-status="<?= htmlspecialchars($status); ?>"
                                                                        data-priority="<?= htmlspecialchars($priority); ?>"
                                                                        data-remark="<?= htmlspecialchars($enq['admin_remark'] ?? ''); ?>"
                                                                        title="Update Status / Add Remark">
                                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                </button>

                                                                <!-- Delete Enquiry -->
                                                                <button type="button" class="btn btn-soft-danger btn-sm btn-delete-enquiry" 
                                                                        data-id="<?= htmlspecialchars($enq['id']); ?>" 
                                                                        data-ref="<?= htmlspecialchars($enq['reference'] ?? ('#' . $enq['id'])); ?>"
                                                                        title="Delete Enquiry">
                                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="9" class="text-center py-5 text-muted">
                                                        <i class="bx bx-inbox fs-36 d-block mb-2 text-secondary"></i>
                                                        <h5 class="fs-15 fw-semibold">No enquiries found</h5>
                                                        <p class="fs-13 mb-0">Try changing your search terms or status filters.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Card Footer with Pagination matching template -->
                            <div class="card-footer border-top bg-transparent py-3 px-3">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="fs-13 text-muted">
                                        Showing <strong><?= count($enquiries); ?></strong> of <strong><?= $total_items ?? count($enquiries); ?></strong> enquiries
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-end mb-0">
                                            <?php 
                                                $currentPage = $current_page_num ?? 1;
                                                $totalPages = $total_pages ?? 1;
                                                $baseUrl = base_url('admin/enquiries');
                                                $queryPrefix = '?';
                                                if (!empty($selected_status)) $queryPrefix .= 'status=' . urlencode($selected_status) . '&';
                                                if (!empty($search)) $queryPrefix .= 'search=' . urlencode($search) . '&';
                                                if (!empty($date_filter)) $queryPrefix .= 'date_filter=' . urlencode($date_filter) . '&';
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

    <!-- Quick Status Update Modal -->
    <div class="modal fade" id="quickStatusModal" tabindex="-1" aria-labelledby="quickStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="<?= base_url('admin/enquiryupdatestatus'); ?>" method="post" id="formQuickStatus">
                    <input type="hidden" name="id" id="modalEnquiryId">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fs-16 fw-bold" id="quickStatusModalLabel">Update Enquiry Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Enquiry Reference</label>
                            <input type="text" id="modalEnquiryRef" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Status Flow *</label>
                            <select name="status" id="modalEnquiryStatus" class="form-select" required>
                                <option value="New">1. New</option>
                                <option value="In Review">2. In Review</option>
                                <option value="Quotation Sent">3. Quotation Sent</option>
                                <option value="Confirmed">4. Confirmed</option>
                                <option value="Closed">5. Closed</option>
                            </select>
                            <small class="text-muted fs-12">Flow: New &rarr; In Review &rarr; Quotation Sent &rarr; Confirmed &rarr; Closed</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Priority</label>
                            <select name="priority" id="modalEnquiryPriority" class="form-select">
                                <option value="Normal">Normal</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Admin Remark / Notes</label>
                            <textarea name="admin_remark" id="modalEnquiryRemark" class="form-control" rows="3" placeholder="Add technical notes, quote ref, client discussion notes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #04308c; border-color: #04308c;">Save Status Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteEnquiryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow text-center p-3">
                <div class="modal-body">
                    <div class="avatar-lg mx-auto mb-3 bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; margin: 0 auto;">
                        <i class="bx bx-trash fs-28"></i>
                    </div>
                    <h5 class="fs-16 fw-bold mb-2">Delete Enquiry?</h5>
                    <p class="text-muted fs-13 mb-3">Are you sure you want to delete enquiry <strong id="deleteEnquiryRef"></strong>? This action cannot be undone.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteEnquiryBtn" class="btn btn-danger btn-sm px-3">Delete</a>
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
            // Quick Status Modal trigger
            const quickModal = new bootstrap.Modal(document.getElementById('quickStatusModal'));
            document.querySelectorAll('.btn-quick-status').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const ref = this.getAttribute('data-ref');
                    const status = this.getAttribute('data-status');
                    const priority = this.getAttribute('data-priority');
                    const remark = this.getAttribute('data-remark');

                    document.getElementById('modalEnquiryId').value = id;
                    document.getElementById('modalEnquiryRef').value = ref;
                    document.getElementById('modalEnquiryStatus').value = status;
                    document.getElementById('modalEnquiryPriority').value = priority || 'Normal';
                    document.getElementById('modalEnquiryRemark').value = remark || '';

                    quickModal.show();
                });
            });

            // Delete Modal trigger
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteEnquiryModal'));
            document.querySelectorAll('.btn-delete-enquiry').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const ref = this.getAttribute('data-ref');

                    document.getElementById('deleteEnquiryRef').textContent = ref;
                    document.getElementById('confirmDeleteEnquiryBtn').href = '<?= base_url('admin/enquirydelete/'); ?>' + id;

                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>
