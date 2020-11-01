<?php
    include'../includes/connection.php';
    $id = $_GET['id'];
    $query = mysqli_query($db,"UPDATE `requests` SET status='declined' WHERE `requests`.`id` = '$id';");
        if($query)
        {
        	echo "<h3 style='text-align:center;'>Meal request has been rejected.</h3>";
        }
        else
        {
        	echo "<h3 style='text-align:center;'>Unknown error occured. Please try again.</h3>";
        }

?>
<br/><br/>
<a href="canteen_dashboard.php" style="background: royalblue; color: white; border-radius: 20px; display: block; width: 100px; padding: 10px; text-align: center;">Back</a>