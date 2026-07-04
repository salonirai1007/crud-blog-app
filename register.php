<?php
include 'config.php';

$message="";

if(isset($_POST['register'])){

    $username=trim($_POST['username']);
    $password=trim($_POST['password']);

    if($username=="" || $password==""){

        $message="<div class='alert alert-danger'>
        All fields are required.
        </div>";

    }else{

        $password=password_hash($password,PASSWORD_DEFAULT);

        $check=mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'");

        if(mysqli_num_rows($check)>0){

            $message="<div class='alert alert-warning'>
            Username already exists.
            </div>";

        }else{

            mysqli_query($conn,

            "INSERT INTO users(username,password)

            VALUES('$username','$password')");

            $message="<div class='alert alert-success'>
            Registration Successful.
            </div>";

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>User Registration</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
name="register"
class="btn btn-success w-100">

Register

</button>

</form>

<hr>

<a
href="login.php"
class="btn btn-primary w-100">

Already Have an Account

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>