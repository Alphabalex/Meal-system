<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
include'../includes/admin_only.php';
?>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Helpers&nbsp;</h4>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Helper's Name</th>
                       <th>Meal Owner</th>
                       
                       <th>Date</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = 'SELECT * FROM helpers';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['Helper'].'</td>';
                echo '<td>'. $row['User_Name'].'</td>';
                echo '<td>'. $row['Date'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="hp_searchfrm.php?action=edit & id='.$row['id'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">                                                         <li>
                                  <a type="button" class="btn btn-warning bg-gradient-danger btn-block" style="border-radius: 0px;" href="#" data-toggle="modal" data-target="#help'.$row['id'].'">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            <div class="modal fade" id="help'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
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
                                    <form role="form" method="post" action="hp_del.php">
                                     <div class="form-group">
                                       <input type="hidden" class="form-control" name="id" value="'.$row['id'].'" required>
                                       <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                                     </div>
                                      <hr>
                                      <button type="submit" class="btn btn-danger btn-ok" name="hp_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
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
                <input class="form-control" placeholder="Username" name="username" required pattern="^[a-zA-Z0-9]{4,10}$" title="username must be between 4 and 10 characters long and can only contain Alphanumeric values" id="username" onkeyup="checkUsername(this.value)">
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