<?php
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    mysqli_query($conn,
    "INSERT INTO posts(title,content)
    VALUES('$title','$content')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Post</title>
</head>
<body>

<h2>Create New Post</h2>

<form method="POST">

<input type="text"
       name="title"
       placeholder="Post Title"
       required>

<br><br>

<textarea name="content"
          rows="6"
          cols="40"
          placeholder="Post Content"
          required></textarea>

<br><br>

<button name="submit">
Add Post
</button>

</form>

</body>
</html>