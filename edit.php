<?php
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM posts WHERE id='$id'");

$row = mysqli_fetch_assoc($result);

$message="";

if(isset($_POST['update'])){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if($title=="" || $content==""){

        $message="<div class='alert alert-danger'>
        All fields are required.
        </div>";

    }else{

        $title=mysqli_real_escape_string($conn,$title);
        $content=mysqli_real_escape_string($conn,$content);

        mysqli_query($conn,

        "UPDATE posts
        SET title='$title',
        content='$content'
        WHERE id='$id'");

        header("Location:index.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Post</title>

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

<div class="card-header bg-warning">

<h3>Edit Post</h3>

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
value="<?php echo htmlspecialchars($row['title']); ?>"
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
required><?php echo htmlspecialchars($row['content']); ?></textarea>

</div>

<button
class="btn btn-warning"
name="update">

Update Post

</button>

<a
href="index.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>