<?php
session_start();
include("../Include/db_connection.php");
if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $street_address = $_POST['streetaddress'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    $patientSql = "INSERT INTO patient (first_name, surname, dob, email, password, street_address, city, postcode) 
                   VALUES ('$first_name', '$surname', '$dob', '$email', '$password', '$street_address', '$city', '$postcode')";

    if ($conn->query($patientSql) === TRUE) {
        $patient_id = $conn->insert_id; 
        echo "New records created successfully";
        header("Location: login.php");
        exit;
    } else {
        echo "Error inserting patient record: " . $conn->error;
    }
} else {
    echo "Form submission failed.";
}

$conn->close();
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
<header>
    <img src="../Image/Logo.png" alt="Header Image" class="header-image">
    <a href = "AboutUs.php" class="btn"> About Us </a>
    <a href = "Login.php" class="btn"> Login </a>
    <a href = "SignUp.php" class="btn"> Sign Up </a>
</header>
<main>
    <div class="signup-box">
        <div class="login-text">
        <h1>Sign Up</h1>
            <form name="form" action="signUp.php" method="POST">
                <input type="text" id="first_name" name="firstname" placeholder="First Name" required>
                <input type="text" id="surname" name="surname" placeholder="Surname" required><br><br>
                <input type="date" id="dob" name="dob" placeholder="Date Of Birth" required><br><br>
                <input type="email" id="signup-email" name="email" placeholder="Email" required><br><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                <input type="text" id="street_address" name="streetaddress" placeholder="Street Address" required>
                <input type="text" id="city" name="city" placeholder="City" required><br><br>
                <input type="text" id="postcode" name="postcode" placeholder="Postcode" required><br><br>
                <input type="submit" id="btn" value="Submit" name="submit"/>
            </form>
        </div>
    </div>
</main>

</body>
</html>