<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              switch($_GET['action']){
                case 'add': 
                    if (isset($_POST['giveMeal'])) {
                      $check=mysqli_query($db,"SELECT * FROM meals");
                      if (mysqli_num_rows($check)>0) { ?>
                        <script type="text/javascript">alert('Meals not Awarded! kindly clear the existing records')</script>
                        <script type="text/javascript">window.location = "awardmeal.php";</script>
                        <?php
                      }else{
                        $staffers=($_POST['username']);
                        $from=$_POST['from'];
                        $to=$_POST['to'];
                        foreach ($staffers as $staffer) {
                        $key=$staffer.'mealcount';
                        $count=$_POST[$key];
                        $q1=mysqli_query($db,"SELECT FULLNAME,LEVEL FROM users u join level l ON l.LEVEL_ID= u.LEVEL_ID  WHERE USERNAME='$staffer'");
                          while ($row=mysqli_fetch_array($q1,MYSQLI_ASSOC)) {
                          $user=$row['FULLNAME'];
                          $lvl=$row['LEVEL'];
                          }
                        
                        if ($q1) {
                          $q2=mysqli_query($db,"INSERT INTO meals(Full_Name,Level,Counts,start_date,end_date) VALUES('$user','$lvl','$count','$from','$to')"); ?>
                          <script type="text/javascript">alert('Meals successfully Awarded')</script>
                          <script type="text/javascript">window.location = "awardmeal.php";</script>
                          <?php
                        }
                        
                      }
                      }
                      
                    } 
                break;

                case 'add_overtime':
                  if (isset($_POST['giveMeal'])) {
                        $staffers=($_POST['username']);
                        $from=$_POST['from'];
                        $to=$_POST['to'];
                        foreach ($staffers as $staffer) {
                        $key=$staffer.'mealcount';
                        $count=$_POST[$key];
                        $q1=mysqli_query($db,"SELECT FULLNAME,LEVEL FROM users u join level l ON l.LEVEL_ID= u.LEVEL_ID  WHERE USERNAME='$staffer'");
                          while ($row=mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $user=$row['FULLNAME'];
                          $lvl=$row['LEVEL'];
                          $q2=mysqli_query($db,"SELECT * FROM meals WHERE Full_Name='$user'");
                          if (mysqli_num_rows($q2)>0){
                            $q3=mysqli_query($db,"UPDATE meals SET Counts=Counts +'$count', start_date='$from', end_date='$to' WHERE Full_Name='$user'");
                            }else{
                              $q3=mysqli_query($db,"INSERT INTO meals(Full_Name,Level,Counts,start_date,end_date) VALUES('$user','$lvl','$count','$from','$to')");
                            }
                          }
                           ?>
                          <script type="text/javascript">alert('Weekend Meals successfully Awarded')
                          </script>
                          <script type="text/javascript">window.location = "overtime.php";
                          </script>
                          <?php
                        }
                        
                      }    
                break;

                case 'addVisitorMeal':
                  if (isset($_POST['giveMeal'])) {
                        $staffers=($_POST['username']);
                        $from=$_POST['from'];
                        $to=$_POST['to'];
                        foreach ($staffers as $staffer) {
                        $key=$staffer.'mealcount';
                        $count=$_POST[$key];
                        $q1=mysqli_query($db,"SELECT FULLNAME,LEVEL FROM users u join level l ON l.LEVEL_ID= u.LEVEL_ID  WHERE USERNAME='$staffer'");
                          while ($row=mysqli_fetch_array($q1,MYSQLI_ASSOC)){
                          $user=$row['FULLNAME'];
                          $lvl=$row['LEVEL'];
                          $q2=mysqli_query($db,"SELECT * FROM meals WHERE Full_Name='$user'");
                          if (mysqli_num_rows($q2)>0){
                            $q3=mysqli_query($db,"UPDATE meals SET Counts=Counts +'$count', start_date='$from', end_date='$to' WHERE Full_Name='$user'");
                            }else{
                              $q3=mysqli_query($db,"INSERT INTO meals(Full_Name,Level,Counts,start_date,end_date) VALUES('$user','$lvl','$count','$from','$to')");
                            }
                          }
                           ?>
                          <script type="text/javascript">alert('Visitors Meals successfully Awarded')
                          </script>
                          <script type="text/javascript">window.location = "awardmeal.php";
                          </script>
                          <?php
                        }
                        
                      }    
                break;
              }
            ?>
          </div>

<?php
include'../includes/footer.php';
?>