<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    private $table = 'blogs';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all blogs with optional filters
     */
    public function getAll(array $filter = [])
    {
        $this->db->from($this->table . ' b');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('b.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['category']) && strtolower($filter['category']) !== 'all') {
            $cat = strtolower(trim($filter['category']));
            $this->db->group_start()
                     ->where('LOWER(b.category_slug)', $cat)
                     ->or_where('LOWER(b.category)', $cat)
                     ->group_end();
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start()
                     ->like('b.title', $search)
                     ->or_like('b.short_description', $search)
                     ->or_like('b.author', $search)
                     ->or_like('b.category', $search)
                     ->or_like('b.content', $search)
                     ->group_end();
        }

        $this->db->order_by('b.published_date', 'DESC');
        $this->db->order_by('b.id', 'DESC');

        if (!empty($filter['limit'])) {
            $offset = !empty($filter['offset']) ? (int)$filter['offset'] : 0;
            $this->db->limit((int)$filter['limit'], $offset);
        }

        $rows = $this->db->get()->result_array();

        $items = [];
        foreach ($rows as $row) {
            $items[] = $this->_formatBlog($row);
        }

        return $items;
    }

    /**
     * Paginated blog items for admin list
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        // 1. Total count query
        $this->db->from($this->table . ' b');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('b.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['category']) && strtolower($filter['category']) !== 'all') {
            $cat = strtolower(trim($filter['category']));
            $this->db->group_start()
                     ->where('LOWER(b.category_slug)', $cat)
                     ->or_where('LOWER(b.category)', $cat)
                     ->group_end();
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start()
                     ->like('b.title', $search)
                     ->or_like('b.short_description', $search)
                     ->or_like('b.author', $search)
                     ->or_like('b.category', $search)
                     ->or_like('b.content', $search)
                     ->group_end();
        }

        $totalItems = $this->db->count_all_results();
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        // 2. Fetch page items
        $this->db->from($this->table . ' b');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('b.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['category']) && strtolower($filter['category']) !== 'all') {
            $cat = strtolower(trim($filter['category']));
            $this->db->group_start()
                     ->where('LOWER(b.category_slug)', $cat)
                     ->or_where('LOWER(b.category)', $cat)
                     ->group_end();
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start()
                     ->like('b.title', $search)
                     ->or_like('b.short_description', $search)
                     ->or_like('b.author', $search)
                     ->or_like('b.category', $search)
                     ->or_like('b.content', $search)
                     ->group_end();
        }

        $this->db->order_by('b.published_date', 'DESC');
        $this->db->order_by('b.id', 'DESC');
        $this->db->limit($perPage, $offset);

        $rows = $this->db->get()->result_array();

        $items = [];
        foreach ($rows as $row) {
            $items[] = $this->_formatBlog($row);
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
     * Get single blog by numeric ID
     */
    public function getById($id)
    {
        $row = $this->db->where('id', (int)$id)->get($this->table)->row_array();
        return $row ? $this->_formatBlog($row) : null;
    }

    /**
     * Get single blog by slug (or fallback to ID)
     */
    public function getBySlug($slug)
    {
        if (empty($slug)) {
            return null;
        }

        $row = $this->db->where('slug', trim($slug))->get($this->table)->row_array();
        if (!$row && is_numeric($slug)) {
            $row = $this->db->where('id', (int)$slug)->get($this->table)->row_array();
        }

        return $row ? $this->_formatBlog($row) : null;
    }

    /**
     * Get active blogs for frontend
     */
    public function getActiveBlogs($categorySlug = null, $search = null, $limit = null, $offset = 0)
    {
        $filter = ['status' => 'active'];
        if (!empty($categorySlug) && $categorySlug !== 'all') {
            $filter['category'] = $categorySlug;
        }
        if (!empty($search)) {
            $filter['search'] = $search;
        }
        if (!empty($limit)) {
            $filter['limit'] = $limit;
            $filter['offset'] = $offset;
        }

        return $this->getAll($filter);
    }

    /**
     * Get latest blogs (e.g. for homepage)
     */
    public function getLatestBlogs($limit = 3)
    {
        return $this->getAll([
            'status' => 'active',
            'limit'  => (int)$limit
        ]);
    }

    /**
     * Get recent/related blogs excluding current
     */
    public function getRecentBlogs($excludeId = null, $limit = 4)
    {
        $this->db->from($this->table . ' b')
                 ->where('b.status', 'active');

        if (!empty($excludeId)) {
            $this->db->where('b.id !=', (int)$excludeId);
        }

        $this->db->order_by('b.published_date', 'DESC')
                 ->order_by('b.id', 'DESC')
                 ->limit((int)$limit);

        $rows = $this->db->get()->result_array();

        $items = [];
        foreach ($rows as $row) {
            $items[] = $this->_formatBlog($row);
        }

        return $items;
    }

    /**
     * Get distinct categories with blog counts
     */
    public function getCategories()
    {
        $this->db->select('category, category_slug, COUNT(*) as count')
                 ->from($this->table)
                 ->where('status', 'active')
                 ->group_by('category, category_slug')
                 ->order_by('count', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Create new blog post
     */
    public function create(array $data)
    {
        if (empty($data['title'])) {
            return false;
        }

        // Auto-generate slug if empty
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['title']);
        } else {
            $data['slug'] = $this->generateSlug($data['slug']);
        }

        // Auto slugify category if not provided
        if (empty($data['category_slug']) && !empty($data['category'])) {
            $data['category_slug'] = url_title(strtolower(trim($data['category'])), '-', TRUE);
        }

        if (empty($data['published_date'])) {
            $data['published_date'] = date('Y-m-d');
        }

        if (empty($data['author'])) {
            $data['author'] = 'TeknoLite Team';
        }

        if (empty($data['status'])) {
            $data['status'] = 'active';
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update existing blog post
     */
    public function update($id, array $data)
    {
        $id = (int)$id;
        if (empty($id)) {
            return false;
        }

        if (!empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['slug'], $id);
        } elseif (!empty($data['title'])) {
            $current = $this->getById($id);
            if (empty($current['slug'])) {
                $data['slug'] = $this->generateSlug($data['title'], $id);
            }
        }

        if (!empty($data['category']) && empty($data['category_slug'])) {
            $data['category_slug'] = url_title(strtolower(trim($data['category'])), '-', TRUE);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete blog post by ID
     */
    public function delete($id)
    {
        $id = (int)$id;
        if (empty($id)) {
            return false;
        }

        $blog = $this->getById($id);
        if ($blog && !empty($blog['featured_image']) && strpos($blog['featured_image'], 'uploads/blogs/') !== false) {
            $fullPath = FCPATH . $blog['featured_image'];
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }

        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Toggle status (active / inactive)
     */
    public function toggleStatus($id)
    {
        $id = (int)$id;
        $blog = $this->getById($id);
        if (!$blog) {
            return false;
        }

        $newStatus = ($blog['status'] === 'active') ? 'inactive' : 'active';
        $this->update($id, ['status' => $newStatus]);
        return $newStatus;
    }

    /**
     * Increment views
     */
    public function incrementViews($id)
    {
        $id = (int)$id;
        if (!empty($id)) {
            $this->db->set('views', 'views + 1', FALSE)
                     ->where('id', $id)
                     ->update($this->table);
        }
    }

    /**
     * Generate unique URL slug
     */
    public function generateSlug($text, $excludeId = null)
    {
        $this->load->helper('url');
        $slug = url_title(strtolower(trim($text)), '-', TRUE);
        if (empty($slug)) {
            $slug = 'blog-' . time();
        }

        $baseSlug = $slug;
        $counter = 2;

        while ($this->_slugExists($slug, $excludeId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if slug already exists in blogs table
     */
    private function _slugExists($slug, $excludeId = null)
    {
        $this->db->where('slug', $slug);
        if (!empty($excludeId)) {
            $this->db->where('id !=', (int)$excludeId);
        }
        return ($this->db->count_all_results($this->table) > 0);
    }

    /**
     * Get statistics for admin cards
     */
    public function getStats()
    {
        $total = $this->db->count_all($this->table);

        $this->db->where('status', 'active');
        $active = $this->db->count_all_results($this->table);

        $inactive = $total - $active;

        $this->db->select_sum('views', 'total_views');
        $viewRow = $this->db->get($this->table)->row_array();
        $totalViews = (int)($viewRow['total_views'] ?? 0);

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'total_views' => $totalViews
        ];
    }

    /**
     * Format blog row
     */
    private function _formatBlog(array $row)
    {
        // Resolve featured image URL
        $img = $row['featured_image'] ?? '';
        if (empty($img)) {
            $imageUrl = base_url('assets/images/blog/blog-details.jpg');
        } elseif (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0) {
            $imageUrl = $img;
        } else {
            $imageUrl = base_url($img);
        }

        $row['image_url'] = $imageUrl;

        // Formatted human date
        if (!empty($row['published_date'])) {
            $row['formatted_date'] = date('F d, Y', strtotime($row['published_date']));
            $row['formatted_date_short'] = date('M d, Y', strtotime($row['published_date']));
        } else {
            $row['formatted_date'] = date('F d, Y', strtotime($row['created_at']));
            $row['formatted_date_short'] = date('M d, Y', strtotime($row['created_at']));
        }

        // Estimated read time
        $wordCount = str_word_count(strip_tags($row['content'] ?? ''));
        $minutes = max(1, (int)ceil($wordCount / 200));
        $row['read_time'] = $minutes . ' min read';

        return $row;
    }
}
