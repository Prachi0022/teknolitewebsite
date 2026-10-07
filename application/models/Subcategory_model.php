<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

    private $table = 'subcategories';
    private $categoryTable = 'categories';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all subcategories with optional search, parent category, and status filter
     */
    public function getAll(array $filter = [])
    {
        $this->db->select('s.*, c.name AS category_name, c.slug AS category_slug,
            (SELECT COUNT(*) FROM products p WHERE p.subcategory_id = s.id OR LOWER(p.subcategory_name) = LOWER(s.name)) AS product_count');
        $this->db->from($this->table . ' s');
        $this->db->join($this->categoryTable . ' c', 's.category_id = c.id', 'left');

        // Filter by Parent Category ID or Slug
        if (!empty($filter['category_id']) && $filter['category_id'] !== 'all') {
            $cat = trim($filter['category_id']);
            if (is_numeric($cat)) {
                $this->db->where('s.category_id', (int)$cat);
            } else {
                $this->db->group_start();
                $this->db->where('c.slug', $cat);
                $this->db->or_where('LOWER(c.name)', strtolower($cat));
                $this->db->group_end();
            }
        }

        // Filter by Search Term
        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('s.description', $search);
            $this->db->or_like('s.tag_id', $search);
            $this->db->or_like('s.slug', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }

        // Filter by Status
        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('s.status', $filter['status']);
        }

        $this->db->order_by('s.display_order', 'ASC');
        $this->db->order_by('s.name', 'ASC');

        $rows = $this->db->get()->result_array();

        $subcategories = [];
        foreach ($rows as $row) {
            $row['numeric_id'] = $row['id'];
            $row['id'] = $row['slug'];
            $subcategories[$row['slug']] = $row;
        }

        return $subcategories;
    }

    /**
     * Get paginated subcategories
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        $this->db->from($this->table . ' s');
        $this->db->join($this->categoryTable . ' c', 's.category_id = c.id', 'left');

        if (!empty($filter['category_id']) && $filter['category_id'] !== 'all') {
            $cat = trim($filter['category_id']);
            if (is_numeric($cat)) {
                $this->db->where('s.category_id', (int)$cat);
            } else {
                $this->db->group_start();
                $this->db->where('c.slug', $cat);
                $this->db->or_where('LOWER(c.name)', strtolower($cat));
                $this->db->group_end();
            }
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('s.description', $search);
            $this->db->or_like('s.tag_id', $search);
            $this->db->or_like('s.slug', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }

        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('s.status', $filter['status']);
        }

        $totalItems = $this->db->count_all_results();
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $currentPage = max(1, min((int)$page, $totalPages));
        $offset = ($currentPage - 1) * $perPage;

        // Fetch items
        $this->db->select('s.*, c.name AS category_name, c.slug AS category_slug,
            (SELECT COUNT(*) FROM products p WHERE p.subcategory_id = s.id OR LOWER(p.subcategory_name) = LOWER(s.name)) AS product_count');
        $this->db->from($this->table . ' s');
        $this->db->join($this->categoryTable . ' c', 's.category_id = c.id', 'left');

        if (!empty($filter['category_id']) && $filter['category_id'] !== 'all') {
            $cat = trim($filter['category_id']);
            if (is_numeric($cat)) {
                $this->db->where('s.category_id', (int)$cat);
            } else {
                $this->db->group_start();
                $this->db->where('c.slug', $cat);
                $this->db->or_where('LOWER(c.name)', strtolower($cat));
                $this->db->group_end();
            }
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('s.description', $search);
            $this->db->or_like('s.tag_id', $search);
            $this->db->or_like('s.slug', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }

        if (!empty($filter['status']) && in_array($filter['status'], ['active', 'inactive'])) {
            $this->db->where('s.status', $filter['status']);
        }

        $this->db->order_by('s.display_order', 'ASC');
        $this->db->order_by('s.name', 'ASC');
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
     * Get subcategory by ID, slug, or tag_id
     */
    public function getById($id)
    {
        if (empty($id)) {
            return null;
        }

        $this->db->select('s.*, c.name AS category_name, c.slug AS category_slug,
            (SELECT COUNT(*) FROM products p WHERE p.subcategory_id = s.id OR LOWER(p.subcategory_name) = LOWER(s.name)) AS product_count');
        $this->db->from($this->table . ' s');
        $this->db->join($this->categoryTable . ' c', 's.category_id = c.id', 'left');

        if (is_numeric($id)) {
            $this->db->where('s.id', (int)$id);
        } else {
            $this->db->group_start();
            $this->db->where('s.slug', $id);
            $this->db->or_where('s.tag_id', $id);
            $this->db->or_where('LOWER(s.name)', strtolower($id));
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
     * Get active subcategories under a specific parent category
     */
    public function getByCategory($categoryId)
    {
        return $this->getAll([
            'category_id' => $categoryId,
            'status' => 'active'
        ]);
    }

    /**
     * Create a new Subcategory
     */
    public function create(array $data)
    {
        $name = trim($data['name'] ?? 'New Subcategory');
        $slug = !empty($data['slug']) ? $this->_generateSlug($data['slug']) : $this->_generateSlug($name);

        $baseSlug = $slug;
        $counter = 1;
        while ($this->db->where('slug', $slug)->count_all_results($this->table) > 0) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $tagId = !empty($data['tag_id']) ? trim($data['tag_id']) : ('SUB-' . strtoupper(substr(md5(uniqid()), 0, 5)));

        // Resolve parent category ID
        $parentCatId = 1;
        $catInput = trim($data['category_id'] ?? $data['category_name'] ?? '');
        if (!empty($catInput)) {
            if (is_numeric($catInput)) {
                $parentCatId = (int)$catInput;
            } else {
                $cRow = $this->db->where('slug', $catInput)->or_where('LOWER(name)', strtolower($catInput))->get($this->categoryTable)->row_array();
                if ($cRow) {
                    $parentCatId = $cRow['id'];
                }
            }
        }

        $displayOrder = isset($data['display_order']) && $data['display_order'] !== '' 
            ? (int)$data['display_order'] 
            : ($this->db->count_all($this->table) + 1);

        $insertData = [
            'category_id' => $parentCatId,
            'name' => $name,
            'slug' => $slug,
            'tag_id' => $tagId,
            'description' => trim($data['description'] ?? ''),
            'display_order' => $displayOrder,
            'status' => in_array($data['status'] ?? '', ['active', 'inactive']) ? $data['status'] : 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert($this->table, $insertData);
        return $slug;
    }

    /**
     * Update an existing Subcategory
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
        if (isset($data['description'])) $updateData['description'] = trim($data['description']);
        if (isset($data['display_order'])) $updateData['display_order'] = (int)$data['display_order'];
        if (isset($data['status']) && in_array($data['status'], ['active', 'inactive'])) $updateData['status'] = $data['status'];
        if (isset($data['tag_id'])) $updateData['tag_id'] = trim($data['tag_id']);

        if (!empty($data['category_id'])) {
            $catInput = trim($data['category_id']);
            if (is_numeric($catInput)) {
                $updateData['category_id'] = (int)$catInput;
            } else {
                $cRow = $this->db->where('slug', $catInput)->or_where('LOWER(name)', strtolower($catInput))->get($this->categoryTable)->row_array();
                if ($cRow) {
                    $updateData['category_id'] = $cRow['id'];
                }
            }
        }

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
     * Delete a Subcategory (Physical MySQL Deletion)
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
     * Toggle Subcategory Status
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
     * Get active subcategories (optionally filtered by parent category)
     */
    public function getActiveSubcategories($categoryId = null)
    {
        $filter = ['status' => 'active'];
        if (!empty($categoryId) && $categoryId !== 'all') {
            $filter['category_id'] = $categoryId;
        }
        return $this->getAll($filter);
    }

    /**
     * Get product counts mapped by subcategory name
     */
    public function getProductCounts()
    {
        $this->db->select('s.slug, s.name, COUNT(p.id) AS count');
        $this->db->from($this->table . ' s');
        $this->db->join('products p', 'p.subcategory_id = s.id OR LOWER(p.subcategory_name) = LOWER(s.name)', 'left');
        $this->db->group_by('s.id');
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
        return strtolower($text ?: 'subcategory');
    }
}