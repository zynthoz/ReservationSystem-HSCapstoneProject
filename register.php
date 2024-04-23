<?php
include("connection.php");


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if fullname, email, and contact already exist
if (isset($_POST['submit'])) {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $fullName = $firstName . ' ' . $lastName;
    $email = $_POST['email'];
    $contact = $_POST['contactNo'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM accounts WHERE Username='$fullName' OR Email='$email' OR Phone='$contact'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult) {
        $numRows = mysqli_num_rows($checkResult);
        if ($numRows > 0) {
            echo "<script>alert('Username, email, or contact already exists!'); window.location.href = 'registration.php';</script>";
        } else {
            $query = "INSERT INTO accounts (Username, Password, Email, Phone, Privilege) VALUES ('$fullName', '$password', '$email', '$contact', 'Outsider')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<script>alert('Account created succesfully'); window.location.href = 'index.php';</script>";
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
