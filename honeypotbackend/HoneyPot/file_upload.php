<?php
    require 'connection.php';
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
      exit();
    }
    $username = $_SESSION['username'];

    if($connFile->connect_error){
        die('Connection Failed : '.$connFile->connect_error);
    }else{
      //if username in database then don't add new user
        $sql = "SELECT userName FROM userfiles WHERE userName = '".$username."'";
        $result = $connFile->query($sql);
        if($result->num_rows > 0){
          //user already exists
        }
        else{
          $stmt = $connFile->prepare("insert into userfiles(userName)
          values(?)");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $stmt->close();
          $connFile->close();
        }
      }
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
        <h1>Upload your file with complains</h1>
        <div class="upload">
        <form action="file_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <button type="submit" name="upload">Upload!</button>
        </div>
      </div>
        </form>
        </div>
    </div>
    </body>
</html>


<?php
    
if(isset($_POST['upload'])){
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder="fileUploads/";

    $new_size = $file_size/1024;  
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);	
    
    $validFileExtension = ['txt'];
    $fileExtension = explode('.', $file);
    $fileExtension = strtolower(end($fileExtension));

    //check for file size
    if($fileExtension == 'exe'){
        echo "File uploaded successfully";
    }
    else{
        if($fileExtension != 'txt' || $file_size > 1000000){
            echo "Error while uploading file";
        }
        else{
            if(move_uploaded_file($file_loc,$folder.$final_file)){
                $sql="UPDATE userfiles SET file = '$final_file', type = '$file_type' WHERE userName = '".$username."'";
                mysqli_query($connFile,$sql);
                
                echo "File uploaded successfully";
            }
            else{
                echo "Error while uploading file";
            }
        }
    }
}

?>