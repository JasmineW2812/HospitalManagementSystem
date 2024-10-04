<?php
include("../Include/db_connection.php");

if(isset($_SESSION["staff_id"])) {
    $staff_id = $_SESSION['staff_id'];

    $sql_receptionist = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Receptionist'";
    $result_receptionist = $conn->query($sql_receptionist);

    $sql_doctor = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Doctor'";
    $result_doctor = $conn->query($sql_doctor);

    $sql_hospital_official = "SELECT * FROM staff WHERE staff_id='$staff_id' AND role='Hospital Official'";
    $result_hospital_official = $conn->query($sql_hospital_official);

    if ($result_receptionist->num_rows > 0) {
      echo '<header>
              <a href="../StaffPHP/staffHome.php">
                <img src="../Image/Logo.png" alt="Header Image" class="header-image">
              </a>
              <a href="../StaffPHP/appointmentRequests.php" class="btn"> Appointment Requests </a>
              <a href="../StaffPHP/checkInPatient.php" class="btn"> Check In Patient </a>
              <a href="../StaffPHP/staffAccountInfo.php" class="btn"> Account Information </a>
              <a href="../GeneralPHP/Login.php" class="btn">Sign Out</a>
            </header>';
    } elseif ($result_doctor->num_rows > 0) {
      echo '<header>
            <a href="../StaffPHP/staffHome.php">
              <img src="../Image/Logo.png" alt="Header Image" class="header-image">
            </a>
            <a href="../StaffPHP/viewSchedule.php" class="btn"> View Schedule </a>
            <a href="../StaffPHP/staffAccountInfo.php" class="btn"> Account Information </a>
            <a href="../GeneralPHP/Login.php" class="btn">Sign Out</a>
          </header>';
    }
  elseif ($result_hospital_official->num_rows > 0) {
    echo '<header>
          <a href="../StaffPHP/staffHome.php">
            <img src="../Image/Logo.png" alt="Header Image" class="header-image">
          </a>
          <a href="../StaffPHP/staffAccountInfo.php" class="btn"> Account Information </a>
          <a href="../StaffPHP/viewData.php" class="btn"> View Data </a>
          <a href="../StaffPHP/searchUser.php" class="btn"> Search User </a>
          <a href="../GeneralPHP/Login.php" class="btn">Sign Out</a>
        </header>';
  }
}
?>

