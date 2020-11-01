<?php
ob_start();
date_default_timezone_set("Africa/Lagos");
 $db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'meal' ) or die(mysqli_error($db));
?>