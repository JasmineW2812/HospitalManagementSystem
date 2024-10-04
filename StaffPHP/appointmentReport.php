<?php
include("../Include/db_connection.php");
include("../Include/staffHeader.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['appointment_id'])) {
    $appointmentId = $_GET['appointment_id'];

        $sqlAppointment = "SELECT * 
        FROM appointment_request AS ar
        INNER JOIN appointment AS a 
        ON ar.appointment_id = a.appointment_id
        WHERE ar.appointment_id = $appointmentId";
    $resultAppointment = $conn->query($sqlAppointment);


    if ($resultAppointment->num_rows > 0) {
        $appointment = $resultAppointment->fetch_assoc();

        $patientId = $appointment['patient_id'];
        $sqlPatient = "SELECT * FROM patient WHERE patient_id = $patientId";
        $resultPatient = $conn->query($sqlPatient);
        
        if ($resultPatient->num_rows > 0) {
            $patient = $resultPatient->fetch_assoc();
        } else {
            $patient = array();
        }
    } else {
        $appointment = array(); 
    }
} else {
    header("Location: appointmentNotFound.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Appointment Report</title>
</head>
<body>

<h2>Appointment Report</h2>

<?php if (!empty($appointment)): ?>
    <h3>Appointment Details</h3>
    <p><strong>Start Time:</strong> <?php echo $appointment['start_time']; ?></p>
    <p><strong>End Time:</strong> <?php echo $appointment['end_time']; ?></p>
    <p><strong>Check In Status:</strong> <?php echo $appointment['check_in_status']; ?></p>

    <?php if (!empty($patient)): ?>
        <h3>Patient Details</h3>
        <p><strong>Patient ID:</strong> <?php echo $patient['patient_id']; ?></p>
        <p><strong>Name:</strong> <?php echo $patient['first_name'] . ' ' . $patient['surname']; ?></p>
        <p><strong>Email:</strong> <?php echo $patient['email']; ?></p>
        <?php echo "<a href='../PatientPHP/healthHistory.php?patient_id=" . $patient["patient_id"] . "'>View Details</a>";?>
    <?php else: ?>
        <p>No patient details found for this appointment.</p>
    <?php endif; ?>

    <form action="updateDuringAppointment.php" class="healthreport-box" method="POST">
    <h3>During Appointment</h3>
        <label for="during_appointment">During Appointment Info:</label><br>
        <textarea id="during_appointment" name="during_appointment"></textarea><br>
        <label for="diagnosis">Diagnosis:</label><br>
        <textarea id="diagnosis" name="diagnosis"></textarea><br>
        <label for="date_started">Date Started:</label><br>
        <input type="date" id="date_started" name="date_started"><br>
        <label for="treatment">Treatment:</label><br>
        <textarea id="treatment" name="treatment"></textarea><br>
        <input type="hidden" name="appointment_id" value="<?php echo $appointmentId; ?>">
        <input type="hidden" name="patient_id" value="<?php echo $patientId; ?>">
        <input type="submit" value="Submit">
    </form> 


<?php else: ?>
    <p>No appointment details found for the provided ID.</p>
<?php endif; ?>
</body>
</html>
