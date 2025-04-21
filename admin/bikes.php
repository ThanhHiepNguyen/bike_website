<?php
require_once '../includes/db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$bikes = $pdo->query("SELECT bikes.*, stations.name AS station_name FROM bikes JOIN stations ON bikes.station_id = stations.id")->fetchAll(PDO::FETCH_ASSOC);
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <h3>Quản lý danh sách xe</h3>
    <a href="index.php" class="btn btn-secondary btn-sm mb-3">← Quay về Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Loại xe</th><th>Trạm</th><th>Trạng thái</th><th>QR</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($bikes as $bike): ?>
            <tr>
                <td><?= $bike['id'] ?></td>
                <td><?= $bike['bike_type'] ?></td>
                <td><?= $bike['station_name'] ?></td>
                <td><?= $bike['status'] ?></td>
                <td><?= $bike['qr_code'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
