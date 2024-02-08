<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Honeypot</title>
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <header class="header-banner">
        <div class="main-nav">
          <nav class="nav bottom-banner" role="navigation">
            <ul>
              <li class="home"><a href="main.php">Home</a></li>
              <li class="avatar">
                <a href="avatar.php">Change avatar</a>
              </li>
              <li class="excercices"><a href="excercises.php">Excercises</a></li>
              <li class="excercices"><a href="logout.php">Logout</a></li>
            </ul>
          </nav>
        </div>
        <div class="banner">
            <div class="bottom-banner">
              <h1 class="site-title"><a href="#">Excercise 1</a></h1>
              <h2>Xss</h2>
              <p>Try it here:</p>
              <a href="xss.php">Link</a>

              <h1 class="site-title"><a href="#">Excercise 2</a></h1>
              <h2>SQLi</h2>
              <p>Try it here:</p>
              <a href="SQLi.php">Link</a>

              <h1 class="site-title"><a href="#">Excercise 3</a></h1>
              <h2>IDOR</h2>
              <p>Try it here:</p>
              <a href="idor.php">Link</a>

              <h1 class="site-title"><a href="#">Excercise 4</a></h1>
              <h2>File Upload</h2>
              <p>Try it here:</p>
              <a href="file_upload.php">Link</a>

              <h1 class="site-title"><a href="#">Excercise 5</a></h1>
              <h2>Look for the secret file</h2>
            </div>
          </div>
  </body>
</html>