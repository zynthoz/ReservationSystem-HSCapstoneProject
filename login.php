<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

// verify login
$query = "SELECT * FROM accounts WHERE email='$email' AND password='$password'";

$result = $conn->query($query);

// Fetch the user data
if ($row = $result->fetch_assoc()) {
    // Store the username in the session variable
    $_SESSION['username'] = $row['Username'];
    $_SESSION['privilege'] = $row['Privilege'];
}

if ($result->num_rows == 1) {
    header("Location: home.php");
    exit();
} else {
    $_SESSION['error'] = true;
    header('Location: index.php');
    exit;
}
