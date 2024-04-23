<?php
require 'connection.php';
session_start();
$id = isset($_GET['accept']) ? $_GET['accept'] : (isset($_GET['reject']) ? $_GET['reject'] : null);

$emailInfoQuery = "SELECT * FROM `reservations` WHERE `Ticket ID`='$id'";
$result = mysqli_query($conn, $emailInfoQuery);

if (mysqli_num_rows($result) > 0) {
    // Fetch data from the result set
    $row = mysqli_fetch_assoc($result);
    $name = $row['Name'];
    $facility = $row['Facility'];
}

if (isset($_GET['accept'])) {
    $status = 'approved';
    $htmlContent = '<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">
<div style="font-family: Arial, sans-serif; height:415px; width:450px; padding: 40px; background-color: #f7f7f7; color: #black; text-align: center;">
 <div style="max-width: 350px; margin: 0 auto; background-color: #fff; height:350px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
   <div style="background-color:#142446; font-size:85px; color:white;">LSQC</div>
<div style="max-width: 350px; padding:20px; background-color: #fff; margin: 0 auto;">
<h1>Hi ' . $name . ' !</h1>
<p>Your reservation request for the ' . $facility . ' has been ' . $status . '</p>
  <div style="width:100%; border-bottom: 1px solid gray; margin-top:35%;"></div>
  <div style="margin-top:5%"><p style="font-weight:bold;">Reference number: ' . $id . '</p></div>
   </div>
</div>
</div>';
    $fetchUserQuery = "SELECT accounts.Email, reservations.Name
                   FROM accounts
                   JOIN reservations ON accounts.Username = reservations.Name
                   WHERE reservations.`TICKET ID`='$id'";
  $fetchUserResult = mysqli_query($conn, $fetchUserQuery);

  if (mysqli_num_rows($fetchUserResult) > 0) {
    $row = mysqli_fetch_assoc($fetchUserResult);
    $email = $row['Email'];
  }

    
    $checkQuery = "SELECT Approvals FROM `reservations` WHERE `Ticket ID`=$id";
    $result = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($result);

        if ($_SESSION['privilege'] == 'Facilitator') {
    if ($row['Approvals'] >= 0) {


require_once "vendor/autoload.php";
require 'C:\xampp\htdocs\CODERS\vendor\guzzlehttp\guzzle\src\Client.php';

 
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "lsqc.reservations@gmail.com",
            'Name' => "Lourdes School Quezon City"
        ],
        'To' => [
            [
                'Email' => $email,
                'Name' => $_SESSION['username']

            ]
        ],
        'Subject' => "Facility Reservation",
        'HTMLPart' => $htmlContent
        ]
    ]
];
 
$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.mailjet.com/v3.1/',
]);
 
$response = $client->request('POST', 'send', [
    'json' => $body,
    'auth' => ['0efbd79bae4b4c4eb88c7f9e7a0775ee', '8151f50916389ff579aa1e8d0520b25a']
]);
 
if($response->getStatusCode() == 200) {
    $body = $response->getBody();
    $response = json_decode($body);
    if ($response->Messages[0]->Status == 'success') {
        echo "Email sent successfully.";
    }
}


        
        $updateStatusQuery = "UPDATE `reservations` SET Status = 'Reserved' WHERE `Ticket ID`=$id";
        mysqli_query($conn, $updateStatusQuery);
        header("location: home.php?status=Dashboard");
    }

    $username = $_SESSION['username']; // Assuming you have a way to get the current user's username

    // Check if the current user has already approved this reservation
    $check_sql = "SELECT COUNT(*) as count FROM `approvals` WHERE `reservation_id` = $id AND `user_id` = '$username'";
    $result = $conn->query($check_sql);

    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } else {
        $row = $result->fetch_assoc();
        $approval_count = $row['count'];

        if ($approval_count == 0) {
            // Insert a new approval record
            $insert_sql = "INSERT INTO `approvals` (reservation_id, user_id) VALUES ($id, '$username')";
            $conn->query($insert_sql);

            // Update the reservation approvals count
            $update_sql = "UPDATE `reservations` SET Approvals = Approvals + 1 WHERE `Ticket ID` = $id";
            $conn->query($update_sql);

            // header("location: home.php?adminPanel=Pending");
            echo $email;
        } else {
            echo "You have already approved this reservation.";
        }
    }
}
    
    if ($_SESSION['privilege'] == 'Admin'||$_SESSION['privilege'] == 'Super Admin') {
    if ($row['Approvals'] >= 2) {


require_once "vendor/autoload.php";
require 'C:\xampp\htdocs\CODERS\vendor\guzzlehttp\guzzle\src\Client.php';

 
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "lsqc.reservations@gmail.com",
            'Name' => "Lourdes School Quezon City"
        ],
        'To' => [
            [
                'Email' => $email,
                'Name' => $_SESSION['username']

            ]
        ],
        'Subject' => "Facility Reservation",
        'HTMLPart' => $htmlContent
        ]
    ]
];
 
$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.mailjet.com/v3.1/',
]);
 
$response = $client->request('POST', 'send', [
    'json' => $body,
    'auth' => ['0efbd79bae4b4c4eb88c7f9e7a0775ee', '8151f50916389ff579aa1e8d0520b25a']
]);
 
if($response->getStatusCode() == 200) {
    $body = $response->getBody();
    $response = json_decode($body);
    if ($response->Messages[0]->Status == 'success') {
        echo "<script>alert('Email sent successfully.');</script>";
    }
}


        
        $updateStatusQuery = "UPDATE `reservations` SET Status = 'Reserved' WHERE `Ticket ID`=$id";
        mysqli_query($conn, $updateStatusQuery);
        header("location: home.php?status=Dashboard");
    }

    $username = $_SESSION['username']; // Assuming you have a way to get the current user's username

    // Check if the current user has already approved this reservation
    $check_sql = "SELECT COUNT(*) as count FROM `approvals` WHERE `reservation_id` = $id AND `user_id` = '$username'";
    $result = $conn->query($check_sql);

    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } else {
        $row = $result->fetch_assoc();
        $approval_count = $row['count'];

        if ($approval_count == 0) {
            // Insert a new approval record
            $insert_sql = "INSERT INTO `approvals` (reservation_id, user_id) VALUES ($id, '$username')";
            $conn->query($insert_sql);

            // Update the reservation approvals count
            $update_sql = "UPDATE `reservations` SET Approvals = Approvals + 1 WHERE `Ticket ID` = $id";
            $conn->query($update_sql);

            header("location: home.php?status=Dashboard");
        } else {
            echo "<script>alert('You have already approved this reservation.');</script>";
        }
    }
}
}

if (isset($_GET['reject'])) {
    $status = 'rejected';
    $htmlContent = '<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">
<div style="font-family: Arial, sans-serif; height:415px; width:450px; padding: 40px; background-color: #f7f7f7; color: #black; text-align: center;">
 <div style="max-width: 350px; margin: 0 auto; background-color: #fff; height:350px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
   <div style="background-color:#142446; font-size:85px; color:white;">LSQC</div>
<div style="max-width: 350px; padding:20px; background-color: #fff; margin: 0 auto;">
<h1>Hi ' . $name . ' !</h1>
<p>Your reservation request for the ' . $facility . ' has been ' . $status . '</p>
  <div style="width:100%; border-bottom: 1px solid gray; margin-top:35%;"></div>
  <div style="margin-top:5%"><p style="font-weight:bold;">Reference number: ' . $id . '</p></div>
   </div>
</div>
</div>';
    $fetchUserQuery = "SELECT accounts.Email, reservations.Name
                   FROM accounts
                   JOIN reservations ON accounts.Username = reservations.Name
                   WHERE reservations.`TICKET ID`='$id'";
  $fetchUserResult = mysqli_query($conn, $fetchUserQuery);

  if (mysqli_num_rows($fetchUserResult) > 0) {
    $row = mysqli_fetch_assoc($fetchUserResult);
    $email = $row['Email'];
  }

    require_once "vendor/autoload.php";
require 'C:\xampp\htdocs\CODERS\vendor\guzzlehttp\guzzle\src\Client.php';

 
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "lsqc.reservations@gmail.com",
            'Name' => "Lourdes School Quezon City"
        ],
        'To' => [
            [
                'Email' => $email,
                'Name' => $_SESSION['username']

            ]
        ],
        'Subject' => "Facility Reservation",
        'HTMLPart' => $htmlContent
        ]
    ]
];
 
$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.mailjet.com/v3.1/',
]);
 
$response = $client->request('POST', 'send', [
    'json' => $body,
    'auth' => ['0efbd79bae4b4c4eb88c7f9e7a0775ee', '8151f50916389ff579aa1e8d0520b25a']
]);
 
if($response->getStatusCode() == 200) {
    $body = $response->getBody();
    $response = json_decode($body);
    if ($response->Messages[0]->Status == 'success') {
        echo "<script>alert('Email sent successfully.');</script>";
    }
}

    $sql = "UPDATE `reservations` SET `Status`='Rejected' WHERE `Ticket ID`=$id";
    $conn->query($sql);

    // Redirect to Pending page after rejection
    header("location:home.php?status=Pending");
    echo "<script>alert('Reservation Rejected.');</script>";
}
?>