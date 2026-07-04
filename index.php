<?php
include 'config.php';

// Search
$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Pagination
$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

// Total Records
$countQuery = mysqli_query($conn,
"SELECT COUNT(*) as total FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'");

$total = mysqli_fetch_assoc($countQuery)['total'];

$totalPages = ceil($total / $limit);

// Posts
$result = mysqli_query($conn,
"SELECT *
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
ORDER BY id DESC
LIMIT $limit OFFSET $offset");

?>

<!DOCTYPE html>
<html>
<head>

<title>Blog Posts</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="index.php">

Blog Management System

</a>

</div>

</nav>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<a href="dashboard.php" class="btn btn-primary">

Dashboard

</a>

<form method="GET" class="d-flex">

<input
type="text"
name="search"
class="form-control me-2"
placeholder="Search..."
value="<?php echo htmlspecialchars($search); ?>">

<button class="btn btn-success">

Search

</button>

</form>

</div>

<?php

if(mysqli_num_rows($result)==0){

?>

<div class="alert alert-danger">

No Posts Found

</div>

<?php

}

?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="card mb-3 shadow">

<div class="card-body">

<h3>

<?php echo htmlspecialchars($row['title']); ?>

</h3>

<p>

<?php echo nl2br(htmlspecialchars($row['content'])); ?>

</p>

<p class="text-muted">

<?php echo $row['created_at']; ?>

</p>

<a
href="edit.php?id=<?php echo $row['id'];?>"
class="btn btn-warning">

Edit

</a>

<a
href="delete.php?id=<?php echo $row['id'];?>"
class="btn btn-danger"
onclick="return confirm('Delete this post?')">

Delete

</a>

</div>

</div>

<?php } ?>

<nav>

<ul class="pagination justify-content-center">

<?php

for($i=1;$i<=$totalPages;$i++){

?>

<li class="page-item <?php if($page==$i) echo 'active'; ?>">

<a
class="page-link"
href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">

<?php echo $i; ?>

</a>

</li>

<?php

}

?>

</ul>

</nav>

</div>

</body>

</html>