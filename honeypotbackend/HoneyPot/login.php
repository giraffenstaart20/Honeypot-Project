<?php

  session_start();

  require 'connection.php';

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $username = $_POST["username"];
   

  //get hashedpassword from db
  function get_pwd_from_db($connLogin, $username){
    $sql = "SELECT userPassword FROM users WHERE userName = '".$username."'";
    $result = $connLogin->query($sql);
    $row = $result->fetch_assoc();
    return $row["userPassword"];
  }

  function get_user_from_db($connLogin, $username){
    $sql = "SELECT * FROM users WHERE userName = '".$username."'";
    $result = $connLogin->query($sql);
    $row=mysqli_fetch_array($result);
    return $row;
  }

  $salt = "c1isvFdxMDdmjOlvxpecFw";
  $password = $_POST["password"];

  $username = mysqli_real_escape_string($connLogin, $username);
  $password = mysqli_real_escape_string($connLogin, $password);

  $passwordSalted = hash_hmac("sha256", $password, $salt);
  $passwordHashed = get_pwd_from_db($connLogin, $username);

  $user = get_user_from_db($connLogin, $username);

  if(password_verify($passwordSalted, $passwordHashed) && $user['role'] == "admin" && $user['enabled'] == true){
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role'];
    echo "Admin Login successfully...";
    header("Location: http://localhost/honeypotbackend/HoneyPot/admin.php"); //needs to be different page
    exit();
  }
  elseif(password_verify($passwordSalted, $passwordHashed) && $user['enabled'] == true){
    $_SESSION['username'] = $username;
    echo "User Login successfully...";
    header("Location: http://localhost/honeypotbackend/HoneyPot/main.php"); //needs to be different page
      exit();
  }
  else{
    echo "Login failed...";
  }
  }
?>