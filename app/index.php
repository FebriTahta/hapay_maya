<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(!$_SESSION['nama']){
  header('Location: ../index.php?session=expired');
}
include('header.php');?>
<?php include('../conf/config.php');?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<link rel="icon" type="image/png" href="dist/img/logo.png">

  <!-- Preloader -->
  <?php include('preloader.php');?>

  <!-- Navbar -->
  <?php include('navbar.php');?>
  <!-- /Navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include('logo.php');?>

    <!-- Sidebar -->
    <?php include('sidebar.php');?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include('content_header.php');?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
    if (isset($_GET['page'])){
      if ($_GET['page']=='dashboard'){
        include('app/../pages/dashboard/dashboard.php');
      }
      else if($_GET['page']=='client'){
        include('app/../pages/client/client.php');
      }
      else if($_GET['page']=='data-pembayaran'){
        include('data_pembayaran.php');
      }
      else if($_GET['page']=='data'){
        include('data.php');
      }
      else{
        include('data_pembayaran.php');
      }
    }
    else{
      include('app/../pages/dashboard/dashboard.php');
    }?> 
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php');?> 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
