<?php
include'../includes/connection.php';
include'../includes/topp.php';

$user=$_SESSION['USERNAME'];
$q1=mysqli_query($db,"SELECT *, l.LEVEL, d.DEPARTMENT
        FROM  `users` u
        join `level` l ON l.LEVEL_ID=u.LEVEL_ID
        join `department` d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
        WHERE USERNAME='$user'");
while ($row=mysqli_fetch_array($q1,MYSQLI_ASSOC)) 
{
   $level=$row['LEVEL'];
   $staff=$row['FULLNAME'];
   $image=$row['IMAGE_DATA'];
   $dept=$row['DEPARTMENT'];
}
$q2=mysqli_query($db,"SELECT * FROM meals WHERE Full_Name='$staff'");
  if(mysqli_num_rows($q2)>0) 
  {
        while ($row=mysqli_fetch_array($q2,MYSQLI_ASSOC)) 
    {
       $counts=$row['Counts'];
       $used=$row['Used'];
       $left=$counts-$used;
       $format_start=date_create($row['start_date']);
       $format_end=date_create($row['end_date']);
       $start=date_format($format_start,'D j F Y');
       $end=date_format($format_end,'D j F Y');
    }
  }

$q3=mysqli_query($db,"SELECT * FROM leftovers WHERE Full_Name='$staff'");
if(mysqli_num_rows($q3)>0)
{
      while ($row=mysqli_fetch_array($q3,MYSQLI_ASSOC)) 
    {
         $counter=$row['Counts'];
         $use=$row['Used'];
         $leftover=$counter-$use;
    }
}

?>
<style type="text/css">
 /* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 30% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 550px;
}
a, button, code, div, img, input, label, li, p, pre, select, span, svg, table, td, textarea, th, ul {
    -webkit-border-radius: 0!important;
    -moz-border-radius: 0!important;
    border-radius: 0!important;
}
.dashboard-stat, .portlet {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
}
.portlet {
    margin-top: 0;
    margin-bottom: 25px;
    padding: 0;
    border-radius: 4px;
}
.portlet.bordered {
    border-left: 2px solid #e6e9ec!important;
}
.portlet.light {
    padding: 12px 20px 15px;
    background-color: #fff;
}
.portlet.light.bordered {
    border: 1px solid #e7ecf1!important;
}
.list-separated {
    margin-top: 10px;
    margin-bottom: 15px;
}
.profile-stat {
    padding-bottom: 20px;
    border-bottom: 1px solid #f0f4f7;
}
.profile-stat-title {
    color: #7f90a4;
    font-size: 25px;
    text-align: center;
}
.uppercase {
    text-transform: uppercase!important;
}

.profile-stat-text {
    color: #5b9bd1;
    font-size: 10px;
    font-weight: 600;
    text-align: center;
}
.profile-desc-title {
    color: #7f90a4;
    font-size: 17px;
    font-weight: 600;
}
.profile-desc-text {
    color: #7e8c9e;
    font-size: 14px;
}
.margin-top-20 {
    margin-top: 20px!important;
}
[class*=" fa-"]:not(.fa-stack), [class*=" glyphicon-"], [class*=" icon-"], [class^=fa-]:not(.fa-stack), [class^=glyphicon-], [class^=icon-] {
    display: inline-block;
    line-height: 14px;
    -webkit-font-smoothing: antialiased;
}
.profile-desc-link i {
    width: 22px;
    font-size: 19px;
    color: #abb6c4;
    margin-right: 5px;
}
</style>
  <div class="container">
    <div class="row profile">
    <div class="col-md-6  mx-auto">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic text-center">
          <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.( $image ).'"/>'; ?>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            <?php echo strtoupper($staff); ?>
          </div>
          <div class="profile-usertitle-job">
            <?php echo "DEPARTMENT: $dept"; ?>
          </div>
          <div class="profile-usertitle-job">
            <?php echo "Level: $level"; ?>
          </div>
        </div>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
          <ul class="nav">
            <li class="active">
              <a href="#">
              <i class="glyphicon glyphicon-home"></i>
              Overview </a>
            </li>
            <li>
              <a href="#" data-toggle="modal" data-target="#settingsModal" data-href="settings.php?action=edit & id='<?php echo $a; ?>'">
              <i class="glyphicon glyphicon-user"></i>
              Account Settings </a>
            </li>
            <li>
              <a href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="glyphicon glyphicon-user"></i>
              Logout </a>
            </li>
          </ul>
        </div>
        <!-- END MENU -->
        <?php 
          if(isset($_POST['sendrequest'])){
            if ($left==0 && $leftover==0) {
              echo "<script>alert('Sorry, you have exhausted your meal chances!')</script>";
            }else{
                  $message = "$staff would like to request a meal.";
                  $query = mysqli_query($db,"INSERT INTO requests (fullname,message,date,status) VALUES ('$staff', '$message', CURRENT_TIMESTAMP,'pending')");
                  if($query){
                      echo "<script>alert('Your meal request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
                  }else{
                      echo "<script>alert('Unknown error occured.')</script>";
                  }
            }
              
          }
         ?>
         
        <div class="portlet light bordered">
              <!-- STAT -->
            <div class="row list-separated profile-stat">
              <div class="col-md-4 col-sm-4 col-xs-6">
                  <div class="uppercase profile-stat-title"><?php echo isset($left)? $left : 0; ?> </div>
                  <div class="uppercase profile-stat-text"> MEAL VOUCHERS </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-6">
                  <div class="uppercase profile-stat-title"> <?php echo isset($leftover)? $leftover : 0; ?></div>
                  <div class="uppercase profile-stat-text"> PREVIOUS WEEK LEFTOVERS</div>
              </div>
            </div>
            <!-- END STAT -->
              <div>
                <h4 class="profile-desc-title">Validity</h4>
                <span class="profile-desc-text"> <?php echo isset($start) && isset($end)? "$start - $end" : ''; ?> </span> 
                <p>
                  <form method="POST" action="user_dashboard.php">
                  <input type="submit" name="sendrequest" value="Send Meal Request" class="btn btn-primary d-block mx-auto">
                </form>
                </p>
              </div>
            </div>                   
          </div>
        </div>
      </div>
    </div>       
<?php
include'../includes/footer.php';
?>