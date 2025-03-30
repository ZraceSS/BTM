<?php
// Start session to check login status
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Better Time Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Background Image -->
    <div class="bg-image"></div>
    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-content text-center text-white">
            <h1>Welcome to <span class="text-warning">BETTER</span> Time Manager</h1>
            <p>Manage your time efficiently and improve your productivity.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="register.php" class="btn btn-warning btn-lg">Get Started</a>
                <a href="goldplan.php" class="btn btn-outline-light btn-lg">Gold Plan</a>
                <a href="candela.php" class="btn btn-outline-light btn-lg">Candela</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>