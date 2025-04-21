<?php
require_once 'includes/db_connect.php';
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$page_title = "Liên Hệ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Lưu vào database
    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // Gửi email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Thay bằng email của bạn
        $mail->Password = 'your_app_password'; // Thay bằng App Password của Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom($email, $name);
        $mail->addAddress('support@bikego.vn');
        $mail->Subject = 'Liên Hệ Từ BikeGo';
        $mail->Body = "Tên: $name\nEmail: $email\nTin nhắn: $message";

        $mail->send();
        $success = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.";
    } catch (Exception $e) {
        $error = "Gửi email thất bại: {$mail->ErrorInfo}";
    }
}
require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Liên Hệ Với Chúng Tôi</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">Vui lòng nhập họ tên.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Tin Nhắn</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        <div class="invalid-feedback">Vui lòng nhập tin nhắn.</div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Gửi</button>
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