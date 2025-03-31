<?php
include 'auth.php';
include 'database.php';

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete task
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id=? AND user_id=?");
$stmt->execute([$task_id, $user_id]);

header("Location: candela.php?date=".$_GET['date']);
exit();
?>
