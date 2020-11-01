<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
	if (isset($_POST['meal_del']) && !empty($_POST['pin'])){
		    $pin=$_POST['pin'];
        $q1=mysqli_query($db,"SELECT * FROM pin WHERE PIN ='{$pin}'");
        if (mysqli_num_rows($q1)>0) {
            $clearExisting=mysqli_query($db,"TRUNCATE TABLE leftovers");
            $q9=mysqli_query($db,"SELECT * FROM meals WHERE Used= 0 AND Counts !=0");
            $exceptions=mysqli_fetch_all($q9,MYSQLI_ASSOC);
            foreach ($exceptions as $exception) {
              $exempted=$exception['Full_Name'];
              $level=$exception['Level'];
              $count=$exception['Counts'];
              $from=$exception['start_date'];
              $end=$exception['end_date'];
              $q10=mysqli_query($db,"INSERT INTO exceptions(Full_Name,Level,Counts,start_date,end_date) VALUES('$exempted','$level','$count','$from','$end')");
            }
            $q4=mysqli_query($db,"SELECT * FROM meals WHERE Counts-Used > 0 AND Used !=0");
            $leftovers=mysqli_fetch_all($q4,MYSQLI_ASSOC);
            foreach ($leftovers as $leftover) {
              $owner=$leftover['Full_Name'];
              $lev=$leftover['Level'];
              $leftover_count=$leftover['Counts']-$leftover['Used'];
              $expiry_date=$leftover['end_date'];
              $q5=mysqli_query($db,"INSERT INTO leftovers(Full_Name,Level,Counts,Expiry_Date) VALUES('$owner','$lev','$leftover_count','$expiry_date')");
              if ($q5) {
                $q6=mysqli_query($db,"TRUNCATE TABLE meals"); ?>
                <script type="text/javascript">alert("Record Successfully Cleared.");window.location = "record.php";</script>
                <?php
              }

            }      
    }							
   	else{
        ?>
        <script type="text/javascript">alert("Wrong Pin Supplied.");window.location = "record.php";</script>
        <?php
    }		
}
?>