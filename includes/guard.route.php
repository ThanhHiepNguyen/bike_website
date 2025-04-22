<?php
// guard.route.php

// Kiểm tra xem session đã được start chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function guardRoute($requiredRole = null) {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user_id'])) {
        // Lưu URL hiện tại để redirect sau khi đăng nhập
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        
        // Redirect đến trang đăng nhập
        header('Location: /bike_website/login.php');
        exit();
    }
    
    // Nếu có yêu cầu role cụ thể
    if ($requiredRole && (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole)) {
        // Nếu không có quyền, redirect về trang chủ
        header('Location: /bike_website/index.php');
        exit();
    }
}

// Hàm kiểm tra xem người dùng có phải là admin không
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Hàm kiểm tra xem người dùng đã đăng nhập chưa
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}