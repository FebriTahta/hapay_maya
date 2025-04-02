<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <?php
          if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
            # code...
            echo '<h1 class="m-0">REKAP SPP BHP</h1>';  
          }elseif(isset($_GET['page']) && $_GET['page'] == 'client'){
            echo '<h1 class="m-0">DATA CLIENT</h1>';  
          }
        ?>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?page=dashboard" index.php?page="client">Home</a></li>
          <?php
            if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
              # code...
              echo '
                <li class="breadcrumb-item active">Dashboard</li>
              ';  
            }elseif(isset($_GET['page']) && $_GET['page'] == 'client'){
              echo '
                <li class="breadcrumb-item active">Data Client</li>
              ';  
            }
          ?>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>