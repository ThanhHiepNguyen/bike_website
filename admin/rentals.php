<?php

require_once '../includes/db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$rentals = $pdo->query("SELECT rentals.*, users.username, bikes.bike_type FROM rentals 
    JOIN users ON rentals.user_id = users.id
    JOIN bikes ON rentals.bike_id = bikes.id
    ORDER BY rentals.start_time DESC")->fetchAll(PDO::FETCH_ASSOC);

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <h3>Danh sách lượt thuê</h3>
    <a href="index.php" class="btn btn-secondary btn-sm mb-3">← Quay về Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Người thuê</th><th>Loại xe</th><th>Bắt đầu</th><th>Kết thúc</th><th>Phí</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rentals as $rental): ?>
            <tr>
                <td><?= $rental['id'] ?></td>
                <td><?= $rental['username'] ?></td>
                <td><?= $rental['bike_type'] ?></td>
                <td><?= $rental['start_time'] ?></td>
                <td><?= $rental['end_time'] ?? '---' ?></td>
                <td><?= $rental['total_price'] ? $rental['total_price'] . ' đ' : '---' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
