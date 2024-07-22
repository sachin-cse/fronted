
-- CREATED BY - SACHIN MANDAL
---CREATED - 11/07/2024


-- register tables for user
CREATE TABLE IF NOT EXISTS `register`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- login table

CREATE TABLE IF NOT EXISTS `login`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- contact table
CREATE TABLE IF NOT EXISTS `contact`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    send_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Resource table
CREATE TABLE IF NOT EXISTS `resources`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    audio VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);

-- admin table
CREATE TABLE IF NOT EXISTS `adminsignin`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);

-- alter command in admin signin
ALTER TABLE `adminsignin`
ADD COLUMN `role` ENUM('admin', 'subadmin') DEFAULT 'admin' AFTER `email`;


ALTER TABLE `adminsignin`
ADD COLUMN `profile_image` VARCHAR(255) DEFAULT null AFTER `role`;

ALTER TABLE `adminsignin`
ADD COLUMN `status` ENUM('active', 'inactive') DEFAULT 'active' AFTER `profile_image`;

ALTER TABLE `adminsignin`
ADD COLUMN `last_login` DATETIME DEFAULT NULL AFTER `status`;
-- insert query for admin signin--
insert into `adminsignin`(null, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- end adminsign in query ----

--- setings part query ---

-- general settings create table query ---
CREATE TABLE IF NOT EXISTS `general_settings`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `site_meta_title` VARCHAR(255) NOT NULL,
    `site_meta_description` TEXT DEFAULT NULL,
    `site_og_image` VARCHAR(255) NOT NULL,
    `site_meta_keywords` VARCHAR(255) DEFAULT NULL,
    `site_meta_robots` VARCHAR(255) DEFAULT NULL,
    `site_script_title` VARCHAR(255) DEFAULT NULL,
    `site_script_description` TEXT DEFAULT NULL,
    `create_user` INT(11) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);

---social settings create table query---
CREATE TABLE IF NOT EXISTS `social_settings`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `social_links` TEXT DEFAULT NULL,
    `create_user` INT(11) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);

---site settings create table query---
CREATE TABLE IF NOT EXISTS `site_settings`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `site_title` VARCHAR(255) NOT NULL,
    `site_description` TEXT DEFAULT NULL,
    `site_logo` VARCHAR(255) NOT NULL,
    `site_favicon` VARCHAR(255) DEFAULT NULL,
    `site_smtp_driver` VARCHAR(255) DEFAULT NULL,
    `site_smtp_host` VARCHAR(255) DEFAULT NULL,
    `site_smtp_port` VARCHAR(10) DEFAULT NULL,
    `site_smtp_username` VARCHAR(40) DEFAULT NULL,
    `site_smtp_password` VARCHAR(100) DEFAULT NULL,
    `site_smtp_encryption` VARCHAR(10) DEFAULT NULL,
    `site_footer_links` TEXT DEFAULT NULL,
    `site_footer_email` VARCHAR(255) DEFAULT NULL,
    `site_footer_description` TEXT DEFAULT NULL,
    `site_footer_phone_number` VARCHAR(20) DEFAULT NULL,
    `create_user` INT(11) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);

-- settings part query end---

-- pages query
CREATE TABLE IF NOT EXISTS `pages`(
    `page_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `page_name` VARCHAR(255) NOT NULL,
    `page_slug` VARCHAR(255) NOT NULL,
    `page_title` VARCHAR(255) NOT NULL,
    `page_status` VARCHAR(20) NOT NULL,
    `page_description` VARCHAR(255) NOT NULL,
    `page_feature_image` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- pages seo query
CREATE TABLE IF NOT EXISTS `page_seo`(
    `seo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `page_id` INT(11) NOT NULL,
    `meta_title` VARCHAR(255) NOT NULL,
    `meta_keyword` VARCHAR(255) NOT NULL,
    `meta_description` VARCHAR(20) NOT NULL,
    `meta_robots` VARCHAR(255) NOT NULL,
    `og_feature_image` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- relation between page and page seo table
ALTER TABLE `page_seo`
ADD FOREIGN KEY (`page_id`) REFERENCES pages(`page_id`);

-- resources table
CREATE TABLE IF NOT EXISTS `resources`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `media_type` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `file_link` VARCHAR(255) NOT NULL,
    `created_by` INT(11) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    `updated_at` TIMESTAMP DEFAULT NON UPDATE CURRENT_TIMESTAMP
);



