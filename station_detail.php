<?php
require_once 'includes/header.php';
require_once 'includes/db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$station_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($station_id <= 0) {
    echo "<div class='alert alert-danger'>ID trạm không hợp lệ</div>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM stations WHERE id = ?");
$stmt->execute([$station_id]);
$station = $stmt->fetch();

if (!$station) {
    echo "<div class='alert alert-warning'>Không tìm thấy trạm xe</div>";
    exit;
}

$bike_stmt = $pdo->query("SELECT * FROM bike_templates");
$all_bikes = $bike_stmt->fetchAll(PDO::FETCH_ASSOC);

$bike = array_filter($all_bikes, fn($b) => $b['bike_type'] === 'bike');
$ebike = array_filter($all_bikes, fn($b) => $b['bike_type'] === 'ebike');

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách xe tại <?= htmlspecialchars($station['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-toggle {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .btn-toggle.active {
            background-color: #0d6efd;
            color: white;
        }

        .bike-list {
            display: none;
        }

        .bike-list.active {
            display: block;
        }

        .bike-img {
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <h3 class="mb-4 text-primary">🚲 Danh sách xe tại <?= htmlspecialchars($station['name']) ?></h3>

        <div class="d-flex justify-content-center gap-2 mb-4">
            <button class="btn btn-toggle active" onclick="showTab('bike')">Xe đạp cơ</button>
            <button class="btn btn-toggle" onclick="showTab('ebike')">Xe đạp điện</button>
        </div>

        <div id="bike" class="bike-list active">
            <?php if (count($bike) > 0): ?>
                <div class="row">
                    <?php foreach ($bike as $b): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <?php if (!empty($b['image'])): ?>
                                        <img src="assets/images/bikes/<?= htmlspecialchars($b['image']) ?>" class="img-fluid bike-img" alt="Xe <?= $b['id'] ?>">
                                    <?php endif; ?>
                                    <h5 class="card-title">🚲 Xe đạp thường</h5>
                                    <p>Trạng thái: <?= $b['status'] ?></p>
                                    <button class="btn btn-outline-primary w-100" onclick="showPricingModal()">Bảng giá thuê</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Không có xe đạp cơ tại trạm này.</p>
            <?php endif; ?>
        </div>

        <div id="ebike" class="bike-list">
            <?php if (count($ebike) > 0): ?>
                <div class="row">
                    <?php foreach ($ebike as $b): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <?php if (!empty($b['image'])): ?>
                                        <img src="assets/images/bikes/<?= htmlspecialchars($b['image']) ?>" class="img-fluid bike-img" alt="Xe <?= $b['id'] ?>">
                                    <?php endif; ?>
                                    <h5 class="card-title">⚡ Xe đạp điện</h5>
                                    <p>Trạng thái: <?= $b['status'] ?></p>
                                    <button class="btn btn-outline-primary w-100" onclick="showPricingModal()">Bảng giá thuê</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Không có xe đạp điện tại trạm này.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Bảng giá -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">📋 Bảng giá thuê xe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="text-primary fw-bold">Vé lượt</h5>
                                        <p><strong>10.000</strong> VNĐ/lượt</p>
                                        <p>🕒 Thời lượng: 60 phút</p>
                                        <p>⏳ Hạn dùng: 60 phút</p>
                                        <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                    </div>
                                    <button class="btn btn-primary mt-3 w-100" onclick="startPayment('luot', 10000)">Chọn vé này</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-success">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="text-success fw-bold">Vé ngày</h5>
                                        <p><strong>50.000</strong> VNĐ/ngày</p>
                                        <p>🕒 Thời lượng: 450 phút</p>
                                        <p>⏳ Hạn dùng: 24h</p>
                                        <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                    </div>
                                    <button class="btn btn-success mt-3 w-100" onclick="startPayment('ngay', 50000)">Chọn vé này</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="text-warning fw-bold">Vé tháng</h5>
                                        <p><strong>79.000</strong> VNĐ/tháng</p>
                                        <p>🕒 Miễn phí tất cả chuyến < 45 phút</p>
                                                <p>⏳ Hạn dùng: 30 ngày</p>
                                                <p>💳 Quá giờ: 3.000đ / 15 phút</p>
                                    </div>
                                    <button class="btn btn-warning mt-3 w-100" onclick="startPayment('thang', 79000)">Chọn vé này</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    >
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Thanh toán -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Thanh toán vé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="ticketType" class="fw-bold mb-2"></p>
                    <p class="mb-3">Vui lòng quét mã QR sau để thanh toán</p>
                    <img src="assets/images/qr_momo.png" class="img-fluid mb-3" width="200" alt="QR">
                    <p>Vui lòng quét mã thanh toán và bấm xác nhận để nhận mã kích hoạt xe</p>
                    <form id="sendCodeForm">
                        <input type="hidden" name="plan" id="planHidden">
                        <input type="hidden" name="price" id="priceHidden">
                        <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
                    </form>

                    <div id="result" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(type) {
            document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.bike-list').forEach(div => div.classList.remove('active'));
            document.getElementById(type).classList.add('active');
            event.target.classList.add('active');
        }

        function showPricingModal() {
            const modal = new bootstrap.Modal(document.getElementById('pricingModal'));
            modal.show();
        }

        function startPayment(plan, price) {
            const planText = {
                'luot': 'Vé lượt (10.000 VNĐ)',
                'ngay': 'Vé ngày (50.000 VNĐ)',
                'thang': 'Vé tháng (79.000 VNĐ)'
            };

            document.getElementById('ticketType').textContent = planText[plan] || 'Loại vé';
            document.getElementById('planHidden').value = plan;
            document.getElementById('priceHidden').value = price;

            const qrImg = document.querySelector('#paymentModal img');
            qrImg.src = `./assets/images/qr_${plan}.png?t=${Date.now()}`; // Tạo đường dẫn ảnh QR

            const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
            modal.show();
        }

        document.getElementById('sendCodeForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const plan = document.getElementById('planHidden').value;
            const price = document.getElementById('priceHidden').value;

            // Tạo mã ngẫu nhiên
            const code = Math.random().toString(36).substring(2, 10).toUpperCase();

            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `
            <div class="alert alert-success">
                ✅ Thanh toán gói <strong>${plan}</strong> với giá <strong>${price} VNĐ</strong> thành công!<br>
                <strong>Mã kích hoạt của bạn là:</strong> <span class="text-primary fs-5">${code}</span>
            </div>
        `;

            // 🔥 Gọi API lưu lịch sử thuê
            const response = await fetch('save_rental.php', {
                method: 'POST',
                body: new URLSearchParams({
                    bike_template_id: 1, // Thay bằng ID xe thực tế
                    plan: plan,
                    price: price
                })
            });

            const data = await response.json();
            if (data.success) {
                console.log('✅ Đã lưu lịch sử thành công');
            } else {
                console.error('⚠️ Lỗi khi lưu lịch sử:', data.message);
            }
        });
    </script>


    <?php require_once 'includes/footer.php'; ?>
</body>

</html>