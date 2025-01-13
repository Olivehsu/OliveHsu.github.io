<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" >
    <head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>
    <title>Support Us</title>
</head>

<body>
    <!-- Header section-->
    <?php include 'header.php'; ?>

    <img src="../images/petpic/xiaomaodamao.png" width="180px" id="xiaomaodamao" alt="cat daxiao pic">

    <main id="donation">
        <h1>Support Us</h1>
        <p>Thank you for considering supporting our work!</p>
        <p>You can make a donation in the form of a coffee or a meal.</p>
    
        <!-- Donation options -->
        <form action="donation_process.php" method="post" id="donationform">
            <label>
                <input type="checkbox" name="donation[]" value="coffee"> Coffee ($5)
            </label>
            <br><br>
            <label>
                <input type="checkbox" name="donation[]" value="meal"> Meal ($20)
            </label>
            <br><br>
    
            <!-- Submit button for donation -->
            <button type="submit">Donate</button>
        </form>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
