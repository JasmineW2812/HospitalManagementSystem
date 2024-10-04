<?php
include("../Include/patientHeader.php");
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
    <main>
        <div class="home-display">
            <div class="image-container">
                <a href="patientBookAppointment.php">
                    <span class="label">Book Appointment</span>
                    <img src="../Image/Book.jpg" class="image" alt="Book">
                </a>
            </div>
            <div class="image-container">
                <a href="healthHistory.php">
                    <span class="label">Health Report</span>
                    <img src="../Image/HealthReport.jpg" class="image" alt="Health Report">
                </a>
            </div>
            <div class="image-container">
                <a href="accountInfo.php">
                    <span class="label">Account Profile</span>
                    <img src="../Image/AccountProfile.png" class="image" alt="Account Profile">
                </a>
            </div>
        </div>
    </main>
</body>
</html>

