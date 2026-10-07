<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Get setting value by key with fallback default
 * Uses static in-memory caching to execute only 1 DB query per request.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (!function_exists('get_setting')) {
    function get_setting($key, $default = '') {
        static $cached_settings = null;

        if ($cached_settings === null) {
            $CI =& get_instance();
            if (!isset($CI->Settings_model)) {
                $CI->load->model('Settings_model');
            }
            $all = $CI->Settings_model->getSettings();
            $cached_settings = is_array($all) ? $all : [];
        }

        if (isset($cached_settings[$key]) && $cached_settings[$key] !== null && $cached_settings[$key] !== '') {
            return $cached_settings[$key];
        }

        return $default;
    }
}

/**
 * Clean phone number to digits only (for WhatsApp wa.me links and tel: protocol)
 *
 * @param string $phone
 * @return string
 */
if (!function_exists('clean_phone_number')) {
    function clean_phone_number($phone) {
        if (empty($phone)) {
            return '';
        }
        return preg_replace('/[^0-9]/', '', $phone);
    }
}

/**
 * Get setting image URL by key with fallback default
 *
 * @param string $key
 * @param string $default Relative asset path or full URL
 * @return string Full URL to image
 */
if (!function_exists('get_setting_image')) {
    function get_setting_image($key, $default = 'assets/images/logo/logo.png') {
        $val = get_setting($key, '');
        if (!empty($val)) {
            if (strpos($val, 'http://') === 0 || strpos($val, 'https://') === 0) {
                return $val;
            }
            return base_url($val);
        }
        if (!empty($default)) {
            if (strpos($default, 'http://') === 0 || strpos($default, 'https://') === 0) {
                return $default;
            }
            return base_url($default);
        }
        return '';
    }
}

