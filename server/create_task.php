<?php
// Start session at the beginning
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once('../database/database.php');
$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user_id from session
    $user_id = $_SESSION['user_id'];
    $priority = $_POST['priority'];
    $task_date = $_POST['task_date'];
    $due_date = $_POST['due_date'];
    $content = $_POST['content'];
    $memo = $_POST['memo'] ?? '';

    $sql = "INSERT INTO tasks (user_id, priority, task_date, due_date, content, memo) 
            VALUES ('$user_id', '$priority', '$task_date', '$due_date', '$content', '$memo')";
    
    $result = mysqli_query($db, $sql);

    if($result) {
        header("Location: show_task.php?id=" . mysqli_insert_id($db));
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

db_disconnect($db);
?>