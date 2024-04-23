<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "accountsdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// Insert input data to Table
if(isset($_POST['submit'])) {
    $facility = $_POST['facility'];
    $floor = $_POST['floor'];
    $description = $_POST['description'];
    $access = $_POST['access'];
    $query = "INSERT INTO facilities VALUES('', '$facility', '$floor', '$access', '$description')";
}
mysqli_query($conn, $query);
header('location: home.php?admin');
exit;
?>
