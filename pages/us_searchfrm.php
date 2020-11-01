<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
include'../includes/admin_only.php';
  $query2 = 'SELECT *, t.TYPE
              FROM users u
              JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
              JOIN level l ON l.LEVEL_ID=u.LEVEL_ID
              JOIN type t ON t.TYPE_ID=u.TYPE_ID
              WHERE ID ='.$_GET['id'];

  $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result2))
    {   
      $zz= $row['ID'];
      $a= $row['FULLNAME'];
      $c=$row['GENDER'];
      $d=$row['USERNAME'];
      $e=$row['PASSWORD'];
      $image=$row['IMAGE_DATA'];
      $lvl=$row['LEVEL'];
      $dpt=$row['DEPARTMENT'];
    }
    $id = $_GET['id'];
?>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"><?php echo $a; ?>'s Detail</h4>
            </div>
            <a href="user.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                    <div class="form-group row text-left">
                      <div class="col-sm-12">
                        <h5><?php echo '<img height="200px" width="200px" style="border-radius:20px;" src="data:image/jpeg;base64,'.( $image ).'"/>'; ?>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Full Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a;?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Gender<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $c; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Username<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $d; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Department<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $dpt; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Level<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $lvl; ?> <br>
                        </h5>
                      </div>
                    </div>
          </div>
          </div>

<?php
include'../includes/footer.php';
?>