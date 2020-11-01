<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
            $dept = $_POST['dept'];
            
		
	 			$query = 'UPDATE department set DEPARTMENT="'.$dept.'" WHERE
					DEPARTMENT_ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("You've Updated Department Successfully.");
			window.location = "department.php";
		</script>