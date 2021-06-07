<?php
include 'includes/header.php';
include 'func/filemanager.php';
include 'func/postmanager.php';
$num_rows = 0;
$errors = [];
if(isset($_POST['submit'])) {
  $postid = $_POST['postid'];
  checkPost($_POST, $_FILES, $errors,$conn,$postid);
}

if(isset($_GET['id']) && $_SESSION['loggedin'] == true){
  $sql = "SELECT posts.Title, posts.Content, posts.Author, posts.Image FROM posts WHERE posts.ID = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $results = $stmt->get_result();
  if($results->num_rows == 1){
    $row = $results->fetch_assoc();
    $title = $row['Title'];
    $body = $row['Content'];
    $author = $row['Author'];
    $img = $row['Image'];
    if ($_SESSION['username'] != $author)
    {
      $errors['Author'] = "You not the author so you can't edit !!!";
    }
  }
}
  else {
  $errorMsg = "Post not found or you not the author so you can't edit !!!";
}
 ?>

 <div class="container">
   <div class="row">
     <?php if ($_SESSION['loggedin'] == false): ?>
       <div class="container text-center">
         <h2>Please Login First</h2>
         <button type="button" class="btn btn-dark mb-2"><a href='index.php'>< Back to home page</a></button><br>
         <hr>
         <button type="post" name="submit" class="btn btn-lg btn-dark mt-3"><a href="login.php">Login</a> </button>
       </div>
     <?php elseif (!empty($errors)):?>
       <div class="container">
         <h3 style="color:red; font-style:italic;"><?php echo $errors['Author']; ?></h3>
         <hr>
         <button type="button" class="btn btn-dark mb-2"><a href='index.php'>< Back to home page</a></button><br>
       </div>
     <?php else :?>
     <div class="col-md-6 mt-5 ">
       <form class="" action="edit.php" method="post" enctype="multipart/form-data">
         <label for="title">Title</label>
         <input type="text" name="title" placeholder="Input your title..." class="form-control mb-3" value="<?php echo $title ?>">
         <label for="content">Content</label>
         <textarea name="content" class="form-control mb-3" placeholder="Input your content..." rows="8" cols="80"><?php echo $body ?></textarea>
         <label for="img">Image Address</label>
         <img src="<?php echo $img ?>" style='max-width:100%'>
         <input type="file" name="img" value="" class="mt-3 mb-3 form-control">
         <input type="number" name="postid" value="<?php echo $_GET['id'];?>" hidden>
         <button type="submit" name="submit" style="margin-left: 33%;" class="btn btn-lg btn-danger mt-3">Update</button>
       </form>
     </div>
     <div class="col-md-6 ">
       <img src="https://dichvuquangcao.vn/wp-content/uploads/2021/04/yty.png" style="width: 130%;
   margin-top: 19%;" alt="">
     </div>
   <?php endif; ?>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>
