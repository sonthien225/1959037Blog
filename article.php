<?php
include 'db.php';
include 'includes/header.php';
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

      <div class="jumbotron jumbotron-fluid article">
        <div class="container">
          <button type="button" class="btn btn-secondary mb-2"><a href='index.php'>< Back</a></button><br>
          <?php if (isset($row)): ?>
            <img src="<?php echo $img; ?> " style='max-width:100%'>
            <h1 class="display-3"><?php echo $title; ?></h1>
            <h3>User:  <?php echo $author; ?></h3>
            <p>Body: <?php echo $body ?></p>
            <h5 class="font-weight-light"><em><?php echo date_format($date,"Y/m/d"); ?> </em></h5>
          <?php else: ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="container recent-articles">
        <div class="row">
          <?php
            if($num_rows != 0) {
              echo $body;
            }
           ?>
        </div>
      </div>
<?php include 'includes/footer.php'; ?>
