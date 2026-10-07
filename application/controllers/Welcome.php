<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	    public function __construct()
    {
        parent::__construct();

        $this->load->helper(['url', 'security', 'cookie']);
        $this->load->library(['email', 'session', 'form_validation']);
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('Wishlist_model', 'wishlist_model');
        $this->load->model('Casestudy_model', 'casestudy_model');
        $this->load->model('Branch_model', 'branch_model');
        $this->load->model('Blog_model', 'blog_model');

        $this->_check_remember_login();
    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data['new_products'] = $this->product_model->getLatestProducts(8);
		$data['active_categories'] = $this->category_model->getActiveCategories();
		$data['case_studies'] = $this->casestudy_model->getActiveCaseStudies();
		$data['latest_blogs'] = $this->blog_model->getLatestBlogs(3);
		$this->load->view('home', $data);
	}
	public function home()
	{
		$data['new_products'] = $this->product_model->getLatestProducts(8);
		$data['active_categories'] = $this->category_model->getActiveCategories();
		$data['case_studies'] = $this->casestudy_model->getActiveCaseStudies();
		$data['latest_blogs'] = $this->blog_model->getLatestBlogs(3);
		$this->load->view('home', $data);
	}
	public function about()
	{
		$data['branches'] = $this->branch_model->getActiveBranches();
		$this->load->view('about', $data);
	}

	public function product($category_slug = null)
	{
        $activeCategories = $this->category_model->getActiveCategories();

        $filter = ['status' => 'active'];
        if (!empty($category_slug) && $category_slug !== 'all') {
            $filter['category'] = $category_slug;
        }

        $products = $this->product_model->getAll($filter);

		$this->load->view('product', [
            'products' => $products,
            'active_categories' => $activeCategories,
            'selected_category' => $category_slug
        ]);
	}

	public function productdetail($slug = null)
	{
        // Slug or id from URL segment or GET parameter
        if (empty($slug)) {
            $slug = $this->input->get('slug') ?: $this->input->get('id');
        }

        $product = null;
        if (!empty($slug)) {
            $product = $this->product_model->getBySlug($slug);
            if (!$product) {
                $product = $this->product_model->getById($slug);
            }
        }

        // Fallback to first active product if slug not found
        if (!$product) {
            $allActive = $this->product_model->getAll(['status' => 'active']);
            $product = !empty($allActive) ? reset($allActive) : null;
        }

        // Related products from same category
        $relatedProducts = [];
        if ($product) {
            $relatedProducts = $this->product_model->getAll([
                'category' => $product['category'],
                'status' => 'active'
            ]);
            // Exclude current product
            unset($relatedProducts[$product['id']]);

            // If fewer than 4 in same category, top up with other active products
            if (count($relatedProducts) < 4) {
                $otherProducts = $this->product_model->getAll(['status' => 'active', 'limit' => 10]);
                foreach ($otherProducts as $otherId => $other) {
                    if ($other['id'] != $product['id'] && !isset($relatedProducts[$otherId])) {
                        $relatedProducts[$otherId] = $other;
                    }
                    if (count($relatedProducts) >= 4) {
                        break;
                    }
                }
            }
        }

		$this->load->view('productdetail', [
            'product' => $product,
            'related_products' => $relatedProducts,
            'active_categories' => $this->category_model->getActiveCategories()
        ]);
	}
	public function blog($category_slug = null)
	{
		$category = $this->input->get('category') ?: $category_slug;
		$search = $this->input->get('search') ?: $this->input->get('q');

		$blogs = $this->blog_model->getActiveBlogs($category, $search);
		$categories = $this->blog_model->getCategories();

		$this->load->view('blog', [
			'blogs' => $blogs,
			'categories' => $categories,
			'selected_category' => $category,
			'search' => $search,
			'total_count' => count($blogs)
		]);
	}
	public function blogdetail($slug = null)
	{
		// Fetch slug or id from URL segment or GET parameter
		if (empty($slug)) {
			$slug = $this->input->get('slug') ?: $this->input->get('id');
		}

		$blog = null;
		if (!empty($slug)) {
			$blog = $this->blog_model->getBySlug($slug);
		}

		// Fallback to first active blog if not found
		if (!$blog) {
			$allActive = $this->blog_model->getActiveBlogs();
			$blog = !empty($allActive) ? $allActive[0] : null;
		}

		// Increment views if valid article
		if ($blog) {
			$this->blog_model->incrementViews($blog['id']);
		}

		$recentBlogs = $blog ? $this->blog_model->getRecentBlogs($blog['id'], 3) : $this->blog_model->getLatestBlogs(3);
		$categories = $this->blog_model->getCategories();

		$this->load->view('blogdetail', [
			'blog' => $blog,
			'recent_blogs' => $recentBlogs,
			'categories' => $categories
		]);
	}
	public function contact()
	{
		$this->load->view('contact');
	}
	public function casestudy()
	{
        $this->load->model('Casestudy_model', 'casestudy_model');
        $industry = $this->input->get('category') ?: $this->input->get('industry');
        $caseStudies = $this->casestudy_model->getActiveCaseStudies($industry);
        $industries = $this->casestudy_model->getIndustries();

		$this->load->view('casestudy', [
            'casestudies' => $caseStudies,
            'industries' => $industries,
            'selected_industry' => $industry
        ]);
	}

	public function casestudydetail($slug = null)
	{
        $this->load->model('Casestudy_model', 'casestudy_model');

        // Slug or id from URL segment or GET parameter
        if (empty($slug)) {
            $slug = $this->input->get('slug') ?: $this->input->get('id');
        }

        $caseStudy = null;
        if (!empty($slug)) {
            $caseStudy = $this->casestudy_model->getBySlug($slug);
            if (!$caseStudy) {
                $caseStudy = $this->casestudy_model->getById($slug);
            }
        }

        // Fallback to first active case study if specific record not found
        if (!$caseStudy) {
            $allActive = $this->casestudy_model->getActiveCaseStudies();
            $caseStudy = !empty($allActive) ? $allActive[0] : null;
        }

        $recentStudies = $this->casestudy_model->getActiveCaseStudies();

		$this->load->view('casestudydetail', [
            'case_study' => $caseStudy,
            'recent_studies' => $recentStudies
        ]);
	}
	public function login()
	{
        if ($this->session->userdata('logged_in')) {
            redirect('profile');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[150]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[72]');

            if ($this->form_validation->run()) {
                $email = strtolower(trim($this->input->post('email', TRUE)));
                $password = (string) $this->input->post('password');

                $auth = $this->customer_model->validateCredentials($email, $password);
                if ($auth['success']) {
                    $customer = $auth['customer'];

                    // Check remember me checkbox (name="remember_me" or "agree_checkbox")
                    $remember = $this->input->post('remember_me') ?: $this->input->post('agree_checkbox');
                    if ($remember) {
                        $token = $this->customer_model->generateRememberToken($customer['id']);
                        if ($token) {
                            $cookie = [
                                'name'   => 'customer_remember',
                                'value'  => $token,
                                'expire' => 86400 * 30, // 30 days
                                'path'   => '/',
                                'httponly' => TRUE,
                                'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                            ];
                            $this->input->set_cookie($cookie);
                        }
                    }

                    $this->session->set_userdata([
                        'logged_in' => TRUE,
                        'user_account' => $customer,
                        'customer_id' => $customer['id']
                    ]);

                    $this->session->set_flashdata('success', 'Welcome back, ' . htmlspecialchars($customer['name']) . '!');
                    redirect('profile');
                    return;
                } else {
                    $this->session->set_flashdata('error', $auth['message']);
                }
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please enter your email and password.');
            }
        }
        $this->load->view('login');
	}

	public function register()
	{
        if ($this->session->userdata('logged_in')) {
            redirect('profile');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
            $this->form_validation->set_rules('mobile', 'Phone Number', 'trim|max_length[20]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[72]');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                if (!$this->input->post('agree_terms')) {
                    $this->session->set_flashdata('error', 'You must agree to the Terms of Service to register.');
                    $this->load->view('register');
                    return;
                }

                $email = strtolower(trim($this->input->post('email', TRUE)));
                $existing = $this->customer_model->getByEmail($email);
                if ($existing) {
                    $this->session->set_flashdata('error', 'This email address is already registered. Please log in or use Forgot Password.');
                    redirect('login');
                    return;
                }

                $name = trim($this->input->post('name', TRUE));
                $mobile = trim($this->input->post('mobile', TRUE));
                $rawPassword = (string)$this->input->post('password');

                $newCustomerCode = $this->customer_model->create([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'password' => $rawPassword,
                    'avatar' => 'assets/images/avatar/avatar-3.jpg',
                    'status' => 'active'
                ]);

                $newCustomer = $this->customer_model->getById($newCustomerCode);
                if ($newCustomer) {
                    $this->session->set_userdata([
                        'logged_in' => TRUE,
                        'user_account' => $newCustomer,
                        'customer_id' => $newCustomer['id']
                    ]);
                    $this->session->set_flashdata('success', 'Your account has been created successfully!');
                    redirect('profile');
                    return;
                }
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please check the required fields.');
            }
        }
        $this->load->view('register');
	}

	public function profile()
	{
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $user = $this->session->userdata('user_account');
        if (!empty($user['id'])) {
            $fresh = $this->customer_model->getById($user['id']);
            if ($fresh) {
                $user = $fresh;
                $this->session->set_userdata('user_account', $fresh);
            }
        }

        $data['user'] = $user;
        $this->load->view('profile', $data);
	}

    public function update_profile()
    {
        if (!$this->session->userdata('logged_in') || $this->input->method() !== 'post') {
            redirect('login');
            return;
        }

        $sessionUser = $this->session->userdata('user_account');
        $customerId = $sessionUser['id'] ?? $this->session->userdata('customer_id');

        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[150]');
        $this->form_validation->set_rules('mobile', 'Phone', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('new_password', 'New Password', 'min_length[8]|max_length[72]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[new_password]');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
            return;
        }

        $updateData = [
            'name' => trim($this->input->post('name', TRUE)),
            'email' => strtolower(trim($this->input->post('email', TRUE))),
            'mobile' => trim($this->input->post('mobile', TRUE)),
            'company' => trim($this->input->post('company', TRUE))
        ];

        if ($this->input->post('new_password')) {
            $updateData['password'] = $this->input->post('new_password');
        }

        if (!empty($_FILES['profile_image']['name']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = FCPATH . 'uploads/customers/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, TRUE);
            }
            $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $filename = 'cust_' . time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $ext;
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $filename)) {
                    $updateData['avatar'] = 'uploads/customers/' . $filename;
                }
            }
        }

        $this->customer_model->update($customerId, $updateData);
        $freshCustomer = $this->customer_model->getById($customerId);

        $this->session->set_userdata([
            'user_account' => $freshCustomer,
            'customer_id' => $freshCustomer['id']
        ]);

        $this->session->set_flashdata('success', 'Your account details were updated successfully.');
        redirect('profile');
    }

    public function logout()
    {
        $user = $this->session->userdata('user_account');
        if (!empty($user['id'])) {
            $this->customer_model->clearRememberToken($user['id']);
        }

        delete_cookie('customer_remember');
        $this->session->unset_userdata(['logged_in', 'user_account', 'customer_id', 'registered_user']);
        $this->session->sess_destroy();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->session->set_flashdata('success', 'You have been logged out.');
        redirect('login');
    }

    /**
     * Forgot Password Page
     */
    public function forgetpassword()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('profile');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[150]');
            if ($this->form_validation->run()) {
                $email = strtolower(trim($this->input->post('email', TRUE)));
                $resetData = $this->customer_model->createPasswordResetToken($email);

                if ($resetData) {
                    $resetUrl = base_url('resetpassword/' . $resetData['token']);
                    $customerName = htmlspecialchars($resetData['customer']['name'] ?? 'Valued Customer');

                    // Configure verified Hostinger SMTP
                    $smtpConfig = [
                        'protocol'    => 'smtp',
                        'smtp_host'   => 'smtp.hostinger.com',
                        'smtp_port'   => 587,
                        'smtp_user'   => 'devika@nexmoves.in',
                        'smtp_pass'   => 'Nex-devika@15',
                        'smtp_crypto' => 'tls',
                        'mailtype'    => 'html',
                        'charset'     => 'utf-8',
                        'newline'     => "\r\n",
                        'crlf'        => "\r\n",
                        'wordwrap'    => TRUE
                    ];

                    $this->email->initialize($smtpConfig);
                    $this->email->from('devika@nexmoves.in', 'TeknoLite Support');
                    $this->email->to($email);
                    $this->email->subject('Reset Your TeknoLite Password');

                    $htmlMessage = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your TeknoLite Password</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:\'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; color:#333333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:40px 15px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background-color:#04308c; padding:32px 36px; text-align:center;">
                            <h1 style="margin:0; font-size:26px; color:#ffffff; font-weight:700; letter-spacing:1px;">TEKNOLITE</h1>
                            <p style="margin:6px 0 0 0; font-size:13px; color:#cfd9ea; text-transform:uppercase; letter-spacing:1.5px;">Architectural Lighting Studio</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 36px 28px 36px;">
                            <h2 style="margin:0 0 16px 0; font-size:20px; color:#1e293b; font-weight:600;">Password Reset Request</h2>
                            <p style="margin:0 0 16px 0; font-size:15px; line-height:1.6; color:#475569;">
                                Hello <strong>' . $customerName . '</strong>,
                            </p>
                            <p style="margin:0 0 24px 0; font-size:15px; line-height:1.6; color:#475569;">
                                We received a request to reset the password for your TeknoLite account associated with <strong>' . htmlspecialchars($email) . '</strong>. Click the button below to choose your new password:
                            </p>
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin:28px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="' . $resetUrl . '" target="_blank" style="display:inline-block; background-color:#04308c; color:#ffffff; font-size:15px; font-weight:600; text-decoration:none; padding:14px 36px; border-radius:6px; box-shadow:0 3px 8px rgba(4,48,140,0.35);">Reset My Password</a>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin:20px 0 8px 0; font-size:13px; color:#64748b; line-height:1.5;">
                                If the button above does not work, copy and paste this link into your browser:
                            </p>
                            <p style="margin:0 0 24px 0; font-size:13px; color:#04308c; word-break:break-all;">
                                <a href="' . $resetUrl . '" style="color:#04308c; text-decoration:underline;">' . $resetUrl . '</a>
                            </p>
                            <div style="background-color:#f8fafc; border-left:4px solid #04308c; padding:12px 16px; border-radius:4px; margin:24px 0 12px 0;">
                                <p style="margin:0; font-size:13px; color:#475569; line-height:1.5;">
                                    <strong>Security Notice:</strong> This password reset link is valid for <strong>1 hour</strong>. If you did not make this request, you can safely ignore this email; your account remains secure.
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#f1f5f9; padding:20px 36px; text-align:center; border-top:1px solid #e2e8f0;">
                            <p style="margin:0 0 6px 0; font-size:12px; color:#94a3b8;">
                                &copy; ' . date('Y') . ' TeknoLite Lighting. All rights reserved.
                            </p>
                            <p style="margin:0; font-size:12px; color:#94a3b8;">
                                Need help? Contact us at <a href="mailto:devika@nexmoves.in" style="color:#04308c; text-decoration:none;">devika@nexmoves.in</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

                    $this->email->message($htmlMessage);

                    $mailSent = false;
                    try {
                        $mailSent = $this->email->send();
                        if (!$mailSent) {
                            log_message('error', 'Reset password email delivery failed: ' . $this->email->print_debugger(['headers']));
                        }
                    } catch (Exception $e) {
                        log_message('error', 'Reset password email exception: ' . $e->getMessage());
                    }

                    if ($mailSent) {
                        $this->session->set_flashdata('success', 'A password reset link has been sent to ' . htmlspecialchars($email) . '. Please check your inbox and spam folder.');
                    } else {
                        $this->session->set_flashdata('success', 'A password reset link has been generated for ' . htmlspecialchars($email) . '.');
                    }
                    $this->session->set_flashdata('reset_url', $resetUrl);
                } else {
                    $this->session->set_flashdata('success', 'If an account exists with that email address, a password reset link has been sent.');
                }

                redirect('forgetpassword');
                return;
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please enter a valid email address.');
            }
        }

        $this->load->view('forgetpassword');
    }

    /**
     * Reset Password Page
     */
    public function resetpassword($token = null)
    {
        if (empty($token)) {
            $token = $this->input->post('token');
        }

        if (empty($token)) {
            $this->session->set_flashdata('error', 'Invalid password reset request.');
            redirect('forgetpassword');
            return;
        }

        $customer = $this->customer_model->verifyPasswordResetToken($token);
        if (!$customer) {
            $this->session->set_flashdata('error', 'This password reset link is invalid or has expired. Please request a new one.');
            redirect('forgetpassword');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('password', 'New Password', 'required|min_length[8]|max_length[72]');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $newPassword = (string)$this->input->post('password');
                $success = $this->customer_model->resetPasswordWithToken($token, $newPassword);

                if ($success) {
                    $this->session->set_flashdata('success', 'Your password has been reset successfully. Please log in with your new password.');
                    redirect('login');
                    return;
                } else {
                    $this->session->set_flashdata('error', 'Unable to reset password. Please try requesting a new link.');
                    redirect('forgetpassword');
                    return;
                }
            } else {
                $this->session->set_flashdata('error', validation_errors() ?: 'Please check password requirements.');
            }
        }

        $this->load->view('resetpassword', [
            'token' => $token,
            'customer' => $customer
        ]);
    }

    /**
     * Check persistent Remember Me cookie
     */
    private function _check_remember_login()
    {
        if ($this->session->userdata('logged_in')) {
            return;
        }

        $rememberToken = $this->input->cookie('customer_remember');
        if (!empty($rememberToken)) {
            $customer = $this->customer_model->getAccountByRememberToken($rememberToken);
            if ($customer) {
                $this->session->set_userdata([
                    'logged_in' => TRUE,
                    'user_account' => $customer,
                    'customer_id' => $customer['id']
                ]);
            } else {
                delete_cookie('customer_remember');
            }
        }
    }
	private function _get_default_enquiries()
	{
		return [
			[
				'id' => '#ENQ-001',
				'product_name' => 'LED COB Downlight',
				'product_image' => base_url('assets/images/shop/product-1.jpg'),
				'product_category' => 'Indoor Lighting / Downlights',
				'product_url' => base_url('productdetail'),
				'quantity' => '10',
				'name' => 'Tony Nguyen',
				'email' => 'tony@example.com',
				'mobile' => '+91 98765 43210',
				'company' => 'Nguyen Architectural Studio',
				'subject' => 'LED COB Downlight Enquiry',
				'message' => 'Looking for 10 units of 12W 3000K warm white downlights for a residential villa project in Mumbai.',
				'date' => 'September 07, 2026',
				'status' => 'Pending'
			],
			[
				'id' => '#ENQ-002',
				'product_name' => 'LED Track Light',
				'product_image' => base_url('assets/images/shop/product-2.jpg'),
				'product_category' => 'Commercial Lighting / Track Lights',
				'product_url' => base_url('productdetail'),
				'quantity' => '25',
				'name' => 'Tony Nguyen',
				'email' => 'tony@example.com',
				'mobile' => '+91 98765 43210',
				'company' => 'Nguyen Architectural Studio',
				'subject' => 'Track Light Commercial Specification',
				'message' => 'Need quotation for 25 track fixtures with 3-circuit rail system for an art gallery renovation.',
				'date' => 'September 06, 2026',
				'status' => 'Responded'
			]
		];
	}

	public function orderhistory()
	{
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please log in or register to view your enquiries.');
            redirect('login');
            return;
        }
		$session_enquiries = $this->session->userdata('user_enquiries');
		if ($session_enquiries === NULL) {
			$session_enquiries = $this->_get_default_enquiries();
			$this->session->set_userdata('user_enquiries', $session_enquiries);
		}
		$data['enquiries'] = $session_enquiries;
        $data['user'] = $this->session->userdata('user_account') ?: $this->session->userdata('registered_user');
		$this->load->view('orderhistory', $data);
	}

	public function enquirydetail()
	{
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please log in or register to view your enquiries.');
            redirect('login');
            return;
        }
		$session_enquiries = $this->session->userdata('user_enquiries');
		if ($session_enquiries === NULL) {
			$session_enquiries = $this->_get_default_enquiries();
			$this->session->set_userdata('user_enquiries', $session_enquiries);
		}

		$id = $this->input->get('id');
		$active = null;

		if ($id) {
			$cleanId = strtolower(ltrim($id, '#'));
			foreach ($session_enquiries as $enq) {
				if (strtolower(ltrim($enq['id'], '#')) === $cleanId) {
					$active = $enq;
					break;
				}
			}
		}

		if (!$active && !empty($session_enquiries)) {
			$active = $session_enquiries[0];
		}

		$data['active_enquiry'] = $active;
		$data['enquiry_id'] = $id ?: ($active['id'] ?? '#ENQ-001');
        $data['user'] = $this->session->userdata('user_account') ?: $this->session->userdata('registered_user');
		$this->load->view('enquirydetail', $data);
	}

    public function submit()
    {
        // Only allow POST requests
        if ($this->input->method() !== 'post') {
            redirect('/');
            return;
        }

        $is_ajax = $this->input->is_ajax_request();

        // Validation
        $this->form_validation->set_rules(
            'name',
            'Name',
            "trim|required|max_length[100]|regex_match[/^[A-Za-z .'-]+$/]"
        );

        $this->form_validation->set_rules(
            'mobile',
            'Mobile',
            'trim|required|max_length[20]|regex_match[/^[0-9+() .-]{7,20}$/]'
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|max_length[150]'
        );

        $this->form_validation->set_rules(
            'message',
            'Message',
            'trim|required'
        );

        if ($this->form_validation->run() == FALSE) {
            if ($is_ajax) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status'  => 'error',
                        'message' => strip_tags(validation_errors())
                    ]));
                return;
            }

            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER'] ?? '/');
            return;
        }

        // Form data
        $name             = html_escape($this->input->post('name', TRUE));
        $mobile           = html_escape($this->input->post('mobile', TRUE));
        $email            = $this->input->post('email', TRUE);
        $company          = html_escape($this->input->post('company', TRUE));
        $message          = html_escape($this->input->post('message', TRUE));

        $product_name     = html_escape($this->input->post('product_name', TRUE)) ?: 'TeknoLite LED Light';
        $product_image    = $this->input->post('product_image', TRUE) ?: base_url('assets/images/products/gamma.png');
        $product_category = html_escape($this->input->post('product_category', TRUE)) ?: 'Commercial & Architectural Range';
        $product_url      = $this->input->post('product_url', TRUE) ?: base_url('productdetail');
        $quantity         = max(1, intval($this->input->post('quantity', TRUE) ?: 1));
        $subject          = html_escape($this->input->post('subject', TRUE)) ?: ('Product Enquiry - ' . $product_name);

        echo $product_image;
        exit;

        // Generate Enquiry ID & Date
        $enquiry_id = '#ENQ-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $date_str   = date('F d, Y');

        $new_enquiry = [
            'id'               => $enquiry_id,
            'product_name'     => $product_name,
            'product_image'    => $product_image,
            'product_category' => $product_category,
            'product_url'      => $product_url,
            'quantity'         => $quantity,
            'name'             => $name,
            'email'            => $email,
            'mobile'           => $mobile,
            'company'          => $company ?: '-',
            'subject'          => $subject,
            'message'          => $message,
            'date'             => $date_str,
            'status'           => 'Pending'
        ];

        // Store into session
        $session_enquiries = $this->session->userdata('user_enquiries');
        if ($session_enquiries === NULL) {
            $session_enquiries = $this->_get_default_enquiries();
        }
        array_unshift($session_enquiries, $new_enquiry);
        $this->session->set_userdata('user_enquiries', $session_enquiries);

        // Persist to Central Enquiry Management Storage
        try {
            $this->load->model('Enquiry_model', 'enquiry_model');
            $this->enquiry_model->create([
                'id'               => $enquiry_id,
                'name'             => $name,
                'email'            => $email,
                'mobile'           => $mobile,
                'company'          => $company,
                'message'          => $message,
                'product_name'     => $product_name,
                'product_image'    => $product_image,
                'product_category' => $product_category,
                'quantity'         => $quantity,
                'created_by'       => 'Website Visitor'
            ]);
        } catch (Exception $e) {
            log_message('error', 'Enquiry storage error: ' . $e->getMessage());
        }

        /*
        |--------------------------------------------------------------------------
        | SMTP Configuration
        |--------------------------------------------------------------------------
        */
        $config = [
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.hostinger.com',
            'smtp_port'   => 587,
            'smtp_user'   => 'devika@nexmoves.in',
            'smtp_pass'   => 'Nex-devika@15',
            'smtp_crypto' => 'tls',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n",
            'crlf'        => "\r\n",
            'wordwrap'    => TRUE
        ];

        $this->email->initialize($config);

        $this->email->from('devika@nexmoves.in', 'TeknoLite Website');
        $this->email->to('devika@nexmoves.in');
        $this->email->reply_to($email, $name);
        $this->email->subject('Website Product Enquiry: ' . $product_name . ' (' . $enquiry_id . ')');

        $email_body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>New Product Enquiry</title>
        </head>
        <body style="margin:0; padding:0; background:#f4f5f7; font-family:Arial, sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5f7; padding:30px 15px;">
                <tr>
                    <td align="center">
                        <table width="620" cellpadding="0" cellspacing="0" style="max-width:620px; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.06);">
                            <!-- Header -->
                            <tr>
                                <td style="background:#111625; padding:24px 30px; color:#ffffff;">
                                    <h2 style="margin:0 0 6px 0; font-size:22px; color:#ffffff;">TeknoLite - New Product Enquiry</h2>
                                    <div style="font-size:13px; color:#9fa6b2;">Reference: <strong style="color:#ffffff;">' . $enquiry_id . '</strong> &bull; ' . $date_str . '</div>
                                </td>
                            </tr>

                            <!-- Product Info Box -->
                            <tr>
                                <td style="padding:24px 30px; background:#f9fafb; border-bottom:1px solid #eef0f3;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="130" valign="top" style="padding-right:20px;">
                                                <img src="' . $product_image . '" alt="' . $product_name . '" width="120" style="width:120px; height:auto; border-radius:6px; border:1px solid #e5e7eb; display:block; object-fit:cover;">
                                            </td>
                                            <td valign="top">
                                                <div style="font-size:12px; font-weight:700; color:#e53935; text-transform:uppercase; margin-bottom:4px;">' . $product_category . '</div>
                                                <h3 style="margin:0 0 10px 0; font-size:18px; color:#111625;">' . $product_name . '</h3>
                                                <table cellpadding="4" cellspacing="0" style="font-size:14px; color:#4b5563;">
                                                    <tr>
                                                        <td style="padding-left:0;"><strong>Required Quantity:</strong></td>
                                                        <td><span style="display:inline-block; background:#111625; color:#ffffff; padding:2px 10px; border-radius:12px; font-weight:700; font-size:13px;">' . $quantity . ' Units</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- Customer Credentials -->
                            <tr>
                                <td style="padding:30px; color:#333333; font-size:14px; line-height:1.6;">
                                    <h4 style="margin:0 0 16px 0; font-size:16px; color:#111625; border-bottom:2px solid #e53935; padding-bottom:8px; display:inline-block;">Customer Credentials</h4>
                                    <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                                        <tr style="border-bottom:1px solid #f0f0f0;">
                                            <td width="35%" style="color:#6b7280; font-weight:bold;">Person Name:</td>
                                            <td style="color:#111625; font-weight:600;">' . $name . '</td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #f0f0f0;">
                                            <td style="color:#6b7280; font-weight:bold;">Phone Number:</td>
                                            <td style="color:#111625;"><a href="tel:' . $mobile . '" style="color:#0d6efd; text-decoration:none; font-weight:600;">' . $mobile . '</a></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #f0f0f0;">
                                            <td style="color:#6b7280; font-weight:bold;">Email Address:</td>
                                            <td style="color:#111625;"><a href="mailto:' . $email . '" style="color:#0d6efd; text-decoration:none;">' . $email . '</a></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #f0f0f0;">
                                            <td style="color:#6b7280; font-weight:bold;">Company / Profession:</td>
                                            <td style="color:#111625;">' . ($company ?: '-') . '</td>
                                        </tr>
                                        <tr>
                                            <td style="color:#6b7280; font-weight:bold;">Enquiry Subject:</td>
                                            <td style="color:#111625;">' . $subject . '</td>
                                        </tr>
                                    </table>

                                    <!-- Message Requirements -->
                                    <div style="margin-top:24px;">
                                        <div style="font-weight:bold; color:#111625; margin-bottom:8px;">Project Requirements / Message:</div>
                                        <div style="padding:16px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:6px; color:#374151; font-size:14px; line-height:1.6;">
                                            ' . nl2br($message) . '
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Footer -->
                            <tr>
                                <td style="background:#f3f4f6; padding:18px 30px; font-size:12px; color:#9ca3af; text-align:center;">
                                    This enquiry was sent automatically from the TeknoLite website (<a href="' . base_url() . '" style="color:#6b7280;">' . base_url() . '</a>).
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

        $this->email->message($email_body);

        $mail_sent = false;
        try {
            $mail_sent = $this->email->send();
            if (!$mail_sent) {
                log_message('error', 'Enquiry email error: ' . $this->email->print_debugger());
            }
        } catch (Exception $e) {
            log_message('error', 'Enquiry email exception: ' . $e->getMessage());
        }

        if ($is_ajax) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status'    => 'success',
                    'message'   => 'Thank you! Your enquiry has been submitted successfully.',
                    'mail_sent' => $mail_sent,
                    'enquiry'   => $new_enquiry
                ]));
            return;
        }

        $this->session->set_flashdata(
            'success',
            'Thank you! Your enquiry for ' . $product_name . ' has been submitted successfully.'
        );

        redirect('orderhistory');
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER WISHLIST ENDPOINTS (DATABASE PERSISTENCE)
    |--------------------------------------------------------------------------
    */

    /**
     * Wishlist API: Get current logged-in customer's wishlist items
     */
    public function wishlist_get()
    {
        $isLoggedIn = (bool)$this->session->userdata('logged_in');
        $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);

        if (!$isLoggedIn || empty($customerId)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success'   => false,
                    'logged_in' => false,
                    'items'     => [],
                    'count'     => 0,
                    'message'   => 'Please log in to view your saved wishlist.'
                ]));
        }

        $items = $this->wishlist_model->getItemsByCustomerId($customerId);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success'   => true,
                'logged_in' => true,
                'items'     => $items,
                'count'     => count($items)
            ]));
    }

    /**
     * Wishlist API: Add item to customer's saved wishlist
     */
    public function wishlist_add()
    {
        $isLoggedIn = (bool)$this->session->userdata('logged_in');
        $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);

        if (!$isLoggedIn || empty($customerId)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode([
                    'success'   => false,
                    'logged_in' => false,
                    'message'   => 'Please log in to save items to your wishlist.',
                    'redirect'  => site_url('login')
                ]));
        }

        $productData = [
            'id'             => trim((string)$this->input->post('id', TRUE)),
            'name'           => trim((string)$this->input->post('name', TRUE)),
            'category'       => trim((string)$this->input->post('category', TRUE)),
            'category_label' => trim((string)$this->input->post('category_label', TRUE)),
            'image'          => trim((string)$this->input->post('image', TRUE)),
            'url'            => trim((string)$this->input->post('url', TRUE))
        ];

        // Also accept raw JSON payload
        if (empty($productData['id'])) {
            $rawJson = json_decode($this->input->raw_input_stream, true);
            if (is_array($rawJson) && !empty($rawJson['id'])) {
                $productData = $rawJson;
            }
        }

        if (empty($productData['id'])) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Invalid product information provided.'
                ]));
        }

        $saved = $this->wishlist_model->addItem($customerId, $productData);
        $items = $this->wishlist_model->getItemsByCustomerId($customerId);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $saved,
                'count'   => count($items),
                'items'   => $items,
                'message' => 'Product saved to your wishlist.'
            ]));
    }

    /**
     * Wishlist API: Remove item from customer's saved wishlist
     */
    public function wishlist_remove()
    {
        $isLoggedIn = (bool)$this->session->userdata('logged_in');
        $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);

        if (!$isLoggedIn || empty($customerId)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode([
                    'success'   => false,
                    'logged_in' => false,
                    'message'   => 'Please log in to manage your wishlist.'
                ]));
        }

        $productId = trim((string)$this->input->post('id', TRUE));
        if (empty($productId)) {
            $rawJson = json_decode($this->input->raw_input_stream, true);
            if (is_array($rawJson) && !empty($rawJson['id'])) {
                $productId = trim((string)$rawJson['id']);
            }
        }

        $removed = $this->wishlist_model->removeItem($customerId, $productId);
        $items = $this->wishlist_model->getItemsByCustomerId($customerId);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $removed,
                'count'   => count($items),
                'items'   => $items,
                'message' => 'Product removed from your wishlist.'
            ]));
    }

    /**
     * Wishlist API: Clear customer's saved wishlist
     */
    public function wishlist_clear()
    {
        $isLoggedIn = (bool)$this->session->userdata('logged_in');
        $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);

        if (!$isLoggedIn || empty($customerId)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode([
                    'success'   => false,
                    'logged_in' => false,
                    'message'   => 'Please log in to manage your wishlist.'
                ]));
        }

        $cleared = $this->wishlist_model->clearItems($customerId);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $cleared,
                'count'   => 0,
                'items'   => [],
                'message' => 'Wishlist cleared.'
            ]));
    }

    /**
     * Wishlist API: Sync client items into customer's saved wishlist
     */
    public function wishlist_sync()
    {
        $isLoggedIn = (bool)$this->session->userdata('logged_in');
        $customerId = $this->session->userdata('customer_id') ?? ($this->session->userdata('user_account')['id'] ?? null);

        if (!$isLoggedIn || empty($customerId)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode([
                    'success'   => false,
                    'logged_in' => false,
                    'items'     => [],
                    'count'     => 0
                ]));
        }

        $items = $this->input->post('items', TRUE);
        if (empty($items)) {
            $rawJson = json_decode($this->input->raw_input_stream, true);
            if (is_array($rawJson) && isset($rawJson['items'])) {
                $items = $rawJson['items'];
            }
        }

        if (is_array($items) && !empty($items)) {
            $syncedItems = $this->wishlist_model->syncItems($customerId, $items);
        } else {
            $syncedItems = $this->wishlist_model->getItemsByCustomerId($customerId);
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'count'   => count($syncedItems),
                'items'   => $syncedItems
            ]));
    }
}