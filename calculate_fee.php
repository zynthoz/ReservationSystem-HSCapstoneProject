<?php
session_start();
include("connection.php"); // Assuming this file contains your database connection code

if(isset($_POST['reservation_fee']) && isset($_SESSION["username"])) {
    $reservationFee = $_POST['reservation_fee'];
    $username = $_SESSION["username"];

    // Perform necessary database operations to store the reservation fee
    // For example, you can insert it into a table associated with the user
    $query = "INSERT INTO reservation_fees (username, fee) VALUES ('$username', $reservationFee)";
    if(mysqli_query($conn, $query)) {
        echo "Reservation fee stored successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>