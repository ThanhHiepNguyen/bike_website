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
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
            if ($stmt->execute([$username, $email, $password_hash])) {
                header("Location: login.php?success=" . urlencode("Đăng ký thành công!"));
                exit;
            } else {
                $error = "Đăng ký thất bại, thử lại sau!";
            }
        }
    }
}
require_once 'includes/header.php';
?>

<style>
    .register-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #f8f9fa 100%);
    }
    
    .register-card {
        max-width: 450px;
        width: 100%;
        margin: 0 auto;
        padding: 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        animation: fadeInUp 0.6s ease-out;
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .register-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    
    .register-header p {
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
    
    .btn-register {
        height: 50px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        background: #28a745;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-register:hover {
        background: #218838;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
    }
    
    .password-strength {
        height: 4px;
        margin-top: 8px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .password-requirements {
        font-size: 12px;
        color: #6c757d;
        margin-top: 8px;
    }
    
    .password-requirements li {
        margin-bottom: 4px;
    }
    
    .password-requirements .valid {
        color: #28a745;
    }
    
    .password-requirements .invalid {
        color: #dc3545;
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

<div class="register-container">
    <div class="container">
        <div class="register-card">
            <div class="register-header">
                <h2>Đăng Ký</h2>
                <p>Tạo tài khoản BikeGo của bạn</p>
            </div>
            
            <form method="post" class="needs-validation" novalidate>
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Tên người dùng" required>
                    <label for="username">Tên người dùng</label>
                    <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                </div>
                
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email của bạn</label>
                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
                    <label for="password">Mật khẩu</label>
                    <div class="password-strength" id="password-strength"></div>
                    <div class="password-requirements">
                        <ul class="small mb-0 ps-3">
                            <li id="length" class="invalid">Ít nhất 8 ký tự</li>
                            <li id="uppercase" class="invalid">Ít nhất 1 chữ hoa</li>
                            <li id="number" class="invalid">Ít nhất 1 số</li>
                            <li id="special" class="invalid">Ít nhất 1 ký tự đặc biệt</li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                    <label for="confirm_password">Xác nhận mật khẩu</label>
                    <div class="invalid-feedback">Vui lòng xác nhận mật khẩu.</div>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms">
                        Tôi đồng ý với <a href="#" class="text-success">điều khoản sử dụng</a> và <a href="#" class="text-success">chính sách bảo mật</a>
                    </label>
                    <div class="invalid-feedback">Bạn phải đồng ý với điều khoản để tiếp tục.</div>
                </div>
                
                <button type="submit" class="btn btn-success btn-register w-100">
                    <i class="bi bi-person-plus me-2"></i>Đăng Ký
                </button>
            </form>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="text-footer">
                <p class="mb-0">Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
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

    // Password strength checker
    const password = document.getElementById('password');
    const strengthBar = document.getElementById('password-strength');
    const requirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special')
    };

    password.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;
        
        // Check length
        if (value.length >= 8) {
            strength += 25;
            requirements.length.classList.remove('invalid');
            requirements.length.classList.add('valid');
        } else {
            requirements.length.classList.remove('valid');
            requirements.length.classList.add('invalid');
        }
        
        // Check uppercase
        if (/[A-Z]/.test(value)) {
            strength += 25;
            requirements.uppercase.classList.remove('invalid');
            requirements.uppercase.classList.add('valid');
        } else {
            requirements.uppercase.classList.remove('valid');
            requirements.uppercase.classList.add('invalid');
        }
        
        // Check number
        if (/[0-9]/.test(value)) {
            strength += 25;
            requirements.number.classList.remove('invalid');
            requirements.number.classList.add('valid');
        } else {
            requirements.number.classList.remove('valid');
            requirements.number.classList.add('invalid');
        }
        
        // Check special character
        if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
            strength += 25;
            requirements.special.classList.remove('invalid');
            requirements.special.classList.add('valid');
        } else {
            requirements.special.classList.remove('valid');
            requirements.special.classList.add('invalid');
        }
        
        // Update strength bar
        strengthBar.style.width = strength + '%';
        if (strength <= 25) {
            strengthBar.style.backgroundColor = '#dc3545';
        } else if (strength <= 50) {
            strengthBar.style.backgroundColor = '#ffc107';
        } else if (strength <= 75) {
            strengthBar.style.backgroundColor = '#20c997';
        } else {
            strengthBar.style.backgroundColor = '#28a745';
        }
    });

    // Password match checker
    const confirmPassword = document.getElementById('confirm_password');
    confirmPassword.addEventListener('input', function() {
        if (this.value !== password.value) {
            this.setCustomValidity('Mật khẩu không khớp');
        } else {
            this.setCustomValidity('');
        }
    });
</script>

<?php require_once 'includes/footer.php'; ?>