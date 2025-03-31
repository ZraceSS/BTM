<?php include 'auth.php';?>
<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- Background Image -->
    <div class="bg-image"></div>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="glass-box text-center p-4 text-white">
            <h2 class="text-warning fw-bold mb-4">Setting</h2>
            <div class="mb-3"><i class="bi bi-person-circle fs-1"></i></div>
            <h4><?= $_SESSION['username']; ?></h4>
            <div class="mt-4">
                <p>🔔 Notification</p>
                <a href="edit_profile.php" class="btn btn-outline-light mb-2 w-100">Edit Profile</a>
                <a href="logout.php" class="btn btn-warning mb-2 w-100">Logout</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>