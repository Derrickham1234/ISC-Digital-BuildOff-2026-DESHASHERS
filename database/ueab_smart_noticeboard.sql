-- ==========================================
-- UEAB SMART NOTICEBOARD
-- Clean Database Setup
-- ==========================================

CREATE DATABASE IF NOT EXISTS ueab_smart_noticeboard
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE ueab_smart_noticeboard;

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- CATEGORIES TABLE
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- NOTICES TABLE
CREATE TABLE IF NOT EXISTS notices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    category_id INT NOT NULL,
    created_by INT NOT NULL,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id)
        REFERENCES categories(id),

    FOREIGN KEY (created_by)
        REFERENCES users(id)
) ENGINE=InnoDB;

-- DEFAULT NOTICE CATEGORIES
INSERT IGNORE INTO categories (category_name) VALUES
('Academic'),
('Examinations'),
('Events'),
('Announcements'),
('Administration');

-- END OF DATABASE SETUP