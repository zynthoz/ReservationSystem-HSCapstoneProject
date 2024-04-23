<?php
// Assuming you have a database connection established
// Replace 'your_db_host', 'your_db_name', 'your_db_user', and 'your_db_password' with your actual database details
$pdo = new PDO('mysql:host=your_db_host;dbname=your_db_name', 'your_db_user', 'your_db_password');

$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfMonth = date('N', strtotime("$year-$month-01"));

// Fetch reservation data for the current month
$startDate = date("$year-$month-01");
$endDate = date("$year-$month-$daysInMonth");
$query = "SELECT * FROM reservations WHERE reservation_date BETWEEN :start_date AND :end_date";
$statement = $pdo->prepare($query);
$statement->bindParam(':start_date', $startDate);
$statement->bindParam(':end_date', $endDate);
$statement->execute();
$reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
