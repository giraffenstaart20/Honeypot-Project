<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['username'])){
  header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
  exit();
}
$username = $_SESSION['username'];
$userData = mysqli_fetch_assoc(mysqli_query($connPic, "SELECT * FROM users WHERE userName = '".$username."'"));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Image Profile</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/change_avatar.css">
  </head>
  <body>
  <header class="header-banner">
        <div class="main-nav">
            <nav class="nav bottom-banner" role="navigation">
                <ul>
                    <li class="home"><a href="main.php">Home</a></li>
                    <li class="avatar"><a href="avatar.php">Change avatar</a></li>
                    <li class="excercices"><a href="excercises.php">Excercises</a></li>
                    <li class="excercices"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="banner">
        <div class="bottom-banner">
            <div class="upload">
            <h1>Change avatar</h1>
            <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
            <div class="upload">
                <?php
                $id = $userData["userID"];
                $name = $userData["userName"];
                $image = $userData["image"];
                ?>
                <img src="uploads/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
                <div class="round">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
    </form>
            </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
    <?php
    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["name"];

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          document.location.href = '../honeypot/avatar.php';
        </script>
        ";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = '../honeypot/avatar.php';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE users SET image = '$newImageName' WHERE userID = $id";
        mysqli_query($connPic, $query);
        move_uploaded_file($tmpName, 'uploads/' . $newImageName);
        echo
        "
        <script>
        document.location.href = '../honeypot/avatar.php';
        </script>
        ";
      }
    }
    ?>
  </body>
</html>