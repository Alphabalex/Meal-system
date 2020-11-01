<?php
session_start();
$user=$_SESSION['registering'];
$contents = $_POST['contents'];
$encodedData = str_replace(' ','+',$contents);
//$decodedData = base64_decode($encodedData);
include'../includes/connection.php';
mysqli_query($db,"UPDATE users SET IMAGE_DATA='$encodedData' WHERE USERNAME='$user'");
unset($_SESSION['registering']);

?>