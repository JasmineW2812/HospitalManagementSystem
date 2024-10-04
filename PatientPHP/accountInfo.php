<?php
session_start();
include("../Include/db_connection.php");
include("../Include/patientHeader.php");

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT * FROM patient WHERE patient_id='$patient_id'";
$result_patient = $conn->query($sql);

if ($result_patient->num_rows > 0) {
    $patient_row = $result_patient->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    $sqlsubmit = "UPDATE patient
    SET first_name = ?, 
        surname = ?, 
        email = ?, 
        street_address = ?, 
        city = ?, 
        postcode = ?
    WHERE patient_id = ?";

    $stmt = $conn->prepare($sqlsubmit);
    $stmt->bind_param('ssssssi', $first_name, $surname, $email, $street_address, $city, $postcode, $patient_id);
    $stmt->execute();
}

$conn->close();
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
    <div class="patient-info">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label> Patient ID:<br></label> <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_row['patient_id']; ?>" disabled required><br>
            <label> Name:<br> </label> <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $patient_row['first_name']; ?>"  required><br>
            <label>Surname:<br> </label> <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $patient_row['surname']; ?>"  required><br>
            <label>Date Of Birth:<br> </label> <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $patient_row['dob']; ?>" disabled required><br>
            <label>Email:<br></label>  <input type="text" class="form-control" id="email" name="email" value="<?php echo $patient_row['email']; ?>"  required><br>
            <label>Street Address:<br></label> <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo $patient_row['street_address']; ?>"  required><br>
            <label>City:<br></label>  <input type="text" class="form-control" id="city" name="city" value="<?php echo $patient_row['city']; ?>"  required><br>
            <label>Postcode:<br></label> <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $patient_row['postcode']; ?>"  required><br><br>
            <button type="submit" name="submit" id="savePersonalBtn">Save Personal Details</button>
        </form>
    </div>
</body>
</html>
