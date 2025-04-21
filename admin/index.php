<?php
require_once '../includes/db_connect.php';
session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../includes/header.php';
?>

<div class="container mt-5">
    <h2>Chào mừng Admin</h2>
    <p>Chọn một chức năng quản lý:</p>
    <ul>
        <li><a href="bikes.php">Quản lý xe</a></li>
        <li><a href="users.php">Quản lý người dùng</a></li>
        <li><a href="rentals.php">Lượt thuê</a></li>
    </ul>
</div>

<?php require_once '../includes/footer.php'; ?>
