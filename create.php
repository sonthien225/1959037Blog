<?php
include 'includes/header.php';
 include 'func/filemanager.php';
 include 'func/postmanager.php';

if(isset($_POST['submit'])) {
  checkPost($_POST, $_FILES, $errors,$conn, 0);
}

?>

<div class="container">
  <div class="row">
<?php if ($_SESSION['loggedin'] == false): ?>
  <div class="container text-center">
    <h2>Please Login</h2>
    <hr>
    <button type="post" name="submit" class="btn btn-lg btn-dark mt-3"><a href="login.php">Login</a> </button>
  </div>
<?php else:?>
      <div class="col-md-6 mt-5">
        <form class="" action="create.php" method="post" enctype="multipart/form-data">
          <label for="title">Post</label>
          <input type="text" name="title" placeholder="Input your title..." class="form-control mb-3" value="">
          <label for="content">Body</label>
          <textarea name="content" class="form-control mb-3" placeholder="Input your content..." rows="8" cols="80"></textarea>
          <label for="img">Image</label>
          <input type="file" name="img" value="" class=" mb-3 form-control">
          <button type="submit" name="submit" style="margin-left: 33%;" class="btn btn-danger mt-3">Create</button>
        </form>
      </div>
      <div class="col-md-6">
        <img src="http://s11.favim.com/orig/7/763/7633/76338/white-cat-with-sunglasses-white-cat-pink-white-cat-Favim.com-7633845.jpg" style="width: 100%;
    margin-top: 20px;" alt="">
      </div>
<?php endif; ?>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>
