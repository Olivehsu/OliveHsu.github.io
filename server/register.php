<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <title>Task Management - Register</title>
    <style>
        .warning {
            color: rgb(254, 85, 85) !important;
            font-size: 0.8rem;
            padding: 0 1rem;
            text-align: left;
        }
        .error-border {
            border: 2px solid rgb(254, 85, 85) !important;
        }
    </style>
</head>

<body>
    <!-- Header section-->
    <?php include 'header.php'; ?>

    <img src="../images/petpic/xiaoba2.png" id="xiaobatrap" alt="cat trapped pic" width="150x">

    <main id="register">

        <h1>Welcome aboard!</h1>
        <h2>Let's tackle those tasks.</h2>
        <h2>Ready to get things done?</h2>

        <!-- login in link-->
        <div class="login">
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </div>

        <div class="formcontainer">

        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;">
                <?php
                switch ($_GET['error']) {
                    case 'password_mismatch':
                        echo "Password not matches.";
                        break;
                    case 'username_exists':
                        echo "Username already existed. Try another one.";
                        break;
                    default:
                        echo "Registration failed. Please try again later.";
                        break;
                }
                ?>
            </p>
        <?php endif; ?>
        
            <!-- Registration Form -->
            <form action="register_process.php" method="post">
                
                <!-- Email Address -->
                <div class="textfield">
                    <input type="text" name="email" id="email" placeholder="Email" required>
                </div>

                <!-- User Name -->
                <div class="textfield">
                    <input type="text" name="username" id="username" placeholder="User name" required>
                </div>

                <!-- Password -->
                <div class="textfield">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            
                <!-- Confirm Password -->
                <div class="textfield">
                    <input type="password" name="password2" id="password2" placeholder="Re-type your password" required>
                </div>

                <!-- Terms and Conditions Agreement -->
                <div class="checkbox">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">I agree to the terms and conditions</label>
                </div>

                <!-- Submit and Reset Buttons -->
                <button type="submit">Register</button>
                <button type="reset">Reset</button>
            </form>
        </div>

    </main>

    <?php include 'footer.php'; ?>

    <script src="../scripts/register.js"></script>
</body>

</html>
