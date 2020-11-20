<?php
require_once('../includes/connection.php');
$table=$_REQUEST["table"];
$col=$_REQUEST["column"];
$value=$_REQUEST["value"];
$id=$_REQUEST["id"];
$update =mysqli_query($db, "UPDATE $table SET $col= '$value' WHERE id='$id'") or die('value not updated');
if ($update) {
	echo "value updated successfully";
}
	

?>