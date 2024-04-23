<?php
require 'connection.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="select.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="style_footer.css">
    <link rel="stylesheet" href="style_button.css">
    <link rel="stylesheet" href="calendar.css">
    <script src="select.js"></script>
    <script src="calculateHours.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>

    <script type="text/javascript">
    function getEvent() {
        var events = new Array();
        $.ajax({
            type: "POST",
            url: "function.php?type=list",
            dataType: "json",
            success: function(data) {
                var result = data;

                $.each(result, function(i, item) {

                    var endDate = new Date(result[i].EndDate);
                    endDate.setDate(endDate.getDate() + 1);
                    var newEndDate = endDate.toISOString().split('T')[0];

                    events.push({
                        event_id: result[i].id,
                        title: result[i].Facility,
                        start: result[i].StartDate,
                        end: result[i].EndDate,
                        color: result[i].Color,
                        link: result[i].link,
                        allDay: false,
						
                    });
                });


                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    eventTimeFormat: {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: true
                    },
					eventDisplay: true,
                    initialDate: '<?=date('Y-m-d')?>',
                    navLinks: false, // can click day/week names to navigate views
                    businessHours: false, // display business hours
                    editable: false,
                    selectable: false,
                    events: events,
                    displayEventTime: true,
                    displayEventEnd: true,
                });

                calendar.render();

				
            }

        });
    }
    getEvent()
    </script>
    <?php
	session_start();
	if (!isset ($_SESSION['username'])) {
		// Redirect to the login page if the user is not logged in
		header('Location: index.php');
		exit();
	}
	?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lourdes School Quezon City</title>
    <link rel="icon" type="image/png" href="title_logo.png" />
</head>

<body>
    <div class="parent-home">
        <div class="header-container">
            <div class="header">
                <div class="logo-div"><a href="index.php"><img style="height:90%;" src="logo.png"></a></div>
                <div style="text-align: center; width:100%; display: flex; align-items: center; margin: 0;">
                    <form action="home.php"
                        style="height:100%; width:100%; display: flex; align-items: center; justify-content: center;"
                        method="get">
                        <div style="float:left; margin-left:20px;">
                        </div>
                        <div style="float:left; margin-left:20px;">
                            <?php

  if (isset ($_GET['admin']) || (isset($_GET['adminPanel']) && $_GET['adminPanel'] == 'FacilityList')){
	echo '<button name="addFacility" value="Add Facility" class="button-facility"><div class="create-reservation"><img style="width:20px; height:20px; margin-right:10px; filter: brightness(0) invert(1);" src="plus.png">Create Facility</div></button>';
  }
?>
                        </div>
                        <div class="inbox-container">
                            <div class="account-container" style="margin-right:40%;">
                                <img style="height: 45px; width: 45px; margin:0 10px 0 0px;" src="user.png">
                                <?php
                            echo '<div class="acc-text">
									<p style="font-weight:bold; color:white; margin:0;">' . $_SESSION['username'] . '
									<div class="acc-text">
									<p style="color:white; margin:0;">' . $_SESSION['privilege'] . '
									</div>
									</div>
									</div>';
									?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        function submitForm() {
            var form = document.querySelector("form");
            form.submit();
        }
        </script>
        <div class="content-parent">
            <div class="content">
                <div class="side-panel">
                    <div>



                        <?php
// if ($_SESSION['privilege'] == 'Admin' || $_SESSION['privilege'] == 'Facilitator') {

// 	$count = 0; // Initialize count variable

// if ($_SESSION['privilege'] == 'Admin') {
//     $sql = "SELECT COUNT(*) as count FROM accountsdb.reservations WHERE status = 'Reserved'";
// }

// if ($_SESSION['privilege'] == 'Facilitator') {
//     $sql = "SELECT COUNT(*) as count FROM reservations r 
//             JOIN facilities f ON r.Facility = f.Facility 
//             WHERE r.Status='Reserved' AND f.Facilitator='" . $_SESSION['username'] . "'";
// }

//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
//     $count = $row['count'];

//     // Display the result
// 	echo '<p style="font-weight:bold; filter: opacity(0.45)">Total Reservations</p>';
//     echo '<h1 style="padding-bottom:25px; margin-left:20px; filter: opacity(0.8);">' . $row['count'] . '</h1>';

// 	// Free the result
//     $result->free();


// if ($_SESSION['privilege'] == 'Admin') {
//     $sql = "SELECT COUNT(*) as count FROM accountsdb.reservations WHERE status = 'Pending'";
// }

// if ($_SESSION['privilege'] == 'Facilitator') {
//     $sql = "SELECT COUNT(*) as count FROM reservations r 
//             JOIN facilities f ON r.Facility = f.Facility 
//             WHERE r.Status='Pending' AND f.Facilitator='" . $_SESSION['username'] . "'";
// }
// // Execute the SQL query
// if ($result = $conn->query($sql)) {

//     // Fetch the result of the query
//     $row = $result->fetch_assoc();

//     // Display the result
// 	echo '<p style="font-weight:bold; filter: opacity(0.45)">Pending Reservations</p>';
//     echo '<h1 style="padding-bottom:25px; margin-left:20px; filter: opacity(0.8);">' . $row['count'] . '</h1>';

// 	// Free the result
//     $result->free();
// }
// }
?>

                        <form id="myForm" method="get" action="home.php">
                            <p style="font-weight:bold; filter: opacity(0.7);">View</p>
                            <div class=side-panel-button-div style="display:flex;">
                                <input type="submit" class="side-panel-button" name="calendar" value="Calendar">
                            </div>

                            <div class=side-panel-button-div style="display:flex;">
                                <input type="submit" class="side-panel-button" name="facility-list" value="Facilities">
                            </div>
						<?php

							echo'<div class=side-panel-button-div style="display:flex;">
                        <button type="submit" class="side-panel-button" name="status" value="' . $_SESSION['username'] . '">My Reservations</button>
						</div>';

						?>

                            <?php
						if ($_SESSION['privilege'] == 'Admin') {
							echo '<p style="padding-top:20px; font-weight:bold; filter: opacity(0.7);">Admin Panel</p>';
						}

						if ($_SESSION['privilege'] == 'Facilitator') {
							echo '<p style="padding-top:20px; font-weight:bold; filter: opacity(0.7);">Facilitator Panel</p>';
						}

						if ($_SESSION['privilege'] == 'Super Admin') {
							echo '<p style="padding-top:20px; font-weight:bold; filter: opacity(0.7);">Super Admin Panel</p>';
						}


						if ($_SESSION['privilege'] == 'Admin' || $_SESSION['privilege'] == 'Facilitator'||$_SESSION['privilege'] == 'Super Admin') {
						echo'<div class=side-panel-button-div style="display:flex;">
                        <input type="submit" class="side-panel-button" name="status" value="Dashboard">
						</div>';
						}
						if ($_SESSION['privilege'] == 'Super Admin') {
						echo'<div class=side-panel-button-div style="display:flex;">
                        <button type="submit" class="side-panel-button" name="adminPanel" value="FacilityList">Manage Facility</button>
						</div>
						<div class=side-panel-button-div style="display:flex;">
                        <button type="submit" class="side-panel-button" name="adminPanel" value="Accounts">Manage Accounts</button>
						</div>';
						}

?>
                            <!-- <p style="padding: 20px 0 0 0; font-weight:bold; filter: opacity(0.7);">Help & Settings
                            </p>
                            <div class=side-panel-button-div style="display:flex;">
                                <input type="submit" class="side-panel-button" name="help" value="Help?">
                            </div>
                            <div class=side-panel-button-div style="display:flex;">
                                <input type="submit" class="side-panel-button" name="settings" value="Settings">
                            </div> -->
                    </div>
                    </form>
					<a class="logout-link" href="logout.php">
                    <div class="side-panel-button-logout-div" style="display:flex;">
                        <img src="logout.png" style="margin-left: 3px; width: 25px; height: 25px; margin-top:7px;">
                        <input type="submit" style="padding-left: 7px;" class="side-panel-button-logout" value="Logout">
                    </div>
					</a>
                </div>
				
                <?php
				if (empty($_GET)) {
					echo '<meta http-equiv="refresh" content="0;url=home.php?facility-list">';
    exit();
				}
				if (isset ($_GET['facility-list'])) {

				echo '<div style="padding-left:65px; padding-right:65px;" id="div2" class="divs">';
				
				if ($_SESSION['privilege'] == 'Student'||$_SESSION['privilege'] == 'Teacher') {
					$sql = "SELECT * FROM facilities WHERE Access='Private'";
				}

				if ($_SESSION['privilege'] == 'Outsider') {
					$sql = "SELECT * FROM facilities WHERE Access='Public'";
				}

				if ($_SESSION['privilege'] == 'Admin') {
					$sql = "SELECT * FROM facilities";
				}

				if ($_SESSION['privilege'] == 'Facilitator') {
					$sql = "SELECT * FROM facilities WHERE Facilitator='" . $_SESSION['username'] . "'";
				}

				if ($_SESSION['privilege'] == 'Super Admin') {
					$sql = "SELECT * FROM facilities";
				}

				echo '<div class="facility-container-title">
						<h2>Facility Overview</h2>
					</div>
					<div class="thumbnail-container">';

				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo '<div class="thumbnail-container1" style="width:100%;">
						<div class="facility-thumbnail" style="background-image:url(\'img/' . $row['Background'] . '\')" data-name="facilityReserve" data-value="' . ($row["ID"]) . '">
							</div>
							<div class="facility-description">
								<div class="thumbnail-title">' . ($row["Facility"]) . '</div>
								<p style="font-size:14px; color:#5A5A5A">'  . $row['Description'] . '</p>
							</div>
							</div>';
					}
				}

				echo'</div></div></div>';
				}
				?>
                <script>
                var divs = document.getElementsByClassName("facility-thumbnail");
                for (var i = 0; i < divs.length; i++) {
                    divs[i].addEventListener("click", function() {
                        var name = this.getAttribute("data-name");
                        var value = this.getAttribute("data-value");
                        window.location.href = "home.php?facilityReserve=" + encodeURIComponent(value);
                    });
                }
                </script>
				<?php
				if (isset ($_GET['status'])) {
						if ($_GET['status'] == 'Dashboard') {
					echo '
<div id="div2" class="divs">';
	echo'<table id="pendingReservation">
	<tr>
	<th style="text-align:center;">No.</th>
	<th>Name</th>
	<th>Ticket ID</th>
	<th>Start</th>
	<th>End</th>
	<th>Facility</th>
	<th style="text-align:center;">
	<form id="myForm1" action="" method="GET">
						<div style="display:flex;">
                    <select style="padding:0; font-weight: bold; border: none; outline: none; background-color: transparent;" id="status" name="status">
						<option value="" disabled selected style="display:none;">Status ▼</option>
                        <option value="Pending">Pending</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </form>
				</div></th>';?>
		<script>
    document.getElementById('status').addEventListener('change', function() {
        var selectElement = document.getElementById('status');

        // Get the selected value
        var selectedStatus = selectElement.value;

        // Log the selected value to the console
        console.log(selectedStatus);

        document.getElementById('myForm1').submit();
    });
</script>
<?php
	echo'<th style="text-align:center;">Action</th>';

	echo'</tr>';			if ($_SESSION['privilege'] == 'Admin'){
							$query2 = "SELECT * FROM reservations order by `Ticket ID` desc";
							};

							if ($_SESSION['privilege'] == 'Super Admin'){
							$query2 = "SELECT * FROM reservations order by `Ticket ID` desc";
							};

							if ($_SESSION['privilege'] == 'Facilitator'){
							$query2 =  "SELECT * FROM reservations r 
							JOIN facilities f ON r.Facility = f.Facility 
							WHERE f.Facilitator='" . $_SESSION['username'] . "'";
							};
							$results = mysqli_query($conn, $query2);
							$ctr = 1;
							

							while ($row = mysqli_fetch_array($results)) {
								$formattedStartDate = date('F j Y g:ia', strtotime($row['StartDate']));
							$formattedEndDate = date('F j Y g:ia', strtotime($row['EndDate']));	
								//output a row here
								$status_class = '';
								if ($row['Status'] == 'Reserved') {
									$status_class = 'green-border';
								} elseif ($row['Status'] == 'Pending') {
									$status_class = 'red-border';
								} elseif ($row['Status'] == 'Rejected') {
									$status_class = 'rejected-border';
								}
								echo "<tr>";
								echo "<td style='text-align:center;'>" . $ctr . "</td>";
								echo "<td>" . ($row['Name']) . "</td>";
								echo "<td>" . ($row['Ticket ID']) . "</td>";
								echo "<td>" . $formattedStartDate . "</td>";
								echo "<td>" . $formattedEndDate . "</td>";
								echo "<td style='padding-right:0;'>" . ($row['Facility']) . "</td>";
								echo "<td style='text-align:center;'><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>";
								$status= $row['Status'];
								$ctr++;
								if ($status == "Pending") {
    $username = $_SESSION['username'];
    $check_query = "SELECT * FROM approvals WHERE reservation_id = '" . ($row['Ticket ID']) . "' AND user_id = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<td style='text-align:center;'>Approved By You</td>";
    } else {
        echo "<td style='text-align:center;'>";
        echo "<form method='GET' action='home.php'>";
        echo "<button class='review' id='view' name='approve-reservation' value='" . ($row['Ticket ID']) . "'><span>Review</span></button>";
        echo "</form>";
        echo "</td>";
    }
} else {
    echo "<td style='text-align:center;'>";
    echo "<form method='GET' action='home.php'>";
    echo "<button class='view' id='view' name='view-reservation' value='" . ($row['Ticket ID']) . "'><span>View</span></button>";
    echo "</form>";
    echo "</td>";
}
							}
							echo '</table></div>';
						}
						};
						
				?>
                <?php

				if (isset($_GET["facilityPage"])) {
					echo '<div id="div6" class="divs">';
					$sql = "SELECT * FROM facilities WHERE ID='" . ($_GET['facilityPage']) . "'";
					$result = $conn->query($sql);

					if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
					echo '<div class = "facility-overview" style="background-image: url(\'img/' . $row['Background'] . '\');"><h1 style="z-index:100;">' . $row['Facility'] . '</h1></div>';
					echo '<div class="overview-content">';
					echo '<p>Location: ' . $row['Floor'] . '</p><br>';
					echo '<div><h3 style="font-weight:bold;">Equipment</h3></div></div>';
					echo '<form method="GET" action="home.php">
					<div style="width:150px;">
					<button class="book-now" name="facilityReserve" value="' . ($_GET['facilityPage']) . '">Reserve Now
					</button>
					</div>
					</form>';
					echo'</div>';
					}
				}

				if (isset($_GET["facilityReserve"])) {

					echo '<div id="div5" class="divs">';
					$facilityID=$_GET['facilityReserve'];
					$query1 = "SELECT * FROM facilities WHERE ID = '" . $facilityID . "'";
					$result1 = mysqli_query($conn, $query1);
					if ($row = mysqli_fetch_array($result1)) {
					$facility=$row['Facility'];
					$rate=$row['Rate'];
					}
						if (isset($_POST['paynow'])) {
							    $facility = $_POST['facility'];
    $startDate = $_POST['reservation-date-start'];
    $endDate = $_POST['reservation-date-end'];
    $purpose = $_POST['purpose'];
    $totalFee = $_POST['totalFee'];
	$formattedStartDate = date('F j, Y g:i A', strtotime($startDate));
	$formattedEndDate = date('F j, Y g:i A', strtotime($endDate));

 	$duplicateQuery = "SELECT * FROM reservations WHERE Facility = '$facility' AND Status = 'Reserved' AND StartDate = '$startDate' AND EndDate = '$endDate'";
    $result = mysqli_query($conn, $duplicateQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Duplicate entry!') </script>";
        echo "<meta http-equiv='refresh' content='0; url=home.php?facility-list'>";
    } else {
        // Check for overlapping reservations
        $overlapQuery = "SELECT * FROM reservations WHERE Facility = '$facility' AND Status = 'Reserved' AND ((StartDate <= '$startDate' AND EndDate >= '$startDate') OR (StartDate <= '$endDate' AND EndDate >= '$endDate'))";
        $overlapResult = mysqli_query($conn, $overlapQuery);
        if (mysqli_num_rows($overlapResult) > 0) {
            echo "<script> alert('Overlap with existing reservation!') </script>";
            echo "<meta http-equiv='refresh' content='0; url=home.php?facility-list'>";
        } 
	}
							
							echo'<div class="parent-reservation">
				<div class="row-reservation">';
    $facility = $_POST['facility'];
    $startDate = $_POST['reservation-date-start'];
    $endDate = $_POST['reservation-date-end'];
    $purpose = $_POST['purpose'];
    $totalFee = $_POST['totalFee'];
	$formattedStartDate = date('F j, Y g:i A', strtotime($startDate));
	$formattedEndDate = date('F j, Y g:i A', strtotime($endDate));

	
		
		echo'<script>
					function clearForm() {
						document.getElementById("reservation-form").reset();
					}
				</script>
				<div class="column-arrow">
				<div><a href="javascript:history.back()" onclick="clearForm()">	<img style="width:35; height:35;" src="back.png"></a></div>
				</div><div class="column-reservation2" style="display: flex; justify-content:center;">
				<div style="width:100%;">';
		echo '<div class="order-container">

    <div class="order-number"></div>
	<p class="order-desc">Payment
	</div>
	<div style="width:100%; display:flex; justify-content:center;">
	<span style="color:red;">* </span><span style="font-weight: 400; color: rgb(140, 140, 140);"> Upload a screenshot of your transaction</span>
	</div>			
<div style="width:100%; display:flex; justify-content:center;">
<div class="qr-container">
<div>
<img style="width:300px; height:300;px" src="QR.jpg">
</div>
<div class="qr-info">
<p style="font-weight:bold;">Ac*****ng Of*ce
<p>09668954561
</div>
</div>
</div>
<div style="text-align:center;">
<br>
<br>
<br>
<br>
<p style="color:gray;" id="file-name"></p>
</div>
</div>
</div>

		<div class="column-reservation1">
				<div class="order-container">
   <div class="order-number"></div>
	<p class="order-desc">Preview of Reservation
	</div>';
	$currentDate = date('Y-m-d');
$username = $_SESSION["username"];
$query1 = "SELECT * FROM accounts WHERE Username = '" . $username . "'";
							$result1 = mysqli_query($conn, $query1);
							if ($row = mysqli_fetch_array($result1)) {

    // Output the invoice HTML

    echo '<div class="invoice-container">';
	echo '<div class="invoice-column">';
    echo '<div><p style="font-weight:bold;">Bill to:</p></div>';
	echo '<span style="font-weight:bold;">Date: ' . $currentDate . '</span>';
	echo '</div>';
    echo '<p>' . $username . '</p>';
    echo '<p>' . $row['Email'] . '</p>';
	echo '<p>' . $row['Phone'] . '</p>';
	echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Info: </p>';
	echo '<p>Facility: ' . $facility . '</p>';
	echo '<div id="reservation-dates">
	<p>Start Date: ' . $formattedStartDate  . '</p>
    <p>End Date:  ' . $formattedEndDate  . '</p></div>';
	echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Fee:</p>';
	echo '<p> Payment Method: G-Cash';
	echo '<div id="reservation-fee" data-rate="' . $rate . '">Total Fee: ₱' . $totalFee . '</div>';
    echo '</div>';
	

	
	echo '<center>
	<form action = "process.php" method ="POST" enctype="multipart/form-data">
		<input type="hidden" name="reservationDate" value="' . $currentDate . '">
		<input type="hidden" name="facility" value="' . $facility . '">
		<input type="hidden" name="reservation-date-start" value="' . $startDate . '">
		<input type="hidden" name="reservation-date-end" value="' . $endDate . '">
		<input type="hidden" name="purpose" value="' . $purpose . '">
		<input type="hidden" name="totalFee" value="' . $totalFee . '">';
		
		?>
                <?php
	echo'<input type="submit" class="button" style="width: 100%; margin-top:22px; font-weight:bold;" name="submit" value="CONFIRM">
	<div class="file-upload">
				<label for="image-upload" class="i-am-a-link">
    <img src="upload.png"
         id="image-upload-label">
</label>
<label for="image-upload" class="i-am-a-link-2 ">
    Upload Screenshot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</label>
<input type="file" name="payment_file" id="image-upload" accept=".jpg,.jpeg,.png" required class="hide-me">
</div>
	</center></form>';?> 
	    <script>
        document.getElementById('image-upload').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var fileName = file.name;
                var filePath = URL.createObjectURL(file);
                var link = document.createElement('a');
                link.href = filePath;
                link.target = "_blank"; // Open in a new tab
                link.textContent = fileName;
                document.getElementById('file-name').innerHTML = '';
                document.getElementById('file-name').appendChild(link);
            } else {
                document.getElementById('file-name').textContent = 'No file selected';
            }
        });

        // Check if file input is empty initially
        if (!document.getElementById('image-upload').files[0]) {
            document.getElementById('file-name').textContent = 'No file selected';
        }
    </script>
	<?php
							}
	} else{
					echo '<script>
								function clearForm() {
									document.getElementById("reservation-form").reset();
								}
							</script>
	  <form action="" id="reservation-form" method="POST">
					<div class="parent-reservation">
				<div class="row-reservation">
				<div class="column-arrow">
				<div><a href="javascript:history.back()" onclick="clearForm()">	<img style="width:35; height:35;" src="back.png"></a></div>
				</div>
				<div class="column-reservation">
				<div class="order-container">
    <div class="order-number"></div>
	<p class="order-desc">Reservation Information
	</div>
				<label for="reservation-date" style="margin-left:10px;">Start of Reservation</label>
				<input type="hidden" name="facility" value="' . $facility . '">
				<input type="hidden" name="totalFee" id="totalFee" value="">
				<input class="reservation-date" style="margin-top:10px; margin-bottom:11px;" type="datetime-local" id="reservation-date-start" name="reservation-date-start" required>
				<label style="margin-left:10px;"for="reservation-date-end">End of Reservation</label>
				<input class="reservation-date" style=" margin-top:10px; margin-bottom:11px;" type="datetime-local" id="reservation-date-end" name="reservation-date-end" required>
				<label for="reason">Purpose</label><br>
				<textarea name="purpose" class="reason" rows="30" cols="50" id="purpose"  style="margin-top:10px	" required></textarea><br>';
?>

                <script>
		var currentDate = new Date();
currentDate.setSeconds(0); // Set seconds to 0

// Format the date to ISO string without milliseconds
var isoDate = currentDate.toISOString().slice(0, -5);

// Set the min attribute of the input fields to disable options before the current date
document.getElementById('reservation-date-start').min = isoDate;
document.getElementById('reservation-date-end').min = isoDate;

				 function openDateTimePicker(inputId) {
            document.getElementById(inputId).click();
        }

        // Attach the function to each input field
        document.querySelectorAll('.reservation-date').forEach(function(input) {
            input.addEventListener('click', function() {
                openDateTimePicker(input.id);
            });
        });
                function updateReservationDetails() {
                    // Get datetime input elements
                    const startDateInput = document.getElementById('reservation-date-start');
                    const endDateInput = document.getElementById('reservation-date-end');

                    // Function to format date
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const options = {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        };
                        return date.toLocaleDateString('en-US', options);
                    }

                    // Function to format time
                    function formatTime(timeString) {
                        const date = new Date(timeString);
                        let hours = date.getHours();
                        const minutes = date.getMinutes();
                        const ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12 || 12;
                        return `${hours}:${minutes < 10 ? '0' : ''}${minutes} ${ampm}`;
                    }

                    // Function to calculate duration in hours between two dates
                    function calculateDurationHours(startDate, endDate) {
                        const start = new Date(startDate);
                        const end = new Date(endDate);
                        const durationInMilliseconds = end - start;
                        const durationInHours = durationInMilliseconds / (1000 * 60 * 60);
                        return durationInHours;
                    }

                    // Function to update reservation dates and fee in invoice
                    function updateReservationDates() {
                        const reservationDatesContainer = document.getElementById('reservation-dates');
                        const reservationFeeContainer = document.getElementById('reservation-fee');
                        const startDate = startDateInput.value;
                        const endDate = endDateInput.value;
                        const rate = reservationFeeContainer.getAttribute('data-rate'); // Get rate from data attribute

                        if (startDate && endDate) {
                            const startDateFormatted = formatDate(startDate) + ' ' + formatTime(startDate);
                            const endDateFormatted = formatDate(endDate) + ' ' + formatTime(endDate);
                            reservationDatesContainer.innerHTML = `
                <p>Start Date: ${startDateFormatted}</p>
                <p>End Date: ${endDateFormatted}</p>
            `;
                            const durationHours = calculateDurationHours(startDate, endDate);
                            const totalFeeInput = document.getElementById('totalFee');
                            const reservationFee = durationHours * rate;
                            reservationFeeContainer.textContent = `Total Fee: ₱${reservationFee.toFixed(2)}`;
                            totalFeeInput.value = reservationFee.toFixed(2);
                        } else {
                            reservationDatesContainer.innerHTML =
                                `<p>Start Date:</p><p>End Date:</p>`; // Clear the container if no dates are set
                            reservationFeeContainer.textContent = "Total Fee: "; // Clear the fee if no dates are set
                        }
                    }

                    // Event listeners to capture changes in datetime input fields
                    startDateInput.addEventListener('change', function() {
                        // Update the min attribute of the end date input
                        endDateInput.min = startDateInput.value;
                        updateReservationDates();
                    });
                    endDateInput.addEventListener('change', updateReservationDates);

                    // Initial call to update reservation dates and fee
                    updateReservationDates();
                }

                // Function to refresh the page if coming from the back/forward cache
                function refreshPageIfFromBfcache() {
                    if (window.performance && window.performance.navigation.type === window.performance.navigation
                        .TYPE_BACK_FORWARD) {
                        window.location.reload();
                    }
                }

                // Call the function when the page loads
                document.addEventListener('DOMContentLoaded', function() {
                    updateReservationDetails();
                    refreshPageIfFromBfcache();

                    // Call the function again when the page is shown from the cache
                    window.addEventListener('pageshow', function(event) {
                        if (event.persisted) {
                            window.location.reload();
                        }
                    });
                });
                </script>

                <?php echo'</div>
				<div class="column-reservation">
				<div class="order-container">
    <div class="order-number"></div>
	<p class="order-desc">Blocked Time Slots
	</div>';
	echo '<div class="facility-header">' . $facility . '</div>';
	$query2 = "SELECT * FROM reservations WHERE Facility = '" . $facility . "' AND Status = 'Reserved' ORDER BY CAST(StartDate AS DATETIME) ASC";
$results = mysqli_query($conn, $query2);
echo '<div class="facility-date-container">';
							while ($row = mysqli_fetch_array($results)) {
$startDateTime = strtotime($row['StartDate']);
$endDateTime = strtotime($row['EndDate']);

// Format the start and end dates
$startDateFormat = date('M d', $startDateTime);
$endDateFormat = date('M d', $endDateTime);

// Format the start and end times with AM/PM
$startTimeFormat = date('h:i A', $startDateTime);
$endTimeFormat = date('h:i A', $endDateTime);

echo "<div class='facility-date-rows'><div class='date-column'>{$startDateFormat} - {$endDateFormat}</div><div class='time-column'>{$startTimeFormat} - {$endTimeFormat}</div></div>";}
					echo'</div>';
	// echo '<div class="order-container" style="margin-top:22px;">
	// </div></div>';
//     <div class="order-number">4</div>
// 	<p class="order-desc">Payment
// 	</div>
// 	<span style="color:red;">* </span><span style="font-weight: 400; color: rgb(140, 140, 140);"> Upload a screenshot of your transaction</span>
// 				<div class="file-upload">
// 				<label for="image-upload" class="i-am-a-link">
//     <img src="upload.png"
//          id="image-upload-label">
// </label>
// <label for="image-upload" class="i-am-a-link-2">
//     Upload Screenshot
// </label>

// <input type="file" id="image-upload" class="hide-me">
// </div>
// <div style="width:100%; display:flex; justify-content:center;">
// <div class="qr-container">
// <img style="width:200px; height:200;px" src="QR.jpg">
// <div class="qr-info">
// <p style="font-weight:bold;">Ac*****ng Of*ce
// <p>09668954561
// </div>
// </div>
// </div>
// 				</div>

				echo'</div>';
				echo'<div class="column-reservation1">
				<div class="order-container">
   <div class="order-number"></div>
	<p class="order-desc">Preview of Reservation
	</div>';
	$currentDate = date('Y-m-d');
$username = $_SESSION["username"];
$query1 = "SELECT * FROM accounts WHERE Username = '" . $username . "'";
							$result1 = mysqli_query($conn, $query1);
							if ($row = mysqli_fetch_array($result1)) {

    // Output the invoice HTML

    echo '<div class="invoice-container">';
	echo '<div class="invoice-column">';
    echo '<div><p style="font-weight:bold;">Bill to:</p></div>';
	echo '<span style="font-weight:bold;">Date: ' . $currentDate . '</span>';
	echo '</div>';
    echo '<p>' . $username . '</p>';
    echo '<p>' . $row['Email'] . '</p>';
	echo '<p>' . $row['Phone'] . '</p>';
	echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Info:</p>';
	echo '<p>Facility: ' . $facility . '</p>';
	echo '<div id="reservation-dates">
	<p>Start Date: </p>
    <p>End Date: </p></div>';
	echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Fee:</p>';
	echo '<p> Payment Method: G-Cash';
	echo '<div id="reservation-fee" data-rate="' . $rate . '">Total Fee:</div>';
    echo '</div>';
	echo '</form>';

	
	echo '<center>
	<input type="submit" class="button" style="width: 100%; margin-top:22px; font-weight:bold;" name="paynow" value="PAY NOW">
	</center></div></div></div>';
							}
							
}

				echo '</div>';
	// 			echo '<div class="order-container">
    // <div class="order-number">?</div>
	// <p class="order-desc">Miscellaneous
	// </div>
	// 			<div style="text-align:center;">
	// 			<a href="https://www.example.com">
	// 			<input type="button" class="button-guideline" value="Reservation Guidelines"><br>
	// 			</a>
	// 			<input type="checkbox" id="tos-accept" required> <span>Do you accept <a class="tos"
	// 			href="">Terms
	// 			and Conditions</a>?</span><br><br>
	// 			<input type="submit" class="button" style="width: 100%;" name="submit" value="Submit Reservation"></form>';
					echo '</div></div></div></div>';
				}


				if (isset ($_GET['calendar'])) {
					echo '<div id="div1" class="divs">
					<div id="calendar">
					</div>
					</div>
					</div>';
				}


				if (isset ($_GET['status'])) {
					$status = $_GET['status'];
					if ($status == 'all') {
						$status = "Pending'+'Reserved";
						echo '<div id="div2" class="divs">';
		echo'<table id="pendingReservation">
		<tr>
		<th style="text-align:center;">No.</th>
		<th>Name</th>
		<th>Ticket ID</th>
		<th>Start</th>
		<th>End</th>
		<th>Facility</th>
		<th style="text-align:center;">
		<form id="myForm1" action="" method="GET">
						<div style="display:flex;">
                    <select style="padding: 0;font-weight: bold; border: none; outline: none; background-color: transparent;" id="status" name="status">
						<option value="" disabled selected style="display:none;">Status ▼</option>
                        <option value="Pending">Pending</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </form>
				</div></th>';
				;?>
		<script>
    document.getElementById('status').addEventListener('change', function() {
        var selectElement = document.getElementById('status');

        // Get the selected value
        var selectedStatus = selectElement.value;

        // Log the selected value to the console
        console.log(selectedStatus);

        document.getElementById('myForm1').submit();
    });
</script>
<?php
		echo'<th style="text-align:center;">Action</th>';
		if ($_SESSION['privilege'] == 'Admin') {
		}
		echo'</tr>';
						if ($_SESSION['privilege'] == 'Admin'){
							$query2 = "SELECT * FROM reservations WHERE Status='$status' order by `Ticket ID` desc";
							};

							if ($_SESSION['privilege'] == 'Facilitator'){
							$query2 =  "SELECT * FROM reservations r 
							JOIN facilities f ON r.Facility = f.Facility 
							WHERE r.Status='$status' AND f.Facilitator='" . $_SESSION['username'] . "'";
							};
						$results = mysqli_query($conn, $query2);

						$ctr = 1;

						while ($row = mysqli_fetch_array($results)) {
							$formattedStartDate = date('F j Y g:ia', strtotime($row['StartDate']));
							$formattedEndDate = date('F j Y g:ia', strtotime($row['EndDate']));	
							//output a row here
							$status_class = '';
							if ($row['Status'] == 'Reserved') {
								$status_class = 'green-border';
							} elseif ($row['Status'] == 'Pending') {
								$status_class = 'red-border';
							} elseif ($row['Status'] == 'Rejected') {
								$status_class = 'rejected-border';
							}
							echo "<tr>";
							echo "<td style='text-align:center;'>" . $ctr . "</td>";
							echo "<td>" . ($row['Name']) . "</td>";
							echo "<td>" . ($row['Ticket ID']) . "</td>";
							echo "<td>" . $formattedStartDate . "</td>";
							echo "<td>" . $formattedEndDate . "</td>";
							echo "<td>" . ($row['Facility']) . "</td>";
							echo "<td style='text-align:center;'><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>";
							echo "<form method='GET' action='home.php'><td style='text-align:center;'><button class='view' id='view' name='view-reservation' value='" . ($row['Ticket ID']) . "'>
								<span>View</span>
								</button></form>
								</td>";
							if ($_SESSION['privilege'] == 'Admin') {
							};
							echo "</tr>";
							$ctr++;
						}

						echo '</table>';
					}elseif ($status == "Reserved" || $status == "Rejected")
 {
						echo '<div id="div2" class="divs">';
		echo'<table id="pendingReservation">
		<tr>
		<th style="text-align:center;">No.</th>
		<th>Name</th>
		<th>Ticket ID</th>
		<th>Start</th>
		<th>End</th>
		<th>Facility</th>
		<th style="text-align:center;"><form id="myForm1" action="" method="GET">
						<div style="display:flex;">
                    <select style="padding: 0; font-weight: bold; border: none; outline: none; background-color: transparent;" id="status" name="status">
						<option value="" disabled selected style="display:none;">' . $status . ' ▼</option>
                        <option value="Pending">Pending</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </form>
				</div></th>
		<th style="text-align:center;">Action</th>';?>
		<script>
    document.getElementById('status').addEventListener('change', function() {
        var selectElement = document.getElementById('status');

        // Get the selected value
        var selectedStatus = selectElement.value;

        // Log the selected value to the console
        console.log(selectedStatus);

        document.getElementById('myForm1').submit();
    });
</script>
<?php
		if ($_SESSION['privilege'] == 'Admin') {
		}
		echo'</tr>';
						if ($_SESSION['privilege'] == 'Admin'){
							$query2 = "SELECT * FROM reservations WHERE Status='$status' order by `Ticket ID` desc";
							};

							if ($_SESSION['privilege'] == 'Facilitator'){
							$query2 =  "SELECT * FROM reservations r 
							JOIN facilities f ON r.Facility = f.Facility 
							WHERE r.Status='$status' AND f.Facilitator='" . $_SESSION['username'] . "'";
							};

							if ($_SESSION['privilege'] == 'Super Admin'){
							$query2 = "SELECT * FROM reservations WHERE Status='$status' order by `Ticket ID` desc";
							};

							if ($_SESSION['privilege'] == 'Facilitator'){
							$query2 =  "SELECT * FROM reservations r 
							JOIN facilities f ON r.Facility = f.Facility 
							WHERE r.Status='$status' AND f.Facilitator='" . $_SESSION['username'] . "'";
							};
						if ($_SESSION['privilege'] == 'Outsider') {
							$query2 = "SELECT r.*, f.Access 
							FROM reservations r 
							JOIN facilities f ON r.Facility = f.Facility
							WHERE f.Access='Public' 
							order by r.`Ticket ID` desc";
							
						}
						if ($_SESSION['privilege'] == 'Student') {
							$query2 = "SELECT * FROM reservations WHERE Status='$status' order by `Ticket ID` desc";
							
						}
						if ($_SESSION['privilege'] == 'Teacher') {
							$query2 = "SELECT * FROM reservations WHERE Status='$status' order by `Ticket ID` desc";
							
						}
						$results = mysqli_query($conn, $query2);
						$ctr = 1;

						while ($row = mysqli_fetch_array($results)) {
							$formattedStartDate = date('F j Y g:ia', strtotime($row['StartDate']));
							$formattedEndDate = date('F j Y g:ia', strtotime($row['EndDate']));	
							//output a row here
							$status_class = '';
							if ($row['Status'] == 'Reserved') {
								$status_class = 'green-border';
							} elseif ($row['Status'] == 'Pending') {
								$status_class = 'red-border';
							} elseif ($row['Status'] == 'Rejected') {
								$status_class = 'rejected-border';
							}

							echo "<tr>";
							echo "<td style='text-align:center;'>" . $ctr . "</td>";
							echo "<td>" . ($row['Name']) . "</td>";
							echo "<td>" . ($row['Ticket ID']) . "</td>";
							echo "<td>" . $formattedEndDate . "</td>";
							echo "<td>" . $formattedStartDate . "</td>";
							echo "<td>" . ($row['Facility']) . "</td>";
							echo "<td style='text-align:center;'><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>";
							if ($status == "Pending") {
    $username = $_SESSION['username'];
    $check_query = "SELECT * FROM approvals WHERE reservation_id = '" . ($row['Ticket ID']) . "' AND user_id = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    $ctr++;
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<td style='text-align:center;'>Approved By You</td>";
    } else {
        echo "<td style='text-align:center;'>";
        echo "<form method='GET' action='home.php'>";
        echo "<button class='review' id='view' name='approve-reservation' value='" . ($row['Ticket ID']) . "'><span>Review</span></button>";
        echo "</form>";
        echo "</td>";
    }
} else {
    echo "<td style='text-align:center;'>";
    echo "<form method='GET' action='home.php'>";
    echo "<button class='view' id='view' name='view-reservation' value='" . ($row['Ticket ID']) . "'><span>View</span></button>";
    echo "</form>";
    echo "</td>";
}
							if ($_SESSION['privilege'] == 'Admin') {
							};
							echo "</tr>";
							$ctr++;
						}
					}
					
					 

				if($_GET['status'] != 'Dashboard' && $_GET['status'] != 'Reserved' && $_GET['status'] != 'Pending' && $_GET['status'] != 'Rejected') {

					echo '<div id="div2" class="divs">';
		echo'<table id="pendingReservation">
		<tr>
		<th style="text-align:center;">No.</th>
		<th>Name</th>
		<th>Ticket ID</th>
		<th>Start</th>
		<th>End</th>
		<th>Facility</th>
		<th style="text-align:center;">Status</th>
		<th style="text-align:center;">Action</th>
		<form method="GET" action="home.php">';
					?>
                <?php
					$query2 = "SELECT * FROM reservations WHERE Status='Reserved' + 'Pending' AND Name='" . $_SESSION["username"] . "' ORDER BY `Ticket ID` DESC";
					$results = mysqli_query($conn, $query2);

					$ctr = 1;

					while ($row = mysqli_fetch_array($results)) {
						$formattedStartDate = date('F j Y g:ia', strtotime($row['StartDate']));
							$formattedEndDate = date('F j Y g:ia', strtotime($row['EndDate']));
						//output a row here
						$status_class = '';
						if ($row['Status'] == 'Reserved') {
							$status_class = 'green-border';
						} elseif ($row['Status'] == 'Pending') {
							$status_class = 'red-border';
						} elseif ($row['Status'] == 'Rejected') {
							$status_class = 'rejected-border';
						}

						echo "<tr>";
						echo "<td style='text-align:center;'>" . $ctr . "</td>";
						echo "<td>" . ($row['Name']) . "</td>";
						echo "<td>" . ($row['Ticket ID']) . "</td>";
						echo "<td>" . $formattedStartDate . "</td>";
						echo "<td>" . $formattedEndDate . "</td>";
						echo "<td>" . ($row['Facility']) . "</td>";
						echo "<td style='text-align:center;'><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>
						<form action='' method='GET'>
		<td style='text-align:center;'><button class='view' id='view' name='view-reservation' value='" . ($row['Ticket ID']) . "'>
		<span>View</span>
		</button>
		</td>
		</form>";
						if ($_SESSION['privilege'] == 'Admin') {
						}
						echo "</tr>";
						$ctr++;
					}
				}
				}
				?>
                </table>
                <?php
				if (isset ($_GET['help'])) {
					echo '<div id="div2" class="divs">
				<div style="text-align:center; margin-top:100px;"><h1>
				Help Centre
				</h1>
				<br>
				<p class="gray">We understand that sometimes you may encounter difficulties or have 
				<p class="gray">questions while using our platform, and we are here to assist you every
				<p class="gray">step of the way!
				</div>
				<div style="margin-top:50px; text-align:center; display:flex; width:90%;  justify-content:center; ">
				<div style=" padding:0 60px 0 60px; display:flexbox; height:370px; width:500px;">
				<img src="security.png" style="height:200px; width:200px;">
				<div style="display:flexbox">
				<br>
				<p>We are committed to ensuring the security
				<p>and integrity of our website and protecting
				<p>our users.
				</div>
				</div>
				<div style=" padding:0 60px 0 60px; display:flexbox; height:370px; width:500px;">
				<img src="info.png" style="height:200px; width:200px;">
				<div style="display:flexbox">
				<br>
				<p>We are here to provide you with the
				<p>information and assistance you need to
				<p>effectively manage your accounts.
				</div>
				</div>
				<div style=" padding:0 60px 0 60px; display:flexbox; height:370px; width:500px;">
				<img src="privacy.png" style="height:200px; width:200px;">
				<div style="display:flexbox">
				<br>
				<p>Protecting our privacy and ensuring the
				<p>security of our personal information is of 
				<p>utmost importance to us.
				</div> 
				</div>
				</div>
				<div style="width:100%; height:100%;">
				<div style="display:flex;">
				<div style="width:25%; height:500px; border-right: 1px solid gray;">
				</div>
				
				<div style="width:75%; padding-left:30px;">
				<div>
				<h2>Overview <span style="color:red;">(Temporary text; placeholder)</h2>
				</div>
				<br>
				<ul style="padding-left:20px;">
				<li>Item 1
				<ul style="padding-left:20px;">
				<li>Sub-item 1</li>
				<li>Sub-item 2</li>
				</ul>
				</li>
				<li>Item 2
				<ul style="padding-left:20px;">
				<li>Sub-item 1</li>
				<li>Sub-item 2</li>
				</ul>
				</li>
				</ul>
				</div>
				</div>
				</div>
				';
				}
				?>
                <?php
				if (isset ($_GET['admin']) && ($_SESSION['privilege'] == 'Admin' || ($_SESSION['privilege'] == 'Facilitator'))) {

					echo '<div id="div2" class="divs">
					<form method="get" action="home.php">';
					if ($_SESSION['privilege'] == 'Admin' || $_SESSION['privilege'] == 'Facilitator') {
						echo'<p style="padding-top:20px; font-weight:bold; filter: opacity(0.7);">Reservation Dashboard</p>
						<div class=side-panel-button-div style="display:flex;">
                        <input type="submit" class="side-panel-button" name="status" value="Pending">
						</div>
						<div class=side-panel-button-div style="display:flex;">
                        <input type="submit" class="side-panel-button" name="status" value="Reserved">
						</div>
						<div class=side-panel-button-div style="display:flex;">
                        <input type="submit" class="side-panel-button" name="status" value="Rejected">
						</div>
						</form>';
						}           
				echo'<table id="facilityList">
				<tr>
				<th style="text-align:center;">ID</th>
				<th>Facility</th>
				<th>Access</th>
				<th>Floor</th>
				<th>Facilitator</th>
				<th style="text-align:center;">Action</th>
				</tr>
				'; ?>

                <?php
					// Select data from table
					$username = $_SESSION['username'];

					if ($_SESSION['privilege'] == 'Admin') {
					$sql = "SELECT * FROM facilities";
					}

					if ($_SESSION['privilege'] == 'Facilitator') {
					$sql = "SELECT * FROM facilities WHERE Facilitator = '$username' ";
					}
					
					$result = $conn->query($sql);

					// Print data
					if ($result->num_rows > 0) {
						// Output data of each row
						while ($row = $result->fetch_assoc()) {
							echo "<tr>
							<td style='text-align:center;'>" . $row["ID"] . "</td>
							<td>" . $row["Facility"] . "</td>
							<td>" . $row["Access"] . "</td>
							<td>" . $row["Floor"] . "</td>
							<td>" . $row["Facilitator"] . "</td>
							<td style='text-align:center;'>
							<div class='flex-container'>
								<form action='home.php' method='GET'>
								<button class='edit' id='editFacilities' name='facility' value='" . $row['ID'] . ">
								<span class='edit-icon1'><img class='edit-icon'src='editing.png'></span>
								<span>Edit</span>
								</button>
								</form>
								<form action='delete.php' method='GET'>
								<button class='delete' id='deleteFacilities' name='deleteId' value='" . $row['ID'] . "'>
								<span class='delete-icon1'><img class='delete-icon'src='recycle-bin.png'></span>
								<span>Delete</span>
								</button>
								</form>
								</div>
								</td>
								</tr>";
						}
					} else {
						echo "<tr><td colspan='3'>0 results</td></tr>";
					}

					// Close connection
					$conn->close();
					?>

                <?php
					echo '</table>
				</div>';
				} elseif (isset ($_GET['status'])) {
					$status = $_GET['status'];
					if ($status == 'Pending') {

						$status = "Pending";
						echo '<div id="div2" class="divs"><div class="sort-button-container">';

						echo'<table id="pendingReservation">
						<tr>
						<th style="text-align:center;">No.</th>
						<th>Name</th>
						<th>Ticket ID</th>
						<th>Start</th>
						<th>End</th>
						<th>Facility</th>
						<th>
						<form id="myForm1" action="" method="GET">
						<div style="display:flex;">
                    <select style="padding: 0; font-weight: bold; border: none; outline: none; background-color: transparent;" id="status" name="status">
						<option value="" disabled selected style="display:none;">' . $status . ' ▼</option>
                        <option value="Pending">Pending</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </form>
				</div>
</th>
						<th style="text-align:center;">Action</th>
						</tr>';?>
<script>
    document.getElementById('status').addEventListener('change', function() {
        var selectElement = document.getElementById('status');

        // Get the selected value
        var selectedStatus = selectElement.value;

        // Log the selected value to the console
        console.log(selectedStatus);

        document.getElementById('myForm1').submit();
    });
</script>
						<?php
						if ($_SESSION['privilege'] == 'Admin'){
						$query2 = "SELECT * FROM reservations WHERE Status='$status' ORDER BY `Ticket ID` DESC";
						}
						if ($_SESSION['privilege'] == 'Super Admin'){
						$query2 = "SELECT * FROM reservations WHERE Status='$status' ORDER BY `Ticket ID` DESC";
						}

						if ($_SESSION['privilege'] == 'Facilitator'){
						$query2 = "SELECT * FROM reservations r 
						JOIN facilities f ON r.Facility = f.Facility 
						WHERE r.Status='$status' AND f.Facilitator='" . $_SESSION['username'] . "'";
						}

						$results = mysqli_query($conn, $query2);

						$ctr = 1;

						while ($row = mysqli_fetch_array($results)) {

							//output a row here
							$status_class = '';
							if ($row['Status'] == 'Reserved') {
								$status_class = 'green-border';
							} elseif ($row['Status'] == 'Pending') {
								$status_class = 'red-border';
							}
							echo "<tr>";
							echo "<td style='text-align:center;'>" . $ctr . "</td>";
							echo "<td>" . ($row['Name']) . "</td>";
							echo "<td>" . ($row['Ticket ID']) . "</td>";
							echo "<td>" . ($row['StartDate']) . "</td>";
							echo "<td>" . ($row['EndDate']) . "</td>";
							echo "<td>" . ($row['Facility']) . "</td>";
							echo "<td><span class='status-text " . $status_class . "'>" . ($row['Status']) . "</span></td>";
							echo "<td style='text-align:center;'><div class='flex-container'>";
							$username = $_SESSION['username'];
							$check_query = "SELECT * FROM approvals WHERE reservation_id = '" . ($row['Ticket ID']) . "' AND user_id = '$username'";
    $check_result = mysqli_query($conn, $check_query);
	$ctr ++;
    if (mysqli_num_rows($check_result) > 0) {
        echo "Approved By You";
    } else {				

		echo"<form action='' method='GET'>
		<button class='review' id='view' name='approve-reservation' value='" . ($row['Ticket ID']) . "'>
		<span>Review</span>
		</button>
		</form>";		
		
							// echo"<form action='authorize.php' method='GET'>
							// <button class='correct' id='accept' name='accept' value='" . ($row['Ticket ID']) . "'>
							// 	<span class='correct-icon1'><img class='correct-icon'src='correct.png'></span>
							// 	<span>Accept</span>
							// 	</button>
							// </form>
							// <form action='authorize.php' method='GET'>
							// <button class='reject' id='reject' name='reject' value='" . ($row['Ticket ID']) . "'>
							// 	<span class='reject-icon1'><img class='reject-icon'src='close.png'></span>
							// 	<span>Reject</span>
							// 	</button>
							// </form>";}
							// echo"</div>
							// </td>";
							// echo "</tr>";
						}	// $ctr++;
						}
						echo '</table>
				</div>';}
					} elseif (isset ($_GET['adminPanel'])) {
					$status = $_GET['adminPanel'];
					if ($status == 'FacilityList') {
						echo '<div id="div2" class="divs">
						       
				<table id="facilityList">
				<tr>
				<th style="text-align:center;">ID</th>
				<th>Facility</th>
				<th>Access</th>
				<th>Floor</th>
				<th>Facilitator</th>
				<th style="text-align:center;">Action</th>
				</tr>
				'; ?>

                <?php
						$username = $_SESSION['username'];
						// Select data from table
						if ($_SESSION['privilege'] == 'Admin') {
						$sql = "SELECT * FROM facilities";
						}

						if ($_SESSION['privilege'] == 'Super Admin') {
						$sql = "SELECT * FROM facilities";
						}

						if ($_SESSION['privilege'] == 'Facilitator') {
						$sql = "SELECT * FROM facilities WHERE Facilitator = '$username' ";
						}

						$result = $conn->query($sql);

						// Print data
						if ($result->num_rows > 0) {
							// Output data of each row
							while ($row = $result->fetch_assoc()) {
								echo "<tr>
								<td style='text-align:center;'>" . $row["ID"] . "</td>
								<td>" . $row["Facility"] . "</td>
								<td>" . $row["Access"] . "</td>
								<td>" . $row["Floor"] . "</td>
								<td>" . $row["Facilitator"] . "</td>
								<td style='text-align:center;'>
								<div class='flex-container'>
								<form action='home.php' method='GET'>
								<button class='edit' id='editFacilities' name='facility' value='" . $row['ID'] . "'>
								<span class='edit-icon1'><img class='edit-icon'src='editing.png'></span>
								<span>Edit</span>
								</button>
								</form>
								<form action='delete.php' method='GET'>
								<button class='delete' id='deleteFacilities' name='deleteId' value='" . $row['ID'] . "'>
								<span class='delete-icon1'><img class='delete-icon'src='recycle-bin.png'></span>
								<span>Delete</span>
								</button>
								</form>
								</div>
								</td>
								</tr>";
							}
						} else {
							echo "<tr><td colspan='3'>0 results</td></tr>";
						}
					

						// Close connection
						$conn->close();
						?>

                <?php
						echo '</table>
				</div>';
					}
					if ($status == 'Accounts') {
						echo '<div id="div3" class="divs">						
						<table id="pendingReservation">
						<tr>
						<th style="text-align:center;">ID</th>
						<th>Name</th>
						<th>Password</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Privilege</th>
						<th style="text-align:center;">Action</th>
						</tr>';
						$query2 = "SELECT * FROM accounts order by `ID` desc";
						$results = mysqli_query($conn, $query2);

						$ctr = 1;

						while ($row = mysqli_fetch_array($results)) {

							//output a row here
							echo "<tr>";
							echo "<td style='text-align:center;'>" . ($row['ID']) . "</td>";
							echo "<td>" . ($row['Username']) . "</td>";
							echo "<td>" . ($row['Password']) . "</td>";
							echo "<td>" . ($row['Email']) . "</td>";
							echo "<td>" . ($row['Phone']) . "</td>";
							echo "<td>" . ($row['Privilege']) . "</td>";
							echo "<td style='text-align:center;'><div class='flex-container'>								
							<form action='' method='GET'>
							<button class='edit' id='accept' name='edit' value='" . ($row['ID']) . "'>
								<span class='correct-icon1'><img class='correct-icon'src='editing.png'></span>
								<span>Edit</span>
								</button>
							</form>
							<form action='delete.php' method='GET'>
							<button class='reject' id='reject' name='deleteAcc' value='" . ($row['ID']) . "'>
								<span class='reject-icon1'><img class='reject-icon'src='recycle-bin.png'></span>
								<span>Delete</span>
								</button>
							</form>
							</div>
							</td>";
							echo "</tr>";
							$ctr++;
						}
						echo '</table>
				</div>';
					}
					}
					
				if (isset ($_GET['view-reservation'])) {
					
					echo '<div id="div2" class="divs">';
					$result = mysqli_query($conn, "
					SELECT reservations.*, accounts.*, facilities.*
					FROM reservations
					INNER JOIN accounts ON reservations.`Name` = accounts.`Username`
					INNER JOIN facilities ON reservations.`Facility` = facilities.`Facility`
					WHERE reservations.`Ticket ID` = '" . $_GET['view-reservation'] . "'
				");

					$row = mysqli_fetch_array($result);
					$formattedStartDate = date('F j, Y g:i A', strtotime($row['StartDate']));
					$formattedEndDate = date('F j, Y g:i A', strtotime($row['EndDate']));

					echo '<div class="parent-reservation">
				<div class="row-reservation">
				<div class="column-arrow-admin">
				<div><a href="javascript:history.back()" onclick="clearForm()">	<img style="width:35; height:35;" src="back.png"></a></div>
				</div>
				<div class="column-reservation-admin">
				<div class="invoice-container1">';
					echo '<div class="invoice-column">';
					echo '<div><span style="font-weight:bold;">Reference Number:&nbsp;</span><span>' . $row['Ticket ID'] . '</span></div>';
					echo '<span style="font-weight:bold;">Date: ' . $row['ReservationDate'] . '</span>';
					echo '</div><br>';
					echo '<div><p style="font-weight:bold;">Bill to:</p></div>';
					echo '<p>' . $row['Name'] . '</p>';
					echo '<p>' . $row['Email'] . '</p>';
					echo '<p>' . $row['Phone'] . '</p>';
					echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Info: </p>';
					echo '<p>Facility: ' . $row['Facility'] . '</p>';
					echo '<div id="reservation-dates">
					<p>Start Date: ' . $formattedStartDate  . '</p>
					<p>End Date:  ' . $formattedEndDate  . '</p></div><br>';
					echo '<span style="font-weight:bold;">Reference Number:&nbsp;</span><span>' . $row['Ticket ID'] . '</span><br>';
					echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Fee:</p>';
					echo '<p> Payment Method: G-Cash';
					echo '<div id="reservation-fee">Total Fee: ₱' . $row['Fee'] . '</div>';
					echo '<a href="img/' . $row['Payment'] . '" target="_blank">View Payment Image</a>';
					echo "</div></div>";

					echo'<div class="column-image"><div class="container-image">';
					echo '<span style="font-weight:bold;">Purpose:</span><br><br>';
					echo '<textarea readonly style="cursor:default" class="description1" name="description" rows="30" cols="50">' .  $row['Reason'] . '</textarea>';
					echo"";
					echo'</div></div></div></div></div>';
				}

				if (isset ($_GET['approve-reservation'])) {
					
					echo '<div id="div2" class="divs">';
					$result = mysqli_query($conn, "
					SELECT reservations.*, accounts.*, facilities.*
					FROM reservations
					INNER JOIN accounts ON reservations.`Name` = accounts.`Username`
					INNER JOIN facilities ON reservations.`Facility` = facilities.`Facility`
					WHERE reservations.`Ticket ID` = '" . $_GET['approve-reservation'] . "'
				");

					$row = mysqli_fetch_array($result);
					$formattedStartDate = date('F j, Y g:i A', strtotime($row['StartDate']));
					$formattedEndDate = date('F j, Y g:i A', strtotime($row['EndDate']));

					echo '<div class="parent-reservation">
				<div class="row-reservation">
				<div class="column-arrow-admin">
				<div><a href="javascript:history.back()" onclick="clearForm()">	<img style="width:35; height:35;" src="back.png"></a></div>
				</div>
				<div class="column-reservation-admin">
				<div class="invoice-container1">';
					echo '<div class="invoice-column">';
					echo '<div><span style="font-weight:bold;">Reference Number:&nbsp;</span><span>' . $row['Ticket ID'] . '</span></div>';
					echo '<span style="font-weight:bold;">Date: ' . $row['ReservationDate'] . '</span>';
					echo '</div><br>';
					echo '<div><p style="font-weight:bold;">Bill to:</p></div>';
					echo '<p>' . $row['Name'] . '</p>';
					echo '<p>' . $row['Email'] . '</p>';
					echo '<p>' . $row['Phone'] . '</p>';
					echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Info: </p>';
					echo '<p>Facility: ' . $row['Facility'] . '</p>';
					echo '<div id="reservation-dates">
					<p>Start Date: ' . $formattedStartDate  . '</p>
					<p>End Date:  ' . $formattedEndDate  . '</p></div><br>';
					echo '<span style="font-weight:bold;">Reference Number:&nbsp;</span><span>' . $row['Ticket ID'] . '</span><br>';
					echo '<p style="font-weight:bold; margin-top: 22px;">Reservation Fee:</p>';
					echo '<p> Payment Method: G-Cash';
					echo '<div id="reservation-fee">Total Fee: ₱' . $row['Fee'] . '</div>';
					echo '<a href="img/' . $row['Payment'] . '" target="_blank">View Payment Image</a>';
					echo "<form action='authorize.php' method='GET'>
							 <button class='correct' id='accept' name='accept' style='margin-top:22px;' value='" . ($row['Ticket ID']) . "'>
							 	<span class='correct-icon1'><img class='correct-icon'src='correct.png'></span>
							 	<span>Accept</span>
							 	</button>
							 </form>
							 <form action='authorize.php' method='GET'>
							 <button class='reject' id='reject' name='reject' style='margin-top:11px;' value='" . ($row['Ticket ID']) . "'>
							 	<span class='reject-icon1'><img class='reject-icon'src='close.png'></span>
							 	<span>Reject</span>
							 	</button>
							 </form></div></div>";

					echo'<div class="column-image"><div class="container-image">';
					echo '<span style="font-weight:bold;">Purpose:</span><br><br>';
					echo '<textarea readonly style="cursor:default" class="description1" name="description" rows="30" cols="50">' .  $row['Reason'] . '</textarea>';
					echo"";
					echo'</div></div></div></div></div>';
				}
				?>
                <?php
				if (isset ($_GET['edit'])) {
					$result = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `ID`='" . $_GET['edit'] . "'");
					$row = mysqli_fetch_array($result);
					if (isset($_POST['submit'])) {
						$username = $_POST['username'];
						$email = $_POST['email'];
						
						// Check if username or email changed
						$checkUsernameQuery = "SELECT * FROM `accounts` WHERE `Username`='$username' AND `ID`<>'{$_GET['edit']}'";
						$checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
						
						$checkEmailQuery = "SELECT * FROM `accounts` WHERE `Email`='$email' AND `ID`<>'{$_GET['edit']}'";
						$checkEmailResult = mysqli_query($conn, $checkEmailQuery);

						if (mysqli_num_rows($checkUsernameResult) > 0) {
						echo "<script>alert('Username already exists!');</script>";
					} elseif (mysqli_num_rows($checkEmailResult) > 0) {
						echo "<script>alert('Email already exists!');</script>";
					}
					else {
							// Update account information if username and email are unique
							mysqli_query($conn, "UPDATE `accounts` SET `Username`='$username',`Password`='{$_POST['password']}',`Email`='$email',`Phone`='{$_POST['phone']}',`Privilege`='{$_POST['privilege']}' WHERE `ID`='{$_GET['edit']}'");
							echo "<meta http-equiv='refresh' content='0; url=home.php?adminPanel=Accounts'>";
						}
					}
					echo '<div class="facility-form-parent">
							<div class="facility-form">
							<form action="" method="POST">
							
							<label for="userName">Username</label><br>
							<input type="hidden" name="id" id="account-input" value="' . $row['ID'] . '">
							<input type="text" name="username" id="account-input" value="' . $row['Username'] . '"><br><br>
							<label for="password">Password</label><br>
							<input type="text" name="password" id="account-input" value="' . $row['Password'] . '"><br><br>
							<label for="password">Email</label><br>
							<input type="text" name="email" id="account-input" value="' . $row['Email'] . '"><br><br>
							<label for="password">Phone</label><br>
							<input type="text" name="phone" id="account-input" value="' . $row['Phone'] . '"><br><br>
							<div class="custom-select" id="location" name="location">
							<select id="privilege" name="privilege" class="select-arrow">
							<option value="" disabled selected>Privilege</option>
							<option value="Outsider"' . ($row['Privilege'] == 'Outsider' ? ' selected' : '') . '>Outsider</option>
							<option value="Student"' . ($row['Privilege'] == 'Student' ? ' selected' : '') . '>Student</option>
							<option value="Teacher"' . ($row['Privilege'] == 'Teacher' ? ' selected' : '') . '>Teacher</option>
							<option value="Facilitator"' . ($row['Privilege'] == 'Facilitator' ? ' selected' : '') . '>Facilitator</option>
							<option value="Admin"' . ($row['Privilege'] == 'Admin' ? ' selected' : '') . '>Admin</option>
							<option value="Super Admin"' . ($row['Privilege'] == 'Super Admin' ? ' selected' : '') . '>Super Admin</option>
							</select>
							</div><br>
							<input style="margin-left:9px;" type="submit" class="button" name="submit" value="Update">
									</form>
									</div>
									</div>';
				} ?>

                <?php
				if (isset ($_GET['facility'])) {
					$result = mysqli_query($conn, "SELECT * FROM facilities WHERE ID='" . $_GET['facility'] . "'");
					$row = mysqli_fetch_array($result);
					$facilitator = $row['Facilitator'];
					$description = $row['Description'];
					$access = $row['Access'];
					$color = $row["Color"];
					$fee = $row["Rate"];
					$image = $row["Background"];

					if (isset ($_POST['submit'])) {
	$background_name = $_FILES['background_file']['name'];
    $background_size = $_FILES['background_file']['size'];
    $background_tmpName = $_FILES['background_file']['tmp_name'];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $background_name);
    $imageExtension = strtolower(end($imageExtension));

    if(!in_array($imageExtension, $validImageExtension)){
        echo
        "<script> alert('Invalid Image Extension'); </script>";
    }
    else if($background_size > 5000000){
        echo
        "<script> alert('Image Size Is Too Large'); </script>";
        echo
        "<meta http-equiv='refresh' content='0; url=home.php?facility-list=Facilities'>";
    }
    else {
        $new_background_name = uniqid();
        $new_background_name .= '.' . $imageExtension;

        move_uploaded_file($background_tmpName, 'img/' . $new_background_name);
						
						mysqli_query($conn, "UPDATE facilities SET Facility='" . $_POST['facility'] . "', Floor='" . $_POST['floor'] . "', Facilitator='" . $_POST['facilitator'] . "',
								Description='" . $_POST['description'] . "', Color='" . $_POST['event-color'] . "', Rate='" . $_POST['fee'] . "', Access='" . $_POST['access'] . "', Background='" . $new_background_name . "' WHERE ID='" . $row['ID'] . "'");
						echo "<meta http-equiv='refresh' content='0; url=home.php?adminPanel=FacilityList'>";
	}
					}
					echo '<div class="facility-form-parent">
							<div class="facility-form">
							<form action="" method="POST" enctype="multipart/form-data">
							
							<label for="facilityName">Facility Name</label><br>
							<input type="hidden" name="id" id="facilityName" value="' . $row['ID'] . '">
							<input type="text" name="facility" id="facilityName" value="' . $row['Facility'] . '"><br><br>
							<label for="facilityName">Location</label>
							<div class="custom-select" id="location" name="location">
							<select id="floor" name="floor" class="select-arrow">
							<option value="Grounds"' . ($row['Floor'] == 'Grounds' ? ' selected' : '') . '>Grounds</option>
							<option value="2nd Floor"' . ($row['Floor'] == '2nd Floor' ? ' selected' : '') . '>2nd Floor</option>
							<option value="3rd Floor"' . ($row['Floor'] == '3rd Floor' ? ' selected' : '') . '>3rd Floor</option>
							<option value="4th Floor"' . ($row['Floor'] == '4th Floor' ? ' selected' : '') . '>4th Floor</option>
							</select>
							</div><br>
							';
							$query1 = "SELECT * FROM accounts WHERE Privilege = 'Facilitator'";
							$result1 = mysqli_query($conn, $query1);

							if (mysqli_num_rows($result1) > 0) {
								echo "<label for='facilityName'>Facilitator</label>
								<div class='custom-select' id='facilitator' name='facilitator'>
								<select name='facilitator' class='select-arrow'>";
								echo'<option value="Facilitator" disabled>Facilitator</option>
								<option value="Admin">Admin</option>';

								while($row = mysqli_fetch_assoc($result1)) {
								// Check if the current option's value matches the value from the database
								$isSelected = ($row["Username"] == $facilitator) ? "selected" : "";
								echo "<option value='" . $row["Username"] . "' " . $isSelected . ">" . $row["Username"] . "</option>";
								}
								echo "</select></div><br>";
							} else {
								echo "No facilitators found.";
							}
							echo'<label for="description">Description</label><br>
							<textarea class="description" name="description" rows="30" cols="50" maxlength="45">' . $description . '</textarea><br><br>
							<div style="display:flex;">
							<p style="margin:0; margin-left: 7px; font-weight:bold;">Select a color:</p>
							<input style="margin-left:15;" value="' . $color . '" name ="event-color" type="color"><br><br>
							</div>
							<label for="facilityName">Rate:</label><br>
							<input type="text" name="fee" id="facilityName" value="' . $fee . '"><br><br>
							<div class="file-upload1">
							<label for="image-upload" class="i-am-a-link">
								<img src="upload.png"
								id="image-upload-label">
								</label>
								<label for="image-upload" class="i-am-a-link-2 ">
									Upload Screenshot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</label>
								<input type="hidden" id="current-file-path" value="' . $image . '">
								<input type="file" name="background_file" id="image-upload" value="' . $image . '" accept=".jpg,.jpeg,.png" class="hide-me"></div><br><br>
							<label for="">Access</label><br>'; ?>
                <?php if ($access== "Private") {
						echo '<input type="radio" id="access" name="access" value="Private" checked>
								<label for="private">Private</label><br>
								<input type="radio" id="access" name="access" value="Public">
								<label for="public">Public</label><br><br>


								
								<center><input type="submit" class="button" name="submit" value="Update"></center>
								</form>
								</div>
								</div>';
					} else if ($access == "Public") {
						echo '<input type="radio" id="access" name="access" value="Private">
									<label for="private">Private</label><br>
									<input type="radio" id="access" name="access" value="Public" checked>
									<label for="public">Public</label><br><br>	
									<center><input type="submit" class="button" name="submit" value="Update"></center>
									</form>
									</div>
									</div>';
					}
				} ?>

                <?php
				if (isset ($_GET['addFacility'])) {
					if (isset ($_POST['submit'])) {
						$facility = $_POST['facility'];
						$floor = $_POST['floor'];
						$description = $_POST['description'];
						$access = $_POST['access'];
						$facilitator = $_POST['facilitator'];
						$color = $_POST['event-color'];
						$rate = $_POST['fee'];

						$background_name = $_FILES['background_file']['name'];
    $background_size = $_FILES['background_file']['size'];
    $background_tmpName = $_FILES['background_file']['tmp_name'];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $background_name);
    $imageExtension = strtolower(end($imageExtension));

    if(!in_array($imageExtension, $validImageExtension)){
        echo
        "<script> alert('Invalid Image Extension'); </script>";
    }
    else if($background_size > 5000000){
        echo
        "<script> alert('Image Size Is Too Large'); </script>";
        echo
        "<meta http-equiv='refresh' content='0; url=home.php?facility-list=Facilities'>";
    }
    else {
        $new_background_name = uniqid();
        $new_background_name .= '.' . $imageExtension;

        move_uploaded_file($background_tmpName, 'img/' . $new_background_name);

						$query = "INSERT INTO `facilities` (`Facility`, `Floor`, `Access`, `Facilitator`, `Description`, `Color`, `Rate`, `Background`) VALUES ('$facility', '$floor', '$access', '$facilitator', '$description', '$color', '$rate', '$new_background_name')";
mysqli_query($conn, $query);
		
					}
					echo '<meta http-equiv="refresh" content="0; URL=home.php?adminPanel=FacilityList">';
					}
					echo '<div class="facility-form-parent">
							<div class="facility-form">
							<form action="" method="POST" enctype="multipart/form-data">
							
							<label for="facilityName">Facility Name</label><br>
							<input type="hidden" name="id" id="facilityName" value="">
							<input type="text" name="facility" id="facilityName" value="" required><br><br>
							<label for="facilityName">Location</label>
							<div class="custom-select" id="location" name="location">
							<select id="floor" name="floor" class="select-arrow" required>
							<option value="" disabled selected>Floor</option>
							<option value="Grounds">Grounds</option>
							<option value="2nd Floor">2nd Floor</option>
							<option value="3rd Floor">3rd Floor</option>
							<option value="4th Floor">4th Floor</option>
							</select>
							</div><br>';
							$query1 = "SELECT * FROM accounts WHERE Privilege = 'Facilitator'";
							$result1 = mysqli_query($conn, $query1);

							if (mysqli_num_rows($result1) > 0) {
								echo "<label for='facilityName'>Facilitator</label>
								<div class='custom-select' id='facilitator' name='facilitator'>
								<select name='facilitator' class='select-arrow' required>
								<option value='' disabled selected>Facilitator</option>";
								echo'<option value="Admin">Admin</option>';

								$selectedValue = "Facilitator"; // Default selected value
								while($row = mysqli_fetch_assoc($result1)) {
								// Check if the current option's value matches the value from the database
								$isSelected = ($row["Username"] == $selectedValue) ? "selected" : "";
								echo "<option value='" . $row["Username"] . "' " . $isSelected . ">" . $row["Username"] . "</option>";

								}
								echo "</select></div><br>";
							} else {
								echo "No facilitators found.";
							}
							echo'<label for="description">Description</label><br>
							<textarea class="description" name="description" rows="30" cols="50" maxlength="45" required></textarea><br><br>
							<div style="display:flex;">
							<p style="margin:0; margin-left: 7px; font-weight:bold;">Select a color: </p>';
							echo'<input style="margin-left:15;" name="event-color" type="color"><br><br>
							</div>
														<label for="facilityName">Rate:</label><br>
							<input type="text" name="fee" id="facilityName" value="" required><br><br>
							<div class="file-upload1">
							<label for="image-upload" class="i-am-a-link">
								<img src="upload.png"
								id="image-upload-label">
								</label>
								<label for="image-upload" class="i-am-a-link-2 ">
									Upload Screenshot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</label>
								<input type="file" name="background_file" id="image-upload" accept=".jpg,.jpeg,.png" required class="hide-me"></div><br><br>
							<label for="">Access</label><br>'; ?>
                <?php
					echo '<input type="radio" id="access" name="access" value="Private" required>
								<label for="private">Private</label><br>
								<input type="radio" id="access" name="access" value="Public" required>
								<label for="public">Public</label><br><br>
								
								<center><input type="submit" class="button" name="submit" value="Update"></center>
								</form>
								</div>
								</div>';
				} ?>

                <?php
				if (isset ($_GET['settings'])) {
					echo '<div id="div2" class="divs">
													<div style="text-align:left; justify-content:left; width:100%; margin-top:30px; padding-bottom:15px;">
													<div style="margin-left:20px;">
													<div><p style="font-weight:bold;">Account Settings</div>
													<div><p style="color:gray"> Customize your personal profile information</div>
													</div>
													</div>
													<div style="border-bottom: solid 1px rgb(223, 223, 223); width:100%;">
													</div>
													</div>';
				}
				?>
            </div>
        </div>
        <div class="footer_block">
            <div class="footer">
                <div class="footer_container">
                    <div class="footer_links">
                        <h3>Contact Us</h3>
                        <span>Kanlaon Cor. Don Manuel Sts. Sta.<br>
                            Mesa Heights, Quezon City</span><br>
                        <span>Tel. Nos. 87315127 | 87315198 |87311777</span><br>
                        <span>registrar@lsqc.edu.ph | admin@lsqc.edu.ph</span><br>
                    </div>
                    <div class="footer_links">
                        <h3>Accreditations</h3>
                        <p class="footer-link">PAASCU Accredited Level 3<br></p></a>
                        <p class="footer-link">CEAP Member<br></p></a>
                        <p class="footer-link">ESC Certified</p></a>
                    </div>
                    <div class="footer_links">
                        <h3>Follow Us!</h3>
                        <a href="" class="contact_icon"><img class="contact_icon"
                                src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbf0a2f2b67e3b3ba079c_Twitter%20Icon.svg"
                                height="20px" width="20" alt="Twitter icon"></a><a href="" class="contact_icon">
                            <img class="contact_icon"
                                src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbfe70fcf5a0514c5b1da_Instagram%20Icon.svg"></a>
                        <a href="" class="contact_icon"><img class="contact_icon"
                                src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dbe42e1e6034fdaba46f6_Facebook%20Icon.svg"></a>
                        <a href="" class="contact_icon"><img class="contact_icon"
                                src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0002f2b676eb4ba0869_LinkedIn%20Icon.svg"></a>
                        <a href="" class="contact_icon"><img class="contact_icon"
                                src="https://uploads-ssl.webflow.com/5966ea9a9217ca534caf139f/5c8dc0112f2b6739c9ba0871_Pinterest%20Icon.svg"></a>

                    </div>
                </div>
                <div style="text-align: center; color:white;">
                    <p>This website is a project, part of the terminal coursework for the Research/Capstone project
                        within the Science, Technology, Engineering, and Mathematics (STEM)
                    <p>strand. Created by Francisco G. Chan III, Aaron Gabriel P. Lim, and Dylan Benedict V.
                        Peñaloza of Grade 12-STEM1 in the academic year 2023-2024
                    <div style="width:100%; padding-left: 15%; padding-right: 15%;">
                        <div class="line"></div>
                    </div>
                    <p>Copyright © 2024 - Lourdes School Quezon City. All Rights Reserved
                </div>
            </div>
        </div>
</body>

</html>