<?php
//set timezone
date_default_timezone_set('America/Toronto');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Add Task</title>
    <script src="../scripts/add_task.js"></script> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>

<body class="addtask">

    <!-- Header section-->
    <?php include 'header.php'; ?>


    <main id="addtask">
        <!-- New Task form -->
        <h1>Add a New Task</h1>
    
        <form action="create_task.php" method="post" id="addtaskform">
            <div class="grid-container">
                <!-- Priority field -->
                <div class="form-group full-width">
                    <label for="priority">Priority</label>
                    <!-- christy -->
                    <input type="text" id="priority" name="priority">
                    <!-- <input type="text" id="priority" name="priority" value="Auto-set based on quadrant" readonly> -->
                </div>
    
                <!-- Date field -->
                <div class="form-group">
                    <label for="task_date">Date</label>
                    <input type="date" id="task_date" name="task_date" value="<?php echo date('Y-m-d'); ?>" required>

                </div>
    
                <!-- Deadline (DDL) field -->
                <div class="form-group">
                    <label for="due_date">Deadline (DDL)</label>
                    <input type="date" id="due_date" name="due_date" required>
                </div>
    
                <!-- Task description -->
                <div class="form-group full-width">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="4" required></textarea>
                </div>
    
                <!-- Optional memo field -->
                <div class="form-group full-width">
                    <label for="memo">Memo (optional)</label>
                    <textarea id="memo" name="memo" rows="4"></textarea>
                </div>
    
                <!-- Buttons -->
                <div class="button-container full-width">
                    <button type="submit">Add Task</button>
                    <button type="reset">Reset</button>
                </div>
            </div>
        </form>

        <img src="../images/petpic/ao4.png" id="douyastart" alt="douya adventure pic" width="180px">
    </main>

    <!-- Footer section with creator information -->
    <?php include 'footer.php'; ?>
</body>
</html>