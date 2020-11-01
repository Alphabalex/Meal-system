<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';  
  $query = 'SELECT * FROM shift WHERE SHIFT_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['SHIFT_ID'];
      $shift= $row['SHIFT'];
      $meal= $row['MEAL'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Shift</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="shift.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="shift_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Shift:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Shift" name="shift" value="<?php echo $shift; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Number of Meals:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Number of Meals" name="meal" value="<?php echo $meal; ?>" required type="number">
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>