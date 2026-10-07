-- ============================================================================
-- TeknoLite Architectural Lighting - Complete Production MySQL Database Schema
-- Compatible with MySQL 5.7, 8.0, 8.4+ and MariaDB 10.3+
-- Ready for phpMyAdmin / MySQL CLI Import
-- Target Database: `teknolite`
-- ============================================================================

CREATE DATABASE IF NOT EXISTS `teknolite` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `teknolite`;

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

-- ----------------------------------------------------------------------------
-- Clean Drop All Tables in Reverse-Dependency Order
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `enquiry_timeline`;
DROP TABLE IF EXISTS `enquiry_items`;
DROP TABLE IF EXISTS `enquiries`;
DROP TABLE IF EXISTS `customer_wishlist`;
DROP TABLE IF EXISTS `customers`;
DROP TABLE IF EXISTS `product_gallery`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `subcategories`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `admin_remember_tokens`;
DROP TABLE IF EXISTS `admin_users`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `case_studies`;
DROP TABLE IF EXISTS `settings`;

-- ----------------------------------------------------------------------------
-- 1. Table: `admin_users`
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `admin_remember_tokens`;
DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_code` VARCHAR(50) NOT NULL UNIQUE,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `name` VARCHAR(150) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'Super Admin',
  `password` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT 'assets/admin/images/avatar.jpg',
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `login_attempts` INT NOT NULL DEFAULT 0,
  `locked_until` DATETIME NULL DEFAULT NULL,
  `last_login` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_admin_username` (`username`),
  INDEX `idx_admin_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Admin portal authentication and users';

-- ----------------------------------------------------------------------------
-- 2. Table: `admin_remember_tokens`
-- ----------------------------------------------------------------------------
CREATE TABLE `admin_remember_tokens` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` INT UNSIGNED NOT NULL,
  `token_hash` VARCHAR(255) NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_remember_admin_id` (`admin_id`),
  CONSTRAINT `fk_remember_admin` FOREIGN KEY (`admin_id`) 
    REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Persistent login remember-me tokens';

-- ----------------------------------------------------------------------------
-- 3. Table: `categories`
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `product_gallery`;
DROP TABLE IF EXISTS `enquiry_items`;
DROP TABLE IF EXISTS `enquiry_timeline`;
DROP TABLE IF EXISTS `enquiries`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `subcategories`;
DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `tag_id` VARCHAR(50) DEFAULT NULL,
  `image` VARCHAR(255) NOT NULL DEFAULT 'assets/images/products/gamma.png',
  `short_description` TEXT NULL,
  `description` LONGTEXT NULL,
  `starting_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `stock` INT NOT NULL DEFAULT 0,
  `display_order` INT NOT NULL DEFAULT 1,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_by` VARCHAR(100) NOT NULL DEFAULT 'Admin',
  `meta_title` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_category_slug` (`slug`),
  INDEX `idx_category_status` (`status`),
  INDEX `idx_category_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Product Categories';

-- ----------------------------------------------------------------------------
-- 4. Table: `subcategories`
-- ----------------------------------------------------------------------------
CREATE TABLE `subcategories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `tag_id` VARCHAR(50) DEFAULT NULL,
  `description` TEXT NULL,
  `display_order` INT NOT NULL DEFAULT 1,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_subcategory_category` (`category_id`),
  INDEX `idx_subcategory_slug` (`slug`),
  INDEX `idx_subcategory_status` (`status`),
  CONSTRAINT `fk_subcategory_category` FOREIGN KEY (`category_id`) 
    REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Product Subcategories';

-- ----------------------------------------------------------------------------
-- 5. Table: `products`
-- ----------------------------------------------------------------------------
CREATE TABLE `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NULL,
  `subcategory_id` INT UNSIGNED NULL,
  `category_name` VARCHAR(150) NULL,
  `subcategory_name` VARCHAR(150) NULL,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `sku` VARCHAR(100) NOT NULL UNIQUE,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `regular_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `price_on_request` TINYINT(1) NOT NULL DEFAULT 0,
  `stock` INT NOT NULL DEFAULT 0,
  `display_order` INT NOT NULL DEFAULT 1,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `is_bestseller` TINYINT(1) NOT NULL DEFAULT 0,
  `rating` DECIMAL(3,2) NOT NULL DEFAULT 5.00,
  `reviews_count` INT NOT NULL DEFAULT 0,
  `featured_image` VARCHAR(255) NOT NULL DEFAULT 'assets/images/products/gamma.png',
  `hover_image` VARCHAR(255) NULL,
  `short_description` TEXT NULL,
  `full_description` LONGTEXT NULL,
  `spec_wattage` VARCHAR(255) NULL,
  `spec_cct` VARCHAR(255) NULL,
  `spec_beam_angles` VARCHAR(255) NULL,
  `spec_finishes` VARCHAR(255) NULL,
  `spec_voltage` VARCHAR(150) NULL,
  `spec_cri` VARCHAR(100) NULL,
  `spec_ip` VARCHAR(100) NULL,
  `spec_mounting` VARCHAR(150) NULL,
  `spec_dimensions` VARCHAR(255) NULL,
  `spec_lumens` VARCHAR(255) NULL,
  `spec_ugr` VARCHAR(100) NULL,
  `features` LONGTEXT NULL,
  `applications` LONGTEXT NULL,
  `meta_title` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_product_slug` (`slug`),
  INDEX `idx_product_sku` (`sku`),
  INDEX `idx_product_category` (`category_id`),
  INDEX `idx_product_subcategory` (`subcategory_id`),
  INDEX `idx_product_status` (`status`),
  INDEX `idx_product_order` (`display_order`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) 
    REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_product_subcategory` FOREIGN KEY (`subcategory_id`) 
    REFERENCES `subcategories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lighting Products Catalogue';

-- ----------------------------------------------------------------------------
-- 6. Table: `product_gallery`
-- ----------------------------------------------------------------------------
CREATE TABLE `product_gallery` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT UNSIGNED NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `display_order` INT NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_gallery_product` (`product_id`),
  CONSTRAINT `fk_gallery_product` FOREIGN KEY (`product_id`) 
    REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Product image gallery slides';

-- ----------------------------------------------------------------------------
-- 7. Table: `customers`
-- ----------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `customer_wishlist`;
DROP TABLE IF EXISTS `enquiry_timeline`;
DROP TABLE IF EXISTS `enquiry_items`;
DROP TABLE IF EXISTS `enquiries`;
DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_code` VARCHAR(50) NOT NULL UNIQUE,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `mobile` VARCHAR(50) NOT NULL,
  `company` VARCHAR(150) NULL,
  `gst_number` VARCHAR(50) NULL,
  `address` TEXT NULL,
  `city` VARCHAR(100) NULL,
  `state` VARCHAR(100) NULL,
  `pincode` VARCHAR(20) NULL,
  `country` VARCHAR(100) NOT NULL DEFAULT 'India',
  `password` VARCHAR(255) NULL,
  `avatar` VARCHAR(255) NOT NULL DEFAULT 'assets/images/avatar/avatar-3.jpg',
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `remember_token` VARCHAR(255) NULL,
  `remember_token_expires_at` DATETIME NULL,
  `reset_token` VARCHAR(255) NULL,
  `reset_token_expires_at` DATETIME NULL,
  `registered_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_customer_code` (`customer_code`),
  INDEX `idx_customer_email` (`email`),
  INDEX `idx_customer_mobile` (`mobile`),
  INDEX `idx_customer_status` (`status`),
  INDEX `idx_customer_remember` (`remember_token`),
  INDEX `idx_customer_reset` (`reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Customer directory';

-- ----------------------------------------------------------------------------
-- 7b. Table: `customer_wishlist`
-- ----------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `customer_wishlist`;

CREATE TABLE `customer_wishlist` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NOT NULL,
  `product_id` VARCHAR(100) NOT NULL,
  `product_name` VARCHAR(255) NOT NULL,
  `product_category` VARCHAR(150) NULL,
  `product_image` VARCHAR(255) NULL,
  `product_url` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_customer_product` (`customer_id`, `product_id`),
  INDEX `idx_customer_id` (`customer_id`),
  CONSTRAINT `fk_wishlist_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Customer wishlist persistence';

-- ----------------------------------------------------------------------------
-- 8. Table: `enquiries`
-- ----------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `enquiry_timeline`;
DROP TABLE IF EXISTS `enquiry_items`;
DROP TABLE IF EXISTS `enquiries`;

CREATE TABLE `enquiries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference_no` VARCHAR(50) NOT NULL UNIQUE,
  `customer_id` INT UNSIGNED NULL,
  `customer_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `mobile` VARCHAR(50) NOT NULL,
  `company_name` VARCHAR(150) NULL,
  `priority` ENUM('Normal', 'High', 'Urgent') NOT NULL DEFAULT 'Normal',
  `status` ENUM('New', 'In Review', 'Quotation Sent', 'Confirmed', 'Closed') NOT NULL DEFAULT 'New',
  `customer_message` LONGTEXT NULL,
  `admin_remark` LONGTEXT NULL,
  `total_quantity` INT NOT NULL DEFAULT 1,
  `subtotal` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `discount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `delivery_charge` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `tax_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `total_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `shipping_contact_person` VARCHAR(150) NULL,
  `shipping_company` VARCHAR(150) NULL,
  `shipping_street` TEXT NULL,
  `shipping_city` VARCHAR(100) NULL,
  `shipping_state` VARCHAR(100) NULL,
  `shipping_zip` VARCHAR(20) NULL,
  `shipping_country` VARCHAR(100) DEFAULT 'India',
  `shipping_phone` VARCHAR(50) NULL,
  `created_by` VARCHAR(100) NOT NULL DEFAULT 'Website Visitor',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_enquiry_ref` (`reference_no`),
  INDEX `idx_enquiry_status` (`status`),
  INDEX `idx_enquiry_customer` (`customer_id`),
  INDEX `idx_enquiry_created` (`created_at`),
  CONSTRAINT `fk_enquiry_customer` FOREIGN KEY (`customer_id`) 
    REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Product Enquiries & Quotations';

-- ----------------------------------------------------------------------------
-- 9. Table: `enquiry_items`
-- ----------------------------------------------------------------------------
CREATE TABLE `enquiry_items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NULL,
  `product_name` VARCHAR(255) NOT NULL,
  `product_sku` VARCHAR(100) NULL,
  `product_category` VARCHAR(150) NULL,
  `product_image` VARCHAR(255) NOT NULL DEFAULT 'assets/images/products/gamma.png',
  `product_url` VARCHAR(255) NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `tax` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `total_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Ready',
  `specs` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_item_enquiry` (`enquiry_id`),
  INDEX `idx_item_product` (`product_id`),
  CONSTRAINT `fk_item_enquiry` FOREIGN KEY (`enquiry_id`) 
    REFERENCES `enquiries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_product` FOREIGN KEY (`product_id`) 
    REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Enquiry line items';

-- ----------------------------------------------------------------------------
-- 10. Table: `enquiry_timeline`
-- ----------------------------------------------------------------------------
CREATE TABLE `enquiry_timeline` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `actor` VARCHAR(100) NOT NULL DEFAULT 'System',
  `icon` VARCHAR(100) NOT NULL DEFAULT 'solar:inbox-line-broken',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_timeline_enquiry` (`enquiry_id`),
  CONSTRAINT `fk_timeline_enquiry` FOREIGN KEY (`enquiry_id`) 
    REFERENCES `enquiries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Enquiry activity audit timeline';

-- ----------------------------------------------------------------------------
-- 11. Table: `case_studies`
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `case_studies`;

CREATE TABLE `case_studies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `case_study_code` VARCHAR(50) NOT NULL UNIQUE,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `client` VARCHAR(255) NULL,
  `industry` VARCHAR(100) NOT NULL DEFAULT 'General',
  `location` VARCHAR(255) NULL,
  `featured_image` VARCHAR(255) NOT NULL DEFAULT 'assets/images/project/project1.jpeg',
  `overview` LONGTEXT NULL,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `meta_title` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_casestudy_slug` (`slug`),
  INDEX `idx_casestudy_industry` (`industry`),
  INDEX `idx_casestudy_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Case studies CMS';

-- ----------------------------------------------------------------------------
-- 12. Table: `settings`
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` LONGTEXT NULL,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='System Configuration Key-Value Store';

-- ----------------------------------------------------------------------------
-- 13. Table: `blogs`
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `category` VARCHAR(100) NOT NULL DEFAULT 'General',
  `category_slug` VARCHAR(100) NOT NULL DEFAULT 'general',
  `author` VARCHAR(100) NOT NULL DEFAULT 'TeknoLite Team',
  `published_date` DATE NOT NULL,
  `featured_image` VARCHAR(255) NOT NULL DEFAULT 'assets/images/blog/blog-details.jpg',
  `short_description` TEXT NULL,
  `content` LONGTEXT NULL,
  `views` INT NOT NULL DEFAULT 0,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `meta_title` VARCHAR(255) NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_blog_slug` (`slug`),
  INDEX `idx_blog_status` (`status`),
  INDEX `idx_blog_category` (`category_slug`),
  INDEX `idx_blog_published` (`published_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='TeknoLite Blog CMS Articles';

-- ----------------------------------------------------------------------------
-- Seed Data: `admin_users`
-- Default Admin Password: Admin@123
-- ----------------------------------------------------------------------------
INSERT INTO `admin_users` (`id`, `admin_code`, `username`, `email`, `name`, `role`, `password`, `avatar`, `status`, `login_attempts`, `locked_until`, `last_login`, `created_at`) VALUES
(1, 'ADM-1001', 'admin', 'admin@teknolite.com', 'TeknoLite Administrator', 'Super Admin', '$2y$10$crvEJ.XVvaO25RE4u2.SiuJuqopkPLJXIu346J7I7w1L3gmXFb.Wi', 'assets/admin/images/avatar.jpg', 'active', 0, NULL, '2026-09-09 10:02:54', '2026-01-01 00:00:00'),
(2, 'ADM-1002', 'manager', 'manager@teknolite.com', 'Lighting Studio Manager', 'Store Manager', '$2y$10$crvEJ.XVvaO25RE4u2.SiuJuqopkPLJXIu346J7I7w1L3gmXFb.Wi', 'assets/admin/images/avatar.jpg', 'active', 0, NULL, NULL, '2026-02-01 00:00:00'),
(3, 'ADM-1003', 'devika', 'devika@nexmoves.in', 'Devika Admin', 'Super Admin', '$2y$10$crvEJ.XVvaO25RE4u2.SiuJuqopkPLJXIu346J7I7w1L3gmXFb.Wi', 'assets/admin/images/avatar.jpg', 'active', 0, NULL, NULL, '2026-09-09 10:00:00'),
(4, 'ADM-1004', 'nexmoves', 'nexmovesolutionssubscription@gmail.com', 'Nexmoves Administrator', 'Super Admin', '$2y$10$crvEJ.XVvaO25RE4u2.SiuJuqopkPLJXIu346J7I7w1L3gmXFb.Wi', 'assets/admin/images/avatar.jpg', 'active', 0, NULL, NULL, '2026-09-09 10:00:00');

-- ----------------------------------------------------------------------------
-- Seed Data: `categories`
-- ----------------------------------------------------------------------------
INSERT INTO `categories` (`id`, `name`, `slug`, `tag_id`, `image`, `short_description`, `description`, `starting_price`, `stock`, `display_order`, `status`, `created_by`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Cobspot Light', 'cobspot-light', 'CAT-COB01', 'assets/images/products/gamma.png', 'Architectural recessed LED COB spotlights with deep-set anti-glare optics.', 'High CRI recessed spotlights with faceted reflectors for ambient, accent, and directional illumination in luxury commercial and residential interiors.', 1450, 500, 1, 'active', 'Admin', 'Cobspot Lights | TeknoLite Architectural Lighting', 'cobspot light, recessed spotlight, architectural cob, downlight', 'Explore professional COB spotlights engineered for low glare and vibrant color rendering.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(2, 'Down Lights', 'down-lights', 'DL20419', 'assets/images/products/mv8box.png', 'Commercial and residential recessed downlights for general ambient illumination.', 'Versatile recessed downlight solutions available in round and square profiles with die-cast aluminum heat sinks for long service life.', 980, 820, 2, 'inactive', 'Admin', 'LED Down Lights Collection | TeknoLite', 'down lights, ceiling lights, recessed lights, commercial downlight', 'Browse durable, energy-efficient LED downlights suitable for homes and offices.', '2026-09-01 10:15:00', '2026-09-09 10:27:37'),
(3, 'Spot Lights', 'spot-lights', 'SL33910', 'assets/images/products/spotlight.png', 'Directional accent spotlights designed for focused exhibition and retail displays.', 'Compact and adjustable spotlights featuring multiple optic angles (15°/24°/36°) to accentuate artwork, displays, and architectural features.', 1200, 340, 3, 'active', 'Admin', 'Adjustable Spot Lights | TeknoLite', 'spot lights, accent lighting, directional light, showroom lighting', 'High-performance spotlight luminaires for retail showcases, galleries, and hospitality.', '2026-09-01 10:30:00', '2026-09-09 12:00:00'),
(4, 'Garden Lights', 'garden-lights', 'GL48102', 'assets/images/products/glight.png', 'IP65 weatherproof outdoor landscape spikes and bollard garden illumination.', 'Constructed with corrosion-resistant powder-coated aluminum and tempered glass, providing robust outdoor illumination for walkways, facades, and garden foliage.', 1850, 260, 4, 'active', 'Admin', 'Outdoor & Garden Lights | TeknoLite', 'garden lights, outdoor lighting, ip65 landscape light, spike light', 'Weather-resistant outdoor lighting fixtures for landscape architecture and garden pathways.', '2026-09-01 10:45:00', '2026-09-09 12:00:00'),
(5, 'Linear Lighting', 'linear-lighting', 'LL51920', 'assets/images/products/rldrd.png', 'Seamless architectural linear profiles for modern office ceilings and corridors.', 'Continuous, glare-free linear illumination available in surface, recessed, and suspended pendant configurations for modern corporate interiors.', 2400, 195, 5, 'active', 'Seller', 'Architectural Linear Lighting | TeknoLite', 'linear lighting, linear profile, suspended pendant, commercial office lights', 'Continuous linear LED profiles engineered for seamless architectural lighting layouts.', '2026-09-01 11:00:00', '2026-09-09 12:00:00'),
(6, 'Track Lighting', 'track-lighting', 'TL60218', 'assets/images/products/ely.png', 'Flexible track lighting systems with rotatable heads for dynamic showroom configurations.', 'Modular 3-phase and magnetic track spotlights offering 360-degree rotation and 90-degree tilt for maximum versatility in retail stores and galleries.', 1650, 410, 6, 'active', 'Admin', 'Track Lighting Systems | TeknoLite', 'track lighting, magnetic track, retail track lights, adjustable track', 'Flexible track lighting solutions engineered for dynamic retail and commercial environments.', '2026-09-01 11:15:00', '2026-09-09 12:00:00'),
(7, 'Wall Washers', 'wall-washers', 'WW71829', 'assets/images/products/rldsq.png', 'High-uniformity vertical illumination for textured walls and architectural facades.', 'Asymmetric optical distribution specifically designed to wash vertical surfaces smoothly without hot spots or scalloping.', 2100, 150, 7, 'active', 'Seller', 'LED Wall Washers | TeknoLite', 'wall washer, asymmetric optics, vertical illumination, architectural lights', 'Uniform vertical wall washing luminaires for commercial interiors and facades.', '2026-09-01 11:30:00', '2026-09-09 12:00:00'),
(8, 'Linear Lighting', 'linear-lighting-1', 'CAT-06E31', 'assets/images/products/rldrd.png', '', '', 1200, 100, 1, 'active', 'Admin', '', '', '', '2026-09-09 10:56:20', '2026-09-09 10:56:20');

-- ----------------------------------------------------------------------------
-- Seed Data: `subcategories`
-- ----------------------------------------------------------------------------
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `slug`, `tag_id`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Recessed Trimless', 'recessed-trimless', 'SUB-101', 'Trimless seamless recessed mounting for contemporary minimalist ceilings.', 1, 'active', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(2, 1, 'Recessed Trimmed', 'recessed-trimmed', 'SUB-102', 'Flanged recessed ceiling installation with clean overlap edge for fast retrofitting.', 2, 'active', '2026-09-01 10:10:00', '2026-09-09 12:00:00'),
(3, 2, 'Surface Mounted', 'surface-mounted', 'SUB-103', 'Direct slab and ceiling surface installation without requiring cutouts.', 3, 'active', '2026-09-01 10:20:00', '2026-09-09 12:00:00'),
(4, 2, 'Square Recessed', 'square-recessed', 'SUB-104', 'Geometric square aperture downlight fixtures with specular secondary reflectors.', 4, 'active', '2026-09-01 10:30:00', '2026-09-09 12:00:00'),
(5, 6, 'Track Spotlight', 'track-spotlight', 'SUB-105', 'Adjustable 3-circuit and magnetic track directional spotlights for retail displays.', 5, 'active', '2026-09-01 10:40:00', '2026-09-09 12:00:00'),
(6, 4, 'Landscape Spike', 'landscape-spike', 'SUB-106', 'Ground stake outdoor luminaires for plant accentuation and pathway illumination.', 6, 'active', '2026-09-01 10:50:00', '2026-09-09 12:00:00'),
(7, 4, 'Bollard Light', 'bollard-light', 'SUB-107', 'Free-standing vertical landscape fixtures with 360-degree radial glare-free beam.', 7, 'active', '2026-09-01 11:00:00', '2026-09-09 12:00:00'),
(8, 5, 'Linear Pendant', 'linear-pendant', 'SUB-108', 'Suspended architectural linear profiles with direct/indirect optical distribution.', 8, 'active', '2026-09-01 11:10:00', '2026-09-09 12:00:00'),
(9, 3, 'Micro Spotlight', 'micro-spotlight', 'SUB-109', 'Miniature showcase and boutique display spotlights with narrow beam angles.', 9, 'active', '2026-09-01 11:20:00', '2026-09-09 12:00:00');

-- ----------------------------------------------------------------------------
-- Seed Data: `products`
-- ----------------------------------------------------------------------------
INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `category_name`, `subcategory_name`, `name`, `slug`, `sku`, `price`, `regular_price`, `price_on_request`, `stock`, `display_order`, `status`, `is_featured`, `is_bestseller`, `rating`, `reviews_count`, `featured_image`, `hover_image`, `short_description`, `full_description`, `spec_wattage`, `spec_cct`, `spec_beam_angles`, `spec_finishes`, `spec_voltage`, `spec_cri`, `spec_ip`, `spec_mounting`, `spec_dimensions`, `spec_lumens`, `spec_ugr`, `features`, `applications`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Cobspot Light', 'Recessed Trimless', 'LED COB Downlight', 'led-cob-downlight', 'TL-GAMMA-01', 1450, 1800, 1, 486, 1, 'active', 1, 0, 4.8, 55, 'assets/images/products/gamma.png', 'assets/images/products/gamma_hover.jpeg', 'Architectural recessed LED COB downlight with deep-set anti-glare optics and vibrant color fidelity.', 'TeknoLite LED COB Downlight provides focused, efficient illumination with a clean recessed ceiling finish. Featuring an integrated die-cast aluminum heat sink, precision faceted secondary reflector, and high CRI > 90 chip, it ensures seamless integration into luxury residences, hospitality suites, and boutique showrooms.', '7W, 12W, 18W, 24W', '3000K Warm White, 4000K Natural White, 6000K Cool White', '15°, 24°, 36°, 60°', 'Matt White, Matt Black, Brushed Gold', 'AC 220-240V, 50/60Hz', '> 90 Ra', 'IP20 / IP44 Optional', 'Ceiling Recessed', 'Ø85mm x 70mm (Cutout Ø75mm)', '950 - 2400 Lumens • &lt; 16 Anti-Glare', '< 16 Anti-Glare', 'Deep recessed anti-glare optical chamber (UGR &lt; 16)
High lumen efficacy up to 105 lm/W
Heavy-duty die-cast aluminum thermal heat dissipation
Flicker-free isolated constant current LED driver
50,000+ hours L70 rated operating lifespan', 'Luxury Residential Villas
High-End Retail Boutiques
Hospitality & Hotel Guestrooms
Art Galleries & Museums
Corporate Executive Boardrooms', 'LED COB Downlight | Architectural Lighting | TeknoLite', 'LED COB Downlight, Recessed Downlight, Anti-glare downlight, Architectural Lighting, TeknoLite', 'Explore TeknoLite LED COB Downlight with UGR < 16> 90, and multi-wattage options. Request a quote or download spec sheets.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(2, 3, 5, 'Spot Lights', 'Track Spotlight', 'LED Track Light', 'led-track-light', 'TL-GLIGHT-02', 2250, 2750, 0, 784, 2, 'active', 1, 0, 4.9, 143, 'assets/images/products/glight.png', 'assets/images/products/glight_hover.jpeg', 'High-performance commercial track spotlight with 350° horizontal rotation and 90° vertical tilt.', 'Engineered for flexibility and punch, the TeknoLite Commercial Track Light features an adaptable universal 3-circuit track adapter, honeycomb louver option, and interchangeable optical lenses. Perfectly illuminates accent displays, apparel, and gallery artwork.', '15W, 24W, 30W', '3000K Warm White, 4000K Natural White, 5000K Neutral White', '15°, 24°, 38°', 'Matt Black, Matt White', 'AC 220-240V, 50/60Hz', '> 92 Ra', 'IP20', 'Universal 3-Circuit / 1-Phase Track', 'Ø70mm x 140mm', '1500 - 3200 Lumens', '< 19', '350° horizontal rotation and 90° vertical articulation
Compatible with global standard track rails
Passive cooling finned aluminum extrusion body
Interchangeable optical reflectors for precise beam control
Triac and DALI dimming options available', 'Fashion Retail & Showrooms
Museums & Art Galleries
Automotive Displays
Commercial Lobbies
Jewelry Boutiques', 'Commercial LED Track Light | Spotlights | TeknoLite', 'LED Track Light, Commercial Spotlight, Track lighting, Retail display light, TeknoLite', 'TeknoLite commercial grade LED Track Light with 350-degree rotation, high CRI 92, and multiple beam spreads for flexible display lighting.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(3, 4, 6, 'Garden Lights', 'Landscape Spike', 'Garden & Landscape Light', 'garden-landscape-light', 'TL-GLS-03', 1850, 2200, 0, 769, 3, 'active', 0, 1, 4.7, 174, 'assets/images/products/gls.png', 'assets/images/products/gls_hover.jpeg', 'IP65 waterproof landscape spike and flood fixture for gardens, pathways, and facade accents.', 'Built from marine-grade anodized aluminum with corrosion-resistant electrostatic powder coating, this outdoor landscape spotlight withstands harsh environmental conditions while delivering dramatic grazing and accent effects onto flora, trees, and architectural columns.', '6W, 10W, 15W', '3000K Warm White, 4000K Natural White, Green Accent', '24°, 45°, 60°', 'Anodized Dark Gray, Matt Black', 'AC 85-265V / 24V DC Safe Low Voltage', '> 80 Ra', 'IP65 Waterproof', 'Ground Spike / Surface Base', 'Ø60mm x 120mm (Ground Spike: 160mm)', '580 - 1450 Lumens', 'N/A (Outdoor)', 'IP65 waterproof rating with double silicone sealing rings
Tempered impact-resistant optical glass lens
Anti-glare cowl/hood to shield stray light
Heavy-duty ABS ground spike with tilt lock mechanism
Available in safe 24V DC extra-low-voltage variant', 'Garden Pathways & Walkways
Tree & Shrub Up-Lighting
Exterior Facade Grazing
Hotel Landscape & Courtyards
Resort Water Features & Patios', 'Outdoor Garden & Landscape Spike Light | IP65 | TeknoLite', 'Garden Light, Landscape Spotlight, Outdoor LED Light, IP65 Spike Light, TeknoLite', 'TeknoLite IP65 waterproof outdoor garden spotlight with ground spike and surface mount base for landscaping, trees, and facade illumination.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(4, 2, 3, 'Down Lights', 'Surface Mounted', 'Surface Mount Downlight', 'surface-mount-downlight', 'TL-MV8BOX-04', 1650, 1950, 0, 571, 4, 'active', 0, 0, 4.6, 88, 'assets/images/products/mv8box.png', 'assets/images/products/mv8box_hover.jpeg', 'Square architectural surface-mounted cylinder downlight for exposed slab ceilings.', 'Designed specifically for architectural ceilings without false ceiling or drywall cutouts, the MV8 series mounts directly onto concrete slabs, exposed beams, or wood deck ceilings, providing clean, geometric aesthetic appeal with internal driver housing.', '10W, 15W, 20W', '3000K Warm White, 4000K Natural White, 6000K Cool White', '24°, 36°', 'Matt White, Matt Black', 'AC 220-240V, 50/60Hz', '> 90 Ra', 'IP20', 'Ceiling Surface Mounted', '85mm x 85mm x 100mm', '900 - 1900 Lumens', '< 18', 'Surface mount canopy with twist-and-lock mounting ring
Clean seamless housing with concealed fasteners
Integrated flicker-free driver within fixture canopy
Deep anti-glare louver baffle
High CRI > 90 true color representation', 'Exposed Concrete Slab Lofts
Modern Minimalist Apartments
Commercial Corridors & Lobbies
Restaurants & Cafe Ceilings
Retail Stores', 'Square Surface Mount Downlight | Architectural | TeknoLite', 'Surface Downlight, Square Cylinder Downlight, Ceiling Surface Light, Architectural Lighting, TeknoLite', 'Discover TeknoLite square surface-mounted downlights for concrete ceilings and spaces without recessed provisions. High CRI and clean design.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(5, 3, 9, 'Spot Lights', 'Micro Spotlight', 'Spotlight Accent Series', 'spotlight-accent-series', 'TL-SPOT-05', 950, 1200, 0, 420, 5, 'active', 0, 0, 4.8, 92, 'assets/images/products/spotlight.png', 'assets/images/products/spotlight_hover.jpeg', 'Precision miniature spotlight fixture for museum vitrines, jewelry displays, and niche lighting.', 'The TeknoLite Micro Spotlight delivers focused, punchy accent beams in compact form factors. Ideal for fine jewelry displays, niche shelving, museum showcases, and bespoke residential millwork.', '5W, 8W, 12W', '3000K Warm White, 4000K Natural White', '15°, 24°, 36°', 'Matt Black, Brushed Gold, Matt White', 'AC 220-240V', '> 90 Ra', 'IP20', 'Mini Surface / Niche Base', 'Ø50mm x 85mm', '450 - 1100 Lumens', '< 15', 'Compact micro form factor for discreet architectural integration
Ultra-narrow 15° beam capability for pinpoint accenting
360° rotational knuckle hinge
Zero UV and low heat radiation for delicate artifacts', 'Jewelry & Watch Vitrines
Museum Glass Showcases
Residential Bookcases & Niches
Wine Cellars & Tasting Rooms', 'Miniature Accent Spotlight Series | TeknoLite', 'Mini Spotlight, Accent Lighting, Showcase Light, Jewelry Vitrine Light, TeknoLite', 'Precision miniature LED accent spotlights for showcase, niche, and jewelry lighting from TeknoLite.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(6, 2, 1, 'Down Lights', 'Recessed Trimless', 'Round Linear Recessed Light', 'round-linear-recessed-light', 'TL-RLDRD-06', 2100, 2500, 0, 310, 6, 'active', 1, 0, 4.7, 64, 'assets/images/products/rldrd.png', 'assets/images/products/rldrd_hover.jpeg', 'Architectural recessed round downlight with integrated linear darklight reflector for zero glare.', 'Featuring a precision darklight optical baffle system, the RLDRD round recessed luminaire completely obscures the light source at standard viewing angles, achieving true darklight illumination where light is felt without visual intrusion.', '12W, 18W, 24W', '3000K Warm White, 4000K Natural White', '30°, 45°', 'Matt White, Matt Black', 'AC 220-240V', '> 90 Ra', 'IP20', 'Trimless / Trimmed Plaster-In', 'Ø95mm x 80mm', '1100 - 2300 Lumens', '< 13 Darklight', 'Ultra-low glare darklight optical baffle (UGR < 13)
Trimless mud-in plaster frame option for seamless drywall look
Class II isolated dimmable driver compatible with 0-10V/DALI
Optimal optical efficiency with vacuum metalized reflector', 'Corporate Executive Suites
Luxury Penthouse Ceilings
Fine Dining Restaurants
Hotel Corridors & Suites', 'Round Linear Recessed Downlight | Darklight | TeknoLite', 'Round Recessed Downlight, Darklight downlight, Trimless downlight, TeknoLite', 'TeknoLite round linear recessed downlight with zero-glare darklight technology and trimless installation capability.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(7, 2, 4, 'Down Lights', 'Square Recessed', 'Square Recessed Downlight', 'square-recessed-downlight', 'TL-RLDSQ-07', 2350, 2800, 0, 195, 7, 'active', 0, 0, 4.5, 41, 'assets/images/products/rldsq.png', 'assets/images/products/rldsq_hover.jpeg', 'Square aperture recessed architectural downlight with anti-glare louver grid.', 'Clean square geometry designed for crisp architectural ceilings. The RLDSQ downlight combines a die-cast square bezel with high-output COB LED technology, creating a sharp modern lighting statement.', '12W, 18W, 24W', '3000K Warm White, 4000K Natural White, 6000K Cool White', '24°, 36°', 'Matt Black, Matt White', 'AC 220-240V', '> 90 Ra', 'IP20', 'Square Ceiling Recessed', '95mm x 95mm x 85mm', '1150 - 2400 Lumens', '< 16', 'Architectural square die-cast aluminum trim
Deep recessed optic with square secondary cut-off
Easy spring-clip mounting into false ceilings
Reliable thermal heat dissipation', 'Modern Commercial Offices
Hotel Guest Corridors
Contemporary Residences
Retail Showrooms', 'Square Recessed Downlight | TeknoLite Architectural', 'Square Recessed Light, Square Downlight, Architectural Downlight, TeknoLite', 'TeknoLite square architectural recessed downlight with anti-glare baffle and high efficiency LED engine.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(8, 8, 8, 'Linear Lighting', 'Linear Pendant', 'Architectural Linear Pendant', 'architectural-linear-pendant', 'TL-ELY-08', 4800, 5600, 1, 85, 8, 'active', 1, 1, 4.9, 112, 'assets/images/products/ely.png', 'assets/images/products/ely_hover.jpeg', 'Continuous suspended linear profile fixture with direct/indirect dual light distribution.', 'The ELY Linear Pendant delivers seamless continuous lines of light with up-down lighting capability. Featuring precision opal micro-prismatic optics to prevent visual fatigue in modern offices, co-working studios, and conference spaces.', '20W, 36W, 48W', '3000K Warm White, 4000K Natural White', 'Direct 90° / Indirect 110°', 'Anodized Black, Anodized Silver, Matt White', 'AC 220-240V', '> 90 Ra', 'IP20', 'Aircraft Cable Suspended / Surface', '1200mm x 50mm x 75mm', '2200 - 5200 Lumens', '< 19 Office Compliant', 'Dual up/down emission for ceiling illumination and task lighting
Continuous joiner hardware for unbroken runs up to 30 meters
Micro-prismatic UGR < 19 glare control diffuser
Adjustable stainless steel aircraft cable suspension (1.5m)
Optional DALI-2 push-dim integrated protocol', 'Open Plan Offices & Workspaces
Conference & Meeting Rooms
Architectural Design Studios
Educational Classrooms & Libraries
Reception Desks & Retail Counters', 'Architectural Linear Pendant | Direct Indirect | TeknoLite', 'Linear Pendant, Suspended Linear Light, Direct Indirect Light, Office Lighting, TeknoLite', 'Continuous suspended linear profile lighting by TeknoLite. Features direct and indirect illumination for modern architectural workspaces.', '2026-09-01 10:00:00', '2026-09-09 12:00:00'),
(9, 6, 5, 'Track Lighting', 'Track Spotlight', 'Magnetic Track Spotlight 15W', 'magnetic-track-spotlight-15w', 'TL-MAG-09', 2650, 3150, 0, 150, 9, 'active', 1, 1, 4.9, 28, 'assets/images/products/ely.png', 'assets/images/products/ely_hover.jpeg', 'Architectural 48V magnetic low-voltage track spotlight with 360° pan and 90° tilt.', 'Premium magnetic track spotlight designed for high-end retail, museums, and modern residential spaces. Delivers high CRI > 92 illumination with anti-glare honeycomb louvre.', '15W', '3000K, 4000K', '15°, 24°, 36°', 'Matt Black, Matt White', 'DC 48V', '> 92 Ra', 'IP20', 'Magnetic Track 48V', 'Ø55mm x 110mm', '1350 Lumens', '< 16 Anti-Glare', '48V Low voltage safety\nInstant tool-less magnetic click installation\nDeep recessed secondary reflector\nFlicker-free dimming compatible', 'Luxury Boutiques\nArt Galleries\nResidential Living\nShowrooms', 'Magnetic Track Spotlight 15W | TeknoLite', 'magnetic track light, 48V spotlight, architectural track light', 'Discover TeknoLite 48V Magnetic Track Spotlight with CRI > 92 and anti-glare optics.', '2026-09-02 10:00:00', NOW()),
(10, 7, 8, 'Wall Washers', 'Linear Pendant', 'Architectural Linear Wall Washer', 'architectural-linear-wall-washer', 'TL-WW-10', 3400, 3950, 0, 120, 10, 'active', 1, 0, 4.8, 19, 'assets/images/products/rldsq.png', 'assets/images/products/rldsq_hover.jpeg', 'Precision asymmetric linear optical wall washer fixture for uniform vertical illumination.', 'High-efficiency vertical architectural wall washer engineered to eliminate scallop effects and highlight vertical facades and gallery accent walls.', '24W, 36W', '3000K, 4000K', 'Asymmetric 30° x 60°', 'Matt White, Matt Black', 'AC 220-240V, 50/60Hz', '> 90 Ra', 'IP44 / IP65', 'Ceiling Recessed / Surface', '1000mm x 45mm x 55mm', '2800 - 4200 Lumens', '< 19', 'Asymmetric wall wash optical distribution\nUniform vertical lux gradient without hot spots\nExtruded aviation-grade aluminum casing\nAvailable in standard and custom lengths', 'Commercial Lobbies\nMuseum Feature Walls\nHotel Reception Facades\nExecutive Offices', 'Architectural Linear Wall Washer | TeknoLite', 'wall washer, asymmetric linear light, facade wall wash, TeknoLite', 'High-efficiency asymmetric architectural linear wall washer for commercial and hospitality interiors.', '2026-09-03 11:30:00', NOW());

-- ----------------------------------------------------------------------------
-- Seed Data: `product_gallery`
-- ----------------------------------------------------------------------------
INSERT INTO `product_gallery` (`id`, `product_id`, `image_path`, `display_order`, `created_at`) VALUES
(1, 1, 'assets/images/products/gamma.png', 1, NOW()),
(2, 1, 'assets/images/products/gamma_hover.jpeg', 2, NOW()),
(3, 1, 'assets/images/shop/banner1.jpg', 3, NOW()),
(4, 1, 'assets/images/shop/banner1.1.jpg', 4, NOW()),
(5, 2, 'assets/images/products/glight.png', 1, NOW()),
(6, 2, 'assets/images/products/glight_hover.jpeg', 2, NOW()),
(7, 3, 'assets/images/products/gls.png', 1, NOW()),
(8, 3, 'assets/images/products/gls_hover.jpeg', 2, NOW()),
(9, 4, 'assets/images/products/mv8box.png', 1, NOW()),
(10, 4, 'assets/images/products/mv8box_hover.jpeg', 2, NOW()),
(11, 5, 'assets/images/products/spotlight.png', 1, NOW()),
(12, 5, 'assets/images/products/spotlight_hover.jpeg', 2, NOW()),
(13, 6, 'assets/images/products/rldrd.png', 1, NOW()),
(14, 6, 'assets/images/products/rldrd_hover.jpeg', 2, NOW()),
(15, 7, 'assets/images/products/rldsq.png', 1, NOW()),
(16, 7, 'assets/images/products/rldsq_hover.jpeg', 2, NOW()),
(17, 8, 'assets/images/products/ely.png', 1, NOW()),
(18, 8, 'assets/images/products/ely_hover.jpeg', 2, NOW());

-- ----------------------------------------------------------------------------
-- Seed Data: `customers`
-- ----------------------------------------------------------------------------
INSERT INTO `customers` (`id`, `customer_code`, `name`, `email`, `mobile`, `company`, `gst_number`, `address`, `city`, `state`, `pincode`, `country`, `password`, `avatar`, `status`, `registered_at`, `created_at`, `updated_at`) VALUES
(1, 'CUST-1001', 'Gail C. Anderson', 'gail.anderson@matrixbuild.com', '+91 98201 45892', 'Wilson\'s Jewelers LTD / Matrix Architects', '27AABCW9603R1ZN', '1344 Hershell Hollow Road, Bandra Kurla Complex', 'Mumbai', 'Maharashtra', '400051', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-1.jpg', 'inactive', '2024-01-15 10:30:00', '2024-01-15 10:30:00', NOW()),
(2, 'CUST-1002', 'Jung S. Ayala', 'jung.ayala@luxuryliving.in', '+91 97112 84920', 'Ayala Luxury Living Studio', '29AAGCA8821K1ZM', '88 Indiranagar 100ft Road', 'Bengaluru', 'Karnataka', '560038', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-2.jpg', 'active', '2024-02-10 14:20:00', '2024-02-10 14:20:00', NOW()),
(3, 'CUST-1003', 'David A. Arnold', 'david.arnold@grandresorts.com', '+91 98450 12389', 'Arnold Hospitality Group', '30AAGCA5512D1ZR', 'Palolem Beach Road, Canacona', 'Goa', 'Goa', '403702', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-3.jpg', 'active', '2024-02-28 09:15:00', '2024-02-28 09:15:00', NOW()),
(4, 'CUST-1004', 'Cecile D. Gordon', 'cecile.gordon@lightingconsult.com', '+91 99304 88120', 'Gordon Lighting Consulting', '06AAGCG7714P1ZQ', 'Tower B, Cyber City DLF Phase 2', 'Gurugram', 'Haryana', '122002', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-4.jpg', 'active', '2024-03-05 16:40:00', '2024-03-05 16:40:00', NOW()),
(5, 'CUST-1005', 'William Moreno', 'william.moreno@morenoarch.com', '+91 98110 56743', 'Moreno & Associates Architects', '36AAGCM9923N1ZY', 'Plot 42, Jubilee Hills Road No. 36', 'Hyderabad', 'Telangana', '500033', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-5.jpg', 'active', '2024-03-14 11:00:00', '2024-03-14 11:00:00', NOW()),
(6, 'CUST-1006', 'Alphonse Roy', 'alphonse.roy@roycommercial.com', '+91 97401 22987', 'Roy Commercial Developers', '32AAGCR4410H1ZX', 'Roy Complex, MG Road', 'Kochi', 'Kerala', '682016', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-6.jpg', 'active', '2024-03-20 15:50:00', '2024-03-20 15:50:00', NOW()),
(7, 'CUST-1007', 'Pierpont Marleau', 'pierpont@marleaudesign.org', '+91 98840 77154', 'Marleau Retail Group', '27AAGCM1129L1ZW', 'Phoenix Palladium, Lower Parel', 'Mumbai', 'Maharashtra', '400013', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-7.jpg', 'inactive', '2024-03-25 12:10:00', '2024-03-25 12:10:00', NOW()),
(8, 'CUST-1008', 'Madeleine Gervais', 'madeleine.gervais@designcube.in', '+91 96190 33412', 'Design Cube Architects', '27AAGCD6618F1ZV', 'Koregaon Park Road No. 5', 'Pune', 'Maharashtra', '411001', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-8.jpg', 'active', '2024-04-01 17:30:00', '2024-04-01 17:30:00', NOW()),
(9, 'CUST-1009', 'Satordi Gaillou', 'satordi.gaillou@urbanlight.com', '+91 98230 99881', 'Gaillou Architectural Lighting', '08AAGCG3312C1ZU', 'C-Scheme, Subhash Marg', 'Jaipur', 'Rajasthan', '302001', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-9.jpg', 'active', '2024-04-12 10:15:00', '2024-04-12 10:15:00', NOW()),
(10, 'CUST-1010', 'Rohit Verma', 'rohit.verma@lumenspace.com', '+91 98330 44556', 'LumenSpace Engineering', '07AAGCL2209K1ZT', 'Connaught Place, Barakhamba Road', 'New Delhi', 'Delhi', '110001', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/users/avatar-1.jpg', 'inactive', '2024-04-18 13:45:00', '2024-04-18 13:45:00', NOW()),
(11, 'CUST-1011', 'Devika Nexmoves', 'nexmovesolutionssubscription@gmail.com', '+91 98765 43210', 'Nexmoves Solutions', '27AABCW9603R1ZN', 'Commercial Complex, MG Road', 'Mumbai', 'Maharashtra', '400001', 'India', '$2y$10$I/XpqizbJu9BoVOie31cXuVrB/BYMvXEDLl8F70HSb8riTmAls5mO', 'assets/images/avatar/avatar-3.jpg', 'active', '2026-09-09 10:00:00', '2026-09-09 10:00:00', NOW());

-- ----------------------------------------------------------------------------
-- Seed Data: `customer_wishlist`
-- ----------------------------------------------------------------------------
INSERT INTO `customer_wishlist` (`customer_id`, `product_id`, `product_name`, `product_category`, `product_image`, `product_url`, `created_at`) VALUES
(11, '3', 'Magnetic Linear Profile', 'Magnetic Lights', 'assets/images/products/gls.png', 'productdetail/magnetic-linear-profile', NOW()),
(2, '2', 'LED Track Light', 'Spot Lights', 'assets/images/products/glight.png', 'productdetail/led-track-light', NOW()),
(2, '4', 'Surface Mounted Cylinder Light', 'Ceiling Lights', 'assets/images/products/gamma.png', 'productdetail/surface-mounted-cylinder-light', NOW());


-- ----------------------------------------------------------------------------
-- Seed Data: `enquiries`
-- ----------------------------------------------------------------------------
INSERT INTO `enquiries` (`id`, `reference_no`, `customer_id`, `customer_name`, `email`, `mobile`, `company_name`, `priority`, `status`, `customer_message`, `admin_remark`, `total_quantity`, `subtotal`, `discount`, `delivery_charge`, `tax_amount`, `total_amount`, `shipping_contact_person`, `shipping_company`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `shipping_phone`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '#583488/80', 1, 'Gail C. Anderson', 'gail.anderson@matrixbuild.com', '+91 98201 45892', 'Wilson\'s Jewelers LTD', 'Normal', 'New', 'We require high CRI warm white downlights for a luxury jewelry showroom renovation. Need anti-glare optics (<16 UGR) and gold finish trim to match interior accents. Please provide quotation for 40 units with DALI dimmable drivers.', 'New enquiry received from website. Initial review needed for DALI driver availability with our technical engineer.', 20, 35200, 1760, 0, 6019.2, 39459.2, 'Gail C. Anderson', 'Wilson\'s Jewelers LTD', '1344 Hershell Hollow Road', 'Mumbai', 'Maharashtra', '400051', 'India', '(723) 732-760-5760', 'Website Visitor', '2024-04-23 18:23:00', NOW()),
(2, '#ENQ-456754/80', 2, 'Jung S. Ayala', 'jung.ayala@luxuryliving.in', '+91 97112 84920', 'Ayala Luxury Living Studio', 'Normal', 'Closed', 'Need surface mounted architectural downlights for an exposed concrete ceiling penthouse in Bangalore. Looking for textured matt black finish.', 'Order completely delivered and closed.', 18, 33300, 1665, 500, 5784.3, 37919.3, 'Jung S. Ayala', 'Ayala Luxury Living', '88 Indiranagar 100ft Road', 'Bengaluru', 'Karnataka', '560038', 'India', '+91 97112 84920', 'Website Visitor', '2024-04-20 14:15:00', NOW()),
(3, '#ENQ-578246/80', 3, 'David A. Arnold', 'david.arnold@grandresorts.com', '+91 98450 12389', 'Arnold Hospitality Group', 'High', 'Confirmed', 'Complete resort landscape lighting requirement. Need IP67 rated spike lights and bollards for pathways and garden areas. Total 60 fixtures required within 3 weeks.', 'Customer approved quote and confirmed order.', 60, 174000, 20880, 0, 27561.6, 180681.6, 'David A. Arnold', 'Grand Palolem Resorts', 'Palolem Beach Road, Canacona', 'Goa', 'Goa', '403702', 'India', '+91 98450 12389', 'Website Visitor', '2024-04-19 11:30:00', NOW()),
(4, '#ENQ-348930/80', 4, 'Cecile D. Gordon', 'cecile.gordon@lightingconsult.com', '+91 99304 88120', 'Gordon Lighting Consulting', 'Normal', 'Confirmed', 'Corporate headquarters boardroom setup. Linear suspended luminaires with acoustic felt baffle integration.', 'Advance payment received. Production scheduled at factory with expected dispatch on 28th April.', 10, 65000, 3250, 1200, 11331, 74281, 'Cecile D. Gordon', 'Gordon Lighting Consulting', 'Tower B, Cyber City DLF Phase 2', 'Gurugram', 'Haryana', '122002', 'India', '+91 99304 88120', 'Website Visitor', '2024-04-04 16:45:00', NOW()),
(5, '#ENQ-391367/80', 5, 'William Moreno', 'william.moreno@morenoarch.com', '+91 98110 56743', 'Moreno & Associates Architects', 'Normal', 'Closed', 'Need sample units for villa entrance lighting. Will proceed with 80 units upon mock-up approval.', 'Order fulfilled and delivered. Mock-up approved. Next Phase enquiry will be placed under new project code.', 4, 6400, 0, 250, 1197, 7847, 'William Moreno', 'Moreno & Associates', 'Plot 42, Jubilee Hills Road No. 36', 'Hyderabad', 'Telangana', '500033', 'India', '+91 98110 56743', 'Website Visitor', '2024-04-02 09:10:00', NOW()),
(6, '#ENQ-930447/80', 6, 'Alphonse Roy', 'alphonse.roy@roycommercial.com', '+91 97401 22987', 'Roy Commercial Developers', 'High', 'Quotation Sent', 'Complete shopping mall atrium lighting scheme. Need 3000K warm tone, wide beam angle linear fixtures with emergency backup battery packs.', 'Technical proposal submitted with 3-hour emergency driver specifications. Awaiting commercial signoff.', 30, 102000, 10200, 0, 16524, 108324, 'Alphonse Roy', 'Roy Commercial Developers', 'Roy Complex, MG Road', 'Kochi', 'Kerala', '682016', 'India', '+91 97401 22987', 'Website Visitor', '2024-03-28 15:20:00', NOW()),
(7, '#ENQ-462397/80', 7, 'Pierpont Marleau', 'pierpont@marleaudesign.org', '+91 98840 77154', 'Marleau Retail Group', 'High', 'Closed', 'Boutique fashion showroom track lighting. Looking for 3-circuit track spotlights with honeycomb louvre attachments.', 'Fulfilled and closed successfully.', 16, 35200, 1760, 400, 6091.2, 39931.2, 'Pierpont Marleau', 'Marleau Retail', 'Phoenix Palladium, Lower Parel', 'Mumbai', 'Maharashtra', '400013', 'India', '+91 98840 77154', 'Website Visitor', '2024-03-20 12:00:00', NOW()),
(8, '#ENQ-472356/80', 8, 'Madeleine Gervais', 'madeleine.gervais@designcube.in', '+91 96190 33412', 'Design Cube Architects', 'Normal', 'Confirmed', 'Modern villa outdoor facade illumination. Need IP65 warm white wall washers with asymmetric beam distribution.', 'Order confirmed. Client transferred 50% advance. Delivery scheduled for 1st May.', 12, 37200, 1860, 500, 6451.2, 42291.2, 'Madeleine Gervais', 'Design Cube Architects', 'Koregaon Park Road No. 5', 'Pune', 'Maharashtra', '411001', 'India', '+91 96190 33412', 'Website Visitor', '2024-03-12 17:05:00', NOW()),
(9, '#ENQ-448226/80', 9, 'Satordi Gaillou', 'satordi.gaillou@urbanlight.com', '+91 98230 99881', 'Gaillou Architectural Lighting', 'High', 'In Review', 'Heritage building facade restoration lighting in Jaipur. Strict requirement for 2200K super-warm color temperature and custom sand-beige powder coating.', 'Contacted LED driver supplier for custom 2200K Nichia emitter batch availability. Feasibility confirmed.', 25, 70000, 3500, 800, 12114, 79414, 'Satordi Gaillou', 'Gaillou Architectural', 'C-Scheme, Subhash Marg', 'Jaipur', 'Rajasthan', '302001', 'India', '+91 98230 99881', 'Website Visitor', '2024-03-02 10:40:00', NOW());

-- ----------------------------------------------------------------------------
-- Seed Data: `enquiry_items`
-- ----------------------------------------------------------------------------
INSERT INTO `enquiry_items` (`id`, `enquiry_id`, `product_id`, `product_name`, `product_sku`, `product_category`, `product_image`, `product_url`, `quantity`, `unit_price`, `tax`, `total_price`, `status`, `specs`, `created_at`) VALUES
(1, 1, 1, 'LED COB Downlight', 'TL-GAMMA-01', 'Cobspot Light', 'assets/images/products/gamma.png', '', 12, 1450, 261, 20532, 'Ready', '12W • 3000K Warm White • Brushed Gold • DALI', '2024-04-23 18:23:00'),
(2, 1, 2, 'LED Track Light Pro', 'TL-TRACK-02', 'Track Light', 'assets/images/products/gamma_hover.jpeg', '', 8, 2200, 396, 20768, 'Ready', '24W • 4000K Natural White • Matt Black • 24° Beam', '2024-04-23 18:23:00'),
(3, 2, 4, 'Surface Mount Downlight', 'TL-SMD-03', 'Architectural Indoor', 'assets/images/products/gamma.png', '', 18, 1850, 333, 39294, 'Ready', '15W • 3000K Warm • Matt Black • 36°', '2024-04-20 14:15:00'),
(4, 3, 3, 'Garden & Landscape Light', 'TL-LAND-05', 'Outdoor & Landscape', 'assets/images/products/gamma_hover.jpeg', '', 40, 2800, 504, 132160, 'Ready', 'IP67 • 9W • 3000K • Spike Mount • Dark Graphite', '2024-04-19 11:30:00'),
(5, 3, 5, 'Spotlight Accent Series', 'TL-SPOT-06', 'Outdoor & Landscape', 'assets/images/products/gamma.png', '', 20, 3100, 558, 73160, 'Ready', 'IP65 • 18W • Tree Strapped • 15° Narrow', '2024-04-19 11:30:00'),
(6, 4, 8, 'Architectural Linear Pendant', 'TL-LIN-08', 'Decorative & Acoustic', 'assets/images/products/gamma.png', '', 10, 6500, 1170, 76700, 'Ready', '2400mm • 48W • 4000K • Charcoal Grey Acoustic Felt', '2024-04-04 16:45:00'),
(7, 5, 7, 'Square Recessed Downlight', 'TL-SQ-07', 'Cobspot Light', 'assets/images/products/gamma.png', '', 4, 1600, 288, 7552, 'Ready', '15W • 2700K Warm White • Matt White', '2024-04-02 09:10:00'),
(8, 6, NULL, 'Round Linear Recessed Light', 'TL-RLIN-04', 'Architectural Indoor', 'assets/images/products/gamma.png', '', 30, 3400, 612, 120360, 'Ready', '36W • 3000K • Integrated Emergency Pack', '2024-03-28 15:20:00'),
(9, 7, 2, 'LED Track Light Pro', 'TL-TRACK-02', 'Track Light', 'assets/images/products/gamma_hover.jpeg', '', 16, 2200, 396, 41536, 'Ready', '30W • 3000K • CRI>95 • Honeycomb Louvre', '2024-03-20 12:00:00'),
(10, 8, 5, 'Spotlight Accent Series', 'TL-SPOT-06', 'Outdoor & Landscape', 'assets/images/products/gamma.png', '', 12, 3100, 558, 43896, 'Ready', 'IP65 • 24W • 3000K • Asymmetric 15x45°', '2024-03-12 17:05:00'),
(11, 9, 3, 'Garden & Landscape Light', 'TL-LAND-05', 'Outdoor & Landscape', 'assets/images/products/gamma_hover.jpeg', '', 25, 2800, 504, 82600, 'Ready', 'IP67 • Custom 2200K Super-Warm • Sand Beige', '2024-03-02 10:40:00');

-- ----------------------------------------------------------------------------
-- Seed Data: `enquiry_timeline`
-- ----------------------------------------------------------------------------
INSERT INTO `enquiry_timeline` (`id`, `enquiry_id`, `title`, `description`, `actor`, `icon`, `created_at`) VALUES
(1, 1, 'Enquiry Received', 'Customer submitted enquiry through website product detail page.', 'System', 'solar:inbox-line-broken', '2024-04-23 18:23:00'),
(2, 1, 'Automated Notification Sent', 'Confirmation email dispatched to gail.anderson@matrixbuild.com.', 'System', 'solar:letter-broken', '2024-04-23 18:30:00'),
(3, 1, 'Status: In Review', 'Automated test remark - reviewing lux requirements.', 'Admin', 'solar:clipboard-check-broken', '2026-09-09 08:53:00'),
(4, 1, 'Status: New', 'New enquiry received from website. Initial review needed for DALI driver availability with our technical engineer.', 'Admin', 'solar:inbox-line-broken', '2026-09-09 08:53:00'),
(5, 1, 'Status: In Review', 'Automated test remark - reviewing lux requirements.', 'Admin', 'solar:clipboard-check-broken', '2026-09-09 09:38:00'),
(6, 1, 'Status: New', 'New enquiry received from website. Initial review needed for DALI driver availability with our technical engineer.', 'Admin', 'solar:inbox-line-broken', '2026-09-09 09:38:00'),
(7, 2, 'Enquiry Received', 'Website quote form submitted.', 'System', 'solar:inbox-line-broken', '2024-04-20 14:15:00'),
(8, 2, 'Status Updated: In Review', 'Moved to technical design team for lux calculations.', 'Admin', 'solar:clipboard-check-broken', '2024-04-21 10:00:00'),
(9, 2, 'Status: Quotation Sent', 'Official quotation emailed to customer.', 'Admin', 'solar:letter-opened-broken', '2026-09-09 08:55:00'),
(10, 2, 'Status: Confirmed', 'Customer approved quote and confirmed order.', 'Admin', 'solar:check-circle-broken', '2026-09-09 08:56:00'),
(11, 2, 'Status: Closed', 'Order completely delivered and closed.', 'Admin', 'solar:check-read-broken', '2026-09-09 08:56:00'),
(12, 2, 'Admin Remark Added', 'Order completely delivered and closed.', 'Admin', 'solar:check-read-broken', '2026-09-09 08:56:00'),
(13, 3, 'Enquiry Received', 'Direct RFQ submitted via portal.', 'System', 'solar:inbox-line-broken', '2024-04-19 11:30:00'),
(14, 3, 'Technical Evaluation Complete', 'Selected IP67 drivers and spike units.', 'Admin', 'solar:settings-minimalistic-broken', '2024-04-19 16:00:00'),
(15, 3, 'Quotation Sent', 'Quotation #QT-2024-578 emailed to david.arnold@grandresorts.com', 'Admin', 'solar:letter-opened-broken', '2024-04-20 11:00:00'),
(16, 3, 'Status: Confirmed', 'Customer approved quote and confirmed order.', 'Admin', 'solar:check-circle-broken', '2026-09-09 08:56:00'),
(17, 3, 'Admin Remark Added', 'Customer approved quote and confirmed order.', 'Admin', 'solar:check-circle-broken', '2026-09-09 08:56:00'),
(18, 4, 'Enquiry Received', 'Custom acoustic fixture request submitted.', 'System', 'solar:inbox-line-broken', '2024-04-04 16:45:00'),
(19, 4, 'Quotation Sent', 'Quotation sent with acoustic test certificates.', 'Admin', 'solar:letter-opened-broken', '2024-04-05 14:30:00'),
(20, 4, 'Order Confirmed', 'Client approved quotation and confirmed PO.', 'Admin', 'solar:check-circle-broken', '2024-04-08 11:15:00'),
(21, 5, 'Enquiry Received', 'Sample unit request logged.', 'System', 'solar:inbox-line-broken', '2024-04-02 09:10:00'),
(22, 5, 'Quotation Sent', 'Sample pricing shared with waiver clause.', 'Admin', 'solar:letter-opened-broken', '2024-04-03 11:30:00'),
(23, 5, 'Confirmed & Dispatched', 'Samples shipped via Blue Dart tracking #BD882910.', 'Admin', 'solar:box-broken', '2024-04-05 15:00:00'),
(24, 5, 'Enquiry Closed', 'Samples successfully delivered and approved.', 'Admin', 'solar:check-read-broken', '2024-04-10 10:00:00'),
(25, 6, 'Enquiry Received', 'Mall atrium quote request received.', 'System', 'solar:inbox-line-broken', '2024-03-28 15:20:00'),
(26, 6, 'Quotation Sent', 'Detailed BOQ and emergency driver compliance certificate sent.', 'Admin', 'solar:letter-opened-broken', '2024-03-29 17:00:00'),
(27, 7, 'Enquiry Received', 'Retail track lighting enquiry logged.', 'System', 'solar:inbox-line-broken', '2024-03-20 12:00:00'),
(28, 7, 'Enquiry Closed', 'Goods delivered and inspected at site.', 'Admin', 'solar:check-read-broken', '2024-03-25 16:00:00'),
(29, 8, 'Enquiry Received', 'Facade lighting quote request.', 'System', 'solar:inbox-line-broken', '2024-03-12 17:05:00'),
(30, 8, 'Quotation Sent', 'Quotation #QT-2024-472 sent with beam simulation.', 'Admin', 'solar:letter-opened-broken', '2024-03-14 13:00:00'),
(31, 8, 'Order Confirmed', 'PO received and confirmed.', 'Admin', 'solar:check-circle-broken', '2024-03-18 11:30:00'),
(32, 9, 'Enquiry Received', 'Heritage restoration enquiry submitted.', 'System', 'solar:inbox-line-broken', '2024-03-02 10:40:00'),
(33, 9, 'In Review', 'Custom color temp and finish under review with R&D team.', 'Admin', 'solar:clipboard-check-broken', '2024-03-03 15:15:00');

-- ----------------------------------------------------------------------------
-- Seed Data: `case_studies`
-- ----------------------------------------------------------------------------
INSERT INTO `case_studies` (`id`, `case_study_code`, `title`, `slug`, `client`, `industry`, `location`, `featured_image`, `overview`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'CS-1001', 'Indoor Residential Lighting Collection', 'indoor-lighting-collection', 'The Horizon Villa', 'Residential', 'South Mumbai, Maharashtra', 'assets/images/project/project1.jpeg', 'Elegant architectural lighting solutions designed to create warm, functional and aesthetically pleasing interior spaces. Utilized deep-recessed low-glare COB downlights and warm 2700K ambient cove profiles across expansive living and entertainment zones.', 'active', 'Indoor Residential Lighting Collection | TeknoLite Projects', 'residential lighting, luxury villa lighting, indoor architectural lighting, LED cove lights', 'Explore TeknoLite\'s bespoke residential indoor lighting case study showcasing high CRI recessed fixtures and magnetic track lights.', '2026-08-15 10:30:00', '2026-09-01 14:20:00'),
(2, 'CS-1002', 'Modern Office Lighting Solution', 'modern-office-lighting-solution', 'NexGen Fintech Headquarters', 'Commercial', 'Bandra-Kurla Complex (BKC), Mumbai', 'assets/images/project/project2.jpeg', 'A high-performance commercial lighting solution designed to create comfortable, balanced and functional illumination across a 40,000 sq.ft modern workspace. Integrated continuous linear LED profiles with UGR < 19 anti-glare diffusers to maximize visual comfort and energy efficiency.', 'active', 'Modern Office Lighting Solution | TeknoLite Case Study', 'commercial office lighting, corporate lighting solution, linear LED fixtures, anti glare office lights', 'Explore how TeknoLite delivered an energy-efficient LED lighting solution for a modern commercial workspace using anti-glare linear profiles.', '2026-08-20 11:15:00', '2026-09-02 09:45:00'),
(3, 'CS-1003', 'Decorative LED Fixtures for Hospitality', 'decorative-led-fixtures-hospitality', 'The Grand Pavilion Resort & Spa', 'Hospitality', 'North Goa, India', 'assets/images/project/project3.jpeg', 'Sophisticated architectural and accent lighting tailored for luxury hotel lobbies, fine dining restaurants, and outdoor landscape illumination. Crafted bespoke decorative pendant luminaires and IP67 architectural facade wall-washers to highlight natural stone textures.', 'active', 'Luxury Hospitality Lighting Design | TeknoLite Projects', 'hotel lighting design, hospitality lighting, decorative chandeliers, outdoor facade lighting', 'Discover how TeknoLite elevated hotel ambiance with customized architectural and decorative fixtures at The Grand Pavilion Resort.', '2026-08-28 16:00:00', '2026-09-05 12:10:00'),
(4, 'CS-1004', 'Architectural Retail Gallery Illumination', 'architectural-retail-gallery-illumination', 'Lumina Luxury Boutique', 'Retail', 'Indiranagar, Bengaluru', 'assets/images/project/project11.jpeg', 'High-CRI track and spot lighting system engineered to bring out rich colors and textures of premium designer collections. Features 3-phase magnetic tracks with adjustable beam angles (15°-45°) and 95+ CRI chips for museum-grade color rendering.', 'active', 'Architectural Retail Lighting Solution | TeknoLite Case Study', 'retail store lighting, luxury boutique track lights, high CRI spots, magnetic track lighting', 'Case study of Lumina Luxury Boutique retail lighting using 95+ CRI adjustable magnetic track spots.', '2026-09-03 14:00:00', '2026-09-08 17:30:00');

-- ----------------------------------------------------------------------------
-- Seed Data: `settings`
-- ----------------------------------------------------------------------------
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'meta_title', 'TeknoLite - Architectural Lighting Studio & Fixtures', NOW()),
(2, 'meta_keyword', 'architectural lighting, commercial downlights, track lights, outdoor facade, linear lights', NOW()),
(3, 'store_theme', 'Default', NOW()),
(4, 'layout', 'Default', NOW()),
(5, 'description', 'TeknoLite is a leading architectural lighting manufacturer specializing in high performance LED COB downlights, linear profiles, track spots, and landscape luminaires for luxury projects.', NOW()),
(6, 'store_name', 'TeknoLite Official Store', NOW()),
(7, 'owner_name', 'Gaston Lapierre', NOW()),
(8, 'owner_phone', '9820145892', NOW()),
(9, 'owner_email', 'contact@teknolite.in', NOW()),
(10, 'address', 'Plot No. 42, Marol Industrial Area, Andheri East', NOW()),
(11, 'zipcode', '400059', NOW()),
(12, 'city', 'Mumbai', NOW()),
(13, 'country', 'India', NOW()),
(14, 'localization_country', 'India', NOW()),
(15, 'language', 'English', NOW()),
(16, 'currency', 'Indian Rupee', NOW()),
(17, 'length_class', 'Millimeter', NOW()),
(18, 'weight_class', 'Kilogram', NOW()),
(19, 'category_product_count', 'yes', NOW()),
(20, 'items_per_page', '12', NOW()),
(21, 'allow_reviews', 'yes', NOW()),
(22, 'allow_guest_reviews', 'no', NOW()),
(23, 'min_vouchers', '1', NOW()),
(24, 'max_vouchers', '12', NOW()),
(25, 'prices_with_tax', 'yes', NOW()),
(26, 'default_tax_rate', '18%', NOW()),
(27, 'customers_online', 'yes', NOW()),
(28, 'customers_activity', 'yes', NOW()),
(29, 'customer_searches', 'yes', NOW()),
(30, 'allow_guest_checkout', 'no', NOW()),
(31, 'login_display_price', 'yes', NOW()),
(32, 'max_login_attempts', '1 hour', NOW());

-- ----------------------------------------------------------------------------
-- Seed Data: `blogs`
-- ----------------------------------------------------------------------------
INSERT INTO `blogs` (`id`, `title`, `slug`, `category`, `category_slug`, `author`, `published_date`, `featured_image`, `short_description`, `content`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Architectural Lighting Trends for Modern Commercial Spaces', 'architectural-lighting-trends-for-modern-commercial-spaces', 'Lighting Insights', 'lighting-insights', 'TeknoLite Team', '2026-09-15', 'assets/images/blog/blog-details.jpg', 'Discover how glare control, micro-optics, and linear pendant illumination are transforming modern corporate workspaces.', '<p>Architectural lighting design in 2026 demands a harmonious blend of human-centric visual comfort, energy performance, and sleek aesthetic integration. As modern corporate campuses move toward open-plan design with floor-to-ceiling glass and exposed ceiling slabs, lighting fixtures must deliver targeted optical distribution without introducing visual discomfort or glare.</p><h3>1. Deep Recessed Anti-Glare Optics (UGR &lt; 16)</h3><p>Visual fatigue in office environments is frequently linked to harsh overhead glare from poorly shielded downlights. Modern COB spotlights and downlights now feature deep optical chambers with faceted specular reflectors, ensuring high lumens on work surfaces while obscuring the LED light source from standard line-of-sight angles.</p><h3>2. Seamless Continuous Linear Profiles</h3><p>Linear LED profiles with dual direct/indirect emission have become the gold standard for open office ceilings. Direct illumination provides task illumination for workstations, while indirect upward output bounces off ceiling surfaces to soften contrast and eliminate shadowy ceilings.</p><h3>3. Flexible 48V Magnetic Track Systems</h3><p>Retail showrooms and dynamic hospitality spaces benefit immensely from modular low-voltage magnetic track lighting. Designers can reconfigure spotlights, wall washers, and diffuse linear modules tool-free as interior layouts evolve.</p>', 125, 'active', 'Architectural Lighting Trends 2026 | TeknoLite Blog', 'architectural lighting, commercial lighting trends, anti glare led, linear lighting', 'Explore modern commercial lighting trends including glare control, linear profiles, and 48V magnetic tracks.', '2026-09-15 10:00:00', '2026-09-15 10:00:00'),
(2, 'Mastering UGR & Anti-Glare Optics in Office Downlights', 'mastering-ugr-anti-glare-optics-in-office-downlights', 'Technical Guides', 'technical-guides', 'TeknoLite Engineering', '2026-09-20', 'assets/images/blog/blog-details.jpg', 'A technical guide on Unified Glare Rating (UGR), reflector cut-off angles, and glare control for workplace lighting design.', '<p>Unified Glare Rating (UGR) is an international metric defined by the CIE to evaluate psychological glare produced by luminaires in indoor environments. Achieving a UGR rating of below 19 is mandatory for office workstation compliance, while luxury spaces often target UGR &lt; 13.</p><h3>Key Factors Influencing UGR:</h3><ul><li><strong>Optic Recess Depth:</strong> Positioning the LED COB deeper inside the fixture aluminum housing reduces direct line-of-sight exposure.</li><li><strong>Reflector Geometry:</strong> Faceted secondary baffles absorb stray light spill and create precise beam cut-offs.</li><li><strong>Micro-Prismatic Diffusers:</strong> Engineered acrylic diffusers refract direct rays evenly across the aperture surface.</li></ul><p>TeknoLite downlight ranges incorporate these advanced optical technologies to achieve exceptional visual comfort in high-end commercial installations.</p>', 98, 'active', 'Mastering UGR & Anti-Glare Optics | TeknoLite Technical Guide', 'UGR rating, anti-glare downlights, office lighting standards, glare control', 'Learn how Unified Glare Rating (UGR) and deep-set optics improve visual comfort in professional workspaces.', '2026-09-20 11:30:00', '2026-09-20 11:30:00'),
(3, 'How Outdoor IP65 Spike Lights Enhance Facade & Landscape Design', 'how-outdoor-ip65-spike-lights-enhance-facade-landscape-design', 'Landscape Lighting', 'landscape-lighting', 'TeknoLite Design Studio', '2026-09-28', 'assets/images/blog/blog-details.jpg', 'Learn key techniques for grazing textures, accentuating trees, and illuminating outdoor pathways safely with IP65 LED spotlights.', '<p>Exterior landscape lighting extends living spaces outdoors and adds dramatic nighttime curb appeal to residential villas, resorts, and corporate grounds. Utilizing weatherproof IP65 luminaires ensures long-term reliability against monsoon rains, dust infiltration, and ambient temperature fluctuations.</p><h3>Best Practices for Landscape Lighting:</h3><p>1. <strong>Tree Grazing:</strong> Position ground spikes 30-50cm from the tree trunk, angling the beam upward to highlight branch structure and foliage.</p><p>2. <strong>Facade Wall Washing:</strong> Asymmetric wall washers positioned along building foundations create uniform illumination across stone finishes without harsh shadows.</p><p>3. <strong>Safe Low-Voltage Distribution:</strong> Deploying 24V DC extra-low-voltage spike lights along garden footpaths ensures absolute electrical safety in wet outdoor environments.</p>', 74, 'active', 'Outdoor IP65 Landscape Lighting Guide | TeknoLite', 'ip65 garden lights, landscape spotlights, outdoor lighting design, spike lights', 'Discover best practices for outdoor landscape and facade lighting using IP65 weatherproof fixtures.', '2026-09-28 14:00:00', '2026-09-28 14:00:00');

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================================
-- End of Database Seed Script
-- ============================================================================