<?php
require_once 'includes/db_connect.php';
$page_title = "Đăng Nhập";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Email hoặc mật khẩu không đúng!";
    }
}
require_once 'includes/header.php';
?>


<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Đăng Nhập</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="needs-validation" novalidate>
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
                    <button type="submit" class="btn btn-success w-100">Đăng Nhập</button>
                </form>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success mt-3"><?php echo htmlspecialchars($_GET['success']); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>