<?php
include 'connection.php';
include 'header.php';

$username = $email = $password = '';
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$sql = "insert into users (username, email, password) values ('$username', '$email', '$password')";
$results = mysqli_query($db, $sql);
if (!$results)
    die('Sign in failed');
else {
    echo "Account created successfully.<br>";
    echo "You will be redirected in 3 seconds...";
    // sleep(10);
    redirect("index.php");
}

include 'footer.php';