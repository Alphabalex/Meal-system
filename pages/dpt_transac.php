<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $name = $_POST['name'];
              switch($_GET['action']){
                case 'add':  
                    $query = "INSERT INTO department
                              (DEPARTMENT)
                              VALUES ('{$name}')";
                    mysqli_query($db,$query)or die ('Error in updating department in Database '.$query);
                break;
              }
            ?>
              <script type="text/javascript">window.location = "department.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>