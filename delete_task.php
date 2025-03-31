<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];
$date = $_GET['date'] ?? date('Y-m-d');

// Delete ALL tasks (todo & gold) for selected day
$stmt = $pdo->prepare("DELETE FROM tasks WHERE user_id=? AND due_date=?");
$stmt->execute([$user_id, $date]);

if ($stmt->rowCount()) {
    // Tasks deleted
    header("Location: candela.php?date=$date&deleted=all");
} else {
    // No tasks to delete
    header("Location: candela.php?date=$date&deleted=none");
}
exit();
?>
