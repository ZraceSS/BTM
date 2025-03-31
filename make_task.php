<?php
include 'auth.php';
include 'database.php';

$currentDate = $_GET['date'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $desc, $date]);

    header("Location: candela.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Maker</title>

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
    
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="glass-box text-center p-4 text-white" style="width:600px;">
            <h1 class="text-warning">Make-Task</h1>
            <form method="POST" action="process_make_task.php">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>To-Do List</h5>
                        <textarea name="todo_list" class="form-control" rows="5"
                            placeholder="Enter To-Do tasks, each in new line"></textarea>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-warning">Gold-Plan List</h5>
                        <textarea name="gold_list" class="form-control" rows="5"
                            placeholder="Enter Gold-Plan tasks, each in new line"></textarea>
                    </div>
                </div>
                <input type="date" name="due_date" class="form-control mt-3" value="<?= $currentDate; ?>" required>
                <button type="submit" class="btn btn-success mt-4">Done</button>
                <a href="candela.php" class="btn btn-danger mt-4">Cancel</a>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>