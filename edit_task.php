<?php
include 'auth.php';
include 'database.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$task = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];

    $stmt = $pdo->prepare("UPDATE tasks SET title=?, description=?, due_date=? WHERE id=? AND user_id=?");
    $stmt->execute([$title, $desc, $date, $id, $user_id]);

    header("Location: candela.php");
    exit();
}
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
    
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="glass-box text-white p-4" style="width: 400px;">
            <h2 class="text-warning text-center">Edit Task</h2>
            <form method="POST">
                <input name="title" class="form-control mb-3" value="<?= $task['title']; ?>" required>
                <textarea name="desc" class="form-control mb-3"><?= $task['description']; ?></textarea>
                <input name="date" type="date" class="form-control mb-3" value="<?= $task['due_date']; ?>" required>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success w-50 me-2">Update</button>
                    <a href="candela.php" class="btn btn-danger w-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</bodys>

</html>