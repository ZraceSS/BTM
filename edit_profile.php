<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle update form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = $_POST['password'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET username=?, email=?, password_hash=? WHERE id=?";
        $params = [$new_username, $new_email, $hashed_password, $user_id];
    } else {
        $query = "UPDATE users SET username=?, email=? WHERE id=?";
        $params = [$new_username, $new_email, $user_id];
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    $_SESSION['username'] = $new_username;
    header("Location: account.php?updated=true");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

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
        <div class="glass-box text-white p-4" style="width: 400px;">
            <h2 class="text-warning fw-bold text-center mb-4">Edit Profile</h2>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control text-center" placeholder="Username"
                        value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control text-center" placeholder="Email"
                        value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control text-center" placeholder="New Password">
                </div>
                <div class="mb-4">
                    <input type="password" name="confirm" class="form-control text-center"
                        placeholder="Re-enter Password">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success w-50 me-2">Done</button>
                    <a href="account.php" class="btn btn-danger w-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>