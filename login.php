<?php
include 'config.php';

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($sql) > 0){

        $user = mysqli_fetch_assoc($sql);

        if(password_verify($password, $user['password'])){

            $_SESSION['user'] = $username;

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Incorrect Password";
        }

    } else {

        $message = "User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>User Login</h2>

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

    <button type="submit" name="login">
        Login
    </button>

</form>

<br>

<a href="register.php">Create Account</a>

</body>
</html>