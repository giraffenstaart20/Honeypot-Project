<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retrypassword = $_POST['retrypassword'];

    //database connection
    $conn = new mysqli('localhost','root','','registration');
    if($conn->connect_error){  //&& $password = $retrypassword
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(username, password)
        values(?, ?)");
        $stmt->bind_param("ss", $username, $password);
        echo "Registration successfully...";
        $stmt->close();
        $conn->close();
    }
?>