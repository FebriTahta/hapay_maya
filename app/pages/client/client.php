<section>
    <div class="content" style="padding-left: 1%; padding-right: 1%;">
        <div id="info" class="info row text-uppercase"></div>
        <div class="filter mb-2" style="margin-left: 6px;">
            <div class="row">
                <form id="filterForm col-4" style="margin-right: 10px;">
                    <select name="tahun" class="form-control" style="width: 150px;" id="tahun"></select>
                </form>

                <form id="filterFormStatus col-4">
                    <select name="status" class="form-control" style="width: 150px;" id="status"></select>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 text-left">
                        DETAIL TABLE DATA CLIENT
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_client"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="data_table_client" class="table table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                                <thead class="text-uppercase text-nowrap">
                                    <tr role="row">
                                        <th>No</th>
                                        <th>Wilayah</th>
                                        <th>Client</th>
                                        <th>Alamat</th>
                                        <th>Client Id</th>
                                        <th>App Id</th>
                                        <th>No Simf</th>
                                        <th>Id Invoice</th>
                                        <th>No Spp</th>
                                        <th>Service</th>
                                        <th>Terbit Spp</th>
                                        <th>Batas Bayar</th>
                                        <th>Awal Periode BHP</th>
                                        <th>Potensi BHP</th>
                                        <th>Besar BHP</th>
                                        <th>Tahun Periode</th>
                                        <th>Status Bayar</th>
                                        <th>Status Isr</th>
                                        <th>Tgl Pembayaran</th>
                                        <th>Bhp Terbayar</th>
                                        <th>Bhp Dibatalkan</th>
                                        <th>Denda Tunggakan</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                                <tfoot class="text-uppercase text-nowrap">
                                    <tr role="row">
                                    <th>No</th>
                                        <th>Wilayah</th>
                                        <th>Client</th>
                                        <th>Alamat</th>
                                        <th>Client Id</th>
                                        <th>App Id</th>
                                        <th>No Simf</th>
                                        <th>Id Invoice</th>
                                        <th>No Spp</th>
                                        <th>Service</th>
                                        <th>Terbit Spp</th>
                                        <th>Batas Bayar</th>
                                        <th>Awal Periode BHP</th>
                                        <th>Potensi BHP</th>
                                        <th>Besar BHP</th>
                                        <th>Tahun Periode</th>
                                        <th>Status Bayar</th>
                                        <th>Status Isr</th>
                                        <th>Tgl Pembayaran</th>
                                        <th>Bhp Terbayar</th>
                                        <th>Bhp Dibatalkan</th>
                                        <th>Denda Tunggakan</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include('client_modal_add.php');
?>