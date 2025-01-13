<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
    <title>View Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    // Start session and check login
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    require_once('../database/database.php');
    $db = db_connect();

    // Check if we get the id
    if (!isset($_GET['id'])) {
        header("Location: task_list.php");
        exit();
    }
    
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Get task details (only for current user)
    $sql = "SELECT * FROM tasks WHERE id = '$id' AND user_id = '$user_id'";
    $result_set = mysqli_query($db, $sql);
    $task = mysqli_fetch_assoc($result_set);

    // If task not found or doesn't belong to user
    if (!$task) {
        header("Location: task_list.php");
        exit();
    }
    ?>

    <!-- Header section-->
    <?php include 'header.php'; ?>

    <img src="../images/petpic/xiaoba1.png" id="xiaobaseeyou" alt="cat hachi look at you pic" width="180x">

    <main id="content">
        <a class="back-link" href="mytodo.php">Back to List</a>

        <form class="task show">
            <h1>Task Details</h1>

            <div class="attributes">
                <p><span class="label"><strong>Priority:</strong></span> <span class="value"><?php echo $task['priority']; ?></span></p>
                <p><span class="label"><strong>Task Date:</strong></span> <span class="value"><?php echo $task['task_date']; ?></span>
                </p>
                <p><span class="label"><strong>Due Date:</strong></span> <span class="value"><?php echo $task['due_date']; ?></span></p>
                <p><span class="label"><strong>Content:</strong></span> <span class="value"><?php echo $task['content']; ?></span></p>
                <p><span class="label"><strong>Memo:</strong></span> <span class="value"><?php echo $task['memo']; ?></span></p>
            </div>

            <!-- Add edit and delete links -->
            <div class="actions">
                <a class="action" href="<?php echo "edit_task.php?id=" . $task['id']; ?>">Edit</a>
                <a class="action" href="<?php echo "delete_task.php?id=" . $task['id']; ?>">Delete</a>
            </div>
        </form>
    </main>

    <?php include 'footer.php'; ?>

    <?php db_disconnect($db); ?>
</body>
</html>