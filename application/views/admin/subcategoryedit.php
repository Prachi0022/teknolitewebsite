<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Edit Subcategory | Teknolite Admin'; ?></title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

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

        .subcategory-preview-box {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 1rem;
            border: 1px solid #eef2f6;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        [data-bs-theme="dark"] .subcategory-preview-box {
            background-color: #0f172a;
            border-color: #334155;
        }

        .action-bar-container {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 14px 18px;
            border: 1px solid #e2e8f0;
        }

        [data-bs-theme="dark"] .action-bar-container {
            background-color: #1e293b;
            border-color: #334155;
        }

        .form-control, .form-select {
            border-color: #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #04308c;
            box-shadow: 0 0 0 0.15rem rgba(4, 48, 140, 0.2);
        }

        .admin-footer {
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <!-- Left Sidebar Navigation (Kept identical to Dashboard) -->
        <?php $this->load->view('admin/components/sidebar', ['current_page' => 'subcategoryedit']); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main-wrapper">
            <!-- Topbar Header -->
            <?php $this->load->view('admin/components/header', ['topbar_title' => 'EDIT SUBCATEGORY']); ?>

            <!-- Page Content -->
            <main class="admin-page-content py-3 px-3 px-md-4">
                <?php 
                    $subId = $subcategory['id'] ?? '';
                    $subName = $subcategory['name'] ?? '';
                    $subCatId = $subcategory['category_id'] ?? '';
                    $subCatName = $subcategory['category_name'] ?? 'Category';
                    $subTag = $subcategory['tag_id'] ?? '';
                    $subOrder = $subcategory['display_order'] ?? 1;
                    $subStatus = $subcategory['status'] ?? 'active';
                    $subDesc = $subcategory['description'] ?? '';
                ?>
                <form id="subcategoryEditForm" method="post" action="<?= base_url('admin/subcategoryedit/' . $subId); ?>">
                    <div class="row g-3">

                        <!-- Right Column: Edit Form -->
                        <div class="col-xl-8 col-lg-8">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-transparent border-bottom py-3 px-3">
                                    <h4 class="card-title fs-15 fw-bold mb-0 text-dark">Edit Subcategory Information</h4>
                                </div>
                                <div class="card-body p-3 p-md-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="subcat-title" class="form-label fs-13 fw-semibold text-dark">Subcategory Name <span class="text-danger">*</span></label>
                                                <input type="text" id="subcat-title" name="name" class="form-control" value="<?= htmlspecialchars($subName); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div>
                                                <label for="parent-cat" class="form-label fs-13 fw-semibold text-dark">Parent Category <span class="text-danger">*</span></label>
                                                <select class="form-select" id="parent-cat" name="category_id" required>
                                                    <?php if (!empty($all_categories)): ?>
                                                        <?php foreach ($all_categories as $pCat): ?>
                                                            <option value="<?= htmlspecialchars($pCat['id']); ?>" 
                                                                    data-name="<?= htmlspecialchars($pCat['name']); ?>"
                                                                    <?= ($subCatId === $pCat['id'] || strtolower($subCatName) === strtolower($pCat['name'])) ? 'selected' : ''; ?>>
                                                                <?= htmlspecialchars($pCat['name']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="subcat-tag" class="form-label fs-13 fw-semibold text-dark">Tag ID</label>
                                                <input type="text" id="subcat-tag" name="tag_id" class="form-control" value="<?= htmlspecialchars($subTag); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="subcat-order" class="form-label fs-13 fw-semibold text-dark">Display Order</label>
                                                <input type="number" id="subcat-order" name="display_order" class="form-control" value="<?= $subOrder; ?>" min="1">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="subcat-status" class="form-label fs-13 fw-semibold text-dark">Status</label>
                                                <select class="form-select" id="subcat-status" name="status">
                                                    <option value="active" <?= ($subStatus === 'active') ? 'selected' : ''; ?>>Active</option>
                                                    <option value="inactive" <?= ($subStatus === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div>
                                                <label for="subcat-desc" class="form-label fs-13 fw-semibold text-dark">Description</label>
                                                <textarea class="form-control bg-light-subtle" id="subcat-desc" name="description" rows="5" placeholder="Architectural mounting or fixture characteristics..."><?= htmlspecialchars($subDesc); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div class="action-bar-container mb-4">
                                <div class="row justify-content-end g-2">
                                    <div class="col-sm-4 col-md-3 col-6">
                                        <button type="submit" class="btn btn-outline-secondary w-100 fs-13 py-2 fw-semibold text-nowrap">
                                            Save Changes
                                        </button>
                                    </div>
                                    <div class="col-sm-3 col-md-2 col-6">
                                        <a href="<?= base_url('admin/subcategories'); ?>" class="btn btn-primary w-100 fs-13 py-2 fw-semibold text-nowrap" style="background-color: #04308c; border-color: #04308c;">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </main>

            <!-- Teknolite Admin Footer -->
            <footer class="admin-footer text-center py-3 text-muted border-top mt-auto">
                <div class="container-fluid">
                    2026 &copy; Teknolite. Crafted by <span class="text-danger">&#10084;</span> <strong class="text-dark">Techzaa</strong>
                </div>
            </footer>
        </div>
    </div>

    <!-- Theme Settings Offcanvas Drawer -->
    <?php $this->load->view('admin/components/theme-settings'); ?>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('subcat-title');
        const parentSelect = document.getElementById('parent-cat');
        const tagInput = document.getElementById('subcat-tag');
        const orderInput = document.getElementById('subcat-order');

        const previewTitle = document.getElementById('previewSubName');
        const previewParent = document.getElementById('previewParentCat');
        const previewTag = document.getElementById('previewSubTag');
        const previewOrder = document.getElementById('previewSubOrder');

        if (titleInput && previewTitle) {
            titleInput.addEventListener('input', function() {
                previewTitle.textContent = this.value.trim() || "Subcategory Name";
            });
        }

        if (parentSelect && previewParent) {
            parentSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                const catName = opt ? (opt.dataset.name || opt.text) : "Category";
                previewParent.textContent = "Parent: " + catName;
            });
        }

        if (tagInput && previewTag) {
            tagInput.addEventListener('input', function() {
                previewTag.textContent = this.value.trim() || "#SUB-AUTO";
            });
        }

        if (orderInput && previewOrder) {
            orderInput.addEventListener('input', function() {
                previewOrder.textContent = "#" + (this.value || "1");
            });
        }
    });
    </script>
</body>
</html>
