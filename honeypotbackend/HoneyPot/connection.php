<?php

//login conn
$connLogin = new mysqli('localhost','root','','honeypot');
if($connLogin->connect_error){  
    die('Connection Failed : '.$connLogin->connect_error);
}

//register conn
$connRegister = new mysqli('localhost','root','','honeypot');

//db_pictire_conn
$connPic = mysqli_connect('localhost','root','','honeypot');

if(!$connPic){
    die("Connection failed: ".mysqli_connect_error());
}


//db_sqli_conn
$connSQLI = new mysqli('localhost','root','','honeypot');
if($connSQLI->connect_error){  
    die('Connection Failed : '.$connSQLI->connect_error);
}

//db_xss_conn
$connXSS = new mysqli('localhost','root','','comments');


//db_file_conn
$connFile = new mysqli('localhost','root','','files');


//admin conn
$conn = mysqli_connect('localhost','root','','honeypot');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>