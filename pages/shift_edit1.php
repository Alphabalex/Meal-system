<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$shift = strtoupper($_POST['shift']);
			$meal = $_POST['meal'];
	   	
		
	 			$query = "UPDATE shift set SHIFT ='$shift', MEAL='$meal' WHERE
					SHIFT_ID ='$zz'";
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Updated Shift Successfully.");
			window.location = "shift.php";
		</script>