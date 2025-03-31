<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];

$total_tasks = $pdo->prepare("SELECT COUNT(*) FROM tasks WHERE user_id=?");
$total_tasks->execute([$user_id]);
$total_tasks_count = $total_tasks->fetchColumn();

$completed_tasks = $pdo->prepare("SELECT COUNT(*) FROM tasks WHERE user_id=? AND is_done=1");
$completed_tasks->execute([$user_id]);
$completed_tasks_count = $completed_tasks->fetchColumn();

$completion_rate = $total_tasks_count ? round(($completed_tasks_count / $total_tasks_count) * 100) : 0;
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

    <div class="container py-5 text-white">
        <h1 class="text-warning text-center fw-bold">📊 Productivity Statistics 📊</h1>

        <div class="glass-box p-5 mt-5 text-center">
            <h4>Total Tasks: <strong><?= $total_tasks_count ?></strong></h4>
            <h4>Completed Tasks: <strong><?= $completed_tasks_count ?></strong></h4>

            <div class="progress my-4" style="height: 30px;">
                <div class="progress-bar bg-success" style="width: <?= $completion_rate ?>%;">
                    <?= $completion_rate ?>%
                </div>
            </div>

            <?php if ($completion_rate >= 80): ?>
                <p class="text-success">Great job! 🎉 Keep it up!</p>
            <?php elseif ($completion_rate >= 50): ?>
                <p class="text-warning">Good work! But you can do even better. 🚀</p>
            <?php else: ?>
                <p class="text-danger">Let's push a bit more! You've got this! 💪</p>
            <?php endif; ?>

            <a href="candela.php" class="btn btn-warning mt-3">Manage Your Tasks</a>
        </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>