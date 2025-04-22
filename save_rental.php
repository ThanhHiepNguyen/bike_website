<?php
// save_rental.php

require_once 'includes/db_connect.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$bike_template_id = $_POST['bike_template_id'] ?? null;
$plan = $_POST['plan'] ?? '';
$price = $_POST['price'] ?? '';

if (!$bike_template_id || !$plan || !$price) {
    echo json_encode(['success' => false, 'message' => 'Thiếu thông tin để lưu.']);
    exit;
}

$start_time = date('Y-m-d H:i:s');
$end_time = null; // Nếu bạn muốn có thời gian kết thúc ngay lập tức, có thể đặt ở đây.
$total_price = floatval($price);

try {
    $stmt = $pdo->prepare("INSERT INTO rentals (user_id, bike_template_id, start_time, end_time, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $bike_template_id, $start_time, $end_time, $total_price]);

    echo json_encode(['success' => true, 'message' => 'Đã lưu lịch sử thuê xe!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Lỗi CSDL: ' . $e->getMessage()]);
}
