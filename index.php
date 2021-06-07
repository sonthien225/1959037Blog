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
          
        </form>
      </div>
    </div>

    <div class="container post">
      <h2 class="display-4">Recent Posts</h2>
      <div class="row">
        <?php
        $posts = getPosts(12, $conn);
         echo outputPosts($posts);
         ?>
         <!-- <a href="index.php?delete=<?php if(isset($_GET['id'])) { echo $post->id; } ?>"><button type="button" class="btn btn-danger">Delete Post</button></a> -->

      </div>
    </div>
<?php include 'includes/footer.php'; ?>
