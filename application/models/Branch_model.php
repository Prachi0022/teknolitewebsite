<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {

    private $table = 'branches';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all active branches ordered by sort_order
     */
    public function getActiveBranches()
    {
        return $this->db->where('status', 'active')
                        ->order_by('sort_order', 'ASC')
                        ->order_by('id', 'ASC')
                        ->get($this->table)
                        ->result_array();
    }

    /**
     * Get all branches (for admin list)
     */
    public function getAllBranches()
    {
        return $this->db->order_by('sort_order', 'ASC')
                        ->order_by('id', 'ASC')
                        ->get($this->table)
                        ->result_array();
    }

    /**
     * Get single branch by ID
     */
    public function getBranch($id)
    {
        return $this->db->where('id', (int)$id)->get($this->table)->row_array();
    }

    /**
     * Save (insert or update) a branch
     */
    public function saveBranch(array $data, $id = null)
    {
        if (!empty($id)) {
            $this->db->where('id', (int)$id);
            $data['updated_at'] = date('Y-m-d H:i:s');
            return $this->db->update($this->table, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }

    /**
     * Delete a branch by ID
     */
    public function deleteBranch($id)
    {
        return $this->db->where('id', (int)$id)->delete($this->table);
    }
}
