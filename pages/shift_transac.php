<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $shift = strtoupper($_POST['shift']);
              $meal=   $_POST['meal'];
              switch($_GET['action']){
                case 'add':  
                    $query = "INSERT INTO shift
                              (SHIFT,MEAL)
                              VALUES ('{$shift}','{$meal}')";
                    mysqli_query($db,$query)or die ('Error in updating shift in Database '.$query);
                break;
              }
            ?>
              <script type="text/javascript">window.location = "shift.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>