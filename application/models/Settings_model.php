<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    private $table = 'settings';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all settings key-value array
     */
    public function getSettings()
    {
        $rows = $this->db->get($this->table)->result_array();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    public function getAllKeyValues()
    {
        return $this->getSettings();
    }

    public function get($key, $default = '')
    {
        $this->db->where('setting_key', $key);
        $row = $this->db->get($this->table)->row_array();
        return $row ? $row['setting_value'] : $default;
    }

    /**
     * Save/upsert settings
     */
    public function saveSettings(array $data)
    {
        foreach ($data as $key => $value) {
            $key = trim($key);
            if ($key === '') continue;

            $exists = $this->db->where('setting_key', $key)->count_all_results($this->table);
            if ($exists > 0) {
                $this->db->where('setting_key', $key)->update($this->table, [
                    'setting_value' => (string)$value,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->db->insert($this->table, [
                    'setting_key' => $key,
                    'setting_value' => (string)$value,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        return true;
    }
}