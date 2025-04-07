<section>
<div class="content" style="padding-left: 1%; padding-right: 1%;">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form id="formAddTagihanClient">
                            <div class="form-group">
                                <label for="client">Id Invoice Surat</label>
                                <input type="text" class="form-control" name="id_invoice_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="client">Nomor Tagihan</label>
                                <input type="text" class="form-control" name="no_tagihan" required>
                            </div>
                            <div class="form-group">
                                <label for="client">Terbit Surat</label>
                                <input type="date" class="form-control" name="terbit_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="client">Batas Bayar Surat</label>
                                <input type="date" class="form-control" name="batas_bayar_surat" required>
                            </div>
                            <div class="form-group">
                                <label for="client">Tagihan</label>
                                <input type="number" class="form-control" name="tagihan" required>
                            </div>
                            <div class="form-group">
                                <label for="client">Status Bayar Surat</label>
                                <input type="text" class="form-control" name="status_bayar_surat" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 text-left">
                            DAFTAR DATA TAGIHAN CLIENT
                        </div>
                        <!-- <div class="col-6 text-right">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_tagihan_client"><i class="fa fa-plus"></i></button>
                        </div> -->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_tagihan_client" class="table table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                                    <thead class="text-uppercase text-nowrap">
                                        <tr role="row">
                                            <th>No</th>
                                            <th>Client Id</th>
                                            <th>Client</th>
                                            <th>Id Invoice Surat</th>
                                            <th>No Tagihan</th>
                                            <th>Terbit Surat</th>
                                            <th>Batas Bayar Surat</th>
                                            <th>Tagihan</th>
                                            <th>Status Bayar Surat</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                    <tfoot class="text-uppercase text-nowrap">
                                        <tr role="row">
                                            <th>No</th>
                                            <th>Client Id</th>
                                            <th>Client</th>
                                            <th>Id Invoice Surat</th>
                                            <th>No Tagihan</th>
                                            <th>Terbit Surat</th>
                                            <th>Batas Bayar Surat</th>
                                            <th>Tagihan</th>
                                            <th>Status Bayar Surat</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>