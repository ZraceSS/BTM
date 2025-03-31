<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];
$date = $_GET['date'];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? AND due_date=?");
$stmt->execute([$user_id, $date]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$todo_tasks = implode("\n", array_column(array_filter($tasks, fn($t) => $t['list_type'] == 'todo'), 'description'));
$gold_tasks = implode("\n", array_column(array_filter($tasks, fn($t) => $t['list_type'] == 'gold'), 'description'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<bodys>

    <?php include 'navbar.php'; ?>
    <!-- Background Image -->
    <div class="bg-image"></div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="glass-box text-center p-4 text-white" style="width:600px;">
            <h1 class="text-warning">Edit-Task</h1>
            <form method="POST" action="process_edit_task.php">
                <input type="hidden" name="due_date" value="<?= $date ?>">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>To-Do List</h5>
                        <textarea name="todo_list" class="form-control"
                            rows="5"><?= htmlspecialchars($todo_tasks) ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-warning">Gold-Plan List</h5>
                        <textarea name="gold_list" class="form-control"
                            rows="5"><?= htmlspecialchars($gold_tasks) ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Done</button>
                <a href="candela.php" class="btn btn-danger mt-4">Cancel</a>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</bodys>

</html>