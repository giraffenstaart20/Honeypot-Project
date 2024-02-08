<?php
    require 'connection.php';

    $loggingusername = $_POST['username'];
    $loggingpassword = $_POST['password'];
    $loggingretrypassword = $_POST['retrypassword'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'retrypassword', FILTER_DEFAULT);;


    $salt = "c1isvFdxMDdmjOlvxpecFw";
    $passwordSalted = hash_hmac("sha256", $password, $salt);
    $passwordHashed = password_hash($passwordSalted, PASSWORD_DEFAULT);

    //database connection
    
    if($connRegister->connect_error){
        die('Connection Failed : '.$connRegister->connect_error);
    }else{
        $stmt = $connRegister->prepare("insert into users(userName, userPassword, plainPassword)
        values(?, ?, ?)");
        $stmt->bind_param("sss", $username, $passwordHashed, $password);
        $stmt->execute();
        echo "Registration successfully...";
        header("Location: http://localhost/honeypotbackend/HoneyPot/login.html"); //needs to be different page
        exit();
        $stmt->close();
        $connRegister->close();
    }
?>
