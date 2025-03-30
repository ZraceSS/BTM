<?php
// Start the session if needed (optional for login/logout features)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold text-warning" href="#">Better Time Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="features.php">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-warning px-3 mx-2" href="login.php">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-warning text-dark px-3" href="signup.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>