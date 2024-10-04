<?php
session_start();
include("../Include/db_connection.php");
include("../Include/patientHeader.php");

$patient_id = $_SESSION['patient_id'];

if(isset($_POST['submit'])){
    $patient_id = $_SESSION['patient_id']; 
    $about_appointment = $_POST['about_appointment'];
    $subject = $_POST['subject'];

    $appointmentsql = "INSERT INTO appointment_request (patient_id, about_appointment,subject) 
    VALUES ('$patient_id', '$about_appointment','$subject')";

    if ($conn->query($appointmentsql) === TRUE) {
        echo "Appointment request submitted successfully";
    } else {
        echo "Error inserting appointment request: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Appointment Request</title>
</head>
<body>

<main>
    <div class="signup-box">
        <div class="login-text">
            <h2>Appointment Request</h2>
            <form name="form" action="patientBookAppointment.php" method="POST">
                <h3>Subject</h3>
                <input type="text" id="subject" name="subject" placeholder="" required>
                <h3>Explain why you need an appointment</h3>
                <input type="text" id="about_appointment" name="about_appointment" placeholder="" required>
                <input type="submit" id="btn" value="Submit" name="submit"/>
            </form>
        </div>
    </div>
</main>

</body>
</html>
