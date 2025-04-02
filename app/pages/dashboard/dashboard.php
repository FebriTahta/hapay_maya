<?php 
  include('app/../pages/dashboard/dashboard_chart.php');
?>

<section class="content">
  <div class="container-fluid">
    <div class="row" id="report-client">
      <!-- Left col -->
      <div class="col-12">
        <div class="filter">
          <form id="filterForm">
            <select name="tahun" class="form-control" style="width: 150px;" id="tahun"></select>
          </form>
        </div>
      </div>
      <section class="col-lg-8 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              statistik perolehan nominal bhp (Jt)
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              statistik invoice valid spp perbulan
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart2" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </section>

      <!-- /.right col -->
      <section class="col-lg-4 connectedSortable">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              status nominal bayar spp
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
        </div>

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              status bayar spp perinvoice
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="doughnutChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
          </div>
        </div>
      </section>

      <!-- /.mid all col -->
      <section class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              perolehan nominal bhp
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table table-responsive">
              <table id="data1" class="table-bordered table-striped" style="width: 100%;">
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title text-uppercase">
              <i class="fas fa-chart-pie mr-1"></i>
              invoice valid spp perbulan
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table table-responsive">
              <table id="data2" class="table-bordered table-striped" style="width: 100%;">
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
