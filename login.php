<?php
include 'includes/header.php';
$errors = [];

if(isset($_POST['submit'])) {
  $username = $_POST['name'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM test WHERE Name = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  var_dump($result);
  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['pw1'])) {
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $row['Name'];
      $_SESSION['user_id'] = $row['ID'];
      $location = "Location:  index.php?id=" . $stmt->insert_id . "&new=true";
      header($location);

    } else {
      $errorMsg = "Password incorrect!";
      $errors['login_password'] = $errorMsg;
    }
  } else {
    $errorMsg = "User not found!";
    $errors['login_username'] = $errorMsg;
  }
}

if (isset($_POST['create'])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if ($name == '' || strlen($name) < 5) {
    $errMsg = "Name cannot empty or less than 5 character";
    $errors['errname'] = $errMsg;
  } else {
    $sql = "SELECT * FROM test WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $results = $stmt->get_result();
    var_dump($results);
    // check num_rows to see if username is taken
    // throw error if num_rows == 1
    if($results->num_rows == 1) {
      $errorMsg = "This username is taken, please use another";
      $errors['create_username'] = $errorMsg;
    }
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errMsg = "Email cannot empty or less than 5 character";
    $errors['erremail'] = $errMsg;
  }

  if ($password1 == '' || strlen($password1) < 5) {
    $errMsg = "Password cannot empty or less than 5 character";
    $errors['errpassword'] = $errMsg;
  }

  if ($password1 != $password2) {
    $errMsg = "Password doesn't match";
    $errors['errpassword2'] = $errMsg;
  }

  if (!isset($_POST['gender'])) {
    $errMsg = "Gender must be set";
    $errors['errgender'] = $errMsg;
  }else {
    $gender = $_POST['gender'];
  }

  if(empty($errors)){
    $hash = password_hash($password1, PASSWORD_DEFAULT);
    $sql = "INSERT INTO test (Name, Email, pw1, Gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$name, $email, $hash, $gender);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $_SESSION['loggedin'] = true;
      $location = "Location: index.php?id=" . $stmt->insert_id . "&new=true";
      header($location);
    }
  }
}

?>
<div class="container">
  <div class="row">
    <div class="col-md-6 mt-2 mb-5">
      <h3>Create Account</h3>
      <form class="" action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter your name" class="form-control" value="">
        <p class="error"><?php if (isset($errors['errname'])) { echo htmlspecialchars($errors['errname']);} ?></p>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Enter your email" class="form-control" value="">
        <p class="error"><?php if (isset($errors['erremail'])) { echo htmlspecialchars($errors['erremail']);} ?></p>
        <label for="password1">Password</label>
        <input type="password" name="password1" placeholder="Enter your first password" class="form-control" value="">
        <p class="error"><?php if (isset($errors['errpassword'])) { echo htmlspecialchars($errors['errpassword']);} ?></p>
        <label for="password2">Rewrite Password</label>
        <input type="password" name="password2" placeholder="Enter your second password" class="form-control" value="">
        <p class="error"><?php if (isset($errors['errpassword2'])) { echo htmlspecialchars($errors['errpassword2']);} ?></p>
        <label for="gender">Sexuality</label> <br>
        <input type="checkbox" name="gender" value="">Male <br>
        <input type="checkbox" name="gender" value="">Female <br>
        <p class="error"><?php if (isset($errors['errgender'])) { echo htmlspecialchars($errors['errgender']);} ?> <br></p>
        <button type="submit" name="create"  class="btn btn-lg btn-danger mt-3"> Create Account</button>
      </form>
    </div>
    <div class="col-md-6 mt-2 mb-5">
      <h3>Login</h3>
      <form class="" action="login.php" method="post">
        <label for="name">Username</label>
        <input type="text" name="name" class="form-control" placeholder="Input your username" value="<?php if (isset($name)) { echo htmlspecialchars($name);} ?>">
        <p class="error"><?php if(isset($errors['login_username'])) {echo htmlspecialchars($errors['login_username']);} ?></p>
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Input your username" value="">
        <p class="error"><?php if(isset($errors['login_password'])) {echo htmlspecialchars($errors['login_password']);} ?></p>
        <button type="submit" name="submit"  class="btn btn-lg btn-danger mt-3"> Login</button>
      </form>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
