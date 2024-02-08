<?php
session_start();
echo $_SESSION['role'];

require 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
    exit();
} elseif ($_SESSION['role'] != "admin") {
    header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
    exit();
} 

if ($connRegister->connect_error) {
    die('Connection Failed : ' . $connRegister->connect_error);
} else {
    $query = "SELECT * FROM users;";
    $run = mysqli_query($conn, $query);

    $queryCheckAdmin = "SELECT * FROM users WHERE role='admin';";
    $runCheckAdmin = mysqli_query($conn, $queryCheckAdmin);
    $resCheckAdmin = mysqli_fetch_assoc($runCheckAdmin);
}

//check via db of user wel admin is (heb het hier moeten zetten aangezien dak eerst connectioe moe maken met db voor dat werkt)
if ($_SESSION['username'] != $resCheckAdmin['userName']){
    header("Location: http://localhost/honeypotbackend/HoneyPot/login.html");
    exit();
}

$username = $_SESSION["username"];
echo $_SESSION["username"];
error_log("username: ".$username, E_USER_WARNING);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="main">
        <h1>Users active</h1>
        <div class="active-users">
            <?php include('usersontxt.php'); ?>
        </div>

            <h1>All users</h1>
            <div class="all-users">
                <table>
                    <tr class="heading">
                        <th>userID</th>
                        <th>userName</th>
                        <th>role</th>
                        <th>enabled</th>
                        <th>change enabled value</th>
                    </tr>
                    <?php

                    if ($num = mysqli_num_rows($run) > 0) {
                        while ($result = mysqli_fetch_assoc($run)) {
                            echo "  
                                    <tr class='data'>  
                                        <td>" . $result['userID'] . "</td>  
                                        <td>" . $result['userName'] . "</td>  
                                        <td>" . $result['role'] . "</td>
                                        <td>" . $result['enabled'] . "</td>
                                        <td><a href='changeUserEnabled.php?id=".$result['userID']."'>Change</a></td> 
                                    </tr>  
                                ";
                        }
                    }
                    ?>
                </table>
        </div>
    </div>
</body>

</html>