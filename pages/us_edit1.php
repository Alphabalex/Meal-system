<?php
include('../includes/connection.php');

			$zz = $_POST['id'];
			$a = $_POST['fullname'];
            $c = $_POST['gender'];
            $d = $_POST['username'];
            $shift=$_POST['shift'];
		
	 			$query = 
	 			"UPDATE users SET FULLNAME='$a', GENDER='$c', USERNAME='$d', SHIFT_ID='$shift'";
				if ($_POST['password'] !='') {
					$e = $_POST['password'];
					$query.=",PASSWORD = sha1('$e')";
				}

	 				$query.="WHERE ID ='$zz'";
					$result = mysqli_query($db, $query) or die(mysqli_error($db));							
?>
				<script type="text/javascript">
	                alert("You've updated account successfully.");
	                window.location = "user.php";
            	</script>