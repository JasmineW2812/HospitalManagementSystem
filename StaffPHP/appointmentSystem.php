<?php
session_start();
include("../Include/db_connection.php");
include("../Include/staffHeader.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['appointment_request_id']) && isset($_POST['appointment_id'])) {
        $appointmentRequestId = $_POST['appointment_request_id'];
        $appointmentId = $_POST['appointment_id'];

        $sql = "UPDATE appointment_request SET appointment_id = '$appointmentId' WHERE appointment_request_id = $appointmentRequestId";
        
        if ($conn->query($sql) === TRUE) {
            echo "Appointment updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Insufficient data received.";
    }
} else {
    echo "Invalid request method.";
}


$staff_id = $_SESSION['staff_id'];

if (isset($_GET['appointment_request_id'])) {
    $defaultAppointmentRequestId = $_GET['appointment_request_id'];
} else {
    $defaultAppointmentRequestId = null;
}

$sql = "SELECT * FROM appointment WHERE appointment_status IS NULL";
$result = $conn->query($sql);

$scheduleByDay = array();

while ($row = $result->fetch_assoc()) {
    $dayOfWeek = date('l', strtotime($row['day_of_week']));
    $scheduleByDay[$dayOfWeek][] = $row;
}

$daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Timetable</title>
</head>
<body>

<h1>Timetable</h1>

<div class="schedule-grid">
    <?php
    foreach ($daysOfWeek as $day) {
        echo "<div class='schedule-day'>";
        echo "<h2>$day</h2>";
        echo "<div class='schedule-items'>";

        if (!empty($scheduleByDay[$day])) {
            foreach ($scheduleByDay[$day] as $scheduleItem) {
                $statusClass = ($scheduleItem['appointment_status'] == 'booked') ? 'booked' : 'available';
                echo "<div class='schedule-item $statusClass'>";
                echo "<strong>Start Time:</strong> " . $scheduleItem["start_time"] . "<br>";
                echo "<strong>End Time:</strong> " . $scheduleItem["end_time"] . "<br>";
                echo "<strong>Date:</strong> " . $scheduleItem["day_of_week"] . "<br>";
                echo "<strong>Status:</strong> " . $scheduleItem["appointment_status"];
                echo "<button class='appointment-button' data-appointment-id='" . $scheduleItem["appointment_id"] . "' data-appointment-request-id='" . $defaultAppointmentRequestId . "'>Book Appointment</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No schedule for $day</p>";
        }

        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

<script>
    document.querySelectorAll('.appointment-button').forEach(button => {
        button.addEventListener('click', function() {
            console.log("Button clicked");
            const appointmentRequestId = this.getAttribute('data-appointment-request-id');
            const appointmentId = this.getAttribute('data-appointment-id');
            
            console.log("Appointment Request ID:", appointmentRequestId);
            console.log("Appointment ID:", appointmentId);
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'bookAppointment.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Appointment booked successfully.');
                } else {
                    console.error('Error booking appointment.');
                }
            };
            xhr.send('appointment_request_id=' + encodeURIComponent(appointmentRequestId) + '&appointment_id=' + encodeURIComponent(appointmentId));
        });
    });
</script>


</body>
</html>
