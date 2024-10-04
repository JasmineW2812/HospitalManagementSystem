<?php
include("../Include/db_connection.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['appointment_request_id']) && isset($_POST['appointment_id'])) {
        $appointmentRequestId = $_POST['appointment_request_id'];
        $appointmentId = $_POST['appointment_id'];

        $sql = "UPDATE appointment_request AS ar
        INNER JOIN appointment AS a ON ar.appointment_id = a.appointment_id
        SET ar.appointment_id = '$appointmentId', a.appointment_status = 'booked'
        WHERE ar.appointment_request_id = $appointmentRequestId";
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
?>
