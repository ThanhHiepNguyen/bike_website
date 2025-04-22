<style>
#sidebar {
    min-width: 70px;
    max-width: 70px;
    min-height: calc(100vh - 80px);
    transition: all 0.3s ease;
    position: fixed;
    top: 80px;
    left: 0;
    z-index: 999;
    background: #fff;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    overflow: hidden;
}

#sidebar.active {
    min-width: 250px;
    max-width: 250px;
}

#sidebar .sidebar-header {
    padding: 15px 10px;
    background: #fff;
    text-align: center;
    transition: all 0.3s;
    border-bottom: 1px solid #e9ecef;
}

#sidebar.active .sidebar-header {
    text-align: left;
    padding: 15px;
}

#sidebar .sidebar-header h5 {
    margin: 0;
    white-space: nowrap;
    display: none;
}

#sidebar.active .sidebar-header h5 {
    display: block;
}

#sidebar .nav-link {
    font-weight: 500;
    color: #333;
    padding: 15px 10px;
    display: flex;
    align-items: center;
    transition: all 0.3s;
    white-space: nowrap;
    position: relative;
    justify-content: center;
}

#sidebar.active .nav-link {
    justify-content: flex-start;
    padding: 10px 15px;
}

#sidebar .nav-link i {
    font-size: 1.2rem;
    min-width: 20px;
    text-align: center;
    margin: 0;
}

#sidebar.active .nav-link i {
    margin-right: 10px;
    font-size: 1rem;
}

#sidebar .nav-link .menu-text {
    display: none;
    margin-left: 10px;
}

#sidebar.active .nav-link .menu-text {
    display: inline;
}

#sidebar .nav-link:hover {
    color: #007bff;
    background: #f8f9fa;
}

#sidebar .nav-link.active {
    color: #007bff;
    background: #e9ecef;
}

#sidebarCollapse {
    position: absolute;
    top: 15px;
    right: 10px;
    display: none;
}

#sidebar.active #sidebarCollapse {
    display: block;
}

/* Tooltip for collapsed sidebar */
#sidebar:not(.active) .nav-link {
    position: relative;
}

#sidebar:not(.active) .nav-link:hover::after {
    content: attr(data-toggle);
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    background: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    white-space: nowrap;
    font-size: 0.875rem;
    z-index: 1000;
    margin-left: 10px;
}

#sidebar:not(.active) .nav-link:hover::before {
    content: '';
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    border: 6px solid transparent;
    border-right-color: #333;
    margin-left: -2px;
}
</style>

<nav id="sidebar" class="bg-white sidebar shadow-sm">
    <div class="sidebar-sticky">
        <div class="sidebar-header">
            <h5 class="mb-0">Admin Panel</h5>
            <button type="button" id="sidebarCollapse" class="btn btn-sm btn-light">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="nav flex-column py-2">
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" 
                   href="/bike_website/admin/index.php" 
                   data-toggle="Dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'bikes.php' ? 'active' : ''; ?>" 
                   href="/bike_website/admin/bikes/index.php"
                   data-toggle="Quản lý xe">
                    <i class="fas fa-bicycle"></i>
                    <span class="menu-text">Quản lý xe</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'stations.php' ? 'active' : ''; ?>" 
                   href="stations.php"
                   data-toggle="Quản lý trạm">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="menu-text">Quản lý trạm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>" 
                   href="users.php"
                   data-toggle="Quản lý người dùng">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Quản lý người dùng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'rentals.php' ? 'active' : ''; ?>" 
                   href="rentals.php"
                   data-toggle="Lịch sử thuê">
                    <i class="fas fa-history"></i>
                    <span class="menu-text">Lịch sử thuê</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contacts.php' ? 'active' : ''; ?>" 
                   href="contacts.php"
                   data-toggle="Liên hệ">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-text">Liên hệ</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    
    // Toggle sidebar when clicking collapse button
    sidebarCollapse.addEventListener('click', function() {
        sidebar.classList.remove('active');
    });
    
    // Toggle sidebar when clicking on sidebar header or nav items
    sidebar.addEventListener('click', function(e) {
        // If clicking on the collapse button, don't expand
        if (e.target.closest('#sidebarCollapse')) {
            return;
        }
        
        // If sidebar is collapsed and user clicks anywhere on it, expand it
        if (!sidebar.classList.contains('active')) {
            sidebar.classList.add('active');
        }
    });
    
    // Collapse sidebar when clicking outside
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target) && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });
});
</script>