<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Enquiry Details | Teknolite Admin'; ?></title>

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
        .fs-20 { font-size: 20px !important; }
        .fs-22 { font-size: 22px !important; }
        .fs-35 { font-size: 35px !important; }

        .avatar-md {
            width: 48px;
            height: 48px;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            overflow: hidden;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            min-width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Timeline Styling */
        .timeline-step {
            position: relative;
            padding-left: 2.25rem;
            margin-bottom: 1.5rem;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }
        .timeline-line {
            position: absolute;
            left: 15px;
            top: 24px;
            bottom: -20px;
            width: 2px;
            border-left: 2px dashed #cbd5e1;
        }
        .timeline-step:last-child .timeline-line {
            display: none;
        }
        .timeline-dot {
            position: absolute;
            left: 0;
            top: 2px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }
        .timeline-dot.active {
            border-color: #22c55e;
            color: #22c55e;
            background-color: #f0fdf4;
        }

        .bg-light-subtle-box {
            background-color: #f8fafc;
            border-radius: 8px;
        }

        @media print {
            .admin-sidebar, .admin-topbar, .btn-print-hide, .card-footer {
                display: none !important;
            }
            .admin-main-wrapper {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'enquirydetail']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'ORDER DETAILS']); ?>

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
                    $currentStatus = $enquiry['status'] ?? 'New';
                    $statusSteps = [
                        'New' => 1,
                        'In Review' => 2,
                        'Quotation Sent' => 3,
                        'Confirmed' => 4,
                        'Closed' => 5
                    ];
                    $currentStepNum = $statusSteps[$currentStatus] ?? 1;

                    // Badges
                    $statusBadgeClass = 'border border-secondary text-secondary';
                    if ($currentStatus === 'New') $statusBadgeClass = 'border border-secondary text-secondary';
                    else if ($currentStatus === 'In Review') $statusBadgeClass = 'border border-warning text-warning';
                    else if ($currentStatus === 'Quotation Sent') $statusBadgeClass = 'border border-primary text-primary';
                    else if ($currentStatus === 'Confirmed') $statusBadgeClass = 'border border-success text-success';
                    else if ($currentStatus === 'Closed') $statusBadgeClass = 'border border-dark text-dark';

                    $financials = $enquiry['financials'] ?? [
                        'subtotal' => 0,
                        'discount' => 0,
                        'delivery_charge' => 0,
                        'tax_amount' => 0,
                        'total_amount' => 0
                    ];
                ?>

                <div class="row">
                    <!-- Left Section (col-xl-9 col-lg-8) -->
                    <div class="col-xl-9 col-lg-8">
                        
                        <!-- Top Order Status & 5-Step Progress Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-3 p-md-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div>
                                        <h4 class="fw-bold text-dark d-flex align-items-center gap-2 mb-1 fs-18">
                                            <?= htmlspecialchars($enquiry['reference'] ?? ('#' . $enquiry['id'])); ?>
                                            <span class="badge <?= $statusBadgeClass; ?> px-2 py-1 fs-13 rounded">
                                                <?= htmlspecialchars($currentStatus); ?>
                                            </span>
                                            <?php if (strtolower($enquiry['priority'] ?? 'normal') === 'high'): ?>
                                                <span class="badge bg-danger-subtle text-danger px-2 py-1 fs-13">High Priority</span>
                                            <?php endif; ?>
                                        </h4>
                                        <p class="mb-0 text-muted fs-13">
                                            Orders / Order Details / <?= htmlspecialchars($enquiry['reference'] ?? ('#' . $enquiry['id'])); ?> &bull; 
                                            <?= htmlspecialchars($enquiry['date_formatted'] ?? ''); ?> at <?= htmlspecialchars($enquiry['time_formatted'] ?? ''); ?>
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 btn-print-hide">
                                        <a href="<?= base_url('admin/enquiries'); ?>" class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-arrow-back me-1"></i> Back to List
                                        </a>
                                        <button type="button" onclick="window.print();" class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-printer me-1"></i> Print / PDF
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('statusSelect').focus();" style="background-color: #04308c; border-color: #04308c;">
                                            <i class="bx bx-edit me-1"></i> Update Status
                                        </button>
                                    </div>
                                </div>

                                <!-- Progress Title -->
                                <div class="mt-4">
                                    <h4 class="fw-semibold text-dark fs-15 mb-1">Status Flow Progress</h4>
                                    <p class="text-muted fs-12 mb-0">Standard lifecycle: New &rarr; In Review &rarr; Quotation Sent &rarr; Confirmed &rarr; Closed</p>
                                </div>

                                <!-- 5 Progress Step Bars matching template -->
                                <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-3 mt-1">
                                    <!-- Step 1: New -->
                                    <div class="col">
                                        <div class="progress" style="height: 9px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <p class="mb-0 fs-13 fw-semibold <?= ($currentStepNum >= 1) ? 'text-success' : 'text-muted'; ?>">1. New</p>
                                            <?php if ($currentStepNum === 1): ?>
                                                <div class="spinner-border spinner-border-sm text-success ms-auto" role="status" style="width: 13px; height: 13px;"></div>
                                            <?php elseif ($currentStepNum > 1): ?>
                                                <i class="bx bx-check text-success ms-auto fs-16"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Step 2: In Review -->
                                    <div class="col">
                                        <div class="progress" style="height: 9px;">
                                            <div class="progress-bar <?= ($currentStepNum >= 2) ? 'bg-warning progress-bar-striped progress-bar-animated' : 'bg-light'; ?>" role="progressbar" style="width: <?= ($currentStepNum >= 2) ? '100%' : '0%'; ?>"></div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <p class="mb-0 fs-13 fw-semibold <?= ($currentStepNum >= 2) ? 'text-warning' : 'text-muted'; ?>">2. In Review</p>
                                            <?php if ($currentStepNum === 2): ?>
                                                <div class="spinner-border spinner-border-sm text-warning ms-auto" role="status" style="width: 13px; height: 13px;"></div>
                                            <?php elseif ($currentStepNum > 2): ?>
                                                <i class="bx bx-check text-success ms-auto fs-16"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Step 3: Quotation Sent -->
                                    <div class="col">
                                        <div class="progress" style="height: 9px;">
                                            <div class="progress-bar <?= ($currentStepNum >= 3) ? 'bg-primary' : 'bg-light'; ?>" role="progressbar" style="width: <?= ($currentStepNum >= 3) ? '100%' : '0%'; ?>"></div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <p class="mb-0 fs-13 fw-semibold <?= ($currentStepNum >= 3) ? 'text-primary' : 'text-muted'; ?>">3. Quotation Sent</p>
                                            <?php if ($currentStepNum === 3): ?>
                                                <div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" style="width: 13px; height: 13px;"></div>
                                            <?php elseif ($currentStepNum > 3): ?>
                                                <i class="bx bx-check text-success ms-auto fs-16"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Step 4: Confirmed -->
                                    <div class="col">
                                        <div class="progress" style="height: 9px;">
                                            <div class="progress-bar <?= ($currentStepNum >= 4) ? 'bg-success' : 'bg-light'; ?>" role="progressbar" style="width: <?= ($currentStepNum >= 4) ? '100%' : '0%'; ?>"></div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <p class="mb-0 fs-13 fw-semibold <?= ($currentStepNum >= 4) ? 'text-success' : 'text-muted'; ?>">4. Confirmed</p>
                                            <?php if ($currentStepNum === 4): ?>
                                                <div class="spinner-border spinner-border-sm text-success ms-auto" role="status" style="width: 13px; height: 13px;"></div>
                                            <?php elseif ($currentStepNum > 4): ?>
                                                <i class="bx bx-check text-success ms-auto fs-16"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Step 5: Closed -->
                                    <div class="col">
                                        <div class="progress" style="height: 9px;">
                                            <div class="progress-bar <?= ($currentStepNum >= 5) ? 'bg-dark' : 'bg-light'; ?>" role="progressbar" style="width: <?= ($currentStepNum >= 5) ? '100%' : '0%'; ?>"></div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <p class="mb-0 fs-13 fw-semibold <?= ($currentStepNum >= 5) ? 'text-dark' : 'text-muted'; ?>">5. Closed</p>
                                            <?php if ($currentStepNum >= 5): ?>
                                                <i class="bx bx-check-double text-success ms-auto fs-16"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Estimated Fulfillment Banner Footer -->
                            <div class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2 py-2 px-3 border-top">
                                <p class="border rounded mb-0 px-2 py-1 bg-body fs-13 text-muted">
                                    <i class='bx bx-arrow-from-left align-middle fs-16 me-1'></i>
                                    Estimated Quotation / Dispatch:
                                    <span class="text-dark fw-semibold ms-1"><?= date('M d, Y', strtotime('+3 days', strtotime($enquiry['created_at'] ?? 'now'))); ?></span>
                                </p>
                                <div class="btn-print-hide">
                                    <?php if ($currentStatus === 'New'): ?>
                                        <form action="<?= base_url('admin/enquiryupdatestatus/' . $enquiry['id']); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="status" value="In Review">
                                            <input type="hidden" name="admin_remark" value="Moved to In Review for photometric calculations.">
                                            <button type="submit" class="btn btn-sm btn-primary" style="background-color: #04308c; border-color: #04308c;">
                                                Move to In Review &rarr;
                                            </button>
                                        </form>
                                    <?php elseif ($currentStatus === 'In Review'): ?>
                                        <form action="<?= base_url('admin/enquiryupdatestatus/' . $enquiry['id']); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="status" value="Quotation Sent">
                                            <input type="hidden" name="admin_remark" value="Official quotation emailed to customer.">
                                            <button type="submit" class="btn btn-sm btn-primary" style="background-color: #04308c; border-color: #04308c;">
                                                Mark Quotation Sent &rarr;
                                            </button>
                                        </form>
                                    <?php elseif ($currentStatus === 'Quotation Sent'): ?>
                                        <form action="<?= base_url('admin/enquiryupdatestatus/' . $enquiry['id']); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="status" value="Confirmed">
                                            <input type="hidden" name="admin_remark" value="Customer approved quote and confirmed order.">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Confirm Order &rarr;
                                            </button>
                                        </form>
                                    <?php elseif ($currentStatus === 'Confirmed'): ?>
                                        <form action="<?= base_url('admin/enquiryupdatestatus/' . $enquiry['id']); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="status" value="Closed">
                                            <input type="hidden" name="admin_remark" value="Order completely delivered and closed.">
                                            <button type="submit" class="btn btn-sm btn-dark">
                                                Close / Archive Order &rarr;
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 fs-13">Lifecycle Completed</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Selected Products Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
                                <h4 class="card-title fs-16 fw-bold mb-0">Selected Products & Fixtures</h4>
                                <span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">
                                    <?= count($enquiry['products'] ?? []); ?> Item(s) &bull; <?= (int)($enquiry['total_quantity'] ?? 1); ?> Total Units
                                </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered table-nowrap">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th class="ps-3">Product Name & Specifications</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>GST / Tax</th>
                                                <th class="text-end pe-3">Line Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($enquiry['products'])): ?>
                                                <?php foreach ($enquiry['products'] as $prod): 
                                                    $imgUrl = !empty($prod['image']) ? base_url($prod['image']) : base_url('assets/images/products/gamma.png');
                                                    $qty = (int)($prod['quantity'] ?? 1);
                                                    $price = (float)($prod['price'] ?? 0);
                                                    $tax = (float)($prod['tax'] ?? ($price * 0.18));
                                                    $lineTotal = (float)($prod['total'] ?? (($price + $tax) * $qty));
                                                ?>
                                                    <tr>
                                                        <td class="ps-3">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="avatar-md bg-light border p-1 rounded">
                                                                    <img src="<?= $imgUrl; ?>" onerror="this.src='<?= base_url('assets/images/products/gamma.png'); ?>';" alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 fw-bold mb-0 text-dark">
                                                                        <?= htmlspecialchars($prod['name'] ?? 'TeknoLite LED Light'); ?>
                                                                    </h6>
                                                                    <p class="text-muted mb-0 fs-12">
                                                                        <span>SKU: <?= htmlspecialchars($prod['sku'] ?? 'TL-PRO'); ?></span> &bull; 
                                                                        <span><?= htmlspecialchars($prod['specs'] ?? ($prod['category'] ?? 'Standard')); ?></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success-subtle text-success px-2 py-1 fs-12">
                                                                <?= htmlspecialchars($prod['status'] ?? 'Ready'); ?>
                                                            </span>
                                                        </td>
                                                        <td class="fs-14 fw-semibold text-dark">
                                                            <?= $qty; ?>
                                                        </td>
                                                        <td class="fs-13">
                                                            ₹<?= number_format($price, 2); ?>
                                                        </td>
                                                        <td class="fs-13 text-muted">
                                                            ₹<?= number_format($tax, 2); ?>
                                                        </td>
                                                        <td class="text-end pe-3 fw-bold text-dark fs-14">
                                                            ₹<?= number_format($lineTotal, 2); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted">No items listed.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Message / Requirement Box -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h4 class="card-title fs-16 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                    <i class="bx bx-message-detail text-primary"></i> Customer Message / Requirement
                                </h4>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <div class="p-3 rounded bg-light border">
                                    <p class="mb-0 fs-14 text-dark" style="white-space: pre-wrap; line-height: 1.6;">
                                        <?= !empty($enquiry['customer_message']) ? htmlspecialchars($enquiry['customer_message']) : 'No specific notes provided by the customer.'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Order & Enquiry Timeline Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h4 class="card-title fs-16 fw-bold mb-0">Enquiry Timeline & History</h4>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <div class="timeline-container position-relative">
                                    <?php 
                                        $timelineEvents = $enquiry['timeline'] ?? [];
                                        if (empty($timelineEvents)) {
                                            $timelineEvents[] = [
                                                'date' => $enquiry['date_formatted'] ?? date('M d, Y'),
                                                'title' => 'Enquiry Created',
                                                'description' => 'Enquiry logged into system.',
                                                'user' => 'System',
                                                'icon' => 'solar:inbox-line-broken'
                                            ];
                                        }
                                        foreach ($timelineEvents as $tEvent):
                                    ?>
                                        <div class="timeline-step">
                                            <span class="timeline-line"></span>
                                            <div class="timeline-dot active">
                                                <i class="bx bx-check-circle fs-18"></i>
                                            </div>
                                            <div class="d-flex flex-wrap align-items-start justify-content-between gap-2">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-semibold fs-14"><?= htmlspecialchars($tEvent['title'] ?? 'Activity Logged'); ?></h5>
                                                    <p class="text-muted fs-13 mb-1"><?= htmlspecialchars($tEvent['description'] ?? ''); ?></p>
                                                    <small class="text-secondary fs-12">Action by: <strong><?= htmlspecialchars($tEvent['user'] ?? 'Admin'); ?></strong></small>
                                                </div>
                                                <span class="text-muted fs-12"><?= htmlspecialchars($tEvent['date'] ?? ''); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom 4 Meta Info Cards -->
                        <div class="card border-0 shadow-sm mb-4 bg-light-subtle">
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    <!-- 1. Channel / Source -->
                                    <div class="col-sm-6 col-lg-3 border-end-lg">
                                        <div class="d-flex align-items-center justify-content-between px-2">
                                            <div>
                                                <p class="text-dark fw-semibold fs-14 mb-1">Source / Channel</p>
                                                <p class="text-muted fs-13 mb-0">Website RFQ</p>
                                            </div>
                                            <div class="avatar-md bg-white border rounded">
                                                <iconify-icon icon="solar:shop-2-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. Date -->
                                    <div class="col-sm-6 col-lg-3 border-end-lg">
                                        <div class="d-flex align-items-center justify-content-between px-2">
                                            <div>
                                                <p class="text-dark fw-semibold fs-14 mb-1">Enquiry Date</p>
                                                <p class="text-muted fs-13 mb-0"><?= htmlspecialchars($enquiry['date_formatted'] ?? date('M d, Y')); ?></p>
                                            </div>
                                            <div class="avatar-md bg-white border rounded">
                                                <iconify-icon icon="solar:calendar-date-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Customer -->
                                    <div class="col-sm-6 col-lg-3 border-end-lg">
                                        <div class="d-flex align-items-center justify-content-between px-2">
                                            <div>
                                                <p class="text-dark fw-semibold fs-14 mb-1">Customer</p>
                                                <p class="text-muted fs-13 mb-0"><?= htmlspecialchars(mb_strimwidth($enquiry['customer_name'] ?? 'Client', 0, 16, '...')); ?></p>
                                            </div>
                                            <div class="avatar-md bg-white border rounded">
                                                <iconify-icon icon="solar:user-circle-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4. Reference -->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="d-flex align-items-center justify-content-between px-2">
                                            <div>
                                                <p class="text-dark fw-semibold fs-14 mb-1">Reference ID</p>
                                                <p class="text-muted fs-13 mb-0"><?= htmlspecialchars($enquiry['id'] ?? 'ENQ'); ?></p>
                                            </div>
                                            <div class="avatar-md bg-white border rounded">
                                                <iconify-icon icon="solar:clipboard-text-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Sidebar Section (col-xl-3 col-lg-4) -->
                    <div class="col-xl-3 col-lg-4">
                        
                        <!-- 1. Order / Quotation Summary Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h4 class="card-title fs-16 fw-bold mb-0">Quotation Summary</h4>
                            </div>
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 fs-13">
                                        <tbody>
                                            <tr>
                                                <td class="px-0 py-1 text-muted">
                                                    <iconify-icon icon="solar:clipboard-text-broken" class="align-middle me-1"></iconify-icon> Sub Total :
                                                </td>
                                                <td class="text-end text-dark fw-semibold px-0 py-1">
                                                    ₹<?= number_format($financials['subtotal'] ?? 0, 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 text-muted">
                                                    <iconify-icon icon="solar:ticket-broken" class="align-middle me-1"></iconify-icon> Discount :
                                                </td>
                                                <td class="text-end text-success fw-semibold px-0 py-1">
                                                    -₹<?= number_format($financials['discount'] ?? 0, 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 text-muted">
                                                    <iconify-icon icon="solar:kick-scooter-broken" class="align-middle me-1"></iconify-icon> Delivery / Freight :
                                                </td>
                                                <td class="text-end text-dark fw-semibold px-0 py-1">
                                                    ₹<?= number_format($financials['delivery_charge'] ?? 0, 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 text-muted">
                                                    <iconify-icon icon="solar:calculator-minimalistic-broken" class="align-middle me-1"></iconify-icon> GST (18%) :
                                                </td>
                                                <td class="text-end text-dark fw-semibold px-0 py-1">
                                                    ₹<?= number_format($financials['tax_amount'] ?? 0, 2); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle py-3 px-3 border-top">
                                <p class="fw-bold text-dark mb-0 fs-14">Estimated Total</p>
                                <h5 class="fw-bold text-primary mb-0 fs-16" style="color: #04308c !important;">
                                    ₹<?= number_format($financials['total_amount'] ?? 0, 2); ?>
                                </h5>
                            </div>
                        </div>

                        <!-- 2. Admin Status Update & Remark Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h4 class="card-title fs-16 fw-bold mb-0 text-dark">Update Status & Remarks</h4>
                            </div>
                            <div class="card-body p-3">
                                <form action="<?= base_url('admin/enquiryupdatestatus/' . $enquiry['id']); ?>" method="post">
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold">Status Flow *</label>
                                        <select name="status" id="statusSelect" class="form-select fs-13" required>
                                            <option value="New" <?= ($currentStatus === 'New') ? 'selected' : ''; ?>>1. New</option>
                                            <option value="In Review" <?= ($currentStatus === 'In Review') ? 'selected' : ''; ?>>2. In Review</option>
                                            <option value="Quotation Sent" <?= ($currentStatus === 'Quotation Sent') ? 'selected' : ''; ?>>3. Quotation Sent</option>
                                            <option value="Confirmed" <?= ($currentStatus === 'Confirmed') ? 'selected' : ''; ?>>4. Confirmed</option>
                                            <option value="Closed" <?= ($currentStatus === 'Closed') ? 'selected' : ''; ?>>5. Closed</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold">Priority</label>
                                        <select name="priority" class="form-select fs-13">
                                            <option value="Normal" <?= (strtolower($enquiry['priority'] ?? '') === 'normal') ? 'selected' : ''; ?>>Normal</option>
                                            <option value="High" <?= (strtolower($enquiry['priority'] ?? '') === 'high') ? 'selected' : ''; ?>>High</option>
                                            <option value="Urgent" <?= (strtolower($enquiry['priority'] ?? '') === 'urgent') ? 'selected' : ''; ?>>Urgent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fs-13 fw-semibold">Admin Remark / Notes</label>
                                        <textarea name="admin_remark" class="form-control fs-13" rows="3" placeholder="Add technical notes or quote reference..."><?= htmlspecialchars($enquiry['admin_remark'] ?? ''); ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 fw-semibold" style="background-color: #04308c; border-color: #04308c;">
                                        Save Status & Remark
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- 3. Customer Details Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h4 class="card-title fs-16 fw-bold mb-0">Customer Details</h4>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="avatar-md rounded-circle bg-primary-subtle text-primary fw-bold fs-16 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <?= strtoupper(substr($enquiry['customer_name'] ?? 'C', 0, 1)); ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold fs-14 text-dark"><?= htmlspecialchars($enquiry['customer_name'] ?? 'Client'); ?></h6>
                                        <a href="mailto:<?= htmlspecialchars($enquiry['email'] ?? ''); ?>" class="link-primary fs-12 text-decoration-none">
                                            <?= htmlspecialchars($enquiry['email'] ?? '-'); ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="border-top pt-2 mt-2">
                                    <h6 class="fs-13 fw-semibold text-muted mb-1">Company / Studio</h6>
                                    <p class="fs-13 text-dark fw-medium mb-2"><?= htmlspecialchars($enquiry['company_name'] ?? '-'); ?></p>

                                    <h6 class="fs-13 fw-semibold text-muted mb-1">Contact Number</h6>
                                    <p class="fs-13 text-dark fw-medium mb-2">
                                        <a href="tel:<?= htmlspecialchars($enquiry['mobile'] ?? ''); ?>" class="text-dark text-decoration-none">
                                            <i class="bx bx-phone me-1 text-primary"></i> <?= htmlspecialchars($enquiry['mobile'] ?? '-'); ?>
                                        </a>
                                    </p>

                                    <h6 class="fs-13 fw-semibold text-muted mb-1">Site / Delivery Address</h6>
                                    <?php $addr = $enquiry['shipping_address'] ?? []; ?>
                                    <p class="fs-13 text-dark mb-0" style="line-height: 1.5;">
                                        <?= htmlspecialchars($addr['street'] ?? 'Plot 42, Commercial Hub'); ?>,<br>
                                        <?= htmlspecialchars($addr['city'] ?? 'Mumbai'); ?>, <?= htmlspecialchars($addr['state'] ?? 'Maharashtra'); ?> <?= htmlspecialchars($addr['zip'] ?? ''); ?>,<br>
                                        <?= htmlspecialchars($addr['country'] ?? 'India'); ?>
                                    </p>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
</body>
</html>
