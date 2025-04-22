<?php 
require_once '../../includes/db_connect.php'; 
require_once '../../includes/guard.route.php'; 
require_once '../../includes/header.php';  

// Check if user has admin access 
guardRoute('admin');  

// Handle bike operations (add, edit, delete, status update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $bikeType = $_POST['bike_type'];
                $status = 'available';
                
                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $uploadDir = '../../assets/images/';
                    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $filename = 'bike_' . time() . '.' . $fileExtension;
                    $uploadPath = $uploadDir . $filename;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        $stmt = $pdo->prepare("INSERT INTO bike_templates (bike_type, image, status) VALUES (?, ?, ?)");
                        $stmt->execute([$bikeType, $filename, $status]);
                        $_SESSION['success'] = "Thêm xe mới thành công!";
                    } else {
                        $_SESSION['error'] = "Lỗi upload hình ảnh!";
                    }
                } else {
                    $_SESSION['error'] = "Vui lòng chọn hình ảnh!";
                }
                header('Location: index.php');
                exit();
                break;
                
            case 'update_status':
                $bikeId = $_POST['bike_id'];
                $status = $_POST['status'];
                
                $stmt = $pdo->prepare("UPDATE bike_templates SET status = ? WHERE id = ?");
                $stmt->execute([$status, $bikeId]);
                
                $_SESSION['success'] = "Cập nhật trạng thái xe thành công!";
                header('Location: index.php');
                exit();
                break;
                
            case 'delete':
                $bikeId = $_POST['bike_id'];
                
                // Check if bike is being rented
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM rentals WHERE bike_template_id = ? AND end_time IS NULL");
                $stmt->execute([$bikeId]);
                $activeRentals = $stmt->fetchColumn();
                
                if ($activeRentals > 0) {
                    $_SESSION['error'] = "Không thể xóa xe đang được thuê!";
                } else {
                    // Get image filename for deletion
                    $stmt = $pdo->prepare("SELECT image FROM bike_templates WHERE id = ?");
                    $stmt->execute([$bikeId]);
                    $image = $stmt->fetchColumn();
                    
                    // Delete bike from database
                    $stmt = $pdo->prepare("DELETE FROM bike_templates WHERE id = ?");
                    $stmt->execute([$bikeId]);
                    
                    // Delete image file
                    if ($image && file_exists('../../assets/images/' . $image)) {
                        unlink('../../assets/images/' . $image);
                    }
                    
                    $_SESSION['success'] = "Xóa xe thành công!";
                }
                
                header('Location: index.php');
                exit();
                break;
        }
    }
}

// Get bike statistics
$stmt = $pdo->prepare("SELECT bike_type, COUNT(*) as count FROM bike_templates GROUP BY bike_type");
$stmt->execute();
$bikeTypeStats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

$stmt = $pdo->prepare("SELECT status, COUNT(*) as count FROM bike_templates GROUP BY status");
$stmt->execute();
$bikeStatusStats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;

// Filter
$bikeType = isset($_GET['type']) ? $_GET['type'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build query
$where = [];
$params = [];

if ($bikeType) {
    $where[] = "bike_type = ?";
    $params[] = $bikeType;
}

if ($status) {
    $where[] = "status = ?";
    $params[] = $status;
}

if ($search) {
    $where[] = "(id LIKE ? OR image LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";

// Get total count
$stmt = $pdo->prepare("SELECT COUNT(*) FROM bike_templates $whereClause");
$stmt->execute($params);
$totalBikes = $stmt->fetchColumn();
$totalPages = ceil($totalBikes / $perPage);

// Get bikes for current page
$sql = "SELECT * FROM bike_templates $whereClause ORDER BY id DESC LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$bikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    width: 100%;
}

.content-area {
    position: relative;
    width: 100%;
    height: calc(100vh - 80px);
    overflow-y: auto;
}

.stats-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
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

.bike-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.bike-image:hover {
    transform: scale(1.1);
}

.status-badge {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
}

.filter-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    color: #6c757d;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.875rem;
    padding: 1rem;
}

.table td {
    vertical-align: middle;
    padding: 1rem;
}

.action-buttons .btn {
    padding: 0.375rem 0.75rem;
    margin: 0 0.25rem;
}

.dropdown-menu {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
}

.dropdown-item {
    padding: 0.5rem 1rem;
    transition: background-color 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.page-header {
    margin-bottom: 2rem;
}

.add-btn {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    border-radius: 50px;
}
</style>

<div class="admin-container">
    <div class="admin-grid">
        <!-- Sidebar -->
        <?php include '../sidebar.php'; ?>
        
        <!-- Main content -->
        <div class="content-wrapper">
            <div class="content-area">
                <main class="main-content">
                    <!-- Page header -->
                    <div class="page-header d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý xe</h1>
                        <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#addBikeModal">
                            <i class="fas fa-plus mr-2"></i>Thêm xe mới
                        </button>
                    </div>

                    <!-- Alert messages -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Statistics cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng số xe
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBikes; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bicycle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-success h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Xe đạp thường
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $bikeTypeStats['bike'] ?? 0; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bicycle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-info h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Xe đạp điện
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $bikeTypeStats['ebike'] ?? 0; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-warning h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Đang bảo trì
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $bikeStatusStats['maintenance'] ?? 0; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="card filter-card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bộ lọc</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" class="row align-items-center">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label class="form-label mb-2">Loại xe:</label>
                                    <select name="type" class="form-control">
                                        <option value="">Tất cả</option>
                                        <option value="bike" <?php echo $bikeType === 'bike' ? 'selected' : ''; ?>>Xe đạp thường</option>
                                        <option value="ebike" <?php echo $bikeType === 'ebike' ? 'selected' : ''; ?>>Xe đạp điện</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label class="form-label mb-2">Trạng thái:</label>
                                    <select name="status" class="form-control">
                                        <option value="">Tất cả</option>
                                        <option value="available" <?php echo $status === 'available' ? 'selected' : ''; ?>>Có sẵn</option>
                                        <option value="rented" <?php echo $status === 'rented' ? 'selected' : ''; ?>>Đang thuê</option>
                                        <option value="maintenance" <?php echo $status === 'maintenance' ? 'selected' : ''; ?>>Bảo trì</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label mb-2">Tìm kiếm:</label>
                                    <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" placeholder="ID hoặc tên file ảnh">
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label mb-2">&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search mr-1"></i>Lọc
                                        </button>
                                        <a href="index.php" class="btn btn-secondary ml-2">
                                            <i class="fas fa-redo mr-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Bikes table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách xe</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hình ảnh</th>
                                            <th>Loại xe</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bikes as $bike): ?>
                                        <tr>
                                            <td><strong>#<?php echo $bike['id']; ?></strong></td>
                                            <td>
                                                <img src="../../assets/images/<?php echo htmlspecialchars($bike['image']); ?>" 
                                                     alt="Bike <?php echo $bike['id']; ?>" 
                                                     class="bike-image"
                                                     onclick="showImageModal('../../assets/images/<?php echo htmlspecialchars($bike['image']); ?>')">
                                            </td>
                                            <td>
                                                <?php 
                                                echo $bike['bike_type'] === 'bike' ? 
                                                    '<span class="badge badge-primary status-badge">Xe đạp thường</span>' : 
                                                    '<span class="badge badge-info status-badge">Xe đạp điện</span>';
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                switch ($bike['status']) {
                                                    case 'available':
                                                        echo '<span class="badge badge-success status-badge">Có sẵn</span>';
                                                        break;
                                                    case 'rented':
                                                        echo '<span class="badge badge-warning status-badge">Đang thuê</span>';
                                                        break;
                                                    case 'maintenance':
                                                        echo '<span class="badge badge-danger status-badge">Bảo trì</span>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog mr-1"></i>Trạng thái
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form method="POST" class="dropdown-item p-0">
                                                                <input type="hidden" name="action" value="update_status">
                                                                <input type="hidden" name="bike_id" value="<?php echo $bike['id']; ?>">
                                                                <input type="hidden" name="status" value="available">
                                                                <button type="submit" class="btn btn-link text-left w-100 <?php echo $bike['status'] === 'available' ? 'disabled' : ''; ?>">
                                                                    <i class="fas fa-check text-success mr-2"></i>Có sẵn
                                                                </button>
                                                            </form>
                                                            <form method="POST" class="dropdown-item p-0">
                                                                <input type="hidden" name="action" value="update_status">
                                                                <input type="hidden" name="bike_id" value="<?php echo $bike['id']; ?>">
                                                                <input type="hidden" name="status" value="maintenance">
                                                                <button type="submit" class="btn btn-link text-left w-100 <?php echo $bike['status'] === 'maintenance' ? 'disabled' : ''; ?>">
                                                                    <i class="fas fa-tools text-danger mr-2"></i>Bảo trì
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?php echo $bike['id']; ?>)">
                                                        <i class="fas fa-trash mr-1"></i>Xóa
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if ($totalPages > 1): ?>
                            <nav aria-label="Page navigation" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&amp;type=<?php echo urlencode($bikeType); ?>&amp;status=<?php echo urlencode($status); ?>&amp;search=<?php echo urlencode($search); ?>">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php echo $page === $i ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>&amp;type=<?php echo urlencode($bikeType); ?>&amp;status=<?php echo urlencode($status); ?>&amp;search=<?php echo urlencode($search); ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&amp;type=<?php echo urlencode($bikeType); ?>&amp;status=<?php echo urlencode($status); ?>&amp;search=<?php echo urlencode($search); ?>">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<!-- Delete confirmation form -->
<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="bike_id" id="deleteBikeId">
</form>

<!-- Include Add Bike Modal -->
<?php include 'addBikeModal.php'; ?>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem hình ảnh</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Bike Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
// Confirm delete function
function confirmDelete(bikeId) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Bạn không thể hoàn tác sau khi xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteBikeId').value = bikeId;
            document.getElementById('deleteForm').submit();
        }
    });
}

// Show image in modal
function showImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    $('#imageModal').modal('show');
}
</script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>