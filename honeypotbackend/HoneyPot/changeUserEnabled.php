<?php   
 require 'connection.php';  
 if (isset($_GET['id'])) {  
      $userID = $_GET['id'];  
      $query = "UPDATE `users` SET `enabled` = NOT `enabled` WHERE userID = '$userID'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:admin.php');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 else{
    echo "verkeerd";
 }
 ?>  