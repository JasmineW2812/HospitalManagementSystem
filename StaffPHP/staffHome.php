<?php
session_start();
include("../Include/db_connection.php");
$staff_id = $_SESSION['staff_id'];
include("../Include/staffHeader.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="../CSS/style.css">
    <title>Document</title>

</head>

<body>

<?php
$sql = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Receptionist'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <div class="home-display">
        <div class="image-container">
            <a href="appointmentRequests.php">
                <span class="label">Appointment Requests</span>
                <img src="../Image/Book.jpg" class="image" alt="Book">
            </a>
        </div>
        <div class="image-container">
            <a href="staffAccountInfo.php">
                <span class="label">Your Info</span>
                <img src="../Image/AccountProfile.png" class="image" alt="Your Info">
            </a>
        </div>
        <div class="image-container">
            <a href="checkInPatient.php">
                <span class="label">Check In Patient</span>
                <img src="../Image/CheckIn.jpg" class="image" alt="Check In">
            </a>
        </div>
    </div>';

}

$sql = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Doctor'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <div class="home-display">
        <div class="image-container">
            <a href="viewSchedule.php">
                <span class="label">View Schedule</span>
                <img src="../Image/Book.jpg" class="image" alt="View Schedule">
            </a>
        </div>
        <div class="image-container">
            <a href="staffAccountInfo.php">
                <span class="label">Your Info</span>
                <img src="../Image/AccountProfile.png" class="image" alt="Your Info">
            </a>
        </div>
    </div>';
}

$sql = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Hospital Official'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <div class="home-display">
        <div class="image-container">
            <a href="viewData.php">
                <span class="label">View Data</span>
                <img src="../Image/Pure_blue.webp" class="image" alt="View Data">
            </a>
        </div>
        <div class="image-container">
            <a href="staffAccountInfo.php">
                <span class="label">Your Info</span>
                <img src="../Image/AccountProfile.png" class="image" alt="Your Info">
            </a>
        </div>
        <div class="image-container">
            <a href="searchUser.php">
                <span class="label">Search User</span>
                <img src="../Image/Solid_red.png" class="image" alt="Search User">
            </a>
        </div>
    </div>';
}
?>
</body>
</html>
