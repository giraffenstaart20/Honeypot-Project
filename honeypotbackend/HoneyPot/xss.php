<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['username'])){
  header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
  exit();
}

 $username = $_SESSION['username'];
 //push this username to fake database
  
  if($connXSS->connect_error){
      die('Connection Failed : '.$connXSS->connect_error);
  }else{
    //if username in database then don't add new user
      $sql = "SELECT userName FROM usercomments WHERE userName = '".$username."'";
      $result = $connXSS->query($sql);
      if($result->num_rows > 0){
        //user already exists
      }
      else{
        $stmt = $connXSS->prepare("insert into usercomments(userName)
        values(?)");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
      }
    }

    $sql = "SELECT comment FROM usercomments WHERE userName = '$username'";
    $result = mysqli_query($connXSS, $sql);
    $comment =  $result->fetch_assoc()['comment'];
    
    

?>

<!DOCTYPE html>
   <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xss</title>
        
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
        <label for="searchbar">Upload a comment to the site:</label>
        <input id="searchbar" type="text" name="search" placeholder="Add a comment">
        <input type="submit" name="submit" id="btn" value="Upload!">
        <br>
        <br>
        <p id="output"><?php echo $comment; ?></p>
        </form>
        </div>
    </div>
    <script src="../HoneyPot/assets/js/upload.js"></script>
    </body>
   </html>

<?php

//mag het met een fake database of moet het dummy code returnen?
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    $username = $_SESSION['username'];
    $connXSS = new mysqli('localhost','root','','comments');
    if($connXSS->connect_error){
        die('Connection Failed : '.$connXSS->connect_error);
    }else{
        $sql = "UPDATE usercomments SET comment = '$search' WHERE userName = '$username'";
        mysqli_query($connXSS, $sql);
    }
}

?>
