<?php
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if($title == "" || $content == ""){

        $message = "<div class='alert alert-danger'>All fields are required.</div>";

    }else{

        $title = mysqli_real_escape_string($conn,$title);
        $content = mysqli_real_escape_string($conn,$content);

        mysqli_query($conn,
        "INSERT INTO posts(title,content)
        VALUES('$title','$content')");

        $message = "<div class='alert alert-success'>
        Post Added Successfully.
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Create Post</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="dashboard.php">

Blog Management System

</a>

</div>

</nav>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Create New Post</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Post Title

</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter Post Title"
required>

</div>

<div class="mb-3">

<label class="form-label">

Post Content

</label>

<textarea
name="content"
rows="6"
class="form-control"
placeholder="Write your post here..."
required></textarea>

</div>

<button
type="submit"
name="submit"
class="btn btn-success">

Add Post

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>