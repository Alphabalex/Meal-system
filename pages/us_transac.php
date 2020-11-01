<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $name = $_POST['fullname'];
              $gender=$_POST['gender'];
              $user = $_POST['username'];
              $pass = $_POST['password'];
              $level= $_POST['level'];
              $dept=  $_POST['dept'];
              $type=  $_POST['type'];
              $shift= $_POST['shift'];
        
              switch($_GET['action']){
                case 'add':    
                    $query = "INSERT INTO users
                              (ID, FULLNAME, USERNAME, PASSWORD, TYPE_ID, LEVEL_ID, DEPARTMENT_ID, SHIFT_ID, GENDER)
                              VALUES (Null,'{$name}','{$user}',sha1('{$pass}'), '{$type}', '{$level}', '{$dept}', '{$shift}', '{$gender}')";
                    if (mysqli_query($db,$query)) {
                      session_start();
                      $_SESSION['registering']= $user;
                    }  
                break;
              }
            ?>
              <script type="text/javascript">window.location = "capture.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>