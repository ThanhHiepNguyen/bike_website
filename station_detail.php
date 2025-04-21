<?php
require_once 'includes/header.php';
require_once 'includes/db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$station_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($station_id <= 0) {
    echo "<div class='alert alert-danger'>ID trạm không hợp lệ</div>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM stations WHERE id = ?");
$stmt->execute([$station_id]);
$station = $stmt->fetch();

if (!$station) {
    echo "<div class='alert alert-warning'>Không tìm thấy trạm xe</div>";
    exit;
}

$bike_stmt = $pdo->query("SELECT * FROM bike_templates");
$all_bikes = $bike_stmt->fetchAll(PDO::FETCH_ASSOC);

$bike = array_filter($all_bikes, fn($b) => $b['bike_type'] === 'bike');
$ebike = array_filter($all_bikes, fn($b) => $b['bike_type'] === 'ebike');

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách xe tại <?= htmlspecialchars($station['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-toggle {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .btn-toggle.active {
            background-color: #0d6efd;
            color: white;
        }

        .bike-list {
            display: none;
        }

        .bike-list.active {
            display: block;
        }

        .bike-img {
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <h3 class="mb-4 text-primary">🚲 Danh sách xe tại <?= htmlspecialchars($station['name']) ?></h3>

        <div class="d-flex justify-content-center gap-2 mb-4">
            <button class="btn btn-toggle active" onclick="showTab('bike')">Xe đạp cơ</button>
            <button class="btn btn-toggle" onclick="showTab('ebike')">Xe đạp điện</button>
        </div>

        <div id="bike" class="bike-list active">
            <?php if (count($bike) > 0): ?>
                <div class="row">
                    <?php foreach ($bike as $b): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <?php if (!empty($b['image'])): ?>
                                        <img src="assets/images/bikes/<?= htmlspecialchars($b['image']) ?>" class="img-fluid bike-img" alt="Xe <?= $b['id'] ?>">
                                    <?php endif; ?>
                                    <h5 class="card-title">🚲 Xe đạp thường</h5>
                                    <p>Trạng thái: <?= $b['status'] ?></p>
                                    <button class="btn btn-outline-primary w-100" onclick="showPricingModal()">Bảng giá thuê</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Không có xe đạp cơ tại trạm này.</p>
            <?php endif; ?>
        </div>

        <div id="ebike" class="bike-list">
            <?php if (count($ebike) > 0): ?>
                <div class="row">
                    <?php foreach ($ebike as $b): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <?php if (!empty($b['image'])): ?>
                                        <img src="assets/images/bikes/<?= htmlspecialchars($b['image']) ?>" class="img-fluid bike-img" alt="Xe <?= $b['id'] ?>">
                                    <?php endif; ?>
                                    <h5 class="card-title">⚡ Xe đạp điện</h5>
                                    <p>Trạng thái: <?= $b['status'] ?></p>
                                    <button class="btn btn-outline-primary w-100" onclick="showPricingModal()">Bảng giá thuê</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Không có xe đạp điện tại trạm này.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Bảng giá -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">📋 Bảng giá thuê xe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="text-primary fw-bold">Vé lượt</h5>
                                    <p><strong>10.000</strong> điểm/lượt</p>
                                    <p>🕒 Thời lượng: 60 phút</p>
                                    <p>⏳ Hạn dùng: 60 phút</p>
                                    <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-success">
                                <div class="card-body">
                                    <h5 class="text-success fw-bold">Vé ngày</h5>
                                    <p><strong>50.000</strong> điểm/ngày</p>
                                    <p>🕒 Thời lượng: 450 phút</p>
                                    <p>⏳ Hạn dùng: 24h</p>
                                    <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-warning">
                                <div class="card-body">
                                    <h5 class="text-warning fw-bold">Vé tháng</h5>
                                    <p><strong>79.000</strong> điểm/tháng</p>
                                    <p>🕒 Miễn phí tất cả chuyến < 45 phút</p>
                                            <p>⏳ Hạn dùng: 30 ngày</p>
                                            <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(type) {
            document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.bike-list').forEach(div => div.classList.remove('active'));
            document.getElementById(type).classList.add('active');
            event.target.classList.add('active');
        }

        function showPricingModal() {
            const modal = new bootstrap.Modal(document.getElementById('pricingModal'));
            modal.show();
        }
    </script>

    <?php require_once 'includes/footer.php'; ?>
</body>

</html>