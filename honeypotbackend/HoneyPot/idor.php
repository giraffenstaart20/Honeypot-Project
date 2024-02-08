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
        <h1>Look for moderators</h1>
        <form action="idor.php" method="get">
            <label for="mods">Choose a moderator you want to contact:</label>
            <select name="mods" id="mods">
            <option name="mod1" value="moderator 1">Moderator 1</option>
            <option value="moderator 2">Moderator 2</option>
            <option value="moderator 2">Moderator 3</option>
            <option value="moderator 4">Moderator 4</option><br>
            </select>
            <input type="submit">
        </form>
        </div>
    </div>
    <script src="../HoneyPot/assets/js/upload.js"></script>
    </body>
</html>

<?php
if(isset($_GET['mods'])){
    $mod = $_GET["mods"];
    if($mod == "moderator 1"){ 
        echo "Name: Moderator 1 ";
        echo " email is: senne.vdc@gmail.com";
    }
    elseif($mod == "moderator 2"){
        echo "Name: Moderator 2 ";
        echo " email is: symon.acd@gmail.com";
    }
    elseif($mod == "moderator 3"){
        echo "Name: Moderator 3 ";
        echo " email is: sebastiaan.sil@gmail.com";
    }
    elseif($mod == "moderator 4 "){
        echo "Name: Moderator 4 ";
        echo " email is: ds.mod@gmail.com";
    }
    elseif($mod == "admin" || $mod == "Admin" || $mod == "ADMIN" || $mod == "administrator" || $mod == "Administrator" || $mod == "ADMINISTRATOR"){
        echo "Name: Admin ";
        echo " email is: admin.192.196.128.124@gmail.com";
    }
    else{
        echo "No moderator found";
    }
}

?>