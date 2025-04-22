<?php
require_once 'includes/header.php';
require_once 'includes/db_connect.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-danger'>Bạn cần đăng nhập để xem lịch sử thuê xe.</div>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Truy vấn lịch sử thuê xe
$stmt = $pdo->prepare("
    SELECT r.*, b.bike_type, b.image
    FROM rentals r
    JOIN bike_templates b ON r.bike_template_id = b.id
    WHERE r.user_id = ?
    ORDER BY r.start_time DESC
");
$stmt->execute([$user_id]);
$history = $stmt->fetchAll();
?>

<div class="container py-4">
    <h3 class="text-primary mb-4">🕘 Lịch sử thuê xe của bạn</h3>

    <?php if (count($history) === 0): ?>
        <div class="alert alert-info">Bạn chưa thuê xe nào.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Loại xe</th>
                        <th>Ảnh xe</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $index => $r): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $r['bike_type'] === 'bike' ? 'Xe đạp' : 'Xe đạp điện' ?></td>
                            <td><img src="assets/images/bikes/<?= htmlspecialchars($r['image']) ?>" width="80"></td>
                            <td><?= $r['start_time'] ?></td>
                            <td><?= $r['end_time'] ?></td>
                            <td><?= number_format($r['total_price']) ?> VNĐ</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?php require_once 'includes/footer.php'; ?>