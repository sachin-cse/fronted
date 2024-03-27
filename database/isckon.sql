
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
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP
);