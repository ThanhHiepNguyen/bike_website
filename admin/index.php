<?php 
require_once '../includes/db_connect.php'; 
require_once '../includes/guard.route.php'; 
require_once '../includes/header.php';  

// Check if user has admin access 
guardRoute('admin');  

// Get statistics for dashboard
$stmt = $pdo->prepare("SELECT COUNT(*) as total_users FROM users WHERE role = 'user'");
$stmt->execute();
$total_users = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_stations FROM stations");
$stmt->execute();
$total_stations = $stmt->fetch(PDO::FETCH_ASSOC)['total_stations'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_bikes FROM bike_templates");
$stmt->execute();
$total_bikes = $stmt->fetch(PDO::FETCH_ASSOC)['total_bikes'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_rentals FROM rentals");
$stmt->execute();
$total_rentals = $stmt->fetch(PDO::FETCH_ASSOC)['total_rentals'];

$stmt = $pdo->prepare("SELECT COUNT(*) as active_rentals FROM rentals WHERE end_time IS NULL");
$stmt->execute();
$active_rentals = $stmt->fetch(PDO::FETCH_ASSOC)['active_rentals'];

$stmt = $pdo->prepare("SELECT COUNT(*) as available_bikes FROM bike_templates WHERE status = 'available'");
$stmt->execute();
$available_bikes = $stmt->fetch(PDO::FETCH_ASSOC)['available_bikes'];
?> 

<style>
.admin-container {
    margin-top: 80px;
    min-height: calc(100vh - 80px);
    background-color: #f8f9fa;
}

.admin-grid {
    display: grid;
    grid-template-columns: auto 1fr;
    min-height: calc(100vh - 80px);
}

.main-content {
    padding: 20px;
    margin-left: 0;
    transition: all 0.3s ease;
    overflow-y: auto;
}

.content-wrapper {
    padding-left: 70px;
    width: 100vw;
}

/* Adjust content area to always leave space for the sidebar */
.content-area {
    position: relative;
    width: 100%;
    height: calc(100vh - 80px);
    overflow-y: auto;
}

.border-left-primary {
    border-left: 4px solid #4e73df;
}

.border-left-success {
    border-left: 4px solid #1cc88a;
}

.border-left-info {
    border-left: 4px solid #36b9cc;
}

.border-left-warning {
    border-left: 4px solid #f6c23e;
}

.card {
    border: none;
    border-radius: .35rem;
}

.chart-area {
    position: relative;
    height: 300px;
}

.chart-pie {
    position: relative;
    height: 250px;
}
</style>

<div class="admin-container">
    <div class="admin-grid">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        
        <!-- Main content -->
        <div class="content-wrapper">
            <div class="content-area">
                <main class="main-content">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Xuất báo cáo</button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng người dùng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Tổng số trạm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_stations; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Tổng số xe</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_bikes; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bicycle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Xe đang sẵn sàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $available_bikes; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ thuê xe theo tháng</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="rentalChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Phân bố loại xe</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="bikeTypeChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Xe đạp thường
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Xe đạp điện
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Hoạt động gần đây</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $stmt = $pdo->prepare("
                                        SELECT r.*, u.full_name, b.bike_type 
                                        FROM rentals r 
                                        JOIN users u ON r.user_id = u.id 
                                        JOIN bike_templates b ON r.bike_template_id = b.id 
                                        ORDER BY r.start_time DESC 
                                        LIMIT 5
                                    ");
                                    $stmt->execute();
                                    $recent_rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Người dùng</th>
                                                    <th>Loại xe</th>
                                                    <th>Thời gian</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_rentals as $rental): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($rental['full_name']); ?></td>
                                                    <td><?php echo $rental['bike_type'] == 'bike' ? 'Xe đạp' : 'Xe điện'; ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($rental['start_time'])); ?></td>
                                                    <td>
                                                        <?php if ($rental['end_time'] === null): ?>
                                                            <span class="badge badge-warning">Đang thuê</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success">Đã trả</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liên hệ mới nhất</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");
                                    $stmt->execute();
                                    $recent_contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Thời gian</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_contacts as $contact): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></td>
                                                    <td>
                                                        <a href="contacts.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-primary">Xem</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Rental Chart
var ctx = document.getElementById('rentalChart').getContext('2d');
var rentalChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        datasets: [{
            label: 'Số lượt thuê',
            data: [65, 59, 80, 81, 56, 55, 40, 88, 45, 65, 70, 85],
            fill: true,
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            tension: 0.3
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Bike Type Chart
var pieCtx = document.getElementById('bikeTypeChart').getContext('2d');
var bikeTypeChart = new Chart(pieCtx, {
    type: 'doughnut',
    data: {
        labels: ['Xe đạp thường', 'Xe đạp điện'],
        datasets: [{
            data: [20, 20],
            backgroundColor: ['#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});
</script>