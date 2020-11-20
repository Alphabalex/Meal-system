<?php
  require('session.php');
  confirm_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Balogun Abdulquddus">

  <title>Nigerite Meal system</title>
  <link rel="icon" href="https://www.freeiconspng.com/uploads/sales-icon-7.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/print.css" media="print">
</head>

<body id="page-top">
          
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Nigerite Meal system</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Tables
      </div>
      <!-- Tables Buttons -->
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Accounts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="department.php">
          <i class="fas fa-fw fa-box"></i>
          <span>Department</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="level.php">
          <i class="fas fa-fw fa-signal"></i>
          <span>Level</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shift.php">
          <i class="fas fa-fw fa-signal"></i>
          <span>Shift</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="awardmeal.php">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Award Meal</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="overtime.php">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Overtime</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="record.php">
          <i class="fas fa-fw fa-file-pdf"></i>
          <span>Meal Record</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="leftover.php">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Leftovers Record</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="exception.php">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Exceptions Record</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="helpers.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Helpers Record</span></a>
      </li>   
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>
