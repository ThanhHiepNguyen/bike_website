<?php
require_once 'db_connect.php';
$site_name = "BikeGo";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <title><?php echo $site_name . (isset($page_title) ? " - $page_title" : ""); ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">

        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/logo.png" alt="BikeGo" style="height: 50px; object-fit: contain;">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="stations.php">Trạm Xe</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Liên Hệ</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Hồ Sơ</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Đăng Xuất</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Đăng Nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Đăng Ký</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>