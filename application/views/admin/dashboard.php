<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Admin Dashboard | TeknoLite Teknolite'; ?></title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- JsVectorMap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap/dist/css/jsvectormap.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- TeknoLite Admin Master Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/app.css'); ?>">

    <!-- Inline Enhancements for Exact Teknolite Visual Match -->
    <style>
        .fs-12 { font-size: 12px !important; }
        .fs-13 { font-size: 13px !important; }
        .fs-14 { font-size: 14px !important; }
        .fs-24 { font-size: 24px !important; }
        .fs-32 { font-size: 32px !important; }

        .Teknolite-order-img {
            width: 38px;
            height: 38px;
            min-width: 38px;
            max-width: 38px;
            border-radius: 6px;
            background-color: #0f172a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .Teknolite-order-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .map-marker-pin {
            position: absolute;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            color: #475569;
            pointer-events: none;
        }
        .map-marker-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #64748b;
            border: 1.5px solid #ffffff;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'dashboard']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'WELCOME!']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">

                <!-- Alert Notification Banner -->
                <div class="alert alert-warning border-0 mb-3 Teknolite-alert-trouble" role="alert">
                    We regret to inform you that our server is currently experiencing technical difficulties.
                </div>

                <!-- Top Row: 4 Metric Cards + Performance Chart -->
                <div class="row g-3">
                    <!-- Left: 4 Metric Cards in 2x2 Grid -->
                    <div class="col-xxl-5">
                        <div class="row g-3">
                            <!-- Card 1: Total Enquiries -->
                            <div class="col-md-6">
                                <div class="card overflow-hidden h-100 mb-0">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="avatar-md bg-soft-primary rounded">
                                                    <iconify-icon icon="solar:cart-5-bold-duotone" class="avatar-title fs-32 text-primary"></iconify-icon>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="text-muted mb-0 text-truncate fs-13 fw-medium">Total Enquiries</p>
                                                <h3 class="text-dark mt-1 mb-0 fw-bold"><?= number_format($total_enquiries ?? 0); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer py-2 bg-light bg-opacity-50">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="text-success fw-semibold"> <i class="bx bxs-up-arrow fs-12"></i> Active</span>
                                                <span class="text-muted ms-1 fs-12">Live Orders</span>
                                            </div>
                                            <a href="<?= base_url('admin/enquiries'); ?>" class="text-reset fw-semibold fs-12">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: New Leads -->
                            <div class="col-md-6">
                                <div class="card overflow-hidden h-100 mb-0">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="avatar-md bg-soft-primary rounded">
                                                    <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="text-muted mb-0 text-truncate fs-13 fw-medium">New Leads</p>
                                                <h3 class="text-dark mt-1 mb-0 fw-bold"><?= number_format($enquiry_stats['new'] ?? 0); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer py-2 bg-light bg-opacity-50">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="text-success fw-semibold"> <i class="bx bxs-up-arrow fs-12"></i> Action</span>
                                                <span class="text-muted ms-1 fs-12">Unprocessed</span>
                                            </div>
                                            <a href="<?= base_url('admin/enquiries?status=new'); ?>" class="text-reset fw-semibold fs-12">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Total Products -->
                            <div class="col-md-6">
                                <div class="card overflow-hidden h-100 mb-0">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="avatar-md bg-soft-primary rounded">
                                                    <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="text-muted mb-0 text-truncate fs-13 fw-medium">Products</p>
                                                <h3 class="text-dark mt-1 mb-0 fw-bold"><?= number_format($total_products ?? 0); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer py-2 bg-light bg-opacity-50">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="text-info fw-semibold"><?= number_format($total_categories ?? 0); ?> Categories</span>
                                            </div>
                                            <a href="<?= base_url('admin/productlist'); ?>" class="text-reset fw-semibold fs-12">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4: Registered Customers -->
                            <div class="col-md-6">
                                <div class="card overflow-hidden h-100 mb-0">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="avatar-md bg-soft-primary rounded">
                                                    <i class="bx bx-user-pin avatar-title text-primary fs-24"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="text-muted mb-0 text-truncate fs-13 fw-medium">Customers</p>
                                                <h3 class="text-dark mt-1 mb-0 fw-bold"><?= number_format($total_customers ?? 0); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer py-2 bg-light bg-opacity-50">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="text-success fw-semibold"><?= number_format($customer_stats['active'] ?? 0); ?> Active</span>
                                            </div>
                                            <a href="<?= base_url('admin/customers'); ?>" class="text-reset fw-semibold fs-12">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Performance Chart Card -->
                    <div class="col-xxl-7">
                        <div class="card h-100 mb-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Performance</h4>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                                    </div>
                                </div>

                                <div dir="ltr">
                                    <div id="dash-performance-chart" class="apex-charts" style="min-height: 310px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Row: Conversions, Sessions by Country, Top Pages -->
                <div class="row g-3 mt-1">
                    <!-- 1. Conversions -->
                    <div class="col-lg-4">
                        <div class="card h-100 mb-0">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title mb-2">Conversions</h5>
                                    <div id="conversions" class="apex-charts mb-2" style="min-height: 200px;"></div>
                                </div>
                                <div>
                                    <div class="row text-center my-3">
                                        <div class="col-6 border-end">
                                            <p class="text-muted mb-1 fs-13">This Week</p>
                                            <h3 class="text-dark mb-0 fw-bold">23.5k</h3>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-muted mb-1 fs-13">Last Week</p>
                                            <h3 class="text-dark mb-0 fw-bold">41.05k</h3>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-light shadow-none w-100 fw-semibold text-muted fs-13 py-2">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Sessions by Country -->
                    <div class="col-lg-4">
                        <div class="card h-100 mb-0">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title mb-2">Sessions by Country</h5>
                                    <div id="world-map-markers" style="height: 240px; width: 100%; position: relative;" class="my-2"></div>
                                </div>
                                <div class="row text-center mt-3 pt-2 border-top">
                                    <div class="col-6 border-end">
                                        <p class="text-muted mb-1 fs-13">This Week</p>
                                        <h3 class="text-dark mb-0 fw-bold">23.5k</h3>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-1 fs-13">Last Week</p>
                                        <h3 class="text-dark mb-0 fw-bold">41.05k</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Top Pages -->
                    <div class="col-lg-4">
                        <div class="card h-100 mb-0">
                            <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between gap-2 py-3 px-3">
                                <h5 class="card-title mb-0 flex-grow-1">Top Pages</h5>
                                <a href="<?= base_url('admin/productlist'); ?>" class="btn btn-sm btn-soft-primary">View All</a>
                            </div>
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table class="table table-hover table-nowrap table-centered m-0">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th class="text-muted ps-3">Page Path</th>
                                            <th class="text-muted text-center">Page Views</th>
                                            <th class="text-muted text-end pe-3">Exit Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/ecommerce.html</a></td>
                                            <td class="text-center font-monospace">465</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-success">4.4%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/dashboard.html</a></td>
                                            <td class="text-center font-monospace">426</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-danger">20.4%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/chat.html</a></td>
                                            <td class="text-center font-monospace">254</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-warning">12.25%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/auth-login.html</a></td>
                                            <td class="text-center font-monospace">3369</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-success">5.2%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/email.html</a></td>
                                            <td class="text-center font-monospace">985</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-danger">64.2%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/social.html</a></td>
                                            <td class="text-center font-monospace">653</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-success">2.4%</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3"><a href="#" class="text-muted text-decoration-none">Teknolite/blog.html</a></td>
                                            <td class="text-center font-monospace">478</td>
                                            <td class="text-end pe-3"><span class="badge badge-soft-danger">1.4%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row: Recent Orders -->
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-3 px-3 flex-wrap gap-2">
                                <h4 class="card-title mb-0">Recent Orders</h4>
                                <a href="<?= base_url('admin/productadd'); ?>" class="btn btn-sm btn-soft-primary">
                                    <i class="bx bx-plus me-1"></i> Create Order
                                </a>
                            </div>

                            <div class="table-responsive table-centered">
                                <table class="table mb-0 table-hover table-nowrap">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th class="ps-3">Order ID.</th>
                                            <th>Date</th>
                                            <th>Product</th>
                                            <th>Customer Name</th>
                                            <th>Email ID</th>
                                            <th>Phone No.</th>
                                            <th>Address</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recent_enquiries)): ?>
                                            <?php foreach ($recent_enquiries as $enq): ?>
                                                <?php 
                                                    $firstProduct = !empty($enq['products']) ? $enq['products'][0] : null;
                                                    $prodImg = !empty($firstProduct['image']) ? $firstProduct['image'] : 'assets/images/products/gamma.png';
                                                    $prodName = !empty($firstProduct['name']) ? $firstProduct['name'] : 'Lighting Fixture';
                                                    $statusClass = 'text-warning';
                                                    if ($enq['status'] === 'Confirmed' || $enq['status'] === 'Closed') {
                                                        $statusClass = 'text-success';
                                                    } else if ($enq['status'] === 'In Review') {
                                                        $statusClass = 'text-primary';
                                                    } else if ($enq['status'] === 'Quotation Sent') {
                                                        $statusClass = 'text-info';
                                                    }
                                                ?>
                                                <tr>
                                                    <td class="ps-3">
                                                        <a href="<?= base_url('admin/enquirydetail/' . $enq['id']); ?>" class="fw-semibold text-reset">
                                                            <?= htmlspecialchars($enq['reference']); ?>
                                                        </a>
                                                    </td>
                                                    <td><?= htmlspecialchars($enq['date_formatted'] ?? date('d M Y')); ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="Teknolite-order-img">
                                                                <img src="<?= base_url($prodImg); ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/products/gamma.png'); ?>';" alt="<?= htmlspecialchars($prodName); ?>">
                                                            </div>
                                                            <span class="fs-13 fw-medium text-truncate" style="max-width: 140px;"><?= htmlspecialchars($prodName); ?></span>
                                                        </div>
                                                    </td>
                                                    <td><span class="fw-medium"><?= htmlspecialchars($enq['customer_name'] ?? 'Website Client'); ?></span></td>
                                                    <td class="text-muted"><?= htmlspecialchars($enq['email'] ?? '-'); ?></td>
                                                    <td class="text-muted"><?= htmlspecialchars($enq['mobile'] ?? '-'); ?></td>
                                                    <td class="text-muted"><?= htmlspecialchars(($enq['shipping_address']['city'] ?? 'Mumbai') . ' / ' . ($enq['shipping_address']['state'] ?? 'MH')); ?></td>
                                                    <td>Direct Enquiry</td>
                                                    <td>
                                                        <span class="<?= $statusClass; ?> fw-medium"><i class="bx bxs-circle fs-10 me-1"></i> <?= htmlspecialchars($enq['status']); ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-muted">No recent orders or enquiries logged yet.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer border-top bg-transparent py-3">
                                <div class="row align-items-center g-3">
                                    <div class="col-sm">
                                        <div class="text-muted fs-13">
                                            Showing <span class="fw-semibold text-dark">5</span> of <span class="fw-semibold text-dark">90,521</span> orders
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <ul class="pagination pagination-sm m-0">
                                            <li class="page-item">
                                                <a href="javascript:void(0);" class="page-link"><i class="bx bx-left-arrow-alt"></i></a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="javascript:void(0);" class="page-link">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="javascript:void(0);" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="javascript:void(0);" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="javascript:void(0);" class="page-link"><i class="bx bx-right-arrow-alt"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Admin Footer -->
            <?php $this->load->view('admin/components/footer'); ?>
        </div>

        <!-- Theme Settings Offcanvas Drawer -->
        <?php $this->load->view('admin/components/theme-settings'); ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/js/jsvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world-merc.js"></script>

    <!-- Master Admin JS -->
    <script src="<?= base_url('assets/admin/app.js'); ?>"></script>

    <!-- Dashboard Charts & Map Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Performance Chart (Mixed Bar & Line)
            var perfEl = document.querySelector("#dash-performance-chart");
            if (perfEl && window.ApexCharts) {
                var perfOptions = {
                    series: [{
                        name: 'Page Views',
                        type: 'column',
                        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
                    }, {
                        name: 'Clicks',
                        type: 'line',
                        data: [9, 13, 8, 20, 24, 16, 7, 9, 9, 27, 12, 34]
                    }],
                    chart: {
                        height: 312,
                        type: 'line',
                        toolbar: { show: false }
                    },
                    stroke: {
                        width: [0, 2.5],
                        curve: 'smooth'
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '28%',
                            borderRadius: 4
                        }
                    },
                    fill: {
                        opacity: [0.85, 1],
                    },
                    colors: ['#04308c', '#10b981'],
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    markers: {
                        size: [0, 4],
                        strokeColors: '#ffffff',
                        strokeWidth: 2,
                        hover: { size: 6 }
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        markers: { radius: 12 }
                    },
                    grid: {
                        borderColor: '#f1f3f7',
                        strokeDashArray: 3
                    },
                    xaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false }
                    },
                    yaxis: [{
                        min: 0,
                        max: 80,
                        tickAmount: 8
                    }, {
                        opposite: true,
                        show: false
                    }]
                };
                var perfChart = new ApexCharts(perfEl, perfOptions);
                perfChart.render();
            }

            // 2. Conversions Radial Gauge Chart
            var convEl = document.querySelector("#conversions");
            if (convEl && window.ApexCharts) {
                var convOptions = {
                    chart: {
                        height: 200,
                        type: 'radialBar',
                        sparkline: { enabled: true }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 135,
                            hollow: {
                                margin: 0,
                                size: '70%',
                            },
                            track: {
                                background: '#f1f3f7',
                                strokeWidth: '100%',
                            },
                            dataLabels: {
                                name: {
                                    show: true,
                                    fontSize: '13px',
                                    fontWeight: 500,
                                    color: '#6c757d',
                                    offsetY: 20
                                },
                                value: {
                                    offsetY: -15,
                                    fontSize: '24px',
                                    fontWeight: 700,
                                    color: '#212529',
                                    formatter: function (val) {
                                        return val + '%';
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        colors: ['#04308c'],
                    },
                    stroke: {
                        dashArray: 3
                    },
                    series: [65.2],
                    labels: ['Returning Customer'],
                };
                var convChart = new ApexCharts(convEl, convOptions);
                convChart.render();
            }

            // 3. Sessions by Country Map
            var mapEl = document.getElementById('world-map-markers');
            if (mapEl) {
                if (window.jsVectorMap) {
                    try {
                        new jsVectorMap({
                            selector: '#world-map-markers',
                            map: 'world_merc',
                            zoomButtons: false,
                            markers: [
                                { name: 'Canada', coords: [56.1304, -106.3468] },
                                { name: 'United States', coords: [37.0902, -95.7129] },
                                { name: 'Brazil', coords: [-14.2350, -51.9253] },
                                { name: 'Russia', coords: [61.5240, 105.3188] },
                                { name: 'China', coords: [35.8617, 104.1954] }
                            ],
                            markerStyle: {
                                initial: {
                                    fill: '#495057',
                                    stroke: '#ffffff',
                                    strokeWidth: 2,
                                    r: 5
                                },
                                hover: {
                                    fill: '#04308c'
                                }
                            },
                            regionStyle: {
                                initial: {
                                    fill: '#e9ecef',
                                    fillOpacity: 1,
                                    stroke: 'none'
                                }
                            }
                        });
                    } catch (e) {
                        fallbackWorldMap(mapEl);
                    }
                } else {
                    fallbackWorldMap(mapEl);
                }
            }

            function fallbackWorldMap(container) {
                container.innerHTML = `
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; position: relative; background: #f8fafc; border-radius: 8px;">
                        <svg viewBox="0 0 1000 500" style="width: 100%; height: 100%; opacity: 0.28; fill: #64748b;">
                            <path d="M150,120 Q180,90 220,110 T280,140 Q240,200 200,240 T150,180 Z" />
                            <path d="M220,260 Q260,250 280,300 T260,420 Q210,380 200,320 Z" />
                            <path d="M480,110 Q540,80 600,100 T650,160 Q580,200 520,180 Z" />
                            <path d="M490,200 Q560,190 580,260 T560,380 Q500,340 480,260 Z" />
                            <path d="M660,100 Q800,80 880,120 T850,260 Q750,280 680,220 Z" />
                            <path d="M750,330 Q820,320 860,360 T820,440 Q750,420 740,360 Z" />
                        </svg>
                        <div class="map-marker-pin" style="top: 25%; left: 24%;">
                            <span class="map-marker-dot"></span> Canada
                        </div>
                        <div class="map-marker-pin" style="top: 38%; left: 26%;">
                            <span class="map-marker-dot"></span> United States
                        </div>
                        <div class="map-marker-pin" style="top: 68%; left: 36%;">
                            <span class="map-marker-dot"></span> Brazil
                        </div>
                        <div class="map-marker-pin" style="top: 22%; left: 72%;">
                            <span class="map-marker-dot"></span> Russia
                        </div>
                        <div class="map-marker-pin" style="top: 40%; left: 76%;">
                            <span class="map-marker-dot"></span> China
                        </div>
                    </div>
                `;
            }
        });
    </script>
</body>
</html>
