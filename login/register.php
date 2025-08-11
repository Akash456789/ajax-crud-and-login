<?php
include "conn.php";
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert = mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')");
    
    if ($insert) {
        $success = "Registration successful! You can login now.";
    } else {
        $error = "Something went wrong! " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>
<br>
<a href="login.php">Already have an account? Login here</a>
</body>
</html>
