<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Customer Profile | Teknolite Admin'; ?></title>

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
        .fs-24 { font-size: 24px !important; }

        .customer-avatar-box {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background-color: rgba(4, 48, 140, 0.12);
            color: #04308c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-mini-box {
            padding: 16px;
            border-radius: 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
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
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'CUSTOMER PROFILE']); ?>

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
                    $isActive = (strtolower($customer['status'] ?? 'active') === 'active');
                    $firstLetter = strtoupper(substr($customer['name'] ?? 'C', 0, 1));
                    
                    // Compute stats from enquiries
                    $totalEnqCount = count($enquiries ?? []);
                    $confirmedCount = 0;
                    $totalQuotedValue = 0;
                    foreach ($enquiries ?? [] as $e) {
                        if (($e['status'] ?? '') === 'Confirmed' || ($e['status'] ?? '') === 'Closed') {
                            $confirmedCount++;
                        }
                        $totalQuotedValue += (float)($e['financials']['total_amount'] ?? 0);
                    }
                ?>

                <!-- Top Profile Banner Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <?php if (!empty($customer['avatar'])): ?>
                                    <img src="<?= htmlspecialchars($customer['avatar_url'] ?? base_url($customer['avatar'])); ?>" alt="<?= htmlspecialchars($customer['name'] ?? 'Customer'); ?>" class="rounded-circle object-fit-cover shadow-sm border" style="width: 76px; height: 76px;" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'customer-avatar-box\'><?= $firstLetter; ?></div>';">
                                <?php else: ?>
                                    <div class="customer-avatar-box">
                                        <?= $firstLetter; ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h4 class="fw-bold text-dark mb-1 fs-20 d-flex align-items-center gap-2">
                                        <?= htmlspecialchars($customer['name'] ?? 'Customer'); ?>
                                        <span class="badge <?= $isActive ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary'; ?> px-2 py-1 fs-12 rounded">
                                            <?= $isActive ? 'Active Account' : 'Inactive Account'; ?>
                                        </span>
                                    </h4>
                                    <p class="text-muted mb-1 fs-14">
                                        <i class="bx bx-buildings me-1 text-primary"></i> <?= htmlspecialchars($customer['company'] ?? 'Individual Client'); ?> &bull; 
                                        <span>ID: <strong><?= htmlspecialchars($customer['id']); ?></strong></span>
                                    </p>
                                    <small class="text-muted fs-12">
                                        Member since <?= htmlspecialchars($customer['date_formatted'] ?? date('M d, Y', strtotime($customer['registered_at'] ?? 'now'))); ?>
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="<?= base_url('admin/customers'); ?>" class="btn btn-sm btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Customers
                                </a>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal" style="background-color: #04308c; border-color: #04308c;">
                                    <i class="bx bx-edit me-1"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column: Customer & Business Details (col-xl-4 col-lg-5) -->
                    <div class="col-xl-4 col-lg-5">
                        
                        <!-- Personal & Business Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h5 class="card-title fs-15 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                    <iconify-icon icon="solar:user-circle-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                    Customer Details
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-3">
                                    <small class="text-muted d-block fs-12 fw-semibold text-uppercase">Email Address</small>
                                    <a href="mailto:<?= htmlspecialchars($customer['email'] ?? ''); ?>" class="link-primary fw-medium fs-14 text-decoration-none">
                                        <?= htmlspecialchars($customer['email'] ?? '-'); ?>
                                    </a>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block fs-12 fw-semibold text-uppercase">Mobile Number</small>
                                    <a href="tel:<?= htmlspecialchars($customer['mobile'] ?? ''); ?>" class="text-dark fw-medium fs-14 text-decoration-none">
                                        <?= htmlspecialchars($customer['mobile'] ?? '-'); ?>
                                    </a>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block fs-12 fw-semibold text-uppercase">Company / Studio</small>
                                    <span class="text-dark fw-medium fs-14">
                                        <?= htmlspecialchars($customer['company'] ?? 'Individual Client'); ?>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block fs-12 fw-semibold text-uppercase">GST Number</small>
                                    <?php if (!empty($customer['gst_number'])): ?>
                                        <span class="badge bg-light text-dark border font-monospace fs-13 px-2 py-1">
                                            <?= htmlspecialchars($customer['gst_number']); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted fs-13">Not Applicable / Unregistered</span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <small class="text-muted d-block fs-12 fw-semibold text-uppercase">Account Status</small>
                                    <a href="<?= base_url('admin/customerstatus/' . $customer['id']); ?>" class="badge <?= $isActive ? 'bg-success text-white' : 'bg-secondary text-white'; ?> px-2 py-1 fs-12 text-decoration-none mt-1">
                                        <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i>
                                        <?= $isActive ? 'Active (Click to Deactivate)' : 'Inactive (Click to Activate)'; ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Address & Location Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3">
                                <h5 class="card-title fs-15 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                    <iconify-icon icon="solar:map-point-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                    Billing & Project Address
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <p class="fs-14 text-dark mb-2" style="line-height: 1.6;">
                                    <strong><?= htmlspecialchars($customer['name']); ?></strong><br>
                                    <?= htmlspecialchars($customer['address'] ?? 'Project Site / Commercial Office'); ?><br>
                                    <?= htmlspecialchars($customer['city'] ?? 'Mumbai'); ?>, <?= htmlspecialchars($customer['state'] ?? 'Maharashtra'); ?> &bull; <strong>PIN: <?= htmlspecialchars($customer['pincode'] ?? '400001'); ?></strong><br>
                                    <?= htmlspecialchars($customer['country'] ?? 'India'); ?>
                                </p>
                                <div class="mt-3 rounded overflow-hidden border">
                                    <?php $mapCity = urlencode(($customer['city'] ?? 'Mumbai') . ', India'); ?>
                                    <iframe width="100%" height="180" frameborder="0" scrolling="no" src="https://maps.google.com/maps?q=<?= $mapCity; ?>&t=&z=13&ie=UTF8&iwloc=B&output=embed" style="border:0; display:block;"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Stats & Enquiry History (col-xl-8 col-lg-7) -->
                    <div class="col-xl-8 col-lg-7">
                        
                        <!-- Customer Stats Row -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="stat-mini-box">
                                    <small class="text-muted fs-12 fw-semibold text-uppercase">Total Enquiries</small>
                                    <h3 class="fw-bold text-dark mb-0 fs-24"><?= $totalEnqCount; ?></h3>
                                    <small class="text-primary fs-12">Product RFQs submitted</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-mini-box">
                                    <small class="text-muted fs-12 fw-semibold text-uppercase">Confirmed Orders</small>
                                    <h3 class="fw-bold text-success mb-0 fs-24"><?= $confirmedCount; ?></h3>
                                    <small class="text-muted fs-12">Closed / in production</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-mini-box">
                                    <small class="text-muted fs-12 fw-semibold text-uppercase">Total Quoted Value</small>
                                    <h3 class="fw-bold text-dark mb-0 fs-24">₹<?= number_format($totalQuotedValue, 2); ?></h3>
                                    <small class="text-muted fs-12">Estimated volume</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-mini-box">
                                    <small class="text-muted fs-12 fw-semibold text-uppercase">Saved in Wishlist</small>
                                    <h3 class="fw-bold text-danger mb-0 fs-24"><?= count($wishlist ?? []); ?></h3>
                                    <small class="text-danger fs-12">Active saved products</small>
                                </div>
                            </div>
                        </div>

                        <!-- Enquiry History Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="card-title fs-16 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:history-bold-duotone" class="text-primary fs-20"></iconify-icon>
                                        Customer Enquiry & Quotation History
                                    </h5>
                                    <small class="text-muted">Track all enquiries, requests for quotation, and order conversions from this client.</small>
                                </div>
                                <span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">
                                    <?= $totalEnqCount; ?> Record(s)
                                </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered table-nowrap">
                                        <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                            <tr>
                                                <th class="ps-3">Enquiry Reference</th>
                                                <th>Date</th>
                                                <th>Fixtures / Items</th>
                                                <th>Estimated Amount</th>
                                                <th>Status</th>
                                                <th class="text-end pe-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($enquiries)): ?>
                                                <?php foreach ($enquiries as $enq): 
                                                    $eStatus = $enq['status'] ?? 'New';
                                                    $eBadge = 'border border-secondary text-secondary';
                                                    if ($eStatus === 'New') $eBadge = 'border border-secondary text-secondary';
                                                    else if ($eStatus === 'In Review') $eBadge = 'border border-warning text-warning';
                                                    else if ($eStatus === 'Quotation Sent') $eBadge = 'border border-primary text-primary';
                                                    else if ($eStatus === 'Confirmed') $eBadge = 'border border-success text-success';
                                                    else if ($eStatus === 'Closed') $eBadge = 'border border-dark text-dark';

                                                    $eTotal = $enq['financials']['total_amount'] ?? 0;
                                                    $firstProduct = !empty($enq['products']) ? $enq['products'][0] : null;
                                                ?>
                                                    <tr>
                                                        <td class="ps-3">
                                                            <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="fw-semibold text-primary text-decoration-none">
                                                                <?= htmlspecialchars($enq['reference'] ?? ('#' . $enq['id'])); ?>
                                                            </a>
                                                        </td>
                                                        <td class="fs-13 text-muted">
                                                            <?= htmlspecialchars($enq['date_formatted'] ?? date('M d, Y', strtotime($enq['created_at'] ?? 'now'))); ?>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium text-dark fs-13"><?= (int)($enq['total_quantity'] ?? 1); ?> Fixtures</span>
                                                            <?php if ($firstProduct): ?>
                                                                <small class="d-block text-muted fs-12"><?= htmlspecialchars(mb_strimwidth($firstProduct['name'] ?? '', 0, 22, '...')); ?></small>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <span class="fw-bold text-dark fs-14">₹<?= number_format($eTotal, 2); ?></span>
                                                        </td>
                                                        <td>
                                                            <span class="badge <?= $eBadge; ?> px-2 py-1 fs-12">
                                                                <?= htmlspecialchars($eStatus); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-3">
                                                            <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="btn btn-light btn-sm" title="View Full Enquiry Details">
                                                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center py-5 text-muted">
                                                        <i class="bx bx-inbox fs-36 d-block mb-2 text-secondary"></i>
                                                        <h6 class="fs-14 fw-semibold">No enquiry history found</h6>
                                                        <p class="fs-12 mb-0">This customer has not submitted any product enquiries or quotation requests yet.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Saved Wishlist Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="card-title fs-16 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:heart-bold-duotone" class="text-danger fs-20"></iconify-icon>
                                        Customer Saved Wishlist
                                    </h5>
                                    <small class="text-muted">Architectural fixtures and lighting products saved by this customer in real time.</small>
                                </div>
                                <span class="badge bg-danger-subtle text-danger fs-12 px-2 py-1">
                                    <?= count($wishlist ?? []); ?> Saved Product(s)
                                </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered table-nowrap">
                                        <thead class="bg-light-subtle" style="background-color: #f8fafc;">
                                            <tr>
                                                <th class="ps-3">Product</th>
                                                <th>Category</th>
                                                <th>Product ID</th>
                                                <th class="text-end pe-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($wishlist)): ?>
                                                <?php foreach ($wishlist as $wItem): 
                                                    $wImg = !empty($wItem['image']) ? $wItem['image'] : 'assets/images/products/gamma.png';
                                                    if (strpos($wImg, 'http://') !== 0 && strpos($wImg, 'https://') !== 0) {
                                                        $wImg = base_url($wImg);
                                                    }
                                                ?>
                                                    <tr>
                                                        <td class="ps-3">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <img src="<?= htmlspecialchars($wImg); ?>" alt="<?= htmlspecialchars($wItem['name']); ?>" class="rounded border object-fit-cover" style="width: 44px; height: 44px;">
                                                                <div>
                                                                    <h6 class="fs-14 fw-semibold mb-0 text-dark"><?= htmlspecialchars($wItem['name']); ?></h6>
                                                                    <small class="text-muted"><?= htmlspecialchars($wItem['id'] ?? ''); ?></small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="fs-13 text-muted">
                                                            <span class="badge bg-light text-secondary border px-2 py-1">
                                                                <?= htmlspecialchars($wItem['category_label'] ?? ($wItem['category'] ?? 'Lighting')); ?>
                                                            </span>
                                                        </td>
                                                        <td class="fs-13 font-monospace text-muted">
                                                            <?= htmlspecialchars($wItem['id'] ?? '—'); ?>
                                                        </td>
                                                        <td class="text-end pe-3">
                                                            <a href="<?= base_url($wItem['url'] ?? 'productdetail'); ?>" target="_blank" class="btn btn-light btn-sm" title="View Product on Website">
                                                                <iconify-icon icon="solar:square-top-down-broken" class="align-middle fs-16 me-1"></iconify-icon> View Product
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center py-5 text-muted">
                                                        <i class="bx bx-heart fs-36 d-block mb-2 text-danger-emphasis" style="opacity: 0.5;"></i>
                                                        <h6 class="fs-14 fw-semibold">Wishlist is empty</h6>
                                                        <p class="fs-12 mb-0">This customer has not saved any products to their wishlist yet.</p>
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

            <!-- Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>
    </div>

    <!-- Edit Customer Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <form action="<?= base_url('admin/customerupdate'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($customer['id']); ?>">
                    <input type="hidden" name="redirect_to" value="admin/customerprofile/<?= htmlspecialchars($customer['id']); ?>">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fs-16 fw-bold">Edit Customer Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Customer Full Name *</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($customer['name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Email Address *</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['email'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Mobile Number *</label>
                                <input type="text" name="mobile" class="form-control" value="<?= htmlspecialchars($customer['mobile'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Company / Firm Name</label>
                                <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($customer['company'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Customer Avatar / Photo</label>
                                <input type="file" name="avatar" class="form-control" accept="image/*">
                                <small class="text-muted fs-11">Upload a new image to change avatar</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                <small class="text-muted fs-11">Min 6 characters. Leave blank to keep unchanged.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">GST Number</label>
                                <input type="text" name="gst_number" class="form-control" value="<?= htmlspecialchars($customer['gst_number'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-13 fw-semibold">Account Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" <?= ($isActive) ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?= (!$isActive) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-13 fw-semibold">Street Address</label>
                                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($customer['address'] ?? ''); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">City</label>
                                <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($customer['city'] ?? ''); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">State</label>
                                <input type="text" name="state" class="form-control" value="<?= htmlspecialchars($customer['state'] ?? ''); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-13 fw-semibold">PIN Code</label>
                                <input type="text" name="pincode" class="form-control" value="<?= htmlspecialchars($customer['pincode'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #04308c; border-color: #04308c;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>
</body>
</html>
