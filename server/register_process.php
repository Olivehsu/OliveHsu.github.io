<?php
require_once('../database/database.php');

// register
function register_user($username, $password)
{
    $connection = db_connect();

    //insert new user to db
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $result = $stmt->execute();

    // disconnect
    db_disconnect($connection);

    return $result;
}

// check if username has existed in db
function username_exists($username)
{
    $connection = db_connect();

    // search same username in db
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $exists = $result->num_rows > 0;

    db_disconnect($connection);

    return $exists;
}

// check form post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // check password match
    if ($password !== $password2) {
        exit("Password doesn't match. Please try again.");
    }

    // check username
    if (username_exists($username)) {
        exit("Username has already existed. Please try another one.");
    }

    if (register_user($username, $password)) {
        header("Location: login.php");
        exit();
    } else {
        echo "registration failed. Please try again later.";
    }
}
?>
