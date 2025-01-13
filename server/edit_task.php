
<?php
//set timezone
date_default_timezone_set('America/Toronto');
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../database/database.php');
$db = db_connect();

if (!isset($_GET['id'])) {
    header("Location: mytodo.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $priority = $_POST['priority'];
    $task_date = $_POST['task_date'];
    $due_date = $_POST['due_date'];
    $content = $_POST['content'];
    $memo = $_POST['memo'] ?? '';

    // Update the task
    $sql = "UPDATE tasks SET 
            priority = '$priority',
            task_date = '$task_date',
            due_date = '$due_date',
            content = '$content',
            memo = '$memo'
            WHERE id = '$id' AND user_id = '$user_id'";
            
    $result = mysqli_query($db, $sql);
    if($result) {
        header("Location: mytodo.php");
        exit();
    }
} else {
    // Get the task data
    $sql = "SELECT * FROM tasks WHERE id = '$id' AND user_id = '$user_id'";
    $result_set = mysqli_query($db, $sql);
    $task = mysqli_fetch_assoc($result_set);

    if (!$task) {
        header("Location: mytodo.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <title>Edit Task</title>
</head>
<body class="addtask">
    <!-- Header section-->
    <?php include 'header.php'; ?>

    <main id="addtask">
        <h1>Edit Task</h1>

        <form action="<?php echo 'edit_task.php?id=' . $task['id']; ?>" method="post" id="addtaskform">
            <div class="grid-container">
                <div class="form-group full-width">
                    <label for="priority">Priority</label>
                    <input type="text" id="priority" name="priority" value="<?php echo $task['priority']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="task_date">Date</label>
                    <input type="date" id="task_date" name="task_date" value="<?php echo $task['task_date']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="due_date">Deadline (DDL)</label>
                    <input type="date" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>" required>
                </div>

                <div class="form-group full-width">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="4" required><?php echo $task['content']; ?></textarea>
                </div>

                <div class="form-group full-width">
                    <label for="memo">Memo (optional)</label>
                    <textarea id="memo" name="memo" rows="4"><?php echo $task['memo']; ?></textarea>
                </div>

                <div class="button-container full-width">
                    <button type="submit">Update Task</button>
                    <button type="reset">Reset</button>
                </div>
            </div>
        </form>

        <img src="../images/petpic/ao5.png" id="aostanding" alt="douya skiing pic" width="200px">
    </main>


    <footer>
        <p>&copy; 2024 Task Management App. Crafted with care by Lanfang Xu, Ninglu Zhou, and Yimi Ding. All rights reserved.</p>
    </footer>

</body>
</html>

<?php 
db_disconnect($db);
?>