<?php
session_start();
include("../Include/db_connection.php");
include("../Include/staffHeader.php");

$staff_id = $_SESSION['staff_id'];
$sql = "SELECT * FROM staff WHERE staff_id='$staff_id'";
$result_staff = $conn->query($sql);

if ($result_staff->num_rows > 0) {
    $staff_row = $result_staff->fetch_assoc();

}

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    $sqlsubmit = "UPDATE Staff
    SET first_name = ?, 
        surname = ?, 
        email = ?, 
        street_address = ?, 
        city = ?, 
        postcode = ?
    WHERE staff_id = ?";

$stmt = $conn->prepare($sqlsubmit);

$stmt->bind_param('ssssssi', $first_name, $surname, $email, $street_address, $city, $postcode, $staff_id);

$stmt->execute();
}



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
    <form action="staffAccountInfo.php" method="post">
        <div class="staff-info">
            <label> Staff ID<br></label> <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff_row['staff_id']; ?>" disabled required><br>
            <label> Name:<br> </label> <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $staff_row['first_name']; ?>"  required><br>
            <label>Surname:<br> </label> <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $staff_row['surname']; ?>"  required><br>
            <label>Role:<br> </label> <input type="text" class="form-control" id="role" name="role" value="<?php echo $staff_row['role']; ?>"disabled  required><br>
            <label>Salary:<br> </label> <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $staff_row['salary']; ?>"disabled  required><br>
            <label>Training Certification End Date:<br> </label> <input type="text" class="form-control" id="training_certification_end_date" name="training_certification_end_date" value="<?php echo $staff_row['training_certification_end_date']; ?>"disabled  required><br>
            <label>Date Of Birth:<br> </label> <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $staff_row['dob']; ?>" disabled required><br>
            <label>Email:<br></label>  <input type="text" class="form-control" id="email" name="email" value="<?php echo $staff_row['email']; ?>"  required><br>
            <label>Street Address:<br></label> <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo $staff_row['street_address']; ?>"  required><br>
            <label>City:<br></label>  <input type="text" class="form-control" id="city" name="city" value="<?php echo $staff_row['city']; ?>"  required><br>
            <label>Postcode:<br></label> <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $staff_row['postcode']; ?>"  required><br><br>
            <button type="submit" name="submit" id="savePersonalBtn">Save Personal Details</button>
        </div>
    </form>
<?php

$conn->close();
?>
</body>
</html>
