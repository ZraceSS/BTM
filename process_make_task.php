<?php
include 'auth.php';
include 'database.php';

$user_id = $_SESSION['user_id'];
$due_date = $_POST['due_date'];

function addTasks($pdo, $user_id, $due_date, $tasks, $type) {
  foreach(explode("\n", trim($tasks)) as $task_desc) {
    if(trim($task_desc)) {
      $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, due_date, list_type) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$user_id, $task_desc, $task_desc, $due_date, $type]);
    }
  }
}

if(!empty($_POST['todo_list'])) {
  addTasks($pdo, $user_id, $due_date, $_POST['todo_list'], 'todo');
}

if(!empty($_POST['gold_list'])) {
  addTasks($pdo, $user_id, $due_date, $_POST['gold_list'], 'gold');
}

header("Location: candela.php?date=$due_date");
exit();
?>
