<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$level = $_POST['level'];
	   	
		
	 			$query = "UPDATE level set LEVEL ='$level' WHERE
					LEVEL_ID ='$zz'";
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Updated Level Successfully.");
			window.location = "level.php";
		</script>