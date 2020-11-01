<?php
      include'../includes/connection.php';         
      $query = mysqli_query($db,"SELECT * FROM requests WHERE status='pending'");
      if(mysqli_num_rows($query)>0){
          foreach(mysqli_fetch_all($query,MYSQLI_ASSOC) as $row){
            $staff=$row['fullname'];
            $message=$row['message'];
            $date=$row['date'];
            $id=$row['id'];
            $q1=mysqli_query($db,"SELECT *, l.LEVEL
            FROM  `users` u
            join `level` l ON l.LEVEL_ID=u.LEVEL_ID WHERE FULLNAME='$staff'");
            while ($record=mysqli_fetch_array($q1,MYSQLI_ASSOC)) {
                $image=$record['IMAGE_DATA'];
                $level=$record['LEVEL'];
            }
            $q2=mysqli_query($db,"SELECT * FROM meals WHERE Full_Name='$staff'");
            while ($row=mysqli_fetch_array($q2,MYSQLI_ASSOC)) {
                 $counts=$row['Counts'];
                 $used=$row['Used'];
                 $left=$counts-$used;
            }
            $q5=mysqli_query($db,"SELECT * FROM leftovers WHERE Full_Name='$staff'");
            while ($row=mysqli_fetch_array($q5,MYSQLI_ASSOC)) {
                 $counter=$row['Counts'];
                 $use=$row['Used'];
                 $leftover=$counter-$use;
            }
            ?>
                  <div class="col-lg-3">
                    <div class="card">
                    <?php echo '<img class="card-img-top" src="data:image/jpeg;base64,'.( $image ).'"/>'; ?>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo "Level: $level"; ?></h5>
                      <ul class="list-group">
                        <li class="list-group-item list-group-item-primary"><i class="fa fa-briefcase"style="font-size:20px;"></i> Meal Vouchers: <?php echo isset($left)? $left : 0; ?></li>
                        <li class="list-group-item list-group-item-primary"><i class="fa fa-user"style="font-size:20px;"></i> <?php echo isset($leftover)? "Leftovers: $leftover" : 0; ?></li>
                      </ul>
                    </div>
                    <div class="card-footer">
                      <p class="lead text-muted"><?php echo $message ?></p>
                      <a href="accept.php?id=<?php echo $id ?>" class="btn btn-success m-2 btn-lg">Accept</a>
                      <a href="reject.php?id=<?php echo $id ?>" class="btn btn-danger m-2 btn-lg">Reject</a>
                      <p><i class="fas fa-clock-o text-gray-300"><?php echo $date ?></i></p>
                    </div>
                  </div>
                </div>
  <?php
          }
      }else{
         echo "<div class='col'><h3>No Pending Requests.</h3></div>";
      }
?>