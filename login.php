<?php
require_once 'includes/db_connect.php';
$page_title = "Đăng Nhập";

$userDataForJS = null;

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
    
        // Store minimal user data for JavaScript
        $userDataForJS = json_encode([
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ]);
    
        // Set a flag instead of immediate redirect
        $_SESSION['login_success'] = true;
        $_SESSION['redirect_after_login'] = $user['role'] === 'admin' ? 'admin/index.php' : 'index.php';
    } else {
        $error = "Email hoặc mật khẩu không đúng!";
    }
}
require_once 'includes/header.php';
?>

<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #f8f9fa 100%);
    }
    
    .login-card {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        padding: 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        animation: fadeInUp 0.6s ease-out;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    
    .login-header p {
        color: #666;
        font-size: 16px;
    }
    
    .form-floating {
        margin-bottom: 20px;
    }
    
    .form-floating > .form-control {
        padding: 1rem 0.75rem;
        height: 3.5rem;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-floating > .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.1);
    }
    
    .btn-login {
        height: 50px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        background: #28a745;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-login:hover {
        background: #218838;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
    }
    
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 25px 0;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #dee2e6;
    }
    
    .divider span {
        padding: 0 15px;
        color: #6c757d;
        font-size: 14px;
    }
    
    .social-login {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .social-login .btn {
        flex: 1;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .text-footer {
        text-align: center;
        margin-top: 20px;
    }
    
    .text-footer a {
        color: #28a745;
        text-decoration: none;
        font-weight: 500;
    }
    
    .text-footer a:hover {
        text-decoration: underline;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    // Store user data and handle redirect after localStorage save
    <?php if (isset($_SESSION['login_success']) && $userDataForJS): ?>
        const userData = <?php echo $userDataForJS; ?>;
        if (userData) {
            // Store minimal user data
            localStorage.setItem('userData', JSON.stringify(userData));
            console.log('Login successful!');
            
            // Redirect after localStorage operation
            <?php 
                $redirectPath = $_SESSION['redirect_after_login'] ?? 'index.php';
                unset($_SESSION['login_success']);
                unset($_SESSION['redirect_after_login']);
            ?>
            window.location.href = '<?php echo $redirectPath; ?>';
        }
    <?php endif; ?>
</script>

<div class="login-container">
    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <h2>Đăng Nhập</h2>
                <p>Chào mừng bạn đến với BikeGo</p>
            </div>
            
            <?php if (!isset($_SESSION['login_success'])): ?>
            <form method="post" class="needs-validation" novalidate>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email của bạn</label>
                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Mật khẩu</label>
                    <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <a href="forgot-password.php" class="text-success">Quên mật khẩu?</a>
                </div>
                
                <button type="submit" class="btn btn-success btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng Nhập
                </button>
                
                <div class="divider">
                    <span>Hoặc đăng nhập với</span>
                </div>
                
                <div class="social-login">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-google"></i> Google
                    </button>
                    <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-facebook"></i> Facebook
                    </button>
                </div>
            </form>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo htmlspecialchars($_GET['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="text-footer">
                <p class="mb-0">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php require_once 'includes/footer.php'; ?>