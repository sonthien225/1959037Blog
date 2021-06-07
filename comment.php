<?php
include 'func/postmanager.php';
include 'classes/Comment.php';
include 'includes/header.php';

if(isset($_GET['id'])) {
  $post = getPost($_GET['id'], $conn);
  $theid = $_GET['id'];
  $comments = new Comment($theid, $conn);
  $comments->getComments();
}

 ?>
 
 <div class="container post mt-5">
   <div class="row">
     <?php if ($post == false): ?>
       <h2 class="display-4">404 Post Not Found!</h2>
      </div>
     <?php else: ?>
       <div class="col-md-8 offset-md-2">
          <img src="<?php echo $post['Image']; ?>" class="img-fluid" alt="">
          <h2 class="font-weight-light mt-4"><?php echo htmlspecialchars($post['Title']); ?></h2>
           <p><?php echo htmlspecialchars($post['Content']); ?></p>
          <h5><em><?php echo htmlspecialchars($post['Date_time']); ?>
          </em></h5>
       </div>
     </div> <!-- end of post row -->

     <!-- comment row -->
     
      <h3 class="display-4 mt-3 mb-3">Comments</h3>
    
     <div class="row comments">
       <div class="col-md-8 form">
         <?php if ($_SESSION['loggedin']): ?>
           <form class="comment-form" method="POST" action="func/ajaxManager.php?comment=true&<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
             <textarea name="comment-text" class="form-control" rows="4" cols="80"></textarea>
             <input type="hidden" name="id" value="<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
             <button type="submit" name="comment-submit" class="btn btn-outline-success mt-2">Add Comment</button>
           </form>
           <?php $comments->outputComments();?>
         <?php else: ?>
           <h3>Please login to comment!</h3>
           <a href="login.php"><button type="button" class="btn btn-primary btn-lg">Login</button></a>
         <?php endif; ?>

       </div>


     </div>
   <?php endif; ?>

 </div>

 <?php
 $queryIDCount = count($_SESSION['query_history']) -2;
 $queryStrPos = strpos($_SESSION['query_history'][$queryIDCount],"id");
 $queryId = substr($_SESSION['query_history'][$queryIDCount],$queryStrPos);
 $queryId = explode("=", $queryId);

 include 'includes/footer.php';
  ?>
