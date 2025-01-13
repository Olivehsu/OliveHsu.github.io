<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo List</title>
    <link rel="stylesheet" href="../style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    // Connect to the database
    require_once('../database/database.php');
    $db = db_connect();

    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];

    // Handle search and filter inputs
    $search_query = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
    $filter_priority = isset($_GET['filter_priority']) ? mysqli_real_escape_string($db, $_GET['filter_priority']) : '';

    // Build the SQL query
    $sql = "SELECT * FROM tasks WHERE user_id = '$user_id'";
    if (!empty($search_query)) {
        $sql .= " AND content LIKE '%$search_query%'";
    }
    if (!empty($filter_priority)) {
        $sql .= " AND priority = '$filter_priority'";
    }
    $sql .= " ORDER BY due_date ASC";

    $result_set = mysqli_query($db, $sql);

    if (!$result_set) {
        echo "Error retrieving tasks: " . mysqli_error($db);
        exit();
    }
    ?>

    <!-- Header section-->
    <?php include 'header.php'; ?>

    <div class="page-container">
        <main id="content">
            <h1>My To-Do List</h1>

            <!-- Search and Filter Form -->
            <form method="GET" action="mytodo.php" class="search-filter-form" id="filter">
                <input type="text" name="search" placeholder="Search by content"  
                value="<?php echo htmlspecialchars($search_query); ?>">
                <select name="filter_priority">
                    <option value="">Filter by priority</option>
                    <option value="Urgent & Important" <?php if ($filter_priority == 'Urgent & Important') echo 'selected'; ?>>
                        Urgent & Important
                    </option>
                    <option value="Not Urgent but Important" <?php if ($filter_priority == 'Not Urgent but Important') echo 'selected'; ?>>
                        Not Urgent but Important
                    </option>
                    <option value="Urgent but Not Important" <?php if ($filter_priority == 'Urgent but Not Important') echo 'selected'; ?>>
                        Urgent but Not Important
                    </option>
                    <option value="Not Urgent & Not Important" <?php if ($filter_priority == 'Not Urgent & Not Important') echo 'selected'; ?>>
                        Not Urgent & Not Important
                    </option>
                </select>
                <button type="submit">Apply</button>
                <button type="button" onclick="window.location.href='mytodo.php'">Reset</button>
            </form>

            <a class="back-link" href="index.php">Add New Task</a>

            <!-- Task List -->
            <div class="task-list">
                <?php while ($task = mysqli_fetch_assoc($result_set)) { ?>
                    <div class="task-card">
                        <h2><?php echo htmlspecialchars($task['content']); ?></h2>
                        <dl>
                            <dt>Priority</dt>
                            <dd><?php echo htmlspecialchars($task['priority']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Task Date</dt>
                            <dd><?php echo htmlspecialchars($task['task_date']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Due Date</dt>
                            <dd><?php echo htmlspecialchars($task['due_date']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Content</dt>
                            <dd><?php echo htmlspecialchars($task['content']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Memo</dt>
                            <dd><?php echo htmlspecialchars($task['memo']); ?></dd>
                        </dl>
                        <div class="actions">
                            <a href="edit_task.php?id=<?php echo (int)$task['id']; ?>">Edit</a>
                            <a href="delete_task.php?id=<?php echo (int)$task['id']; ?>">Delete</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>

        <img src="../images/petpic/ao2.png" id="aolookatyou" alt="dog douya look at you pic" width="280">
    </div>

    <?php
    // Free result set and close the database connection
    mysqli_free_result($result_set);
    db_disconnect($db);
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>