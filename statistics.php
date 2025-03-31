<?php
include 'auth.php';
include 'database.php';

// Simple statistics (tasks done/total)
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM tasks WHERE user_id=?");
$stmt->execute([$user_id]);
$totalTasks = $stmt->fetchColumn();

$stmtDone = $pdo->prepare("SELECT COUNT(*) FROM tasks WHERE user_id=? AND is_done=1");
$stmtDone->execute([$user_id]);
$completedTasks = $stmtDone->fetchColumn();

$percentComplete = $totalTasks ? round(($completedTasks / $totalTasks) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static</title>

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

    <div class="container text-center text-white vh-100 d-flex align-items-center justify-content-center">
        <div class="glass-box p-5">
            <h2 class="text-warning">Statistics & Productivity</h2>
            <p>Tasks Completed: <?= $completedTasks ?> / <?= $totalTasks ?></p>
            <div class="progress bg-dark mb-3" style="height: 30px;">
                <div class="progress-bar bg-success" style="width: <?= $percentComplete ?>%;"><?= $percentComplete ?>%
                </div>
            </div>
            <a href="candela.php" class="btn btn-warning">Manage Tasks</a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>