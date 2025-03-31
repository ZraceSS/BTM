<?php
include 'auth.php';
include 'database.php';

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
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="glass-box text-white p-4" style="width: 400px;">
            <h2 class="text-warning text-center">Make Task</h2>
            <form method="POST">
                <input name="title" class="form-control mb-3" placeholder="Title" required>
                <textarea name="desc" class="form-control mb-3" placeholder="Description"></textarea>
                <input name="date" type="date" class="form-control mb-3" required>
                <button type="submit" class="btn btn-success w-100">Create</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>