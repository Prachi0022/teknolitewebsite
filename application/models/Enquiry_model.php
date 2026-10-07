<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model {

    private $table = 'enquiries';
    private $itemsTable = 'enquiry_items';
    private $timelineTable = 'enquiry_timeline';

    public const STATUS_NEW = 'New';
    public const STATUS_IN_REVIEW = 'In Review';
    public const STATUS_QUOTATION_SENT = 'Quotation Sent';
    public const STATUS_CONFIRMED = 'Confirmed';
    public const STATUS_CLOSED = 'Closed';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all enquiries with flexible filters (search, status, date range)
     */
    public function getAll(array $filter = [])
    {
        $this->db->from($this->table . ' e');

        // Status filter
        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('LOWER(e.status)', strtolower(trim($filter['status'])));
        }

        // Date range filter
        if (!empty($filter['date_filter']) && $filter['date_filter'] !== 'all') {
            switch ($filter['date_filter']) {
                case 'today':
                    $this->db->where('DATE(e.created_at) =', date('Y-m-d'));
                    break;
                case 'this_week':
                    $this->db->where('YEARWEEK(e.created_at, 1) = YEARWEEK(CURDATE(), 1)');
                    break;
                case 'this_month':
                    $this->db->where('DATE_FORMAT(e.created_at, "%Y-%m") =', date('Y-m'));
                    break;
            }
        }

        // Search query
        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('e.reference_no', $search);
            $this->db->or_like('e.customer_name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.company_name', $search);
            $this->db->or_like('e.customer_message', $search);
            $this->db->or_like('e.admin_remark', $search);
            $this->db->group_end();
        }

        $this->db->order_by('e.created_at', 'DESC');
        $rows = $this->db->get()->result_array();

        $enquiries = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatEnquiry($row, true);
            $enquiries[$formatted['id']] = $formatted;
        }

        return $enquiries;
    }

    /**
     * Get paginated enquiry results
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        $this->db->from($this->table . ' e');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('LOWER(e.status)', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['date_filter']) && $filter['date_filter'] !== 'all') {
            switch ($filter['date_filter']) {
                case 'today':
                    $this->db->where('DATE(e.created_at) =', date('Y-m-d'));
                    break;
                case 'this_week':
                    $this->db->where('YEARWEEK(e.created_at, 1) = YEARWEEK(CURDATE(), 1)');
                    break;
                case 'this_month':
                    $this->db->where('DATE_FORMAT(e.created_at, "%Y-%m") =', date('Y-m'));
                    break;
            }
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('e.reference_no', $search);
            $this->db->or_like('e.customer_name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.company_name', $search);
            $this->db->or_like('e.customer_message', $search);
            $this->db->or_like('e.admin_remark', $search);
            $this->db->group_end();
        }

        $totalItems = $this->db->count_all_results();
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        // Fetch paginated
        $this->db->from($this->table . ' e');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('LOWER(e.status)', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['date_filter']) && $filter['date_filter'] !== 'all') {
            switch ($filter['date_filter']) {
                case 'today':
                    $this->db->where('DATE(e.created_at) =', date('Y-m-d'));
                    break;
                case 'this_week':
                    $this->db->where('YEARWEEK(e.created_at, 1) = YEARWEEK(CURDATE(), 1)');
                    break;
                case 'this_month':
                    $this->db->where('DATE_FORMAT(e.created_at, "%Y-%m") =', date('Y-m'));
                    break;
            }
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('e.reference_no', $search);
            $this->db->or_like('e.customer_name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.company_name', $search);
            $this->db->or_like('e.customer_message', $search);
            $this->db->or_like('e.admin_remark', $search);
            $this->db->group_end();
        }

        $this->db->order_by('e.created_at', 'DESC');
        $this->db->limit($perPage, $offset);

        $rows = $this->db->get()->result_array();
        $items = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatEnquiry($row, true);
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
     * Get single enquiry by ID or reference_no
     */
    public function getById($id)
    {
        if (empty($id)) return null;

        $cleanId = strtoupper(trim(str_replace(['#', '/80', ' '], '', $id)));

        $this->db->from($this->table . ' e');
        $this->db->group_start();
        $this->db->where('e.reference_no', $id);
        $this->db->or_where('e.reference_no', '#' . $cleanId . '/80');
        $this->db->or_where('e.reference_no', $cleanId);
        $this->db->or_like('e.reference_no', $cleanId);
        if (is_numeric($id)) {
            $this->db->or_where('e.id', (int)$id);
        }
        $this->db->group_end();

        $row = $this->db->get()->row_array();
        if ($row) {
            return $this->_formatEnquiry($row, true);
        }

        return null;
    }

    /**
     * Create new enquiry (used by frontend quote submission or admin)
     */
    public function create(array $data)
    {
        $randomNum = mt_rand(100000, 999999);
        $cleanId = !empty($data['id']) ? strtoupper(str_replace(['#', ' '], '', $data['id'])) : ('ENQ-' . $randomNum);
        $refNo = '#' . $cleanId . '/80';

        $name = trim($data['name'] ?? $data['customer_name'] ?? 'Website Visitor');
        $email = trim($data['email'] ?? '');
        $mobile = trim($data['mobile'] ?? '-');
        $company = trim($data['company'] ?? $data['company_name'] ?? '-');

        // Resolve customer_id if exists
        $customerId = null;
        if (!empty($email)) {
            $cRow = $this->db->where('email', $email)->get('customers')->row_array();
            if ($cRow) {
                $customerId = $cRow['id'];
            }
        }

        $now = date('Y-m-d H:i:s');

        // Build product items
        $products = [];
        if (!empty($data['products']) && is_array($data['products'])) {
            $products = $data['products'];
        } else if (!empty($data['product_name'])) {
            $qty = max(1, (int)($data['quantity'] ?? 1));
            $unitPrice = 1450.00;
            $taxRate = 0.18;
            $lineSubtotal = $unitPrice * $qty;
            $lineTax = $lineSubtotal * $taxRate;
            $products[] = [
                'name' => $data['product_name'],
                'sku' => 'TL-' . strtoupper(substr(md5($data['product_name']), 0, 6)),
                'category' => $data['product_category'] ?? 'Lighting Fixture',
                'image' => $data['product_image'] ?? 'assets/images/products/gamma.png',
                'url' => $data['product_url'] ?? '',
                'quantity' => $qty,
                'price' => $unitPrice,
                'tax' => $lineTax / $qty,
                'total' => $lineSubtotal + $lineTax,
                'status' => 'Ready',
                'specs' => 'Standard Commercial Spec'
            ];
        }

        $totalQty = 0;
        $subtotal = 0;
        foreach ($products as $p) {
            $totalQty += (int)($p['quantity'] ?? 1);
            $subtotal += (float)($p['price'] ?? 0) * (int)($p['quantity'] ?? 1);
        }
        $discount = 0.00;
        $tax = $subtotal * 0.18;
        $totalAmount = ($subtotal - $discount) + $tax;

        $insertData = [
            'reference_no' => $refNo,
            'customer_id' => $customerId,
            'customer_name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'company_name' => $company,
            'priority' => $data['priority'] ?? 'Normal',
            'status' => self::STATUS_NEW,
            'customer_message' => trim($data['message'] ?? $data['customer_message'] ?? ''),
            'admin_remark' => trim($data['admin_remark'] ?? 'New enquiry submitted.'),
            'total_quantity' => $totalQty ?: 1,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'delivery_charge' => 0.00,
            'tax_amount' => $tax,
            'total_amount' => $totalAmount,
            'shipping_contact_person' => $name,
            'shipping_company' => $company,
            'shipping_street' => $data['street'] ?? 'Project Site / Office Address',
            'shipping_city' => $data['city'] ?? 'Mumbai',
            'shipping_state' => $data['state'] ?? 'Maharashtra',
            'shipping_zip' => $data['zip'] ?? '400001',
            'shipping_country' => 'India',
            'shipping_phone' => $mobile,
            'created_by' => $data['created_by'] ?? 'Website Visitor',
            'created_at' => $now,
            'updated_at' => $now
        ];

        $this->db->insert($this->table, $insertData);
        $enquiryId = $this->db->insert_id();

        // Insert items
        foreach ($products as $p) {
            $qty = max(1, (int)($p['quantity'] ?? 1));
            $unitPrice = floatval($p['price'] ?? 1450.00);
            $taxVal = floatval($p['tax'] ?? ($unitPrice * 0.18));
            $totVal = floatval($p['total'] ?? (($unitPrice + $taxVal) * $qty));

            $this->db->insert($this->itemsTable, [
                'enquiry_id' => $enquiryId,
                'product_name' => $p['name'] ?? 'Lighting Fixture',
                'product_sku' => $p['sku'] ?? null,
                'product_category' => $p['category'] ?? 'Lighting Fixture',
                'product_image' => $p['image'] ?? 'assets/images/products/gamma.png',
                'product_url' => $p['url'] ?? '',
                'quantity' => $qty,
                'unit_price' => $unitPrice,
                'tax' => $taxVal,
                'total_price' => $totVal,
                'status' => $p['status'] ?? 'Ready',
                'specs' => is_array($p['specs'] ?? null) ? json_encode($p['specs']) : ($p['specs'] ?? ''),
                'created_at' => $now
            ]);
        }

        // Insert initial timeline
        $this->db->insert($this->timelineTable, [
            'enquiry_id' => $enquiryId,
            'title' => 'Enquiry Received',
            'description' => 'Enquiry logged into system.',
            'actor' => $data['created_by'] ?? 'System',
            'icon' => 'solar:inbox-line-broken',
            'created_at' => $now
        ]);

        return $cleanId;
    }

    /**
     * Update Enquiry Status, Admin Remark, and Priority
     */
    public function updateStatus($id, $newStatus, $remark = '', $priority = null, $user = 'Admin')
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        $numericId = $existing['numeric_id'];
        $oldStatus = $existing['status'];

        $allowedStatuses = [
            self::STATUS_NEW,
            self::STATUS_IN_REVIEW,
            self::STATUS_QUOTATION_SENT,
            self::STATUS_CONFIRMED,
            self::STATUS_CLOSED
        ];

        $updateData = ['updated_at' => date('Y-m-d H:i:s')];

        if (in_array($newStatus, $allowedStatuses)) {
            $updateData['status'] = $newStatus;
        }

        if (!empty($priority)) {
            $updateData['priority'] = $priority;
        }

        if (trim($remark) !== '') {
            $updateData['admin_remark'] = trim($remark);
        }

        $this->db->where('id', $numericId)->update($this->table, $updateData);

        // Add timeline record
        $iconMap = [
            self::STATUS_NEW => 'solar:inbox-line-broken',
            self::STATUS_IN_REVIEW => 'solar:clipboard-check-broken',
            self::STATUS_QUOTATION_SENT => 'solar:letter-opened-broken',
            self::STATUS_CONFIRMED => 'solar:check-circle-broken',
            self::STATUS_CLOSED => 'solar:check-read-broken'
        ];

        $timelineDesc = trim($remark);
        if ($timelineDesc === '') {
            $timelineDesc = ($oldStatus !== $newStatus) 
                ? "Status transitioned from {$oldStatus} to {$newStatus}." 
                : "Admin details updated.";
        }

        $this->db->insert($this->timelineTable, [
            'enquiry_id' => $numericId,
            'title' => ($oldStatus !== $newStatus) ? "Status: {$newStatus}" : "Admin Remark Added",
            'description' => $timelineDesc,
            'actor' => $user,
            'icon' => $iconMap[$newStatus] ?? 'solar:check-circle-broken',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    /**
     * Delete Enquiry (Physical MySQL Deletion)
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
     * Statistics for the top cards
     */
    public function getStats()
    {
        $total = $this->db->count_all($this->table);
        $new = $this->db->where('status', self::STATUS_NEW)->count_all_results($this->table);
        $inReview = $this->db->where('status', self::STATUS_IN_REVIEW)->count_all_results($this->table);
        $quotationSent = $this->db->where('status', self::STATUS_QUOTATION_SENT)->count_all_results($this->table);
        $confirmed = $this->db->where('status', self::STATUS_CONFIRMED)->count_all_results($this->table);
        $closed = $this->db->where('status', self::STATUS_CLOSED)->count_all_results($this->table);

        $highPriority = $this->db->group_start()
            ->where('priority', 'High')
            ->or_where('priority', 'Urgent')
            ->group_end()
            ->count_all_results($this->table);

        $thisMonth = $this->db->where('DATE_FORMAT(created_at, "%Y-%m") =', date('Y-m'))->count_all_results($this->table);

        return [
            'total' => $total,
            'new' => $new,
            'in_review' => $inReview,
            'quotation_sent' => $quotationSent,
            'confirmed' => $confirmed,
            'closed' => $closed,
            'high_priority' => $highPriority,
            'this_month' => $thisMonth
        ];
    }

    /**
     * Format an enquiry row for view compatibility
     */
    private function _formatEnquiry(array $row, $loadRelations = true)
    {
        $numericId = (int)$row['id'];
        $cleanId = strtoupper(trim(str_replace(['#', '/80', ' '], '', $row['reference_no'])));

        $products = [];
        $timeline = [];

        if ($loadRelations) {
            $items = $this->db->where('enquiry_id', $numericId)->get($this->itemsTable)->result_array();
            foreach ($items as $it) {
                $products[] = [
                    'id' => $it['id'],
                    'product_id' => $it['product_id'],
                    'name' => $it['product_name'],
                    'sku' => $it['product_sku'],
                    'category' => $it['product_category'],
                    'image' => $it['product_image'],
                    'url' => $it['product_url'],
                    'quantity' => (int)$it['quantity'],
                    'price' => (float)$it['unit_price'],
                    'tax' => (float)$it['tax'],
                    'total' => (float)$it['total_price'],
                    'status' => $it['status'],
                    'specs' => $it['specs']
                ];
            }

            $tlines = $this->db->where('enquiry_id', $numericId)->order_by('created_at', 'ASC')->get($this->timelineTable)->result_array();
            foreach ($tlines as $tl) {
                $timeline[] = [
                    'date' => date('M d, Y, h:i a', strtotime($tl['created_at'])),
                    'title' => $tl['title'],
                    'description' => $tl['description'],
                    'user' => $tl['actor'],
                    'icon' => $tl['icon']
                ];
            }
        }

        $createdTimestamp = strtotime($row['created_at']);

        return [
            'numeric_id' => $numericId,
            'id' => $cleanId,
            'reference' => $row['reference_no'],
            'reference_no' => $row['reference_no'],
            'customer_id' => $row['customer_id'],
            'customer_name' => $row['customer_name'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'company_name' => $row['company_name'],
            'priority' => $row['priority'],
            'status' => $row['status'],
            'customer_message' => $row['customer_message'],
            'admin_remark' => $row['admin_remark'],
            'total_quantity' => (int)$row['total_quantity'],
            'created_at' => $row['created_at'],
            'date_formatted' => date('M d, Y', $createdTimestamp),
            'time_formatted' => date('h:i a', $createdTimestamp),
            'products' => $products,
            'financials' => [
                'subtotal' => (float)$row['subtotal'],
                'discount' => (float)$row['discount'],
                'delivery_charge' => (float)$row['delivery_charge'],
                'tax_amount' => (float)$row['tax_amount'],
                'total_amount' => (float)$row['total_amount']
            ],
            'shipping_address' => [
                'contact_person' => $row['shipping_contact_person'],
                'company' => $row['shipping_company'],
                'street' => $row['shipping_street'],
                'city' => $row['shipping_city'],
                'state' => $row['shipping_state'],
                'zip' => $row['shipping_zip'],
                'country' => $row['shipping_country'],
                'phone' => $row['shipping_phone']
            ],
            'billing_address' => [
                'same_as_shipping' => true
            ],
            'timeline' => $timeline
        ];
    }
}