<?php
require 'connection.php';
if(isset($_POST['submit'])) {
    mysqli_query($conn, "UPDATE facilities set Facility='" . $_POST['facility'] . "', Floor='" . $_POST['floor'] . "',
    Description='" . $_POST['description'] . "', Access='" . $_POST['access'] . "' WHERE id='" . $row['id'] . "'");
}