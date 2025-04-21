<?php
require_once 'includes/db_connect.php';
$page_title = "Đăng Ký";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Mật khẩu không khớp!";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email đã được sử dụng!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
            if ($stmt->execute([$username, $email, $password_hash])) {

                header("Location: login.php?success=Đăng ký thành công!");
                exit;
            } else {
                $error = "Đăng ký thất bại, thử lại sau!";
            }
        }
    }
}
require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Đăng Ký Tài Khoản</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Người Dùng</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <div class="invalid-feedback">Vui lòng xác nhận mật khẩu.</div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Đăng Ký</button>
                </form>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>