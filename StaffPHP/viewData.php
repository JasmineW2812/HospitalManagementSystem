<?php
session_start();
include("../Include/db_connection.php");
include("../Include/staffHeader.php");

$sqlAppointments = "SELECT * FROM appointment"; 
$resultAppointments = mysqli_query($conn, $sqlAppointments);

$sqlHealthConditions = "SELECT * FROM health_condition"; 
$resultHealthConditions = mysqli_query($conn, $sqlHealthConditions);

$sqlTestResults = "SELECT * FROM test_result"; 
$resultTestResults = mysqli_query($conn, $sqlTestResults);

$sqlTreatments = "SELECT * FROM treatment"; 
$resultTreatments = mysqli_query($conn, $sqlTreatments);

if (isset($_GET['search'])) {
    $search_pattern = $_GET['search'];

    $sqlAppointments = "SELECT * FROM appointment WHERE first_name LIKE '%$search_pattern%'";
    $resultAppointments = mysqli_query($conn, $sqlAppointments);

    $sqlStaff = "SELECT * FROM staff WHERE first_name LIKE '%$search_pattern%'";
    $resultStaff = mysqli_query($conn, $sqlStaff);
}

function countOccurrences($result, $field) {
    $counts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $value = $row[$field];
        if (!isset($counts[$value])) {
            $counts[$value] = 0;
        }
        $counts[$value]++;
    }
    return $counts;
}

$diagnosisCounts = countOccurrences($resultHealthConditions, 'diagnosis');
$treatmentCounts = countOccurrences($resultTreatments, 'treatment');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Appointments and Health Information</title>
</head>
<body>
<div class="table-container">
    <?php
    $appointmentCounts = array();
    $checkedInCounts = array();

    while ($row = mysqli_fetch_assoc($resultAppointments)) {
        $staffId = $row['staff_id'];
        if (!isset($appointmentCounts[$staffId])) {
            $appointmentCounts[$staffId] = 1;
        } else {
            $appointmentCounts[$staffId]++;
        }

        if ($row['check_in_status'] == 'checked_in') {
            if (!isset($checkedInCounts[$staffId])) {
                $checkedInCounts[$staffId] = 1;
            } else {
                $checkedInCounts[$staffId]++;
            }
        }

    }

    foreach ($appointmentCounts as $staffId => $appointmentCount) {
        $checkedInCount = isset($checkedInCounts[$staffId]) ? $checkedInCounts[$staffId] : 0;
        echo "Staff ID: $staffId - Total Appointments: $appointmentCount, Checked In: $checkedInCount<br>";
    }
?>
<div class="table-container">
    <h2>Appointment Counts</h2>
    <table border="1">
        <tr>
            <th>Staff ID</th>
            <th>Total Appointments</th>
            <th>Checked In</th>
        </tr>
        <?php
        foreach ($appointmentCounts as $staffId => $appointmentCount) {
            $checkedInCount = isset($checkedInCounts[$staffId]) ? $checkedInCounts[$staffId] : 0;
            echo "<tr>";
            echo "<td>$staffId</td>";
            echo "<td>$appointmentCount</td>";
            echo "<td>$checkedInCount</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>
    </table>

    <div class="table-container">
    <h2>Health Conditions</h2>
    <table border="1" class="table-scroll">
        <tr>
            <th>Diagnosis</th>
            <th>Total</th>
        </tr>
        <?php
        foreach ($diagnosisCounts as $diagnosis => $count) {
            echo "<tr>";
            echo "<td>".$diagnosis."</td>";
            echo "<td>".$count."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>
    <h2>Treatments</h2>
    <table border="1" class="table-scroll">
        <tr>
            <th>Treatment</th>
            <th>Total</th>
        </tr>

        <?php
        foreach ($treatmentCounts as $treatment => $count) {
            echo "<tr>";
            echo "<td>".$treatment."</td>";
            echo "<td>".$count."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
