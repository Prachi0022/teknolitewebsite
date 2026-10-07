<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist_model extends CI_Model {

    private $table = 'customer_wishlist';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Resolve customer identifier to numeric primary key
     *
     * @param int|string $customerId
     * @return int
     */
    private function _resolveNumericCustomerId($customerId)
    {
        if (is_array($customerId)) {
            if (!empty($customerId['numeric_id'])) return (int)$customerId['numeric_id'];
            if (!empty($customerId['id'])) $customerId = $customerId['id'];
            else if (!empty($customerId['customer_code'])) $customerId = $customerId['customer_code'];
            else if (!empty($customerId['email'])) $customerId = $customerId['email'];
        }

        if (is_numeric($customerId) && (int)$customerId > 0) {
            return (int)$customerId;
        }

        if (is_string($customerId) && !empty($customerId)) {
            $cleanCode = strtoupper(trim(str_replace('#', '', $customerId)));
            $cleanEmail = strtolower(trim($customerId));
            $row = $this->db->select('id')->from('customers')
                            ->group_start()
                                ->where('customer_code', $cleanCode)
                                ->or_where('LOWER(email)', $cleanEmail)
                                ->or_where('id', (int)$customerId)
                            ->group_end()
                            ->get()->row_array();
            if ($row && !empty($row['id'])) {
                return (int)$row['id'];
            }
        }

        return 0;
    }

    /**
     * Get all wishlist items for a specific customer
     *
     * @param int|string $customerId
     * @return array
     */
    public function getItemsByCustomerId($customerId)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        if ($customerId <= 0) {
            return [];
        }

        $this->db->from($this->table)
                 ->where('customer_id', $customerId)
                 ->order_by('created_at', 'DESC');

        $rows = $this->db->get()->result_array();
        $items = [];
        foreach ($rows as $row) {
            $items[] = [
                'id'             => (string)$row['product_id'],
                'name'           => (string)$row['product_name'],
                'category'       => (string)($row['product_category'] ?? 'Architectural Lighting'),
                'category_label' => (string)($row['product_category'] ?? 'Architectural Lighting'),
                'image'          => (string)($row['product_image'] ?? 'assets/images/products/gamma.png'),
                'hover'          => (string)($row['product_image'] ?? 'assets/images/products/gamma.png'),
                'url'            => (string)($row['product_url'] ?? 'productdetail')
            ];
        }

        return $items;
    }

    /**
     * Add single item to customer's wishlist
     *
     * @param int|string $customerId
     * @param array $product
     * @return bool
     */
    public function addItem($customerId, array $product)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        $productId = trim((string)($product['id'] ?? ''));

        if ($customerId <= 0 || empty($productId)) {
            return false;
        }

        $name = trim((string)($product['name'] ?? 'Lighting Fixture'));
        $category = trim((string)($product['category'] ?? ($product['category_label'] ?? 'Architectural Lighting')));
        $image = trim((string)($product['image'] ?? 'assets/images/products/gamma.png'));
        $url = trim((string)($product['url'] ?? 'productdetail'));

        // Check if item already exists
        $existing = $this->db->from($this->table)
                             ->where('customer_id', $customerId)
                             ->where('product_id', $productId)
                             ->count_all_results();

        if ($existing > 0) {
            // Update in case image or URL changed
            $this->db->where('customer_id', $customerId)
                     ->where('product_id', $productId)
                     ->update($this->table, [
                         'product_name'     => $name,
                         'product_category' => $category,
                         'product_image'    => $image,
                         'product_url'      => $url
                     ]);
            return true;
        }

        return $this->db->insert($this->table, [
            'customer_id'      => $customerId,
            'product_id'       => $productId,
            'product_name'     => $name,
            'product_category' => $category,
            'product_image'    => $image,
            'product_url'      => $url,
            'created_at'       => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Remove an item from customer's wishlist
     *
     * @param int|string $customerId
     * @param string $productId
     * @return bool
     */
    public function removeItem($customerId, $productId)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        $productId = trim((string) $productId);

        if ($customerId <= 0 || empty($productId)) {
            return false;
        }

        return $this->db->where('customer_id', $customerId)
                        ->where('product_id', $productId)
                        ->delete($this->table);
    }

    /**
     * Clear all items in customer's wishlist
     *
     * @param int|string $customerId
     * @return bool
     */
    public function clearItems($customerId)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        if ($customerId <= 0) {
            return false;
        }

        return $this->db->where('customer_id', $customerId)
                        ->delete($this->table);
    }

    /**
     * Sync/merge multiple items (e.g. from local storage) into customer wishlist
     *
     * @param int|string $customerId
     * @param array $items
     * @return array Updated list of items
     */
    public function syncItems($customerId, array $items)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        if ($customerId <= 0) {
            return [];
        }

        foreach ($items as $item) {
            if (is_array($item) && !empty($item['id'])) {
                $this->addItem($customerId, $item);
            }
        }

        return $this->getItemsByCustomerId($customerId);
    }

    /**
     * Count items in customer's wishlist
     *
     * @param int|string $customerId
     * @return int
     */
    public function getCount($customerId)
    {
        $customerId = $this->_resolveNumericCustomerId($customerId);
        if ($customerId <= 0) {
            return 0;
        }

        return (int) $this->db->where('customer_id', $customerId)->count_all_results($this->table);
    }
}