<?php

require('../includes/connection.php');
require('session.php');
if (isset($_POST['btnlogin'])) {


  $users = trim($_POST['user']);
  $upass = trim($_POST['password']);
  $h_upass = sha1($upass);
if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "login.php";
                </script>
        <?php
}else{
//create some sql statement             
        $sql = "SELECT ID, FULLNAME, USERNAME, GENDER, t.TYPE
        FROM  `users` u
        join `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE  `USERNAME` ='" . $users . "' AND  `PASSWORD` =  '" . $h_upass . "'";
        $result = $db->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);
                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $found_user['ID']; 
                $_SESSION['FULLNAME'] = $found_user['FULLNAME'];
                $_SESSION['USERNAME'] = $found_user['USERNAME'];  
                $_SESSION['GENDER']  =  $found_user['GENDER']; 
                $_SESSION['TYPE']  =  $found_user['TYPE'];
                $AAA = $_SESSION['MEMBER_ID'];

        //this part is the verification if admin or user 
        if ($_SESSION['TYPE']=='Admin'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FULLNAME']; ?> Welcome!");
                      window.location = "index.php";
                  </script>
             <?php        
           
        }elseif ($_SESSION['TYPE']=='Staff'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FULLNAME']; ?> Welcome!");
                      window.location = "user_dashboard.php";
                  </script>
             <?php        
           
        }elseif ($_SESSION['TYPE']=='Canteen'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['FULLNAME']; ?> Welcome!");
                      window.location = "canteen_dashboard.php";
                  </script>
             <?php        
           
        }
            }
             else {
            //IF theres no result
              ?>
                <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "index.php";
                </script>
              <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $db->error;
        }
        
    }       
} 



if (isset($_POST['helperlogin'])) {
   if (!empty($_POST['name']) && !empty($_POST['username'])){
  $helper = trim($_POST['name']);
  $owner = trim($_POST['username']);             $sql = "SELECT ID, FULLNAME, USERNAME, GENDER, t.TYPE
        FROM  `users` u
        join `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE  `USERNAME` ='" . $owner . "'";
        $result = $db->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);
                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $found_user['ID']; 
                $_SESSION['FULLNAME'] = $found_user['FULLNAME'];
                $_SESSION['USERNAME'] = $found_user['USERNAME'];  
                $_SESSION['GENDER']  =  $found_user['GENDER']; 
                $_SESSION['TYPE']  =  $found_user['TYPE'];
                $AAA = $_SESSION['MEMBER_ID'];
$_SESSION['HELPER']=$helper;  ?>    <script type="text/javascript">
     window.location = "snapshot.php";
                  </script>
             <?php        
           
         }
             else {
            //IF theres no result
              ?>
                <script type="text/javascript">
                alert("Username Not Registered! Contact Your administrator.");
                window.location = "helper.php";
                </script>
              <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $db->error;
        }
        
    }       
} 

 $db->close();
?>