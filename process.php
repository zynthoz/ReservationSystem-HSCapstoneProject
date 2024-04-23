<?php
session_start();
include("connection.php");

// Insert input data to Table
if (isset($_POST['submit'])) {
    $name = $_SESSION['username'];
    $facility = $_POST['facility'];
    $startDate = $_POST['reservation-date-start'];
    $endDate = $_POST['reservation-date-end'];
    $purpose = $_POST['purpose'];
    $totalFee = $_POST['totalFee'];
    $reservationDate = $_POST['reservationDate'];

    $payment_name = $_FILES['payment_file']['name'];
    $payment_size = $_FILES['payment_file']['size'];
    $payment_tmpName = $_FILES['payment_file']['tmp_name'];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $payment_name);
    $imageExtension = strtolower(end($imageExtension));

    if(!in_array($imageExtension, $validImageExtension)){
        echo
        "<script> alert('Invalid Image Extension'); </script>";
    }
    else if($payment_size > 5000000){
        echo
        "<script> alert('Image Size Is Too Large'); </script>";
        echo
        "<meta http-equiv='refresh' content='0; url=home.php?facility-list=Facilities'>";
    }
    else {
        $new_payment_name = uniqid();
        $new_payment_name .= '.' . $imageExtension;

        move_uploaded_file($payment_tmpName, 'img/' . $new_payment_name);

    // Check for duplicates
    $duplicateQuery = "SELECT * FROM reservations WHERE Facility = '$facility' AND Status = 'Reserved' AND StartDate = '$startDate' AND EndDate = '$endDate'";
    $result = mysqli_query($conn, $duplicateQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Duplicate entry!') </script>";
        echo "<meta http-equiv='refresh' content='0; url=home.php?facilityReserve'>";
    } else {
        // Check for overlapping reservations
        $overlapQuery = "SELECT * FROM reservations WHERE Facility = '$facility' AND Status = 'Reserved' AND ((StartDate <= '$startDate' AND EndDate >= '$startDate') OR (StartDate <= '$endDate' AND EndDate >= '$endDate'))";
        $overlapResult = mysqli_query($conn, $overlapQuery);
        if (mysqli_num_rows($overlapResult) > 0) {
            echo "<script> alert('Overlap with existing reservation!') </script>";
            echo "<meta http-equiv='refresh' content='0; url=home.php?facilityReserve'>";
        } else {
            $query = "INSERT INTO reservations (Name, StartDate, EndDate, Facility, Status, Reason, Fee, Payment, ReservationDate) VALUES
            ('$name', '$startDate', '$endDate', '$facility', 'Pending', '$purpose', '$totalFee', '$new_payment_name', '$reservationDate')";

            if (mysqli_query($conn, $query)) {
                echo "<script> alert('Facility requested, please wait for approval') </script>";
                echo "<meta http-equiv='refresh' content='0; url=home.php?facility-list=Facilities'>";
                
            } else {
                echo "<script> alert('Error inserting  " . mysqli_error($conn) . "') </script>";
            }
            
        }
    }
}


}

mysqli_close($conn);
?>