<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
 ?>

 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Staffs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Visitors</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <!-- STAFFS TAB -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
<div class="card-header py-3">
  <h4 class="m-2 font-weight-bold text-primary">Award Meal&nbsp;<i class="fas fa-fw fa-cutlery"></i></h4>
</div>
<div class="card-body">
  <form method="post" action="meal_transac.php?action=add">
    <div class="form-group">
      <input placeholder="From" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="From" name="from" class="form-control" required />
    </div>
    <div class="form-group">
      <input placeholder="To" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="To" name="to" class="form-control" required />
    </div>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
       <thead>
           <tr>
             <th>Name</th>
             <th>Department</th>
             <th>Meal Voucher</th>
           </tr>
       </thead>
        <tbody>

        <?php                  
        $query = "SELECT ID, USERNAME, FULLNAME, DEPARTMENT, MEAL FROM users u
                  JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
                  JOIN type t ON t.TYPE_ID=u.TYPE_ID
                  JOIN shift s ON s.SHIFT_ID=u.SHIFT_ID
                  WHERE u.TYPE_ID=2";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        $staffs= mysqli_fetch_all($result,MYSQLI_ASSOC);          
                foreach($staffs as $staff): ?>
                      <?php 
                        $name=$staff['FULLNAME'];
                        $dpt=$staff['DEPARTMENT'];
                        $usr=$staff['USERNAME'];
                        $uid=$staff['ID'];
                        $meal=$staff['MEAL'];
                      ?>
                      <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $dpt; ?></td>
                        <td>
                          <input type="hidden" name="username[]" value="<?php echo $usr ?>">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="<?php echo 'i'.$uid.'5' ?>"  class="custom-control-input" value="<?php echo $meal ?>" name="<?php echo $usr.'mealcount' ?>" checked required>
                            <label class="custom-control-label" for="<?php echo 'i'.$uid.'5' ?>"><?php echo $meal ?></label>
                          </div>
                        </td>
                      </tr> 
        <?php endforeach; ?> 
          </tbody>
        </table>
      </div>
      <input type="submit" name="giveMeal" value="submit" class="btn btn-primary">
      </form>
    </div>
  </div>
  </div>
  <!-- VISITORS TAB -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
<div class="card-header py-3">
  <h4 class="m-2 font-weight-bold text-primary">Award Meal&nbsp;<i class="fas fa-fw fa-cutlery"></i></h4>
</div>
<div class="card-body">
  <form method="post" action="meal_transac.php?action=addVisitorMeal">
    <div class="form-group">
      <input placeholder="From" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="From" name="from" class="form-control" required />
    </div>
    <div class="form-group">
      <input placeholder="To" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="To" name="to" class="form-control" required />
    </div>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0"> 
       <thead>
           <tr>
             <th>Name</th>
             <th>Department</th>
             <th>Meal Voucher</th>
           </tr>
       </thead>
        <tbody>

        <?php                  
        $query = "SELECT ID, USERNAME, FULLNAME, DEPARTMENT, MEAL FROM users u
                  JOIN department d ON d.DEPARTMENT_ID=u.DEPARTMENT_ID
                  JOIN type t ON t.TYPE_ID=u.TYPE_ID
                  JOIN shift s ON s.SHIFT_ID=u.SHIFT_ID
                  WHERE u.TYPE_ID=4";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        $staffs= mysqli_fetch_all($result,MYSQLI_ASSOC);          
                foreach($staffs as $staff): ?>
                      <?php 
                        $name=$staff['FULLNAME'];
                        $dpt=$staff['DEPARTMENT'];
                        $usr=$staff['USERNAME'];
                        $uid=$staff['ID'];
                        $meal=$staff['MEAL'];
                      ?>
                      <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $dpt; ?></td>
                        <td>
                          <input type="hidden" name="username[]" value="<?php echo $usr ?>">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="<?php echo 'i'.$uid.'3' ?>"  class="custom-control-input" value="3" name="<?php echo $usr.'mealcount' ?>" required>
                            <label class="custom-control-label" for="<?php echo 'i'.$uid.'3' ?>">3</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="<?php echo 'i'.$uid.'2' ?>"  class="custom-control-input" value="2" name="<?php echo $usr.'mealcount' ?>" required>
                            <label class="custom-control-label" for="<?php echo 'i'.$uid.'2' ?>">2</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="<?php echo 'i'.$uid.'1' ?>"  class="custom-control-input" value="1" name="<?php echo $usr.'mealcount' ?>" required>
                            <label class="custom-control-label" for="<?php echo 'i'.$uid.'1' ?>">1</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="<?php echo 'i'.$uid.'0' ?>"  class="custom-control-input" value="0" name="<?php echo $usr.'mealcount' ?>" checked required>
                            <label class="custom-control-label" for="<?php echo 'i'.$uid.'0' ?>">0</label>
                          </div>
                        </td>
                      </tr> 
        <?php endforeach; ?> 
          </tbody>
        </table>
      </div>
      <input type="submit" name="giveMeal" value="submit" class="btn btn-primary">
      </form>
    </div>
  </div></div>
</div>
            

<?php
include'../includes/footer.php';
?>
