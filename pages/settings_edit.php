<?php
include('../includes/connection.php');
require_once('session.php');
			$zz = $_POST['id'];
			$a = $_POST['fullname'];
            $c = $_POST['gender'];
            $d = $_POST['username'];
            $e = $_POST['password'];
	 			$query = 'UPDATE users 
	 						set FULLNAME="'.$a.'", GENDER="'.$c.'", USERNAME="'.$d.'", PASSWORD = sha1("'.$e.'")
                             WHERE ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
              <?php 

                $sql = 'SELECT ID
                          FROM users';
                $result2 = mysqli_query($db, $sql) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result2)) {
                          $a = $row['ID'];
                
        if ($_SESSION['TYPE']=='Admin'){?>

             <script type="text/javascript">
                alert("You've updated your account successfully.");
                window.location = "index.php";
            </script><?php

        }elseif ($_SESSION['TYPE']=='Staff'){?>

            <script type="text/javascript">
                alert("You've updated your account successfully.");
                window.location = "user_dashboard.php";
            </script><?php
        } elseif ($_SESSION['TYPE']=='Canteen'){?>

            <script type="text/javascript">
                alert("You've updated your account successfully.");
                window.location = "canteen_dashboard.php";
            </script><?php
        }
?>

        <?php } ?>