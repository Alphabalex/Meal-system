<?php
    include'../includes/connection.php';
    $id = $_GET['id'];
    $query = mysqli_query($db,"select * from requests where id = '$id'");
    if(mysqli_num_rows($query) > 0)
    {
        foreach(mysqli_fetch_all($query,MYSQLI_ASSOC) as $row)
        {
            $fullname = $row['fullname'];
            $q1=mysqli_query($db,"SELECT * FROM leftovers WHERE Full_Name='$fullname'");
            while ($row=mysqli_fetch_array($q1,MYSQLI_ASSOC)) {
                 $counter=$row['Counts'];
                 $use=$row['Used'];
                 $leftover=$counter-$use;
                 $expiry=$row['Expiry_Date'];
            }
            $q2=mysqli_query($db,"SELECT * FROM meals WHERE Full_Name='$fullname'");
            while ($row=mysqli_fetch_array($q2,MYSQLI_ASSOC)) 
                {
                     $mealcount=$row['Counts'];
                     $mealused=$row['Used'];
                     $mealleft=$mealcount-$mealused;
                }
            if (isset($leftover) && $leftover > 0) 
                {
                    if ($expiry >= date("Y-m-d"))
                     {
                        $query = mysqli_query($db,"UPDATE leftovers SET Used=Used+1 WHERE Full_Name='$fullname';");
                        $query .= mysqli_query($db,"UPDATE `requests` SET status = 'accepted' WHERE `requests`.`id` = '$id';");
                        if($query)
                         {
                         echo "<h3 style='text-align:center;'>Meal request has been accepted.</h3>";
                         }
                        else
                         {
                         echo "<h3 style='text-align:center;'>Unknown error occured. Please try again.</h3>";
                         } 
                    }
                    else
                    {
                        if (isset($mealleft) && $mealleft>0) 
                        {
                          $query = mysqli_query($db,"UPDATE meals SET Used=Used+1 WHERE Full_Name='$fullname';");
                          $query .= mysqli_query($db,"UPDATE `requests` SET status='accepted' WHERE `requests`.`id` = '$id';"); 
                          echo "<h3 style='text-align:center;'>Meal request has been accepted.</h3>"; 
                        }
                        else
                        {
                          mysqli_query($db,"UPDATE `requests` SET status ='declined' WHERE `requests`.`id` = '$id';");
                          echo "<h3 style='text-align:center;'>Sorry. $fullname does not have an active meal chance.</h3>";
                        }
                        
                    }
                    
                }
                else 
                {
                $query = mysqli_query($db,"UPDATE meals SET Used=Used+1 WHERE Full_Name='$fullname';");
                $query .= mysqli_query($db,"UPDATE `requests` SET status='accepted' WHERE `requests`.`id` = '$id';");
                echo "<h3 style='text-align:center;'>Meal request has been accepted.</h3>";
                }
           
           
        }     
  }
  else
  {
    echo "<h3 style='text-align:center;'>Error occured.</h3>";
  }
    
?>
<br/><br/>
<a href="canteen_dashboard.php" style="background: royalblue; color: white; border-radius: 20px; display: block; width: 100px; padding: 10px; text-align: center;">Back</a>