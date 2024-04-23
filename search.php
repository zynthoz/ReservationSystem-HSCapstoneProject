<?php
include("connection.php");

$search = $_POST['search-term'];
$sql = "select * from reservations where Name like '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //output a row here
        $status_class = '';
        if ($row['Status'] == 'Reserved') {
            $status_class = 'green-border';
        } elseif ($row['Status'] == 'Pending') {
            $status_class = 'red-border';
        }
        $ctr = 1;
        echo "<tr>";
        echo "<td>" . $ctr . "</td>";
        echo "<td>" . ($row['Name']) . "</td>";
        echo "<td>" . ($row['Ticket ID']) . "</td>";
        echo "<td>" . ($row['Date']) . "</td>";
        echo "<td>" . ($row['Timeslot']) . "</td>";
        echo "<td>" . ($row['Facility']) . "</td>";
        echo "<td><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>";




        echo "</tr>";
        $ctr++;
    }
} else {
    echo "0 records";
}

$conn->close();

?>
