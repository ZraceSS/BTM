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


    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-<?= $_GET['deleted'] == 'all' ? 'success' : 'danger' ?> text-center">
            <?php
            if ($_GET['deleted'] == 'all')
                echo '✅ All tasks for this day were successfully removed!';
            elseif ($_GET['deleted'] == 'none')
                echo '⚠️ No tasks found to remove for this day.';
            ?>
        </div>
    <?php endif; ?>



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
                            $selected = ($dateStr === $selectedDate) ? 'selected-date' : '';
                        
                            // Check if there are any tasks for this date
                            $stmt = $pdo->prepare("SELECT COUNT(*) as total, SUM(is_done) as done FROM tasks WHERE user_id=? AND due_date=?");
                            $stmt->execute([$user_id, $dateStr]);
                            $taskStats = $stmt->fetch();
                        
                            $hasTasks = $taskStats['total'] > 0;
                            $allDone = $taskStats['total'] > 0 && $taskStats['total'] == $taskStats['done'];
                        
                            $icon = $allDone ? '✅' : ($hasTasks ? '📑' : '');
                        
                            echo "<td class='$selected' onclick=\"location='?date=$dateStr&month=$month&year=$year'\">$day $icon</td>";
                        
                            if (++$dayCounter % 7 == 0) echo "</tr><tr>";
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
                        <h3>📅 Event on <?= date('F d, Y', strtotime($selectedDate)) ?></h3>

                        <div class="mt-3">
                            <h5>🗒️ To-Do List</h5>
                            <ul class="list-group">
                                <?php foreach ($tasks_today as $task): ?>
                                    <?php if ($task['list_type'] === 'todo'): ?>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-white border-light">
                                            <span>
                                                <?= htmlspecialchars($task['description']) ?>
                                                <?php if ($task['is_done']): ?>
                                                    ✅
                                                <?php endif; ?>
                                            </span>
                                            <a href="check_task.php?id=<?= $task['id'] ?>&date=<?= $selectedDate ?>"
                                                class="btn btn-sm btn-success">
                                                <?= $task['is_done'] ? 'Undo' : 'Check' ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>


                        <div class="mt-3">
                            <h5>⭐ Gold Plan</h5>
                            <ul class="list-group">
                                <?php foreach ($tasks_today as $task): ?>
                                    <?php if ($task['list_type'] === 'gold'): ?>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-white border-light">
                                            <span>
                                                <?= htmlspecialchars($task['description']) ?>
                                                <?php if ($task['is_done']): ?>
                                                    ✅
                                                <?php endif; ?>
                                            </span>
                                            <a href="check_task.php?id=<?= $task['id'] ?>&date=<?= $selectedDate ?>"
                                                class="btn btn-sm btn-success">
                                                <?= $task['is_done'] ? 'Undo' : 'Check' ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>



                        <div class="mt-4 text-center">
                            <a href="edit_task.php?date=<?= $selectedDate ?>" class="btn btn-warning">✏️ Edit Plan</a>
                            <a href="delete_task.php?date=<?= $selectedDate ?>"
                                onclick="return confirm('⚠️ Are you sure you want to remove ALL tasks for this day? This cannot be undone!');"
                                class="btn btn-danger">
                                ❌ Remove
                            </a>
                        </div>
                    <?php else: ?>
                        <h3>No tasks for today!</h3>
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