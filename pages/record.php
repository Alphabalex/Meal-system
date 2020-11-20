<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
$q2="SELECT sum(Counts) AS 'total_ration',sum(Used) AS 'total_used',start_date, end_date FROM meals";
$count= mysqli_query($db,$q2);
while ($row=mysqli_fetch_array($count,MYSQLI_ASSOC)) {
  $total_used=$row['total_used'];
  $total_ration=$row['total_ration'];
  $format_start=date_create($row['start_date']);
  $format_end=date_create($row['end_date']);
  $start=date_format($format_start,'D j F Y');
  $end=date_format($format_end,'D j F Y');
} 
?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Meal Record&nbsp; <i class="fas fa-fw fa-file-text"></i></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <div id="alert"></div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                      <th>DATE</th>
                      <th colspan='2'><?php echo "$start - $end" ?></th>
                      </tr>
                      <tr>
                      <th>NAME</th>
                      <th>RATION</th>
                      <th>USED</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php  

                    $q1= "SELECT * FROM meals ORDER BY Full_Name";
                    $fetch= mysqli_query($db,$q1);
                    $records= mysqli_fetch_all($fetch,MYSQLI_ASSOC);               
                      foreach ($records as $record): ?>
                              <?php $id=$record['id']; ?>
                                  <tr>
                                    <td><?php echo $record['Full_Name']; ?></td>
                                    <td contenteditable="true" data-old_value="<?php echo $record['Counts'] ?>" onBlur="saveInlineEdit(this,'Counts','<?php echo $id; ?>','meals')" onClick="highlightEdit(this);"><?php echo $record['Counts']; ?></td>
                                    <td><?php echo $record['Used']; ?></td>
                                  </tr>
                      <?php endforeach; ?>                
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <script>
                function highlightEdit(editableObj) {
                $(editableObj).css("background","midnightblue");
                $(editableObj).css("color","white");
              } 

              function saveInlineEdit(editableObj,column,id,table) {
                // no change change made then return false
                if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
                return false;
                // send ajax to update value
                $(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
                $.ajax({
                  url: "saveInlineEdit.php",
                  cache: false,
                  data:'table='+table+'&column='+column+'&value='+editableObj.innerHTML+'&id='+id,
                  success: function(response)  {
                    $('#alert').attr('class','alert alert-success');
                    $('#alert').text(response);
                    console.log(response);
                    // set updated value as old value
                    $(editableObj).attr('data-old_value',editableObj.innerHTML);
                    $(editableObj).css("background","white");
                    $(editableObj).css("color","midnightblue");     
                  }          
                 });
              }

          </script>

          <div class="card shadow mb-4">  
            <div class="card-body">
              <h4 class="m-2 font-weight-bold text-primary">Meal Record Summary&nbsp; <i class="fas fa-fw fa-file-text"></i></h4>
              <div class="table-responsive">
                <div class="top-panel m-2">
                  <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="record.php?action=saveAspdf" class="btn btn-success btn-sm m-2">Save As PDF</a></li>
                      <li><a type="button" class="btn btn-danger btn-sm m-2" href="#" data-toggle="modal" data-target="#mealdel"><i class="fas fa-fw fa-trash"></i>Clear Record</a>
                      </li>                       
                    </ul>
                  </div>
                </div>

                <div class="modal fade" id="mealdel" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-left">This action cannot be undone, be sure you have a copy of the meal record as pdf! Are you sure you want to clear the record?</p>
                        <form role="form" method="post" action="meal_del.php">
                         <div class="form-group">
                           <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                         </div>
                          <hr>
                          <button type="submit" class="btn btn-danger btn-ok" name="meal_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
                          <button type="reset" class="btn btn-warning"><i class="fa fa-times fa-fw"></i>Reset</button>
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
                        </form> 
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
           $report="<table id='dataTable' class='table table-striped table-bordered' width='100%' cellspacing='0'>
              <tr>
                <th>DATE</th>
                <th colspan='2'>$start - $end </th>
              </tr>";
           ?> 
          <?php 
            $report.="<tr>
            <th colspan='3' class='text-center'>MEAL SUMMARY</th>
          </tr>
          <tr>
            <th>Total Ration</th>
            <th colspan='2'>$total_ration</th>
          </tr>
          <tr>
            <th colspan='3' class='text-center'>TOTAL USED SUMMARY</th>
          </tr>";
           ?>
          
          <?php 
          $q3=mysqli_query($db,"SELECT Level,sum(Used) AS 'total_used_by_level' FROM meals GROUP BY Level");
          $summaries=mysqli_fetch_all($q3,MYSQLI_ASSOC);
           ?>
           <?php foreach ($summaries as $summary): ?>
            <?php 
            $report.="<tr>
              <th>".$summary['Level']."</th>
              <th colspan='2'>".$summary['total_used_by_level']."</th>
            </tr>";
             ?>
           <?php endforeach; ?>
           <?php 
           $report.="<tr>
            <th>Total</th>
            <th colspan='2'>$total_used</th>
           </tr>
          </table>
          <div class='clearfix mt-5'>
              <div class='float-left'>
                <p>.............................................................................................</p>
                <span>Admin signature</span>
              </div>
              <div class='float-right'>
                <p>..............................................................................................</p>
                <span>Canteen signature</span>
              </div>
          </div>
          <div class='text-center'><i>Meal Records</i><br>
            <i>Admin's Copy</i></div>";

          echo $report;
            ?>
              </div>
            </div>
          </div>
          <?php   
            //generating result pdf
            if(isset($_GET['action'])){
              if(@$_GET['action']=='saveAspdf'){
                require_once('../pdf/pdf.php');
                $pdf = new Pdf();

                $pdf->set_paper('A4', 'landscape');

                $file_name = "meal_records"."(".$start."_to_".$end.")".".pdf";

                $pdf->loadHtml($report);

                $pdf->render();
                ob_end_clean();
                $pdf->stream($file_name, array("Attachment" =>1));
                exit(0);
              }
            }        
include'../includes/footer.php';
?>