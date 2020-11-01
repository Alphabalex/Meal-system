<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
	if(isset($_POST['update']))
        {
		            $newdate=$_POST['newExpiry'];
                mysqli_query($db,"UPDATE leftovers SET Expiry_Date='$newdate'"); ?>
                <script type="text/javascript">alert("Expiry Date successfully changed"); window.location = "leftover.php";</script>
                <?php
        }

   	else{
        ?>
        <script type="text/javascript">window.location = "leftover.php";</script>
        <?php
    }		
?>