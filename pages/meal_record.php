<?php
include'../includes/connection.php';
include'../includes/menu.php';
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
                                  <?php echo 
                                  "<tr>
                                    <td>".$record['Full_Name']."</td>
                                    <td>".$record['Counts']."</td>
                                    <td>".$record['Used']."</td>
                                  </tr>";
                                  ?>
                      <?php endforeach; ?>                
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4">  
            <div class="card-body">
              <h4 class="m-2 font-weight-bold text-primary">Meal Record Summary&nbsp; <i class="fas fa-fw fa-file-text"></i></h4>
              <div class="table-responsive">
                <div class="top-panel m-2">
                  <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="meal_record.php?action=saveAspdf" class="btn btn-success btn-sm m-2">Save As PDF</a>
                      </li>                       
                    </ul>
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
            <i>Canteen's Copy</i></div>";

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