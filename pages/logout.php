<?php

session_start();

// 2. Unset all the session variables
unset($_SESSION['MEMBER_ID']);
unset($_SESSION['FULLNAME']);
unset($_SESSION['USERNAME']);
unset($_SESSION['GENDER']);
unset($_SESSION['JOB_TITLE']);
unset($_SESSION['TYPE']);
unset($_SESSION['HELPER']);


session_destroy();
?>
<script type="text/javascript">
    window.location = "login.php";
</script>