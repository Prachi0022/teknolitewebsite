<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casestudy_model extends CI_Model {

    private $table = 'case_studies';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all case studies with optional filters
     */
    public function getAll(array $filter = [])
    {
        $this->db->from($this->table . ' cs');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('cs.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['industry']) && strtolower($filter['industry']) !== 'all') {
            $this->db->where('LOWER(cs.industry)', strtolower(trim($filter['industry'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('cs.title', $search);
            $this->db->or_like('cs.client', $search);
            $this->db->or_like('cs.industry', $search);
            $this->db->or_like('cs.location', $search);
            $this->db->or_like('cs.overview', $search);
            $this->db->or_like('cs.slug', $search);
            $this->db->or_like('cs.case_study_code', $search);
            $this->db->group_end();
        }

        $this->db->order_by('cs.created_at', 'DESC');
        $rows = $this->db->get()->result_array();

        $items = [];
        foreach ($rows as $row) {
            $items[] = $this->_formatCaseStudy($row);
        }

        return $items;
    }

    /**
     * Paginated case studies
     */
    public function getPaginated($page = 1, $perPage = 10, array $filter = [])
    {
        $this->db->from($this->table . ' cs');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('cs.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['industry']) && strtolower($filter['industry']) !== 'all') {
            $this->db->where('LOWER(cs.industry)', strtolower(trim($filter['industry'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('cs.title', $search);
            $this->db->or_like('cs.client', $search);
            $this->db->or_like('cs.industry', $search);
            $this->db->or_like('cs.location', $search);
            $this->db->or_like('cs.overview', $search);
            $this->db->or_like('cs.slug', $search);
            $this->db->or_like('cs.case_study_code', $search);
            $this->db->group_end();
        }

        $totalItems = $this->db->count_all_results();
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        // Fetch
        $this->db->from($this->table . ' cs');

        if (!empty($filter['status']) && strtolower($filter['status']) !== 'all') {
            $this->db->where('cs.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['industry']) && strtolower($filter['industry']) !== 'all') {
            $this->db->where('LOWER(cs.industry)', strtolower(trim($filter['industry'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('cs.title', $search);
            $this->db->or_like('cs.client', $search);
            $this->db->or_like('cs.industry', $search);
            $this->db->or_like('cs.location', $search);
            $this->db->or_like('cs.overview', $search);
            $this->db->or_like('cs.slug', $search);
            $this->db->or_like('cs.case_study_code', $search);
            $this->db->group_end();
        }

        $this->db->order_by('cs.created_at', 'DESC');
        $this->db->limit($perPage, $offset);

        $rows = $this->db->get()->result_array();
        $items = [];
        foreach ($rows as $row) {
            $items[] = $this->_formatCaseStudy($row);
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
     * Get single case study by ID or case_study_code
     */
    public function getById($id)
    {
        if (empty($id)) return null;

        $this->db->from($this->table . ' cs');
        $this->db->group_start();
        $this->db->where('cs.case_study_code', $id);
        $this->db->or_where('cs.slug', $id);
        if (is_numeric($id)) {
            $this->db->or_where('cs.id', (int)$id);
        }
        $this->db->group_end();

        $row = $this->db->get()->row_array();
        if ($row) {
            return $this->_formatCaseStudy($row);
        }

        return null;
    }

    /**
     * Get single case study by Slug
     */
    public function getBySlug($slug)
    {
        if (empty($slug)) return null;

        $row = $this->db->where('slug', strtolower(trim($slug)))->get($this->table)->row_array();
        if ($row) {
            return $this->_formatCaseStudy($row);
        }

        return null;
    }

    /**
     * Get active case studies for frontend
     */
    public function getActiveCaseStudies($industry = null)
    {
        $this->db->where('status', 'active');
        if ($industry !== null && strtolower($industry) !== 'all') {
            $this->db->where('LOWER(industry)', strtolower(trim($industry)));
        }
        $this->db->order_by('created_at', 'DESC');
        $rows = $this->db->get($this->table)->result_array();

        $active = [];
        foreach ($rows as $row) {
            $active[] = $this->_formatCaseStudy($row);
        }

        return $active;
    }

    /**
     * Get unique industries list
     */
    public function getIndustries()
    {
        $this->db->select('DISTINCT(industry) AS industry')->from($this->table)->where('industry IS NOT NULL')->where('industry !=', '')->order_by('industry', 'ASC');
        $rows = $this->db->get()->result_array();
        return array_column($rows, 'industry');
    }

    /**
     * Summary stats
     */
    public function getStats()
    {
        $total = $this->db->count_all($this->table);
        $active = $this->db->where('status', 'active')->count_all_results($this->table);
        $inactive = $this->db->where('status', 'inactive')->count_all_results($this->table);
        $industriesCount = count($this->getIndustries());

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'industries_count' => $industriesCount
        ];
    }

    /**
     * Generate unique slug from title
     */
    public function generateSlug($title, $excludeId = null)
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($title)));
        $slug = trim($slug, '-');
        if (empty($slug)) {
            $slug = 'case-study-' . time();
        }

        $baseSlug = $slug;
        $counter = 1;

        while (true) {
            $this->db->where('slug', $slug);
            if ($excludeId !== null) {
                if (is_numeric($excludeId)) {
                    $this->db->where('id !=', (int)$excludeId);
                } else {
                    $this->db->where('case_study_code !=', $excludeId);
                }
            }
            if ($this->db->count_all_results($this->table) === 0) {
                break;
            }
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Create new case study
     */
    public function create(array $data)
    {
        $title = trim($data['title'] ?? 'Untitled Case Study');
        $slug = !empty($data['slug']) ? trim($data['slug']) : $this->generateSlug($title);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower($slug));
        $slug = trim($slug, '-');

        // Next code
        $maxId = $this->db->select_max('id')->get($this->table)->row()->id ?? 1000;
        $newCode = 'CS-' . ($maxId + 1);

        $now = date('Y-m-d H:i:s');
        $insertData = [
            'case_study_code' => $newCode,
            'title' => $title,
            'slug' => $slug,
            'client' => trim($data['client'] ?? ''),
            'industry' => trim($data['industry'] ?? 'General'),
            'location' => trim($data['location'] ?? ''),
            'solution' => trim($data['solution'] ?? 'Architectural LED Lighting'),
            'featured_image' => trim($data['featured_image'] ?? 'assets/images/project/project1.jpeg'),
            'overview' => trim($data['overview'] ?? ''),
            'short_description' => trim($data['short_description'] ?? ''),
            'status' => in_array(strtolower($data['status'] ?? ''), ['active', 'inactive']) ? strtolower($data['status']) : 'active',
            'meta_title' => trim($data['meta_title'] ?? ($title . ' | TeknoLite Case Study')),
            'meta_description' => trim($data['meta_description'] ?? substr(strip_tags($data['overview'] ?? ''), 0, 160)),
            'meta_keywords' => trim($data['meta_keywords'] ?? ''),
            'created_at' => $now,
            'updated_at' => $now
        ];

        $this->db->insert($this->table, $insertData);
        $insertData['id'] = $newCode;
        $insertData['numeric_id'] = $this->db->insert_id();

        return $insertData;
    }

    /**
     * Update existing case study
     */
    public function update($id, array $data)
    {
        $existing = $this->getById($id);
        if (!$existing) {
            return false;
        }

        $numericId = $existing['numeric_id'];
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];

        if (isset($data['title'])) $updateData['title'] = trim($data['title']);
        if (isset($data['client'])) $updateData['client'] = trim($data['client']);
        if (isset($data['industry'])) $updateData['industry'] = trim($data['industry']);
        if (isset($data['location'])) $updateData['location'] = trim($data['location']);
        if (isset($data['solution'])) $updateData['solution'] = trim($data['solution']);
        if (!empty($data['featured_image'])) $updateData['featured_image'] = trim($data['featured_image']);
        if (isset($data['overview'])) $updateData['overview'] = trim($data['overview']);
        if (isset($data['short_description'])) $updateData['short_description'] = trim($data['short_description']);
        if (isset($data['status']) && in_array(strtolower($data['status']), ['active', 'inactive'])) $updateData['status'] = strtolower($data['status']);

        if (isset($data['meta_title'])) $updateData['meta_title'] = trim($data['meta_title']);
        if (isset($data['meta_description'])) $updateData['meta_description'] = trim($data['meta_description']);
        if (isset($data['meta_keywords'])) $updateData['meta_keywords'] = trim($data['meta_keywords']);

        if (!empty($data['slug'])) {
            $newSlug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($data['slug'])));
            $newSlug = trim($newSlug, '-');
            if ($newSlug !== $existing['slug']) {
                $check = $this->db->where('slug', $newSlug)->where('id !=', $numericId)->count_all_results($this->table);
                if ($check === 0) {
                    $updateData['slug'] = $newSlug;
                }
            }
        }

        $this->db->where('id', $numericId)->update($this->table, $updateData);
        return $this->getById($numericId);
    }

    /**
     * Delete case study (Physical MySQL Deletion)
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
     * Toggle status
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

    private function _formatCaseStudy(array $row)
    {
        return [
            'numeric_id' => (int)$row['id'],
            'id' => $row['case_study_code'],
            'case_study_code' => $row['case_study_code'],
            'title' => $row['title'],
            'slug' => $row['slug'],
            'client' => $row['client'],
            'industry' => $row['industry'],
            'location' => $row['location'],
            'solution' => !empty($row['solution']) ? $row['solution'] : 'Architectural LED Lighting',
            'featured_image' => $row['featured_image'],
            'overview' => $row['overview'],
            'short_description' => !empty($row['short_description']) ? $row['short_description'] : (!empty($row['meta_description']) ? $row['meta_description'] : substr(strip_tags($row['overview'] ?? ''), 0, 220) . (strlen(strip_tags($row['overview'] ?? '')) > 220 ? '...' : '')),
            'status' => $row['status'],
            'meta_title' => $row['meta_title'],
            'meta_description' => $row['meta_description'],
            'meta_keywords' => $row['meta_keywords'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
        ];
    }
}