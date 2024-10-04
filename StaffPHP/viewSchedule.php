<?php
session_start();
include("../Include/staffHeader.php");
include("../Include/db_connection.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$staff_id = $_SESSION['staff_id'];

$sql = "SELECT * FROM appointment WHERE staff_id = $staff_id";
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
<link rel ="stylesheet" href="../CSS/style.css">
<title>Timetable</title>
</head>
<body>

<h2>Timetable</h2>

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

                echo "<a href='appointmentReport.php?appointment_id=" . $scheduleItem["appointment_id"] . "'>View Details</a>";


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

</body>
</html>
