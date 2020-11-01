<?php
include'../includes/connection.php';
include'../includes/menu.php';
include'../includes/privilege.php';
?>
          <div class="row show-grid" id="load">
            <!-- REQUEST ROW -->
            
          </div>


<script type="text/javascript">
  var autoload=setInterval(function()
{
$('#load').load('data.php').fadeIn("Slow");
},1000);
</script>                      
<?php
include'../includes/footer.php';
?>