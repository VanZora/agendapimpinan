<?php
require 'function.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} else {
    $username = $_SESSION["user"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    header("Location: dataview/index.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="logout.php">Logout</a>
</body>

</html>