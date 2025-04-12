<footer class="main-footer">
    <strong>© 2025 - DIREKTORAT JENDERAL INFRASTRUKTUR DIGITAL KEMENTERIAN KOMUNIKASI DAN DIGITAL REPUBLIK INDONESIA - <a href="https://www.instagram.com/balmontangerang/"> Balmon Tangerang</a>.</strong>
    <!-- Balmon Tangerang. -->
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- modal -->
  <div class="modal fade" id="modal_notif" tabindex="-1" role="dialog" aria-labelledby="modalNotifLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body" style="font-size: 14px">
                <p id="text"></p>
                <p>
                  Kami mengingatkan bahwa Anda telah memasuki periode ke-<span id="periode"></span> dan wajib melakukan pembayaran BHP ISR sesuai ketentuan yang berlaku.
                </p>
                <ol>
                  <li>
                    Jika tanggal jatuh tempo pembayaran bertepatan dengan hari libur, maka batas akhir pembayaran adalah satu (1) hari sebelum hari libur tersebut.
                  </li>
                  <li>
                    Jika Anda sudah tidak menggunakan frekuensi, harap segera mengajukan permohonan pengakhiran ISR melalui Spectraweb paling lambat pada saat jatuh tempo, agar tagihan tidak menjadi Piutang Negara.
                  </li>
                  <li>
                    Jika Anda telah melunasi tagihan ini, mohon abaikan pesan ini.
                  </li>
                </ol>
              </div>
              <div class="modal-footer">
                  <div class="row">
                      <div class="col-6 text-center">
                          <button class="btn btn-secondary" style="font-size: 14px; width: 150px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                              CLOSE
                          </button>
                      </div>
                      <div class="col-6 text-center">
                          <a href="#" id="link" class="btn btn-primary" style="font-size: 14px; width: 150px;">
                              BUAT TAGIHAN
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr JS via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php

  include('app/../global/ajax_global.php');

  if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
    
    # code...
    include('app/../pages/dashboard/dashboard_data_table.php');

  } elseif(isset($_GET['page']) && $_GET['page'] == 'client' || $_GET['page'] == 'client-edit'){
    
    # code...
    include('app/../pages/client/client_ajax.php');

  }elseif(isset($_GET['page']) && $_GET['page'] == 'status-tagihan'){
    
    # code...
    include('app/../pages/status_tagihan/status_tagihan_ajax.php');

  }
?>

<?php 
?>
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(document).ready(function(){
    setInterbal(function(){
      $('report-client').load("banner.php");
    })
  })
</script>