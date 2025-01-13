<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" >
    <title>Task Management Homepage</title>
    <script src="../scripts/index.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>
</head>
<body id="todolist">

    <!-- Header section-->
    <?php include 'header.php'; ?>

    <img src="../images/petpic/ao3.png" id="douyawalking" width="300px" alt="aodouya walking pic">

    <main id="quadrants">
        <!-- add the event Four quadrants layout for task display --> 
        <div class="quadrants">
            <div class="quadrant" id="urgent-important" onclick="redirectToTaskPage('Urgent & Important')">
                <h2>Urgent & Important</h2>
            </div>
            <div class="quadrant" id="not-urgent-important" onclick="redirectToTaskPage('Not Urgent but Important')">
                <h2>Not Urgent but Important</h2>
            </div>
            <div class="quadrant" id="urgent-not-important" onclick="redirectToTaskPage('Urgent but Not Important')">
                <h2>Urgent but Not Important</h2>
            </div>
            <div class="quadrant" id="not-urgent-not-important" onclick="redirectToTaskPage('Not Urgent & Not Important')">
                <h2>Not Urgent & Not Important</h2>
            </div>
        </div>
    </main>

    <!-- Footer section with creator information -->

    <?php include 'footer.php'; ?>
</body>
</html>
