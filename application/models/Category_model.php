<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    private $table = 'categories';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all categories with optional search and status filter
     */
    public function getAll(array $filter = [])
    {
        $this->db->select('c.*, 
            (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id OR LOWER(p.category_name) = LOWER(c.name)) AS product_count');
        $this->db->from($this->table . ' c');

        // Filter by Search Query
        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.short_description', $search);
            $this->db->or_like('c.tag_id', $search);
            $this->db->or_like('c.slug', $search);
            $this->db->group_end();
        }

        // Filter by Status
        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('c.status', $filter['status']);
        }

        // Sort by display_order ASC, then name ASC
        $this->db->order_by('c.display_order', 'ASC');
        $this->db->order_by('c.name', 'ASC');

        $rows = $this->db->get()->result_array();

        // Key array by slug for view backwards-compatibility, and preserve id
        $categories = [];
        foreach ($rows as $row) {
            $row['numeric_id'] = $row['id'];
            $row['id'] = $row['slug']; // View files use $cat['id'] as the slug identifier
            $categories[$row['slug']] = $row;
        }

        return $categories;
    }

    /**
     * Get paginated category list
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        // Get total count matching filter
        $this->db->from($this->table . ' c');
        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.short_description', $search);
            $this->db->or_like('c.tag_id', $search);
            $this->db->or_like('c.slug', $search);
            $this->db->group_end();
        }
        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('c.status', $filter['status']);
        }
        $totalItems = $this->db->count_all_results();

        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $currentPage = max(1, min((int)$page, $totalPages));
        $offset = ($currentPage - 1) * $perPage;

        // Fetch paginated items
        $this->db->select('c.*, 
            (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id OR LOWER(p.category_name) = LOWER(c.name)) AS product_count');
        $this->db->from($this->table . ' c');

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('c.name', $search);
            $this->db->or_like('c.short_description', $search);
            $this->db->or_like('c.tag_id', $search);
            $this->db->or_like('c.slug', $search);
            $this->db->group_end();
        }
        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('c.status', $filter['status']);
        }

        $this->db->order_by('c.display_order', 'ASC');
        $this->db->order_by('c.name', 'ASC');
        $this->db->limit($perPage, $offset);

        $rows = $this->db->get()->result_array();
        $items = [];
        foreach ($rows as $row) {
            $row['numeric_id'] = $row['id'];
            $row['id'] = $row['slug'];
            $items[$row['slug']] = $row;
        }

        return [
            'items' => $items,
            'total_items' => $totalItems,
            'total_pages' => $totalPages,
            'current_page' => $currentPage,
            'per_page' => $perPage
        ];
    }

    /**
     * Get single category by ID, slug, or tag_id
     */
    public function getById($id)
    {
        if (empty($id)) {
            return null;
        }

        $this->db->select('c.*, 
            (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id OR LOWER(p.category_name) = LOWER(c.name)) AS product_count');
        $this->db->from($this->table . ' c');

        if (is_numeric($id)) {
            $this->db->where('c.id', (int)$id);
        } else {
            $this->db->group_start();
            $this->db->where('c.slug', $id);
            $this->db->or_where('c.tag_id', $id);
            $this->db->or_where('LOWER(c.name)', strtolower($id));
            $this->db->group_end();
        }

        $row = $this->db->get()->row_array();
        if ($row) {
            $row['numeric_id'] = $row['id'];
            $row['id'] = $row['slug'];
            return $row;
        }

        return null;
    }

    /**
     * Create a new Category
     */
    public function create(array $data)
    {
        $name = trim($data['name'] ?? 'New Category');
        $slug = !empty($data['slug']) ? $this->_generateSlug($data['slug']) : $this->_generateSlug($name);

        // Ensure unique slug
        $baseSlug = $slug;
        $counter = 1;
        while ($this->db->where('slug', $slug)->count_all_results($this->table) > 0) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $tagId = !empty($data['tag_id']) ? trim($data['tag_id']) : ('CAT-' . strtoupper(substr(md5(uniqid()), 0, 5)));

        $displayOrder = isset($data['display_order']) && $data['display_order'] !== '' 
            ? (int)$data['display_order'] 
            : ($this->db->count_all($this->table) + 1);

        $insertData = [
            'name' => $name,
            'slug' => $slug,
            'tag_id' => $tagId,
            'image' => !empty($data['image']) ? $data['image'] : 'assets/images/products/gamma.png',
            'short_description' => trim($data['short_description'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'starting_price' => (float)($data['starting_price'] ?? 1000),
            'stock' => (int)($data['stock'] ?? 100),
            'display_order' => $displayOrder,
            'status' => in_array($data['status'] ?? '', ['active', 'inactive']) ? $data['status'] : 'active',
            'created_by' => !empty($data['created_by']) ? $data['created_by'] : 'Admin',
            'meta_title' => trim($data['meta_title'] ?? ($name . ' | TeknoLite')),
            'meta_keywords' => trim($data['meta_keywords'] ?? strtolower($name)),
            'meta_description' => trim($data['meta_description'] ?? ''),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert($this->table, $insertData);
        return $slug;
    }

    /**
     * Update an existing Category
     */
    public function update($id, array $data)
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        $numericId = $existing['numeric_id'];
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];

        if (isset($data['name'])) $updateData['name'] = trim($data['name']);
        if (!empty($data['image'])) $updateData['image'] = $data['image'];
        if (isset($data['short_description'])) $updateData['short_description'] = trim($data['short_description']);
        if (isset($data['description'])) $updateData['description'] = trim($data['description']);
        if (isset($data['display_order'])) $updateData['display_order'] = (int)$data['display_order'];
        if (isset($data['status']) && in_array($data['status'], ['active', 'inactive'])) $updateData['status'] = $data['status'];
        if (isset($data['created_by'])) $updateData['created_by'] = trim($data['created_by']);
        if (isset($data['tag_id'])) $updateData['tag_id'] = trim($data['tag_id']);
        if (isset($data['starting_price'])) $updateData['starting_price'] = (float)$data['starting_price'];
        if (isset($data['stock'])) $updateData['stock'] = (int)$data['stock'];
        if (isset($data['meta_title'])) $updateData['meta_title'] = trim($data['meta_title']);
        if (isset($data['meta_keywords'])) $updateData['meta_keywords'] = trim($data['meta_keywords']);
        if (isset($data['meta_description'])) $updateData['meta_description'] = trim($data['meta_description']);

        if (!empty($data['slug'])) {
            $newSlug = $this->_generateSlug($data['slug']);
            if ($newSlug !== $existing['slug']) {
                $check = $this->db->where('slug', $newSlug)->where('id !=', $numericId)->count_all_results($this->table);
                if ($check === 0) {
                    $updateData['slug'] = $newSlug;
                }
            }
        }

        return $this->db->where('id', $numericId)->update($this->table, $updateData);
    }

    /**
     * Delete a Category (Physical MySQL Deletion)
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
     * Toggle Category Status (active <-> inactive)
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
     * Get active categories for dropdowns and frontend
     */
    public function getActiveCategories()
    {
        return $this->getAll(['status' => 'active']);
    }

    /**
     * Get product count mapped by category name and slug
     */
    public function getProductCounts()
    {
        $this->db->select('c.slug, c.name, COUNT(p.id) AS count');
        $this->db->from($this->table . ' c');
        $this->db->join('products p', 'p.category_id = c.id OR LOWER(p.category_name) = LOWER(c.name)', 'left');
        $this->db->group_by('c.id');
        $query = $this->db->get();

        $counts = [];
        foreach ($query->result_array() as $row) {
            $counts[$row['slug']] = (int)$row['count'];
            $counts[strtolower($row['name'])] = (int)$row['count'];
        }

        return $counts;
    }

    /**
     * Generate URL slug
     */
    private function _generateSlug($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text ?: 'category');
    }
}