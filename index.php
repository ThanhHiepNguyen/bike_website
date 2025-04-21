<?php
require_once 'includes/header.php';
$page_title = "Trang Chủ";
?>

<section class="hero bg-success text-white text-center py-5 animate__animated animate__fadeIn">
    <div class="container">
        <h1 class="display-4">Di Chuyển Xanh Với BikeGo</h1>
        <p class="lead">Thuê xe đạp dễ dàng, thân thiện môi trường, mọi lúc mọi nơi!</p>
        <a href="stations.php" class="btn btn-light btn-lg">Tìm Trạm Xe</a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Tại Sao Chọn BikeGo?</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="bi bi-bicycle display-4 text-success"></i>
                <h3>Tiện Lợi</h3>
                <p>Thuê xe chỉ với vài thao tác trên ứng dụng.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-tree display-4 text-success"></i>
                <h3>Thân Thiện Môi Trường</h3>
                <p>Góp phần giảm khí thải, bảo vệ hành tinh.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-wallet display-4 text-success"></i>
                <h3>Tiết Kiệm</h3>
                <p>Chi phí thấp, phù hợp mọi đối tượng.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>