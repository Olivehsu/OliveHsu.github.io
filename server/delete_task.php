
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../database/database.php');

$db = db_connect();

if(!isset($_GET['id'])) {
    header("Location: index.php");
}
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// If we decided to delete, execute delete query and redirect to the main page
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM tasks WHERE id = '$id' AND user_id = '$user_id'";
    $result = mysqli_query($db, $sql);
    header("Location: index.php");
} else {
    // Get the task data to confirm deletion
    $sql = "SELECT * FROM tasks WHERE id = '$id' AND user_id = '$user_id'";
    $result_set = mysqli_query($db, $sql);
    $task = mysqli_fetch_assoc($result_set);
    
    // If task not found or doesn't belong to user
    if (!$task) {
        header("Location: index.php");
    }
}
?>

<img src="../images/petpic/xiaomao1.png" id="xiaomao1pic" width="200px" alt="xiaomao lying pic">

<main id="content">
    <a class="back-link" href="index.php">&laquo; Back to Task List</a>

    <div class="task_delete">
        <h1>Delete Task</h1>
        <p>Are you sure you want to delete this task?</p>
        <p class="item">
            <?php echo $task['content']; ?>
        </p>

        <form action="<?php echo 'delete_task.php?id=' . $task['id']; ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Task" />
            </div>
        </form>
    </div>
</main>

<?php 
include 'footer.php';
db_disconnect($db);
?>
</body>
</html>