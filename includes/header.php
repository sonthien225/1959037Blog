<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>BLOG</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class=""></i>BLOG</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="create.php"><i class=""></i> Create Post</a>
                    </li>
                </ul>
                <ul class="navbar-nav float-right">
                    <?php if ($_SESSION['loggedin'] == true): ?>
                      <li class="nav-item active">
                      <a class="nav-link" href="user.php">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?><span class="sr-only">(current)</span></a>                      </li>
                      <li class="nav-item active">
                        <a class="nav-link" href="logout.php"><i class="fa fa-user mr-2"></i> Logout <span class="sr-only">(current)</span></a>
                      </li>
                    <?php else: ?>
                      <li class="nav-item active">
                        <a class="nav-link" href="login.php"><i class="fa fa-user-plus mr-2"></i> Create Account | Login<span class="sr-only">(current)</span></a>
                      </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
