<?php
include 'includes/header.php';
include 'classes/post.php';

if (isset($_GET['delete']))
 {
  $post = new Post($_GET['delete'], $conn);
  $post->deletePost();
}

$num_rows = 0;
if(isset($_GET['id'])) {
  $sql = "SELECT posts.Date_time, posts.Title, posts.Content, posts.Author, posts.Post_ID, posts.Image
  FROM posts JOIN test ON test.ID = posts.Post_ID WHERE posts.ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $results = $stmt->get_result();
  if($results->num_rows == 1) {
    $row = $results->fetch_assoc();
    $title = $row['Title'];
    $date = date_create($row['Date_time']);
    $body = $row['Content'];
    $author = $row['Author'];
    $author_id = $row['Post_ID'];
    $img = $row['Image'];
  }
} else {
  $errorMsg = "Post not found!";
}
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <button type="button" class="btn btn-danger mb-2"><a href='index.php'>< Back to home page</a></button><br>
    <?php if (isset($row)): ?>
      <img src="<?php echo $img; ?> " style='max-width:100%'>
      <h1 class="display-3"><?php echo $title; ?></h1>
      <h3>Author: <?php echo $author; ?></h3>
      <p>Content: <?php echo $body ?></p>
      <h5 class="font-weight-light"><em><?php echo date_format($date,"Y/m/d"); ?> </em></h5>
      <hr>
      <h3 style="color:black; font-style:italic;">Are you sure want to delete this post!!!</h3>
      <a href="delete.php?delete=<?php if(isset($_GET['id'])) { echo $_GET['id']; } ?>"><button type="button" class="btn btn-danger"> <i class='far fa-trash-alt mr-2'></i>Delete Post</button></a>
    <?php endif; ?>
  </div>
</div>











<?php
include 'includes/footer.php';
?>
