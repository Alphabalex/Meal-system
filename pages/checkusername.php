<?php 
include'../includes/connection.php';
$username=$_REQUEST['q'];
$q1=mysqli_query($db,"SELECT * FROM users WHERE USERNAME ='$username'");
if (mysqli_num_rows($q1)>0) 
{
	echo "this Username has been taken, Kindly use another one";
}
else
{
	echo "Username is Available";
}
?>