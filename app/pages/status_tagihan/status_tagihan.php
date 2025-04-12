<section>
<div class="content" style="padding-left: 1%; padding-right: 1%;">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header" style="border-bottom: 1px;">
                    <div class="row">
                        <div class="col-4 items-left text-left">
                            <img src="dist/img/logokomdigi.jpg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity:0.8; padding: 2%; border-radius: 5%; width: 100%;"
                            >
                        </div>
                        <div class="col-8 items-left text-left row">
                            <div class="ml-2">
                                <div class="row">
                                    <div class="col-6 text-right" id="status_wrapper">
                                        <!-- status -->
                                    </div>
                                </div>
                                
                                <p id="nama_client_text" style="font-size: 12px; margin-bottom: 0; padding-bottom: 0;"></p>
                                <p style="font-size: 12px; padding-top: 0; padding-bottom: 0; margin-bottom: 0;">Tagihan : 
                                    <span id="besar_bhp_text"></span>
                                </p>
                                <p style="font-size: 12px; padding-top: 0; margin-top: 0;">Batas Bayar : 
                                    <span id="batas_bayar_text"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <form id="formAddTagihanClient">
                        <div class="row">
                            <!-- hiden -->
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="bulan" id="bulan" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="no" id="no" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id_client" id="id_client" required>
                                    <input type="hidden" class="form-control" name="client_id" id="client_id" required>
                                    <input type="hidden" class="form-control" name="nama_client" id="nama_client" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="alamat_client" id="alamat_client" required>
                                </div>
                            </div>
                           
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="id_invoice_surat" style="font-size: 12px;" class="text-uppercase">id invoice surat</label>
                                    <input type="text" class="form-control" name="id_invoice_surat" id="id_invoice_surat" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="id_invoice_surat" style="font-size: 12px;" class="text-uppercase">no tagihan</label>
                                    <input type="text" class="form-control" name="no_tagihan" id="no_tagihan" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="client" class="text-uppercase" style="font-size: 12px;">Terbit surat</label>
                                    <input type="date" class="form-control" name="terbit_surat" id="terbit_surat" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="client" class="text-uppercase" style="font-size: 12px;">Batas bayar</label>
                                    <input type="date" class="form-control" name="batas_bayar_surat" id="batas_bayar_surat" required>
                                </div>
                            </div>
                            <!-- hiden -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="client" class="text-uppercase" style="font-size: 12px;">Tagihan</label>
                                    <input type="number" class="form-control" name="tagihan" id="tagihan" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-group mb-2">
                                        <label for="client" class="text-uppercase" style="font-size: 12px;">Status</label>
                                        <select name="status" id="status" class="form-control status-dropdown" onchange="ubahWarna()" required>
                                            <option value="" selected disabled>-- PILIH STATUS --</option>
                                            <option value="LUNAS" class="LUNAS">LUNAS</option>
                                            <option value="BELUM" class="BELUM">BELUM</option>
                                            <option value="KURANG" class="KURANG">KURANG</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-12 text-left">
                            HISTORY TABEL DAFTAR DATA TAGIHAN CLIENT
                        </div>
                        <input type="hidden" id="client_id_text" value="<?php echo $_GET['client_id']?>" class="form-control">
                        <input type="hidden" id="id" value="<?php echo $_GET['id']?>" class="form-control">
                        <input type="hidden" id="notif_id" value="<?php echo $_GET['notif_id']?>" class="form-control">
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