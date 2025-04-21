<?php
require_once 'includes/db_connect.php';
$page_title = "Hồ Sơ";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT username, email, full_name, phone FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare("UPDATE users SET full_name = ?, phone = ? WHERE id = ?");
    if ($stmt->execute([$full_name, $phone, $_SESSION['user_id']])) {
        $success = "Cập nhật hồ sơ thành công!";
        $user['full_name'] = $full_name;
        $user['phone'] = $phone;
    } else {
        $error = "Cập nhật thất bại, thử lại sau!";
    }
}
require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Hồ Sơ Người Dùng</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Người Dùng</label>
                        <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cập Nhật</button>
                </form>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success mt-3"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>