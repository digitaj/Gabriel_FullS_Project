<?php  
    session_start();
    require_once "admin_guard.php";
    require_once "partials/admin_header.php";
    require_once "classes/Admin.php";
    

    $admin = new Admin();

    $users = $admin->get_all_users();
    $properties = $admin->fetch_all_properties();

    $total_users = count($users) > 0 ? count($users) : 0;
    $total_properties = count($properties) > 0 ? count($properties) : 0;
?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Minimal Header -->
        <header class="d-flex justify-content-between align-items-center mb-5 pt-3">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none shadow-sm" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <div>
                    <h4 class="fw-bold text-dark m-0">Overview</h4>
                    <p class="text-muted small m-0">Welcome back, Admin</p>
                </div>
            </div>
            <!-- Minimal Actions -->
            <div class="d-flex gap-3">
                <button class="btn btn-white shadow-sm border rounded-circle p-2">
                    <i class="bi bi-bell text-muted"></i>
                </button>
            </div>
        </header>

        <!-- Simplified Stats Grid -->
        <div class="row g-4 mb-5">
            <!-- Stat 1 -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm glass-card h-100 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-bold text-uppercase">Total Users</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                    </div>
                    <div class="d-flex align-items-end gap-2">
                        <h2 class="fw-bold mb-0"><?php echo number_format($total_users); ?></h2>
                        <small class="text-muted mb-1">registered</small>
                    </div>
                </div>
            </div>
            <!-- Stat 2 -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm glass-card h-100 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-bold text-uppercase">Categories</span>
                      
                    </div>
                    <div class="d-flex align-items-end gap-2">
                        <h2 class="fw-bold mb-0">1</h2>
                     
                    </div>
                </div>
            </div>
            <!-- Stat 3 -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm glass-card h-100 p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-bold text-uppercase">Properties Listed</span>
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill">Live</span>
                    </div>
                    <div class="d-flex align-items-end gap-2">
                        <h2 class="fw-bold mb-0"><?php echo number_format($total_properties); ?></h2>
                       
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>

<?php
    require_once "partials/admin_footer.php";
?>