-- Tạo database
CREATE DATABASE IF NOT EXISTS bike_sharing;
USE bike_sharing;

-- Bảng người dùng
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng trạm xe
CREATE TABLE IF NOT EXISTS stations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    latitude DECIMAL(9,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL,
    bike_count INT NOT NULL DEFAULT 0
);

-- Bảng liên hệ
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng mẫu xe dùng chung cho tất cả trạm
CREATE TABLE IF NOT EXISTS bike_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bike_type ENUM('bike', 'ebike') NOT NULL,
    image VARCHAR(255),
    status ENUM('available', 'rented', 'maintenance') DEFAULT 'available'
);

-- Bảng lịch sử thuê xe
CREATE TABLE IF NOT EXISTS rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    bike_template_id INT,
    start_time DATETIME,
    end_time DATETIME,
    total_price DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (bike_template_id) REFERENCES bike_templates(id)
);

-- Dữ liệu mẫu trạm xe
INSERT INTO stations (name, address, latitude, longitude, bike_count) VALUES
('Trạm Hà Nội 1', 'Tây Hồ, Hà Nội', 21.0721, 105.8181, 40),
('Trạm Hà Nội 2', 'Ba Đình, Hà Nội', 21.0355, 105.834, 40),
('Trạm Hà Nội 3', 'Đống Đa, Hà Nội', 21.0275, 105.8325, 40),
('Trạm Hà Nội 4', 'Cầu Giấy, Hà Nội', 21.0362, 105.7814, 40),
('Trạm Hà Nội 5', 'Thanh Xuân, Hà Nội', 20.993, 105.8, 40),
('Trạm Hà Nội 6', 'Long Biên, Hà Nội', 21.0526, 105.8915, 40),
('Trạm Hà Nội 7', 'Hà Đông, Hà Nội', 20.9732, 105.777, 40),
('Trạm Hà Nội 8', 'Nam Từ Liêm, Hà Nội', 21.014, 105.7654, 40),
('Trạm Hà Nội 9', 'Bắc Từ Liêm, Hà Nội', 21.0601, 105.7491, 40),
('Trạm Hà Nội 10', 'Hoàng Mai, Hà Nội', 20.982, 105.8711, 40),
('Trạm Quận 1', 'Quận 1, TP.HCM', 10.7769, 106.7009, 40),
('Trạm Sài Gòn 4', 'Quận 11, TP.HCM', 10.751725, 106.689741, 40),
('Trạm Sài Gòn 5', 'Quận 10, TP.HCM', 10.756853, 106.673072, 40),
('Trạm Sài Gòn 6', 'Quận 10, TP.HCM', 10.786107, 106.697813, 40),
('Trạm Sài Gòn 7', 'Quận 7, TP.HCM', 10.769422, 106.696569, 40),
('Trạm Sài Gòn 8', 'Quận 4, TP.HCM', 10.778244, 106.704642, 40),
('Trạm Sài Gòn 9', 'Quận 7, TP.HCM', 10.765906, 106.698592, 40),
('Trạm Sài Gòn 10', 'Quận 7, TP.HCM', 10.778703, 106.67368, 40),
('Trạm Sài Gòn 11', 'Quận 1, TP.HCM', 10.789229, 106.695564, 40),
('Trạm Sài Gòn 12', 'Quận 10, TP.HCM', 10.771732, 106.679491, 40),
('Trạm Sài Gòn 13', 'Quận 7, TP.HCM', 10.787799, 106.684645, 40),
('Trạm Sài Gòn 14', 'Quận 4, TP.HCM', 10.786334, 106.682605, 40),
('Trạm Sài Gòn 15', 'Quận 10, TP.HCM', 10.755442, 106.700894, 40),
('Trạm Sài Gòn 16', 'Quận 10, TP.HCM', 10.782046, 106.70764, 40),
('Trạm Sài Gòn 17', 'Quận 5, TP.HCM', 10.783183, 106.671855, 40),
('Trạm Sài Gòn 18', 'Quận 10, TP.HCM', 10.761171, 106.706863, 40),
('Trạm Sài Gòn 19', 'Quận 3, TP.HCM', 10.765172, 106.696943, 40),
('Trạm Sài Gòn 20', 'Quận 4, TP.HCM', 10.76322, 106.675006, 40),
('Trạm Sài Gòn 21', 'Quận 3, TP.HCM', 10.751052, 106.708078, 40),
('Trạm Sài Gòn 22', 'Quận 10, TP.HCM', 10.759366, 106.707098, 40),
('Trạm Sài Gòn 23', 'Quận 1, TP.HCM', 10.775995, 106.681632, 40);

-- Mẫu ảnh xe dùng chung
INSERT INTO bike_templates (bike_type, image) VALUES
-- 20 xe đạp thường
('bike', 'Bike_1.jpg'), ('bike', 'Bike_2.jpg'), ('bike', 'Bike_3.jpg'),
('bike', 'Bike_4.jpg'), ('bike', 'Bike_5.jpg'), ('bike', 'Bike_6.jpg'),
('bike', 'Bike_7.jpg'), ('bike', 'Bike_8.jpg'), ('bike', 'Bike_9.jpg'),
('bike', 'Bike_10.jpg'), ('bike', 'Bike_11.jpg'), ('bike', 'Bike_12.jpg'),
('bike', 'Bike_13.jpg'), ('bike', 'Bike_14.jpg'), ('bike', 'Bike_15.jpg'),
('bike', 'Bike_16.jpg'), ('bike', 'Bike_17.jpg'), ('bike', 'Bike_18.jpg'),
('bike', 'Bike_19.jpg'), ('bike', 'Bike_20.jpg');
-- 20 xe đạp điện
INSERT INTO bike_templates (bike_type, image) VALUES
('ebike', 'Ebike_1.jpg'),
('ebike', 'Ebike_2.jpg'),
('ebike', 'Ebike_3.jpg'),
('ebike', 'Ebike_4.jpg'),
('ebike', 'Ebike_5.jpg'),
('ebike', 'Ebike_6.jpg'),
('ebike', 'Ebike_7.jpg'),
('ebike', 'Ebike_8.jpg'),
('ebike', 'Ebike_9.jpg'),
('ebike', 'Ebike_10.jpg'),
('ebike', 'Ebike_11.jpg'),
('ebike', 'Ebike_12.jpg'),
('ebike', 'Ebike_13.jpg'),
('ebike', 'Ebike_14.jpg'),
('ebike', 'Ebike_15.jpg'),
('ebike', 'Ebike_16.jpg'),
('ebike', 'Ebike_17.jpg'),
('ebike', 'Ebike_18.jpg'),
('ebike', 'Ebike_19.jpg'),
('ebike', 'Ebike_20.jpg');
-- Admin mẫu
INSERT INTO users (username, email, password, full_name, phone, role) VALUES
('admin', 'admin@bike.vn', '$2y$10$vQ3AO3XoRwzMgyLaBn03..3QeAaIXybR7U7cNnKDvCS27/Ft4fJHy', 'Quản trị viên', '0123456789', 'admin');