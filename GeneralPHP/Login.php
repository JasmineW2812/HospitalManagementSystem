<?php
session_start();
include("../Include/db_connection.php");
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM patient WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $patient_id = $row['patient_id'];
        
        $_SESSION['loggedin'] = true;
        $_SESSION['is_patient'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['patient_id'] = $patient_id;
        $_SESSION['appointment_id'] = $appointment_id;
        
        header("Location: ../PatientPHP/home.php");
        exit;
    }

    $sql = "SELECT * FROM staff WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['staff_id'] = $row['staff_id']; 
        $_SESSION['appointment_id'] = $row['appointment_id'];
        header("Location: ../StaffPHP/staffHome.php"); 
        exit;
    } else {
        echo "Invalid email or password. Please try again.";
    }
}


$conn->close();
?>
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
        <div class="login-box">
            <div class="login-text">
                <h1>Login</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="email">Email:</label><br>
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="login-email" name="email" required><br>

                    <label for="password">Password:</label><br>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" required><br><br>

                    <input type="submit" value="Login">
                </form>

                <a href="SignUp.php" class="signup-button"><button>Sign Up</button></a>
            </div>
        </div>
    </main>

</body>
</html>