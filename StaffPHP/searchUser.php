<?php
session_start();
include("../Include/db_connection.php");
include("../Include/staffHeader.php");

$sqlPatient = "SELECT * FROM patient"; 
$resultPatient = mysqli_query($conn, $sqlPatient);

$sqlStaff = "SELECT * FROM staff"; 
$resultStaff = mysqli_query($conn, $sqlStaff);

if (isset($_GET['search'])) {
    $search_pattern = $_GET['search'];

    $sqlPatient = "SELECT * FROM patient WHERE first_name LIKE '%$search_pattern%'";
    $resultPatient = mysqli_query($conn, $sqlPatient);

    $sqlStaff = "SELECT * FROM staff WHERE first_name LIKE '%$search_pattern%'";
    $resultStaff = mysqli_query($conn, $sqlStaff);
}

function sortStaffByExpiryDate($conn) {
    $sqlStaff = "SELECT * FROM staff ORDER BY training_certification_end_date";
    $resultStaff = mysqli_query($conn, $sqlStaff);
    return $resultStaff;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Patients and Staff Information</title>
</head>
<body>
<div class="table-container">
    <h2>Patients Information</h2>
    <form method="GET" action="">
        <input type="text" id="searchpatient" name="search" placeholder="Enter Patient First Name" required>
        <button type="submit">Search Patients</button>
    </form>
    <table border="1">
        <tr>
            <th>Patient ID</th>
            <th>First name</th>
            <th>Surname</th>
            <th>Date Of Birth</th>
            <th>Email</th>
            <th>Street Address</th>
            <th>City</th>
            <th>Postcode</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultPatient)) {
            echo "<tr>";
            echo "<td>".$row['patient_id']."</td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['surname']."</td>";
            echo "<td>".$row['dob']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['street_address']."</td>";
            echo "<td>".$row['city']."</td>";
            echo "<td>".$row['postcode']."</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Staff Information</h2>
    <form method="GET" action="">
        <input type="text" id="searchstaff" name="search" placeholder="Enter Staff First Name" required>
        <button type="submit">Search Staff</button>
    </form>
    <form method="GET" action="">
        <button type="submit" name="sort">Sort Staff by Certificate Expiry Date</button>
    </form>
    <table border="1">
        <tr>
            <th>Staff ID</th>
            <th>First name</th>
            <th>Surname</th>
            <th>Date Of Birth</th>
            <th>Email</th>
            <th>Salary</th>
            <th>Street Address</th>
            <th>City</th>
            <th>Postcode</th>
            <th>Training Certificate Expiry</th>
        </tr>
        <?php
        if (isset($_GET['sort'])) {
            $resultStaff = sortStaffByExpiryDate($conn);
        } 

        while ($row = mysqli_fetch_assoc($resultStaff)) {
            echo "<tr>";
            echo "<td>".$row['staff_id']."</td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['surname']."</td>";
            echo "<td>".$row['dob']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['salary']."</td>";
            echo "<td>".$row['street_address']."</td>";
            echo "<td>".$row['city']."</td>";
            echo "<td>".$row['postcode']."</td>";
            echo "<td>".$row['training_certification_end_date']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

