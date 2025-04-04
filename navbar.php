<?php

$is_logged_in = isset($_SESSION['user_id']); // Check if user session exists
?>

<!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg px-4" style="background-color: #444;">
    <a class="navbar-brand text-white fw-bold" href="index.php">BETTER</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="bi bi-list text-white"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <?php if ($is_logged_in): ?>
                <!-- Logged-In Navbar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="featureDropdown" role="button"
                        data-bs-toggle="dropdown">FEATURE</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="candela.php">Candela</a></li>
                        <li><a class="dropdown-item" href="goldplan.php">Gold Plan</a></li>
                        <li><a class="dropdown-item" href="statistics.php">Statistic</a></li>
                    </ul>
                </li>

                <!-- Account Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="account.php">Setting</a></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            
            <?php else: ?>
                <li class="nav-item">
                    <a href="login.php" class="btn btn-light me-2">LOG IN</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="btn btn-light">SIGN UP</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
