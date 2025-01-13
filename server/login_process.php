<?php
require_once('../database/db_credentials.php');
require_once('../database/database.php');


// validate login
function validate_login($username, $password)
{
    $connection = db_connect();

    // search user in db
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->num_rows > 0 ? $result->fetch_assoc() : null;

    // disconnect
    db_disconnect($connection);

    return $user;
}

// check form post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // validate login
    $user = validate_login($username, $password);

    if ($user) {
        // login succeed
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        // login failed
        echo "Username or password incorrect. Please try again.";
        header("Location: login.php?error=1");
        exit();
    }
}
?>

