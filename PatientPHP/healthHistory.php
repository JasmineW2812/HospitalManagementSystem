<?php
session_start();
include("../Include/db_connection.php");
include("../Include/patientHeader.php");

$patient_id = $_SESSION['patient_id'];

$sql_health_condition = "SELECT patient.first_name, 
                                health_condition.diagnosis, 
                                health_condition.date_started, 
                                health_condition.date_ended, 
                                health_condition.ongoing, 
                                treatment.type, 
                                treatment.treatment
                        FROM patient 
                        INNER JOIN health_condition ON patient.patient_id = health_condition.patient_id 
                        LEFT JOIN treatment ON health_condition.health_condition_id = treatment.health_condition_id
                        WHERE patient.patient_id = $patient_id";

$result_health_condition = $conn->query($sql_health_condition);

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
    <div class="table-container">
        <?php
        if ($result_health_condition->num_rows > 0) {
            echo "<h2>Health Condition and Treatment</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Diagnosis</th>
                        <th>Date Started</th>
                        <th>Date Ended</th>
                        <th>Ongoing</th>
                        <th>Type of Treatment</th>
                        <th>Treatment</th>
                    </tr>";
            while ($row = $result_health_condition->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["diagnosis"] . "</td>
                        <td>" . $row["date_started"] . "</td>
                        <td>" . $row["date_ended"] . "</td>
                        <td>" . $row["ongoing"] . "</td>
                        <td>" . $row["type"] . "</td>
                        <td>" . $row["treatment"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>Health Condition and Treatment</h2>";
            echo "0 results";
        }

        $sql_appointment = "SELECT patient.first_name, 
                                    appointment.day_of_week, 
                                    appointment.start_time, 
                                    appointment.end_time, 
                                    appointment.during_appointment, 
                                    appointment.check_in_status
                            FROM patient 
                            INNER JOIN appointment_request ON patient.patient_id = appointment_request.patient_id
                            INNER JOIN appointment ON appointment_request.appointment_id = appointment.appointment_id
                            WHERE patient.patient_id = $patient_id";

        $result_appointment = $conn->query($sql_appointment);

        if ($result_appointment->num_rows > 0) {
            echo "<div class='table-container'>";
            echo "<h2>Appointment History</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Appointment Date</th>
                        <th>Appointment Start Time</th>
                        <th>Appointment End Time</th>
                        <th>Appointment Type</th>
                        <th>Checked In</th>
                    </tr>";
            while ($row = $result_appointment->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["day_of_week"] . "</td>
                        <td>" . $row["start_time"] . "</td>
                        <td>" . $row["end_time"] . "</td>
                        <td>" . $row["during_appointment"] . "</td>
                        <td>" . $row["check_in_status"] . "</td>
                    </tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='table-container'>";
            echo "<h2>Appointment History</h2>";
            echo "0 results";
            echo "</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
