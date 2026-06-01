<?php
include 'config.php';

$message = "";

if(isset($_POST['register'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0){

        $message = "Username already exists!";

    } else {

        mysqli_query($conn,
        "INSERT INTO users(username,password)
        VALUES('$username','$password')");

        $message = "Registration Successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <input type="text"
           name="username"
           placeholder="Username"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>

<br>

<a href="login.php">Already have an account? Login</a>

</body>
</html>