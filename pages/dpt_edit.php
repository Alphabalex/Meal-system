<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
  $id = $_GET['id'];
  $query = "SELECT DEPARTMENT_ID, DEPARTMENT FROM department WHERE DEPARTMENT_ID = '$id'";
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz = $row['DEPARTMENT_ID'];
      $dept = $row['DEPARTMENT'];
    }
      
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Department</h4>
            </div>
            <a href="department.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">

            <form role="form" method="post" action="dpt_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Department Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Department Name" name="dept" value="<?php echo $dept; ?>">
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