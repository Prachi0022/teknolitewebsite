<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'security', 'form', 'cookie']);
        $this->load->library(['session', 'form_validation']);
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Subcategory_model', 'subcategory_model');
        $this->load->model('Enquiry_model', 'enquiry_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('Settings_model', 'settings_model');
        $this->load->model('Casestudy_model', 'casestudy_model');
        $this->load->model('Branch_model', 'branch_model');
        $this->load->model('Blog_model', 'blog_model');
        $this->load->model('Admin_auth_model', 'admin_auth_model');

        // Global Authentication Guard: all methods require login except public auth methods
        $currentMethod = $this->router->fetch_method();
        if (!in_array($currentMethod, ['login', 'logout'])) {
            $this->_check_auth();
        }
    }

    /**
     * Check authentication status and enforce security headers
     */
    private function _check_auth()
    {
        $isLoggedIn = (bool)$this->session->userdata('admin_logged_in');

        // Check for persistent "Remember Me" cookie if session is not active
        if (!$isLoggedIn) {
            $rememberToken = get_cookie('teknolite_admin_remember');
            if (!empty($rememberToken)) {
                $admin = $this->admin_auth_model->verifyRememberToken($rememberToken);
                if ($admin) {
                    $this->session->set_userdata([
                        'admin_logged_in' => TRUE,
                        'admin_user' => $admin,
                        'admin_last_activity' => time()
                    ]);
                    $isLoggedIn = TRUE;
                }
            }
        }

        // If still unauthenticated, redirect to login
        if (!$isLoggedIn) {
            // Save requested URL for post-login redirect
            $currentUrl = current_url();
            $queryStr = $this->input->server('QUERY_STRING');
            if (!empty($queryStr)) {
                $currentUrl .= '?' . $queryStr;
            }
            $this->session->set_userdata('admin_redirect_url', $currentUrl);

            $this->session->set_flashdata('error', 'Please sign in to access the admin panel.');
            redirect('admin/login');
            exit;
        }

        // Session timeout handling (auto-logout after 2 hours / 7200 seconds of inactivity)
        $lastActivity = (int)$this->session->userdata('admin_last_activity');
        if ($lastActivity > 0 && (time() - $lastActivity > 7200)) {
            $this->logout('Your session has expired due to inactivity. Please log in again.');
            exit;
        }

        // Refresh last activity timestamp
        $this->session->set_userdata('admin_last_activity', time());

        // Security: Prevent browser back-button cache access on all authenticated admin pages
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    }

    /**
     * Admin Login Page & Authentication Handler
     */
    public function login()
    {
        // If already logged in, redirect straight to dashboard
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('identity', 'Username or Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $identity = trim($this->input->post('identity', TRUE));
                $password = (string)$this->input->post('password');
                $remember = (bool)$this->input->post('remember_me');

                $result = $this->admin_auth_model->verifyCredentials($identity, $password);

                if ($result['success']) {
                    // Regenerate session via CodeIgniter Session driver safely without dropping data
                    if (method_exists($this->session, 'sess_regenerate')) {
                        $this->session->sess_regenerate(FALSE);
                    }

                    // Set authenticated session data
                    $this->session->set_userdata([
                        'admin_logged_in' => TRUE,
                        'admin_user' => $result['admin'],
                        'admin_last_activity' => time()
                    ]);

                    // Set Remember Me cookie if selected (30 days validity)
                    if ($remember) {
                        $token = $this->admin_auth_model->generateRememberToken($result['admin']['id']);
                        if ($token) {
                            set_cookie([
                                'name' => 'teknolite_admin_remember',
                                'value' => $token,
                                'expire' => 2592000,
                                'path' => '/',
                                'secure' => FALSE,
                                'httponly' => TRUE
                            ]);
                        }
                    }

                    $this->session->set_flashdata('success', 'Welcome back, ' . html_escape($result['admin']['name']) . '!');

                    // Redirect to intended URL or dashboard
                    $redirectUrl = $this->session->userdata('admin_redirect_url');
                    $this->session->unset_userdata('admin_redirect_url');

                    if (!empty($redirectUrl) && strpos($redirectUrl, 'admin/login') === false && strpos($redirectUrl, base_url()) !== false) {
                        redirect($redirectUrl);
                    } else {
                        redirect('admin/dashboard');
                    }
                    return;
                } else {
                    $this->session->set_flashdata('error', $result['message']);
                }
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please enter your username/email and password.');
            }
        }

        $logoutNotice = '';
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['admin_logout_notice'])) {
            $logoutNotice = $_SESSION['admin_logout_notice'];
            unset($_SESSION['admin_logout_notice']);
        } elseif (isset($_SESSION['admin_logout_notice'])) {
            $logoutNotice = $_SESSION['admin_logout_notice'];
            unset($_SESSION['admin_logout_notice']);
        }

        $data = [
            'page_title' => 'Sign In | TeknoLite Admin Portal',
            'logout_notice' => $logoutNotice
        ];

        $this->load->view('admin/login', $data);
    }

    /**
     * Admin Logout Handler
     */
    public function logout($customMessage = null)
    {
        // Remove remember me cookie
        delete_cookie('teknolite_admin_remember');

        // Clear and destroy session
        $this->session->unset_userdata(['admin_logged_in', 'admin_user', 'admin_last_activity', 'admin_redirect_url']);
        $this->session->sess_destroy();

        // Start fresh flash session if needed
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['admin_logout_notice'] = $customMessage ?: 'You have been logged out successfully.';

        // Prevent caching on logout redirect
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

        redirect('admin/login');
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $products = $this->product_model->getAll();
        $enquiries = $this->enquiry_model->getAll();
        $customers = $this->customer_model->getAll();
        $categories = $this->category_model->getAll();
        $subcategories = $this->subcategory_model->getAll();
        $caseStudies = $this->casestudy_model->getAll();

        $enquiryStats = $this->enquiry_model->getStats();
        $customerStats = $this->customer_model->getStats();

        $recentEnquiries = array_slice($enquiries, 0, 7);

        $data = [
            'page_title' => 'Admin Dashboard | TeknoLite Larkon',
            'current_page' => 'dashboard',
            'total_products' => count($products),
            'total_enquiries' => count($enquiries),
            'total_customers' => count($customers),
            'total_categories' => count($categories),
            'total_subcategories' => count($subcategories),
            'total_casestudies' => count($caseStudies),
            'enquiry_stats' => $enquiryStats,
            'customer_stats' => $customerStats,
            'recent_enquiries' => $recentEnquiries
        ];
        $this->load->view('admin/dashboard', $data);
    }

    /**
     * Categories List Page (Search, Pagination, Metrics)
     */
    public function categorie()
    {
        $filter = [];
        $search = trim($this->input->get('search', TRUE) ?? '');
        if ($search !== '') {
            $filter['search'] = $search;
        }

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 8;
        $paginated = $this->category_model->getPaginated($page, $perPage, $filter);

        // Top 4 highlight cards - active categories
        $allActive = $this->category_model->getAll(['status' => 'active']);
        $topCategories = array_slice($allActive, 0, 4);

        $data = [
            'page_title' => 'Categories List | Larkon Admin',
            'current_page' => 'categorie',
            'categories' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'top_categories' => $topCategories,
            'all_count' => count($this->category_model->getAll()),
            'active_count' => count($allActive)
        ];
        $this->load->view('admin/categorie', $data);
    }

    public function categories()
    {
        $this->categorie();
    }

    public function category()
    {
        $this->categorie();
    }

    /**
     * Category Add / Create Page (GET & POST)
     */
    public function categoriesadd()
    {
        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);

            // Handle image upload if provided
            $uploadedImg = $this->_handle_upload('category_thumb', 'uploads/categories/');
            if ($uploadedImg) {
                $postData['image'] = $uploadedImg;
            } else if (!empty($postData['selected_preset_img'])) {
                $postData['image'] = $postData['selected_preset_img'];
            } else if (empty($postData['image'])) {
                $postData['image'] = 'assets/images/products/gamma.png';
            }

            $newSlug = $this->category_model->create($postData);
            $this->session->set_flashdata('success', 'Category "' . htmlspecialchars($postData['name'] ?? 'New Category') . '" created successfully!');
            redirect('admin/categorie');
            return;
        }

        $data = [
            'page_title' => 'Create Category | Larkon Admin',
            'current_page' => 'categoriesadd'
        ];
        $this->load->view('admin/categoriesadd', $data);
    }

    public function categoryadd()
    {
        $this->categoriesadd();
    }

    public function categorieadd()
    {
        $this->categoriesadd();
    }

    /**
     * Category Edit Page (GET & POST)
     */
    public function categorieedit($id = null)
    {
        $all = $this->category_model->getAll();
        if (empty($id)) {
            $keys = array_keys($all);
            $id = reset($keys);
        }

        $category = $this->category_model->getById($id);
        if (!$category) {
            $this->session->set_flashdata('error', 'Category not found.');
            redirect('admin/categorie');
            return;
        }

        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);

            // Handle image upload if provided
            $uploadedImg = $this->_handle_upload('category_thumb', 'uploads/categories/');
            if ($uploadedImg) {
                $postData['image'] = $uploadedImg;
            } else if (!empty($postData['selected_preset_img'])) {
                $postData['image'] = $postData['selected_preset_img'];
            }

            $this->category_model->update($id, $postData);
            $this->session->set_flashdata('success', 'Category "' . htmlspecialchars($category['name']) . '" updated successfully!');
            redirect('admin/categorie');
            return;
        }

        $data = [
            'page_title' => 'Category Edit | Larkon Admin',
            'current_page' => 'categorieedit',
            'category' => $category
        ];
        $this->load->view('admin/categorieedit', $data);
    }

    public function categoryedit($id = null)
    {
        $this->categorieedit($id);
    }

    /**
     * Delete Category
     */
    public function categoriedelete($id = null)
    {
        if (empty($id)) {
            redirect('admin/categorie');
            return;
        }

        $category = $this->category_model->getById($id);
        if ($category) {
            $this->category_model->delete($id);
            $this->session->set_flashdata('success', 'Category "' . htmlspecialchars($category['name']) . '" deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Category not found.');
        }

        redirect('admin/categorie');
    }

    /**
     * Toggle Category Status (AJAX & Redirect)
     */
    public function categorystatus($id = null)
    {
        if (empty($id)) {
            redirect('admin/categorie');
            return;
        }

        $newStatus = $this->category_model->toggleStatus($id);

        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => ($newStatus !== false),
                    'status' => $newStatus,
                    'message' => 'Status changed to ' . ucfirst($newStatus)
                ]));
            return;
        }

        $this->session->set_flashdata('success', 'Category status updated to ' . ucfirst($newStatus) . '.');
        redirect('admin/categorie');
    }

    /**
     * Subcategories List Page (Search, Parent Category Filter, Pagination)
     */
    public function subcategories()
    {
        $filter = [];
        $search = trim($this->input->get('search', TRUE) ?? '');
        if ($search !== '') {
            $filter['search'] = $search;
        }

        $selectedCategory = trim($this->input->get('category', TRUE) ?? '');
        if ($selectedCategory !== '' && $selectedCategory !== 'all') {
            $filter['category_id'] = $selectedCategory;
        }

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 10;
        $paginated = $this->subcategory_model->getPaginated($page, $perPage, $filter);
        $allCategories = $this->category_model->getAll(['status' => 'active']);

        $data = [
            'page_title' => 'Subcategories List | Larkon Admin',
            'current_page' => 'subcategories',
            'subcategories' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'selected_category' => $selectedCategory,
            'all_categories' => $allCategories,
            'all_count' => count($this->subcategory_model->getAll()),
            'active_count' => count($this->subcategory_model->getActiveSubcategories())
        ];
        $this->load->view('admin/subcategories', $data);
    }

    /**
     * Add Subcategory (GET & POST)
     */
    public function subcategoryadd()
    {
        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);
            $newSlug = $this->subcategory_model->create($postData);
            $this->session->set_flashdata('success', 'Subcategory "' . htmlspecialchars($postData['name'] ?? 'New Subcategory') . '" created successfully!');
            redirect('admin/subcategories');
            return;
        }

        $data = [
            'page_title' => 'Add Subcategory | Larkon Admin',
            'current_page' => 'subcategoryadd',
            'all_categories' => $this->category_model->getAll(['status' => 'active'])
        ];
        $this->load->view('admin/subcategoryadd', $data);
    }

    /**
     * Edit Subcategory (GET & POST)
     */
    public function subcategoryedit($id = null)
    {
        $all = $this->subcategory_model->getAll();
        if (empty($id)) {
            $keys = array_keys($all);
            $id = reset($keys);
        }

        $subcategory = $this->subcategory_model->getById($id);
        if (!$subcategory) {
            $this->session->set_flashdata('error', 'Subcategory not found.');
            redirect('admin/subcategories');
            return;
        }

        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);
            $this->subcategory_model->update($id, $postData);
            $this->session->set_flashdata('success', 'Subcategory "' . htmlspecialchars($subcategory['name']) . '" updated successfully!');
            redirect('admin/subcategories');
            return;
        }

        $data = [
            'page_title' => 'Edit Subcategory | Larkon Admin',
            'current_page' => 'subcategoryedit',
            'subcategory' => $subcategory,
            'all_categories' => $this->category_model->getAll(['status' => 'active'])
        ];
        $this->load->view('admin/subcategoryedit', $data);
    }

    /**
     * Delete Subcategory
     */
    public function subcategorydelete($id = null)
    {
        if (empty($id)) {
            redirect('admin/subcategories');
            return;
        }

        $sub = $this->subcategory_model->getById($id);
        if ($sub) {
            $this->subcategory_model->delete($id);
            $this->session->set_flashdata('success', 'Subcategory "' . htmlspecialchars($sub['name']) . '" deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Subcategory not found.');
        }

        redirect('admin/subcategories');
    }

    /**
     * Toggle Subcategory Status
     */
    public function subcategorystatus($id = null)
    {
        if (empty($id)) {
            redirect('admin/subcategories');
            return;
        }

        $newStatus = $this->subcategory_model->toggleStatus($id);

        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => ($newStatus !== false),
                    'status' => $newStatus,
                    'message' => 'Status changed to ' . ucfirst($newStatus)
                ]));
            return;
        }

        $this->session->set_flashdata('success', 'Subcategory status updated to ' . ucfirst($newStatus) . '.');
        redirect('admin/subcategories');
    }

    /**
     * Product Listing Page
     */
    public function productlist()
    {
        $filter = [];
        if ($this->input->get('category')) {
            $filter['category'] = trim($this->input->get('category'));
        }
        if ($this->input->get('status')) {
            $filter['status'] = trim($this->input->get('status'));
        }
        if ($this->input->get('search')) {
            $filter['search'] = trim($this->input->get('search'));
        }

        $products = $this->product_model->getAll($filter);
        $allProducts = $this->product_model->getAll();

        $total_products = count($allProducts);
        $in_stock = 0;
        $low_stock = 0;
        $active_count = 0;
        $categories = [];

        foreach ($allProducts as $p) {
            $stock = $p['stock'] ?? 0;
            if ($stock > 100) {
                $in_stock++;
            } else {
                $low_stock++;
            }
            if (($p['status'] ?? 'active') === 'active') {
                $active_count++;
            }
            if (!empty($p['category'])) {
                $categories[$p['category']] = ($categories[$p['category']] ?? 0) + 1;
            }
        }

        $data = [
            'page_title' => 'Product Catalogue | TeknoLite Admin',
            'current_page' => 'productlist',
            'products' => $products,
            'all_categories' => $this->product_model->getCategories(),
            'category_counts' => $categories,
            'active_filter' => $filter,
            'metrics' => [
                'total' => $total_products,
                'in_stock' => $in_stock,
                'low_stock' => $low_stock,
                'active' => $active_count,
                'categories_count' => count($categories)
            ]
        ];

        $this->load->view('admin/productlist', $data);
    }

    public function products()
    {
        $this->productlist();
    }

    /**
     * Create Product (GET & POST)
     */
    public function productadd()
    {
        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);

            // Handle Featured Image Upload
            $featuredImage = $this->_handle_upload('featured_image');
            if ($featuredImage) {
                $postData['featured_image'] = $featuredImage;
            } else if (empty($postData['featured_image'])) {
                $postData['featured_image'] = 'assets/images/products/gamma.png';
            }

            // Handle Multiple Gallery Images
            $galleryImages = $this->_handle_multiple_upload('gallery_images');
            if (!empty($galleryImages)) {
                $postData['gallery_images'] = array_merge([$postData['featured_image']], $galleryImages);
            } else {
                $postData['gallery_images'] = [$postData['featured_image']];
            }

            // Price on request checkbox
            $postData['price_on_request'] = $this->input->post('price_on_request') ? true : false;
            $postData['is_featured'] = $this->input->post('is_featured') ? true : false;
            $postData['is_bestseller'] = $this->input->post('is_bestseller') ? true : false;

            $submittedSku = trim($postData['sku'] ?? '');
            $newSlug = $this->product_model->create($postData);

            $createdProd = $this->product_model->getBySlug($newSlug);
            $finalSku = $createdProd ? $createdProd['sku'] : $submittedSku;

            if (!empty($submittedSku) && $finalSku !== $submittedSku) {
                $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($postData['name'] ?? 'New Item') . '" created successfully! Note: SKU "' . htmlspecialchars($submittedSku) . '" already existed, so it was uniquely assigned as "' . htmlspecialchars($finalSku) . '".');
            } else {
                $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($postData['name'] ?? 'New Item') . '" created successfully!');
            }
            redirect('admin/productlist');
            return;
        }

        $data = [
            'page_title' => 'Create Product | Larkon Admin',
            'current_page' => 'productadd',
            'categories' => $this->product_model->getCategories(),
            'subcategories' => $this->product_model->getSubcategories()
        ];
        $this->load->view('admin/productadd', $data);
    }

    /**
     * Edit Product (GET & POST)
     */
    public function productedit($id = null)
    {
        $allProducts = $this->product_model->getAll();
        if (empty($id)) {
            $keys = array_keys($allProducts);
            $id = reset($keys);
        }

        $product = $this->product_model->getById($id);
        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('admin/productlist');
            return;
        }

        if ($this->input->method() === 'post') {
            $postData = $this->input->post(NULL, TRUE);

            // Handle optional new Featured Image Upload
            $newFeaturedImage = $this->_handle_upload('featured_image');
            if ($newFeaturedImage) {
                $postData['featured_image'] = $newFeaturedImage;
            }

            // Handle optional additional Gallery Images
            $newGalleryImages = $this->_handle_multiple_upload('gallery_images');
            if (!empty($newGalleryImages)) {
                $existingGallery = $product['gallery_images'] ?? [];
                $postData['gallery_images'] = array_merge($existingGallery, $newGalleryImages);
            }

            // Checkboxes
            $postData['price_on_request'] = $this->input->post('price_on_request') ? true : false;
            $postData['is_featured'] = $this->input->post('is_featured') ? true : false;
            $postData['is_bestseller'] = $this->input->post('is_bestseller') ? true : false;

            $this->product_model->update($id, $postData);

            $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($postData['name'] ?? $product['name']) . '" updated successfully!');
            redirect('admin/productlist');
            return;
        }

        $data = [
            'page_title' => 'Edit ' . $product['name'] . ' | Larkon Admin',
            'current_page' => 'productedit',
            'product' => $product,
            'categories' => $this->product_model->getCategories(),
            'subcategories' => $this->product_model->getSubcategories()
        ];

        $this->load->view('admin/productedit', $data);
    }

    /**
     * Delete Product
     */
    public function productdelete($id = null)
    {
        if (empty($id)) {
            redirect('admin/productlist');
            return;
        }

        $product = $this->product_model->getById($id);
        $deleted = $this->product_model->delete($id);

        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => $deleted,
                    'message' => $deleted ? 'Product deleted successfully.' : 'Product could not be deleted.'
                ]));
            return;
        }

        if ($deleted) {
            $this->session->set_flashdata('success', 'Product "' . htmlspecialchars($product['name'] ?? $id) . '" deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to delete product.');
        }

        redirect('admin/productlist');
    }

    /**
     * Toggle Active/Inactive Status
     */
    public function productstatus($id = null)
    {
        if (empty($id)) {
            redirect('admin/productlist');
            return;
        }

        $newStatus = $this->product_model->toggleStatus($id);

        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => ($newStatus !== false),
                    'status' => $newStatus,
                    'message' => 'Status changed to ' . ucfirst($newStatus)
                ]));
            return;
        }

        redirect('admin/productlist');
    }

    /**
     * Product Detail Page
     */
    public function productlistdetail($id = null)
    {
        $allProducts = $this->product_model->getAll();
        if (empty($id) || !$this->product_model->getById($id)) {
            $keys = array_keys($allProducts);
            $id = reset($keys);
        }

        $product = $this->product_model->getById($id);

        $data = [
            'page_title' => $product['name'] . ' | Admin Details | TeknoLite',
            'current_page' => 'productlistdetail',
            'product' => $product,
            'all_products' => $allProducts
        ];

        $this->load->view('admin/productlistdetail', $data);
    }

    /**
     * Enquiries / Orders List Page
     */
    public function enquiries()
    {
        $filter = [];
        $search = trim($this->input->get('search', TRUE) ?? '');
        if ($search !== '') {
            $filter['search'] = $search;
        }

        $selectedStatus = trim($this->input->get('status', TRUE) ?? '');
        if ($selectedStatus !== '' && strtolower($selectedStatus) !== 'all') {
            $filter['status'] = $selectedStatus;
        }

        $dateFilter = trim($this->input->get('date_filter', TRUE) ?? '');
        if ($dateFilter !== '' && $dateFilter !== 'all') {
            $filter['date_filter'] = $dateFilter;
        }

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 10;
        $paginated = $this->enquiry_model->getPaginated($page, $perPage, $filter);
        $stats = $this->enquiry_model->getStats();

        $data = [
            'page_title' => 'Product Enquiries & Quotations | TeknoLite Larkon Admin',
            'current_page' => 'enquiries',
            'enquiries' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'selected_status' => $selectedStatus,
            'date_filter' => $dateFilter,
            'stats' => $stats
        ];

        $this->load->view('admin/enquiries', $data);
    }

    /**
     * Orders redirected to Enquiries (Semi-ecommerce site)
     */
    public function orders()
    {
        redirect('admin/enquiries');
    }

    /**
     * Enquiry / Order Details Page
     */
    public function enquirydetail($id = null)
    {
        if (empty($id)) {
            $all = $this->enquiry_model->getAll();
            if (!empty($all)) {
                $first = reset($all);
                $id = $first['id'];
            } else {
                $this->session->set_flashdata('error', 'No enquiries found.');
                redirect('admin/enquiries');
                return;
            }
        }

        $enquiry = $this->enquiry_model->getById($id);
        if (!$enquiry) {
            $this->session->set_flashdata('error', 'Enquiry #' . htmlspecialchars($id) . ' not found.');
            redirect('admin/enquiries');
            return;
        }

        $data = [
            'page_title' => 'Enquiry Details ' . ($enquiry['reference'] ?? ('#' . $enquiry['id'])) . ' | Larkon Admin',
            'current_page' => 'enquirydetail',
            'enquiry' => $enquiry,
            'all_enquiries' => $this->enquiry_model->getAll()
        ];

        $this->load->view('admin/enquirydetail', $data);
    }

    /**
     * Alias for Order Details matching Larkon theme
     */
    public function orderdetails($id = null)
    {
        $this->enquirydetail($id);
    }

    /**
     * Update Enquiry Status, Admin Remark, and Priority
     */
    public function enquiryupdatestatus($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id', TRUE);
        }

        $status = trim($this->input->post('status', TRUE) ?? '');
        $remark = trim($this->input->post('admin_remark', TRUE) ?? '');
        $priority = trim($this->input->post('priority', TRUE) ?? '');

        if (empty($id) || empty($status)) {
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Missing ID or Status.']));
            }
            $this->session->set_flashdata('error', 'Invalid enquiry update request.');
            redirect('admin/enquiries');
            return;
        }

        $updated = $this->enquiry_model->updateStatus($id, $status, $remark, $priority, 'Admin');

        if ($this->input->is_ajax_request()) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => $updated,
                    'message' => $updated ? 'Enquiry updated successfully.' : 'Failed to update enquiry.',
                    'new_status' => $status,
                    'remark' => $remark,
                    'priority' => $priority
                ]));
        }

        if ($updated) {
            $this->session->set_flashdata('success', 'Enquiry status updated to "' . $status . '" successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to update enquiry.');
        }

        redirect('admin/enquirydetail/' . $id);
    }

    /**
     * Delete Enquiry
     */
    public function enquirydelete($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id', TRUE);
        }

        if (empty($id)) {
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Enquiry ID is missing.']));
            }
            $this->session->set_flashdata('error', 'Enquiry ID is missing.');
            redirect('admin/enquiries');
            return;
        }

        $deleted = $this->enquiry_model->delete($id);

        if ($this->input->is_ajax_request()) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => $deleted,
                    'message' => $deleted ? 'Enquiry deleted successfully.' : 'Failed to delete enquiry.'
                ]));
        }

        if ($deleted) {
            $this->session->set_flashdata('success', 'Enquiry #' . $id . ' deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Could not delete enquiry.');
        }

        redirect('admin/enquiries');
    }

    /**
     * Customers List Page
     */
    public function customers()
    {
        $filter = [];
        $search = trim($this->input->get('search', TRUE) ?? '');
        if ($search !== '') {
            $filter['search'] = $search;
        }

        $selectedStatus = trim($this->input->get('status', TRUE) ?? '');
        if ($selectedStatus !== '' && strtolower($selectedStatus) !== 'all') {
            $filter['status'] = $selectedStatus;
        }

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 10;
        $paginated = $this->customer_model->getPaginated($page, $perPage, $filter);
        $stats = $this->customer_model->getStats();

        $data = [
            'page_title' => 'Customers List | Larkon Admin',
            'current_page' => 'customers',
            'customers' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'selected_status' => $selectedStatus,
            'stats' => $stats
        ];

        $this->load->view('admin/customers', $data);
    }

    /**
     * Customer Profile & Enquiry History Page
     */
    public function customerprofile($id = null)
    {
        if (empty($id)) {
            $all = $this->customer_model->getAll();
            if (!empty($all)) {
                $first = reset($all);
                $id = $first['id'];
            } else {
                $this->session->set_flashdata('error', 'No customers found.');
                redirect('admin/customers');
                return;
            }
        }

        $customer = $this->customer_model->getById($id);
        if (!$customer) {
            $this->session->set_flashdata('error', 'Customer #' . htmlspecialchars($id) . ' not found.');
            redirect('admin/customers');
            return;
        }

        $enquiryHistory = $this->customer_model->getCustomerEnquiries($customer);

        if (!isset($this->wishlist_model)) {
            $this->load->model('Wishlist_model', 'wishlist_model');
        }
        $wishlistItems = $this->wishlist_model->getItemsByCustomerId($customer['numeric_id'] ?? $customer['id']);

        $data = [
            'page_title' => $customer['name'] . ' | Customer Profile | Larkon Admin',
            'current_page' => 'customerprofile',
            'customer' => $customer,
            'enquiries' => $enquiryHistory,
            'wishlist' => $wishlistItems,
            'all_customers' => $this->customer_model->getAll()
        ];

        $this->load->view('admin/customerprofile', $data);
    }

    /**
     * Toggle Customer Active / Inactive Status
     */
    public function customerstatus($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id', TRUE);
        }

        if (empty($id)) {
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Customer ID is required.']));
            }
            redirect('admin/customers');
            return;
        }

        $newStatus = $this->customer_model->toggleStatus($id);

        if ($this->input->is_ajax_request()) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => ($newStatus !== false),
                    'new_status' => $newStatus,
                    'message' => 'Customer status changed to ' . ucfirst($newStatus)
                ]));
        }

        $this->session->set_flashdata('success', 'Customer status updated to ' . ucfirst($newStatus));
        redirect('admin/customers');
    }

    /**
     * Update Customer Details
     */
    public function customerupdate($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id', TRUE);
        }

        $updateData = [
            'name' => trim($this->input->post('name', TRUE) ?? ''),
            'email' => strtolower(trim($this->input->post('email', TRUE) ?? '')),
            'mobile' => trim($this->input->post('mobile', TRUE) ?? ''),
            'company' => trim($this->input->post('company', TRUE) ?? ''),
            'gst_number' => trim($this->input->post('gst_number', TRUE) ?? ''),
            'address' => trim($this->input->post('address', TRUE) ?? ''),
            'city' => trim($this->input->post('city', TRUE) ?? ''),
            'state' => trim($this->input->post('state', TRUE) ?? ''),
            'pincode' => trim($this->input->post('pincode', TRUE) ?? ''),
            'status' => trim($this->input->post('status', TRUE) ?? 'active')
        ];

        // Handle Customer Avatar Upload
        $uploadedAvatar = $this->_handle_upload('avatar', 'uploads/customers/');
        if ($uploadedAvatar) {
            $updateData['avatar'] = $uploadedAvatar;
        }

        // Handle Password
        if (!empty($this->input->post('password'))) {
            $updateData['password'] = $this->input->post('password');
        }

        if (empty($id)) {
            $newCode = $this->customer_model->create($updateData);
            if ($this->input->is_ajax_request()) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => true,
                        'customer_id' => $newCode,
                        'message' => 'Customer registered successfully.'
                    ]));
            }
            $this->session->set_flashdata('success', 'Customer registered successfully.');
            redirect('admin/customers');
            return;
        }

        $updated = $this->customer_model->update($id, $updateData);

        if ($this->input->is_ajax_request()) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => $updated,
                    'message' => $updated ? 'Customer updated successfully.' : 'Failed to update customer.'
                ]));
        }

        if ($updated) {
            $this->session->set_flashdata('success', 'Customer profile updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Could not update customer.');
        }

        $redirectTo = $this->input->post('redirect_to');
        if (!empty($redirectTo)) {
            redirect($redirectTo);
            return;
        }

        redirect('admin/customerprofile/' . $id);
    }

    /**
     * Delete Customer
     */
    public function customerdelete($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id', TRUE);
        }

        if (empty($id)) {
            redirect('admin/customers');
            return;
        }

        $deleted = $this->customer_model->delete($id);

        if ($this->input->is_ajax_request()) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => $deleted,
                    'message' => $deleted ? 'Customer deleted.' : 'Failed to delete customer.'
                ]));
        }

        if ($deleted) {
            $this->session->set_flashdata('success', 'Customer removed successfully.');
        } else {
            $this->session->set_flashdata('error', 'Could not delete customer.');
        }

        redirect('admin/customers');
    }

    /**
     * Settings Page
     */
    public function settings()
    {
        $settings = $this->settings_model->getSettings();
        $branches = $this->branch_model->getAllBranches();

        $data = [
            'page_title'   => 'Settings | Larkon Admin',
            'current_page' => 'settings',
            'settings'     => $settings,
            'branches'     => $branches
        ];

        $this->load->view('admin/settings', $data);
    }

    /**
     * Save Store & System Settings
     */
    public function savesettings()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/settings');
            return;
        }

        $fields = [
            'store_name', 'owner_name', 'owner_phone', 'owner_email',
            'contact_phone', 'contact_whatsapp', 'contact_email', 'contact_email_support',
            'contact_working_hours', 'contact_website',
            'address', 'city', 'state', 'zipcode', 'country',
            'google_map_iframe',
            'social_facebook', 'social_instagram', 'social_linkedin',
            'social_twitter', 'social_youtube', 'social_pinterest',
            'meta_title', 'meta_keyword', 'description',
            'store_theme', 'layout',
            'localization_country', 'language', 'currency', 'length_class', 'weight_class',
            'category_product_count', 'items_per_page',
            'allow_reviews', 'allow_guest_reviews',
            'min_vouchers', 'max_vouchers',
            'prices_with_tax', 'default_tax_rate',
            'customers_online', 'customers_activity', 'customer_searches', 'allow_guest_checkout', 'login_display_price', 'max_login_attempts'
        ];

        $saveData = [];
        foreach ($fields as $f) {
            if ($this->input->post($f) !== null) {
                $saveData[$f] = trim($this->input->post($f, TRUE));
            }
        }

        // Handle Header Logo Upload
        if (!empty($_FILES['header_logo']['name']) && $_FILES['header_logo']['error'] === UPLOAD_ERR_OK) {
            $headerLogo = $this->_handle_logo_upload('header_logo', 'logo_header');
            if ($headerLogo) {
                $saveData['header_logo'] = $headerLogo;
            }
        }

        // Handle Header 2nd Logo Upload (used for sticky header and footer)
        if (!empty($_FILES['header_logo_2']['name']) && $_FILES['header_logo_2']['error'] === UPLOAD_ERR_OK) {
            $headerLogo2 = $this->_handle_logo_upload('header_logo_2', 'logo_header_2');
            if ($headerLogo2) {
                $saveData['header_logo_2'] = $headerLogo2;
                $saveData['footer_logo'] = $headerLogo2; // Keep in sync for compatibility
            }
        }

        // Handle Footer Logo Upload (if provided separately)
        if (!empty($_FILES['footer_logo']['name']) && $_FILES['footer_logo']['error'] === UPLOAD_ERR_OK) {
            $footerLogo = $this->_handle_logo_upload('footer_logo', 'logo_footer');
            if ($footerLogo) {
                $saveData['footer_logo'] = $footerLogo;
            }
        }

        $saved = $this->settings_model->saveSettings($saveData);

        if ($saved) {
            $this->session->set_flashdata('success', 'Settings updated and saved successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save settings.');
        }

        redirect('admin/settings');
    }

    /**
     * Save / Add Branch Location
     */
    public function branchsave()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/settings');
            return;
        }

        $id = $this->input->post('branch_id');
        $name = trim($this->input->post('name', TRUE) ?? '');
        $cityOrBadge = trim($this->input->post('city_or_badge', TRUE) ?? '');
        $address = trim($this->input->post('address', TRUE) ?? '');
        $mapLink = trim($this->input->post('map_link', TRUE) ?? '');
        $status = in_array(strtolower($this->input->post('status')), ['active', 'inactive']) ? strtolower($this->input->post('status')) : 'active';
        $sortOrder = (int)($this->input->post('sort_order') ?? 0);

        if (empty($name) || empty($address)) {
            $this->session->set_flashdata('error', 'Store Name and Location Address are required.');
            redirect('admin/settings');
            return;
        }

        $branchData = [
            'name' => $name,
            'city_or_badge' => $cityOrBadge,
            'address' => $address,
            'map_link' => $mapLink,
            'status' => $status,
            'sort_order' => $sortOrder
        ];

        // Handle Branch Store Photo Upload
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->_handle_upload('image', 'uploads/branches/');
            if ($imagePath) {
                $branchData['image'] = $imagePath;
            }
        }

        if (!empty($id)) {
            $this->branch_model->saveBranch($branchData, (int)$id);
            $this->session->set_flashdata('success', 'Branch location updated successfully.');
        } else {
            $this->branch_model->saveBranch($branchData);
            $this->session->set_flashdata('success', 'Branch location added successfully.');
        }

        redirect('admin/settings');
    }

    /**
     * Delete Branch Location
     */
    public function branchdelete($id = null)
    {
        if (!empty($id)) {
            $this->branch_model->deleteBranch((int)$id);
            $this->session->set_flashdata('success', 'Branch location deleted successfully.');
        }
        redirect('admin/settings');
    }

    /* =========================================================================
     * CASE STUDIES CMS MANAGEMENT
     * ========================================================================= */

    /**
     * Case Studies List
     */
    public function casestudies()
    {
        $search = trim($this->input->get('search', TRUE) ?? $this->input->get('q', TRUE) ?? '');
        $status = trim($this->input->get('status', TRUE) ?? '');
        $industry = trim($this->input->get('industry', TRUE) ?? '');
        $page = max(1, (int)$this->input->get('page'));
        $perPage = 10;

        $filter = [];
        if ($search !== '') {
            $filter['search'] = $search;
        }
        if ($status !== '' && strtolower($status) !== 'all') {
            $filter['status'] = $status;
        }
        if ($industry !== '' && strtolower($industry) !== 'all') {
            $filter['industry'] = $industry;
        }

        $paginated = $this->casestudy_model->getPaginated($page, $perPage, $filter);
        $stats = $this->casestudy_model->getStats();
        $industries = $this->casestudy_model->getIndustries();

        $data = [
            'page_title' => 'Case Studies CMS | TeknoLite Larkon Admin',
            'current_page' => 'casestudies',
            'items' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'status' => $status,
            'industry' => $industry,
            'stats' => $stats,
            'industries' => $industries
        ];

        $this->load->view('admin/casestudies', $data);
    }

    /**
     * Add New Case Study
     */
    public function casestudyadd()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Case Study Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('client', 'Client / Project Name', 'trim|max_length[255]');
            $this->form_validation->set_rules('industry', 'Industry', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('location', 'Location', 'trim|max_length[255]');
            $this->form_validation->set_rules('overview', 'Project Overview', 'trim|required');

            if ($this->form_validation->run()) {
                // Featured image upload or default
                $featuredImage = $this->_handle_upload('featured_image', 'uploads/casestudies/');
                if (!$featuredImage) {
                    $postedImage = trim($this->input->post('image_url', TRUE) ?? '');
                    $featuredImage = !empty($postedImage) ? $postedImage : 'assets/images/project/project1.jpeg';
                }

                $title = trim($this->input->post('title', TRUE));
                $slug = trim($this->input->post('slug', TRUE) ?? '');
                if (empty($slug)) {
                    $slug = $this->casestudy_model->generateSlug($title);
                }

                $createData = [
                    'title' => $title,
                    'client' => trim($this->input->post('client', TRUE)),
                    'industry' => trim($this->input->post('industry', TRUE)),
                    'location' => trim($this->input->post('location', TRUE)),
                    'solution' => trim($this->input->post('solution', TRUE) ?? 'Architectural LED Lighting'),
                    'featured_image' => $featuredImage,
                    'overview' => trim($this->input->post('overview', TRUE)),
                    'short_description' => trim($this->input->post('short_description', TRUE) ?? ''),
                    'status' => in_array(strtolower($this->input->post('status')), ['active', 'inactive']) ? strtolower($this->input->post('status')) : 'active',
                    'meta_title' => trim($this->input->post('meta_title', TRUE) ?? ($title . ' | TeknoLite Case Study')),
                    'meta_description' => trim($this->input->post('meta_description', TRUE) ?? ''),
                    'meta_keywords' => trim($this->input->post('meta_keywords', TRUE) ?? ''),
                    'slug' => $slug
                ];

                $this->casestudy_model->create($createData);
                $this->session->set_flashdata('success', 'Case study added successfully!');
                redirect('admin/casestudies');
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please fill all required fields.');
            }
        }

        $industries = $this->casestudy_model->getIndustries();

        $data = [
            'page_title' => 'Add New Case Study | TeknoLite Larkon Admin',
            'current_page' => 'casestudyadd',
            'industries' => $industries
        ];

        $this->load->view('admin/casestudyadd', $data);
    }

    /**
     * Edit Existing Case Study
     */
    public function casestudyedit($id = null)
    {
        if (empty($id)) {
            redirect('admin/casestudies');
            return;
        }

        $caseStudy = $this->casestudy_model->getById($id);
        if (!$caseStudy) {
            $this->session->set_flashdata('error', 'Case study not found.');
            redirect('admin/casestudies');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Case Study Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('client', 'Client / Project Name', 'trim|max_length[255]');
            $this->form_validation->set_rules('industry', 'Industry', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('location', 'Location', 'trim|max_length[255]');
            $this->form_validation->set_rules('overview', 'Project Overview', 'trim|required');

            if ($this->form_validation->run()) {
                // Check if new image uploaded
                $featuredImage = $this->_handle_upload('featured_image', 'uploads/casestudies/');
                if (!$featuredImage) {
                    $postedImage = trim($this->input->post('image_url', TRUE) ?? '');
                    $featuredImage = !empty($postedImage) ? $postedImage : $caseStudy['featured_image'];
                }

                $title = trim($this->input->post('title', TRUE));
                $slug = trim($this->input->post('slug', TRUE) ?? '');
                if (empty($slug)) {
                    $slug = $this->casestudy_model->generateSlug($title, $id);
                }

                $updateData = [
                    'title' => $title,
                    'client' => trim($this->input->post('client', TRUE)),
                    'industry' => trim($this->input->post('industry', TRUE)),
                    'location' => trim($this->input->post('location', TRUE)),
                    'solution' => trim($this->input->post('solution', TRUE) ?? 'Architectural LED Lighting'),
                    'featured_image' => $featuredImage,
                    'overview' => trim($this->input->post('overview', TRUE)),
                    'short_description' => trim($this->input->post('short_description', TRUE) ?? ''),
                    'status' => in_array(strtolower($this->input->post('status')), ['active', 'inactive']) ? strtolower($this->input->post('status')) : $caseStudy['status'],
                    'meta_title' => trim($this->input->post('meta_title', TRUE) ?? ''),
                    'meta_description' => trim($this->input->post('meta_description', TRUE) ?? ''),
                    'meta_keywords' => trim($this->input->post('meta_keywords', TRUE) ?? ''),
                    'slug' => $slug
                ];

                $this->casestudy_model->update($id, $updateData);
                $this->session->set_flashdata('success', 'Case study updated successfully!');
                redirect('admin/casestudies');
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please fix validation errors.');
            }
        }

        $industries = $this->casestudy_model->getIndustries();

        $data = [
            'page_title' => 'Edit Case Study | TeknoLite Larkon Admin',
            'current_page' => 'casestudies',
            'case_study' => $caseStudy,
            'industries' => $industries
        ];

        $this->load->view('admin/casestudyedit', $data);
    }

    /**
     * Delete Case Study
     */
    public function casestudydelete($id = null)
    {
        if (!empty($id)) {
            $this->casestudy_model->delete($id);
            $this->session->set_flashdata('success', 'Case study deleted successfully.');
        }
        redirect('admin/casestudies');
    }

    /**
     * Toggle Case Study Status
     */
    public function casestudystatus($id = null)
    {
        if (!empty($id)) {
            $newStatus = $this->casestudy_model->toggleStatus($id);
            $this->session->set_flashdata('success', 'Case study status changed to ' . ucfirst($newStatus));
        }

        $referrer = $this->input->server('HTTP_REFERER');
        if (!empty($referrer) && strpos($referrer, base_url()) !== false) {
            redirect($referrer);
        } else {
            redirect('admin/casestudies');
        }
    }

    /* =========================================================================
     * BLOG CMS MANAGEMENT
     * ========================================================================= */

    /**
     * Blogs List
     */
    public function blogs()
    {
        $search = trim($this->input->get('search', TRUE) ?? $this->input->get('q', TRUE) ?? '');
        $status = trim($this->input->get('status', TRUE) ?? '');
        $category = trim($this->input->get('category', TRUE) ?? '');
        $page = max(1, (int)$this->input->get('page'));
        $perPage = 10;

        $filter = [];
        if ($search !== '') {
            $filter['search'] = $search;
        }
        if ($status !== '' && strtolower($status) !== 'all') {
            $filter['status'] = $status;
        }
        if ($category !== '' && strtolower($category) !== 'all') {
            $filter['category'] = $category;
        }

        $paginated = $this->blog_model->getPaginated($page, $perPage, $filter);
        $stats = $this->blog_model->getStats();
        $categories = $this->blog_model->getCategories();

        $data = [
            'page_title' => 'Blog Management | TeknoLite Larkon Admin',
            'current_page' => 'blogs',
            'items' => $paginated['items'],
            'total_items' => $paginated['total_items'],
            'total_pages' => $paginated['total_pages'],
            'current_page_num' => $paginated['current_page'],
            'per_page' => $perPage,
            'search' => $search,
            'status' => $status,
            'category' => $category,
            'stats' => $stats,
            'categories' => $categories
        ];

        $this->load->view('admin/blogs', $data);
    }

    /**
     * Add New Blog Post
     */
    public function blogadd()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Blog Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
            $this->form_validation->set_rules('content', 'Article Content', 'trim|required');

            if ($this->form_validation->run()) {
                // Featured image upload or default
                $featuredImage = $this->_handle_upload('featured_image', 'uploads/blogs/');
                if (!$featuredImage) {
                    $postedImage = trim($this->input->post('image_url', TRUE) ?? '');
                    $featuredImage = !empty($postedImage) ? $postedImage : 'assets/images/blog/blog-details.jpg';
                }

                $title = trim($this->input->post('title', TRUE));
                $slug = trim($this->input->post('slug', TRUE) ?? '');
                if (empty($slug)) {
                    $slug = $this->blog_model->generateSlug($title);
                }

                $category = trim($this->input->post('category', TRUE));
                $categorySlug = url_title(strtolower($category), '-', TRUE);

                $createData = [
                    'title' => $title,
                    'slug' => $slug,
                    'category' => $category,
                    'category_slug' => $categorySlug,
                    'author' => trim($this->input->post('author', TRUE) ?? 'TeknoLite Team'),
                    'published_date' => $this->input->post('published_date', TRUE) ?: date('Y-m-d'),
                    'featured_image' => $featuredImage,
                    'short_description' => trim($this->input->post('short_description', TRUE)),
                    'content' => $this->input->post('content', FALSE), // Preserve HTML formatting
                    'status' => in_array(strtolower($this->input->post('status')), ['active', 'inactive']) ? strtolower($this->input->post('status')) : 'active',
                    'meta_title' => trim($this->input->post('meta_title', TRUE) ?? ($title . ' | TeknoLite Blog')),
                    'meta_description' => trim($this->input->post('meta_description', TRUE) ?? ''),
                    'meta_keywords' => trim($this->input->post('meta_keywords', TRUE) ?? '')
                ];

                $this->blog_model->create($createData);
                $this->session->set_flashdata('success', 'Blog article published successfully!');
                redirect('admin/blogs');
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please fill all required fields.');
            }
        }

        $categories = $this->blog_model->getCategories();

        $data = [
            'page_title' => 'Create New Blog Post | TeknoLite Larkon Admin',
            'current_page' => 'blogadd',
            'categories' => $categories
        ];

        $this->load->view('admin/blogadd', $data);
    }

    /**
     * Edit Existing Blog Post
     */
    public function blogedit($id = null)
    {
        if (empty($id)) {
            redirect('admin/blogs');
            return;
        }

        $blog = $this->blog_model->getById($id);
        if (!$blog) {
            $this->session->set_flashdata('error', 'Blog post not found.');
            redirect('admin/blogs');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Blog Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
            $this->form_validation->set_rules('content', 'Article Content', 'trim|required');

            if ($this->form_validation->run()) {
                // Check if new image uploaded
                $featuredImage = $this->_handle_upload('featured_image', 'uploads/blogs/');
                if (!$featuredImage) {
                    $postedImage = trim($this->input->post('image_url', TRUE) ?? '');
                    $featuredImage = !empty($postedImage) ? $postedImage : $blog['featured_image'];
                }

                $title = trim($this->input->post('title', TRUE));
                $slug = trim($this->input->post('slug', TRUE) ?? '');
                if (empty($slug)) {
                    $slug = $this->blog_model->generateSlug($title, $id);
                }

                $category = trim($this->input->post('category', TRUE));
                $categorySlug = url_title(strtolower($category), '-', TRUE);

                $updateData = [
                    'title' => $title,
                    'slug' => $slug,
                    'category' => $category,
                    'category_slug' => $categorySlug,
                    'author' => trim($this->input->post('author', TRUE) ?? $blog['author']),
                    'published_date' => $this->input->post('published_date', TRUE) ?: $blog['published_date'],
                    'featured_image' => $featuredImage,
                    'short_description' => trim($this->input->post('short_description', TRUE)),
                    'content' => $this->input->post('content', FALSE), // Preserve HTML formatting
                    'status' => in_array(strtolower($this->input->post('status')), ['active', 'inactive']) ? strtolower($this->input->post('status')) : $blog['status'],
                    'meta_title' => trim($this->input->post('meta_title', TRUE) ?? ''),
                    'meta_description' => trim($this->input->post('meta_description', TRUE) ?? ''),
                    'meta_keywords' => trim($this->input->post('meta_keywords', TRUE) ?? '')
                ];

                $this->blog_model->update($id, $updateData);
                $this->session->set_flashdata('success', 'Blog article updated successfully!');
                redirect('admin/blogs');
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please fix validation errors.');
            }
        }

        $categories = $this->blog_model->getCategories();

        $data = [
            'page_title' => 'Edit Blog Post | TeknoLite Larkon Admin',
            'current_page' => 'blogs',
            'blog' => $blog,
            'categories' => $categories
        ];

        $this->load->view('admin/blogedit', $data);
    }

    /**
     * View Blog Post Detail in Admin
     */
    public function blogview($id = null)
    {
        if (empty($id)) {
            redirect('admin/blogs');
            return;
        }

        $blog = $this->blog_model->getById($id);
        if (!$blog) {
            $this->session->set_flashdata('error', 'Blog post not found.');
            redirect('admin/blogs');
            return;
        }

        $data = [
            'page_title' => 'Preview: ' . $blog['title'] . ' | Larkon Admin',
            'current_page' => 'blogs',
            'blog' => $blog
        ];

        $this->load->view('admin/blogview', $data);
    }

    /**
     * Delete Blog Post
     */
    public function blogdelete($id = null)
    {
        if (!empty($id)) {
            $this->blog_model->delete($id);
            $this->session->set_flashdata('success', 'Blog article deleted successfully.');
        }
        redirect('admin/blogs');
    }

    /**
     * Toggle Blog Post Status
     */
    public function blogstatus($id = null)
    {
        if (!empty($id)) {
            $newStatus = $this->blog_model->toggleStatus($id);
            $this->session->set_flashdata('success', 'Blog status changed to ' . ucfirst($newStatus));
        }

        $referrer = $this->input->server('HTTP_REFERER');
        if (!empty($referrer) && strpos($referrer, base_url()) !== false) {
            redirect($referrer);
        } else {
            redirect('admin/blogs');
        }
    }


    /**
     * Handle single file upload
     */
    private function _handle_upload($fieldName, $targetDir = 'uploads/products/')
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file = $_FILES[$fieldName];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

        if (!in_array($ext, $allowed)) {
            return null;
        }

        $absDir = FCPATH . $targetDir;
        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $filename = 'prod_' . time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $ext;
        $destination = $absDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $targetDir . $filename;
        }

        return null;
    }

    /**
     * Handle multiple file uploads
     */
    private function _handle_multiple_upload($fieldName, $targetDir = 'uploads/products/')
    {
        if (!isset($_FILES[$fieldName]) || !is_array($_FILES[$fieldName]['name'])) {
            return [];
        }

        $uploadedPaths = [];
        $absDir = FCPATH . $targetDir;
        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $count = count($_FILES[$fieldName]['name']);

        for ($i = 0; $i < $count; $i++) {
            if ($_FILES[$fieldName]['error'][$i] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$fieldName]['name'][$i], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed)) {
                    $filename = 'prod_' . time() . '_' . $i . '_' . substr(md5(uniqid()), 0, 6) . '.' . $ext;
                    $dest = $absDir . $filename;
                    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'][$i], $dest)) {
                        $uploadedPaths[] = $targetDir . $filename;
                    }
                }
            }
        }

        return $uploadedPaths;
    }

    /**
     * Handle Logo Upload
     */
    private function _handle_logo_upload($fieldName, $prefix = 'logo')
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file = $_FILES[$fieldName];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

        if (!in_array($ext, $allowed)) {
            return null;
        }

        $targetDir = 'uploads/settings/';
        $absDir = FCPATH . $targetDir;
        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $filename = $prefix . '_' . time() . '_' . substr(md5(uniqid()), 0, 6) . '.' . $ext;
        $destination = $absDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $targetDir . $filename;
        }

        return null;
    }
}
