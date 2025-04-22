<?php
require_once 'db_connect.php';
$site_name = "BikeGo";

$baseDir = '/bike_website';
// Define paths as variables  
$loginPath = $baseDir . '/login.php';
$errorPath = $baseDir . '/errors/403.php';
$homePath = $baseDir . '/index.php';
$stationsPath = $baseDir . '/stations.php';
$contactPath = $baseDir . '/contact.php';
$profilePath = $baseDir . '/profile.php';
$logoutPath = $baseDir . '/logout.php';
$registerPath = $baseDir . '/register.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_name . (isset($page_title) ? " - $page_title" : ""); ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #20c997;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            padding-top: 76px;
            /* Height of navbar */
        }

        /* Navbar Styles */
        .navbar {
            padding: 0.5rem 0;
            background: linear-gradient(90deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.3rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand img {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        /* Navigation Links */
        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            padding: 0.8rem 1.2rem !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Dropdown Styles */
        .navbar .dropdown-menu {
            margin-top: 1rem;
            border: none;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            animation: dropdownFadeIn 0.3s ease;
            overflow: hidden;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar .dropdown-item {
            padding: 0.8rem 1.5rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .navbar .dropdown-item:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(8px);
        }

        .navbar .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
        }

        .user-name {
            font-weight: 500;
            color: var(--dark-color);
        }

        /* Button Styles */
        .btn-login,
        .btn-register {
            padding: 0.5rem 1.5rem !important;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color) !important;
        }

        .btn-login:hover {
            background: var(--primary-color);
            color: white !important;
        }

        .btn-register {
            background: var(--primary-color);
            color: white !important;
            margin-left: 10px;
        }

        .btn-register:hover {
            background: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Mobile Menu */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 10px;
                margin-top: 1rem;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .nav-link::after {
                display: none;
            }

            .btn-login,
            .btn-register {
                margin: 0.5rem 0;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $homePath; ?>">
                <img src="/bike_website/assets/images/logo.png" alt="BikeGo" style="height: 50px; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="<?php echo $homePath; ?>">
                            <i class="fas fa-home me-1"></i>Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'stations.php' ? 'active' : ''; ?>" href="<?php echo $stationsPath; ?>">
                            <i class="fas fa-bicycle me-1"></i>Trạm Xe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="<?php echo $contactPath; ?>">
                            <i class="fas fa-envelope me-1"></i>Liên Hệ
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-profile" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo "https://ui-avatars.com/api/?name=" . urlencode($_SESSION['username']) . "&background=28a745&color=fff&size=64"; ?>" alt="User" class="user-avatar">
                                <span class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?php echo $profilePath; ?>">
                                        <i class="fas fa-user"></i>Hồ Sơ
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-history"></i>Lịch Sử Đặt Xe
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-heart"></i>Xe Yêu Thích
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?php echo $logoutPath; ?>">
                                        <i class="fas fa-sign-out-alt"></i>Đăng Xuất
                                    </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn-login" href="<?php echo $loginPath; ?>">Đăng Nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-register" href="<?php echo $registerPath; ?>">Đăng Ký</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- JavaScript for navbar scroll effect -->
    <script>
        // Add scrolled class to navbar on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>