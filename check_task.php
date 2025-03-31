<?php
include 'auth.php';
include 'database.php';

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Get current status
$stmt = $pdo->prepare("SELECT is_done FROM tasks WHERE id=? AND user_id=?");
$stmt->execute([$task_id, $user_id]);
$task = $stmt->fetch();

if ($task) {
    // Toggle status
    $new_status = !$task['is_done'];
    $stmtUpdate = $pdo->prepare("UPDATE tasks SET is_done=? WHERE id=? AND user_id=?");
    $stmtUpdate->execute([$new_status, $task_id, $user_id]);
}

header("Location: candela.php?date=".$_GET['date']);
exit();
?>
