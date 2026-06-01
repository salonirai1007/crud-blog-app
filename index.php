<?php
include 'config.php';

$result = mysqli_query($conn,
"SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Posts</title>
</head>
<body>

<h2>Blog Posts</h2>

<a href="dashboard.php">Dashboard</a>

<hr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<h3><?php echo $row['title']; ?></h3>

<p><?php echo $row['content']; ?></p>

<small>
<?php echo $row['created_at']; ?>
</small>

<br><br>

<a href="edit.php?id=<?php echo $row['id']; ?>">
Edit
</a>

|

<a href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this post?')">
Delete
</a>

<hr>

<?php } ?>

</body>
</html>