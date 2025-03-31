<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];

// Fetch Gold Plan tasks for the current month
$month = date('m');
$year = date('Y');

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? AND list_type='gold' AND MONTH(due_date)=? AND YEAR(due_date)=?");
$stmt->execute([$user_id, $month, $year]);
$gold_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal Plan</title>

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
        <h1 class="text-warning text-center fw-bold">✨ Gold Plan ✨</h1>

        <div class="glass-box p-4 mt-5">
            <?php if ($gold_tasks): ?>
                <ul class="list-group">
                    <?php foreach ($gold_tasks as $task): ?>
                        <li class="list-group-item bg-transparent text-white d-flex justify-content-between">
                            <span><?= htmlspecialchars($task['title']) ?></span>
                            <span><?= date('F d, Y', strtotime($task['due_date'])) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h5 class="text-center">You haven't set any Gold Plans yet this month!</h5>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>