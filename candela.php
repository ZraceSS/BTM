<?php
include 'auth.php';
include 'database.php';

// Get date parameters
$selectedDate = $_GET['date'] ?? date('Y-m-d');
$month = date('m', strtotime($selectedDate));
$year = date('Y', strtotime($selectedDate));
$user_id = $_SESSION['user_id'];

// Tasks for selected date
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? AND due_date=?");
$stmt->execute([$user_id, $selectedDate]);
$tasks_today = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly task dates
$stmt = $pdo->prepare("SELECT DISTINCT due_date FROM tasks WHERE user_id=? AND MONTH(due_date)=? AND YEAR(due_date)=?");
$stmt->execute([$user_id, $month, $year]);
$task_dates = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Calculate previous & next month
$prevMonth = date('m', strtotime("$year-$month-01 -1 month"));
$prevYear = date('Y', strtotime("$year-$month-01 -1 month"));
$nextMonth = date('m', strtotime("$year-$month-01 +1 month"));
$nextYear = date('Y', strtotime("$year-$month-01 +1 month"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candela</title>

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


    <div class="container py-4 text-white">
        <h1 class="text-center text-warning fw-bold">Candela</h1>

        <div class="row justify-content-center my-4">
            <div class="col-md-5">
                <div class="glass-box p-3 text-center">
                    <h2><?= date('l', strtotime($selectedDate)) ?></h2>
                    <h1 class="display-3"><?= date('d', strtotime($selectedDate)) ?></h1>
                    <h4><?= date('F Y', strtotime($selectedDate)) ?></h4>
                </div>

                <!-- Calendar Navigation -->
                <div class="d-flex justify-content-between my-3">
                    <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>&date=<?= $prevYear . '-' . $prevMonth . '-01' ?>"
                        class="btn btn-outline-light">&lt; Prev</a>
                    <h4><?= date('F Y', strtotime("$year-$month-01")) ?></h4>
                    <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>&date=<?= $nextYear . '-' . $nextMonth . '-01' ?>"
                        class="btn btn-outline-light">Next &gt;</a>
                </div>

                <!-- Calendar -->
                <table class="table table-bordered calendar">
                    <thead>
                        <tr><?php foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $d)
                            echo "<th>$d</th>"; ?></tr>
                    </thead>
                    <tbody>
                        <?php
                        $firstDay = date('w', strtotime("$year-$month-01"));
                        $daysInMonth = date('t', strtotime("$year-$month-01"));
                        $dayCounter = 0;

                        echo "<tr>";
                        for ($i = 0; $i < $firstDay; $i++) {
                            echo "<td></td>";
                            $dayCounter++;
                        }

                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                            $hasTask = in_array($dateStr, $task_dates);
                            $selected = ($dateStr === $selectedDate) ? 'selected-date' : '';
                            $taskIcon = $hasTask ? '📑' : '';
                            echo "<td class='$selected' onclick=\"location='?date=$dateStr'\">$day $taskIcon</td>";
                            if (++$dayCounter % 7 == 0)
                                echo "</tr><tr>";
                        }

                        while ($dayCounter % 7 != 0) {
                            echo "<td></td>";
                            $dayCounter++;
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-5">
                <div class="glass-box p-4">
                    <?php if ($tasks_today): ?>
                        <h3>📅 <?= htmlspecialchars($tasks_today[0]['title']) ?></h3>
                        <div class="mt-4">
                            <h5>📋 To Do List</h5>
                            <ul>
                                <?php foreach ($tasks_today as $task): ?>
                                    <li><?= htmlspecialchars($task['description']) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="check_task.php?id=<?= $tasks_today[0]['id'] ?>&date=<?= $selectedDate ?>" class="btn btn-success">✅ Check</a>
                            <a href="edit_task.php?id=<?= $tasks_today[0]['id'] ?>" class="btn btn-warning">✏️ Edit Plan</a>
                            <a href="delete_task.php?id=<?= $tasks_today[0]['id'] ?>&date=<?= $selectedDate ?>" class="btn btn-danger">❌ Remove</a>
                        </div>
                    <?php else: ?>
                        <h3>📅 No Event</h3>
                        <p class="text-center mt-4">Haven’t To-Do List & Gold plan for this day</p>
                        <div class="mt-3 text-center">
                            <a href="make_task.php?date=<?= $selectedDate ?>" class="btn btn-success">✅ Make Plan</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>