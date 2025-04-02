<?php
session_start();
if (isset($_SESSION['user_id']))
{
    header("Location: index.php");
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $repassword = password_hash($_POST["repassword"], PASSWORD_DEFAULT);


    if ($_POST["password"] != $_POST["repassword"]) {
        header("Location: register.php?signup=warning&returnText=Password miss match.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        header("Location: login.php?signup=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up | Better Time Manager</title>

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
    <?php include 'navbar.php'; ?>

    <!-- Background Image -->
    <div class="bg-image"></div>

    <?php if (isset($_GET['signup']) && isset($_GET['returnText'])): ?>
        <div class="alert alert-<?= $_GET['signup']; ?> text-center">
            <?php
            if ($_GET['signup'] == 'warning')
                echo $_GET['returnText'];
            ?>
        </div>
    <?php endif; ?>

    <!-- Sign-Up Form -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg bg-dark text-white" style="max-width: 400px; width: 100%; border-radius: 12px;">
            <h2 class="text-center text-warning fw-bold">Create an Account</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control form-control-lg" name="username" id="username"
                        placeholder="Choose a username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="repassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control form-control-lg" name="repassword" id="repassword"
                        placeholder="Re-enter password" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold py-2">SIGN UP</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php" class="text-warning">Log In</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>