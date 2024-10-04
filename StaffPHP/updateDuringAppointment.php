<?php
include("../Include/db_connection.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['during_appointment']) && isset($_POST['diagnosis']) && isset($_POST['treatment']) && isset($_POST['appointment_id']) && isset($_POST['patient_id'])) {
    $duringAppointment = $_POST['during_appointment'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $date_started = $_POST['date_started'];
    $appointmentId = $_POST['appointment_id'];
    $patientId = $_POST['patient_id'];

    $sqlUpdateAppointment = "UPDATE appointment SET during_appointment = ? WHERE appointment_id = ?";
    $stmtAppointment = $conn->prepare($sqlUpdateAppointment);
    $stmtAppointment->bind_param("si", $duringAppointment, $appointmentId);

    $sqlInsertDiagnosis = "INSERT INTO health_condition (patient_id, appointment_id, diagnosis, date_started) VALUES (?, ?, ?, ?)";
    $stmtDiagnosis = $conn->prepare($sqlInsertDiagnosis);
    $stmtDiagnosis->bind_param("iiss", $patientId, $appointmentId, $diagnosis, $date_started);
    
    $updateAppointment = $stmtAppointment->execute();
    $insertDiagnosis = $stmtDiagnosis->execute();

    $health_condition_id = $stmtDiagnosis->insert_id;

    $sqlInsertTreatment = "INSERT INTO treatment (health_condition_id, treatment) VALUES (?, ?)";
    $stmtTreatment = $conn->prepare($sqlInsertTreatment);
    $stmtTreatment->bind_param("is", $health_condition_id, $treatment);
    $insertTreatment = $stmtTreatment->execute();

    if ($updateAppointment && $insertDiagnosis && $insertTreatment) {
        header("Location: appointmentReport.php?appointment_id=" . $appointmentId . "&update_success=true");
        exit;
    } else {
        header("Location: appointmentReport.php?appointment_id=" . $appointmentId . "&update_error=true");
        exit;
    }
} else {
    header("Location: appointmentReport.php?update_error=true");
    exit;
}
?>
