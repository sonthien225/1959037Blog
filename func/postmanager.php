<?php
$errors = [];
function checkPost($post, $file, &$errors, $conn, $num) {
  $title = $_POST['title'];
  $body = $_POST['content'];
  // $cmt = $_POST['comment'];
  $author = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $imgurl = validateFile($file, "img");
  if(validateFile($file, "image")) {
    $errors['post_img'] = "There was a problem with your image upload!";
  }

  if($body == '' || $title == '') {
    $errors['post_title'] = "Post title and body cannot be empty!";
  }

  if(!$imgurl) {
    $errors['post_file'] = "There was a problem with your image upload!";
  }

  if(empty($errors) && $num == 0 ) {
    createPost($title, $body, $author, $imgurl, $user_id,  $conn);
  }
  else
  {
    updatePost($title, $body, $author, $imgurl, $num,  $conn);
  }
}

function createPost($title, $body, $author, $imgurl, $user_id,  $conn) {
  $sql = "INSERT INTO posts (Title, Content, Author, Image, Post_ID) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $title, $body, $author, $imgurl, $user_id);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    redirectToPost($stmt->insert_id, "create=success");
  }
}


function updatePost($title, $body, $author, $imgurl, $num, $conn){
  $sql = "UPDATE posts SET Title = ?, Content = ?,  Author = ?, Image = ? WHERE posts.ID = $num";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $title, $body,  $author, $imgurl);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    redirectToPost($stmt->insert_id, "create=success");
  }
}


function getPost($id, $conn) {
  $sql = "SELECT * FROM posts WHERE ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows == 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function getPosts($num_posts, $conn, $limit = 12, $offset = 0) {
  $sql = "SELECT posts.ID, posts.Title, posts.Content, posts.Author, posts.Image,posts.post_ID, test.Name FROM posts JOIN test ON test.ID = posts.Post_ID
 ORDER BY posts.Date_time DESC LIMIT ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $num_posts);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->fetch_all(MYSQLI_ASSOC);
}

function outputPosts($posts, $col = 4, $img = true, $teaserlen = 150, $readmore = true) {
  $output = "";
  foreach ($posts as $post) {
    if($img == true) {
      if($post['Image'] == '') {
        $theimg = "images/default.png";
      } else {
        $theimg = $post['Image'];
      }
      $postimg = "<img src='{$theimg}' style='max-width:100%'>";
    } else {
      $postimg = "";
    }
    $body = substr($post['Content'], 0, $teaserlen);
    $output.= "<div class='col-md-{$col}'> {$postimg}
    <h4 class='text-center'>User: <em>{$post['Author']}</em></h4>
    <h4 class='font-weight-light text-center'><a class='title' href='article.php?id={$post['ID']}'>Post : {$post['Title']}</a></h4>
    <p class='text-center'>Body : {$body}</p>
    <div class='row'>
      <div class='col-md-4 '>
        <button type='button' name='' class='btn btn-lg btn-secondary mt-3' style='color: black;'><a href='edit.php?id={$post['ID']}'>Edit Post</a> </button>
        </div>
        <div class='col-md-4 '>
        <button type='button' name='' class='btn btn-lg btn-secondary mt-3' style='color: black;'><a href='comment.php?id={$post['ID']}'>Comment</a> </button>
        </div>
        <div class='col-md-4'>
        <button type='button' name='' class='btn btn-lg btn-secondary mt-3' style='color: black;'><a href='delete.php?id={$post['ID']}'>Delete</a> </button>
      </div>
    </div>
    </div>";
  }
  return $output;
}

function redirectToPost($id, $get = false) {
  $location = "Location: index.php?id=". $id . "&created=true";
  header($location);
}?>
