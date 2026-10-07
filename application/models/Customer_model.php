<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    private $table = 'customers';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all customers with search and status filtering
     */
    public function getAll(array $filter = [])
    {
        $this->db->from($this->table . ' c');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('c.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.email', $search);
            $this->db->or_like('c.mobile', $search);
            $this->db->or_like('c.company', $search);
            $this->db->or_like('c.gst_number', $search);
            $this->db->or_like('c.city', $search);
            $this->db->or_like('c.state', $search);
            $this->db->or_like('c.pincode', $search);
            $this->db->or_like('c.customer_code', $search);
            $this->db->group_end();
        }

        $this->db->order_by('c.registered_at', 'DESC');
        $rows = $this->db->get()->result_array();

        $customers = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatCustomer($row);
            $customers[$formatted['id']] = $formatted;
        }

        return $customers;
    }

    /**
     * Paginated customer list
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        $this->db->from($this->table . ' c');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('c.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.email', $search);
            $this->db->or_like('c.mobile', $search);
            $this->db->or_like('c.company', $search);
            $this->db->or_like('c.gst_number', $search);
            $this->db->or_like('c.city', $search);
            $this->db->or_like('c.state', $search);
            $this->db->or_like('c.pincode', $search);
            $this->db->or_like('c.customer_code', $search);
            $this->db->group_end();
        }

        $totalItems = $this->db->count_all_results();
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        // Fetch
        $this->db->from($this->table . ' c');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('c.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.email', $search);
            $this->db->or_like('c.mobile', $search);
            $this->db->or_like('c.company', $search);
            $this->db->or_like('c.gst_number', $search);
            $this->db->or_like('c.city', $search);
            $this->db->or_like('c.state', $search);
            $this->db->or_like('c.pincode', $search);
            $this->db->or_like('c.customer_code', $search);
            $this->db->group_end();
        }

        $this->db->order_by('c.registered_at', 'DESC');
        $this->db->limit($perPage, $offset);

        $rows = $this->db->get()->result_array();
        $items = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatCustomer($row);
            $items[$formatted['id']] = $formatted;
        }

        return [
            'items' => $items,
            'total_items' => $totalItems,
            'total_pages' => $totalPages,
            'current_page' => $page,
            'per_page' => $perPage
        ];
    }

    /**
     * Get single customer by ID, customer_code, or Email
     */
    public function getById($id)
    {
        if (empty($id)) return null;

        $cleanId = strtoupper(trim(str_replace('#', '', $id)));

        $this->db->from($this->table . ' c');
        $this->db->group_start();
        $this->db->where('c.customer_code', $cleanId);
        $this->db->or_where('LOWER(c.email)', strtolower(trim($id)));
        if (is_numeric($id)) {
            $this->db->or_where('c.id', (int)$id);
        }
        $this->db->group_end();

        $row = $this->db->get()->row_array();
        if ($row) {
            return $this->_formatCustomer($row);
        }

        return null;
    }

    /**
     * Create or register new customer
     */
    public function create(array $data)
    {
        $randomNum = mt_rand(1011, 9999);
        $code = !empty($data['id']) ? strtoupper(trim($data['id'])) : ('CUST-' . $randomNum);

        // Ensure unique customer_code
        $baseCode = $code;
        $counter = 1;
        while ($this->db->where('customer_code', $code)->count_all_results($this->table) > 0) {
            $code = $baseCode . '-' . $counter++;
        }

        $email = strtolower(trim($data['email'] ?? ''));

        // If email already exists, update or return existing
        if (!empty($email)) {
            $existing = $this->db->where('email', $email)->get($this->table)->row_array();
            if ($existing) {
                $this->update($existing['id'], $data);
                return $existing['customer_code'];
            }
        }

        $now = date('Y-m-d H:i:s');

        // Handle password hashing
        $rawPassword = $data['password'] ?? 'Customer@123';
        $hashedPassword = (strpos($rawPassword, '$2y$') === 0) ? $rawPassword : password_hash($rawPassword, PASSWORD_DEFAULT);

        $insertData = [
            'customer_code' => $code,
            'name' => trim($data['name'] ?? 'Registered Customer'),
            'email' => $email,
            'mobile' => trim($data['mobile'] ?? '-'),
            'company' => trim($data['company'] ?? '-'),
            'gst_number' => !empty($data['gst_number']) ? strtoupper(trim($data['gst_number'])) : null,
            'address' => trim($data['address'] ?? 'Project Site / Office Address'),
            'city' => trim($data['city'] ?? 'Mumbai'),
            'state' => trim($data['state'] ?? 'Maharashtra'),
            'pincode' => trim($data['pincode'] ?? '400001'),
            'country' => trim($data['country'] ?? 'India'),
            'password' => $hashedPassword,
            'status' => in_array($data['status'] ?? '', ['active', 'inactive']) ? $data['status'] : 'active',
            'avatar' => !empty($data['avatar']) ? $data['avatar'] : ('assets/images/avatar/avatar-3.jpg'),
            'registered_at' => $now,
            'created_at' => $now,
            'updated_at' => $now
        ];

        $this->db->insert($this->table, $insertData);
        return $code;
    }

    /**
     * Update customer
     */
    public function update($id, array $data)
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        $numericId = $existing['numeric_id'];
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];

        $fields = ['name', 'email', 'mobile', 'company', 'gst_number', 'address', 'city', 'state', 'pincode', 'status', 'avatar', 'remember_token', 'remember_token_expires_at', 'reset_token', 'reset_token_expires_at'];
        foreach ($fields as $f) {
            if (isset($data[$f])) {
                $updateData[$f] = ($f === 'email') ? strtolower(trim($data[$f])) : trim($data[$f]);
            }
        }

        if (!empty($data['password'])) {
            $rawPass = $data['password'];
            $updateData['password'] = (strpos($rawPass, '$2y$') === 0) ? $rawPass : password_hash($rawPass, PASSWORD_DEFAULT);
        }

        return $this->db->where('id', $numericId)->update($this->table, $updateData);
    }

    /**
     * Toggle active / inactive status
     */
    public function toggleStatus($id)
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        $newStatus = ($existing['status'] === 'active') ? 'inactive' : 'active';
        $this->db->where('id', $existing['numeric_id'])->update($this->table, [
            'status' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $newStatus;
    }

    /**
     * Delete customer (Physical MySQL Deletion)
     */
    public function delete($id)
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        return $this->db->where('id', $existing['numeric_id'])->delete($this->table);
    }

    /**
     * Get enquiry & quotation history for a specific customer
     */
    public function getCustomerEnquiries($customer)
    {
        if (empty($customer)) {
            return [];
        }

        $this->load->model('Enquiry_model', 'enquiry_model');

        $numericId = $customer['numeric_id'] ?? null;
        $email = strtolower(trim($customer['email'] ?? ''));
        $mobile = preg_replace('/[^0-9]/', '', $customer['mobile'] ?? '');

        $this->db->from('enquiries e');
        $this->db->group_start();
        if ($numericId) {
            $this->db->where('e.customer_id', $numericId);
        }
        if (!empty($email)) {
            $this->db->or_where('LOWER(e.email)', $email);
        }
        if (!empty($mobile) && strlen($mobile) >= 7) {
            $this->db->or_like('e.mobile', substr($mobile, -7));
        }
        $this->db->group_end();

        $this->db->order_by('e.created_at', 'DESC');
        $rows = $this->db->get()->result_array();

        $customerEnquiries = [];
        foreach ($rows as $row) {
            $enq = $this->enquiry_model->getById($row['reference_no']);
            if ($enq) {
                $customerEnquiries[] = $enq;
            }
        }

        return $customerEnquiries;
    }

    /**
     * Summary stats for customer cards
     */
    public function getStats()
    {
        $total = $this->db->count_all($this->table);
        $active = $this->db->where('status', 'active')->count_all_results($this->table);
        $inactive = $this->db->where('status', 'inactive')->count_all_results($this->table);

        $business = $this->db->group_start()
            ->where('gst_number IS NOT NULL', NULL, FALSE)
            ->where('gst_number !=', '')
            ->or_where('company IS NOT NULL', NULL, FALSE)
            ->where('company !=', '')
            ->where('company !=', '-')
            ->group_end()
            ->count_all_results($this->table);

        $thisMonth = $this->db->where('DATE_FORMAT(registered_at, "%Y-%m") =', date('Y-m'))->count_all_results($this->table);

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'business' => $business,
            'this_month' => $thisMonth
        ];
    }

    /**
     * Get customer by email address
     */
    public function getByEmail($email)
    {
        if (empty($email)) return null;
        $row = $this->db->where('LOWER(email)', strtolower(trim($email)))->get($this->table)->row_array();
        return $row ? $this->_formatCustomer($row) : null;
    }

    /**
     * Validate customer login credentials
     */
    public function validateCredentials($email, $password)
    {
        $customer = $this->getByEmail($email);
        if (!$customer) {
            return ['success' => false, 'message' => 'The email or password is incorrect.'];
        }

        if (empty($customer['password'])) {
            return ['success' => false, 'message' => 'Please reset your password before logging in.'];
        }

        if (!password_verify($password, $customer['password'])) {
            return ['success' => false, 'message' => 'The email or password is incorrect.'];
        }

        if (strtolower($customer['status'] ?? 'active') !== 'active') {
            return ['success' => false, 'message' => 'Your account is currently inactive. Please contact support.'];
        }

        return ['success' => true, 'customer' => $customer];
    }

    /**
     * Generate secure persistent Remember Me token
     */
    public function generateRememberToken($customerId)
    {
        $customer = $this->getById($customerId);
        if (!$customer) return null;

        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 days

        $this->db->where('id', $customer['numeric_id'])->update($this->table, [
            'remember_token' => $tokenHash,
            'remember_token_expires_at' => $expiresAt
        ]);

        return $token;
    }

    /**
     * Get customer account matching a valid Remember Me token
     */
    public function getAccountByRememberToken($token)
    {
        if (empty($token)) return null;

        $tokenHash = hash('sha256', $token);
        $row = $this->db->where('remember_token', $tokenHash)
                        ->where('remember_token_expires_at >', date('Y-m-d H:i:s'))
                        ->where('status', 'active')
                        ->get($this->table)
                        ->row_array();

        return $row ? $this->_formatCustomer($row) : null;
    }

    /**
     * Clear Remember Me token on logout
     */
    public function clearRememberToken($customerId)
    {
        $customer = $this->getById($customerId);
        if (!$customer) return;

        $this->db->where('id', $customer['numeric_id'])->update($this->table, [
            'remember_token' => null,
            'remember_token_expires_at' => null
        ]);
    }

    /**
     * Create a secure password reset token (1-hour validity)
     */
    public function createPasswordResetToken($email)
    {
        $customer = $this->getByEmail($email);
        if (!$customer) return null;

        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = date('Y-m-d H:i:s', time() + 3600); // 1 hour

        $this->db->where('id', $customer['numeric_id'])->update($this->table, [
            'reset_token' => $tokenHash,
            'reset_token_expires_at' => $expiresAt
        ]);

        return [
            'token' => $token,
            'expires_at' => $expiresAt,
            'customer' => $customer
        ];
    }

    /**
     * Verify if a password reset token is valid
     */
    public function verifyPasswordResetToken($token)
    {
        if (empty($token)) return null;

        $tokenHash = hash('sha256', $token);
        $row = $this->db->where('reset_token', $tokenHash)
                        ->where('reset_token_expires_at >', date('Y-m-d H:i:s'))
                        ->get($this->table)
                        ->row_array();

        return $row ? $this->_formatCustomer($row) : null;
    }

    /**
     * Reset password using a valid token
     */
    public function resetPasswordWithToken($token, $newPassword)
    {
        $customer = $this->verifyPasswordResetToken($token);
        if (!$customer) return false;

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->db->where('id', $customer['numeric_id'])->update($this->table, [
            'password' => $hashedPassword,
            'reset_token' => null,
            'reset_token_expires_at' => null,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    /**
     * Resolve customer avatar URL
     */
    public function resolveAvatarUrl($avatar)
    {
        if (empty($avatar)) {
            return base_url('assets/images/avatar/avatar-3.jpg');
        }
        if (strpos($avatar, 'http://') === 0 || strpos($avatar, 'https://') === 0) {
            return $avatar;
        }
        if (strpos($avatar, 'assets/') === 0 || strpos($avatar, 'uploads/') === 0) {
            return base_url($avatar);
        }
        return base_url('uploads/customers/' . ltrim($avatar, '/'));
    }

    private function _formatCustomer(array $row)
    {
        $registeredTimestamp = strtotime($row['registered_at'] ?: $row['created_at']);
        $avatarUrl = $this->resolveAvatarUrl($row['avatar'] ?? '');

        return [
            'numeric_id' => (int)$row['id'],
            'id' => $row['customer_code'],
            'customer_code' => $row['customer_code'],
            'name' => $row['name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'company' => $row['company'],
            'gst_number' => $row['gst_number'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'pincode' => $row['pincode'],
            'country' => $row['country'],
            'password' => $row['password'] ?? null,
            'avatar' => $row['avatar'] ?? '',
            'avatar_url' => $avatarUrl,
            'image' => $avatarUrl,
            'status' => $row['status'],
            'remember_token' => $row['remember_token'] ?? null,
            'reset_token' => $row['reset_token'] ?? null,
            'registered_at' => $row['registered_at'],
            'date_formatted' => date('M d, Y', $registeredTimestamp),
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
        ];
    }
}