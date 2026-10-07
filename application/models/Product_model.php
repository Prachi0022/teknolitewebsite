<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    private $table = 'products';
    private $galleryTable = 'product_gallery';
    private $categoryTable = 'categories';
    private $subcategoryTable = 'subcategories';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all products with optional filters
     */
    public function getAll($filter = [])
    {
        $this->db->select('p.*, c.name AS resolved_category_name, c.slug AS resolved_category_slug, s.name AS resolved_subcategory_name');
        $this->db->from($this->table . ' p');
        $this->db->join($this->categoryTable . ' c', 'p.category_id = c.id', 'left');
        $this->db->join($this->subcategoryTable . ' s', 'p.subcategory_id = s.id', 'left');

        if (!empty($filter['category'])) {
            $cat = trim($filter['category']);
            $this->db->group_start();
            $this->db->where('LOWER(p.category_name)', strtolower($cat));
            $this->db->or_where('LOWER(c.name)', strtolower($cat));
            $this->db->or_where('c.slug', strtolower($cat));
            $this->db->group_end();
        }

        if (!empty($filter['status'])) {
            $this->db->where('p.status', strtolower(trim($filter['status'])));
        }

        if (!empty($filter['search'])) {
            $search = trim($filter['search']);
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.sku', $search);
            $this->db->or_like('p.category_name', $search);
            $this->db->or_like('p.subcategory_name', $search);
            $this->db->or_like('c.name', $search);
            $this->db->or_like('s.name', $search);
            $this->db->group_end();
        }

        $this->db->order_by('p.display_order', 'ASC');
        $this->db->order_by('p.name', 'ASC');

        $rows = $this->db->get()->result_array();

        $products = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatProduct($row, false);
            $products[$formatted['id']] = $formatted;
        }

        return $products;
    }

    /**
     * Get newest active products (e.g. for homepage)
     *
     * @param int $limit
     * @return array
     */
    public function getLatestProducts($limit = 8)
    {
        $this->db->select('p.*, c.name AS resolved_category_name, c.slug AS resolved_category_slug, s.name AS resolved_subcategory_name');
        $this->db->from($this->table . ' p');
        $this->db->join($this->categoryTable . ' c', 'p.category_id = c.id', 'left');
        $this->db->join($this->subcategoryTable . ' s', 'p.subcategory_id = s.id', 'left');
        $this->db->where('p.status', 'active');
        $this->db->order_by('p.created_at', 'DESC');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit((int)$limit);

        $rows = $this->db->get()->result_array();

        $products = [];
        foreach ($rows as $row) {
            $formatted = $this->_formatProduct($row, false);
            $products[] = $formatted;
        }

        return $products;
    }

    /**
     * Get single product by ID or Slug
     */
    public function getById($id)
    {
        if (empty($id)) {
            return null;
        }

        $this->db->select('p.*, c.name AS resolved_category_name, c.slug AS resolved_category_slug, s.name AS resolved_subcategory_name');
        $this->db->from($this->table . ' p');
        $this->db->join($this->categoryTable . ' c', 'p.category_id = c.id', 'left');
        $this->db->join($this->subcategoryTable . ' s', 'p.subcategory_id = s.id', 'left');

        if (is_numeric($id)) {
            $this->db->where('p.id', (int)$id);
        } else {
            $this->db->group_start();
            $this->db->where('p.slug', $id);
            $this->db->or_where('p.sku', $id);
            $this->db->or_where('p.id', (int)$id);
            $this->db->group_end();
        }

        $row = $this->db->get()->row_array();
        if ($row) {
            return $this->_formatProduct($row, true);
        }

        return null;
    }

    /**
     * Get single product by Slug
     */
    public function getBySlug($slug)
    {
        return $this->getById($slug);
    }

    /**
     * Create a new product
     */
    public function create(array $data)
    {
        $name = trim($data['name'] ?? 'Untitled Product');
        $slug = !empty($data['slug']) ? $this->_slugify($data['slug']) : $this->_slugify($name);

        $baseSlug = $slug;
        $counter = 1;
        while ($this->db->where('slug', $slug)->count_all_results($this->table) > 0) {
            $slug = $baseSlug . '-' . $counter++;
        }

        // Generate or ensure unique SKU
        $rawSku = !empty($data['sku']) ? trim($data['sku']) : '';
        if (empty($rawSku)) {
            $cleanName = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $name));
            $prefix = !empty($cleanName) ? substr($cleanName, 0, 6) : 'PROD';
            $rawSku = 'TL-' . $prefix . '-' . rand(100, 999);
        }

        $baseSku = $rawSku;
        $sku = $baseSku;
        $skuCounter = 1;
        while ($this->db->where('sku', $sku)->count_all_results($this->table) > 0) {
            $sku = $baseSku . '-' . $skuCounter++;
        }

        // Resolve category & subcategory IDs
        $catName = trim($data['category'] ?? 'Cobspot Light');
        $subName = trim($data['subcategory'] ?? 'Recessed Trimless');
        $catId = $this->_resolveCategoryId($catName);
        $subId = $this->_resolveSubcategoryId($subName, $catId);

        // Parse specifications
        $specWattage = $this->_implodeArray($data['spec_wattage'] ?? $data['specifications']['wattage'] ?? ['12W', '18W']);
        $specCct = $this->_implodeArray($data['spec_cct'] ?? $data['specifications']['cct'] ?? ['3000K', '4000K']);
        $specBeam = $this->_implodeArray($data['spec_beam_angles'] ?? $data['specifications']['beam_angles'] ?? ['24°', '36°']);
        $specFinishes = $this->_implodeArray($data['spec_finishes'] ?? $data['specifications']['finishes'] ?? ['Matt White', 'Matt Black']);

        $displayOrder = isset($data['display_order']) && $data['display_order'] !== '' 
            ? (int)$data['display_order'] 
            : ($this->db->count_all($this->table) + 1);

        $features = $this->_normalizeListString($data['features'] ?? '');
        $applications = $this->_normalizeListString($data['applications'] ?? "Commercial Lobbies\nRetail Boutiques\nLuxury Residences\nHospitality");

        $insertData = [
            'category_id' => $catId,
            'subcategory_id' => $subId,
            'category_name' => $catName,
            'subcategory_name' => $subName,
            'name' => $name,
            'slug' => $slug,
            'sku' => $sku,
            'price' => isset($data['price']) ? (float)$data['price'] : 0,
            'regular_price' => isset($data['regular_price']) ? (float)$data['regular_price'] : 0,
            'price_on_request' => !empty($data['price_on_request']) ? 1 : 0,
            'stock' => isset($data['stock']) ? (int)$data['stock'] : 100,
            'display_order' => $displayOrder,
            'status' => (!empty($data['status']) && in_array($data['status'], ['active', 'inactive'])) ? $data['status'] : 'active',
            'is_featured' => !empty($data['is_featured']) ? 1 : 0,
            'is_bestseller' => !empty($data['is_bestseller']) ? 1 : 0,
            'rating' => isset($data['rating']) ? (float)$data['rating'] : 5.0,
            'reviews_count' => isset($data['reviews_count']) ? (int)$data['reviews_count'] : 0,
            'featured_image' => !empty($data['featured_image']) ? $data['featured_image'] : 'assets/images/products/gamma.png',
            'hover_image' => !empty($data['hover_image']) ? $data['hover_image'] : '',
            'short_description' => trim($data['short_description'] ?? ''),
            'full_description' => trim($data['full_description'] ?? ''),
            'spec_wattage' => $specWattage,
            'spec_cct' => $specCct,
            'spec_beam_angles' => $specBeam,
            'spec_finishes' => $specFinishes,
            'spec_voltage' => trim($data['spec_voltage'] ?? $data['specifications']['input_voltage'] ?? 'AC 220-240V, 50/60Hz'),
            'spec_cri' => trim($data['spec_cri'] ?? $data['specifications']['cri'] ?? '> 90 Ra'),
            'spec_ip' => trim($data['spec_ip'] ?? $data['specifications']['ip_rating'] ?? 'IP20'),
            'spec_mounting' => trim($data['spec_mounting'] ?? $data['specifications']['mounting'] ?? 'Ceiling Recessed'),
            'spec_dimensions' => trim($data['spec_dimensions'] ?? $data['specifications']['dimensions'] ?? 'Standard'),
            'spec_lumens' => trim($data['spec_lumens'] ?? $data['specifications']['luminous_flux'] ?? '1000 - 2000 Lumens'),
            'spec_ugr' => trim($data['spec_ugr'] ?? $data['specifications']['ugr'] ?? '< 16 Anti-Glare'),
            'features' => $features,
            'applications' => $applications,
            'meta_title' => trim($data['meta_title'] ?? $data['seo']['meta_title'] ?? ($name . ' | TeknoLite Architectural Lighting')),
            'meta_description' => trim($data['meta_description'] ?? $data['seo']['meta_description'] ?? ($data['short_description'] ?? '')),
            'meta_keywords' => trim($data['meta_keywords'] ?? $data['seo']['meta_keywords'] ?? ($name . ', Architectural Lighting, TeknoLite')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert($this->table, $insertData);
        $newProductId = $this->db->insert_id();

        // Save Gallery Images
        $gallery = $data['gallery_images'] ?? [];
        if (is_array($gallery)) {
            $gOrder = 1;
            foreach ($gallery as $gImg) {
                if (!empty($gImg)) {
                    $this->db->insert($this->galleryTable, [
                        'product_id' => $newProductId,
                        'image_path' => $gImg,
                        'display_order' => $gOrder++,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return $slug;
    }

    /**
     * Update an existing product
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
        if (isset($data['sku'])) {
            $rawSku = trim($data['sku']);
            if (!empty($rawSku)) {
                $baseSku = $rawSku;
                $sku = $baseSku;
                $skuCounter = 1;
                while ($this->db->where('sku', $sku)->where('id !=', $numericId)->count_all_results($this->table) > 0) {
                    $sku = $baseSku . '-' . $skuCounter++;
                }
                $updateData['sku'] = $sku;
            }
        }
        if (isset($data['price'])) $updateData['price'] = (float)$data['price'];
        if (isset($data['regular_price'])) $updateData['regular_price'] = (float)$data['regular_price'];
        if (isset($data['price_on_request'])) $updateData['price_on_request'] = !empty($data['price_on_request']) ? 1 : 0;
        if (isset($data['stock'])) $updateData['stock'] = (int)$data['stock'];
        if (isset($data['display_order'])) $updateData['display_order'] = (int)$data['display_order'];
        if (isset($data['status']) && in_array($data['status'], ['active', 'inactive'])) $updateData['status'] = $data['status'];
        if (isset($data['is_featured'])) $updateData['is_featured'] = !empty($data['is_featured']) ? 1 : 0;
        if (isset($data['is_bestseller'])) $updateData['is_bestseller'] = !empty($data['is_bestseller']) ? 1 : 0;
        if (isset($data['short_description'])) $updateData['short_description'] = trim($data['short_description']);
        if (isset($data['full_description'])) $updateData['full_description'] = trim($data['full_description']);

        if (!empty($data['featured_image'])) $updateData['featured_image'] = $data['featured_image'];
        if (isset($data['hover_image'])) $updateData['hover_image'] = $data['hover_image'];

        if (isset($data['category'])) {
            $catName = trim($data['category']);
            $updateData['category_name'] = $catName;
            $updateData['category_id'] = $this->_resolveCategoryId($catName);
        }
        if (isset($data['subcategory'])) {
            $subName = trim($data['subcategory']);
            $updateData['subcategory_name'] = $subName;
            $catId = $updateData['category_id'] ?? $existing['category_id'];
            $updateData['subcategory_id'] = $this->_resolveSubcategoryId($subName, $catId);
        }

        // Specs
        if (isset($data['spec_wattage'])) $updateData['spec_wattage'] = $this->_implodeArray($data['spec_wattage']);
        if (isset($data['spec_cct'])) $updateData['spec_cct'] = $this->_implodeArray($data['spec_cct']);
        if (isset($data['spec_beam_angles'])) $updateData['spec_beam_angles'] = $this->_implodeArray($data['spec_beam_angles']);
        if (isset($data['spec_finishes'])) $updateData['spec_finishes'] = $this->_implodeArray($data['spec_finishes']);
        if (isset($data['spec_voltage'])) $updateData['spec_voltage'] = trim($data['spec_voltage']);
        if (isset($data['spec_cri'])) $updateData['spec_cri'] = trim($data['spec_cri']);
        if (isset($data['spec_ip'])) $updateData['spec_ip'] = trim($data['spec_ip']);
        if (isset($data['spec_mounting'])) $updateData['spec_mounting'] = trim($data['spec_mounting']);
        if (isset($data['spec_dimensions'])) $updateData['spec_dimensions'] = trim($data['spec_dimensions']);
        if (isset($data['spec_lumens'])) $updateData['spec_lumens'] = trim($data['spec_lumens']);
        if (isset($data['spec_ugr'])) $updateData['spec_ugr'] = trim($data['spec_ugr']);

        if (isset($data['features'])) $updateData['features'] = $this->_normalizeListString($data['features']);
        if (isset($data['applications'])) $updateData['applications'] = $this->_normalizeListString($data['applications']);

        if (isset($data['meta_title'])) $updateData['meta_title'] = trim($data['meta_title']);
        if (isset($data['meta_description'])) $updateData['meta_description'] = trim($data['meta_description']);
        if (isset($data['meta_keywords'])) $updateData['meta_keywords'] = trim($data['meta_keywords']);

        if (!empty($data['slug'])) {
            $newSlug = $this->_slugify($data['slug']);
            if ($newSlug !== $existing['slug']) {
                $check = $this->db->where('slug', $newSlug)->where('id !=', $numericId)->count_all_results($this->table);
                if ($check === 0) {
                    $updateData['slug'] = $newSlug;
                }
            }
        }

        $res = $this->db->where('id', $numericId)->update($this->table, $updateData);

        // Update gallery if supplied
        if (isset($data['gallery_images']) && is_array($data['gallery_images'])) {
            $this->db->where('product_id', $numericId)->delete($this->galleryTable);
            $gOrder = 1;
            foreach ($data['gallery_images'] as $gImg) {
                if (!empty($gImg)) {
                    $this->db->insert($this->galleryTable, [
                        'product_id' => $numericId,
                        'image_path' => $gImg,
                        'display_order' => $gOrder++,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return $res;
    }

    /**
     * Delete product by ID (Physical MySQL Deletion)
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
     * Toggle Active/Inactive status
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
     * Get list of unique category names
     */
    public function getCategories()
    {
        $rows = $this->db->select('name')->from($this->categoryTable)->where('status', 'active')->order_by('display_order', 'ASC')->get()->result_array();
        if (!empty($rows)) {
            return array_column($rows, 'name');
        }

        return ['Cobspot Light', 'Down Lights', 'Spot Lights', 'Garden Lights', 'Linear Lighting', 'Track Lighting', 'Wall Washers'];
    }

    /**
     * Get list of subcategories
     */
    public function getSubcategories($categoryId = null)
    {
        $this->db->select('s.name');
        $this->db->from($this->subcategoryTable . ' s');
        $this->db->where('s.status', 'active');

        if (!empty($categoryId) && $categoryId !== 'all') {
            if (is_numeric($categoryId)) {
                $this->db->where('s.category_id', (int)$categoryId);
            } else {
                $this->db->join($this->categoryTable . ' c', 's.category_id = c.id', 'left');
                $this->db->group_start();
                $this->db->where('c.slug', $categoryId);
                $this->db->or_where('LOWER(c.name)', strtolower($categoryId));
                $this->db->group_end();
            }
        }

        $this->db->order_by('s.display_order', 'ASC');
        $rows = $this->db->get()->result_array();
        if (!empty($rows)) {
            return array_column($rows, 'name');
        }

        return ['Recessed Trimless', 'Recessed Trimmed', 'Surface Mounted', 'Track Spotlight', 'Landscape Spike', 'Linear Pendant', 'Square Recessed', 'Micro Spotlight', 'Bollard Light'];
    }

    /**
     * Format a product row for view compatibility
     */
    private function _formatProduct(array $row, $fetchGallery = false)
    {
        $numericId = (int)$row['id'];
        $slug = $row['slug'] ?: ('product-' . $numericId);

        // Fetch gallery images
        $gallery = [];
        if ($fetchGallery) {
            $gRows = $this->db->where('product_id', $numericId)->order_by('display_order', 'ASC')->get($this->galleryTable)->result_array();
            foreach ($gRows as $g) {
                if (!empty($g['image_path'])) {
                    $gallery[] = $g['image_path'];
                }
            }
        }
        if (!empty($row['featured_image']) && !in_array($row['featured_image'], $gallery)) {
            array_unshift($gallery, $row['featured_image']);
        }
        if (!empty($row['hover_image']) && !in_array($row['hover_image'], $gallery)) {
            $gallery[] = $row['hover_image'];
        }
        $gallery = array_values(array_unique(array_filter($gallery)));
        if (empty($gallery)) {
            $gallery[] = 'assets/images/products/gamma.png';
        }

        $wattage = $this->_explodeArray($row['spec_wattage'] ?? '');
        $cct = $this->_explodeArray($row['spec_cct'] ?? '');
        $beam = $this->_explodeArray($row['spec_beam_angles'] ?? '');
        $finishes = $this->_explodeArray($row['spec_finishes'] ?? '');

        return [
            'numeric_id' => $numericId,
            'id' => $slug,
            'slug' => $slug,
            'name' => $row['name'],
            'sku' => $row['sku'],
            'category' => $row['category_name'] ?: ($row['resolved_category_name'] ?? 'Cobspot Light'),
            'category_slug' => !empty($row['resolved_category_slug']) ? $row['resolved_category_slug'] : $this->_slugify($row['category_name'] ?: ($row['resolved_category_name'] ?? 'general')),
            'subcategory' => $row['subcategory_name'] ?: ($row['resolved_subcategory_name'] ?? 'Recessed Trimless'),
            'category_id' => $row['category_id'],
            'subcategory_id' => $row['subcategory_id'],
            'price' => (float)$row['price'],
            'regular_price' => (float)$row['regular_price'],
            'price_on_request' => (bool)$row['price_on_request'],
            'stock' => (int)$row['stock'],
            'display_order' => (int)$row['display_order'],
            'status' => $row['status'],
            'is_featured' => (bool)$row['is_featured'],
            'is_bestseller' => (bool)$row['is_bestseller'],
            'rating' => (float)$row['rating'],
            'reviews_count' => (int)$row['reviews_count'],
            'featured_image' => $row['featured_image'],
            'hover_image' => $row['hover_image'],
            'gallery_images' => $gallery,
            'short_description' => $row['short_description'],
            'full_description' => $row['full_description'],
            'specifications' => [
                'wattage' => $wattage ?: ['12W', '18W'],
                'cct' => $cct ?: ['3000K', '4000K'],
                'beam_angles' => $beam ?: ['24°', '36°'],
                'finishes' => $finishes ?: ['Matt White', 'Matt Black'],
                'input_voltage' => $row['spec_voltage'] ?: 'AC 220-240V, 50/60Hz',
                'cri' => $row['spec_cri'] ?: '> 90 Ra',
                'ip_rating' => $row['spec_ip'] ?: 'IP20',
                'mounting' => $row['spec_mounting'] ?: 'Ceiling Recessed',
                'dimensions' => $row['spec_dimensions'] ?: 'Standard',
                'luminous_flux' => $row['spec_lumens'] ?: '',
                'ugr' => $row['spec_ugr'] ?: '< 16 Anti-Glare'
            ],
            'features' => $this->_explodeList($row['features'] ?? ''),
            'applications' => $this->_explodeList($row['applications'] ?? ''),
            'seo' => [
                'meta_title' => $row['meta_title'] ?: ($row['name'] . ' | TeknoLite'),
                'meta_description' => $row['meta_description'] ?: ($row['short_description'] ?? ''),
                'meta_keywords' => $row['meta_keywords'] ?: ($row['name'] . ', Architectural Lighting'),
                'slug' => $slug
            ],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
        ];
    }

    private function _resolveCategoryId($name)
    {
        if (empty($name)) return 1;
        $row = $this->db->where('LOWER(name)', strtolower($name))->or_where('slug', strtolower($name))->get($this->categoryTable)->row_array();
        return $row ? (int)$row['id'] : 1;
    }

    private function _resolveSubcategoryId($name, $categoryId = null)
    {
        if (empty($name)) return null;
        $this->db->where('LOWER(name)', strtolower($name))->or_where('slug', strtolower($name));
        if ($categoryId) {
            $this->db->where('category_id', (int)$categoryId);
        }
        $row = $this->db->get($this->subcategoryTable)->row_array();
        return $row ? (int)$row['id'] : null;
    }

    private function _implodeArray($val)
    {
        if (is_array($val)) {
            return implode(', ', array_filter(array_map('trim', $val)));
        }
        return trim((string)$val);
    }

    private function _explodeArray($val)
    {
        if (empty($val)) return [];
        return array_values(array_filter(array_map('trim', explode(',', $val))));
    }

    private function _normalizeListString($val)
    {
        if (is_array($val)) {
            return implode("\n", array_filter(array_map('trim', $val)));
        }
        return trim((string)$val);
    }

    private function _explodeList($val)
    {
        if (empty($val)) return [];
        $lines = explode("\n", $val);
        $clean = [];
        foreach ($lines as $line) {
            $line = trim(preg_replace('/^[\s*•\-]+/', '', $line));
            if (!empty($line)) $clean[] = $line;
        }
        return $clean;
    }

    private function _slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text ?: 'item');
    }
}