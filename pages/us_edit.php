<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
include'../includes/admin_only.php';

$query = "SELECT ID, SHIFT_ID, FULLNAME, GENDER, USERNAME, PASSWORD, t.TYPE, u.TYPE_ID
              FROM users u
              join type t on u.TYPE_ID=t.TYPE_ID
              WHERE ID =".$_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
  while($row = mysqli_fetch_array($result))
  {  
        $zz= $row['ID'];
        $shift_id=$row['SHIFT_ID'];
        $a= $row['FULLNAME'];
        $c=$row['GENDER'];
        $d=$row['USERNAME'];
        $e=$row['PASSWORD'];
        $l=$row['TYPE'];
        $type_id=$row['TYPE_ID'];
  }
    $id = $_GET['id'];

$sql4 = "SELECT * FROM shift ORDER BY SHIFT";
$result = mysqli_query($db, $sql4) or die ("Bad SQL: $sql");

$shift = "<select class='form-control' name='shift' required>";
  while ($row = mysqli_fetch_assoc($result)) {
    if ($shift_id == $row['SHIFT_ID']) 
    {
        $shift .= "<option value='".$row['SHIFT_ID']."' selected>".$row['SHIFT']."</option>";
    } 
    else
    {
      $shift .= "<option value='".$row['SHIFT_ID']."'>".$row['SHIFT']."</option>";
    }
    
  }
  

$shift .= "</select>";
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit User Account</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="user.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
      

            <form role="form" method="post" action="us_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />

              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Full Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Full Name" name="fullname" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Gender:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Gender" name="gender" value="<?php echo $c; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Username:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Username" name="username" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Shift:
                </div>
                <div class="col-sm-9">
                <?php echo $shift; ?>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Account Type:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Account Type" name="type" value="<?php echo $l; ?>" readonly>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>