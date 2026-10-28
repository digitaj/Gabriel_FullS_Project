<?php
require_once "classes/User.php";
require_once "head.php";

$user = new User();
$userDetails = null;

if (isset($_SESSION['user_online'])) {
    $userDetails = $user->get_user($_SESSION['user_online']);
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top glass-navbar nav1" role="navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" aria-label="Lixurus Home">Lixurus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="buy.php">Buy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rent.php">Rent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sell.php">Sell</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if ($userDetails){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-label="Saved Homes">Saved Homes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../search.php" aria-label="Saved Search">Saved Search</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="bi bi-person-circle fs-5" aria-hidden="true"></i>
                            <span class="fw-semibold"><?php echo htmlspecialchars($userDetails['user_firstname'] . ' ' . $userDetails['user_lastname']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2" aria-hidden="true"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="properties_listed.php"><i class="bi bi-houses me-2" aria-hidden="true"></i>Properties Listed</a></li>
                            <li><a class="dropdown-item" href="dashboard.php"><i class="bi bi-house me-2" aria-hidden="true"></i>Saved Homes</a></li>
                            <li><a class="dropdown-item" href="transactions.html"><i class="bi bi-search me-2" aria-hidden="true"></i>Saved Search</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2" aria-hidden="true"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item pr-5">
                        <a href="login.php" class="btn btn-outline-success me-2">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="btn btn-outline-success">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
 

