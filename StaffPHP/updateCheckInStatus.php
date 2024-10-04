<?php
include("../Include/db_connection.php");
session_start();

if (isset($_GET['appointment_id']) && !empty($_GET['appointment_id'])) {

    $appointment_id = $_GET['appointment_id'];

    echo "Received appointment ID: $appointment_id <br>";

    $sqlQuery = "UPDATE appointment SET check_in_status = 'Checked in' WHERE appointment_id = $appointment_id";

    echo "SQL Query: $sqlQuery <br>";

    if (mysqli_query($conn, $sqlQuery)) {
        echo "Check-in status updated successfully";
    } else {
        echo "Error updating check-in status: " . mysqli_error($conn);
    }
} else {
    echo "Error: Appointment ID is not set or empty.";
}
?>
