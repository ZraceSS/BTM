<?php
include 'auth.php';
include 'database.php';

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Get current is_done status
$stmt = $pdo->prepare("SELECT is_done FROM tasks WHERE id=? AND user_id=?");
$stmt->execute([$task_id, $user_id]);
$task = $stmt->fetch();

if ($task) {
    $new_status = !$task['is_done'];
    $update = $pdo->prepare("UPDATE tasks SET is_done=? WHERE id=? AND user_id=?");
    $update->execute([$new_status, $task_id, $user_id]);
}

$date = $_GET['date'] ?? date('Y-m-d');
header("Location: candela.php?date=$date");
exit();
?>
