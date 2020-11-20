<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
include'../includes/admin_only.php';

$sql = "SELECT * FROM level ORDER BY LEVEL";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$aaa = "<select class='form-control' name='level' required>
        <option disabled selected hidden>Select Level</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $aaa .= "<option value='".$row['LEVEL_ID']."'>".$row['LEVEL']."</option>";
  }
$aaa .= "</select>";

$sql2 = "SELECT * FROM department ORDER BY DEPARTMENT";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");

$sup = "<select class='form-control' name='dept' required>
        <option disabled selected hidden>Select Department</option>";
  while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['DEPARTMENT_ID']."'>".$row['DEPARTMENT']."</option>";
  }
$sup .= "</select>";

$sql3 = "SELECT TYPE_ID, TYPE  FROM type order by TYPE asc";
$result = mysqli_query($db, $sql3) or die ("Bad SQL: $sql");

$bbb = "<select class='form-control' name='type' required>
        <option disabled selected hidden>Select Account Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $bbb .= "<option value='".$row['TYPE_ID']."'>".$row['TYPE']."</option>";
  }
$bbb .= "</select>";

$sql4 = "SELECT * FROM shift ORDER BY SHIFT";
$result = mysqli_query($db, $sql4) or die ("Bad SQL: $sql");

$shift = "<select class='form-control' name='shift' required>
        <option disabled selected hidden>Select Shift</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $shift .= "<option value='".$row['SHIFT_ID']."'>".$row['SHIFT']."</option>";
  }
$shift .= "</select>";
?>

        <!-- Creating Account -->
        <div class="card-header py-3">
          <h4 class="m-2 font-weight-bold text-primary">Create Account(s)&nbsp;<a  href="#" data-toggle="modal" data-target="#userModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
        </div>
        <!-- ADMIN TABLE -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Admin Account(s)</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Full name</th>
                       <th>Username</th>
                       <th>Type</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = 'SELECT ID, FULLNAME, USERNAME, t.TYPE
              FROM users u
              JOIN type t ON t.TYPE_ID=u.TYPE_ID
              WHERE u.TYPE_ID=1';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['FULLNAME'].'</td>';
                echo '<td>'. $row['USERNAME'].'</td>';
                echo '<td>'. $row['TYPE'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="us_searchfrm.php?action=edit & id='.$row['ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="us_edit.php?action=edit & id='.$row['ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div></td>';
                echo '</tr> ';
                        }
?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

          <!-- Staff Account -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Staff Accounts&nbsp;
              </h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Full name</th>
                       <th>Username</th>
                       <th>Department</th>
                       <th>Level</th>
                       <th>Shift</th>
                       <th>Type</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = 'SELECT ID, USERNAME, FULLNAME, DEPARTMENT, LEVEL, SHIFT, t.TYPE
              FROM users u
              JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
              JOIN level l ON l.LEVEL_ID=u.LEVEL_ID
              JOIN shift s ON s.SHIFT_ID=u.SHIFT_ID
              JOIN type t ON t.TYPE_ID=u.TYPE_ID
              WHERE u.TYPE_ID=2';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['FULLNAME'].'</td>';
                echo '<td>'. $row['USERNAME'].'</td>';
                echo '<td>'. $row['DEPARTMENT'].'</td>';
                echo '<td>'. $row['LEVEL'].'</td>';
                echo '<td>'. $row['SHIFT'].'</td>';
                echo '<td>'. $row['TYPE'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="us_searchfrm.php?action=edit & id='.$row['ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="us_edit.php?action=edit & id='.$row['ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-danger btn-block" style="border-radius: 0px;" href="#" data-toggle="modal" data-target="#user'.$row['ID'].'">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            <div class="modal fade" id="user'.$row['ID'].'" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p class="text-left">Are you sure you want to delete?</p>
                                    <form role="form" method="post" action="us_del.php">
                                     <div class="form-group">
                                       <input type="hidden" class="form-control" name="id" value="'.$row['ID'].'" required>
                                       <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                                     </div>
                                      <hr>
                                      <button type="submit" class="btn btn-danger btn-ok" name="us_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
                                      <button type="reset" class="btn btn-warning"><i class="fa fa-times fa-fw"></i>Reset</button>
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
                                    </form> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div></td>';
                echo '</tr> ';
                        }
?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
          <!-- Canteen Account -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Canteen Accounts</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Full name</th>
                       <th>Username</th>
                       <th>Type</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = 'SELECT ID, USERNAME, FULLNAME, DEPARTMENT, LEVEL ,t.TYPE
              FROM users u
              JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
              JOIN level l ON l.LEVEL_ID=u.LEVEL_ID
              JOIN type t ON t.TYPE_ID=u.TYPE_ID
              WHERE u.TYPE_ID=3';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['FULLNAME'].'</td>';
                echo '<td>'. $row['USERNAME'].'</td>';
                echo '<td>'. $row['TYPE'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="us_searchfrm.php?action=edit & id='.$row['ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="us_edit.php?action=edit & id='.$row['ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-danger btn-block" style="border-radius: 0px;" href="#" data-toggle="modal" data-target="#user'.$row['ID'].'">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            <div class="modal fade" id="user'.$row['ID'].'" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p class="text-left">Are you sure you want to delete?</p>
                                    <form role="form" method="post" action="us_del.php">
                                     <div class="form-group">
                                       <input type="hidden" class="form-control" name="id" value="'.$row['ID'].'" required>
                                       <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                                     </div>
                                      <hr>
                                      <button type="submit" class="btn btn-danger btn-ok" name="us_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
                                      <button type="reset" class="btn btn-warning"><i class="fa fa-times fa-fw"></i>Reset</button>
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
                                    </form> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div></td>';
                echo '</tr> ';
                        }
?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

            <!-- Guest Account -->

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Guest Accounts</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable4" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Full name</th>
                       <th>Username</th>
                       <th>Type</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = 'SELECT ID, USERNAME, FULLNAME, DEPARTMENT, LEVEL ,t.TYPE
              FROM users u
              JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
              JOIN level l ON l.LEVEL_ID=u.LEVEL_ID
              JOIN type t ON t.TYPE_ID=u.TYPE_ID
              WHERE u.TYPE_ID=4';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['FULLNAME'].'</td>';
                echo '<td>'. $row['USERNAME'].'</td>';
                echo '<td>'. $row['TYPE'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="us_searchfrm.php?action=edit & id='.$row['ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="us_edit.php?action=edit & id='.$row['ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-danger btn-block" style="border-radius: 0px;" href="#" data-toggle="modal" data-target="#user'.$row['ID'].'">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            <div class="modal fade" id="user'.$row['ID'].'" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p class="text-left">Are you sure you want to delete?</p>
                                    <form role="form" method="post" action="us_del.php">
                                     <div class="form-group">
                                       <input type="hidden" class="form-control" name="id" value="'.$row['ID'].'" required>
                                       <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                                     </div>
                                      <hr>
                                      <button type="submit" class="btn btn-danger btn-ok" name="us_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
                                      <button type="reset" class="btn btn-warning"><i class="fa fa-times fa-fw"></i>Reset</button>
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
                                    </form> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div></td>';
                echo '</tr> ';
                        }
?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
<?php include'../includes/footer.php'; ?>

  <!-- User Account Modal-->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User Account</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="us_transac.php?action=add">
              <div class="form-group">
                <input class="form-control" placeholder="Full name" name="fullname" required>
              </div>
              <div class="form-group">
                <select class='form-control' name='gender' required>
                  <option disabled selected hidden>Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Username" name="username" required pattern="^[a-zA-Z0-9_-]{4,15}$" title="username must be between 4 and 15 characters long and can only contain Alphanumeric values, underscore and dash" id="username" onkeyup="checkUsername(this.value)">
                <span id="result" style="color: crimson; font-size: 15px;"></span>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
              </div>
              <div class="form-group">
                <?php
                  echo $sup;
                ?>
              </div>
              <div class="form-group">
                <?php
                  echo $aaa;
                ?>
              </div>
              <div class="form-group">
                <?php
                  echo $bbb;
                ?>
              </div>
              <div class="form-group">
                <?php
                  echo $shift;
                ?>
              </div>
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Proceed to Capturing</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  <script>
    function checkUsername(str)
    {
      if (str.length==0)
       {
        result.innerHTML="";
        return;
       }
       else
       {
        var check= new XMLHttpRequest();
        check.onreadystatechange=function()
        {
          if (this.readyState==4 && this.status==200) 
          {
            result.innerHTML=this.responseText;
          }
        };
        check.open("GET","checkusername.php?q=" + str, true);
        check.send();
       }
    }
  </script>