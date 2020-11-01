<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $level = $_POST['level'];
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO level
                    (LEVEL)
                    VALUES ('{$level}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "level.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>