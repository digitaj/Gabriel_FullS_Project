<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lixurus Homes Admin - Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="assets/bootstrap/bootstrap-icons.css" rel="stylesheet">
    <!-- Admin CSS -->
    <link href="assets/css/admin.css" rel="stylesheet">
</head>

<body>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column text-white" id="sidebar">
        <a href="index.html" class="sidebar-brand mb-4 text-decoration-none">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-cpu-fill text-success"></i>
                <span class="text-dark">Lixurus Homes Admin</span>
            </div>
        </a>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link active" aria-current="page">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="users.php" class="nav-link link-dark">
                    <i class="bi bi-people"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_category.php" class="nav-link link-dark">
                    <i class="bi bi-plus-circle"></i>
                  Add Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="properties.php" class="nav-link link-dark">
                    <i class="bi bi-houses"></i>
                  View Properties
                </a>
            </li>
            
            <li class="nav-item">
                <a href="admin_logout.php" class="nav-link link-dark">
                    <i class="bi bi-gear"></i>
                    Logout
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none" id="dropdownUser2"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=random" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>Admin</strong>
                <i class="bi bi-chevron-down ms-2 small"></i>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="login.html">Sign out</a></li>
            </ul>
        </div>
    </nav>