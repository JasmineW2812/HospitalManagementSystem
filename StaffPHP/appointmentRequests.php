<?php
session_start();
include("../Include/db_connection.php");
include("../Include/staffHeader.php");

$staff_id = $_SESSION['staff_id'];

$sql = "SELECT * FROM appointment_request WHERE appointment_id IS NULL";
$result = mysqli_query($conn, $sql);

$appointment_request = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Document</title>
</head>
<body>
    <h2>Appointment Requests</h2>
    <div class="grid-container">
        <?php
        if (!empty($appointment_request)) { 
            foreach ($appointment_request as $row) {
                echo "<div class='grid-item'>";
                echo "Subject: " . $row["subject"] . "<br>";
                echo "<a href='appointmentSystem.php?appointment_request_id=" . $row["appointment_request_id"] . "'>Select Request</a>";
                echo "</div>";
            }
        } else {
            echo "<div class='grid-item'>No messages found.</div>";
        }
        ?>
    </div>
</body>
</html>

