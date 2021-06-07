<?php
class Post {
  public $title;
  public $body;
  public $author;
  public $date;
  public $id;
  public $posts_array = [];
  public $conn;

  public function __construct($id, $conn) {
    $this->id = $id;
    $this->conn = $conn;
  }

  public function outputPost() {
    return "<h1>" . $this->title . "</h1>"
          . "<h4>" . $this->author . "</h4>"
          . "<p>" . $this->body . "</p>";
          var_dump($this);
  }

  public function getPost() {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $results = $stmt->get_result();
    $row = $results->fetch_assoc();
    $this->title = $row['Title'];
    $this->body = $row['Content'];
    $this->author = $row['Author'];
  }

  public function deletePost() {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    if($stmt->affected_rows == 1) {
      echo "<h1 class='display-2'>Post was deleted!</h1>";
    } else {
     echo '<div class="alert alert-danger" role="alert">
        Row not found or deleted!
      </div>';
    }
  }

}
 ?>
