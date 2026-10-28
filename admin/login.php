<?php
    // echo password_hash("password123", PASSWORD_DEFAULT);
    // die();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevConf Admin - Login</title>

    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="assets/bootstrap/bootstrap-icons.css" rel="stylesheet">
    <!-- Admin CSS -->
    <link href="assets/css/admin.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body class="login-body d-flex justify-content-center align-items-center vh-100">

    <div class="login-card glass-card animate__animated animate__fadeInUp w-100 h-auto p-4">
           <div class="row">
                <div class="col-md-12">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-dark">Admin Access</h3>
                            <p class="text-muted small">Please sign in to continue to the dashboard.</p>
                            <?php
                                require_once "partials/message.php";
                            ?>
                        </div>

                        <form action="process/process_admin_login.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted small fw-bold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" class="form-control bg-light border-start-0 ps-0" id="email"
                                        placeholder="admin@lixurus.com" name="email" >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label text-muted small fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                                    <input type="password" class="form-control bg-light border-start-0 ps-0" id="password"
                                        placeholder="••••••••" name="password" >
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" name="btnadmin" class="btn btn-success py-2 fw-bold shadow-sm">Sign In</button>
                            </div>

                            <div class="text-center">
                                <a href="../index.php" class="text-decoration-none small text-muted hover-link">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Main Site
                                </a>
                            </div>
                        </form>
                </div>
           </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>