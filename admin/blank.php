<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lixurus Homes</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="bootstrap/bootstrap-icons.css" rel="stylesheet">
    <!-- Admin CSS -->
    <link href="css/admin.css" rel="stylesheet">
</head>

<body>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column text-white" id="sidebar">
        <a href="index.html" class="sidebar-brand mb-4 text-decoration-none">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-cpu-fill text-primary"></i>
                <span class="text-dark">Lixurus Homes Admin</span>
            </div>
        </a>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.html" class="nav-link link-dark">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="users.html" class="nav-link link-dark">
                    <i class="bi bi-people"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark">
                    <i class="bi bi-calendar-event"></i>
                    Sessions
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark">
                    <i class="bi bi-chat-dots"></i>
                    Topics
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark">
                    <i class="bi bi-ticket-perforated"></i>
                    Ticket Sales
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <i class="bi bi-file-earmark"></i>
                    Blank Page
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark">
                    <i class="bi bi-gear"></i>
                    Settings
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Main Content -->
    <main class="main-content">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 m-0 small">
                <li class="breadcrumb-item"><a href="index.html" class="text-decoration-none text-muted">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <header
            class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded glass-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h4 class="m-0 fw-bold text-secondary">Blank Page Title</h4>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Action Buttons can go here -->
            </div>
        </header>

        <!-- Page Content -->
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-body p-5 text-center text-muted">
                <div class="mb-3 display-1 text-light">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h5>Start Here</h5>
                <p>This is a blank canvas for your new admin page.</p>
            </div>
        </div>

    </main>

    <!-- Bootstrap Bundle -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
        }
    </script>
</body>

</html>