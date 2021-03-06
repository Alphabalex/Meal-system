<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
include'../includes/privilege.php';
$q1= "SELECT * FROM exceptions ORDER BY Full_Name";
$fetch= mysqli_query($db,$q1);
$records= mysqli_fetch_all($fetch,MYSQLI_ASSOC);
$q2="SELECT start_date, end_date FROM exceptions";
$dates= mysqli_query($db,$q2);
while ($row=mysqli_fetch_array($dates,MYSQLI_ASSOC)) {
  $format_start=date_create($row['start_date']);
  $format_end=date_create($row['end_date']);
  $start=date_format($format_start,'D j F Y');
  $end=date_format($format_end,'D j F Y');
} 
?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Exception records&nbsp; <i class="fas fa-fw fa-file-text"></i></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <div class="top-panel m-2">
                  <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="exception.php?action=saveAspdf" class="btn btn-success btn-sm m-2">Save As PDF</a></li>
                      <li><a type="button" class="btn btn-danger btn-sm m-2" href="#" data-toggle="modal" data-target="#expdel"><i class="fas fa-fw fa-trash"></i>Clear Record</a>
                      </li>                       
                    </ul>
                  </div>
                </div>

                <div class="modal fade" id="expdel" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
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
                        <form role="form" method="post" action="exp_del.php">
                         <div class="form-group">
                           <input type="password"  maxlength="4" class="form-control" placeholder="Enter Pin" name="pin" required>
                         </div>
                          <hr>
                          <button type="submit" class="btn btn-danger btn-ok" name="exp_del"><i class="fa fa-trash fa-fw"></i>Delete</button>
                          <button type="reset" class="btn btn-warning"><i class="fa fa-times fa-fw"></i>Reset</button>
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
                        </form> 
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
                $output="
                  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>        
                  <thead>
                  <tr>
                    <th>NAME</th>
                    <th>LEVEL</th>
                    <th>RATION</th>
                    <th>DATE</th>
                  </tr>
                  </thead>
                  <tbody>";
                 ?>
                <?php foreach ($records as $record): ?>
                <?php  
                $format_start=date_create($record['start_date']);
                $format_end=date_create($record['end_date']);
                $start=date_format($format_start,'D j F Y');
                $end=date_format($format_end,'D j F Y');
                ?>
                <?php $output.="<tr>
                  <td>".$record['Full_Name']."</td>
                  <td>".$record['Level']."</td>
                  <td>".$record['Counts']."</td>
                  <td>".$start ." - ". $end."</td>
                </tr>";
                ?>
              <?php endforeach; ?> 
              <?php
              $output.="</tbody>
                </table>";
              echo $output;
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

                $file_name="exception_records"."(".$start."_to_".$end.")".".pdf";

                $pdf->loadHtml($output);

                $pdf->render();
                ob_end_clean();
                $pdf->stream($file_name, array("Attachment" =>1));
                exit(0);
              }
            }        
include'../includes/footer.php';
?>