<?php
session_start();
$owner=$_SESSION['USERNAME'];
$helper=$_SESSION['HELPER'];
$contents = $_POST['contents'];
$encodedData = str_replace(' ','+',$contents);
//$decodedData = base64_decode($encodedData);
include'../includes/connection.php';
mysqli_query($db, "INSERT INTO helpers (Helper,User_Name,Image,Date) VALUES('$helper','$owner',' $encodedData',NOW())" );
?>