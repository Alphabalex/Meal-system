<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
	if (isset($_POST['exp_del']) && !empty($_POST['pin'])){
		$pin=$_POST['pin'];
        $q1=mysqli_query($db,"SELECT * FROM pin WHERE PIN ='{$pin}'");
        if (mysqli_num_rows($q1)>0) {
            $query = "TRUNCATE TABLE exceptions";
            $result = mysqli_query($db, $query) or die(mysqli_error($db)); ?>
            <script type="text/javascript">alert("Exceptions Successfully Deleted.");window.location = "exception.php";</script>
 <?php       
    }							
   	else{
        ?>
        <script type="text/javascript">alert("Wrong Pin Supplied.");window.location = "exception.php";</script>
        <?php
    }		
}
?>