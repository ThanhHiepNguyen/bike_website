<?php
require_once '../includes/db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <h3>Quản lý người dùng</h3>
    <a href="index.php" class="btn btn-secondary btn-sm mb-3">← Quay về Dashboard</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th><th>Username</th><th>Email</th><th>Vai trò</th><th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
