<?php
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="dashboard.php">
            Blog Management System
        </a>

        <div class="text-white">
            Welcome,
            <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
        </div>

    </div>

</nav>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h2 class="mb-4">
                Dashboard
            </h2>

            <p class="lead">
                Welcome to your Blog Management System
            </p>

            <hr>

            <a href="create.php" class="btn btn-success m-2">
                ➕ Create New Post
            </a>

            <a href="index.php" class="btn btn-primary m-2">
                📄 View All Posts
            </a>

            <a href="logout.php" class="btn btn-danger m-2">
                🚪 Logout
            </a>

        </div>

    </div>

</div>

</body>

</html>