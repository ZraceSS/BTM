<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION['user']); // Check if user session exists
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
                        <li><a class="dropdown-item" href="#">Candela</a></li>
                        <li><a class="dropdown-item" href="#">Gold Plan</a></li>
                        <li><a class="dropdown-item" href="#">Statistic</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">ABOUT</a>
                </li>

                <!-- Account Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            
            <?php else: ?>
                <!-- Non-Logged-In Navbar -->
                <li class="nav-item">
                    <a href="#" class="btn btn-outline-light me-2">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="btn btn-warning me-2">LOG IN</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="btn btn-light">SIGN UP</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
