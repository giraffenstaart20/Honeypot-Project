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
          <h1 class="site-title"><a href="#">Honeypot</a></h1>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus
            officia explicabo veniam, quod sed eos blanditiis autem cum, animi
            voluptatem rerum recusandae magnam laboriosam quis asperiores sunt
            quas cupiditate itaque?
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maiores,
            nobis! Eum doloribus iusto necessitatibus animi, itaque alias
            laboriosam, reprehenderit totam et quae laborum, ducimus illo soluta
            facere ex saepe libero.
          </p>
        </div>
      </div>
    </header>
  </body>
</html>
