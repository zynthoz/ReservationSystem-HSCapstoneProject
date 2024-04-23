<?php
require 'connection.php';
session_start();

if(!empty($_GET['type']) && $_GET['type'] == 'list')
{
    if ($_SESSION['privilege'] == 'Admin'){
$sql = "SELECT r.*, f.Color
            FROM reservations r 
            JOIN facilities f ON r.Facility = f.Facility
            WHERE r.Status='Reserved'";
    }

        if ($_SESSION['privilege'] == 'Super Admin'){
$sql = "SELECT r.*, f.Color
            FROM reservations r 
            JOIN facilities f ON r.Facility = f.Facility
            WHERE r.Status='Reserved'";
    }

    else if ($_SESSION["privilege"] == "Outsider"){
$sql = "SELECT r.*, f.Access, f.Color
            FROM reservations r 
            JOIN facilities f ON r.Facility = f.Facility
            WHERE r.Status='Reserved' AND f.Access='Public'";
    }

    else if ($_SESSION["privilege"] == "Facilitator"){
$sql = "SELECT r.*, f.Color
        FROM reservations r
        JOIN facilities f ON r.Facility = f.Facility 
        WHERE r.Status='Reserved' AND f.Facilitator='" . $_SESSION['username'] . "'";
    }

        else if ($_SESSION["privilege"] == "Student"){
$sql = "SELECT r.*, f.Access, f.Color
        FROM reservations r
        JOIN facilities f ON r.Facility = f.Facility
        WHERE r.Status='Reserved' AND f.Access='Private'";
    }

    else if ($_SESSION["privilege"] == "Teacher"){
$sql = "SELECT r.*, f.Access, f.Color
        FROM reservations r
        JOIN facilities f ON r.Facility = f.Facility
        WHERE r.Status='Reserved' AND f.Access='Private'";
    }
$result = $conn->query($sql);
$eventsArray = array();

while($row = $result->fetch_assoc())
{
$eventArray[] = $row;
}

echo json_encode($eventArray);
}

?>