<?php
   require 'connection.php';
   session_start();
    if(!isset($_SESSION['username'])){
        header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
        exit();
}
?>

<!DOCTYPE html>
   <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SQLi</title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
      </head>
    <body>
        <div class="xss">
        <div class="flexxss">
        <a href="excercises.php">Back to excercices</a>
        <br>
        <br>
        <form method="POST">
            <p>Search for users in the database</p>
        <input id="searchbar" onkeyup="search_user()" type="text"
        name="search" placeholder="Search users..">
        <input type="submit" name="submit">
        </form>
        </div>
    </div>
    </body>
   </html>

   <?php


if(isset($_POST['submit'])){
    $search = $_POST['search'];
    //if sqli is detected, redirect to sqli.php
    if($search == "'1'='1"){
        echo "TRUE";
    }
    //need to add more dummy data.
    if($search == "'SELECT * FROM *" || $search == "'SELECT * FROM users'"){
        echo "[1:administrator:odC5XlRNSeTn:admin123:admin, 2:honey:FZZGXWCXNSe:ilikehoney:user]";
    }
    if($search == "'SELECT userPassword FROM users"){
        echo "[admin, 1234, securepassword, 12Howest4, IlikeCats]";
    }
    //may want to let them search in a fake database.
    else{
        $sql = "SELECT userName FROM users WHERE userName = '".$search."'";
        $result = $connSQLI->query($sql);
        if($result->num_rows > 0){
            $row=mysqli_fetch_array($result);
            echo $row['userName'];
            echo " is a user in the database";
        }
        else{
            echo "No user found";
        }
        }
    }
?>