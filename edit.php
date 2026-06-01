<?php
include 'config.php';

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM posts WHERE id=$id");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    mysqli_query($conn,
    "UPDATE posts
    SET title='$title',
    content='$content'
    WHERE id=$id");

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Post</title>
</head>
<body>

<h2>Edit Post</h2>

<form method="POST">

<input type="text"
       name="title"
       value="<?php echo $row['title']; ?>"
       required>

<br><br>

<textarea name="content"
          rows="6"
          cols="40"
          required><?php echo $row['content']; ?></textarea>

<br><br>

<button name="update">
Update Post
</button>

</form>

</body>
</html>