<?php include 'includes/header.php';
include 'func/filemanager.php';
include 'func/postmanager.php';
include 'classes/post.php';

$sql = "SELECT * FROM posts";
$results = $conn->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
 ?>

    <div class="jumbotron jumbotron-fluid mb-2">
      <div class="container front">
        <form class="" action="search.php" method="post">
          <h3>Welcome, nice to meet you and I want to know more about you</h3>
          <!-- <input type="text" name="search" placeholder="Enter the title...." class="form-control" value="">
          <button type="submit" name="submit" class="btn btn-outline-light btn-lg mt-3"><i class="fa fa-search mr-2"></i>Search</button> -->
        </form>
      </div>
    </div>

    <div class="container post">
      <h2 class="display-4">Posts</h2>
      <hr>
      <div class="row">
        <?php
        $posts = getPosts(12, $conn);
         echo outputPosts($posts);
         ?>
         <!-- <a href="index.php?delete=<?php if(isset($_GET['id'])) { echo $post->id; } ?>"><button type="button" class="btn btn-danger">Delete Post</button></a> -->

      </div>
    </div>
<?php include 'includes/footer.php'; ?>
