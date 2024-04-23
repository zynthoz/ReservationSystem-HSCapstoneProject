<?php
require 'connection.php';
if (isset($_GET['deleteId'])){
    $id=$_GET['deleteId'];
    $sql = "DELETE FROM facilities WHERE ID=$id";
    mysqli_query($conn, $sql); 
    header("location:home.php?adminPanel=FacilityList");
}

if (isset($_GET['deleteAcc'])){
    $id=$_GET['deleteAcc'];
    $sql = "DELETE FROM accounts WHERE ID=$id";
    mysqli_query($conn, $sql); 
    header("location:home.php?adminPanel=Accounts");
}
?>