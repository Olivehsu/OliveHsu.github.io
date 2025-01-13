<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>

    <!-- Header section-->
    <?php include 'header.php'; ?>

    <img src="../images/petpic/xiaomao2.png" id="xiaomao2" alt="xiaomao pic" width="200px">

    <!-- Login form -->
    <main id="login">
        <heading>
        <h1>Let's sign you in.</h1>
        <h2>Hello again! </h2>
        <h2>Ready to continue?</h2>
        </heading>

        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;">Username or password incorrect. Please try again.</p>
        <?php endif; ?>

        <form action="login_process.php" method="post">
            <!-- Username field -->
            <input type="text" placeholder="Phone, email or username" id="username" name="username" required>
            <!-- Password field -->
            <input type="password" placeholder="Password" id="password" name="password" required>
            <!-- Buttons -->
            <button type="submit">Sign in</button>
            <button type="reset">Reset</button> <!-- This button resets the entire form -->
        </form>

        <!--registration link-->
        <div class="register">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>

        <div id="intro">
            <div id="logo">
                <img src="../images/icons/home.png" width="400px" alt="logo">
            </div>
            <div id="text">
                <h2>Make your life easier, one paw at a time!</h2>
                <h3>Sort your to-dos:</h3>
                <ul>
                    <li>Top Priority</li>
                    <li>Important-ish</li>
                    <li>Can Wait</li>
                    <li>Meh, Later</li>
                </ul>
                <p>Ready? 
                    <a href="index.php">Add a task</a> or 
                    <a href="register.php"> join the pack</a> !
                </p>

            </div>
        </div>

    </main>

    <?php include 'footer.php'; ?>

</body>

</html>
