<?php
include("../Include/staffHeader.php");
include("../Include/db_connection.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM appointment";
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

<h2>Schedule Timetable</h2>

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

                if ($scheduleItem['appointment_status'] == 'booked') {
                    echo "<br><button onclick='updateCheckInStatus({$scheduleItem["appointment_id"]})'>Check In</button> " . $scheduleItem["check_in_status"] . "<br>";
                }
                
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
    function updateCheckInStatus(appointment_id) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4) {
                if (xmlhttp.status === 200) {
                    alert(xmlhttp.responseText);
                } else {
                    alert('Error: Something went wrong');
                }
            }
        };
        xmlhttp.open("GET", "updateCheckInStatus.php?appointment_id=" + appointment_id);
        xmlhttp.send();
    }
</script>
</body>
</html>
